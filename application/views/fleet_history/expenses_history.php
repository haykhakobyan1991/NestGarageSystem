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
<script src="https://code.highcharts.com/highcharts.js"></script>

<?
$time = strtotime(mdate('%Y-%m-%d', now()));
?>

<style>
	.row.bg-secondary {
		min-height: 194px;
	}

	.modal {
		top: 30% !important;
	}

</style>


<div id="add-info">


	<hr class="my-2">

	<div class="container-fluid" style="min-height: 35px;">


		<div style="float: right;">
			<span class="p-3">from</span>
			<input type="date" value="<?= date("Y-m-d", strtotime("-1 month", $time)); ?>" name="from"
				   style="border: 1px solid silver;padding: 4px 2px 4px 10px;border-radius: 5px;"/>

			<span class="p-3">to</span>
			<input type="date" value="<?= mdate('%Y-%m-%d', now()) ?>" name="to"
				   style="border: 1px solid silver;padding: 4px 2px 4px 10px;;border-radius: 5px;"/>

			<button style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 10px 24px !important;
    font-weight: 500 !important;margin-top: -4px;min-height: 37px !important;" type="button" id="search"
					class="ml-2 save_cancel_btn btn btn-success">Տեսնել
			</button>
		</div>


	</div>

	<hr class="my-2">

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div id="container" style="width:100%; height:auto;"></div>
			</div>

	</div>

</div>

<script>

	$(document).ready(function () {


		$(document).on('click', '#search', function (e) {
			var url = '<?=base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/Fleet_history/getHistoryAll_ax')?>';
			var date_from = $('input[name="from"]').val();
			var date_to = $('input[name="to"]').val();


			$.ajax({
				url: url,
				type: 'POST',
				data: {from: date_from, to: date_to},
				async: true,
				dataType: "json",
				success: function (data) {
					$('#container').html(data);
				}
			});




		})

	});


	Highcharts.chart('container', {

		chart: {
			type: 'column'
		},

		title: {
			text: 'Total fruit consumtion, grouped by gender'
		},

		xAxis: {
			categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
		},

		yAxis: {
			allowDecimals: false,
			min: 0,
			title: {
				text: 'Number of fruits'
			}
		},

		tooltip: {
			formatter: function () {
				return '<b>' + this.x + '</b><br/>' +
					this.series.name + ': ' + this.y + '<br/>' +
					'Total: ' + this.point.stackTotal;
			}
		},

		plotOptions: {
			column: {
				stacking: 'normal'
			}
		},

		series: [{
			name: 'John',
			data: [21, 21, 21, 12, 12],
			stack: 'male'
		}, {
			name: 'Joe',
			data: [21, 21, 21, 2, 21],
			stack: 'male'
		}, {
			name: 'Jane',
			data: [21, 21, 21, 21, 12],
			stack: 'female'
		}, {
			name: 'Janet',
			data: [21, 21, 21, 0, 21],
			stack: 'female'
		}]
	});

</script>
