<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
<script src="<?= base_url() ?>assets/js/table.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/structure1.css"/>
<!-- Structure Start -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<!--[if lt IE 9]>
<script src="https://code.highcharts.com/modules/oldie.js"></script>
<![endif]-->
<style>
	.row.bg-secondary {
		min-height: 194px;
	}
	.btn-group.mb-3.mb-md-3.mt-3.mt-md-3{
		top: 50px;
	}
	button.save_cancel_btn.btn.btn-success.mb-1.p-0.add_lg_2,button.save_cancel_btn.btn.btn-success.p-0.remove_lg_2 {
		border: 1px solid gray !important;
		color: gray;
	}
	button.save_cancel_btn.btn.btn-success.mb-1.p-0.add_lg_2:hover,button.save_cancel_btn.btn.btn-success.p-0.remove_lg_2:hover {
		border: 1px solid gray !important;
		color: gray;
		background: #fff !important;
	}

	canvas{
		background: #fff;
	}

	.row.bg-secondary {
		min-height: 194px;
	}

	.modal {
		top: 30% !important;
	}

	.dataTables_filter>label {
		margin-right: 70%;
	}
</style>
<script src="<?= base_url('assets/js/go.js') ?>"></script>
<script src="https://gojs.net/latest/extensions/Robot.js"></script>

<script type="text/javascript" src="<?=base_url('assets/js/dataTables/jquery.dataTables.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/dataTables/dataTables.bootstrap4.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/dataTables/dataTables.buttons.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/dataTables/buttons.bootstrap4.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/dataTables/jszip.min.js')?>"></script>
<!--<script type="text/javascript" src="--><?//=base_url('assets/js/dataTables//vfs_fonts.js')?><!--"></script>-->
<script type="text/javascript" src="<?=base_url('assets/js/dataTables/buttons.html5.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/js/dataTables/buttons.colVis.min.js')?>"></script>

<?
if ($this->uri->segment('3') == 'fleet_history') {
	echo '<script src="https://code.highcharts.com/highcharts.js"></script>';
}

$time = strtotime(mdate('%Y-%m-%d', now()));
?>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-secondary" id="exampleModalLabel">Changes</h5>
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

	<div class="container-fluid">
		<div class="row">

			<div class="col-sm-3" style="">

			</div>

			<div class="col-sm-4">
				<div class="row">
					<div class="input-group mb-3 col-sm-7">
						<input id="sb_s" type="text" class="form-control" placeholder="<?=lang('search')?>" aria-label="Search" aria-describedby="basic-addon2">
						<div class="input-group-append">
							<span class="input-group-text" id="basic-addon2"><i class="fas fa-search"></i></span>
						</div>
					</div>
					<div class="col-sm-5">
						<div class="row">
							<div class="col-sm-56 form-group form-check pt-1">
								<input type="checkbox" class="select_all form-check-input" id="exampleCheck1">
								<label class="form-check-label" for="exampleCheck1"><?=lang('select_all')?></label>
							</div>
							<div class="col-sm-6 form-group form-check pt-1 text-center">
								<button class="btn btn-sm btn-outline-secondary p-1 delete_all"><i class="fas fa-trash"></i></button>
								<label class="form-check-label" for=""><?=lang('delete')?></label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-1"></div>
			<div class="col-sm-4" >
				<div class="row">
					<div class="input-group mb-3 col-sm-7">
						<input id="sb_s_2" type="text" class="form-control" placeholder="<?=lang('search')?>" aria-label="Search" aria-describedby="basic-addon2">
						<div class="input-group-append">
							<span class="input-group-text" id="basic-addon2"><i class="fas fa-search"></i></span>
						</div>
					</div>
					<div class="col-sm-5">
						<div class="row">
							<div class="col-sm-56 form-group form-check pt-1">
								<input type="checkbox" class="select_all_2 form-check-input" id="exampleCheck2">
								<label class="form-check-label" for="exampleCheck2"><?=lang('select_all')?></label>
							</div>
							<div class="col-sm-6 form-group form-check pt-1 text-center">
								<button class="btn btn-sm btn-outline-secondary p-1 delete_all_2"><i class="fas fa-trash"></i></button>
								<label class="form-check-label" for="exampleCheck1-2"><?=lang('delete')?></label>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

		<div class="row" style="margin-top: -12px;">
			<div class="col-sm-3 p-0" >
				<div id="myDiagramDiv" style="border: 10px solid #00000040;height: 500px; width: 100%;"></div>
				<textarea id="mySavedModel" style="display:none;">
				{"class": "go.TreeModel",
		  			"nodeDataArray": <?= $structure ?>
				}
    			</textarea>
				<script src="chrome-extension://gppongmhjkpfnbhagpmjfkannfbllamg/js/inject.js"></script>
			</div>
			<div class="col-sm-4"
				 style="border: 10px solid #00000040;border-left: none; border-right: none;max-height: 520px; overflow-y: scroll;">
				<ul style="list-style: decimal;" class="list-group lg_1 mt-1">
					<h2 class="text-center" style="opacity: .5;color: gray;margin-top: 40%;" ><?=lang('select_fleets_from_list')?></h2>
				</ul>
			</div>
			<div class="col-sm-1 text-center" style="border: 10px solid #00000040;">
				<button class="save_cancel_btn btn btn-success mb-1 p-0 add_lg_2" style="margin-top: 200px;"><i
						style="font-size: 30px;" class="fas fa-long-arrow-alt-right"> </i></button>
				<button class="save_cancel_btn btn btn-success p-0 remove_lg_2"><i style="font-size: 30px;"
																				   class="fas fa-long-arrow-alt-left"> </i>
				</button>
			</div>
			<div class="col-sm-4"
				 style="border: 10px solid #00000040; border-left: none;max-height: 520px; overflow-y: scroll;">
				<ul style="list-style-type: decimal;" class="list-group lg_2 mt-1">
					<h2 class="text-center" style="opacity: .5;color: gray;margin-top: 40%;" ><?=lang('move_here_to_see_the_costs')?></h2>
				</ul>
			</div>
		</div>
	</div>

	<span class="selected_information "></span>


	<div id="add-info" style="<?= $this->uri->segment(3) == '' ? 'display: none' : '' ?>">
		<nav class="mt-2">
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a class="nav-item nav-link tab_nav "
				   data-tab="1" id="nav-1-tab"
				   data-toggle="tab" href="#nav-1"
				   role="tab" aria-controls="nav-1"
				   aria-selected="true"><?=lang('inspection')?></a>

				<a class="nav-item nav-link tab_nav"
				   data-tab="2" id="nav-2-tab"
				   data-toggle="tab" href="#nav-2"
				   role="tab" aria-controls="nav-2"
				   aria-selected="false"><?=lang('fuel_consumption')?></a>

				<a class="nav-item nav-link tab_nav"
				   data-tab="3" id="nav-3-tab"
				   data-toggle="tab" href="#nav-3"
				   role="tab" aria-controls="nav-3"
				   aria-selected="false"><?=lang('fine')?></a>

				<a class="nav-item nav-link tab_nav"
				   data-tab="4" id="nav-4-tab"
				   data-toggle="tab" href="#nav-4"
				   role="tab" aria-controls="nav-4"
				   aria-selected="false"><?=lang('accident')?></a>

				<a class="nav-item nav-link tab_nav"
				   data-tab="5" id="nav-5-tab"
				   data-toggle="tab" href="#nav-5"
				   role="tab" aria-controls="nav-5"
				   aria-selected="false"><?=lang('insurance')?></a>

				<a class="nav-item nav-link tab_nav"
				   data-tab="6" id="nav-6-tab"
				   data-toggle="tab" href="#nav-6"
				   role="tab" aria-controls="nav-6"
				   aria-selected="false"><?=lang('spares')?></a>

				<a class="nav-item nav-link tab_nav"
				   data-tab="7" id="nav-7-tab"
				   data-toggle="tab" href="#nav-7"
				   role="tab" aria-controls="nav-7"
				   aria-selected="false"><?=lang('repair')?></a>

				<a class="nav-item nav-link tab_nav"
				   data-tab="8" id="nav-8-tab"
				   data-toggle="tab" href="#nav-8"
				   role="tab" aria-controls="nav-8"
				   aria-selected="false"><?=lang('wheel')?></a>

				<a class="nav-item nav-link tab_nav"
				   data-tab="9" id="nav-9-tab"
				   data-toggle="tab" href="#nav-9"
				   role="tab" aria-controls="nav-9"
				   aria-selected="false"><?=lang('brake')?></a>

				<a class="nav-item nav-link tab_nav"
				   data-tab="10" id="nav-10-tab"
				   data-toggle="tab" href="#nav-10"
				   role="tab" aria-controls="nav-10"
				   aria-selected="false"><?=lang('grease')?></a>

				<a class="nav-item nav-link tab_nav"
				   data-tab="11" id="nav-11-tab"
				   data-toggle="tab" href="#nav-11"
				   role="tab" aria-controls="nav-11"
				   aria-selected="false"><?=lang('filter')?></a>

				<a class="nav-item nav-link tab_nav"
				   data-tab="12" id="nav-12-tab"
				   data-toggle="tab" href="#nav-12"
				   role="tab" aria-controls="nav-12"
				   aria-selected="false"><?=lang('battery')?></a>

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
					<span class="p-3"><?=lang('from')?></span>
					<input type="date" value="<?= date("Y-m-d", strtotime("-1 month", $time)); ?>" name="from"
						   style="border: 1px solid silver;padding: 4px 2px 4px 10px;border-radius: 5px;"/>

					<span class="p-3"><?=lang('to')?></span>
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
							class="ml-2 save_cancel_btn btn btn-success"><?=lang('see')?>
					</button>
				</div>
			</div>

		</div><?

		if ($this->uri->segment('3') == 'fleet_history') { ?>

			<hr class="my-2">

			<div class="container-fluid" style="min-height: 35px;">


				<div style="float: right;">
					<span class="p-3"><?=lang('from')?></span>
					<input type="date" value="<?= date("Y-m-d", strtotime("-1 month", $time)); ?>" name="from"
						   style="border: 1px solid silver;padding: 4px 2px 4px 10px;border-radius: 5px;"/>

					<span class="p-3"><?=lang('to')?></span>
					<input type="date" value="<?= mdate('%Y-%m-%d', now()) ?>" name="to"
						   style="border: 1px solid silver;padding: 4px 2px 4px 10px;;border-radius: 5px;"/>

					<button style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 10px 24px !important;
    font-weight: 500 !important;margin-top: -4px;min-height: 37px !important;" type="button" id="search"
							class="ml-2 save_cancel_btn btn btn-success"><?=lang('see')?>
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
		/*Diagram Trees Start*/


		// This button assumes data binding to the "checked" property.
		go.GraphObject.defineBuilder("TriStateCheckBoxButton", function (args) {
			var button = /** @type {Panel} */ (
				go.GraphObject.make("Button",
					{
						"ButtonBorder.fill": "white",
						"ButtonBorder.stroke": "gray",
						width: 14,
						height: 14,
						margin: 10
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

						new go.Binding("stroke", "checked", function (p) {
							return p === null ? null : "black";
						})
					)
				)
			);


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


				// support extra side-effects without clobbering the click event handler:
				if (typeof button["_doClick"] === "function") button["_doClick"](e, button);

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
						doubleClick: function (e, node) {
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
							new go.Binding("text", "name", function (s) {
								return " " + s;
							})),
						$(go.TextBlock,
							{
								font: 'bold ,9pt Verdana, sans-serif',
								margin: new go.Margin(5, 5, 0, 2),
								stroke: "#607d8b"
							},

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

		function load() {
			myDiagram.model = go.Model.fromJson(document.getElementById("mySavedModel").value);
		}

		$(document).ready(function () {
			init();
			robot = new Robot(myDiagram);

			function dragSelectNodes(dd) {
				var alpha = myDiagram.findNodeForKey(dd);
				if (alpha === null) return;

				alpha.isSelected = true;

			}


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
					myDiagram.selection.each(function (part) {

						if (part instanceof go.Node) {
							arr = {
								"key": part.Wd.key,
								"name": part.Wd.name,
								"title": part.Wd.title,
								"parent": part.Wd.parent
							};
							new_arr.push(arr);
						}


					});

					console.table(new_arr);

					var lg_1 = '';
					$.each(new_arr, function (key, value) {
						$('.added_lg_2').each(function () {
							var data_key = $(this).data('key');

							if(data_key == value.key){
								value.key = '';
							}

						});
						var str2 = value.key;
						var re2 = 'f';
						var found2 = str2.match(re2);

						if (found2 == 'f') {
							lg_1 += '<li style="cursor: pointer" class="sel_items mt-1 list-group-item" data-key="' + value.key + '" data-parent="' + value.parent + '">' + value.name +'</li>';
						}
					});

					$('.lg_1').html(lg_1);


				})
		});


		/*********************************************************/

		$(document).on('click', '.sel_items', function () {
			if ($(this).hasClass('bg-info')) {
				$(this).removeClass('bg-info text-white');
			} else {
				$(this).addClass('bg-info text-white')
			}
		});

		var array = [];
		$(document).on('click', '.added_lg_2', function () {

			array = [];
			if ($(this).hasClass('bg-info')) {
				$(this).removeClass('bg-info text-white');
			} else {
				$(this).addClass('bg-info text-white');
			}
			$('.added_lg_2').each(function () {
				if ($(this).hasClass('bg-info')) {
					arr = {
						'key': $(this).data('key'),
						'name': $(this).text()
					};
					array.push(arr)
				}
			});
			//console.table(array)

			if ($('a[data-id="1"]').hasClass('active')) {
				if (array.length !== 0) {
					console.table(array);
					$('.selected_information').html('<img style="z-index: 999; position: fixed; left: 50%; width: 10em" src="<?=base_url('/assets/images/puff.svg')?>">');
					var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/car_info')?>';
					$.post(url, {arr: array}).done(function (data) {
						console.log(data);
						$('.selected_information').html(data);
						$('#nav-tabContent-car').fadeIn('slow');
					});


				}
			} else if ($('a[data-id="2"]').hasClass('active')) {
				$('.selected_information').html('');

				var url_1 = '';
				$('.tab_nav').each(function () {
					if ($(this).data('tab') == 1 && $(this).hasClass('active')) {
						url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_inspection')?>';
						vehicle_add(array, url_1, $(this).data('tab'))
					} else if ($(this).data('tab') == 2 && $(this).hasClass('active')) {
						url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_fuel')?>';
						vehicle_add(array, url_1, $(this).data('tab'))
					} else if ($(this).data('tab') == 3 && $(this).hasClass('active')) {
						url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_fine')?>';
						vehicle_add(array, url_1, $(this).data('tab'))
					} else if ($(this).data('tab') == 4 && $(this).hasClass('active')) {
						url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_accident')?>';
						vehicle_add(array, url_1, $(this).data('tab'))
					} else if ($(this).data('tab') == 5 && $(this).hasClass('active')) {
						url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_insurance')?>';
						vehicle_add(array, url_1, $(this).data('tab'))
					} else if ($(this).data('tab') == 6 && $(this).hasClass('active')) {
						url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_spares')?>';
						vehicle_add(array, url_1, $(this).data('tab'))
					} else if ($(this).data('tab') == 7 && $(this).hasClass('active')) {
						url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_repair')?>';
						vehicle_add(array, url_1, $(this).data('tab'))
					} else if ($(this).data('tab') == 8 && $(this).hasClass('active')) {
						url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_wheel')?>';
						vehicle_add(array, url_1, $(this).data('tab'))
					} else if ($(this).data('tab') == 9 && $(this).hasClass('active')) {
						url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_brake')?>';
						vehicle_add(array, url_1, $(this).data('tab'))
					} else if ($(this).data('tab') == 10 && $(this).hasClass('active')) {
						url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_grease')?>';
						vehicle_add(array, url_1, $(this).data('tab'))
					} else if ($(this).data('tab') == 11 && $(this).hasClass('active')) {
						url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_filter')?>';
						vehicle_add(array, url_1, $(this).data('tab'))
					} else if ($(this).data('tab') == 12 && $(this).hasClass('active')) {
						url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_battery')?>';
						vehicle_add(array, url_1, $(this).data('tab'))
					}
				});

			}else if ($('a[data-id="3"]').hasClass('active')) {
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
					data: {date_from: date_from, date_to: date_to, table: table, arr: array},
					async: true,
					dataType: "json",
					success: function (data) {
						chartCircle(data, title);
						chart(data, title);
					}
				});
			} else {
				$('.selected_information').html('');
			}

		});

		if ($('a[data-id="2"]').hasClass('active')) {

			$('.tab_nav').click(function () {
				if ($(this).data('tab') == 1) {
					url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_inspection')?>';
					vehicle_add(array, url_1, $(this).data('tab'))
				} else if ($(this).data('tab') == 2) {
					url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_fuel')?>';
					vehicle_add(array, url_1, $(this).data('tab'))
				} else if ($(this).data('tab') == 3) {
					url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_fine')?>';
					vehicle_add(array, url_1, $(this).data('tab'))
				} else if ($(this).data('tab') == 4) {
					url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_accident')?>';
					vehicle_add(array, url_1, $(this).data('tab'))
				} else if ($(this).data('tab') == 5) {
					url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_insurance')?>';
					vehicle_add(array, url_1, $(this).data('tab'))
				} else if ($(this).data('tab') == 6) {
					url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_spares')?>';
					vehicle_add(array, url_1, $(this).data('tab'))
				} else if ($(this).data('tab') == 7) {
					url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_repair')?>';
					vehicle_add(array, url_1, $(this).data('tab'))
				} else if ($(this).data('tab') == 8) {
					url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_wheel')?>';
					vehicle_add(array, url_1, $(this).data('tab'))
				} else if ($(this).data('tab') == 9) {
					url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_brake')?>';
					vehicle_add(array, url_1, $(this).data('tab'))
				} else if ($(this).data('tab') == 10) {
					url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_grease')?>';
					vehicle_add(array, url_1, $(this).data('tab'))
				} else if ($(this).data('tab') == 11) {
					url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_filter')?>';
					vehicle_add(array, url_1, $(this).data('tab'))
				} else if ($(this).data('tab') == 12) {
					url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_battery')?>';
					vehicle_add(array, url_1, $(this).data('tab'))
				}
			});

			$(document).on('click', 'button#search', function () {
				var url_2 = $(this).data('url');
				var dataTab = $(this).data('tab');
				vehicle_add(new_arr, url_2, dataTab);
			});


		} else if ($('a[data-id="3"]').hasClass('active')) {


			function chart(data, title) {

				Highcharts.chart('container', {
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
									click: function () {

										var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/getHistoryCircle_ax')?>';
										var date = this.category;
										var table = data.table;
										var title = $('.tab_nav.active').text();

										$.ajax({
											url: url,
											type: 'POST',
											data: {date: date, table: table, arr: new_arr},
											async: true,
											dataType: "json",
											success: function (data) {
												chartCircle(data, title);
											}
										});

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

			}

			/*
            *
            * Second Chart Start
            *
            */

			Highcharts.setOptions({
				colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
					return {
						radialGradient: {
							cx: 0.5,
							cy: 0.3,
							r: 0.7
						},
						stops: [
							[0, color],
							[1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
						]
					};
				})
			});

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

										if(!this.selected) {

											var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/getHistorySingle_ax')?>';
											var date_from = $('input[name="from"]').val();
											var date_to = $('input[name="to"]').val();
											var table = this.table;
											var fleet_id = this.fleet_id;
											var fleet_name = this.name;
											$.ajax({
												url: url,
												type: 'POST',
												data: {date_from: date_from, date_to: date_to, table: table, fleet_id: fleet_id, fleet_name: fleet_name},
												async: true,
												dataType: "json",
												success: function (data) {
													chart(data, fleet_name);
												}
											});
										} else {

											var date_from = $('input[name="from"]').val();
											var date_to = $('input[name="to"]').val();
											var table = this.table;
											var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/getHistory_ax')?>';

											$.ajax({
												url: url,
												type: 'POST',
												data: {date_from: date_from, date_to: date_to, table: table, arr: array},
												async: true,
												dataType: "json",
												success: function (data) {
													chart(data, title);
												}
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
						data: {date_from: date_from, date_to: date_to, table: table, arr: array},
						async: true,
						dataType: "json",
						success: function (data) {
							chartCircle(data, title);
							chart(data, title);
						}
					});
				}


			})
		}


		$(document).on('click', '.add_lg_2', function () {
			$('.lg_2 h2').css('display','none');
			$('.sel_items').each(function () {
				if ($(this).hasClass('bg-info')) {
					$('.lg_2').append(this);
					$(this).addClass('added_lg_2');
					$(this).remove('.list-group');
					$(this).removeClass('bg-info text-white sel_items');
				}
			});



			$('.select_all').prop('checked', false);

		});


		$(document).on('click', '.remove_lg_2', function () {
			$('.added_lg_2').each(function () {
				if ($(this).hasClass('bg-info')) {
					$('.lg_1').append(this);
					$(this).remove('.lg_2');
					$(this).removeClass('bg-info text-white added_lg_2');
					$(this).addClass('sel_items');
					$('#nav-tabContent-car').remove();
					$('.tab-pane').children('form').remove();
				}
			});

			$('.select_all_2').prop('checked', false);

		});


		$('.select_all').on('change', function () {
			if($('.select_all').is(':checked')){
				$('.sel_items').addClass('bg-info text-white')
			}else{
				$('.sel_items').removeClass('bg-info text-white');
			}
		});

		$('.delete_all').click(function () {
			$('.sel_items').remove();

			$('.lg_1').html('<h2 class="text-center" style="opacity: .4;color: gray;margin-top: 40%;" ><?=lang('select_fleets_from_list')?></h2>');
		});

		/***************************************************************/
		$('.select_all_2').on('change', function () {
			if($('.select_all_2').is(':checked')){
				$('.added_lg_2').each(function () {
					if (!$(this).hasClass('bg-info text-white')) {
						$(this).trigger('click');
					}
				});
			}else{
				$('.added_lg_2').each(function () {
					if ($(this).hasClass('bg-info text-white')) {
						$(this).trigger('click');
					}
				});
			}
		});

		$('.delete_all_2').click(function () {
			$('.added_lg_2').remove();
			$('#nav-tabContent-car').remove();
			$('.tab-pane').children('form').remove();
			$('.lg_2').html('<h2 class="text-center" style="opacity: .4;color: gray;margin-top: 40%;" ><?=lang('move_here_to_see_the_costs')?></h2>')
		});


		/**********************************************************/

		/* Search Start */

		$(function () {
			$('#sb_s').keyup(function () {
				var val = $(this).val().toLowerCase();
				$(".sel_items ").hide();
				$(".sel_items").each(function () {
					var text = $(this).text().toLowerCase();
					if (text.indexOf(val) != -1) {
						$(this).show();
					}
				});
			});

		});

		$(function () {
			$('#sb_s_2').keyup(function () {
				var val = $(this).val().toLowerCase();
				$(".added_lg_2 ").hide();
				$(".added_lg_2").each(function () {
					var text = $(this).text().toLowerCase();
					if (text.indexOf(val) != -1) {
						$(this).show();
					}
				});
			});

		});


		/* Search End */




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
				}
			});

			$.post(url_1, {arr: new_arr, date_from: date_from, date_to: date_to}).done(function (data) {
				$('.tab-pane').each(function () {
					if ($(this).data('tab') == dataTab) {
						$(this).html(data);
						$("td[valign='top']").parent('tr').remove();
						$('button#search').data('tab', dataTab);
						$('button#search').data('url', url_1);

						if(data != '') {
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
