<!-- Structure Start -->
<style>
	canvas {
		background: #fff;
	}
</style>
<script src="<?= base_url('assets/js/go.js') ?>"></script>
<div class="jumbotron jumbotron-fluid pb-2 pt-2">


	<div id="sample">
		<div id="myDiagramDiv" style="border: solid 1px black;  height:600px"></div>
	</div>
	<textarea style="display: none; width: 100%;" id="mySavedModel">

</textarea>
	<button id="SaveButton" onclick="save()">Save</button>

	<script src="chrome-extension://gppongmhjkpfnbhagpmjfkannfbllamg/js/inject.js"></script>
</div>


<script>
	function init() {
		if (window.goSamples) goSamples();  // init for these samples -- you don't need to call this
		var $ = go.GraphObject.make;  // for conciseness in defining templates

		myDiagram =
			$(go.Diagram, "myDiagramDiv",  // create a Diagram for the DIV HTML element
				{
					// position the graph in the middle of the diagram
					initialContentAlignment: go.Spot.Center,

					// allow double-click in background to create a new node
					"clickCreatingTool.archetypeNodeData": {text: "Node", color: "red"},

					// allow Ctrl-G to call groupSelection()
					"commandHandler.archetypeGroupData": {text: "Group", isGroup: true, color: "blue"},


					// enable undo & redo

					layout:
						$(go.TreeLayout,
							{
								treeStyle: go.TreeLayout.StyleLastParents,
								arrangement: go.TreeLayout.ArrangementHorizontal,
								// properties for most of the tree:
								angle: 90,
								// layerSpacing: 35,
								// properties for the "last parents":
								alternateAngle: 90,
								alternateLayerSpacing: 35,
								//alternateAlignment: go.TreeLayout.AlignmentBus,
								alternateNodeSpacing: 20
							}),


				});

		// Define the appearance and behavior for Nodes:

		// First, define the shared context menu for all Nodes, Links, and Groups.

		// To simplify this code we define a function for creating a context menu button:
		function makeButton(text, action, visiblePredicate) {
			return $("ContextMenuButton",
				$(go.TextBlock, text),
				{click: action},
				// don't bother with binding GraphObject.visible if there's no predicate
				visiblePredicate ? new go.Binding("visible", "", function (o, e) {
					return o.diagram ? visiblePredicate(o, e) : false;
				}).ofObject() : {});
		}

		// a context menu is an Adornment with a bunch of buttons in them
		var partContextMenu =
			$(go.Adornment, "Vertical",
				makeButton("Properties",
					function (e, obj) {  // OBJ is this Button
						var contextmenu = obj.part;  // the Button is in the context menu Adornment
						var part = contextmenu.adornedPart;  // the adornedPart is the Part that the context menu adorns
						// now can do something with PART, or with its data, or with the Adornment (the context menu)
						if (part instanceof go.Link) alert(linkInfo(part.data));
						else if (part instanceof go.Group) alert(groupInfo(contextmenu));
						else alert(nodeInfo(part.data));
					}),
				makeButton("Cut",
					function (e, obj) {
						e.diagram.commandHandler.cutSelection();
					},
					function (o) {
						return o.diagram.commandHandler.canCutSelection();
					}),
				makeButton("Copy",
					function (e, obj) {
						e.diagram.commandHandler.copySelection();
					},
					function (o) {
						return o.diagram.commandHandler.canCopySelection();
					}),
				makeButton("Paste",
					function (e, obj) {
						e.diagram.commandHandler.pasteSelection(e.diagram.lastInput.documentPoint);
					},
					function (o) {
						return o.diagram.commandHandler.canPasteSelection();
					}),
				makeButton("Delete",
					function (e, obj) {
						e.diagram.commandHandler.deleteSelection();
					},
					function (o) {
						return o.diagram.commandHandler.canDeleteSelection();
					}),
				makeButton("Undo",
					function (e, obj) {
						e.diagram.commandHandler.undo();
					},
					function (o) {
						return o.diagram.commandHandler.canUndo();
					}),
				makeButton("Redo",
					function (e, obj) {
						e.diagram.commandHandler.redo();
					},
					function (o) {
						return o.diagram.commandHandler.canRedo();
					}),
				makeButton("Group",
					function (e, obj) {
						e.diagram.commandHandler.groupSelection();
					},
					function (o) {
						return o.diagram.commandHandler.canGroupSelection();
					}),
				makeButton("Ungroup",
					function (e, obj) {
						e.diagram.commandHandler.ungroupSelection();
					},
					function (o) {
						return o.diagram.commandHandler.canUngroupSelection();
					})
			);

		function mayWorkFor(node1, node2) {
			if (!(node1 instanceof go.Node)) return false;  // must be a Node
			if (node1 === node2) return false;  // cannot work for yourself
			if (node2.isInTreeOf(node1)) return false;  // cannot work for someone who works for you
			return true;
		}

		function textStyle() {
			return {font: "9pt  Segoe UI,sans-serif", stroke: "#fff"};
		}

		function nodeDoubleClick(e, obj) {
			// var clicked = obj.part;
			// if (clicked !== null) {
			//     var thisemp = clicked.data;
			//     myDiagram.startTransaction("add employee");
			//     var newemp = {key: getNextKey(), name: "(new person)", title: "", parent: thisemp.key};
			//     myDiagram.model.addNodeData(newemp);
			//     myDiagram.commitTransaction("add employee");
			// }
		}

		function nodeInfo(d) {  // Tooltip info for a node data object
			var str = "Node " + d.key + ": " + d.text + "\n";
			if (d.group)
				str += "member of " + d.group;
			else
				str += "top-level node";
			return str;
		}

		// These nodes have text surrounded by a rounded rectangle
		// whose fill color is bound to the node data.
		// The user can drag a node by dragging its TextBlock label.
		// Dragging from the Shape will start drawing a new link.

		// define the Node template

		var levelColors = ["#37474F", "#546E7A", "#78909C", "#B0BEC5"];
		myDiagram.layout.commitNodes = function () {
			go.TreeLayout.prototype.commitNodes.call(myDiagram.layout);
			myDiagram.layout.network.vertexes.each(function (v) {
				if (v.node) {
					var level = v.level % (levelColors.length);
					var color = levelColors[level];
					var shape = v.node.findObject("SHAPE");
					console.log(v.node);
					if (shape) shape.fill = $(go.Brush, "Linear", {0: color, start: go.Spot.Left, end: go.Spot.Right});
				}
			});
		};


		myDiagram.nodeTemplate =
			$(go.Node, "Auto",
				{locationSpot: go.Spot.Center},
				new go.Binding("location", "loc").makeTwoWay(),
				{doubleClick: nodeDoubleClick},
				{ // handle dragging a Node onto a Node to (maybe) change the reporting relationship
					mouseDragEnter: function (e, node, prev) {
						var diagram = node.diagram;
						var selnode = diagram.selection.first();
						if (!mayWorkFor(selnode, node)) return;
						var shape = node.findObject("SHAPE");
						if (shape) {
							shape._prevFill = shape.fill;  // remember the original brush
							shape.fill = "darkred";
						}
					},
					mouseDragLeave: function (e, node, next) {
						var shape = node.findObject("SHAPE");
						if (shape && shape._prevFill) {
							shape.fill = shape._prevFill;  // restore the original brush
						}
					},
					mouseDrop: function (e, node) {
						var diagram = node.diagram;
						var selnode = diagram.selection.first();  // assume just one Node in selection
						if (mayWorkFor(selnode, node)) {
							// find any existing link into the selected node
							var link = selnode.findTreeParentLink();
							if (link !== null) {  // reconnect any existing link
								link.fromNode = node;
							} else {  // else create a new link
								diagram.toolManager.linkingTool.insertLink(node, node.port, selnode, selnode.port);
							}
						}
					}
				},
				// for sorting, have the Node.text be the data.name
				new go.Binding("text", "name"),
				// bind the Part.layerName to control the Node's layer depending on whether it isSelected
				new go.Binding("layerName", "isSelected", function (sel) {
					return sel ? "Foreground" : "";
				}).ofObject(),
				// define the node's outer shape
				$(go.Shape, "Rectangle",
					{
						name: "SHAPE", fill: "orange", stroke: null,
						// set the port properties:
						portId: "", cursor: "pointer",
						fromLinkable: true, fromLinkableDuplicates: false, toLinkable: true, toLinkableDuplicates: false

					}),
				$(go.Panel, "Horizontal",

					$(go.Picture,
						{
							name: "Picture",
							desiredSize: new go.Size(39, 50),
							margin: new go.Margin(6, 8, 6, 10),
						},
						new go.Binding("source", "img")),
					// define the panel where the text will appear
					$(go.Panel, "Table",
						{
							maxSize: new go.Size(150, 999),
							margin: new go.Margin(6, 10, 0, 3),
							defaultAlignment: go.Spot.Left
						},
						$(go.RowColumnDefinition, {column: 2, width: 4}),
						$(go.TextBlock, textStyle(),  // the name
							{
								row: 0, column: 0, columnSpan: 5,
								font: "12pt Segoe UI,sans-serif",
								editable: true, isMultiline: false,
								minSize: new go.Size(10, 16)
							},
							new go.Binding("text", "name").makeTwoWay()),
						$(go.TextBlock, "", textStyle(),
							{row: 1, column: 0}),
						$(go.TextBlock, textStyle(),
							{
								row: 1, column: 1, columnSpan: 4,
								editable: true, isMultiline: false,
								minSize: new go.Size(10, 14),
								margin: new go.Margin(0, 0, 0, 3)
							},
							new go.Binding("text", "text").makeTwoWay()),
						$(go.TextBlock, textStyle(),
							{row: 2, column: 0},
						),
						$(go.TextBlock, textStyle(),
							{name: "boss", row: 2, column: 3,}, // we include a name so we can access this TextBlock when deleting Nodes/Links
							new go.Binding("text", "parent", function (v) {
								return "Boss: " + v;
							})),
						$(go.TextBlock, textStyle(),  // the comments
							{
								row: 3, column: 0, columnSpan: 5,
								font: "italic 9pt sans-serif",
								wrap: go.TextBlock.WrapFit,
								editable: true,  // by default newlines are allowed
								minSize: new go.Size(10, 14)
							},
							new go.Binding("text", "comments").makeTwoWay())
					)  // end Table Panel
				) // end Horizontal Panel
			);  // end Node


		myDiagram.allowMove = false;

		// Define the appearance and behavior for Links:

		function linkInfo(d) {  // Tooltip info for a link data object
			return "Link:\nfrom " + d.from + " to " + d.to;
		}

		// The link shape and arrowhead have their stroke brush data bound to the "color" property
		myDiagram.linkTemplate =
			$(go.Link,
				{toShortLength: 3, relinkableFrom: true, relinkableTo: true},  // allow the user to relink existing links
				$(go.Shape,
					{strokeWidth: 2},
					new go.Binding("stroke", "color")),
				$(go.Shape,
					{toArrow: "Standard", stroke: null},
					new go.Binding("fill", "color")),
				{ // this tooltip Adornment is shared by all links
					toolTip:
						$(go.Adornment, "Auto",
							$(go.Shape, {fill: "#FFFFCC"}),
							$(go.TextBlock, {margin: 4},  // the tooltip shows the result of calling linkInfo(data)
								new go.Binding("text", "", linkInfo))
						),
					// the same context menu Adornment is shared by all links
					contextMenu: partContextMenu
				}
			);

		// Define the appearance and behavior for Groups:


		function findHeadShot(key) {
			// if (key < 0 || key > 16) return "https://vignette.wikia.nocookie.net/tumblr-survivor-athena/images/7/7a/Blank_Avatar.png/revision/latest?cb=20161204161729";
			// return "https://vignette.wikia.nocookie.net/tumblr-survivor-athena/images/7/7a/Blank_Avatar.png/revision/latest?cb=20161204161729.png"
		}

		function groupInfo(adornment) {  // takes the tooltip or context menu, not a group node data object
			var g = adornment.adornedPart;  // get the Group that the tooltip adorns
			var mems = g.memberParts.count;
			var links = 0;
			g.memberParts.each(function (part) {
				if (part instanceof go.Link) links++;
			});
			return "Group " + g.data.key + ": " + g.data.text + "\n" + mems + " members including " + links + " links";
		}

		// Groups consist of a title in the color given by the group node data
		// above a translucent gray rectangle surrounding the member parts
		myDiagram.groupTemplate =
			$(go.Group, "Vertical",
				{
					selectionObjectName: "PANEL",  // selection handle goes around shape, not label
					ungroupable: true
				},  // enable Ctrl-Shift-G to ungroup a selected Group
				$(go.TextBlock,
					{
						font: "bold 19px sans-serif",
						isMultiline: false,  // don't allow newlines in text
						editable: true  // allow in-place editing by user
					},
					new go.Binding("text", "text").makeTwoWay(),
					new go.Binding("stroke", "color")),
				$(go.Panel, "Horizontal",
					{name: "PANEL"},

					$(go.Picture,
						{maxSize: new go.Size(50, 50)},
						{width: 55, height: 55},
						new go.Binding("source", "img")),
					$(go.Placeholder, {margin: 10, background: "transparent"})  // represents where the members are
				),
				{ // this tooltip Adornment is shared by all groups
					toolTip:
						$(go.Adornment, "Auto",
							$(go.Shape, {fill: "#ff0900"}),
							$(go.TextBlock, {margin: 4},
								// bind to tooltip, not to Group.data, to allow access to Group properties
								new go.Binding("text", "", groupInfo).ofObject())
						),
					// the same context menu Adornment is shared by all groups
					contextMenu: partContextMenu
				}
			);

		// Define the behavior for the Diagram background:

		function diagramInfo(model) {  // Tooltip info for the diagram's model
			return "Model:\n" + model.nodeDataArray.length + " nodes, " + model.linkDataArray.length + " links";
		}


		// provide a tooltip for the background of the Diagram, when not over any Part
		myDiagram.toolTip =
			$(go.Adornment, "Auto",
				$(go.Shape, {fill: "#FFFFCC"}),
				$(go.TextBlock, {margin: 4},
					new go.Binding("text", "", diagramInfo))
			);

		// provide a context menu for the background of the Diagram, when not over any Part
		myDiagram.contextMenu =
			$(go.Adornment, "Vertical",
				makeButton("Paste",
					function (e, obj) {
						e.diagram.commandHandler.pasteSelection(e.diagram.lastInput.documentPoint);
					},
					function (o) {
						return o.diagram.commandHandler.canPasteSelection();
					}),
				makeButton("Undo",
					function (e, obj) {
						e.diagram.commandHandler.undo();
					},
					function (o) {
						return o.diagram.commandHandler.canUndo();
					}),
				makeButton("Redo",
					function (e, obj) {
						e.diagram.commandHandler.redo();
					},
					function (o) {
						return o.diagram.commandHandler.canRedo();
					})
			);


		// Create the Diagram's Model:

		// var nodeDataArray = [
		// 	{key: 'c1', text: "Alpha"},
		// 	{
		// 		key: 'd2',
		// 		text: "Beta",
		// 		img: "https://banner2.kisspng.com/20171201/dcb/superman-logo-png-hd-5a219b596c0785.5547984215121518974425.jpg"
		// 	},
		// 	{key: '3', text: "Gamma"},
		// 	{key: '4', text: "fff"},
		// 	{key: '5', text: "sdfsdf df"},
		// 	{key: '6', text: "sdfsdf df"},
		// 	{key: '7', text: "sdfsdf df"}
		// ];
		//
		//
		// var linkDataArray = [
		// 	{from: 'c1', to: 'd2'},
		// 	{from: 'c1', to: 3},
		// 	{from: 'd2', to: 4},
		// 	{from: 'd2', to: 5},
		// 	{from: 3, to: 6},
		// 	{from: 3, to: 7},
		// 	{from: 3, to: 5}
		// ];


		var nodeDataArray = <?=$structure?>;
		var linkDataArray = <?=$from_to?>;

		myDiagram.model = new go.GraphLinksModel(nodeDataArray, linkDataArray);

	}


	$(document).ready(function () {
		init();

	})

	function save() {
		document.getElementById("mySavedModel").value = myDiagram.model.toJson();
		myDiagram.isModified = false;
		console.log(myDiagram.model.linkDataArray);
	}

</script>

