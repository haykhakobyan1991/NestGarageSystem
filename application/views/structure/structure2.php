<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
<script src="<?= base_url() ?>assets/js/table.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/structure1.css"/>
<!-- Structure Start -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<!--[if lt IE 9]>
<script src="https://code.highcharts.com/modules/oldie.js"></script>
<![endif]-->
<script src="https://gojs.net/latest/extensions/Robot.js"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/dataTables.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/dataTables.buttons.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.bootstrap4.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/jszip.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.html5.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.colVis.min.js') ?>"></script>
<script src="//cdn.datatables.net/plug-ins/1.10.19/api/sum().js"></script>

<!-- Structure Start -->
<style>
	canvas {
		background: #fff;
	}
	.row.bg-secondary {
		min-height: 194px;
	}
	.modal {
		top: 30% !important;
	}
	#fleet_filter {
		border: 1px solid;
		position: absolute;
		z-index: 999;
		right: 60px;
		top: 20px;
		padding: 10px 15px 10px 30px;
		border-radius: 5px;
	}
	.dataTables_filter > label {
		margin-right: 70%;
	}

	.btn.disabled, .btn:disabled {
		opacity: 1 !important;
	}
	.bootstrap-select.disabled, .bootstrap-select > .disabled {
		cursor: none !important;
		color: #000 !important;
		background: #eaedf0 !important;
	}
</style>
<?
if ($this->uri->segment('3') == 'fleet_history') {
	echo '<script src="https://code.highcharts.com/highcharts.js"></script>';
	//---;
	echo '<script src="' . base_url('assets/js/custom-events.js') . '"></script>';
}

$time = strtotime(mdate('%Y-%m-%d', now()));


//filter structure (only cars)
$structure_array = json_decode($structure, true);
foreach ($structure_array as $key => $info) {
	if (preg_match("/^(d)/", $info['key']) || preg_match("/^(c)/", $info['key']) || preg_match("/^(h)/", $info['key'])) {
		unset($structure_array[$key]);
	}
}

$structure_array = array_values(array_unique($structure_array, SORT_REGULAR));


?>


<script src="<?= base_url('assets/js/go.js') ?>"></script>
<div class="content m-1">
	<div class="jumbotron jumbotron-fluid pb-2 pt-2 mb-0">


		<div id="sample" style="position:relative;">
			<div id="fleet_filter" class="form-group form-check">
				<input style="margin-top: 4px" type="checkbox" class="form-check-input" id="filter_vehicles">
				<label class="form-check-label" for="exampleCheck1"><?= lang('only_vehicles') ?></label>
			</div>
			<div id="myDiagramDiv" style="background-color: #696969; border: solid 1px black; height: 500px"></div>
			<div>
				<div id="myInspector"></div>
			</div>
			<div>
				<textarea id="mySavedModel" style="display:none;">
					{"class": "go.TreeModel",
						"nodeDataArray": <?= $structure ?>
					}
			</textarea>
			</div>
		</div>
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
			<!--			   aria-selected="false">--><? //=lang('wheel')?><!--</a>-->
			<!--			<a class="nav-item nav-link tab_nav"-->
			<!--			   data-tab="9" id="nav-9-tab"-->
			<!--			   data-toggle="tab" href="#nav-9"-->
			<!--			   role="tab" aria-controls="nav-9"-->
			<!--			   aria-selected="false">--><? //=lang('brake')?><!--</a>-->
			<!--			<a class="nav-item nav-link tab_nav"-->
			<!--			   data-tab="10" id="nav-10-tab"-->
			<!--			   data-toggle="tab" href="#nav-10"-->
			<!--			   role="tab" aria-controls="nav-10"-->
			<!--			   aria-selected="false">--><? //=lang('grease')?><!--</a>-->
			<!--			<a class="nav-item nav-link tab_nav"-->
			<!--			   data-tab="11" id="nav-11-tab"-->
			<!--			   data-toggle="tab" href="#nav-11"-->
			<!--			   role="tab" aria-controls="nav-11"-->
			<!--			   aria-selected="false">--><? //=lang('filter')?><!--</a>-->
			<!--			<a class="nav-item nav-link tab_nav"-->
			<!--			   data-tab="12" id="nav-12-tab"-->
			<!--			   data-toggle="tab" href="#nav-12"-->
			<!--			   role="tab" aria-controls="nav-12"-->
			<!--			   aria-selected="false">--><? //=lang('battery')?><!--</a>-->
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
		<div class="tab-pane fade" data-tab="12" id="nav-12" role="tabpanel" aria-labelledby="nav-12-tab"></div>
		<!--search-->
		<div id="search_" style="min-height: 35px;position: absolute;top: 9px;left: 66%;display: none">
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
		</div>

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
					<div id="container" style="width:100%; "></div>
				</div>
				<div class="col-sm-5">
					<div id="container_2" style="width:100%; "></div>
				</div>
			</div>
		</div><?

	} ?>

</div>

<script>

	/*Diagram Trees Start*/


	// This button assumes data binding to the "checked" property.
	// go.GraphObject.defineBuilder("TriStateCheckBoxButton", function (args) {
	// 	// var button = (
	// 	// 	go.GraphObject.make("Button",
	// 	// 		{
	// 	// 			"ButtonBorder.fill": "transparent",
	// 	// 			"ButtonBorder.stroke": "transparent",
	// 	// 			width: 1,
	// 	// 			height: 1,
	// 	// 			margin: 0
	// 	// 		},
	// 	// 		go.GraphObject.make(go.Shape,
	// 	// 			{
	// 	// 				name: "ButtonIcon",
	// 	// 				geometryString: "M0 4 L3 9 9 0",  // a "check" mark
	// 	// 				strokeWidth: 2,
	// 	// 				stretch: go.GraphObject.Fill,  // this Shape expands to fill the Button
	// 	// 				geometryStretch: go.GraphObject.Uniform,  // the check mark fills the Shape without distortion
	// 	// 				background: null,
	// 	// 				visible: false  // visible set to false: not checked, unless data.checked is true
	// 	// 			},
	// 	// 			new go.Binding("visible", "checked", function (p) {
	// 	// 				return p === true || p === null;
	// 	// 			}),
	// 	// 			new go.Binding("stroke", "checked", function (p) {
	// 	// 				return p === null ? null : "black";
	// 	// 			}),
	// 	// 			new go.Binding("background", "checked", function (p) {
	// 	// 				return p === null ? "gray" : null;
	// 	// 			})
	// 	// 		)
	// 	// 	)
	// 	// );
	//
	// 	// function updateCheckBoxesDown(node, val) {
	// 	// 	node.diagram.model.setDataProperty(node.data, "checked", val);
	// 	// 	node.findTreeChildrenNodes().each(function (child) {
	// 	// 		updateCheckBoxesDown(child, val);
	// 	// 	})
	// 	// }
	//
	// 	// function updateCheckBoxesUp(node) {
	// 	// 	var parent = node.findTreeParentNode();
	// 	// 	if (parent !== null) {
	// 	// 		var anychecked = parent.findTreeChildrenNodes().any(function (n) {
	// 	// 			return n.data.checked !== false && n.data.checked !== undefined;
	// 	// 		});
	// 	// 		var allchecked = parent.findTreeChildrenNodes().all(function (n) {
	// 	// 			return n.data.checked === true;
	// 	// 		});
	// 	// 		node.diagram.model.setDataProperty(parent.data, "checked", (allchecked ? true : (anychecked ? null : false)));
	// 	// 		updateCheckBoxesUp(parent);
	// 	// 	}
	// 	// }
	//
	// 	// button.click = function (e, button) {
	// 	//
	// 	// 	if (!button.isEnabledObject()) return;
	// 	// 	var diagram = e.diagram;
	// 	// 	if (diagram === null || diagram.isReadOnly) return;
	// 	// 	if (diagram.model.isReadOnly) return;
	// 	// 	e.handled = true;
	// 	// 	var shape = button.findObject("ButtonIcon");
	// 	// 	// diagram.startTransaction("checkbox");
	// 	// 	// Assume the name of the data property is "checked".
	// 	// 	// var node = button.part;
	// 	// 	// var oldval = node.data.checked;
	// 	// 	// var newval = (oldval !== true);  // newval will always be either true or false, never null
	// 	// 	// Set this data.checked property and those of all its children to the same value
	// 	// 	// updateCheckBoxesDown(node, newval);
	// 	// 	// Walk up the tree and update all of their checkboxes
	// 	// 	// updateCheckBoxesUp(node);
	// 	// 	// support extra side-effects without clobbering the click event handler:
	// 	// 	// if (typeof button["_doClick"] === "function") button["_doClick"](e, button);
	// 	// 	// diagram.commitTransaction("checkbox");
	// 	// };
	//
	// 	// return button;
	// });

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
				$("TreeExpanderButton"),
				$(go.Panel, "Horizontal",
					{
						padding: 3,
						position: new go.Point(16, 0),
						margin: new go.Margin(0, 2, 0, 0),
						defaultAlignment: go.Spot.Center
					},
					new go.Binding("background", "isSelected", function (s) {
						return (s ? "lightblue" : "white");
					}).ofObject(),

					$(go.TextBlock,
						{font: '9pt Verdana, sans-serif', margin: new go.Margin(0, 2, 0, 2)},
						new go.Binding("stroke", "isHighlighted", function (h) {
							return h ? "#ff7a59" : color;
						}).ofObject(),
						new go.Binding("text", "name", function (s) {
							return " " + s;
						})),
					$(go.TextBlock,
						{
							font: 'bold ,9pt Verdana, sans-serif',
							margin: new go.Margin(0, 5, 0, 2),
							stroke: "#607d8b"
						},
						new go.Binding("stroke", "isHighlighted", function (h) {
							return h ? "#ff7a59" : color;
						}).ofObject(),
						new go.Binding("text", "title", function (s) {
							return " " + s;
						}))
				)  // end Horizontal Panel
			);  // end Node

		// without lines
		//myDiagram.linkTemplate = $(go.Link);

		// with lines
		myDiagram.linkTemplate =
			$(go.Link,
				{
					selectable: false,
					routing: go.Link.Orthogonal,
					fromEndSegmentLength: 4,
					toEndSegmentLength: 4,
					fromSpot: new go.Spot(0.001, 1, 7, 0),
					toSpot: go.Spot.Left
				},
				$(go.Shape,
					{stroke: 'gray', strokeDashArray: [1, 2]}));
		load();

		// support editing the properties of the selected person in HTML
		if (window.Inspector) myInspector = new Inspector("myInspector", myDiagram,
			{
				properties: {
					"key": {readOnly: true},
					"comments": {}
				}
			});
	}

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
			var results = myDiagram.findNodesByExample({name: regex});

			console.log(results);

			myDiagram.highlightCollection(results);


			// try to center the diagram at the first node that was found
			if (results.count > 0) myDiagram.centerRect(results.first().actualBounds);
		} else {
			myDiagram.clearHighlighteds();
		}

		myDiagram.commitTransaction("highlight search");
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

	function diagramListener() {

		robot = new Robot(myDiagram);

		function dragSelectNodes(dd) {
			var alpha = myDiagram.findNodeForKey(dd);
			if (alpha === null) return;

			alpha.isSelected = true;

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
						console.log(e);


						document.getElementById('more_info').href = "<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/structure1/add_expenses/?from=')?>"
							+ date
							+ '&to=' + date
							+ '&tab=' + menuBox.getAttribute('data-tab')
							+ '&fleets=' + fleets;
					}, 200);

				} else {
					console.log(e.target);
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


		var new_arr = [];
		myDiagram.addDiagramListener("ObjectSingleClicked",
			function (e) {

				linkDataArray = <?=$structure?>;
				$.each(linkDataArray, function (key, value) {
					if (value.parent == myDiagram.selection.Ca.key.Wd.key && value.parent !== undefined) {
						dragSelectNodes(value.key);
						$.each(linkDataArray, function (ky, val) {
							if (val.parent == value.key) {
								dragSelectNodes(val.key);
							}
						})
					}
				});


				var arr = [];
				new_arr = [];
				selecteds = [];
				myDiagram.selection.each(function (part) {

					if (part instanceof go.Node) {
						arr = {
							"key": part.Wd.key,
							"name": part.Wd.name,
							"title": part.Wd.title,
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
							chartCircle(data, title);
							chart(data, title);
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

				console.log(data.data);

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
											}).done(function () { //---
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
											}).done(function () { //---
												rightClick();
											});
										}
									}
								}
							},
							showInLegend: true
						},
					},

					series: [{
						type: 'pie',
						name: 'Browser share',
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
							chartCircle(data, title);
							chart(data, title);
						}
					}).done(function () { //---
						rightClick();
					});
				}


			})
		}
	}


	function get_diagram() {
		myDiagram.div = null;
		init();
	}

	function replaceDiagram() {


		myDiagram.div = null;

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
				$("TreeExpanderButton"),
				$(go.Panel, "Horizontal",
					{
						padding: 3,
						position: new go.Point(16, 0),
						margin: new go.Margin(0, 2, 0, 0),
						defaultAlignment: go.Spot.Center
					},
					new go.Binding("background", "isSelected", function (s) {
						return (s ? "lightblue" : "white");
					}).ofObject(),

					$(go.TextBlock,
						{
							font: '9pt Verdana, sans-serif',
							margin: new go.Margin(0, 2, 0, 2)
						},
						new go.Binding("text", "name", function (s) {
							return " " + s;
						}),
						new go.Binding("stroke", "isHighlighted", function (h) {
							return h ? "#ff7a59" : color;
						}).ofObject()),

				  	$(go.TextBlock,{
								font: 'bold ,9pt Verdana, sans-serif',
								margin: new go.Margin(0, 5, 0, 2)
					  },

						new go.Binding("text", "title", function (s) {
							return " " + s;
						}),
						new go.Binding("stroke", "isHighlighted", function (h) {
							return h ? "#ff7a59" : color;
						}).ofObject())
				)  // end Horizontal Panel
			);  // end Node

		// without lines
		//myDiagram.linkTemplate = $(go.Link);

		// with lines
		myDiagram.linkTemplate =
			$(go.Link,
				{
					selectable: false,
					routing: go.Link.Orthogonal,
					fromEndSegmentLength: 4,
					toEndSegmentLength: 4,
					fromSpot: new go.Spot(0.001, 1, 7, 0),
					toSpot: go.Spot.Left
				},
				$(go.Shape,
					{strokeDashArray: [1, 2]}
				));

		load_new();

		// support editing the properties of the selected person in HTML
		if (window.Inspector) myInspector = new Inspector("myInspector", myDiagram,
			{
				properties: {
					"key": {readOnly: true},
					"comments": {}
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
				var results = myDiagram.findNodesByExample({name: regex});

				console.log(results);

				myDiagram.highlightCollection(results);

				// try to center the diagram at the first node that was found
				if (results.count > 0) myDiagram.centerRect(results.first().actualBounds);
			} else {
				myDiagram.clearHighlighteds();
			}

			myDiagram.commitTransaction("highlight search");
		}


		diagramListener();
	}

	$(document).on('change', '#filter_vehicles', function () {
		if ($(this).is(':checked')) {
			replaceDiagram();
		} else {
			get_diagram();
		}
		diagramListener();
	});


	function load() {
		myDiagram.model = go.Model.fromJson(document.getElementById("mySavedModel").value);
	}

	function load_new() {
		myDiagram.model = go.Model.fromJson('{"class": "go.TreeModel","nodeDataArray": <?=json_encode($structure_array)?>}');
	}


	$(document).ready(function () {
		init();
		diagramListener();
	});


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
			'<td><input title="" readonly type="text" name="user[' + i + ']" value="<?//= $user['name'] ?>"  class="form-control text-center"/></td>\n' +
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


<script>//-----;
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

					console.log(el.location);
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
