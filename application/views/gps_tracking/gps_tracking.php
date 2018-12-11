<script src="https://www.gstatic.com/firebasejs/5.6.0/firebase.js"></script>
<script>
	// Initialize Firebase
	var config = {
		apiKey: "AIzaSyCXe53OPy3WBeXRud_Muy3jfHqMlcgFsh0",
		authDomain: "mapdraw-303a9.firebaseapp.com",
		databaseURL: "https://mapdraw-303a9.firebaseio.com",
		projectId: "mapdraw-303a9",
		storageBucket: "mapdraw-303a9.appspot.com",
		messagingSenderId: "169827754958"
	};
	firebase.initializeApp(config);
</script>
<script src="https://api-maps.yandex.ru/2.1/?apikey=624e82b8-f673-476e-ada3-3c68555422b9&lang=ru_RU" type="text/javascript"></script>
<style>
	.settings_btn,.print-btn,.plus_btn,.set_btn,.delete_btn {
		border: none !important;
		outline: none !important;
		cursor: pointer;
	}

	.settings_btn,.print-btn:hover,.settings_btn,.print-btn:focus,.plus_btn:hover,.plus_btn:focus,.set_btn:hover,.set_btn:focus,.delete_btn:focus,.delete_btn:hover {
		border: none !important;
		outline: none !important;
		cursor: pointer;
		background: #fff !important;
	}

	legend.scheduler-border {
		width:inherit; /* Or auto */
		padding:0 10px; /* To give a bit of padding on the left and right */
		border-bottom:none;
	}

	fieldset.scheduler-border {
		border: 1px groove #ddd !important;
		padding: 0 1.4em 1.4em 1.4em !important;
		margin: 0 0 1.5em 0 !important;
		-webkit-box-shadow:  0px 0px 0px 0px #000;
		box-shadow:  0px 0px 0px 0px #000;
	}

	.fleets_ul li {
		margin: 2px;
		padding: 2px 8px;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
		cursor: pointer;
		-webkit-transition: all .3s ease-in-out;
		-moz-transition: all .3s ease-in-out;
		-ms-transition: all .3s ease-in-out;
		-o-transition: all .3s ease-in-out;
		transition: all .3s ease-in-out;
	}

	.fleets_ul li:hover{
		background: #7c7c7d;
		color: #fff;
	}

	.fleets_ul_active {
		background: #7c7c7d;
		color: #fff;
	}

</style>
<div class="container-fluid pl-0 pr-0" style="margin-top: -11px;margin-bottom: 5px;">
	<nav class="navbar navbar-expand-lg navbar-light bg-light pl-0 pr-0">
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav mr-auto">
				<button style="color:#00000080 !important;min-width: 120px;max-height: 40px;" class="btn btn-outline-secondary  nav-item nav-link mr-1" href="#"><img style="margin-right: 5px;margin-left: -15px;" src="<?= base_url() ?>assets/images/gps_tracking/satellite.svg" />Trajectory</button>
				<button style="color:#00000080 !important;min-width: 120px;max-height: 40px;" class="btn btn-outline-secondary  nav-item nav-link mr-1" href="#"><img style="margin-right: 5px;margin-left: -15px;" src="<?= base_url() ?>assets/images/gps_tracking/speedometer.svg" />Speed</button>
				<button style="color:#00000080 !important;min-width: 120px;max-height: 40px;" class="btn btn-outline-secondary  nav-item nav-link mr-1" href="#"><img style="margin-right: 5px;margin-left: -15px;" src="<?= base_url() ?>assets/images/gps_tracking/gas-station.svg" />Fuel</button>
				<button style="color:#00000080 !important;min-width: 120px;max-height: 40px;" class="btn btn-outline-secondary  nav-item nav-link mr-1 " href="#"><img style="margin-right: 5px;margin-left: -15px;" src="<?= base_url() ?>assets/images/gps_tracking/engine.svg" />Engine</button>
				<button style="color:#00000080 !important;min-width: 120px;max-height: 40px;" class="btn btn-outline-secondary  nav-item nav-link mr-1 " href="#"><img style="margin-right: 5px;margin-left: -15px;" src="<?= base_url() ?>assets/images/gps_tracking/box.svg" />Cargo</button>
				<button style="color:#00000080 !important;min-width: 120px;max-height: 40px;" class="btn btn-outline-secondary  nav-item nav-link mr-1 " href="#"><img style="margin-right: 5px;margin-left: -15px;" src="<?= base_url() ?>assets/images/gps_tracking/support.svg" />Sos</button>

				<button style="color:#00000080 !important;min-width: 120px;display: inline-block;max-height: 40px;" class="btn btn-outline-secondary  nav-item nav-link mr-1 ml-1" href="#">Notification</button>
				<button style="color:#00000080 !important;min-width: 120px;display: inline-block;max-height: 40px;" class="btn btn-outline-secondary  nav-item nav-link mr-1 " href="#">Events</button>
				<button style="color:#00000080 !important;min-width: 120px;display: inline-block;max-height: 40px;" class="btn btn-outline-secondary  nav-item nav-link mr-1 " href="#">Statistics</button>


					<label style="padding: 10px 6px 0px 10px;">Update</label>
					<select style="margin-top: 1px" class="form-control form-control-sml">
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>5</option>
						<option>10</option>
						<option>15</option>
						<option>20</option>
						<option>25</option>
					</select>


			</div>

			<div class="navbar-nav ml-auto">
				<button style="color:#00000080 !important;display: inline-block;max-height: 40px;padding: 7px 24px !important;" class="btn btn-outline-secondary  nav-item nav-link mr-1 settings_btn" href="#"><img style="margin-right: 5px;margin-left: -15px;" src="<?= base_url() ?>assets/images/gps_tracking/settings-work-tool.svg" class="ml-0 mr-0 " /></button>
				<button style="color:#00000080 !important;display: inline-block;max-height: 40px;padding: 7px 24px !important;" class="btn btn-outline-secondary  nav-item nav-link mr-1 print-btn" href="#"><img style="margin-right: 5px;margin-left: -15px;" src="<?= base_url() ?>assets/images/gps_tracking/print.svg" class="ml-0 mr-0 "/></button>
			</div>
		</div>
	</nav>
</div>


<div class="container-fluid pl-0 pr-0" style="outline: 1px solid #ccc;">
	<div class="row">
		<div class="col-sm-9">
			<div id="map" style="width: 100%; height: 650px;"></div>
		</div>

		<div class="col-sm-3 pr-4">
			<fieldset class="scheduler-border">
				<legend class="scheduler-border">Group</legend>
				<div class="control-group">
					<div class="controls bootstrap-timepicker"  >
						<div class="row">
							<div class="col-sm-6">
								<select style="margin-top: 1px;max-width: 220px;" class="form-control form-control-sml">
									<option>group 1</option>
									<option>group 2</option>
									<option>group 3</option>
									<option>group 4</option>
								</select>
							</div>
							<div class="col-sm-6" style="padding-top: 4px;">
								<button class="btn btn-sm btn-outline-secondary plus_btn mr-3" style="width: 20px;padding: 2px !important;"><img style="margin-right: 5px;margin-left: -15px;" src="<?= base_url() ?>assets/images/gps_tracking/plus-black-symbol.svg" class="ml-0 mr-0 " /></button>
								<button class="btn btn-sm btn-outline-secondary set_btn mr-3" style="width: 20px;padding: 2px !important;"><img style="margin-right: 5px;margin-left: -15px;" src="<?= base_url() ?>assets/images/gps_tracking/settings-work-tool.svg" class="ml-0 mr-0 " /></button>
								<button class="btn btn-sm btn-outline-secondary delete_btn" style="width: 20px;padding: 2px !important;"><img style="margin-right: 5px;margin-left: -15px;" src="<?= base_url() ?>assets/images/gps_tracking/delete.svg" class="ml-0 mr-0 " /></button>
							</div>
						</div>
					</div>
				</div>
			</fieldset>

			<fieldset class="scheduler-border">
				<legend class="scheduler-border">Vehicles</legend>
				<div class="control-group">
					<div class="controls bootstrap-timepicker" >
						<div class="row">
							<div class="col-sm-12">
								<ul style="margin-top: 1px;min-height: 170px;overflow-y: auto;" class="fleets_ul form-control form-control-sml">
									<li>fleet 1</li>
									<li>fleet 2</li>
									<li>fleet 3</li>
									<li>fleet 4</li>
									<li>fleet 4</li>
									<li>fleet 4</li>
									<li>fleet 4</li>
									<li>fleet 4</li>
									<li>fleet 4</li>
									<li>fleet 4</li>
									<li>fleet 4</li>
									<li>fleet 4</li>
									<li>fleet 4</li>
									<li>fleet 4</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</fieldset>

			<fieldset class="scheduler-border">
				<legend class="scheduler-border">Informaton</legend>
				<div class="control-group">
					<div class="controls bootstrap-timepicker" >
						<div class="row">
							<div class="col-sm-12" style="min-height: 170px;overflow-y: auto;">
								<div class="row">
									<div class="col-sm-4">Անուն</div>
									<div class="col-sm-8">Maz_1</div>
								</div>

								<div class="row">
									<div class="col-sm-4">Պետհամարանիշ</div>
									<div class="col-sm-8">452uu74</div>
								</div>

								<div class="row">
									<div class="col-sm-4">Տեսակը</div>
									<div class="col-sm-8">Բեռնատար</div>
								</div>

								<div class="row">
									<div class="col-sm-4">ԻՀ։</div>
									<div class="col-sm-8">487871123597487</div>
								</div>

								<div class="row">
									<div class="col-sm-4">Նկարագիր</div>
									<div class="col-sm-8">Կորյուն Մարուքյան</div>
								</div>

								<div class="row">
									<div class="col-sm-4">Հեռ․ Համար</div>
									<div class="col-sm-8">+37455554455</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</fieldset>
		</div>
	</div>
</div>

<script>

	$(document).on('click', '.fleets_ul li', function() {
		$(this).toggleClass('fleets_ul_active');
	})

</script>


<script type="text/javascript">


	const db = firebase.firestore();
	db.settings({timestampsInSnapshots: true});
	var d = new Date();
	var t = d.getTime()
	counter = t;


	// setInterval(function () {

	//     lat =  parseFloat(lat + 0.0001);
	//     long = parseFloat(long + 0.0001);


	// var ref = firebase.database().ref('cord/1544097063591/').update({long, lat})
	// },2000);


	// $('button').click(function () {
	// 	var coordinate = [];
	//
	// 	var lat = $('input[name="x"]').val();
	// 	var long = $('input[name="y"]').val();
	// 	var d1 = $('input[name="d1"]').val();
	// 	var d2 = $('input[name="d2"]').val();
	// 	var text = $('input[name="text"]').val();
	//
	// 	counter += 1;
	//
	// 	db.collection('GPS').add({
	// 		cord: {
	// 			'id': counter,
	// 			'lat': lat,
	// 			'long': long,
	// 			'd1': d1,
	// 			'd2': d2,
	// 			'text': text
	// 		}
	// 	});
	//
	//
	// 	$('input').val('');
	// 	db.collection('GPS').get().then((snapshots) => {
	// 		location.reload();
	// 	})
	//
	//
	// });


	var arr = [];
	var d1_arr = [];
	var d2_arr = [];
	var text_arr = [];
	db.collection('GPS').orderBy('cord.id').get().then((snapshots) => {

		snapshots.docs.forEach(doc => {

			lat = doc.data().cord.lat;
			long = doc.data().cord.long;
			d1 = doc.data().cord.d1;
			d2 = doc.data().cord.d2;
			text = doc.data().cord.text;


			arr.push([lat, long]);
			d1_arr.push(d1);
			d2_arr.push(d2);
			text_arr.push(text);


		});
		ymaps.ready(function () {

			if (arr.length == 0) {
				var arr_a = [35.6697343, 19.9361881];
				var zoom = 3;
			} else {
				var arr_a = arr[0];
				var zoom = 17;
			}

			var myMap = new ymaps.Map('map', {
				center: arr_a,
				zoom: zoom,
			});
			console.log(arr)
			var myGeoObject = new ymaps.GeoObject({
				geometry: {
					type: "LineString",
					coordinates: arr
				},
				properties: {
					hintContent: "",
					balloonContent: ""
				}
			}, {
				draggable: false,
				strokeColor: "#4285F4",
				strokeWidth: 5
			});




			// var pointA = [55.80, 37.50],
			//     pointB = [55.80, 37.40],
			//     pointC = [55.70, 37.50],
			//     pointD = [55.70, 37.40];

			//     var multiRoute = new ymaps.multiRouter.MultiRoute({
			//         referencePoints: [
			//                           '55.80, 37.50',
			//                           '55.80, 37.40',
			//                           '55.70, 37.50',
			//                           '55.70, 37.40'
			//                         ],
			//         params: {
			//             routingMode: ''
			//         }
			//         }, {
			//             boundsAutoApply: false
			//         });

			// // Создаем карту с добавленной на нее кнопкой.
			// var myMap = new ymaps.Map('map', {
			//     center: [55.739625, 37.54120],
			//     zoom: 12,
			// }, {
			//     buttonMaxWidth: 300
			// });

			// // Добавляем мультимаршрут на карту.
			// myMap.geoObjects.add(multiRoute);








			//Car Coordinates

			var cord = firebase.database().ref("cord/");

			console.log(cord)
			var track = [];
			cord.on("child_changed", function (data) {
				var carCoordinate = '';
				cordValue = data.val();
				latitude = cordValue.lat;
				longitude = cordValue.long;

				console.log(latitude);
				console.log(longitude);

				if(track.indexOf([latitude.toFixed(5), longitude.toFixed(5)]) === -1) {
					track.push([latitude.toFixed(5), longitude.toFixed(5)]);

				}

				console.log(track);
				var myGeoObject2 = new ymaps.GeoObject({
					geometry: {
						type: "LineString",
						coordinates: track
					},
					properties: {
						hintContent: "",
						balloonContent: ""
					}
				}, {
					draggable: false,
					strokeColor: "#4285F4",
					strokeWidth: 3
				});
				myMap.geoObjects.add(myGeoObject2);


				carCoordinate = new ymaps.Placemark([latitude, longitude], {
					balloonContent: latitude + '-' + longitude
				}, {
					iconLayout: 'default#image',
					iconImageHref: '<?= base_url() ?>assets/images/ymap/car.svg',
					iconImageSize: [35, 30],
					iconImageOffset: [-10, -30]
				});

				myMap.geoObjects.removeAll();
				myMap.geoObjects.add(carCoordinate);


				myMap.geoObjects
					.add(carCoordinate)
					.add(myGeoObject)
					.add(myGeoObject2);


				// var i = 1;
				//
				// $.each(arr, function (e, value) {
				//
				// 	if (i == 1) {
				// 		myPlacemark = new ymaps.Placemark(value, {
				// 			balloonContentHeader: text_arr[e],
				// 			balloonContentBody: "<span>" + d1_arr[e] + "</span>  /  <span>" + d2_arr[e] + "</span>",
				// 			balloonContentFooter: "",
				// 			hintContent: value
				// 		}, {
				// 			preset: 'islands#greenDotIcon',
				// 		});
				// 	} else if (i > 1 && i < arr.length) {
				// 		myPlacemark = new ymaps.Placemark(value, {
				// 				balloonContentHeader: text_arr[e],
				// 				balloonContentBody: "<span>" + d1_arr[e] + "</span>  /  <span>" + d2_arr[e] + "</span>",
				// 				balloonContentFooter: "",
				// 				hintContent: value
				// 			},
				// 			{
				// 				preset: 'islands#blueCircleDotIconWithCaption',
				// 				iconCaptionMaxWidth: '50'
				// 			});
				// 	} else if (i == arr.length) {
				// 		myPlacemark = new ymaps.Placemark(value, {
				// 			balloonContentHeader: text_arr[e],
				// 			balloonContentBody: "<span>" + d1_arr[e] + "</span>  /  <span>" + d2_arr[e] + "</span>",
				// 			balloonContentFooter: "",
				// 			hintContent: value
				// 		}, {
				// 			preset: 'islands#redDotIcon',
				// 		});
				// 	}
				// 	myMap.geoObjects.add(myPlacemark);
				//
				// 	i++;
				//
				// })

			})

			cord.on("child_added", function (data) {
				var carCoordinate = '';
				cordValue = data.val();
				latitude = cordValue.lat;
				longitude = cordValue.long;

				console.log(latitude);
				console.log(longitude);

				carCoordinate = new ymaps.Placemark([latitude, longitude], {
					balloonContent: latitude + '-' + longitude
				}, {
					iconLayout: 'default#image',
					iconImageHref: '<?= base_url() ?>assets/images/ymap/car.svg',
					iconImageSize: [35, 30],
					iconImageOffset: [-10, -35]
				});


				myMap.geoObjects
					.add(carCoordinate);
			})


			myMap.geoObjects.add(myGeoObject);
			var i = 1;

			$.each(arr, function (e, value) {

				if (i == 1) {
					myPlacemark = new ymaps.Placemark(value, {
						balloonContentHeader: text_arr[e],
						balloonContentBody: "<span>" + d1_arr[e] + "</span>  /  <span>" + d2_arr[e] + "</span>",
						balloonContentFooter: "",
						hintContent: value
					}, {
						preset: 'islands#greenDotIcon',
					});
				} else if (i > 1 && i < arr.length) {
					myPlacemark = new ymaps.Placemark(value, {
							balloonContentHeader: text_arr[e],
							balloonContentBody: "<span>" + d1_arr[e] + "</span>  /  <span>" + d2_arr[e] + "</span>",
							balloonContentFooter: "",
							hintContent: value
						},
						{
							preset: 'islands#blueCircleDotIconWithCaption',
							iconCaptionMaxWidth: '50'
						});
				} else if (i == arr.length) {
					myPlacemark = new ymaps.Placemark(value, {
						balloonContentHeader: text_arr[e],
						balloonContentBody: "<span>" + d1_arr[e] + "</span>  /  <span>" + d2_arr[e] + "</span>",
						balloonContentFooter: "",
						hintContent: value
					}, {
						preset: 'islands#redDotIcon',
					});
				}
				myMap.geoObjects.add(myPlacemark);

				myMap.geoObjects.add(myPlacemark);
				i++;

			})
		});

	});


</script>
