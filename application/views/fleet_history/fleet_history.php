<?
$time = strtotime(mdate('%Y-%m-%d', now()));
?>


<link rel="stylesheet" href="<?= base_url() ?>assets/css/structure1.css"/>
<script src="https://code.highcharts.com/highcharts.js"></script>
<!--[if lt IE 9]>
<script src="https://code.highcharts.com/modules/oldie.js"></script>
<![endif]-->
<style>
	.highcharts-plot-border {
		stroke: transparent !important;
	}
</style>
<div class="content m-1">
	<div class="content m-1">
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
			<a class="info-type nav-item nav-link nav_a mr-2 btn btn-sm btn-outline-success2 showed <?= ($this->uri->segment(3) == '' && $this->router->fetch_class() == 'Structure') ? 'active show' : '' ?> "
			   data-id="1"
			   href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/structure1') ?>"
			   role="tab">
				<i class="fas fa-info"></i> Ինֆորմացիա
			</a>
			<a class="info-type nav-item nav-link nav_a mr-2 btn btn-sm btn-outline-success2 showed  <?= ($this->uri->segment(3) != '' && $this->router->fetch_class() == 'Structure') ? 'active show' : '' ?> "
			   data-id="2"
			   href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/structure1/add_expenses') ?>"
			   role="tab">
				<i class="fas fa-plus"></i> Ավելացնել ծախսեր
			</a>
			<a class="info-type nav-item nav-link nav_a mr-2  btn btn-sm btn-outline-success2 showed <?= ($this->router->fetch_method() == 'fleet_history') ? 'active show' : '' ?>"
			   data-id="3"
			   data-toggle=""
			   href="<?= base_url(($this->uri->segment(1) != '' ? $this->uri->segment(1) : $this->load->default_lang()) . '/fleet_history') ?>"
			   role="tab">
				<i class="fas fa-clipboard-list"></i> Ծաղսերի պատմություն
			</a>
		</div>
	</div>

	<hr class="my-2">

	<div class="container-fluid">
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


				<a class="nav-item nav-link tab_nav"
				   data-tab="12" id="nav-13-tab"
				   data-toggle="tab" href="#nav-13"
				   role="tab" aria-controls="nav-13"
				   aria-selected="false">ԱՀԱԶԱՆԳ</a>
			</div>
		</nav>
	</div>

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
			<div class="col-sm-7">
				<div id="container" style="width:100%; height:500px;"></div>
			</div>
			<div class="col-sm-5">
				<div id="container_2" style="width:100%; height:500px;"></div>
			</div>
		</div>
	</div>


	<script>

		function chart(data, title) {

			Highcharts.chart('container', {
				chart: {
					scrollablePlotArea: {
						minWidth: 700
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
				data: {date_from: date_from, date_to: date_to, table: table},
				async: true,
				dataType: "json",
				success: function (data) {
					chartCircle(data, title);
					chart(data, title);
				}
			});


		})


	</script>

