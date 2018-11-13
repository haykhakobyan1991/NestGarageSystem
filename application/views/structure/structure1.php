<!-- Structure Start -->
<style>
	canvas {
		background: #fff;
	}

	th, td {
		vertical-align: middle !important;
		text-align: center !important;
	}

	table td {
		padding: 5px !important
	}

	th {
		border: 1px solid #333 !important;
	}

	i.fa.fa-plus, i.fa.fa-minus {
		display: inline-block;
		float: right;
		vertical-align: middle;
		cursor: pointer;
		font-size: 12px;
	}

	.more {
		display: none;
	}
</style>
<script src="<?= base_url('assets/js/go.js') ?>"></script>
<div class="jumbotron jumbotron-fluid pb-2 pt-2">
	<div id="sample">
		<div id="myDiagramDiv" style="height:300px"></div>
	</div>
	<textarea style="display: none; width: 100%;" id="mySavedModel"></textarea>
	<button id="SaveButton" onclick="save()">Save</button>
	<script src="chrome-extension://gppongmhjkpfnbhagpmjfkannfbllamg/js/inject.js"></script>
</div>

<div class="row mt-3">
	<div class="container-fluid">
		<ul class="nav justify-content-center navbar navbar-light" style="background-color: #d6d8db;">
			<li class="nav-item">
				<a class="nav-link active" href="#">ՏԵԽ ԶՆՆՈՒՄ</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">ՎԱՌԵԼԻՔ</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">ՏՈՒԳԱՆՔ</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">ՊԱՏԱՀԱՐՆԵՐ</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">ԱՊԱՀՈՎԱԳՐՈՒԹՅՈՒՆ</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">ՊԱՀԵՍՏԱՄԱՍԵՐ</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">ՎԵՐԱՆՈՐՈԳՈՒՄ</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">ԱՆՎԱԴՈՂ</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">ԱՐԳԵԼԱԿ</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">ՔՍՈՒՔ</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">ՖԻԼՏՐ</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">ՄԱՐՏԿՈՑ</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Ահազանգ</a>
			</li>
		</ul>
	</div>
</div>

<hr class="my-4">

<!--<div class="row mt-3">-->
<!--	<div class="container-fluid">-->
<!--		<table class="table table-borderless">-->
<!--			<thead class="d-none">-->
<!---->
<!--			<tr>-->
<!--				<th class="table-secondary" scope="col" rowspan="2">Ն։</th>-->
<!--				<th class="table-secondary" scope="col" rowspan="2">երբ</th>-->
<!--				<th class="table-secondary text-center" scope="col" colspan="4">Տրանսպորտային միջոց</th>-->
<!--				<th class="table-secondary" scope="col" rowspan="2">ծաղսի տեսակ</th>-->
<!--				<th class="table-secondary" scope="col" rowspan="2">գումար</th>-->
<!--				<th class="table-secondary" scope="col" rowspan="2"><i class="fas fa-info-circle"></i></th>-->
<!--			</tr>-->
<!---->
<!--			<tr>-->
<!--				<th class="table-primary">մոդել</th>-->
<!--				<th class="table-primary">տեսակ</th>-->
<!--				<th class="table-primary">պետհամարանիշ</th>-->
<!--				<th class="table-primary">վարորդ</th>-->
<!--			</tr>-->
<!---->
<!--			</thead>-->
<!--			<tbody class="cars_table"></tbody>-->
<!--		</table>-->
<!--	</div>-->
<!--</div>-->

<script>
	function init() {
		if (window.goSamples) goSamples();
		var $ = go.GraphObject.make;
		myDiagram =
			$(go.Diagram, "myDiagramDiv",
				{
					initialContentAlignment: go.Spot.Center,
					"commandHandler.archetypeGroupData": {text: "Group", isGroup: true, color: "blue"},
					layout:
						$(go.TreeLayout,
							{
								treeStyle: go.TreeLayout.StyleLastParents,
								arrangement: go.TreeLayout.ArrangementHorizontal,
								angle: 90,
								alternateAngle: 90,
								alternateLayerSpacing: 35,
								alternateNodeSpacing: 20
							}),
				});

		function makeButton(text, action, visiblePredicate) {
			return $("ContextMenuButton",
				$(go.TextBlock, text),
				{click: action},
				visiblePredicate ? new go.Binding("visible", "", function (o, e) {
					return o.diagram ? visiblePredicate(o, e) : false;
				}).ofObject() : {});
		}

		var partContextMenu =
			$(go.Adornment, "Vertical",
				makeButton("Properties",
					function (e, obj) {
						var contextmenu = obj.part;
						var part = contextmenu.adornedPart;
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
			if (!(node1 instanceof go.Node)) return false;
			if (node1 === node2) return false;
			if (node2.isInTreeOf(node1)) return false;
			return true;
		}

		function textStyle() {
			return {font: "9pt  Segoe UI,sans-serif", stroke: "#fff"};
		}

		function nodeDoubleClick(e, obj) {
		}

		function nodeInfo(d) {
			var str = "Node " + d.key + ": " + d.text + "\n";
			if (d.group)
				str += "member of " + d.group;
			else
				str += "top-level node";
			// return str;
		}

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
				{
					mouseDragEnter: function (e, node, prev) {
						var diagram = node.diagram;
						var selnode = diagram.selection.first();
						if (!mayWorkFor(selnode, node)) return;
						var shape = node.findObject("SHAPE");
						if (shape) {
							shape._prevFill = shape.fill;
							shape.fill = "darkred";
						}
					},
					height: 35,
					mouseDragLeave: function (e, node, next) {
						var shape = node.findObject("SHAPE");
						if (shape && shape._prevFill) {
							shape.fill = shape._prevFill;
						}
					},
					mouseDrop: function (e, node) {
						var diagram = node.diagram;
						var selnode = diagram.selection.first();
						if (mayWorkFor(selnode, node)) {
							var link = selnode.findTreeParentLink();
							if (link !== null) {
								link.fromNode = node;
							} else {
								diagram.toolManager.linkingTool.insertLink(node, node.port, selnode, selnode.port);
							}
						}
					}
				},
				new go.Binding("text", "name"),
				new go.Binding("layerName", "isSelected", function (sel) {
					return sel ? "Foreground" : "";
				}).ofObject(),
				$(go.Shape, "Rectangle",
					{
						name: "SHAPE", fill: "orange", stroke: null,
						portId: "", cursor: "pointer",
						fromLinkable: true, fromLinkableDuplicates: false, toLinkable: true, toLinkableDuplicates: false
					}),
				$(go.Panel, "Horizontal",
					$(go.Picture,
						{
							name: "Picture",
							desiredSize: new go.Size(25, 25),
							margin: new go.Margin(2, 2, 0, 2),
						},
						new go.Binding("source", "img")),
					$(go.Panel, "Table",
						{
							maxSize: new go.Size(100, 999),
							margin: new go.Margin(2,2, 0, 1),
							defaultAlignment: go.Spot.Left
						},
						$(go.RowColumnDefinition, {column: 2, width: 4}),
						$(go.TextBlock, textStyle(),
							{
								row: 0, column: 0, columnSpan: 2,
								font: "10pt Segoe UI,sans-serif",
								editable: true, isMultiline: false,
								minSize: new go.Size(8, 14)
							},
							new go.Binding("text", "name").makeTwoWay()),
						$(go.TextBlock, "", textStyle(),
							{row: 1, column: 0}),
						$(go.TextBlock, textStyle(),
							{
								row: 1, column: 1, columnSpan: 4,
								editable: false, isMultiline: false,
								minSize: new go.Size(10, 14),
								margin: new go.Margin(1, 1, 0, 3)
							},
							new go.Binding("text", "text").makeTwoWay()),
						$(go.TextBlock, textStyle(),
							{row: 2, column: 0},
						),
						$(go.TextBlock, textStyle(),
							{name: "boss", row: 2, column: 3,},
							new go.Binding("text", "parent", function (v) {
								return "Boss: " + v;
							})),
						$(go.TextBlock, textStyle(),
							{
								row: 3, column: 0, columnSpan: 5,
								font: "italic 9pt sans-serif",
								wrap: go.TextBlock.WrapFit,
								editable: true,
								minSize: new go.Size(10, 14)
							},
							new go.Binding("text", "comments").makeTwoWay())
					)
				)
			);
		myDiagram.allowMove = false;

		function linkInfo(d) {
			return "Link:\nfrom " + d.from + " to " + d.to;
		}

		myDiagram.linkTemplate =
			$(go.Link,
				{toShortLength: 3, relinkableFrom: true, relinkableTo: true},
				$(go.Shape,
					{strokeWidth: 2},
					new go.Binding("stroke", "color")),
				$(go.Shape,
					{toArrow: "Standard", stroke: null},
					new go.Binding("fill", "color")),
				{
					toolTip:
						$(go.Adornment, "Auto",
							$(go.Shape, {fill: "#FFFFCC"}),
							$(go.TextBlock, {margin: 2},
								new go.Binding("text", "", linkInfo))
						),
					contextMenu: partContextMenu
				}
			);

		function findHeadShot(key) {
		}

		function groupInfo(adornment) {
			var g = adornment.adornedPart;
			var mems = g.memberParts.count;
			var links = 0;
			g.memberParts.each(function (part) {
				if (part instanceof go.Link) links++;
			});
			// return "Group " + g.data.key + ": " + g.data.text + "\n" + mems + " members including " + links + " links";
		}

		myDiagram.groupTemplate =
			$(go.Group, "Vertical",
				{
					selectionObjectName: "PANEL",
					ungroupable: true
				},
				$(go.TextBlock,
					{
						font: "bold 19px sans-serif",
						isMultiline: false,
						editable: true
					},
					new go.Binding("text", "text").makeTwoWay(),
					new go.Binding("stroke", "color")),
				$(go.Panel, "Horizontal",
					{name: "PANEL"},
					$(go.Picture,
						{row: 1, column: 2},
						{width: 25, height: 25},
						new go.Binding("source", "img")),
					$(go.Placeholder, {margin: 2, background: "transparent"})
				),
				{
					toolTip:
						$(go.Adornment, "Auto",
							$(go.Shape, {fill: "#ff0900"}),
							$(go.TextBlock, {margin: 2},
								new go.Binding("text", "", groupInfo).ofObject())
						),
					contextMenu: partContextMenu
				}
			);

		function diagramInfo(model) {
			return "Model:\n" + model.nodeDataArray.length + " nodes, " + model.linkDataArray.length + " links";
		}

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
		var nodeDataArray = <?=$structure?>;
		var linkDataArray = <?=$from_to?>;
		myDiagram.model = new go.GraphLinksModel(nodeDataArray, linkDataArray);
	}

	$(document).ready(function () {
		init();
		myDiagram.addDiagramListener("ObjectSingleClicked",
			function (e) {
				var arr = [];
				var new_arr = [];
				myDiagram.selection.each(function (part) {
					if (part instanceof go.Node) {
						arr = {
							"key": part.Wd.key,
							"name": part.Wd.text,
							"parent": part.Wd.parent
						};
						// console.log(arr.key);
						var str1 = arr.key;
						var re1 = 'f';
						var found1 = str1.match(re1);
						if (found1 == 'f') {
							new_arr.push(arr);
						}
					}
				});
				// console.log(new_arr);
				// var new_row = '';
				// var str = new_arr[new_arr.length - 1].key;
				// console.log('str -->' + str);
				// var re = 'f';
				// var found = str.match(re);
				// if (found == 'f') {
				// 	$('thead').removeClass('d-none');
				// 	// $.each(new_arr, function (key, value) {
				// 	// 	new_row += '<tr>\n' +
				// 	// 					'<td scope="row">1<i class="fa fa-plus expand_tr mt-1" data-value="' + value['key'] + '"></i></td>\n' +
				// 	// 					'<td>18.12.2018</td>\n' +
				// 	// 					'<td>' + value['name'] + '</td>\n' +
				// 	// 					'<td>Հեչբեկ</td>\n' +
				// 	// 					'<td>35sx674</td>\n' +
				// 	// 					'<td>Արամ</td>\n' +
				// 	// 					'<td></td>\n' +
				// 	// 					'<td>150000</td>\n' +
				// 	// 					'<td>\n' +
				// 	// 					'<a href="#">\n' +
				// 	// 					'<i style="color:rgb(255,122,89);" class="fas fa-info-circle" data-toggle="tooltip" data-placement="top" title="մանրամասն"></i>\n' +
				// 	// 					'</a>\n' +
				// 	// 					'</td>\n' +
				// 	// 				'</tr>\n' +
				// 	//
				// 	// 		'<tr class="more table-dark" data-value="' + value['key'] + '">\n' +
				// 	// 			'<td class="pl-4" scope="row">1․1</td>\n' +
				// 	// 			'<td colspan="5"></td>\n' +
				// 	// 			'<td style="color: #333;">Յուղ</td>\n' +
				// 	// 			'<td class="pr-4" >125000</td>\n' +
				// 	// 		'</tr>\n' +
				// 	//
				// 	// 		'<tr class="more table-dark" data-value="' + value['key'] + '">\n' +
				// 	// 			'<td class="pl-4" scope="row">1.2</td>\n' +
				// 	// 			'<td colspan="5"></td>\n' +
				// 	// 			'<td style="color: #333;">Անվադող</td>\n' +
				// 	// 			'<td class="pr-4" >25000</td>\n' +
				// 	// 		'</tr>'
				// 	// });
				// 	$('.cars_table').html(new_row);
				// }
				// $('[data-toggle="tooltip"]').tooltip();
			});
	});

	function save() {
		document.getElementById("mySavedModel").value = myDiagram.model.toJson();
		myDiagram.isModified = false;
		console.log(myDiagram.model.linkDataArray);
	}

	$(document).on('click', '.expand_tr', function () {
		if ($(this).hasClass('fa-plus')) {
			$(this).removeClass('fa-plus');
			$(this).addClass('fa-minus');
		} else {
			$(this).addClass('fa-plus');
			$(this).removeClass('fa-minus');
		}

		var btn_value = $(this).data('value');
		$('.more[data-value=' + btn_value + ']').toggle('slow');
	});
</script>
