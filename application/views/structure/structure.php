<!-- Structure Start -->
<style>
	.google-visualization-orgchart-node {
		border: none;
	}

	td.google-visualization-orgchart-node.google-visualization-orgchart-node-medium img, td.google-visualization-orgchart-node.google-visualization-orgchart-node-medium.google-visualization-orgchart-nodesel img {
		display: block;
		margin: 0 auto;
	}
</style>


<div class="jumbotron jumbotron-fluid pb-2 pt-2">
	<div class="">
		<p class="display-5 font-weight-bold mb-0 pl-3">Structure</p>
	</div>

	<div id="chart_div" style="border: 1px solid #000;max-width: 600px;max-height: 400px;overflow: hidden;"></div>
</div>

<script src="<?= base_url('assets/js/google_chart.js') ?>"></script>

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
			[{v: 'Mike', f: 'Mike<img src="https://bit.ly/2OibmNa" style="width: 30px;height: 30px;">'}, '', ''],
			[{v: 'Jim', f: 'Jim<img src="https://bit.ly/2OibmNa" style="width: 30px;height: 30px;">'}, 'Mike', ''],
			[{v: 'Alice', f: 'Alice<img src="https://bit.ly/2OibmNa" style="width: 30px;height: 30px;">'}, 'Mike', ''],
			[{v: 'fff', f: 'fff<img src="https://bit.ly/2OibmNa" style="width: 30px;height: 30px;">'}, 'Alice', ''],
			['Alieeece', 'Alice', ''],
			['Alieefece', 'Alieeece', ''],
			['Alieeedce', 'Alieeece', ''],
			['Alieevece', 'Alieeece', ''],
			['pppp', 'Alieefece', ''],
			['gg', 'pppp', ''],
			['mm', 'gg', ''],
			['vfc', 'mm', ''],
			['vc', 'mm', ''],
			['Alifffce', 'Alice', ''],
			['Addddddlice', 'Mike', ''],
			['xxxxxx', 'Addddddlice', ''],
			['wwwwwwwwww', 'Addddddlice', ''],
			['Bob', 'Jim', 'Bob Sponge'],
			['Carol', 'Bob', ''],
			['jane', 'Bob', ''],
			['dddd', 'Bob', ''],
			['ZZZZ', 'Bob', '']
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
	var zX = 1;
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
</script>
