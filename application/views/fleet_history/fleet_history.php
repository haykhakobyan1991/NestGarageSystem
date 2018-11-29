<link rel="stylesheet" href="<?= base_url() ?>assets/css/structure1.css"/>
<script src="https://code.highcharts.com/highcharts.js"></script>
<!--[if lt IE 9]>
<script src="https://code.highcharts.com/modules/oldie.js"></script>
<![endif]-->
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

				<a class="nav-item nav-link" id="nav-5-tab" data-toggle="tab" href="#nav-5" role="tab"
				   aria-controls="nav-5"
				   aria-selected="false">ԱՊԱՀՈՎԱԳՐՈՒԹՅՈՒՆ</a>

				<a class="nav-item nav-link" id="nav-6-tab" data-toggle="tab" href="#nav-6" role="tab"
				   aria-controls="nav-6"
				   aria-selected="false">ՊԱՀԵՍՏԱՄԱՍԵՐ</a>

				<a class="nav-item nav-link" id="nav-7-tab" data-toggle="tab" href="#nav-7" role="tab"
				   aria-controls="nav-7"
				   aria-selected="false">ՎԵՐԱՆՈՐՈԳՈՒՄ</a>


				<a class="nav-item nav-link" id="nav-8-tab" data-toggle="tab" href="#nav-8" role="tab"
				   aria-controls="nav-8"
				   aria-selected="false">ԱՆՎԱԴՈՂ</a>
				<a class="nav-item nav-link" id="nav-9-tab" data-toggle="tab" href="#nav-9" role="tab"
				   aria-controls="nav-9"
				   aria-selected="false">ԱՐԳԵԼԱԿ</a>
				<a class="nav-item nav-link" id="nav-10-tab" data-toggle="tab" href="#nav-10" role="tab"
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
	</div>

	<hr class="my-2">

	<div class="container-fluid" style="min-height: 35px;">


			<div style="float: right;">
				<span class="p-3">from</span>
				<input type="date"  style="border: 1px solid silver;padding: 4px 2px 4px 10px;border-radius: 5px;"/>

				<span class="p-3">to</span>
				<input type="date"  style="border: 1px solid silver;padding: 4px 2px 4px 10px;;border-radius: 5px;"/>

				<button style="min-width: 94px;font-size: 14px !important;
    line-height: 14px !important;
    padding: 10px 24px !important;
    font-weight: 500 !important;margin-top: -4px;min-height: 37px !important;" type="button" class="ml-2 save_cancel_btn btn btn-success">Տեսնել
				</button>
			</div>




	</div>

	<hr class="my-2"> 

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-8">
				<div id="container" style="width:100%; height:400px;"></div>
			</div>
			<div class="col-sm-4">
				<div id="container_2" style="width:100%; height:400px;"></div>
			</div>
		</div>
	</div>



	<script>
	
	Highcharts.chart('container', {
		chart: {
			type: 'area'
		},
		title: {
			text: 'US and USSR nuclear stockpiles'
		},
		subtitle: {
			text: 'Sources: <a href="https://thebulletin.org/2006/july/global-nuclear-stockpiles-1945-2006">' +
					'thebulletin.org</a> &amp; <a href="https://www.armscontrol.org/factsheets/Nuclearweaponswhohaswhat">' +
					'armscontrol.org</a>'
		},
		xAxis: {
			categories: [
								'<?=lang('month_1') ?>',
								'<?=lang('month_2') ?>',
								'<?=lang('month_3') ?>',
								'<?=lang('month_4') ?>',
								'<?=lang('month_5') ?>',
								'<?=lang('month_6') ?>',
								'<?=lang('month_7') ?>',
								'<?=lang('month_8') ?>',
								'<?=lang('month_9') ?>',
								'<?=lang('month_10') ?>',
								'<?=lang('month_11') ?>',
								'<?=lang('month_12') ?>'
							]
		},
		yAxis: {
			main: 0,
			title: {
					text: 'Nuclear weapon states'
			}
		},
		tooltip: {
			pointFormat: '{series.name} had stockpiled <b>{point.y:,.0f}</b><br/>warheads in {point.x}'
		},
	
		series: [{
			name: 'USA',
			data: [
					400, 300, 350, 200, 150, 6, 11, 32, 110, 235,
					369, 640
			]
		}]
	});



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

// Build the chart
Highcharts.chart('container_2', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Browser market shares in January, 2018'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                },
                connectorColor: 'silver'
            }
        }
    },
    series: [{
        name: 'Share',
        data: [
            { name: 'Chrome', y: 61.41 },
            { name: 'Internet Explorer', y: 11.84 },
            { name: 'Firefox', y: 10.85 },
            { name: 'Edge', y: 4.67 },
            { name: 'Safari', y: 4.18 },
            { name: 'Other', y: 7.05 }
        ]
    }]
});


</script>

