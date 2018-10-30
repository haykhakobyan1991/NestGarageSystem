<!-- Structure Start -->
<style>
	.google-visualization-orgchart-node {
		border: none;
	}

	td.google-visualization-orgchart-node.google-visualization-orgchart-node-medium img, td.google-visualization-orgchart-node.google-visualization-orgchart-node-medium.google-visualization-orgchart-nodesel img {
		display: block;
		margin: 0 auto;
		width: 30px;
		height: 30px;
	}

	tbody {
		transform: scale(0.9);
	}
</style>
<link href="<?= base_url('assets/css/jquery.ui.min.css') ?>"/>


<div class="jumbotron jumbotron-fluid pb-2 pt-2">
	<div class="">
		<p class="display-5 font-weight-bold mb-0 pl-3">Structure</p>
	</div>
	<div class="row" style="margin-left: 0;margin-right: 0;">
		<div class="col-sm-6 col-md-6" id="dr"
			 style="border: 1px solid #000;min-height: 450px;overflow: hidden;cursor:grab;-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;position: relative;"
			 unselectable="on" onselectstart="return false;" onmousedown="return false;">
			<div id="chart_div" style="z-index: 999;"></div>
			<div style="position:absolute; left: 0;bottom: 0;padding:3px;background: #8e8f902e;">
				<p style="font-size: 10px;margin:0;">For default scale press Ctrl + 0</p>
				<p style="font-size: 10px;margin:0;">For Zoom In Ctrl + Mouse Scroll Down</p>
				<p style="font-size: 10px;margin:0;">For Zoom Out Ctrl + Mouse Scroll Up</p>
			</div>
		</div>


		<div class="col-sm-6 col-md-6" id="dr"
			 style="border: 1px solid #000;max-height: 600px;overflow: hidden;cursor:grab;-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;position: relative;"
			 unselectable="on" onselectstart="return false;" onmousedown="return false;">
			<div id="chart_div" style="z-index: 999;"></div>
			<div style="position:absolute; left: 0;bottom: 0;padding:3px;background: #8e8f902e;">
				<p style="font-size: 10px;margin:0;">For default scale press Ctrl + 0</p>
				<p style="font-size: 10px;margin:0;">For Zoom In Ctrl + Mouse Scroll Down</p>
				<p style="font-size: 10px;margin:0;">For Zoom Out Ctrl + Mouse Scroll Up</p>
			</div>
		</div>
	</div>


</div>

<script src="<?= base_url('assets/js/google_chart.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.ui.min.js') ?>"></script>

<script type="text/javascript">
	google.charts.load('current', {packages: ["orgchart"]});
	google.charts.setOnLoadCallback(drawChart);

	function drawChart() {
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Name');
		data.addColumn('string', 'Manager');
		data.addColumn('string', 'ToolTip');

		// For each orgchart box, provide the name, manager, and tooltip to show.
		data.addRows([
			[
				{v: '1', f: '1<input type="hidden" value="1" />'},
				'',
				''
			],

			[
				{v: '1.1', f: '1.1<input type="hidden" value="1.1" />'},
				{v: '1', f: '1<input type="hidden" value="1" />'},
				''
			],

			[
				{v: '1.2', f: '1.2<input type="hidden" value="1.2" />'},
				{v: '1', f: '1<input type="hidden" value="1" />'},
				''
			],

			[
				{v: '1.2.1', f: '1.2.1<input type="hidden" value="1.2.1" />'},
				{v: '1.2', f: '1.2<input type="hidden" value="1..2" />'},
				''
			],

			[
				{v: '1.2.2', f: '1.2.2<input type="hidden" value="1.2.2" />'},
				{v: '1.2', f: '1.2<input type="hidden" value="1.2" />'},
				''
			],

			[
				{v: '1.2.2.1', f: '1.2.2.1<input type="hidden" value="1.2.2.1" />'},
				{v: '1.2.2', f: '1.2.2<input type="hidden" value="1.2.2" />'},
				''
			],

			[
				{v: '1.2.2.2', f: '1.2.2.2<input type="hidden" value="1.2.2.2" />'},
				{v: '1.2.2', f: '1.2.2<input type="hidden" value="1.2.2" />'},
				''
			],

			[
				{v: '1.2.2.3', f: '1.2.2.3<input type="hidden" value="1.2.2.3" />'},
				{v: '1.2.2', f: '1.2.2<input type="hidden" value="1.2.2" />'},
				''
			],

			[
				{v: '1.2.2.2.1', f: '1.2.2.2.1<input type="hidden" value="1.2.2.2.1" />'},
				{v: '1.2.2.2', f: '1.2.2.2<input type="hidden" value="1.2.2.2" />'},
				''
			],

			[
				{v: '1.2.2.2.2', f: '1.2.2.2.2<input type="hidden" value="1.2.2.2.2" />'},
				{v: '1.2.2.2', f: '1.2.2.2.2<input type="hidden" value="1.2.2.2" />'},
				''
			],

			[
				{v: '1.2.2.2.3', f: '1.2.2.2.3<input type="hidden" value="1.2.2.2.3" />'},
				{v: '1.2.2.2', f: '1.2.2.2<input type="hidden" value="1.2.2.2" />'},
				''
			],

			[
				{v: '1.2.3', f: '1.2.3<input type="hidden" value="1.2.3" />'},
				{v: '1.2', f: '1.2<input type="hidden" value="1.2" />'},
				''
			],

			[
				{v: '1.3', f: '1.3<input type="hidden" value="1.3" />'},
				{v: '1', f: '1<input type="hidden" value="1" />'},
				''
			],

			[
				{v: '1.3.1', f: '1.3.1<input type="hidden" value="1.3.1" />'},
				{v: '1.3', f: '1.3<input type="hidden" value="1.3" />'},
				''
			],

			[
				{v: '1.3.2', f: '1.3.2<input type="hidden" value="1.3.2" />'},
				{v: '1.3', f: '1.3<input type="hidden" value="1.3" />'},
				''
			],

			[
				{v: '1.1.1', f: '1.1.1<input type="hidden" value="1.1.1" />'},
				{v: '1.1', f: '1.1<input type="hidden" value="1.1" />'},
				''
			],

			[
				{v: '1.1.1.1', f: '1.1.1.1<input type="hidden" value="1.1.1.1" />'},
				{v: '1.1.1', f: '1.1.1<input type="hidden" value="1.1.1" />'},
				''
			],

			[
				{v: '1.1.1.2', f: '1.1.1.2<input type="hidden" value="1.1.1.2" />'},
				{v: '1.1.1', f: '1.1.1<input type="hidden" value="1.1.1" />'},
				''
			],

			[
				{v: '1.1.1.3', f: '1.1.1.3<input type="hidden" value="1.1.1.3" />'},
				{v: '1.1.1', f: '1.1.1<input type="hidden" value="1.1.1" />'},
				''
			],

			[
				{v: '1.1.1.4', f: '1.1.1.4<input type="hidden" value="1.1.1.4" />'},
				{v: '1.1.1', f: '1.1.1<input type="hidden" value="1.1.1" />'},
				''
			]

		]);

		// Create the chart.
		var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
		// Draw the chart, setting the allowHtml option to true for the tooltips.
		chart.draw(data, {allowHtml: true});
	}
</script>
<script>
	var zoomable = document.getElementById('chart_div');
	var content = document.getElementById('chart_div').getElementsByTagName('tbody');
	var zX = 0.9;
	$('body').on('keydown', function (e) {
		if (e.ctrlKey && (e.keyCode == 48 || e.keyCode == 96)) {
			$('tbody').css('transform', 'scale(0.9)');
			$('#chart_div').css({'left': '0', 'top': '0'});
			zX = 0.9;
		}
	});

	window.addEventListener('wheel', function (e) {
		var dir;
		if (!e.ctrlKey) {
			return;
		}
		dir = (e.deltaY > 0) ? 0.1 : -0.1;
		zX += dir;

		for (var i = 0; i < content.length; i++) {
			zoomable.getElementsByTagName('tbody')[i].style.transform = 'scale(' + zX + ')';
		}

		e.preventDefault();
		return;
	});


	$(document).ready(function () {
		$("#chart_div").draggable();
	});

	$(document).on('click', '.google-visualization-orgchart-node', function() {

		// Active Class google-visualization-orgchart-nodesel

		var ordering = $(this).children('input').val();

		var arr = ordering.split('.');

		console.log(arr);



	})

</script>
