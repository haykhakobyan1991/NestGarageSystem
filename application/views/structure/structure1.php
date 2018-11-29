<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
<script src="<?= base_url() ?>assets/js/table.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/structure1.css"/>
<!-- Structure Start -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<!--[if lt IE 9]>
<script src="https://code.highcharts.com/modules/oldie.js"></script>
<![endif]-->
<script>
	// $(document).ready(function () {
	// 	for (i = 1; i < 14; i++) {
	// 		$('#ex_' + i + '').DataTable();
	// 		$('#ex_' + i + '_wrapper').append('<i class="add_new_tr fa fa-plus ml-1 mr-1 float-right" style="position:absolute;left:250px;bottom:12px;" data-id="ex_' + i + '"> </i>');
	// 		$('#ex_' + i + '_wrapper').append('<button name="" class="btn btn-sm btn-success ml-1 mr-1 float-right" style="left:285px;position:absolute;bottom:13px;">Save</button>');
	// 	}
	// })
</script>

<style>
	.row.bg-secondary {
		min-height: 194px;
	}

	.modal {
		top: 30% !important;
	}
</style>
<script src="<?= base_url('assets/js/go.js') ?>"></script>
<script src="https://gojs.net/latest/extensions/Robot.js"></script>

<!--  Modal Start -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-secondary" id="exampleModalLabel">Changes</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="result" class="modal-body">
				<div class="alert alert-info">
					<img style="height: 20px;margin: 0 auto;display: block;text-align: center;"
						 src="<?= base_url() ?>assets/images/load.svg"/>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="save_changes" class="btn btn-outline-success" onclick="save('1')">Save
					changes
				</button>
				<button type="button" class="btn btn-outline-danger " data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!--  Modal End -->

<div class="content m-1">
	<div class="content m-1">
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
			<a class="info-type nav-item nav-link nav_a mr-2 btn btn-sm btn-outline-success2 showed <?= $this->uri->segment(3) == '' ? 'active show' : '' ?> "
			   data-id="1"
			   href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/structure1') ?>"
			   role="tab">
				<i class="fas fa-info"></i> Ինֆորմացիա
			</a>
			<a class="info-type nav-item nav-link nav_a mr-2 btn btn-sm btn-outline-success2 showed  <?= $this->uri->segment(3) != '' ? 'active show' : '' ?> "
			   data-id="2"
			   href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/structure1/add_expenses') ?>"
			   role="tab">
				<i class="fas fa-plus"></i> Ավելացնել ծախսեր
			</a>
			<a class="info-type nav-item nav-link nav_a mr-2  btn btn-sm btn-outline-success2 showed"
			   data-id="3"
			   data-toggle=""
			   href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/fleet_history') ?>"
			   role="tab">
				<i class="fas fa-clipboard-list"></i> Ծաղսերի պատմություն
			</a>
		</div>
	</div>

	<div class="jumbotron jumbotron-fluid pb-2 pt-2 mb-0 text-right bg-white ">
		<div id="sample">
			<div id="myDiagramDiv" style="height:300px"></div>
		</div>
		<textarea class="d-none" id="mySavedModel" title=""> </textarea>
		<script src="chrome-extension://gppongmhjkpfnbhagpmjfkannfbllamg/js/inject.js"></script>

		<button name=""
				data-toggle="modal"
				data-target=".bd-example-modal-lg"
				class="btn btn-sm btn-outline-secondary mt-1"
				id="SaveButton"
				style="margin-top: -48px !important; z-index: 999; position: relative; margin-right: 15px;"
				onclick="save('-1')">Save
		</button>
	</div>

	<span class="selectted_information "></span>

</div>


<div id="add-info" style="<?= $this->uri->segment(3) == '' ? 'display: none' : '' ?>">
	<nav class="mt-2">
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
			<a class="nav-item nav-link tab_nav "
			   data-tab="1" id="nav-1-tab"
			   data-toggle="tab"
			   href="#nav-1"
			   role="tab"
			   aria-controls="nav-1"
			   aria-selected="true">ՏԵԽ ԶՆՆՈՒՄ</a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="2" id="nav-2-tab"
			   data-toggle="tab"
			   href="#nav-2"
			   role="tab"
			   aria-controls="nav-2"
			   aria-selected="false">ՎԱՌԵԼԻՔ</a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="3" id="nav-3-tab"
			   data-toggle="tab"
			   href="#nav-3"
			   aria-controls="nav-3"
			   aria-selected="false">ՏՈՒԳԱՆՔ</a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="4" id="nav-4-tab"
			   data-toggle="tab"
			   href="#nav-4"
			   aria-controls="nav-4"
			   aria-selected="false">ՊԱՏԱՀԱՐՆԵՐ</a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="5" id="nav-5-tab"
			   data-toggle="tab"
			   href="#nav-5"
			   role="tab"
			   aria-controls="nav-5"
			   aria-selected="false">ԱՊԱՀՈՎԱԳՐՈՒԹՅՈՒՆ</a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="6" id="nav-6-tab"
			   data-toggle="tab"
			   href="#nav-6"
			   role="tab"
			   aria-controls="nav-6"
			   aria-selected="false">ՊԱՀԵՍՏԱՄԱՍԵՐ</a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="7" id="nav-7-tab"
			   data-toggle="tab"
			   href="#nav-7"
			   role="tab"
			   aria-controls="nav-7"
			   aria-selected="false">ՎԵՐԱՆՈՐՈԳՈՒՄ</a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="8" id="nav-8-tab"
			   data-toggle="tab"
			   href="#nav-8"
			   role="tab"
			   aria-controls="nav-8"
			   aria-selected="false">ԱՆՎԱԴՈՂ</a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="9" id="nav-9-tab"
			   data-toggle="tab"
			   href="#nav-9"
			   role="tab"
			   aria-controls="nav-9"
			   aria-selected="false">ԱՐԳԵԼԱԿ</a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="10" id="nav-10-tab"
			   data-toggle="tab"
			   href="#nav-10"
			   role="tab"
			   aria-controls="nav-10"
			   aria-selected="false">ՔՍՈՒՔ</a>

			<a class="nav-item nav-link" id="nav-11-tab" data-toggle="tab" href="#nav-11" role="tab"
			   aria-controls="nav-11"
			   aria-selected="false">ՖԻԼՏՐ</a>
			<a class="nav-item nav-link" id="nav-12-tab" data-toggle="tab" href="#nav-12" role="tab"
			   aria-controls="nav-12"
			   aria-selected="false">ՄԱՐՏԿՈՑ</a>


			<a class="nav-item nav-link" id="nav-13-tab" data-toggle="tab" href="#nav-13" role="tab"
			   aria-controls="nav-13"
			   aria-selected="false">ԱՀԱԶԱՆԳ</a>
		</div>
	</nav>


	<div class="tab-content" id="nav-tabContent">

		<div class="tab-pane fade" data-tab="1" id="nav-1" role="tabpanel" aria-labelledby="nav-1-tab">

		</div>

		<div class="tab-pane fade" data-tab="2" id="nav-2" role="tabpanel" aria-labelledby="nav-2-tab">

		</div>

		<div class="tab-pane fade" data-tab="3" id="nav-3" role="tabpanel" aria-labelledby="nav-3-tab">

		</div>

		<div class="tab-pane fade" data-tab="4" id="nav-4" role="tabpanel" aria-labelledby="nav-4-tab">

		</div>

		<div class="tab-pane fade" data-tab="5" id="nav-5" role="tabpanel" aria-labelledby="nav-5-tab">

		</div>

		<div class="tab-pane fade" data-tab="6" id="nav-6" role="tabpanel" aria-labelledby="nav-6-tab">

		</div>

		<div class="tab-pane fade" data-tab="7" id="nav-7" role="tabpanel" aria-labelledby="nav-7-tab">

		</div>

		<div class="tab-pane fade" data-tab="8" id="nav-8" role="tabpanel" aria-labelledby="nav-8-tab">

		</div>

		<div class="tab-pane fade" data-tab="9" id="nav-9" role="tabpanel" aria-labelledby="nav-9-tab">

		</div>

		<div class="tab-pane fade" data-tab="10" id="nav-10" role="tabpanel" aria-labelledby="nav-10-tab">

		</div>

		<div class="tab-pane fade" id="nav-11" role="tabpanel" aria-labelledby="nav-11-tab">
			<div class="row col-sm-12 col-md-12 bpp_o">
				<div class="container-fluid">
					<table id="ex_11" class="table table-striped table-borderless w-100">
						<thead class="thead_tables">
						<tr>
							<th class="table_th">ID</th>
							<th class="table_th">Երբ</th>
							<th class="table_th">Որտեղից</th>
							<th class="table_th">Արտադրող</th>
							<th class="table_th">Մոդել</th>
							<th class="table_th">Տեսակ</th>
							<th class="table_th">Այլ Ինֆորմացիա</th>
							<th class="table_th">Քանակ</th>
							<th class="table_th">միավորի արժեք</th>
							<th class="table_th">Ամբողջ</th>
							<th class="table_th"><i class="fa fa-trash"> </i></th>
						</tr>
						</thead>
						<tbody class="ex_11"></tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="nav-12" role="tabpanel" aria-labelledby="nav-12-tab">
			<div class="row col-sm-12 col-md-12 bpp_o">
				<div class="container-fluid">
					<table id="ex_12" class="table table-striped table-borderless w-100">
						<thead class="thead_tables">
						<tr>
							<th class="table_th">ID</th>
							<th class="table_th">Երբ</th>
							<th class="table_th">Որտեղից</th>
							<th class="table_th">Արտադրող</th>
							<th class="table_th">Մոդել</th>
							<th class="table_th">Այլ Ինֆորմացիա</th>
							<th class="table_th">Քանակ</th>
							<th class="table_th">միավորի արժեք</th>
							<th class="table_th">Ամբողջ</th>
							<th class="table_th"><i class="fa fa-trash"> </i></th>
						</tr>
						</thead>
						<tbody class="ex_12"></tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="nav-13" role="tabpanel" aria-labelledby="nav-13-tab">
			<div class="row col-sm-12 col-md-12 bpp_o">
				<div class="container-fluid">
					<table id="ex_13" class="table table-striped table-borderless w-100">
						<thead class="thead_tables">
						<tr>
							<th class="table_th">ID</th>
							<th class="table_th">Service</th>
							<th class="table_th">Service frequency</th>
							<th class="table_th">Last performed</th>
							<th class="table_th">Last Performed at (meter)</th>
							<th class="table_th">Next services</th>
							<th class="table_th">To go</th>
							<th class="table_th">Create reminder</th>
							<th class="table_th"><i class="fa fa-trash"> </i></th>
						</tr>
						</thead>
						<tbody class="ex_13"></tbody>
					</table>
				</div>
			</div>
		</div>

	</div>

</div>


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
					makeButton("deletee",
						function (e, obj) {
							e.diagram.commandHandler.deleteeSelection();
						},
						function (o) {
							return o.diagram.commandHandler.candeleteeSelection();
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
				return {
					font: "9px  Segoe UI,sans-serif",
					stroke: "#fff"
				};
			}

			function nodeDoubleClick(e, obj) {
			}

			function nodeInfo(d) {
				var str = "Node " + d.key + ": " + d.text + "\n";
			}

			var levelColors = ["#37474F", "#546E7A", "#78909C", "#B0BEC5"];
			myDiagram.layout.commitNodes = function () {
				go.TreeLayout.prototype.commitNodes.call(myDiagram.layout);
				myDiagram.layout.network.vertexes.each(function (v) {
					if (v.node) {
						level = v.level % (levelColors.length);
						color = levelColors[level];
						shape = v.node.findObject("SHAPE");


						if (shape) shape.fill = $(go.Brush, "Linear", {
							0: color,
							start: go.Spot.Left,
							end: go.Spot.Right
						});
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


					$(go.Shape, "Rectangle", {
							name: "SHAPE",
							stroke: null,
							portId: "",
							cursor: "pointer",
							fromLinkableDuplicates: true,
							toLinkableDuplicates: true
						},
						new go.Binding("fill", "isHighlighted", function (h) {
							return h ? "#ff7a59" : color;
						}).ofObject(),
						new go.Binding("fromLinkable", "from"),
						new go.Binding("toLinkable", "to"),
						new go.Binding("fromLinkable", "fromDepartment"),
						new go.Binding("toLinkable", "toStaff"),
					),

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
								margin: new go.Margin(2, 2, 0, 1),
								defaultAlignment: go.Spot.Left
							},
							$(go.RowColumnDefinition, {column: 2, width: 4}),
							$(go.TextBlock, textStyle(),
								{
									row: 0,
									column: 0,
									columnSpan: 2,
									font: "9px Segoe UI,sans-serif",
									editable: false,
									isMultiline: false,
									minSize: new go.Size(8, 14)
								},
								new go.Binding("text", "name").makeTwoWay()),
							$(go.TextBlock, "", textStyle(),
								{row: 1, column: 0}),
							$(go.TextBlock, textStyle(),
								{
									row: 1,
									column: 1,
									columnSpan: 4,
									editable: false,
									isMultiline: false,
									minSize: new go.Size(10, 14),
									margin: new go.Margin(1, 1, 0, 3)
								},
								new go.Binding("text", "text").makeTwoWay()),
							$(go.TextBlock, textStyle(),
								{row: 2, column: 0},
							),
							$(go.TextBlock, textStyle(),
								{
									name: "boss",
									row: 2,
									column: 3,
								},
								new go.Binding("text", "parent", function (v) {
									return "Boss: " + v;
								})),
							$(go.TextBlock, textStyle(),
								{
									row: 3,
									column: 0,
									columnSpan: 5,
									font: "italic 9px sans-serif",
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
				var links = 0;
				g.memberParts.each(function (part) {
					if (part instanceof go.Link) links++;
				});
			}

			myDiagram.groupTemplate =
				$(go.Group, "Vertical",
					{
						selectionObjectName: "PANEL",
						ungroupable: false
					},
					$(go.TextBlock,
						{
							font: "bold 9px sans-serif",
							isMultiline: false,
							editable: false
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
					)
				);


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
			robot = new Robot(myDiagram);


			function dragSelectNodes(dd) {
				var alpha = myDiagram.findNodeForKey(dd);
				if (alpha === null) return;

				alpha.isSelected = true;

			}

			var new_arr = [];
			myDiagram.addDiagramListener("ObjectSingleClicked",
				function (e) {


					var linkDataArray = <?=$from_to?>;
					$.each(linkDataArray, function (key, value) {
						// console.log(value.from + '----' +part.Wd.key);
						if (value.from == myDiagram.selection.Ca.key.Wd.key) {
							console.log(linkDataArray[key].to);
							dragSelectNodes(linkDataArray[key].to);

							$.each(linkDataArray, function (ky, val) {
								if (val.from == value.to) {
									dragSelectNodes(val.to);
									console.log(val.to);
								}
							})
						}

					});

					//	console.log(myDiagram.selection.Ca.key.Wd.key);

					var arr = [];
					new_arr = [];
					myDiagram.selection.each(function (part) {


						if (part instanceof go.Node) {
							arr = {
								"key": part.Wd.key,
								"name": part.Wd.text,
								"parent": part.Wd.parent
							};

							var str1 = arr.key;
							var re1 = 'f';
							var re2 = 'd';
							var found1 = str1.match(re1);
							var found2 = str1.match(re2);
							if (found1 == 'f' || found2 == 'd') {
								new_arr.push(arr);
							}
							// console.log(new_arr);
						}
					});


					if ($('a[data-id="1"]').hasClass('active')) {
						if (new_arr.length !== 0) {
							$('.selectted_information').html('<img style="z-index: 999; position: fixed; left: 50%; width: 10em" src="http://localhost/NestGarageSystem/assets/images/puff.svg">');
							var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/car_info')?>';
							$.post(url, {arr: new_arr}).done(function (data) {
								$('#add-info').fadeOut('slow');
								$('.selectted_information').html(data);
								$('#nav-tabContent-car').fadeIn('slow');
							});

							var data = $.parseJSON(new_arr);

							$(document).on('click', '#export', function () {
								$(document).excelexportjs({
									containerid: "dvjson",
									datatype: 'json',
									dataset: data,
									columns: getColumns(data)
								});
							})
						}
					} else if ($('a[data-id="2"]').hasClass('active')) {
						$('.selectted_information').html('');

						$('.tab_nav').each(function () {
							if ($(this).data('tab') == 1 && $(this).hasClass('active')) {
								vehicle_inspection(new_arr)
							} else if ($(this).data('tab') == 2 && $(this).hasClass('active')) {
								vehicle_fuel(new_arr)
							} else if ($(this).data('tab') == 3 && $(this).hasClass('active')) {
								vehicle_fine(new_arr)
							} else if ($(this).data('tab') == 4 && $(this).hasClass('active')) {
								vehicle_accident(new_arr)
							} else if ($(this).data('tab') == 5 && $(this).hasClass('active')) {
								vehicle_insurance(new_arr)
							} else if ($(this).data('tab') == 6 && $(this).hasClass('active')) {
								vehicle_spares(new_arr)
							} else if ($(this).data('tab') == 7 && $(this).hasClass('active')) {
								vehicle_repair(new_arr)
							} else if ($(this).data('tab') == 8 && $(this).hasClass('active')) {
								vehicle_wheel(new_arr)
							} else if ($(this).data('tab') == 9 && $(this).hasClass('active')) {
								vehicle_brake(new_arr)
							} else if ($(this).data('tab') == 10 && $(this).hasClass('active')) {
								vehicle_grease(new_arr)
							}
						});

					} else {
						$('.selectted_information').html('');
					}

					/*Remove BoxShadow From HighCharts Pie Diagram*/
					$('.highcharts-text-outline').attr('stroke', '');
				});


			$('.tab_nav').click(function () {
				if ($(this).data('tab') == 1) {
					vehicle_inspection(new_arr)
				} else if ($(this).data('tab') == 2) {
					vehicle_fuel(new_arr)
				} else if ($(this).data('tab') == 3) {
					vehicle_fine(new_arr)
				} else if ($(this).data('tab') == 4) {
					vehicle_accident(new_arr)
				} else if ($(this).data('tab') == 5) {
					vehicle_insurance(new_arr)
				} else if ($(this).data('tab') == 6) {
					vehicle_spares(new_arr)
				} else if ($(this).data('tab') == 7) {
					vehicle_repair(new_arr)
				} else if ($(this).data('tab') == 8) {
					vehicle_wheel(new_arr)
				} else if ($(this).data('tab') == 9) {
					vehicle_brake(new_arr)
				} else if ($(this).data('tab') == 10) {
					vehicle_grease(new_arr)
				}
			})

			//
			// $('.info-type').click(function () {
			//
			// 	$('.tab-pane').each(function(){
			// 		if($(this).data('tab') == 1) {
			// 			$(this).html('');
			// 		}
			//
			// 	});
			//
			// 	$('.nav-item').removeClass('active');
			//
			// 	if ($(this).data('id') == 2) {
			// 		$('#nav-tabContent-car').fadeOut();
			// 		$('#add-info').fadeIn('slow');
			// 	} else if ($(this).data('id') == 1) {
			// 		$('#add-info').fadeOut('slow');
			// 	}
			// });


		});

		// the Search functionality highlights all of the nodes that have at least one data property match a RegExp
		function searchDiagram() {  // called by button
			var input = document.getElementById("mySearch");
			if (!input) return;
			input.focus();

			myDiagram.startTransaction("highlight search");

			if (input.value) {
				// search four different data properties for the string, any of which may match for success
				// create a case insensitive RegExp from what the user typed
				var regex = new RegExp(input.value, "i");
				var results = myDiagram.findNodesByExample({text: regex});

				myDiagram.highlightCollection(results);
				// try to center the diagram at the first node that was found
				if (results.count > 0) myDiagram.centerRect(results.first().actualBounds);
			} else {  // empty string only clears highlighteds collection
				myDiagram.clearHighlighteds();
			}

			myDiagram.commitTransaction("highlight search");
		}


		//if value is -1 show, if value is 1 run query
		function save(value) {
			document.getElementById("mySavedModel").value = myDiagram.model.toJson();
			myDiagram.isModified = false;
			console.log(myDiagram.model.linkDataArray);
			var url = '<?=base_url('Structure/change_from_to_ax')?>';
			var data = myDiagram.model.linkDataArray;
			var old_data = '<?=$from_to?>';
			var structure = '<?=$structure?>';
			$.post(url, {data: data, old_data: old_data, structure: structure, value: value}).done(function (data) {
				console.log("Data Loaded: " + data);
				var return_data = JSON.parse(data);
				var res = '';
				if (return_data.error != '') {
					$('#result').html('<h2 class="text-center alert alert-danger">' + return_data.error + '</h2>');
				} else {
					if (value == '-1') {
						if (return_data.result != '') {
							$.each(return_data.result, function (index, val) {
								res += val
							});
							$('#result').html('<div class="alert alert-info">' + res + '</div>');
						} else {
							$('#save_changes').addClass('d-none');
							$('#result').html('<h2 class="text-center alert alert-info">Information is empty</h2>');
						}
					} else if (value == '1') {
						if (return_data.result) {
							location.reload();
						} else {
							$('#result').html('<h2 class="text-center alert alert-danger">' + return_data.error + '</h2>');
						}
					}
				}

			});
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
		// var ii = 1;
		//
		// $('.ex_1 tr').each(function () {
		// 	ii++;
		// });
		// $('.ex_2 tr').each(function () {
		// 	ii++;
		// });
		// $('.ex_3 tr').each(function () {
		// 	ii++;
		// });
		// $('.ex_4 tr').each(function () {
		// 	ii++;
		// });
		// $('.ex_5 tr').each(function () {
		// 	ii++;
		// });
		// $('.ex_6 tr').each(function () {
		// 	ii++;
		// });
		// $('.ex_7 tr').each(function () {
		// 	ii++;
		// });
		// $('.ex_8 tr').each(function () {
		// 	ii++;
		// });
		// $('.ex_9 tr').each(function () {
		// 	ii++;
		// });
		// $('.ex_10 tr').each(function () {
		// 	ii++;
		// });
		// $('.ex_11 tr').each(function () {
		// 	ii++;
		// });
		// $('.ex_12 tr').each(function () {
		// 	ii++;
		// });
		// $('.ex_13 tr').each(function () {
		// 	ii++;
		// });
		// $(document).on('click', '.add_new_tr', function () {
		// 	var dt_id = $(this).data('id');
		// 	if (dt_id == 'ex_2') {
		// 		$("td[valign='top']").parent('tr').remove();
		// 		$('.ex_2').append('<tr role="row">\n' +
		// 			'<td class="sorting_1"> ' + ii + '</td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row" > </i></td>\n' +
		// 			'</tr>');
		// 	}
		// 	if (dt_id == 'ex_3') {
		// 		$("td[valign='top']").parent('tr').remove();
		// 		$('.ex_3').append('<tr role="row">\n' +
		// 			'<td class="sorting_1"> ' + ii + '</td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"> </i></td>\n' +
		// 			'</tr>');
		// 	}
		// 	if (dt_id == 'ex_4') {
		// 		$("td[valign='top']").parent('tr').remove();
		// 		$('.ex_4').append('<tr role="row">\n' +
		// 			'<td class="sorting_1"> ' + ii + '</td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"> </i></td>\n' +
		// 			'</tr>');
		// 	}
		// 	if (dt_id == 'ex_5') {
		// 		$$("td[valign='top']").parent('tr').remove();
		// 		$('.ex_5').append('<tr role="row">\n' +
		// 			'<td class="sorting_1"> ' + ii + '</td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"> </i></td>\n' +
		// 			'</tr>');
		// 	}
		// 	if (dt_id == 'ex_6') {
		// 		$("td[valign='top']").parent('tr').remove();
		// 		$('.ex_6').append('<tr role="row">\n' +
		// 			'<td class="sorting_1"> ' + ii + '</td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"> </i></td>\n' +
		// 			'</tr>');
		// 	}
		// 	if (dt_id == 'ex_7') {
		// 		$("td[valign='top']").parent('tr').remove();
		// 		$('.ex_7').append('<tr role="row">\n' +
		// 			'<td class="sorting_1"> ' + ii + '</td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"> </i></td>\n' +
		// 			'</tr>');
		// 	}
		// 	if (dt_id == 'ex_8') {
		// 		$("td[valign='top']").parent('tr').remove();
		// 		$('.ex_8').append('<tr role="row">\n' +
		// 			'<td class="sorting_1"> ' + ii + '</td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"> </i></td>\n' +
		// 			'</tr>');
		// 	}
		// 	if (dt_id == 'ex_9') {
		// 		$("td[valign='top']").parent('tr').remove();
		// 		$('.ex_9').append('<tr role="row">\n' +
		// 			'<td class="sorting_1"> ' + ii + '</td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"> </i></td>\n' +
		// 			'</tr>');
		// 	}
		// 	if (dt_id == 'ex_10') {
		// 		$("td[valign='top']").parent('tr').remove();
		// 		$('.ex_10').append('<tr role="row">\n' +
		// 			'<td class="sorting_1"> ' + ii + '</td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"> </i></td>\n' +
		// 			'</tr>');
		// 	}
		// 	if (dt_id == 'ex_11') {
		// 		$("td[valign='top']").parent('tr').remove();
		// 		$('.ex_11').append('<tr role="row">\n' +
		// 			'<td class="sorting_1"> ' + ii + '</td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"> </i></td>\n' +
		// 			'</tr>');
		// 	}
		// 	if (dt_id == 'ex_12') {
		// 		$("td[valign='top']").parent('tr').remove();
		// 		$('.ex_12').append('<tr role="row">\n' +
		// 			'<td class="sorting_1"> ' + ii + '</td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"> </i></td>\n' +
		// 			'</tr>');
		// 	}
		// 	if (ex_13 == dt_id) {
		// 		$("td[valign='top']").parent('tr').remove();
		// 		$('.ex_13').append('<tr role="row">\n' +
		// 			'<td class="sorting_1"> ' + ii + '</td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><input title="" type="text" name="_' + ii + '" value="" class="in_row_input text-center"/></td>\n' +
		// 			'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"> </i></td>\n' +
		// 			'</tr>');
		// 	}
		// 	ii++;
		// 	$('.dataTables_wrapper.dt-bootstrap4.no-footer .row:first-child').css('display', 'none');
		// 	$('th').unbind("click");
		// 	// $('.pagination li').unbind("click");
		// 	// $(function () {
		// 	// 	$('[data-toggle="tooltip"]').tooltip()
		// 	// })
		//});
		$(document).on('click', '.del_row_ft', function () {
			$(this).parent('td').parent('tr').remove();
		});


		function vehicle_inspection(new_arr) {
			var url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_inspection')?>';
			$.post(url_1, {arr: new_arr}).done(function (data) {
				$('.tab-pane').each(function () {
					if ($(this).data('tab') == 1) {
						$(this).html(data);
						$("td[valign='top']").parent('tr').remove();
					}
				});
			});
		}

		function vehicle_fuel(new_arr) {
			var url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_fuel')?>';
			$.post(url_1, {arr: new_arr}).done(function (data) {
				$('.tab-pane').each(function () {
					if ($(this).data('tab') == 2) {
						$(this).html(data);
						$("td[valign='top']").parent('tr').remove();
					}
				});
			});
		}

		function vehicle_fine(new_arr) {
			var url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_fine')?>';
			$.post(url_1, {arr: new_arr}).done(function (data) {
				$('.tab-pane').each(function () {
					if ($(this).data('tab') == 3) {
						$(this).html(data);
						$("td[valign='top']").parent('tr').remove();
					}
				});
			});
		}

		function vehicle_accident(new_arr) {
			var url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_accident')?>';
			$.post(url_1, {arr: new_arr}).done(function (data) {
				$('.tab-pane').each(function () {
					if ($(this).data('tab') == 4) {
						$(this).html(data);
						$("td[valign='top']").parent('tr').remove();
					}
				});
			});
		}

		function vehicle_insurance(new_arr) {
			var url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_insurance')?>';
			$.post(url_1, {arr: new_arr}).done(function (data) {
				$('.tab-pane').each(function () {
					if ($(this).data('tab') == 5) {
						$(this).html(data);
						$("td[valign='top']").parent('tr').remove();
					}
				});
			});
		}

		function vehicle_spares(new_arr) {
			var url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_spares')?>';
			$.post(url_1, {arr: new_arr}).done(function (data) {
				$('.tab-pane').each(function () {
					if ($(this).data('tab') == 6) {
						$(this).html(data);
						$("td[valign='top']").parent('tr').remove();
					}
				});
			});
		}

		function vehicle_repair(new_arr) {
			var url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_repair')?>';
			$.post(url_1, {arr: new_arr}).done(function (data) {
				$('.tab-pane').each(function () {
					if ($(this).data('tab') == 7) {
						$(this).html(data);
						$("td[valign='top']").parent('tr').remove();
					}
				});
			});
		}

		function vehicle_wheel(new_arr) {
			var url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_wheel')?>';
			$.post(url_1, {arr: new_arr}).done(function (data) {
				$('.tab-pane').each(function () {
					if ($(this).data('tab') == 8) {
						$(this).html(data);
						$("td[valign='top']").parent('tr').remove();
					}
				});
			});
		}

		function vehicle_brake(new_arr) {
			var url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_brake')?>';
			$.post(url_1, {arr: new_arr}).done(function (data) {
				$('.tab-pane').each(function () {
					if ($(this).data('tab') == 9) {
						$(this).html(data);
						$("td[valign='top']").parent('tr').remove();
					}
				});
			});
		}

		function vehicle_grease(new_arr) {
			var url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_grease')?>';
			$.post(url_1, {arr: new_arr}).done(function (data) {
				$('.tab-pane').each(function () {
					if ($(this).data('tab') == 10) {
						$(this).html(data);
						$("td[valign='top']").parent('tr').remove();
					}
				});
			});
		}


		//vehicle inspection
		var i = 1;
		$(document).on('click', '.ex_1_add_new_tr', function () {
			i++;

			var fleet = $('input[name="vehicle[1]"]').val();

			$('.ex_1').append('<tr role="row">\n' +
				'<td><input title="" readonly type="text" name="vehicle[' + i + ']" value="' + fleet + '"  class="form-control text-center"/></td>\n' +
				'<td><input title=""  type="date" name="date[' + i + ']" value="<?= mdate('%Y-%m-%d', now()) ?>"  class="form-control text-center"/></td>\n' +
				'<td><input title="" readonly type="text" name="user[' + i + ']" value="<?= $user['name'] ?>"  class="form-control text-center"/></td>\n' +
				'<td><input title="" type="date" name="end_date[' + i + ']" max="3000-12-31" min="1000-01-01"  class="form-control text-center"/></td>\n' +
				'<td><input title="" type="number" name="price[' + i + ']" min="0" class="form-control text-center"/></td>\n' +
				'<td>' +
				'<span class="btn btn-outline-secondary btn-sm del_row_ft" style="padding: .25rem .5rem !important;">' +
				'<i class=" fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"> </i>' +
				'</span>' +
				'</td>\n' +
				'</tr>');

		});


	</script>
