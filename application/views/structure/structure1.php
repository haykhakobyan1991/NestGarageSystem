<!-- Structure Start -->
<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
<script src="<?= base_url() ?>assets/js/table.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>
<script>
	$(document).ready(function () {
		for (i = 1; i < 14; i++) {
			$('#ex_' + i + '').DataTable();
			$('#ex_' + i + '_next').parent('ul').append('<i class="add_new_tr fa fa-plus" data-id="ex_' + i + '"></i>');
		}
	})
</script>
<style>
	canvas {
		background: #fff;
	}

	th, td {
		vertical-align: middle !important;
		text-align: center !important;
	}

	table td {
		padding: 5px !important
	}

	th {
		border: 1px solid #333 !important;
	}

	i.fa.fa-plus, i.fa.fa-minus {
		display: inline-block;
		float: right;
		vertical-align: middle;
		cursor: pointer;
		font-size: 12px;
	}

	.more {
		display: none;
	}

	.add_new_tr {
		display: inline-block;
		padding: 10px;
		border: 1px solid #dee2e6;
	}
</style>
<script src="<?= base_url('assets/js/go.js') ?>"></script>
<div class="jumbotron jumbotron-fluid pb-2 pt-2">
	<div id="sample">
		<div id="myDiagramDiv" style="height:300px"></div>
	</div>
	<textarea style="display: none; width: 100%;" id="mySavedModel"></textarea>
	<button id="SaveButton" onclick="save()">Save</button>
	<script src="chrome-extension://gppongmhjkpfnbhagpmjfkannfbllamg/js/inject.js"></script>
</div>

<div class="row">
	<div class="col-sm-6">
		<div class="card">
			<div class="card-header">Car</div>
			<div class="card-body">
				<div class="row mt-2">
					<div class="col-sm-3">
						<div class="alert alert-secondary small" role="alert">
							<span>unit:</span> <span class="float-right">1</span>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="alert alert-secondary small" role="alert">
							<span>Make:</span> <span class="float-right">BMW</span>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="alert alert-secondary small">
							<span>Color:</span> <span
								style="width: 25px;height: 25px;background: #fff;border: 1px solid #efefef;"
								class="float-right"></span>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="alert alert-secondary small">
							<span>Engine:</span> <span class="float-right">ER45543</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<div class="alert alert-secondary small" role="alert">
							<span>Model:</span> <span class="float-right">M-3</span>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="alert alert-secondary small">
							<span>Year:</span> <span class="float-right">2015</span>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="alert alert-secondary small">
							<span>VIN:</span> <span class="float-right">123123123QWE900938</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="alert alert-secondary small">
							<span>Type of Vehicle:</span> <span class="float-right">Berline</span>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="alert alert-secondary small">
							<span>Department:</span> <span class="float-right">Sales</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="col-sm-6">
		<div class="card">
			<div class="card-header">Driver</div>
			<div class="card-body">
				<div class="row mt-2">
					<div class="col-sm-3">
						<div class="alert alert-secondary small" role="alert">
							<span>unit:</span> <span class="float-right">1</span>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="alert alert-secondary small" role="alert">
							<span>Make:</span> <span class="float-right">BMW</span>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="alert alert-secondary small">
							<span>Color:</span> <span
								style="width: 25px;height: 25px;background: #fff;border: 1px solid #efefef;"
								class="float-right"></span>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="alert alert-secondary small">
							<span>Engine:</span> <span class="float-right">ER45543</span>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-3">
						<div class="alert alert-secondary small" role="alert">
							<span>Model:</span> <span class="float-right">M-3</span>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="alert alert-secondary small">
							<span>Year:</span> <span class="float-right">2015</span>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="alert alert-secondary small">
							<span>VIN:</span> <span class="float-right">123123123QWE900938</span>
						</div>
					</div>
				</div>
				<div class="row">


					<div class="col-sm-6">
						<div class="alert alert-secondary small">
							<span>Type of Vehicle:</span> <span class="float-right">Berline</span>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="alert alert-secondary small">
							<span>Department:</span> <span class="float-right">Sales</span>
						</div>
					</div>

				</div>


			</div>
		</div>
	</div>
</div>

<nav>
	<div class="nav nav-tabs" id="nav-tab" role="tablist">
		<a class="nav-item nav-link active" id="nav-1-tab" data-toggle="tab" href="#nav-1" role="tab"
		   aria-controls="nav-1" aria-selected="true">ՏԵԽ ԶՆՆՈՒՄ</a>

		<a class="nav-item nav-link" id="nav-2-tab" data-toggle="tab" href="#nav-2" role="tab" aria-controls="nav-2"
		   aria-selected="false">ՎԱՌԵԼԻՔ</a>

		<a class="nav-item nav-link" id="nav-3-tab" data-toggle="tab" href="#nav-3" role="tab" aria-controls="nav-3"
		   aria-selected="false">ՏՈՒԳԱՆՔ</a>

		<a class="nav-item nav-link" id="nav-4-tab" data-toggle="tab" href="#nav-4" role="tab" aria-controls="nav-4"
		   aria-selected="false">ՊԱՏԱՀԱՐՆԵՐ</a>

		<a class="nav-item nav-link" id="nav-5-tab" data-toggle="tab" href="#nav-5" role="tab" aria-controls="nav-5"
		   aria-selected="false">ԱՊԱՀՈՎԱԳՐՈՒԹՅՈՒՆ</a>

		<a class="nav-item nav-link" id="nav-6-tab" data-toggle="tab" href="#nav-6" role="tab" aria-controls="nav-6"
		   aria-selected="false">ՊԱՀԵՍՏԱՄԱՍԵՐ</a>

		<a class="nav-item nav-link" id="nav-7-tab" data-toggle="tab" href="#nav-7" role="tab" aria-controls="nav-7"
		   aria-selected="false">ՎԵՐԱՆՈՐՈԳՈՒՄ</a>

		<a class="nav-item nav-link" id="nav-8-tab" data-toggle="tab" href="#nav-8" role="tab" aria-controls="nav-8"
		   aria-selected="false">ԱՆՎԱԴՈՂ</a>

		<a class="nav-item nav-link" id="nav-9-tab" data-toggle="tab" href="#nav-9" role="tab" aria-controls="nav-9"
		   aria-selected="false">ԱՐԳԵԼԱԿ</a>

		<a class="nav-item nav-link" id="nav-10-tab" data-toggle="tab" href="#nav-10" role="tab" aria-controls="nav-10"
		   aria-selected="false">ՔՍՈՒՔ</a>

		<a class="nav-item nav-link" id="nav-11-tab" data-toggle="tab" href="#nav-11" role="tab" aria-controls="nav-11"
		   aria-selected="false">ՖԻԼՏՐ</a>

		<a class="nav-item nav-link" id="nav-12-tab" data-toggle="tab" href="#nav-12" role="tab" aria-controls="nav-12"
		   aria-selected="false">ՄԱՐՏԿՈՑ</a>

		<a class="nav-item nav-link" id="nav-13-tab" data-toggle="tab" href="#nav-13" role="tab" aria-controls="nav-13"
		   aria-selected="false">ԱՀԱԶԱՆԳ</a>
	</div>
</nav>

<div class="tab-content" id="nav-tabContent">
	<div class="tab-pane fade show active" id="nav-1" role="tabpanel" aria-labelledby="nav-1-tab">
		<div class="row col-sm-12 col-md-12"
			 style="background: #fff;padding-top: 10px;padding-bottom: 10px;overflow-x: auto;">
			<div class="container-fluid">
				<table id="ex_1" class="table table-striped table-borderless" style="width:100%">
					<thead style="background: #fff;color: #545b62;">
					<tr>
						<th style="font-size: 12px !important;font-weight:500;">ID</th>
						<th style="font-size: 12px !important;font-weight:500;">Երբ</th>
						<th style="font-size: 12px !important;font-weight:500;">Ում Կողմից</th>
						<th style="font-size: 12px !important;font-weight:500;">Վերջնաժամկետ</th>
						<th style="font-size: 12px !important;font-weight:500;">Գումար</th>
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"></i></th>
					</tr>
					</thead>

					<tbody class="ex_1"></tbody>

				</table>
			</div>
		</div>
	</div>

	<div class="tab-pane fade" id="nav-2" role="tabpanel" aria-labelledby="nav-2-tab">
		<div class="row col-sm-12 col-md-12"
			 style="background: #fff;padding-top: 10px;padding-bottom: 10px;overflow-x: auto;">
			<div class="container-fluid">
				<table id="ex_2" class="table table-striped table-borderless" style="width:100%">
					<thead style="background: #fff;color: #545b62;">
					<tr>
						<th style="font-size: 12px !important;font-weight:500;">ID</th>
						<th style="font-size: 12px !important;font-weight:500;">Երբ</th>
						<th style="font-size: 12px !important;font-weight:500;">Ում Կողմից</th>
						<th style="font-size: 12px !important;font-weight:500;">Վարորդ</th>
						<th style="font-size: 12px !important;font-weight:500;">Քանակ Լիտր</th>
						<th style="font-size: 12px !important;font-weight:500;">1 լիտր-արժեք</th>
						<th style="font-size: 12px !important;font-weight:500;">Գումար</th>
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"></i></th>
					</tr>
					</thead>

					<tbody class="ex_2"></tbody>

				</table>
			</div>
		</div>
	</div>

	<div class="tab-pane fade" id="nav-3" role="tabpanel" aria-labelledby="nav-3-tab">
		<div class="row col-sm-12 col-md-12"
			 style="background: #fff;padding-top: 10px;padding-bottom: 10px;overflow-x: auto;">
			<div class="container-fluid">
				<table id="ex_3" class="table table-striped table-borderless" style="width:100%">
					<thead style="background: #fff;color: #545b62;">
					<tr>
						<th style="font-size: 12px !important;font-weight:500;">ID</th>
						<th style="font-size: 12px !important;font-weight:500;">Երբ</th>
						<th style="font-size: 12px !important;font-weight:500;">Տեասակ</th>
						<th style="font-size: 12px !important;font-weight:500;">Վարորդ</th>
						<th style="font-size: 12px !important;font-weight:500;">Այլ Ինֆորմացիա</th>
						<th style="font-size: 12px !important;font-weight:500;">Գումար</th>
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"></i></th>
					</tr>
					</thead>

					<tbody class="ex_3"></tbody>

				</table>
			</div>
		</div>
	</div>

	<div class="tab-pane fade" id="nav-4" role="tabpanel" aria-labelledby="nav-4-tab">
		<div class="row col-sm-12 col-md-12"
			 style="background: #fff;padding-top: 10px;padding-bottom: 10px;overflow-x: auto;">
			<div class="container-fluid">
				<table id="ex_4" class="table table-striped table-borderless" style="width:100%">
					<thead style="background: #fff;color: #545b62;">
					<tr>
						<th style="font-size: 12px !important;font-weight:500;">ID</th>
						<th style="font-size: 12px !important;font-weight:500;">Երբ</th>
						<th style="font-size: 12px !important;font-weight:500;">Ապահովագրական Ընկերություն</th>
						<th style="font-size: 12px !important;font-weight:500;">Վարորդ</th>
						<th style="font-size: 12px !important;font-weight:500;">Եզրակացության Համար</th>
						<th style="font-size: 12px !important;font-weight:500;">Փոխարինման Ենթակա Դետալների Անվանում
						</th>
						<th style="font-size: 12px !important;font-weight:500;">Հատուցվող գումար</th>
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"></i></th>
					</tr>
					</thead>

					<tbody class="ex_4"></tbody>

				</table>
			</div>
		</div>
	</div>

	<div class="tab-pane fade" id="nav-5" role="tabpanel" aria-labelledby="nav-5-tab">
		<div class="row col-sm-12 col-md-12"
			 style="background: #fff;padding-top: 10px;padding-bottom: 10px;overflow-x: auto;">
			<div class="container-fluid">
				<table id="ex_5" class="table table-striped table-borderless" style="width:100%">
					<thead style="background: #fff;color: #545b62;">
					<tr>
						<th style="font-size: 12px !important;font-weight:500;">ID</th>
						<th style="font-size: 12px !important;font-weight:500;">Երբ</th>
						<th style="font-size: 12px !important;font-weight:500;">Ապահովագրական Ընկերություն</th>
						<th style="font-size: 12px !important;font-weight:500;">Տեսակ</th>
						<th style="font-size: 12px !important;font-weight:500;">Վերջնաժամկետ</th>
						<th style="font-size: 12px !important;font-weight:500;">Գումար</th>
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"></i></th>
					</tr>
					</thead>

					<tbody class="ex_5">

					</tbody>

				</table>
			</div>
		</div>
	</div>

	<div class="tab-pane fade" id="nav-6" role="tabpanel" aria-labelledby="nav-6-tab">
		<div class="row col-sm-12 col-md-12"
			 style="background: #fff;padding-top: 10px;padding-bottom: 10px;overflow-x: auto;">
			<div class="container-fluid">
				<table id="ex_6" class="table table-striped table-borderless" style="width:100%">
					<thead style="background: #fff;color: #545b62;">
					<tr>
						<th style="font-size: 12px !important;font-weight:500;">ID</th>
						<th style="font-size: 12px !important;font-weight:500;">Երբ</th>
						<th style="font-size: 12px !important;font-weight:500;">Որտեղից</th>
						<th style="font-size: 12px !important;font-weight:500;">Տեսակ</th>
						<th style="font-size: 12px !important;font-weight:500;">Արտադրող</th>
						<th style="font-size: 12px !important;font-weight:500;">Մոդել</th>
						<th style="font-size: 12px !important;font-weight:500;">Նոր-Օգտագործված</th>
						<th style="font-size: 12px !important;font-weight:500;">Քանակ</th>
						<th style="font-size: 12px !important;font-weight:500;">Միավորի Արժեք</th>
						<th style="font-size: 12px !important;font-weight:500;">Գումար</th>
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"></i></th>
					</tr>
					</thead>

					<tbody class="ex_6"></tbody>

				</table>
			</div>
		</div>
	</div>

	<div class="tab-pane fade" id="nav-7" role="tabpanel" aria-labelledby="nav-7-tab">
		<div class="row col-sm-12 col-md-12"
			 style="background: #fff;padding-top: 10px;padding-bottom: 10px;overflow-x: auto;">
			<div class="container-fluid">
				<table id="ex_7" class="table table-striped table-borderless" style="width:100%">
					<thead style="background: #fff;color: #545b62;">
					<tr>
						<th style="font-size: 12px !important;font-weight:500;">ID</th>
						<th style="font-size: 12px !important;font-weight:500;">Երբ</th>
						<th style="font-size: 12px !important;font-weight:500;">Վերանորոգող</th>
						<th style="font-size: 12px !important;font-weight:500;">Վերանորոգման ենթակա աշխ․ նյութեր</th>
						<th style="font-size: 12px !important;font-weight:500;">Արժեք</th>
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"></i></th>
					</tr>
					</thead>

					<tbody class="ex_7"></tbody>

				</table>
			</div>
		</div>
	</div>

	<div class="tab-pane fade" id="nav-8" role="tabpanel" aria-labelledby="nav-8-tab">
		<div class="row col-sm-12 col-md-12"
			 style="background: #fff;padding-top: 10px;padding-bottom: 10px;overflow-x: auto;">
			<div class="container-fluid">
				<table id="ex_8" class="table table-striped table-borderless" style="width:100%">
					<thead style="background: #fff;color: #545b62;">
					<tr>
						<th style="font-size: 12px !important;font-weight:500;">ID</th>
						<th style="font-size: 12px !important;font-weight:500;">Երբ</th>
						<th style="font-size: 12px !important;font-weight:500;">Որտեղից</th>
						<th style="font-size: 12px !important;font-weight:500;">Արտադրող</th>
						<th style="font-size: 12px !important;font-weight:500;">Մոդել</th>
						<th style="font-size: 12px !important;font-weight:500;">Տեսակ Ամառ Ձմեռ Բոլոր</th>
						<th style="font-size: 12px !important;font-weight:500;">Նոր-Օգտագործված</th>
						<th style="font-size: 12px !important;font-weight:500;">Քանակ</th>
						<th style="font-size: 12px !important;font-weight:500;">Այլ Ինֆորմաիա</th>
						<th style="font-size: 12px !important;font-weight:500;">Միավորի Արժեք</th>
						<th style="font-size: 12px !important;font-weight:500;">Ամբողջ</th>
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"></i></th>
					</tr>
					</thead>

					<tbody class="ex_8"></tbody>

				</table>
			</div>
		</div>
	</div>

	<div class="tab-pane fade" id="nav-9" role="tabpanel" aria-labelledby="nav-9-tab">
		<div class="row col-sm-12 col-md-12"
			 style="background: #fff;padding-top: 10px;padding-bottom: 10px;overflow-x: auto;">
			<div class="container-fluid">
				<table id="ex_9" class="table table-striped table-borderless" style="width:100%">
					<thead style="background: #fff;color: #545b62;">
					<tr>
						<th style="font-size: 12px !important;font-weight:500;">ID</th>
						<th style="font-size: 12px !important;font-weight:500;">Երբ</th>
						<th style="font-size: 12px !important;font-weight:500;">Որտեղից</th>
						<th style="font-size: 12px !important;font-weight:500;">Արտադրող</th>
						<th style="font-size: 12px !important;font-weight:500;">Մոդել</th>
						<th style="font-size: 12px !important;font-weight:500;">Տեսակ Դիսկ Բառաբան</th>
						<th style="font-size: 12px !important;font-weight:500;">Նոր-Օգտագործված</th>
						<th style="font-size: 12px !important;font-weight:500;">Քանակ</th>
						<th style="font-size: 12px !important;font-weight:500;">Այլ Ինֆորմաիա</th>
						<th style="font-size: 12px !important;font-weight:500;">Միավորի Արժեք</th>
						<th style="font-size: 12px !important;font-weight:500;">Ամբողջ</th>
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"></i></th>
					</tr>
					</thead>

					<tbody class="ex_9"></tbody>

				</table>
			</div>
		</div>
	</div>

	<div class="tab-pane fade" id="nav-10" role="tabpanel" aria-labelledby="nav-10-tab">
		<div class="row col-sm-12 col-md-12"
			 style="background: #fff;padding-top: 10px;padding-bottom: 10px;overflow-x: auto;">
			<div class="container-fluid">
				<table id="ex_10" class="table table-striped table-borderless" style="width:100%">
					<thead style="background: #fff;color: #545b62;">
					<tr>
						<th style="font-size: 12px !important;font-weight:500;">ID</th>
						<th style="font-size: 12px !important;font-weight:500;">Երբ</th>
						<th style="font-size: 12px !important;font-weight:500;">Որտեղից</th>
						<th style="font-size: 12px !important;font-weight:500;">Արտադրող</th>
						<th style="font-size: 12px !important;font-weight:500;">Մոդել</th>
						<th style="font-size: 12px !important;font-weight:500;">Տեսակ</th>
						<th style="font-size: 12px !important;font-weight:500;">Այլ Ինֆորմացիա</th>
						<th style="font-size: 12px !important;font-weight:500;">Քանակ լիտր Արժեք</th>
						<th style="font-size: 12px !important;font-weight:500;">միավորի արժեք</th>
						<th style="font-size: 12px !important;font-weight:500;">Ամբողջ</th>
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"></i></th>
					</tr>
					</thead>

					<tbody class="ex_10"></tbody>

				</table>
			</div>
		</div>
	</div>

	<div class="tab-pane fade" id="nav-11" role="tabpanel" aria-labelledby="nav-11-tab">
		<div class="row col-sm-12 col-md-12"
			 style="background: #fff;padding-top: 10px;padding-bottom: 10px;overflow-x: auto;">
			<div class="container-fluid">
				<table id="ex_11" class="table table-striped table-borderless" style="width:100%">
					<thead style="background: #fff;color: #545b62;">
					<tr>
						<th style="font-size: 12px !important;font-weight:500;">ID</th>
						<th style="font-size: 12px !important;font-weight:500;">Երբ</th>
						<th style="font-size: 12px !important;font-weight:500;">Որտեղից</th>
						<th style="font-size: 12px !important;font-weight:500;">Արտադրող</th>
						<th style="font-size: 12px !important;font-weight:500;">Մոդել</th>
						<th style="font-size: 12px !important;font-weight:500;">Տեսակ</th>
						<th style="font-size: 12px !important;font-weight:500;">Այլ Ինֆորմացիա</th>
						<th style="font-size: 12px !important;font-weight:500;">Քանակ</th>
						<th style="font-size: 12px !important;font-weight:500;">միավորի արժեք</th>
						<th style="font-size: 12px !important;font-weight:500;">Ամբողջ</th>
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"></i></th>
					</tr>
					</thead>

					<tbody class="ex_11"></tbody>

				</table>
			</div>
		</div>
	</div>

	<div class="tab-pane fade" id="nav-12" role="tabpanel" aria-labelledby="nav-12-tab">
		<div class="row col-sm-12 col-md-12"
			 style="background: #fff;padding-top: 10px;padding-bottom: 10px;overflow-x: auto;">
			<div class="container-fluid">
				<table id="ex_12" class="table table-striped table-borderless" style="width:100%">
					<thead style="background: #fff;color: #545b62;">
					<tr>
						<th style="font-size: 12px !important;font-weight:500;">ID</th>
						<th style="font-size: 12px !important;font-weight:500;">Երբ</th>
						<th style="font-size: 12px !important;font-weight:500;">Որտեղից</th>
						<th style="font-size: 12px !important;font-weight:500;">Արտադրող</th>
						<th style="font-size: 12px !important;font-weight:500;">Մոդել</th>
						<th style="font-size: 12px !important;font-weight:500;">Այլ Ինֆորմացիա</th>
						<th style="font-size: 12px !important;font-weight:500;">Քանակ</th>
						<th style="font-size: 12px !important;font-weight:500;">միավորի արժեք</th>
						<th style="font-size: 12px !important;font-weight:500;">Ամբողջ</th>
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"></i></th>
					</tr>
					</thead>

					<tbody class="ex_12"></tbody>

				</table>
			</div>
		</div>
	</div>

	<div class="tab-pane fade" id="nav-13" role="tabpanel" aria-labelledby="nav-13-tab">
		<div class="row col-sm-12 col-md-12"
			 style="background: #fff;padding-top: 10px;padding-bottom: 10px;overflow-x: auto;">
			<div class="container-fluid">
				<table id="ex_13" class="table table-striped table-borderless" style="width:100%">
					<thead style="background: #fff;color: #545b62;">
					<tr>
						<th style="font-size: 12px !important;font-weight:500;">ID</th>
						<th style="font-size: 12px !important;font-weight:500;">Service</th>
						<th style="font-size: 12px !important;font-weight:500;">Service frequency</th>
						<th style="font-size: 12px !important;font-weight:500;">Last performed</th>
						<th style="font-size: 12px !important;font-weight:500;">Last Performed at (meter)</th>
						<th style="font-size: 12px !important;font-weight:500;">Next services</th>
						<th style="font-size: 12px !important;font-weight:500;">To go</th>
						<th style="font-size: 12px !important;font-weight:500;">Create reminder</th>
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"></i></th>
					</tr>
					</thead>

					<tbody class="ex_13"></tbody>

				</table>
			</div>
		</div>
	</div>
</div>



<script>
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
				makeButton("Delete",
					function (e, obj) {
						e.diagram.commandHandler.deleteSelection();
					},
					function (o) {
						return o.diagram.commandHandler.canDeleteSelection();
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
			return {font: "9pt  Segoe UI,sans-serif", stroke: "#fff"};
		}

		function nodeDoubleClick(e, obj) {
		}

		function nodeInfo(d) {
			var str = "Node " + d.key + ": " + d.text + "\n";
			if (d.group)
				str += "member of " + d.group;
			else
				str += "top-level node";
			// return str;
		}

		var levelColors = ["#37474F", "#546E7A", "#78909C", "#B0BEC5"];
		myDiagram.layout.commitNodes = function () {
			go.TreeLayout.prototype.commitNodes.call(myDiagram.layout);
			myDiagram.layout.network.vertexes.each(function (v) {
				if (v.node) {
					var level = v.level % (levelColors.length);
					var color = levelColors[level];
					var shape = v.node.findObject("SHAPE");
					console.log(v.node);
					if (shape) shape.fill = $(go.Brush, "Linear", {0: color, start: go.Spot.Left, end: go.Spot.Right});
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
					height: 35,
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
				new go.Binding("text", "name"),
				new go.Binding("layerName", "isSelected", function (sel) {
					return sel ? "Foreground" : "";
				}).ofObject(),
				$(go.Shape, "Rectangle",
					{
						name: "SHAPE", fill: "orange", stroke: null,
						portId: "", cursor: "pointer",
						fromLinkable: true, fromLinkableDuplicates: false, toLinkable: true, toLinkableDuplicates: false
					}),
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
						$(go.RowColumnDefinition, {column: 2, width: 4}),
						$(go.TextBlock, textStyle(),
							{
								row: 0, column: 0, columnSpan: 2,
								font: "10pt Segoe UI,sans-serif",
								editable: true, isMultiline: false,
								minSize: new go.Size(8, 14)
							},
							new go.Binding("text", "name").makeTwoWay()),
						$(go.TextBlock, "", textStyle(),
							{row: 1, column: 0}),
						$(go.TextBlock, textStyle(),
							{
								row: 1, column: 1, columnSpan: 4,
								editable: false, isMultiline: false,
								minSize: new go.Size(10, 14),
								margin: new go.Margin(1, 1, 0, 3)
							},
							new go.Binding("text", "text").makeTwoWay()),
						$(go.TextBlock, textStyle(),
							{row: 2, column: 0},
						),
						$(go.TextBlock, textStyle(),
							{name: "boss", row: 2, column: 3,},
							new go.Binding("text", "parent", function (v) {
								return "Boss: " + v;
							})),
						$(go.TextBlock, textStyle(),
							{
								row: 3, column: 0, columnSpan: 5,
								font: "italic 9pt sans-serif",
								wrap: go.TextBlock.WrapFit,
								editable: true,
								minSize: new go.Size(10, 14)
							},
							new go.Binding("text", "comments").makeTwoWay())
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
			var mems = g.memberParts.count;
			var links = 0;
			g.memberParts.each(function (part) {
				if (part instanceof go.Link) links++;
			});
			// return "Group " + g.data.key + ": " + g.data.text + "\n" + mems + " members including " + links + " links";
		}

		myDiagram.groupTemplate =
			$(go.Group, "Vertical",
				{
					selectionObjectName: "PANEL",
					ungroupable: true
				},
				$(go.TextBlock,
					{
						font: "bold 19px sans-serif",
						isMultiline: false,
						editable: true
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
				),
				{
					toolTip:
						$(go.Adornment, "Auto",
							$(go.Shape, {fill: "#ff0900"}),
							$(go.TextBlock, {margin: 2},
								new go.Binding("text", "", groupInfo).ofObject())
						),
					contextMenu: partContextMenu
				}
			);

		function diagramInfo(model) {
			return "Model:\n" + model.nodeDataArray.length + " nodes, " + model.linkDataArray.length + " links";
		}

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

	$(document).ready(function () {
		init();
		myDiagram.addDiagramListener("ObjectSingleClicked",
			function (e) {
				var arr = [];
				var new_arr = [];
				myDiagram.selection.each(function (part) {
					if (part instanceof go.Node) {
						arr = {
							"key": part.Wd.key,
							"name": part.Wd.text,
							"parent": part.Wd.parent
						};
						// console.log(arr.key);
						var str1 = arr.key;
						var re1 = 'f';
						var found1 = str1.match(re1);
						if (found1 == 'f') {
							new_arr.push(arr);
						}
					}
				});
			});
	});

	function save() {
		document.getElementById("mySavedModel").value = myDiagram.model.toJson();
		myDiagram.isModified = false;
		console.log(myDiagram.model.linkDataArray);
		var url = '<?=base_url('Structure/change_from_to_ax')?>';
		var data = myDiagram.model.linkDataArray;

		$.post(url, {data: data}).done(function (data) {
			console.log("Data Loaded: " + data);
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
	var ii = 1;
	$(document).on('click', '.add_new_tr', function () {
		var dt_id = $(this).data('id');
		console.log('dt_id -->' + dt_id);

		if (dt_id == 'ex_1') {
			$('.ex_1 .odd').remove();
			$('.ex_1').append('<tr role="row">\n' +
				'\t\t\t\t\t\t\t<td class="sorting_1">' + ii + '</td>\n' +
				'\t\t\t\t\t\t\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\t\t\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\t\t\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\t\t\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\t\t\t<td><i class="del_row_ft fa fa-trash" style="cursor:pointer;color:rgb(255, 122, 89);"></i></td>\n' +
				'\t\t\t\t\t\t</tr>');
		}
		if (dt_id == 'ex_2') {
			$('.ex_2 .odd').remove();
			$('.ex_2').append('<tr role="row">\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td class="sorting_1">' + ii + '</td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><i class="del_row_ft fa fa-trash" style="cursor:pointer;color:rgb(255, 122, 89);"></i></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t</tr>');
		}
		if (dt_id == 'ex_3') {
			$('.ex_3 .odd').remove();
			$('.ex_3').append('<tr role="row">\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td class="sorting_1">' + ii + '</td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><i class="del_row_ft fa fa-trash" style="cursor:pointer;color:rgb(255, 122, 89);"></i></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t</tr>');
		}
		if (dt_id == 'ex_4') {
			$('.ex_4 .odd').remove();
			$('.ex_4').append('<tr role="row">\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td class="sorting_1">' + ii + '</td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><i class="del_row_ft fa fa-trash" style="cursor:pointer;color:rgb(255, 122, 89);"></i></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t</tr>');
		}
		if (dt_id == 'ex_5') {
			$('.ex_5 .odd').remove();
			$('.ex_5').append('<tr role="row">\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td class="sorting_1">' + ii + '</td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><i class="del_row_ft fa fa-trash" style="cursor:pointer;color:rgb(255, 122, 89);"></i></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t</tr>');
		}
		if (dt_id == 'ex_6') {
			$('.ex_6 .odd').remove();
			$('.ex_6').append('<tr role="row">\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td class="sorting_1">' + ii + '</td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><i class="del_row_ft fa fa-trash" style="cursor:pointer;color:rgb(255, 122, 89);"></i></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t</tr>');
		}
		if (dt_id == 'ex_7') {
			$('.ex_7 .odd').remove();
			$('.ex_7').append('<tr role="row">\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td class="sorting_1">' + ii + '</td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><i class="del_row_ft fa fa-trash" style="cursor:pointer;color:rgb(255, 122, 89);"></i></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t</tr>');
		}
		if (dt_id == 'ex_8') {
			$('.ex_8 .odd').remove();
			$('.ex_8').append('<tr role="row">\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td class="sorting_1">' + ii + '</td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><i class="del_row_ft fa fa-trash" style="cursor:pointer;color:rgb(255, 122, 89);"></i></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t</tr>');
		}
		if (dt_id == 'ex_9') {
			$('.ex_9 .odd').remove();
			$('.ex_9').append('<tr role="row">\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td class="sorting_1">' + ii + '</td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><i class="del_row_ft fa fa-trash" style="cursor:pointer;color:rgb(255, 122, 89);"></i></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t</tr>');
		}
		if (dt_id == 'ex_10') {
			$('.ex_10 .odd').remove();
			$('.ex_10').append('<tr role="row">\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td class="sorting_1">' + ii + '</td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><i class="del_row_ft fa fa-trash" style="cursor:pointer;color:rgb(255, 122, 89);"></i></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t</tr>');
		}
		if (dt_id == 'ex_11') {
			$('.ex_11 .odd').remove();
			$('.ex_11').append('<tr role="row">\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td class="sorting_1">' + ii + '</td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><i class="del_row_ft fa fa-trash" style="cursor:pointer;color:rgb(255, 122, 89);"></i></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t</tr>');
		}
		if (dt_id == 'ex_12') {
			$('.ex_12 .odd').remove();
			$('.ex_12').append('<tr role="row">\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td class="sorting_1">' + ii + '</td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><i class="del_row_ft fa fa-trash" style="cursor:pointer;color:rgb(255, 122, 89);"></i></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t</tr>');
		}
		if (dt_id == 'ex_13') {
			$('.ex_13 .odd').remove();
			$('.ex_13').append('<tr role="row">\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td class="sorting_1">' + ii + '</td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><input type="text" name="_' + ii + '" value="" style="width: 100%;" class="text-center"/></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t\\t<td><i class="del_row_ft fa fa-trash" style="cursor:pointer;color:rgb(255, 122, 89);"></i></td>\n' +
				'\t\t\t\t\'\\t\\t\\t\\t\\t\\t</tr>');
		}

		ii++;

	})


</script>
