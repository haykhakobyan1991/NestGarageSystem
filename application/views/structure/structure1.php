<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
<script src="<?= base_url() ?>assets/js/table.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/structure1.css"/>
<!-- Structure Start -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<!--[if lt IE 9]>
<script src="https://code.highcharts.com/modules/oldie.js"></script>
<![endif]-->


<script type="text/javascript" src="<?= base_url('assets/js/dataTables/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/dataTables.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/dataTables.buttons.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/jszip.min.js') ?>"></script>
<!--<script type="text/javascript" src="--><? //=base_url('assets/js/dataTables//vfs_fonts.js')?><!--"></script>-->
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.html5.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.colVis.min.js') ?>"></script>
<script src="//cdn.datatables.net/plug-ins/1.10.19/api/sum().js"></script>


<?
if ($this->uri->segment('3') == 'fleet_history') {
	echo '<script src="https://code.highcharts.com/highcharts.js"></script>';
	//---;
	echo '<script src="' . base_url('assets/js/custom-events.js') . '"></script>';
}
$time = strtotime(mdate('%Y-%m-%d', now()));
?>

<style>
	.row.bg-secondary {
		min-height: 194px;
	}

	.modal {
		top: 30% !important;
	}

	.dataTables_filter > label {
		margin-right: 54%;
	}

	.btn.disabled, .btn:disabled {
		opacity: 1 !important;
	}

	.bootstrap-select.disabled, .bootstrap-select > .disabled {
		cursor: none !important;
		color: #000 !important;
		background: #eaedf0 !important;
	}

	@media only screen and (max-width: 1349px) {
		.dataTables_filter > label {
			margin-right: 65%;
		}
		#search_{
			left: 67%;
		}
		body{
			background: red;
		}
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
				<h5 class="modal-title text-secondary" id="exampleModalLabel"><?= lang('changes') ?></h5>

			</div>
			<div id="result" class="modal-body">
				<div class="alert alert-secondary">
					<img style="height: 20px;margin: 0 auto;display: block;text-align: center;"
						 src="<?= base_url() ?>assets/images/load.svg"/>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="save_changes" class="btn btn-outline-success yes_btn"
						onclick="save('1')"><?= lang('save_changes') ?></button>
				<button type="button" class="btn btn-outline-success cancel_btn"
						data-dismiss="modal"><?= lang('close') ?></button>
			</div>
		</div>
	</div>
</div>
<!--  Modal End -->

<div class="content m-1">


	<div class="jumbotron jumbotron-fluid pb-2 pt-2 mb-0 text-right bg-white ">
		<div id="sample" style="position: relative;">
			<div id="myDiagramDiv" style="height:300px;"></div>
			<button name="" data-toggle="modal" data-target=".bd-example-modal-lg"
					class="btn btn-sm btn-outline-secondary mt-1" id="SaveButton"
					style="position: absolute;bottom: -55px;;right: 4px;z-index: 999;"
					onclick="save('-1')"><?= lang('save') ?></button>
		</div>
		<textarea class="d-none" id="mySavedModel" title=""> </textarea>
		<script src="chrome-extension://gppongmhjkpfnbhagpmjfkannfbllamg/js/inject.js"></script>
	</div>

	<span class="selected_information "></span>

</div>


<div id="add-info" style="<?= $this->uri->segment(3) == '' ? 'display: none' : '' ?>">
	<nav class="mt-2">
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
			<a class="nav-item nav-link tab_nav "
			   data-tab="1" id="nav-1-tab"
			   data-toggle="tab" href="#nav-1"
			   role="tab" aria-controls="nav-1"
			   aria-selected="true"><?= lang('inspection') ?></a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="2" id="nav-2-tab"
			   data-toggle="tab" href="#nav-2"
			   role="tab" aria-controls="nav-2"
			   aria-selected="false"><?= lang('fuel_consumption') ?></a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="3" id="nav-3-tab"
			   data-toggle="tab" href="#nav-3"
			   role="tab" aria-controls="nav-3"
			   aria-selected="false"><?= lang('fine') ?></a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="4" id="nav-4-tab"
			   data-toggle="tab" href="#nav-4"
			   role="tab" aria-controls="nav-4"
			   aria-selected="false"><?= lang('accident') ?></a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="5" id="nav-5-tab"
			   data-toggle="tab" href="#nav-5"
			   role="tab" aria-controls="nav-5"
			   aria-selected="false"><?= lang('insurance') ?></a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="6" id="nav-6-tab"
			   data-toggle="tab" href="#nav-6"
			   role="tab" aria-controls="nav-6"
			   aria-selected="false"><?= lang('spares') ?></a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="7" id="nav-7-tab"
			   data-toggle="tab" href="#nav-7"
			   role="tab" aria-controls="nav-7"
			   aria-selected="false"><?= lang('repair') ?></a>

			<!--			<a class="nav-item nav-link tab_nav"-->
			<!--			   data-tab="8" id="nav-8-tab"-->
			<!--			   data-toggle="tab" href="#nav-8"-->
			<!--			   role="tab" aria-controls="nav-8"-->
			<!--			   aria-selected="false">--><? //= lang('wheel') ?><!--</a>-->

			<!--			<a class="nav-item nav-link tab_nav"-->
			<!--			   data-tab="9" id="nav-9-tab"-->
			<!--			   data-toggle="tab" href="#nav-9"-->
			<!--			   role="tab" aria-controls="nav-9"-->
			<!--			   aria-selected="false">--><? //= lang('brake') ?><!--</a>-->

			<!--			<a class="nav-item nav-link tab_nav"-->
			<!--			   data-tab="10" id="nav-10-tab"-->
			<!--			   data-toggle="tab" href="#nav-10"-->
			<!--			   role="tab" aria-controls="nav-10"-->
			<!--			   aria-selected="false">--><? //= lang('grease') ?><!--</a>-->

			<!--			<a class="nav-item nav-link tab_nav"-->
			<!--			   data-tab="11" id="nav-11-tab"-->
			<!--			   data-toggle="tab" href="#nav-11"-->
			<!--			   role="tab" aria-controls="nav-11"-->
			<!--			   aria-selected="false">--><? //= lang('filter') ?><!--</a>-->

			<!--			<a class="nav-item nav-link tab_nav"-->
			<!--			   data-tab="12" id="nav-12-tab"-->
			<!--			   data-toggle="tab" href="#nav-12"-->
			<!--			   role="tab" aria-controls="nav-12"-->
			<!--			   aria-selected="false">--><? //= lang('battery') ?><!--</a>-->

		</div>
	</nav>


	<div class="tab-content" id="nav-tabContent" style="position: relative">

		<div class="tab-pane fade" data-tab="1" id="nav-1" role="tabpanel" aria-labelledby="nav-1-tab"></div>

		<div class="tab-pane fade" data-tab="2" id="nav-2" role="tabpanel" aria-labelledby="nav-2-tab"></div>

		<div class="tab-pane fade" data-tab="3" id="nav-3" role="tabpanel" aria-labelledby="nav-3-tab"></div>

		<div class="tab-pane fade" data-tab="4" id="nav-4" role="tabpanel" aria-labelledby="nav-4-tab"></div>

		<div class="tab-pane fade" data-tab="5" id="nav-5" role="tabpanel" aria-labelledby="nav-5-tab"></div>

		<div class="tab-pane fade" data-tab="6" id="nav-6" role="tabpanel" aria-labelledby="nav-6-tab"></div>

		<div class="tab-pane fade" data-tab="7" id="nav-7" role="tabpanel" aria-labelledby="nav-7-tab"></div>

		<div class="tab-pane fade" data-tab="8" id="nav-8" role="tabpanel" aria-labelledby="nav-8-tab"></div>

		<div class="tab-pane fade" data-tab="9" id="nav-9" role="tabpanel" aria-labelledby="nav-9-tab"></div>

		<div class="tab-pane fade" data-tab="10" id="nav-10" role="tabpanel" aria-labelledby="nav-10-tab"></div>

		<div class="tab-pane fade" data-tab="11" id="nav-11" role="tabpanel" aria-labelledby="nav-11-tab"></div>

		<div class="tab-pane fade" data-tab="12" id="nav-12" role="tabpanel" aria-labelledby="nav-12-tab"></div><?

		if ($this->uri->segment('3') == 'add_expenses') { ?>


			<!--search-->
			<div id="search_" style="min-height: 35px;position: absolute;top: 9px;left: 49%;display: none">
			<div style="float: right;">
				<span class="p-3"><?= lang('from') ?></span>
				<input type="date" value="<?= date("Y-m-d", strtotime("-1 month", $time)); ?>" name="from"
					   style="border: 1px solid silver;padding: 4px 2px 4px 10px;border-radius: 5px;"/>

				<span class="p-3"><?= lang('to') ?></span>
				<input type="date" value="<?= mdate('%Y-%m-%d', now()) ?>" name="to"
					   style="border: 1px solid silver;padding: 4px 2px 4px 10px;;border-radius: 5px;"/>

				<button style="min-width: 94px;
					font-size: 14px !important;
					line-height: 14px !important;
					padding: 10px 24px !important;
					font-weight: 500 !important;
					margin-top: -4px;
					min-height: 37px !important;"
						type="button"
						id="search"
						class="ml-2 save_cancel_btn btn btn-success"><?= lang('see') ?>
				</button>
			</div>
			</div><?

		} ?>

	</div><?

	if ($this->uri->segment('3') == 'fleet_history') { ?>

		<hr class="my-2">

		<div class="container-fluid" style="min-height: 35px;">


			<div style="float: right;">
				<span class="p-3"><?= lang('from') ?></span>
				<input type="date" value="<?= date("Y-m-d", strtotime("-1 month", $time)); ?>" name="from"
					   style="border: 1px solid silver;padding: 4px 2px 4px 10px;border-radius: 5px;"/>

				<span class="p-3"><?= lang('to') ?></span>
				<input type="date" value="<?= mdate('%Y-%m-%d', now()) ?>" name="to"
					   style="border: 1px solid silver;padding: 4px 2px 4px 10px;;border-radius: 5px;"/>

				<button style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 10px 24px !important;
    font-weight: 500 !important;margin-top: -4px;min-height: 37px !important;" type="button" id="search"
						class="ml-2 save_cancel_btn btn btn-success"><?= lang('see') ?>
				</button>
			</div>


		</div>

		<hr class="my-2">

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-7">
					<div id="container" style="width:100%; height:500px;"></div>
				</div>
				<div class="col-sm-5">
					<div id="container_2" style="width:100%; height:500px;"></div>
				</div>
			</div>
		</div><?

	} ?>

</div>

<script>
	// ---;
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
				stroke: "#fafafa",
				row: 1
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
					height: 38,
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

				new go.Binding("text", "text"),
				new go.Binding("layerName", "isSelected", function (sel) {
					return sel ? "Foreground" : "";
				}).ofObject(),


				$(go.Shape, "Rectangle", {
						name: "SHAPE",
						stroke: null,
						portId: "",
						cursor: "pointer",
						fromLinkableDuplicates: true,
						toLinkableDuplicates: true,
						width: 160
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
						$(go.RowColumnDefinition, {column: 5, width: 4}),

						$(go.TextBlock, textStyle(),
							{
								row: 1,
								columnSpan: 4,
								editable: false,
								isMultiline: false,
								wrap: go.TextBlock.WrapFit
							},
							new go.Binding("text", "text").makeTwoWay()),


						$(go.TextBlock, textStyle(),
							{
								row: 2,
								column: 0,
								columnSpan: 2,
								font: "9px Segoe UI,sans-serif",
								editable: false,
								isMultiline: false,
								width: 90
							},
							new go.Binding("text", "title").makeTwoWay()),



						$(go.TextBlock, textStyle(),
							{row: 1, margin: new go.Margin(0)},
						),
						$(go.TextBlock, textStyle(),
							{
								name: "boss",
								row: 1,
								column: 4,
								wrap: go.TextBlock.WrapFit
							},
							new go.Binding("text", "parent", function (v) {
								return "Boss: " + v;
							}))
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
					'stretch',
					{
						font: "bold 19px sans-serif",
						isMultiline: false,
						editable: false,
						stretch: go.GraphObject.Fill
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

	// trigger click ---;
	function clickFleet(val) {
		var fleet = myDiagram.findNodeForKey(val);
		if (fleet === null) return;
		var loc = fleet.location;

		// click on fleet
		robot.mouseDown(loc.x + 10, loc.y + 10, 0, {});
		robot.mouseUp(loc.x + 10, loc.y + 10, 100, {});

		// Clicking is just a sequence of input events.
		// There is no command in CommandHandler for such a basic gesture.
	}


	function rightClick() { //---;
		$(".highcharts-point").contextmenu(function (e) {

			var doc = document.documentElement;
			var count = (window.pageYOffset || doc.scrollTop) - (doc.clientTop || 0);

			var left = arguments[0].clientX;
			var top = arguments[0].clientY + count;

			menuBox = window.document.querySelector(".dropdown-menu");
			menuBox.style.left = left + "px";
			menuBox.style.top = top + "px";
			menuBox.style.display = "block";

			$('.tab_nav').each(function () {
				if ($(this).hasClass('active')) {
					menuBox.setAttribute('data-tab', $(this).data('tab'));
				}
			});

			e.preventDefault(e);

			//---;
			if ($(this).hasClass('line')) {

				setTimeout(function () {
					var fleets = $('input[name="selecteds"]').val();
					var date = $('input[name="line_date"]').val();
					//console.log(e);

					document.getElementById('more_info').href = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/structure1/add_expenses/?from=')?>"
						+ date
						+ '&to=' + date
						+ '&tab=' + menuBox.getAttribute('data-tab')
						+ '&fleets=' + fleets;
				}, 200);

			} else {
				//console.log(e.target);
				document.getElementById('more_info').href = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/structure1/add_expenses/?from=')?>"
					+ $('input[name="from"]').val()
					+ '&to=' + $('input[name="to"]').val()
					+ '&tab=' + menuBox.getAttribute('data-tab')
					+ '&fleet=' + e.target.point.fleet_id;

			}

		});

		function closeMenu() {
			$('.dropdown-menu').fadeOut(200);
		}

		$(document.body).click(function (e) {
			closeMenu();
		});

		$(".dropdown-menu").click(function (e) {
			menuBox.style.display = "none";
			e.stopPropagation();
		});
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

		// myDiagram.addDiagramListener('ObjectSingleClicked', function (e) {
		// 	myDiagram.clearSelection();
		// });


		myDiagram.addDiagramListener('ObjectSingleClicked', function (e) {
			var linkDataArray = <?=$from_to?>;
			$.each(linkDataArray, function (key, value) {
				if (value.from == myDiagram.selection.Ca.key.Wd.key) {
					//console.log('+' + linkDataArray[key].to);
					dragSelectNodes(linkDataArray[key].to);
					$.each(linkDataArray, function (ky, val) {
						if (val.from == value.to) {
							dragSelectNodes(val.to);
							//console.log('-' + val.to);
						}
					})
				}
			});

			var arr = [];
			new_arr = [];
			selecteds = [];

			myDiagram.selection.each(function (part) {

				if (part instanceof go.Node) {

					//console.log(part);

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
					//---;
					if (found1 == 'f') {
						selecteds.push(arr.key);
					}

				}

			});

			//---;
			$('input[name="selecteds"]').val(selecteds);


			if ($('a[data-id="1"]').hasClass('active')) {
				if (new_arr.length !== 0) {
					$('.selected_information').html('<img style="z-index: 999; position: fixed; left: 50%; width: 10em" src="http://localhost/NestGarageSystem/assets/images/puff.svg">');
					var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/car_info')?>';
					$.post(url, {arr: new_arr}).done(function (data) {
						$('#add-info').fadeOut('slow');
						$('.selected_information').html(data);
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
				$('.selected_information').html('');
				var url_1 = '';

				$('.tab_nav').each(function () {
					if ($(this).data('tab') == 1 && $(this).hasClass('active')) {
						url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_inspection')?>';
						vehicle_add(new_arr, url_1, $(this).data('tab'))
					} else if ($(this).data('tab') == 2 && $(this).hasClass('active')) {
						url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_fuel')?>';
						vehicle_add(new_arr, url_1, $(this).data('tab'))
					} else if ($(this).data('tab') == 3 && $(this).hasClass('active')) {
						url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_fine')?>';
						vehicle_add(new_arr, url_1, $(this).data('tab'))
					} else if ($(this).data('tab') == 4 && $(this).hasClass('active')) {
						url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_accident')?>';
						vehicle_add(new_arr, url_1, $(this).data('tab'))
					} else if ($(this).data('tab') == 5 && $(this).hasClass('active')) {
						url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_insurance')?>';
						vehicle_add(new_arr, url_1, $(this).data('tab'))
					} else if ($(this).data('tab') == 6 && $(this).hasClass('active')) {
						url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_spares')?>';
						vehicle_add(new_arr, url_1, $(this).data('tab'))
					} else if ($(this).data('tab') == 7 && $(this).hasClass('active')) {
						url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_repair')?>';
						vehicle_add(new_arr, url_1, $(this).data('tab'))
					} else if ($(this).data('tab') == 8 && $(this).hasClass('active')) {
						url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_wheel')?>';
						vehicle_add(new_arr, url_1, $(this).data('tab'))
					} else if ($(this).data('tab') == 9 && $(this).hasClass('active')) {
						url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_brake')?>';
						vehicle_add(new_arr, url_1, $(this).data('tab'))
					} else if ($(this).data('tab') == 10 && $(this).hasClass('active')) {
						url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_grease')?>';
						vehicle_add(new_arr, url_1, $(this).data('tab'))
					} else if ($(this).data('tab') == 11 && $(this).hasClass('active')) {
						url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_filter')?>';
						vehicle_add(new_arr, url_1, $(this).data('tab'))
					} else if ($(this).data('tab') == 12 && $(this).hasClass('active')) {
						url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_battery')?>';
						vehicle_add(new_arr, url_1, $(this).data('tab'))
					}
				});

			} else if ($('a[data-id="3"]').hasClass('active')) {
				$('.selected_information').html('');

				var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/getHistory_ax')?>';
				var date_from = $('input[name="from"]').val();
				var date_to = $('input[name="to"]').val();
				var table = '';
				var title = '';

				$('.tab_nav').each(function () {

					if ($(this).data('tab') == 1 && $(this).hasClass('active')) {
						table = 'inspection';
						title = $(this).text();
					} else if ($(this).data('tab') == 2 && $(this).hasClass('active')) {
						table = 'fuel_consumption';
						title = $(this).text();
					} else if ($(this).data('tab') == 3 && $(this).hasClass('active')) {
						table = 'fine';
						title = $(this).text();
					} else if ($(this).data('tab') == 4 && $(this).hasClass('active')) {
						table = 'accident';
						title = $(this).text();
					} else if ($(this).data('tab') == 5 && $(this).hasClass('active')) {
						table = 'insurance';
						title = $(this).text();
					} else if ($(this).data('tab') == 6 && $(this).hasClass('active')) {
						table = 'spares';
						title = $(this).text();
					} else if ($(this).data('tab') == 7 && $(this).hasClass('active')) {
						table = 'repair';
						title = $(this).text();
					} else if ($(this).data('tab') == 8 && $(this).hasClass('active')) {
						table = 'wheel';
						title = $(this).text();
					} else if ($(this).data('tab') == 9 && $(this).hasClass('active')) {
						table = 'brake';
						title = $(this).text();
					} else if ($(this).data('tab') == 10 && $(this).hasClass('active')) {
						table = 'grease';
						title = $(this).text();
					} else if ($(this).data('tab') == 11 && $(this).hasClass('active')) {
						table = 'filter';
						title = $(this).text();
					} else if ($(this).data('tab') == 12 && $(this).hasClass('active')) {
						table = 'battery';
						title = $(this).text();
					}
				});


				$.ajax({
					url: url,
					type: 'POST',
					data: {date_from: date_from, date_to: date_to, table: table, arr: new_arr},
					async: true,
					dataType: "json",
					success: function (data) {
						if (title != '') {
							chartCircle(data, title);
							chart(data, title);
						}
					}
				}).done(function () { //---
					rightClick();
				});
			} else {
				$('.selected_information').html('');
			}

			/*Remove BoxShadow From HighCharts Pie Diagram*/
			$('.highcharts-text-outline').attr('stroke', '');
		});


		// Ctrl right click multiple select //
		$('canvas').bind("contextmenu", function (event) {

			// Avoid the real one
			event.preventDefault();
			myDiagram.clearSelection();

			if ($('a[data-id="1"]').hasClass('active')) {
				$('.selected_information').html('');
			}


		});

		if ($('a[data-id="2"]').hasClass('active')) {

			$('.tab_nav').click(function () {
				if ($(this).data('tab') == 1) {
					url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_inspection')?>';
					vehicle_add(new_arr, url_1, $(this).data('tab'))
				} else if ($(this).data('tab') == 2) {
					url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_fuel')?>';
					vehicle_add(new_arr, url_1, $(this).data('tab'))
				} else if ($(this).data('tab') == 3) {
					url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_fine')?>';
					vehicle_add(new_arr, url_1, $(this).data('tab'))
				} else if ($(this).data('tab') == 4) {
					url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_accident')?>';
					vehicle_add(new_arr, url_1, $(this).data('tab'))
				} else if ($(this).data('tab') == 5) {
					url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_insurance')?>';
					vehicle_add(new_arr, url_1, $(this).data('tab'))
				} else if ($(this).data('tab') == 6) {
					url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_spares')?>';
					vehicle_add(new_arr, url_1, $(this).data('tab'))
				} else if ($(this).data('tab') == 7) {
					url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_repair')?>';
					vehicle_add(new_arr, url_1, $(this).data('tab'))
				} else if ($(this).data('tab') == 8) {
					url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_wheel')?>';
					vehicle_add(new_arr, url_1, $(this).data('tab'))
				} else if ($(this).data('tab') == 9) {
					url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_brake')?>';
					vehicle_add(new_arr, url_1, $(this).data('tab'))
				} else if ($(this).data('tab') == 10) {
					url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_grease')?>';
					vehicle_add(new_arr, url_1, $(this).data('tab'))
				} else if ($(this).data('tab') == 11) {
					url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_filter')?>';
					vehicle_add(new_arr, url_1, $(this).data('tab'))
				} else if ($(this).data('tab') == 12) {
					url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_battery')?>';
					vehicle_add(new_arr, url_1, $(this).data('tab'))
				}
			});
			$(document).on('click', 'button#search', function () {
				var url_2 = $(this).data('url');
				var dataTab = $(this).data('tab');
				vehicle_add(new_arr, url_2, dataTab);
			});
		} else if ($('a[data-id="3"]').hasClass('active')) {

			//---;
			function chart(data, title) {
				chart1 = Highcharts.chart('container', {
					chart: {
						scrollablePlotArea: {
							minWidth: 700
						}
					},
					plotOptions: {
						series: {
							cursor: 'pointer',
							point: {
								events: {
									click: function (e) {
										var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/getHistoryCircle_ax')?>';
										var date = this.category;
										var table = data.table;
										$.ajax({
											url: url,
											type: 'POST',
											data: {date: date, table: table, arr: new_arr},
											async: true,
											dataType: "json",
											success: function (data) {
												chartCircle(data, title);
											}
										}).done(function () {
											rightClick();
										});
									},
									contextmenu: function () {
										$('input[name="line_date"]').val(this.category);
									}
								}
							}
						}
					},
					title: {
						text: title
					},
					subtitle: {
						text: ''
					},
					xAxis: {
						categories: data.date
					},
					yAxis: {
						main: 0,
						title: {
							text: 'AMD'
						}
					},
					series: [{
						name: title,
						data: data.price
					}]
				});


				$('#container path').addClass('line'); //---;

			}

			/*
            *
            * Second Chart Start
            *
            */

			// Highcharts.setOptions({
			// 	colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
			// 		return {
			// 			radialGradient: {
			// 				cx: 0.5,
			// 				cy: 0.3,
			// 				r: 0.7
			// 			},
			// 			stops: [
			// 				[0, color],
			// 				[1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
			// 			]
			// 		};
			// 	})
			// });

			function chartCircle(data, title) {

				// Build the chart
				Highcharts.chart('container_2', {
					chart: {
						plotBackgroundColor: null,
						plotBorderWidth: 1,//null,
						plotShadow: false
					},
					title: {
						text: title
					},
					tooltip: {
						pointFormat: '{series.name}: <b>{point.y:,.0f}</b>'
					},

					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: true,
								format: '<b>{point.name}</b>: {point.y:,.0f}',
								style: {
									color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
								}
							},
							point: {
								events: {
									click: function (e) {

										if (!this.selected) {

											var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/getHistorySingle_ax')?>';
											var date_from = $('input[name="from"]').val();
											var date_to = $('input[name="to"]').val();
											var table = this.table;
											var fleet_id = this.fleet_id;
											var fleet_name = this.name;
											$.ajax({
												url: url,
												type: 'POST',
												data: {
													date_from: date_from,
													date_to: date_to,
													table: table,
													fleet_id: fleet_id,
													fleet_name: fleet_name
												},
												async: true,
												dataType: "json",
												success: function (data) {
													chart(data, fleet_name);
												}
											}).done(function () {
												rightClick();
											});
										} else {

											var date_from = $('input[name="from"]').val();
											var date_to = $('input[name="to"]').val();
											var table = this.table;
											var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/getHistory_ax')?>';

											$.ajax({
												url: url,
												type: 'POST',
												data: {
													date_from: date_from,
													date_to: date_to,
													table: table,
													arr: new_arr
												},
												async: true,
												dataType: "json",
												success: function (data) {
													chart(data, title);
												}
											}).done(function () {
												rightClick();
											});
										}
									}
								}
							},
							showInLegend: true
						}
					},
					series: [{
						type: 'pie',
						name: 'price',
						data: data.data
					}]
				});
			}


			$(document).on('click', '#search, .tab_nav', function (e) {
				var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/getHistory_ax')?>';
				var date_from = $('input[name="from"]').val();
				var date_to = $('input[name="to"]').val();
				var table = '';
				var title = '';
				var ax = false;


				$('.tab_nav').each(function () {

					if ($(this).data('tab') == 1 && $(this).hasClass('active')) {
						ax = true;
						table = 'inspection';
						title = $(this).text();
					} else if ($(this).data('tab') == 2 && $(this).hasClass('active')) {
						ax = true;
						table = 'fuel_consumption';
						title = $(this).text();
					} else if ($(this).data('tab') == 3 && $(this).hasClass('active')) {
						ax = true;
						table = 'fine';
						title = $(this).text();
					} else if ($(this).data('tab') == 4 && $(this).hasClass('active')) {
						ax = true;
						table = 'accident';
						title = $(this).text();
					} else if ($(this).data('tab') == 5 && $(this).hasClass('active')) {
						ax = true;
						table = 'insurance';
						title = $(this).text();
					} else if ($(this).data('tab') == 6 && $(this).hasClass('active')) {
						ax = true;
						table = 'spares';
						title = $(this).text();
					} else if ($(this).data('tab') == 7 && $(this).hasClass('active')) {
						ax = true;
						table = 'repair';
						title = $(this).text();
					} else if ($(this).data('tab') == 8 && $(this).hasClass('active')) {
						ax = true;
						table = 'wheel';
						title = $(this).text();
					} else if ($(this).data('tab') == 9 && $(this).hasClass('active')) {
						ax = true;
						table = 'brake';
						title = $(this).text();
					} else if ($(this).data('tab') == 10 && $(this).hasClass('active')) {
						ax = true;
						table = 'grease';
						title = $(this).text();
					} else if ($(this).data('tab') == 11 && $(this).hasClass('active')) {
						ax = true;
						table = 'filter';
						title = $(this).text();
					} else if ($(this).data('tab') == 12 && $(this).hasClass('active')) {
						ax = true;
						table = 'battery';
						title = $(this).text();
					}
				});


				if (ax) {
					$.ajax({
						url: url,
						type: 'POST',
						data: {date_from: date_from, date_to: date_to, table: table, arr: new_arr},
						async: true,
						dataType: "json",
						success: function (data) {
							if (title != '') {
								chartCircle(data, title);
								chart(data, title);
							}
						}
					}).done(function () {
						rightClick();
					});
				}


			})
		}


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
			var results = myDiagram.findNodesByExample({title: regex}, {text: regex});

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
		//console.log(myDiagram.model.linkDataArray);
		var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/change_from_to_ax')?>';
		var data = myDiagram.model.linkDataArray;
		var old_data = '<?=$from_to?>';
		var structure = '<?=$structure?>';
		$.post(url, {data: data, old_data: old_data, structure: structure, value: value}).done(function (data) {
			//console.log("Data Loaded: " + data);
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
						$('#save_changes').removeClass('d-none');
						$('#result').html('<div class="alert alert-secondary">' + res + '</div>');
					} else {
						$('#save_changes').addClass('d-none');
						$('#result').html('<h2 class="text-center alert alert-secondary"><?=lang('information_is_empty')?></h2>');
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


	$(document).on('click', '.del_row_ft', function () {
		$(this).parent('td').parent('tr').remove();
	});

	//ajax
	function vehicle_add(new_arr, url_1, dataTab) {

		var date_from = $('input[name="from"]').val();
		var date_to = $('input[name="to"]').val();

		$('.tab-pane').each(function () {
			if ($(this).data('tab') == dataTab) {
				$(this).html('<img style="z-index: 999; position: fixed; left: 50%; width: 10em" src="http://localhost/NestGarageSystem/assets/images/puff.svg">');
				$('#search_').css('display', 'none');
			}
		});

		$.post(url_1, {arr: new_arr, date_from: date_from, date_to: date_to}).done(function (data) {
			$('.tab-pane').each(function () {
				if ($(this).data('tab') == dataTab) {
					$(this).html(data);
					$("td[valign='top']").parent('tr').remove();
					$('button#search').data('tab', dataTab);
					$('button#search').data('url', url_1);

					if (data != '') {
						$('#search_').css('display', 'block');
					}
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


<div class="dropdown-menu" style="position:absolute;top: 27px;left: 20px; z-index: 9999">
	<a id="more_info" class="dropdown-item" target="_blank" href=""><i
			class="pr-2 fas fa-info-circle"></i><?= lang('details') ?></a>
</div>


<script>//---;
	$(window).on('load', function () {


		if ($('a[data-id="2"]').hasClass('active')) {
			<?if($this->input->get('tab') != '') {?>

			$('.tab_nav').each(function () {
				if ($(this).data('tab') == '<?=$this->input->get('tab')?>') {
					$(this).trigger('click');
				}
			});


			<?if($this->input->get('fleet') != '') {?>

			setTimeout(function () {
				clickFleet('f<?=$this->input->get('fleet')?>');
			}, 500);

			<?} elseif($this->input->get('fleets') != '') {?>

			var fleet = '<?=$this->input->get('fleets')?>';
			var fleet_arr = fleet.split(',');

			setTimeout(function () {
				var el;

				$.each(fleet_arr, function (e, value) {

					el = myDiagram.findNodeForKey(value);
					if (el === null) return;

					el.isSelected = true;

					var loc = el.location;

					// click on fleet

					robot.mouseDown(loc.x + 10, loc.y + 10, 0, {});
					robot.mouseUp(loc.x + 10, loc.y + 10, 100, {});

				});

			}, 700);

			<?}?>

			$('input[name="from"]').val('<?=$this->input->get('from')?>');
			$('input[name="to"]').val('<?=$this->input->get('to')?>');
			$('#search').trigger('click');

			<?}?>
		}
	});

</script>

<input type="hidden" name="selecteds">
<input type="hidden" name="line_date">
