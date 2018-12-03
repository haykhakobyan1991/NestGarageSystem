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
</style>
<script src="<?= base_url('assets/js/go.js') ?>"></script>
<script src="https://gojs.net/latest/extensions/Robot.js"></script>

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
						<input id="sb_s" type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
						<div class="input-group-append">
							<span class="input-group-text" id="basic-addon2"><i class="fas fa-search"></i></span>
						</div>
					</div>
					<div class="col-sm-5">
						<div class="row">
							<div class="col-sm-56 form-group form-check pt-1">
								<input type="checkbox" class="select_all form-check-input" id="exampleCheck1">
								<label class="form-check-label" for="exampleCheck1">Select all</label>
							</div>
							<div class="col-sm-6 form-group form-check pt-1 text-center">
								<button class="btn btn-sm btn-outline-secondary p-1 delete_all"><i class="fas fa-trash"></i></button>
								<label class="form-check-label" for="">delete</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-1"></div>
			<div class="col-sm-4" >
				<div class="row">
					<div class="input-group mb-3 col-sm-7">
						<input id="sb_s_2" type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
						<div class="input-group-append">
							<span class="input-group-text" id="basic-addon2"><i class="fas fa-search"></i></span>
						</div>
					</div>
					<div class="col-sm-5">
						<div class="row">
							<div class="col-sm-56 form-group form-check pt-1">
								<input type="checkbox" class="select_all_2 form-check-input" id="exampleCheck2">
								<label class="form-check-label" for="exampleCheck2">Select all</label>
							</div>
							<div class="col-sm-6 form-group form-check pt-1 text-center">
								<button class="btn btn-sm btn-outline-secondary p-1 delete_all_2"><i class="fas fa-trash"></i></button>
								<label class="form-check-label" for="exampleCheck1-2">delete</label>
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
					<h2 class="text-center" style="opacity: .5;color: gray;margin-top: 40%;" >Select Fleets from list</h2>
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
					<h2 class="text-center" style="opacity: .5;color: gray;margin-top: 40%;" >Move here to see the costs</h2>
				</ul>
			</div>
		</div>
	</div>

	<span class="selected_information "></span>





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
							lg_1 += '<li style="cursor: pointer" class="sel_items mt-1 list-group-item" data-key="' + value.key + '" data-parent="' + value.parent + '">' + value.name + '/' + value.title + '</li>';
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
					arr = {'key': $(this).data('key')};
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
			}





		});

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

			$('.lg_1').append('<h2 class="text-center" style="opacity: .4;color: gray;margin-top: 40%;" >Select Fleets from list</h2>');
		});

		/***************************************************************/
		$('.select_all_2').on('change', function () {
			if($('.select_all_2').is(':checked')){
				$('.added_lg_2').addClass('bg-info text-white')
			}else{
				$('.added_lg_2').removeClass('bg-info text-white');
			}
		});

		$('.delete_all_2').click(function () {
			$('.added_lg_2').remove();
			$('#nav-tabContent-car').remove();
			$('.lg_2').append('<h2 class="text-center" style="opacity: .4;color: gray;margin-top: 40%;" >Move here to see the costs</h2>')
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
	</script>
