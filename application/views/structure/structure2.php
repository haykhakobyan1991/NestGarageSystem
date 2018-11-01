<!-- Structure Start -->
<style>
	canvas{
		background: #fff;
	}
</style>
<script src="<?= base_url('assets/js/go.js') ?>"></script>
<div class="jumbotron jumbotron-fluid pb-2 pt-2">



	<div id="sample">
		<div id="myDiagramDiv" style="background-color: #696969; border: solid 1px black; height: 500px"></div>
		<div>
			<div id="myInspector">

			</div>
		</div>


		<div>
			<textarea id="mySavedModel" style="display:none;width:100%;height:250px">
				{"class": "go.TreeModel",
		  			"nodeDataArray": [
						{"key":1,"name":"Stella Payne Diaz","title":"CEO"},
						{"key":2,"name":"Luke Warm","title":"VP Marketing/Sales","parent":1},
						{"key":3,"name":"Meg Meehan Hoffa","title":"Sales","parent":2},
						{"key":4,"name":"Peggy Flaming","title":"VP Engineering","parent":1},
						{"key":5,"name":"Saul Wellingood","title":"Manufacturing","parent":4},
						{"key":6,"name":"Al Ligori","title":"Marketing","parent":2},
						{"key":7,"name":"Dot Stubadd","title":"Sales Rep","parent":3},
						{"key":8,"name":"Les Ismore","title":"Project Mgr","parent":5},
						{"key":9,"name":"April Lynn Parris","title":"Events Mgr","parent":6},
						{"key":10,"name":"Xavier Breath","title":"Engineering","parent":4},
						{"key":11,"name":"Anita Hammer","title":"Process","parent":5},
						{"key":12,"name":"Billy Aiken","title":"Software","parent":10},
						{"key":13,"name":"Stan Wellback","title":"Testing","parent":10},
						{"key":14,"name":"Marge Innovera","title":"Hardware","parent":10},
						{"key":15,"name":"Evan Elpus","title":"Quality","parent":5},
						{"key":16,"name":"Lotta B. Essen","title":"Sales Rep","parent":3},
						{"key":17,"name":"Hayk","title":"Hakobyan","parent":3},
						{"key":18,"name":"Hakobyan","title":"zzzz","parent":3},
						{"key":19,"name":"Hakobyan Hayk","title":"ffffff","parent":3}
			 		]
				}
    	</textarea>
		</div>
	</div>

	<script src="chrome-extension://gppongmhjkpfnbhagpmjfkannfbllamg/js/inject.js"></script>
</div>










<script>

	/*Diagram Trees Start*/


	// This button assumes data binding to the "checked" property.
	go.GraphObject.defineBuilder("TriStateCheckBoxButton", function (args) {
		var button = /** @type {Panel} */ (
			go.GraphObject.make("Button",
				{
					"ButtonBorder.fill": "white",
					"ButtonBorder.stroke": "gray",
					width: 14,
					height: 14
				},
				go.GraphObject.make(go.Shape,
					{
						name: "ButtonIcon",
						geometryString: "M0 4 L3 9 9 0",  // a "check" mark
						strokeWidth: 2,
						stretch: go.GraphObject.Fill,  // this Shape expands to fill the Button
						geometryStretch: go.GraphObject.Uniform,  // the check mark fills the Shape without distortion
						background: null,
						visible: false  // visible set to false: not checked, unless data.checked is true
					},
					new go.Binding("visible", "checked", function (p) { return p === true || p === null; }),
					new go.Binding("stroke", "checked", function (p) { return p === null ? null : "black"; }),
					new go.Binding("background", "checked", function (p) { return p === null ? "gray" : null; })
				)
			)
		);

		function updateCheckBoxesDown(node, val) {
			node.diagram.model.setDataProperty(node.data, "checked", val);
			node.findTreeChildrenNodes().each(function (child) { updateCheckBoxesDown(child, val); })
		}

		function updateCheckBoxesUp(node) {
			var parent = node.findTreeParentNode();
			if (parent !== null) {
				var anychecked = parent.findTreeChildrenNodes().any(function (n) { return n.data.checked !== false && n.data.checked !== undefined; });
				var allchecked = parent.findTreeChildrenNodes().all(function (n) { return n.data.checked === true; });
				node.diagram.model.setDataProperty(parent.data, "checked", (allchecked ? true : (anychecked ? null : false)));
				updateCheckBoxesUp(parent);
			}
		}

		button.click = function (e, button) {
			if (!button.isEnabledObject()) return;
			var diagram = e.diagram;
			if (diagram === null || diagram.isReadOnly) return;
			if (diagram.model.isReadOnly) return;
			e.handled = true;
			var shape = button.findObject("ButtonIcon");
			diagram.startTransaction("checkbox");
			// Assume the name of the data property is "checked".
			var node = button.part;
			var oldval = node.data.checked;
			var newval = (oldval !== true);  // newval will always be either true or false, never null
			// Set this data.checked property and those of all its children to the same value
			updateCheckBoxesDown(node, newval);
			// Walk up the tree and update all of their checkboxes
			updateCheckBoxesUp(node);
			// support extra side-effects without clobbering the click event handler:
			if (typeof button["_doClick"] === "function") button["_doClick"](e, button);
			diagram.commitTransaction("checkbox");
		};

		return button;
	});

	function init() {
		if (window.goSamples) goSamples();  // init for these samples -- you don't need to call this
		var $ = go.GraphObject.make;  // for conciseness in defining templates

		myDiagram =
			$(go.Diagram, "myDiagramDiv",
				{
					allowMove: false,
					allowCopy: false,
					allowDelete: false,
					allowHorizontalScroll: false,
					layout:
						$(go.TreeLayout,
							{
								alignment: go.TreeLayout.AlignmentStart,
								angle: 0,
								compaction: go.TreeLayout.CompactionNone,
								layerSpacing: 16,
								layerSpacingParentOverlap: 1,
								nodeIndentPastParent: 1.0,
								nodeSpacing: 0,
								setsPortSpot: false,
								setsChildPortSpot: false
							})
				});

		myDiagram.nodeTemplate =
			$(go.Node,
				{ // no Adornment: instead change panel background color by binding to Node.isSelected
					selectionAdorned: false,
					// a custom function to allow expanding/collapsing on double-click
					// this uses similar logic to a TreeExpanderButton
					doubleClick: function(e, node) {
						var cmd = myDiagram.commandHandler;
						if (node.isTreeExpanded) {
							if (!cmd.canCollapseTree(node)) return;
						} else {
							if (!cmd.canExpandTree(node)) return;
						}
						e.handled = true;
						if (node.isTreeExpanded) {
							cmd.collapseTree(node);
						} else {
							cmd.expandTree(node);
						}
					}
				},
				$("TreeExpanderButton",
					{
						width: 14,
						"ButtonBorder.fill": "whitesmoke",
						"ButtonBorder.stroke": "lightgray",
						"_buttonFillOver": "rgba(0,128,255,0.25)",
						"_buttonStrokeOver": null
					}),
				$(go.Panel, "Horizontal",
					{ position: new go.Point(16, 0), margin: new go.Margin(0, 2, 0, 0), defaultAlignment: go.Spot.Center },
					new go.Binding("background", "isSelected", function(s) { return (s ? "lightblue" : "white"); }).ofObject(),
					$("TriStateCheckBoxButton"),
					$(go.TextBlock,
						{ font: '9pt Verdana, sans-serif', margin: new go.Margin(0, 0, 0, 2) },
						new go.Binding("text", "name", function(s) {
							return " " + s;
						})),
					$(go.TextBlock,
						{ font: '9pt Verdana, sans-serif', margin: new go.Margin(0, 0, 0, 2) },
						new go.Binding("text", "title", function(s) {
							return " " + s;
						}))
				)  // end Horizontal Panel
			);  // end Node

		// without lines
		//myDiagram.linkTemplate = $(go.Link);

		// with lines
		myDiagram.linkTemplate =
			$(go.Link,
				{ selectable: false,
					routing: go.Link.Orthogonal,
					fromEndSegmentLength: 4,
					toEndSegmentLength: 4,
					fromSpot: new go.Spot(0.001, 1, 7, 0),
					toSpot: go.Spot.Left },
				$(go.Shape,
					{ stroke: 'gray', strokeDashArray: [1,2] }));
		load();

		// support editing the properties of the selected person in HTML
		if (window.Inspector) myInspector = new Inspector("myInspector", myDiagram,
			{
				properties: {
					"key": {readOnly: true},
					"comments": {}
				}
			});

		// // create a random tree
		// var nodeDataArray = [{ key: 0 }];
		// var max = 25;
		// var count = 0;
		// while (count < max) {
		// 	count = makeTree(3, count, max, nodeDataArray, nodeDataArray[0]);
		// }
		// myDiagram.model = new go.TreeModel(nodeDataArray);
	}

	function load() {
		myDiagram.model = go.Model.fromJson(document.getElementById("mySavedModel").value);
	}





	/*
	*
	* Document Ready Function
	*
	 */

	$(document).ready(function () {
		init();
	});
</script>

