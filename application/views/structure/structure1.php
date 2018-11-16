<script src="<?= base_url() ?>assets/js/bootstrap_table.js"></script>
<script src="<?= base_url() ?>assets/js/table.js"></script>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/table.css"/>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/structure1.css"/>
<!-- Structure Start -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<!--[if lt IE 9]>
<script src="https://code.highcharts.com/modules/oldie.js"></script>
<![endif]-->
<script>
	$(document).ready(function () {
		for (i = 1; i < 14; i++) {
			$('#ex_' + i + '').DataTable();
			$('#ex_' + i + '_wrapper').append('<i class="add_new_tr fa fa-plus ml-1 mr-1 float-right" style="position:absolute;left:250px;bottom:12px;" data-id="ex_' + i + '"> </i>');
			$('#ex_' + i + '_wrapper').append('<button class="btn btn-sm btn-success ml-1 mr-1 float-right" style="left:285px;position:absolute;bottom:13px;">Save</button>');
		}
	})
</script>

<script src="<?= base_url('assets/js/go.js') ?>"></script>
<div class="jumbotron jumbotron-fluid pb-2 pt-2 mb-0 text-right bg-white ">
	<div id="sample">
		<div id="myDiagramDiv" style="height:300px"></div>
	</div>
	<textarea style="display: none; width: 100%;" id="mySavedModel" title=""> </textarea>
	<script src="chrome-extension://gppongmhjkpfnbhagpmjfkannfbllamg/js/inject.js"></script>
	<nav class="selectted_information float-left d-none">
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
			<a class="nav-item nav-link active" id="nav-car-tab" data-toggle="tab" href="#nav-car" role="tab"
			   aria-controls="nav-car" aria-selected="true">Car</a>
			<a class="nav-item nav-link" id="nav-driver-tab" data-toggle="tab" href="#nav-driver" role="tab"
			   aria-controls="nav-driver" aria-selected="false">Driver</a>
		</div>
	</nav>
	<button class="btn btn-sm btn-outline-secondary mt-1" id="SaveButton" onclick="save()">Save</button>
</div>
<span class="selectted_information d-none">
<div class="tab-content mt-3" id="nav-tabContent">
	<div class="tab-pane fade show active" id="nav-car" role="tabpanel" aria-labelledby="nav-car-tab">
		<div class="container-fluid bg-secondary">
			<div class="row">
				<div class="p-2  w-auto mr-3">
					<p class="text-white-50 small text-white" style="display: block;margin-bottom: 2px;">unit: <span
							class="text-white ml-2">1</span></p>
					<p class="text-white-50 small text-white" style="display: block;margin-bottom: 2px;">Make: <span
							class="text-white ml-2">BMW</span></p>
					<p class="text-white-50 small text-white" style="display: block;margin-bottom: 2px;">Color: <span
							class="ml-2 text-white"
							style="    width: 25px;height: 10px;background: #fff;border: 1px solid #efefef;display: inline-block;"> </span></p>
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">Engine: <span
							class="text-white ml-2">ER45543</span></p>
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">Model: <span
							class="text-white ml-2">M-3</span></p>
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">Year: <span
							class="text-white ml-2">2015</span></p>
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">VIN: <span
							class="text-white ml-2">123123123QWE900938</span></p>
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">Type of Vehicle: <span
							class="text-white ml-2">Berline</span></p>
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">TDepartment: <span
							class="text-white ml-2">Sales</span></p>
				</div>
				<div class="p-2  w-auto">
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">Կցված: <span
							class="text-white ml-2">Անուն Ազգանուն</span></p>
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">Հաշվառման համարանիշ: <span
							class="text-white ml-2">HB32454</span></p>
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">Վառելիք։ <span
							class="text-white ml-2">Բենզին</span></p>
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">Միջին ծաղսը 100 կմ․ ։<span
							class="text-white ml-2">8․5</span></p>
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">Օրեկան․ ։<span
							class="text-white ml-2">120 կմ․</span></p>
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">Վազք։<span
							class="text-white ml-2">87000</span></p>
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">Հոռոգռաֆ։<span
							class="text-white ml-2">սդֆսֆսֆ</span></p>
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">GPS Exsist?։<span
							class="text-white ml-2">Այո</span></p>
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">GPS Tracker IMEI։<span
							class="text-white ml-2">45787585455</span></p>
				</div>
				<div class="p-2  w-auto">
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">Հաշվառման Հասցե։<span
							class="text-white ml-2">Հասցե 14 </span></p>
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">Ապահովագրություն: <span
							class="text-white ml-2">Կասկո</span></p>
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">Ուժի մեջ է: <span
							class="text-white ml-2">22․12․2018</span></p>
				</div>
				<div class="p-2 w-auto ml-2">
					<div id="container" style="width:100%;"></div>
				</div>
				<div class="p-2 w-auto">
					<div id="container2" style="width:100%;"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="tab-pane fade" id="nav-driver" role="tabpanel" aria-labelledby="nav-driver-tab">
		<div class="container-fluid bg-secondary">
			<div class="row">
				<div class="p-2  w-auto mr-3">
					<p class="text-white-50 small text-white"
					   style="display: block;margin-bottom: 2px;">First name: <span class="text-white ml-2">name</span></p>
					<p class="text-white-50 small text-white"
					   style="display: block;margin-bottom: 2px;">Last Name: <span
							class="text-white ml-2">last name</span></p>
					<p class="text-white-50 small text-white" style="display: block;margin-bottom: 2px;">Contact Number 1: <span
							class="text-white ml-2">78785165</span></p>
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">Contact Number 2: <span
							class="text-white ml-2">4588541788</span></p>
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">Email: <span
							class="text-white ml-2">example@ex.com</span></p>
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">Leave Country: <span
							class="text-white ml-2">Armenia</span></p>
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">Address: <span
							class="text-white ml-2">address 45/12</span></p>
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">Post Code: <span
							class="text-white ml-2">0033</span></p>
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">Department: <span
							class="text-white ml-2">sales</span></p>
				</div>
				<div class="p-2  w-auto">
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">Position: <span
							class="text-white ml-2">Driver</span></p>
					<p class="small text-white-50" style="display: block;margin-bottom: 2px;">Nest Card ID: <span
							class="text-white ml-2">4568741gt</span></p>
				</div>
			</div>
		</div>
	</div>
</div>
<nav class="mt-2">
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
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"> </i></th>
					</tr>
					</thead>
					<tbody class="ex_1">
						<tr>
							<td>1</td>
							<td><input title="" type="text" name="_1" value="12.12.2018"
									   style="width: 100%;border: none;outline: none;" class="text-center"/><span
									class="d-none">12.12.2018</span></td>
							<td><input title="" type="text" name="_1" value="uuuu"
									   style="width: 100%;border: none; outline: none;" class="text-center"/><span
									class="d-none">uuuu</span></td>
							<td><input title="" type="text" name="_1" value="20.03.2019"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">20.03.2019</span></td>
							<td><input title="" type="text" name="_1" value="12000"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">12000</span></td>
							<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top"
								   title="delete this row" style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>
						</tr>
						<tr>
							<td>2</td>
							<td><input title="" type="text" name="_2" value="12.09.2018"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">12.09.2018</span></td>
							<td><input title="" type="text" name="_2" value="dddddd"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">dddddd</span></td>
							<td><input title="" type="text" name="_2" value="23.06.2019"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">23.06.2019</span></td>
							<td><input title="" type="text" name="_2" value="55000"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">55000</span></td>
							<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top"
								   title="delete this row" style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>
						</tr>
						<tr>
							<td>3</td>
							<td><input title="" type="text" name="_3" value="03.04.2018"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">03.04.2018</span></td>
							<td><input title="" type="text" name="_3" value="ggggg"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">ggggg</span></td>
							<td><input title="" type="text" name="_3" value="25.08.2019"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">25.08.2019</span></td>
							<td><input title="" type="text" name="_3" value="15400"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">15400</span></td>
							<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top"
								   title="delete this row" style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>
						</tr>
					<tr>
							<td>4</td>
							<td><input title="" type="text" name="_3" value="03.04.2018"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">03.04.2018</span></td>
							<td><input title="" type="text" name="_3" value="ggggg"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">ggggg</span></td>
							<td><input title="" type="text" name="_3" value="25.08.2019"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">25.08.2019</span></td>
							<td><input title="" type="text" name="_3" value="15400"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">15400</span></td>
							<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top"
								   title="delete this row" style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>
						</tr>
					<tr>
							<td>5</td>
							<td><input title="" type="text" name="_3" value="03.04.2018"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">03.04.2018</span></td>
							<td><input title="" type="text" name="_3" value="ggggg"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">ggggg</span></td>
							<td><input title="" type="text" name="_3" value="25.08.2019"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">25.08.2019</span></td>
							<td><input title="" type="text" name="_3" value="15400"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">15400</span></td>
							<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top"
								   title="delete this row" style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>
						</tr>
					<tr>
							<td>6</td>
							<td><input title="" type="text" name="_3" value="03.04.2018"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">03.04.2018</span></td>
							<td><input title="" type="text" name="_3" value="ggggg"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">ggggg</span></td>
							<td><input title="" type="text" name="_3" value="25.08.2019"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">25.08.2019</span></td>
							<td><input title="" type="text" name="_3" value="15400"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">15400</span></td>
							<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top"
								   title="delete this row" style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>
						</tr>
					<tr>
							<td>7</td>
							<td><input title="" type="text" name="_3" value="03.04.2018"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">03.04.2018</span></td>
							<td><input title="" type="text" name="_3" value="ggggg"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">ggggg</span></td>
							<td><input title="" type="text" name="_3" value="25.08.2019"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">25.08.2019</span></td>
							<td><input title="" type="text" name="_3" value="15400"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">15400</span></td>
							<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top"
								   title="delete this row" style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>
						</tr>
					<tr>
							<td>8</td>
							<td><input title="" type="text" name="_3" value="03.04.2018"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">03.04.2018</span></td>
							<td><input title="" type="text" name="_3" value="ggggg"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">ggggg</span></td>
							<td><input title="" type="text" name="_3" value="25.08.2019"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">25.08.2019</span></td>
							<td><input title="" type="text" name="_3" value="15400"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">15400</span></td>
							<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top"
								   title="delete this row" style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>
						</tr><tr>
							<td>9</td>
							<td><input title="" type="text" name="_3" value="03.04.2018"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">03.04.2018</span></td>
							<td><input title="" type="text" name="_3" value="ggggg"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">ggggg</span></td>
							<td><input title="" type="text" name="_3" value="25.08.2019"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">25.08.2019</span></td>
							<td><input title="" type="text" name="_3" value="15400"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">15400</span></td>
							<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top"
								   title="delete this row" style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>
						</tr><tr>
							<td>10</td>
							<td><input title="" type="text" name="_3" value="03.04.2018"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">03.04.2018</span></td>
							<td><input title="" type="text" name="_3" value="ggggg"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">ggggg</span></td>
							<td><input title="" type="text" name="_3" value="25.08.2019"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">25.08.2019</span></td>
							<td><input title="" type="text" name="_3" value="15400"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">15400</span></td>
							<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top"
								   title="delete this row" style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>
						</tr><tr>
							<td>11</td>
							<td><input title="" type="text" name="_3" value="03.04.2018"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">03.04.2018</span></td>
							<td><input title="" type="text" name="_3" value="ggggg"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">ggggg</span></td>
							<td><input title="" type="text" name="_3" value="25.08.2019"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">25.08.2019</span></td>
							<td><input title="" type="text" name="_3" value="15400"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">15400</span></td>
							<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top"
								   title="delete this row" style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>
						</tr><tr>
							<td>12</td>
							<td><input title="" type="text" name="_3" value="03.04.2018"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">03.04.2018</span></td>
							<td><input title="" type="text" name="_3" value="ggggg"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">ggggg</span></td>
							<td><input title="" type="text" name="_3" value="25.08.2019"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">25.08.2019</span></td>
							<td><input title="" type="text" name="_3" value="15400"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">15400</span></td>
							<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top"
								   title="delete this row" style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>
						</tr><tr>
							<td>13</td>
							<td><input title="" type="text" name="_3" value="03.04.2018"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">03.04.2018</span></td>
							<td><input title="" type="text" name="_3" value="ggggg"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">ggggg</span></td>
							<td><input title="" type="text" name="_3" value="25.08.2019"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">25.08.2019</span></td>
							<td><input title="" type="text" name="_3" value="15400"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">15400</span></td>
							<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top"
								   title="delete this row" style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>
						</tr><tr>
							<td>14</td>
							<td><input title="" type="text" name="_3" value="03.04.2018"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">03.04.2018</span></td>
							<td><input title="" type="text" name="_3" value="ggggg"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">ggggg</span></td>
							<td><input title="" type="text" name="_3" value="25.08.2019"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">25.08.2019</span></td>
							<td><input title="" type="text" name="_3" value="15400"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">15400</span></td>
							<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top"
								   title="delete this row" style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>
						</tr><tr>
							<td>15</td>
							<td><input title="" type="text" name="_3" value="03.04.2018"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">03.04.2018</span></td>
							<td><input title="" type="text" name="_3" value="ggggg"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">ggggg</span></td>
							<td><input title="" type="text" name="_3" value="25.08.2019"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">25.08.2019</span></td>
							<td><input title="" type="text" name="_3" value="15400"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">15400</span></td>
							<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top"
								   title="delete this row" style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>
						</tr><tr>
							<td>16</td>
							<td><input title="" type="text" name="_3" value="03.04.2018"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">03.04.2018</span></td>
							<td><input title="" type="text" name="_3" value="ggggg"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">ggggg</span></td>
							<td><input title="" type="text" name="_3" value="25.08.2019"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">25.08.2019</span></td>
							<td><input title="" type="text" name="_3" value="15400"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">15400</span></td>
							<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top"
								   title="delete this row" style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>
						</tr><tr>
							<td>17</td>
							<td><input title="" type="text" name="_3" value="03.04.2018"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">03.04.2018</span></td>
							<td><input title="" type="text" name="_3" value="ggggg"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">ggggg</span></td>
							<td><input title="" type="text" name="_3" value="25.08.2019"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">25.08.2019</span></td>
							<td><input title="" type="text" name="_3" value="15400"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">15400</span></td>
							<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top"
								   title="delete this row" style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>
						</tr><tr>
							<td>18</td>
							<td><input title="" type="text" name="_3" value="03.04.2018"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">03.04.2018</span></td>
							<td><input title="" type="text" name="_3" value="ggggg"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">ggggg</span></td>
							<td><input title="" type="text" name="_3" value="25.08.2019"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">25.08.2019</span></td>
							<td><input title="" type="text" name="_3" value="15400"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">15400</span></td>
							<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top"
								   title="delete this row" style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>
						</tr><tr>
							<td>19</td>
							<td><input title="" type="text" name="_3" value="03.04.2018"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">03.04.2018</span></td>
							<td><input title="" type="text" name="_3" value="ggggg"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">ggggg</span></td>
							<td><input title="" type="text" name="_3" value="25.08.2019"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">25.08.2019</span></td>
							<td><input title="" type="text" name="_3" value="15400"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">15400</span></td>
							<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top"
								   title="delete this row" style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>
						</tr><tr>
							<td>20</td>
							<td><input title="" type="text" name="_3" value="03.04.2018"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">03.04.2018</span></td>
							<td><input title="" type="text" name="_3" value="ggggg"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">ggggg</span></td>
							<td><input title="" type="text" name="_3" value="25.08.2019"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">25.08.2019</span></td>
							<td><input title="" type="text" name="_3" value="15400"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">15400</span></td>
							<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top"
								   title="delete this row" style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>
						</tr><tr>
							<td>21</td>
							<td><input title="" type="text" name="_3" value="03.04.2018"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">03.04.2018</span></td>
							<td><input title="" type="text" name="_3" value="ggggg"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">ggggg</span></td>
							<td><input title="" type="text" name="_3" value="25.08.2019"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">25.08.2019</span></td>
							<td><input title="" type="text" name="_3" value="15400"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">15400</span></td>
							<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top"
								   title="delete this row" style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>
						</tr><tr>
							<td>22</td>
							<td><input title="" type="text" name="_3" value="03.04.2018"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">03.04.2018</span></td>
							<td><input title="" type="text" name="_3" value="ggggg"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">ggggg</span></td>
							<td><input title="" type="text" name="_3" value="25.08.2019"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">25.08.2019</span></td>
							<td><input title="" type="text" name="_3" value="15400"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">15400</span></td>
							<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top"
								   title="delete this row" style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>
						</tr><tr>
							<td>23</td>
							<td><input title="" type="text" name="_3" value="03.04.2018"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">03.04.2018</span></td>
							<td><input title="" type="text" name="_3" value="ggggg"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">ggggg</span></td>
							<td><input title="" type="text" name="_3" value="25.08.2019"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">25.08.2019</span></td>
							<td><input title="" type="text" name="_3" value="15400"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">15400</span></td>
							<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top"
								   title="delete this row" style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>
						</tr><tr>
							<td>24</td>
							<td><input title="" type="text" name="_3" value="03.04.2018"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">03.04.2018</span></td>
							<td><input title="" type="text" name="_3" value="ggggg"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">ggggg</span></td>
							<td><input title="" type="text" name="_3" value="25.08.2019"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">25.08.2019</span></td>
							<td><input title="" type="text" name="_3" value="15400"
									   style="width: 100%;border:none; outline: none;" class="text-center"/><span
									class="d-none">15400</span></td>
							<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top"
								   title="delete this row" style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>
						</tr>
					</tbody>
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
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"> </i></th>
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
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"> </i></th>
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
						<th style="font-size: 12px !important;font-weight:500;">Փոխարինման Ենթակա Դետալների Անվանում</th>
						<th style="font-size: 12px !important;font-weight:500;">Հատուցվող գումար</th>
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"> </i></th>
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
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"> </i></th>
					</tr>
					</thead>
					<tbody class="ex_5"></tbody>
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
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"> </i></th>
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
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"> </i></th>
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
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"> </i></th>
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
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"> </i></th>
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
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"> </i></th>
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
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"> </i> </th>
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
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"> </i></th>
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
						<th style="font-size: 12px !important;font-weight:500;"><i class="fa fa-trash"> </i></th>
					</tr>
					</thead>
					<tbody class="ex_13"></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</span>
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
				makeButton("deletee",
					function (e, obj) {
						e.diagram.commandHandler.deleteeSelection();
					},
					function (o) {
						return o.diagram.commandHandler.candeleteeSelection();
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
			return {font: "9px  Segoe UI,sans-serif", stroke: "#fff"};
		}

		function nodeDoubleClick(e, obj) {
		}

		function nodeInfo(d) {
			var str = "Node " + d.key + ": " + d.text + "\n";
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
								font: "9px Segoe UI,sans-serif",
								editable: false, isMultiline: false,
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
								font: "italic 9px sans-serif",
								wrap: go.TextBlock.WrapFit,
								editable: true,
								minSize: new go.Size(10, 14)
							},
							new go.Binding("text", "comments").makeTwoWay())
					)
				)
			);

		myDiagram.allowMove = false;
		myDiagram.allowUndo = false;

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
			var links = 0;
			g.memberParts.each(function (part) {
				if (part instanceof go.Link) links++;
			});
		}

		myDiagram.groupTemplate =
			$(go.Group, "Vertical",
				{
					selectionObjectName: "PANEL",
					ungroupable: false
				},
				$(go.TextBlock,
					{
						font: "bold 9px sans-serif",
						isMultiline: false,
						editable: false
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
				)
			);


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
							$('.selectted_information').removeClass('d-none');
						}
					}
				});
				/*Remove BoxShadow From HighCharts Pie Diagram*/
				$('.highcharts-text-outline').attr('stroke', '');
			});
	});

	function save() {
		document.getElementById("mySavedModel").value = myDiagram.model.toJson();
		myDiagram.isModified = false;


		console.log(myDiagram.model.linkDataArray);


		var url = '<?=base_url('Structure/change_from_to_ax')?>';
		var data = myDiagram.model.linkDataArray;
		var old_data = '<?=$from_to?>';
		$.post(url, {data: data, old_data: old_data}).done(function (data) {
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

	$('.ex_1 tr').each(function () {
		ii++;
	});
	$('.ex_2 tr').each(function () {
		ii++;
	});
	$('.ex_3 tr').each(function () {
		ii++;
	});
	$('.ex_4 tr').each(function () {
		ii++;
	});
	$('.ex_5 tr').each(function () {
		ii++;
	});
	$('.ex_6 tr').each(function () {
		ii++;
	});
	$('.ex_7 tr').each(function () {
		ii++;
	});
	$('.ex_8 tr').each(function () {
		ii++;
	});
	$('.ex_9 tr').each(function () {
		ii++;
	});
	$('.ex_10 tr').each(function () {
		ii++;
	});
	$('.ex_11 tr').each(function () {
		ii++;
	});
	$('.ex_12 tr').each(function () {
		ii++;
	});
	$('.ex_13 tr').each(function () {
		ii++;
	});
	$(document).on('click', '.add_new_tr', function () {
		var dt_id = $(this).data('id');
		if (dt_id == 'ex_1') {
			$("td[valign='top']").parent('tr').remove();
			$('.ex_1').append('<tr role="row">\n' +
				'<td class="sorting_1"> ' + ii + '</td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"  style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>\n' +
				'</tr>');
		}
		if (dt_id == 'ex_2') {
			$("td[valign='top']").parent('tr').remove();
			$('.ex_2').append('<tr role="row">\n' +
				'<td class="sorting_1"> ' + ii + '</td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"  style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>\n' +
				'</tr>');
		}
		if (dt_id == 'ex_3') {
			$("td[valign='top']").parent('tr').remove();
			$('.ex_3').append('<tr role="row">\n' +
				'<td class="sorting_1"> ' + ii + '</td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"  style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>\n' +
				'</tr>');
		}
		if (dt_id == 'ex_4') {
			$("td[valign='top']").parent('tr').remove();
			$('.ex_4').append('<tr role="row">\n' +
				'<td class="sorting_1"> ' + ii + '</td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"  style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>\n' +
				'</tr>');
		}
		if (dt_id == 'ex_5') {
			$$("td[valign='top']").parent('tr').remove();
			$('.ex_5').append('<tr role="row">\n' +
				'<td class="sorting_1"> ' + ii + '</td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"  style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>\n' +
				'</tr>');
		}
		if (dt_id == 'ex_6') {
			$("td[valign='top']").parent('tr').remove();
			$('.ex_6').append('<tr role="row">\n' +
				'<td class="sorting_1"> ' + ii + '</td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"  style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>\n' +
				'</tr>');
		}
		if (dt_id == 'ex_7') {
			$("td[valign='top']").parent('tr').remove();
			$('.ex_7').append('<tr role="row">\n' +
				'<td class="sorting_1"> ' + ii + '</td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"  style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>\n' +
				'</tr>');
		}
		if (dt_id == 'ex_8') {
			$("td[valign='top']").parent('tr').remove();
			$('.ex_8').append('<tr role="row">\n' +
				'<td class="sorting_1"> ' + ii + '</td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"  style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>\n' +
				'</tr>');
		}
		if (dt_id == 'ex_9') {
			$("td[valign='top']").parent('tr').remove();
			$('.ex_9').append('<tr role="row">\n' +
				'<td class="sorting_1"> ' + ii + '</td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"  style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>\n' +
				'</tr>');
		}
		if (dt_id == 'ex_10') {
			$("td[valign='top']").parent('tr').remove();
			$('.ex_10').append('<tr role="row">\n' +
				'<td class="sorting_1"> ' + ii + '</td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"  style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>\n' +
				'</tr>');
		}
		if (dt_id == 'ex_11') {
			$("td[valign='top']").parent('tr').remove();
			$('.ex_11').append('<tr role="row">\n' +
				'<td class="sorting_1"> ' + ii + '</td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"  style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>\n' +
				'</tr>');
		}
		if (dt_id == 'ex_12') {
			$("td[valign='top']").parent('tr').remove();
			$('.ex_12').append('<tr role="row">\n' +
				'<td class="sorting_1"> ' + ii + '</td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"  style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>\n' +
				'</tr>');
		}
		if (ex_13 == dt_id) {
			$("td[valign='top']").parent('tr').remove();
			$('.ex_13').append('<tr role="row">\n' +
				'<td class="sorting_1"> ' + ii + '</td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><input title="" type="text" name="_' + ii + '" value="" style="width: 100%;border:none; outline: none;" class="text-center"/></td>\n' +
				'<td><i class="del_row_ft fa fa-trash" data-toggle="tooltip" data-placement="top" title="delete this row"  style="cursor:pointer;color:rgb(255, 122, 89);"> </i></td>\n' +
				'</tr>');
		}
		ii++;
		$('.dataTables_wrapper.dt-bootstrap4.no-footer .row:first-child').css('display', 'none');
		$('th').unbind("click");
		// $('.pagination li').unbind("click");
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	});
	$(document).on('click', '.del_row_ft', function () {
		$(this).parent('td').parent('tr').remove();
	});
	$(document).ready(function () {
		Highcharts.chart('container', {
			chart: {
				style: {color: '#FFFFFF'},
				type: 'area',
				width: 400,
				height: 250,
				backgroundColor: 'rgba(255, 255, 255, 0.0)'
			},
			title: {
				style: {color: '#FFFFFF', fontSize: '14px'},
				text: 'US and USSR nuclear stockpiles'
			},
			xAxis: {

				allowDecimals: false,
				labels: {
					style: {color: '#FFFFFF'},
					formatter: function () {
						return this.value;
					}
				}
			},
			yAxis: {
				title: {
					style: {color: '#FFFFFF'},
					text: 'Nuclear weapon states'
				},
				labels: {
					style: {color: '#FFFFFF'},
					formatter: function () {
						return this.value / 1000 + 'k';
					}
				}
			},
			tooltip: {
				pointFormat: '{series.name} had stockpiled <b>{point.y:,.0f}</b><br/>warheads in {point.x}'
			},
			plotOptions: {
				style: {color: '#FFFFFF'},
				area: {
					pointStart: 1940,
					marker: {
						enabled: false,
						symbol: 'circle',
						radius: 2,
						states: {
							hover: {
								enabled: true
							}
						}
					}
				}
			},
			series: [{
				data: [
					1000, 1200, 3000, 1436, 2063, 3057, 4618, 6444, 9822, 15468,
					20434, 24126, 27387, 29459, 31056, 31982, 32040, 31233, 29224, 27342,
					26662, 26956, 27912, 28999, 28965, 27826, 25579, 25722, 24826, 24605,
					24304, 23464, 23708, 24099, 24357, 24237, 24401, 24344, 23586, 22380,
					21004, 17287, 14747, 13076, 12555, 12144, 11009, 10950, 10871, 10824,
					10577, 10527, 10475, 10421, 10358, 10295, 10104, 9914, 9620, 9326,
					5113, 5113, 4954, 4804, 4761, 4717, 4368, 4018
				]
			}]
		});
		//Chart 2
		Highcharts.chart('container2', {
			chart: {
				style: {color: '#FFFFFF'},
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false,
				type: 'pie',
				width: 350,
				height: 250,
				backgroundColor: 'rgba(255, 255, 255, 0.0)'
			},
			title: {
				style: {color: '#FFFFFF', fontSize: '14px'},
				text: 'Browser market shares in January'
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			plotOptions: {
				style: {color: '#FFFFFF'},
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: true,
						style: {
							color: '#FFFFFF',
							fontSize: '10px,',
							fontWeight: '300'
						},
					}
				}
			},
			series: [{
				name: 'Brands',
				colorByPoint: true,
				data: [
					{name: 'Chrome', y: 61.41},
					{name: 'Internet Explorer', y: 11.84},
					{name: 'Firefox', y: 10.85},
					{name: 'Edge', y: 15.67},
					{name: 'Safari', y: 20.18}
				]
			}]
		});
	});
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})

</script>
