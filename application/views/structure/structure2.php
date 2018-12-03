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
<!--<script type="text/javascript" src="--><? //=base_url('assets/js/dataTables//vfs_fonts.js')?><!--"></script>-->
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.html5.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/dataTables/buttons.colVis.min.js') ?>"></script>

<!-- Structure Start -->
<style>
	canvas{
		background: #fff;
	}

	.row.bg-secondary {
		min-height: 194px;
	}

	.modal {
		top: 30% !important;
	}
</style>
<script src="<?= base_url('assets/js/go.js') ?>"></script>
<div class="content m-1">
	<div class="jumbotron jumbotron-fluid pb-2 pt-2">


		<div id="sample">
			<div id="myDiagramDiv" style="background-color: #696969; border: solid 1px black; height: 500px"></div>
			<div>
				<div id="myInspector">

				</div>
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
			   aria-selected="true">ՏԵԽ ԶՆՆՈՒՄ</a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="2" id="nav-2-tab"
			   data-toggle="tab" href="#nav-2"
			   role="tab" aria-controls="nav-2"
			   aria-selected="false">ՎԱՌԵԼԻՔ</a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="3" id="nav-3-tab"
			   data-toggle="tab" href="#nav-3"
			   role="tab" aria-controls="nav-3"
			   aria-selected="false">ՏՈՒԳԱՆՔ</a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="4" id="nav-4-tab"
			   data-toggle="tab" href="#nav-4"
			   role="tab" aria-controls="nav-4"
			   aria-selected="false">ՊԱՏԱՀԱՐՆԵՐ</a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="5" id="nav-5-tab"
			   data-toggle="tab" href="#nav-5"
			   role="tab" aria-controls="nav-5"
			   aria-selected="false">ԱՊԱՀՈՎԱԳՐՈՒԹՅՈՒՆ</a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="6" id="nav-6-tab"
			   data-toggle="tab" href="#nav-6"
			   role="tab" aria-controls="nav-6"
			   aria-selected="false">ՊԱՀԵՍՏԱՄԱՍԵՐ</a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="7" id="nav-7-tab"
			   data-toggle="tab" href="#nav-7"
			   role="tab" aria-controls="nav-7"
			   aria-selected="false">ՎԵՐԱՆՈՐՈԳՈՒՄ</a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="8" id="nav-8-tab"
			   data-toggle="tab" href="#nav-8"
			   role="tab" aria-controls="nav-8"
			   aria-selected="false">ԱՆՎԱԴՈՂ</a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="9" id="nav-9-tab"
			   data-toggle="tab" href="#nav-9"
			   role="tab" aria-controls="nav-9"
			   aria-selected="false">ԱՐԳԵԼԱԿ</a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="10" id="nav-10-tab"
			   data-toggle="tab" href="#nav-10"
			   role="tab" aria-controls="nav-10"
			   aria-selected="false">ՔՍՈՒՔ</a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="11" id="nav-11-tab"
			   data-toggle="tab" href="#nav-11"
			   role="tab" aria-controls="nav-11"
			   aria-selected="false">ՖԻԼՏՐ</a>

			<a class="nav-item nav-link tab_nav"
			   data-tab="12" id="nav-12-tab"
			   data-toggle="tab" href="#nav-12"
			   role="tab" aria-controls="nav-12"
			   aria-selected="false">ՄԱՐՏԿՈՑ</a>

		</div>
	</nav>


	<div class="tab-content" id="nav-tabContent">

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

	</div>

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
					{ padding: 3, position: new go.Point(16, 0), margin: new go.Margin(0, 2, 0, 0), defaultAlignment: go.Spot.Center },
					new go.Binding("background", "isSelected", function(s) { return (s ? "lightblue" : "white"); }).ofObject(),
					$("TriStateCheckBoxButton"),
					$(go.TextBlock,
						{ font: '9pt Verdana, sans-serif', margin: new go.Margin(0, 2, 0, 2) },
						new go.Binding("text", "name", function(s) {
							return " " + s;
						})),
					$(go.TextBlock,
						{
							font: 'bold ,9pt Verdana, sans-serif',
							margin: new go.Margin(0, 5, 0, 2),
							stroke: "#607d8b"
						},

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
					}

				});


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

					$('.tab_nav').each(function () {
						if ($(this).data('tab') == 1 && $(this).hasClass('active')) {
							vehicle_inspection(new_arr);

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
						} else if ($(this).data('tab') == 11 && $(this).hasClass('active')) {
							vehicle_filter(new_arr)
						} else if ($(this).data('tab') == 12 && $(this).hasClass('active')) {
							vehicle_battery(new_arr)
						}
					});

				} else {
					$('.selected_information').html('');
				}

				/*Remove BoxShadow From HighCharts Pie Diagram*/
				$('.highcharts-text-outline').attr('stroke', '');
			});

		$('.tab_nav').click(function () {
			if ($(this).data('tab') == 1) {
				vehicle_inspection(new_arr)
				console.table(new_arr);
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
			} else if ($(this).data('tab') == 11) {
				vehicle_filter(new_arr)
			} else if ($(this).data('tab') == 12) {
				vehicle_battery(new_arr)
			}
		});


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

	function vehicle_filter(new_arr) {
		var url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_filter')?>';
		$.post(url_1, {arr: new_arr}).done(function (data) {
			$('.tab-pane').each(function () {
				if ($(this).data('tab') == 11) {
					$(this).html(data);
					$("td[valign='top']").parent('tr').remove();
				}
			});
		});
	}

	function vehicle_battery(new_arr) {
		var url_1 = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Structure/vehicle_battery')?>';
		$.post(url_1, {arr: new_arr}).done(function (data) {
			$('.tab-pane').each(function () {
				if ($(this).data('tab') == 12) {
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

