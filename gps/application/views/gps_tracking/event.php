<style>
	table {
		height: 100vh;
		max-height: 82%;
		min-height: 72%;
	}
	th {
		text-align: center;
		vertical-align: top !important;
	}
	td {
		max-width: 40px;
		min-width: 40px;
		text-align: center;
		vertical-align: top !important;

	}
	span.today {
		border-radius: 50%;
		background: #007bff;
		width: 25px;
		height: 25px;
		display: inline-block;
		padding: 2px;
		color: #fff;
	}
</style>

<?
echo $calendar;
?>

<script>
	$(document).ready(function () {
		$('td.current').each(function () {
			$(this).attr('data-day', $('input[name="ym"]').val()+'-'+$(this).children('span:first-child').text());
		})
	})
</script>



<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">New Event</h5>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<div class="md-form">
							<label>Time</label>
							<input name="from" placeholder="Selected time" type="time" id="input_starttime" class="form-control timepicker">
						</div>
					</div>
					<div class="form-group">
						<label>Title</label>
						<input name="title" type="text" class="form-control" value="">
					</div>
					<div class="form-group">
						<label>Description</label>
						<textarea name="description" class="form-control"  rows="3"></textarea>
					</div>
					<input type="hidden" name="day" value="">
				</form>
			</div>
			<div class="modal-footer">
				<button id="load" class="btn btn-sm btn-outline-success cancel_btn d-none" style="max-height: 40px; min-width: 93px;"><img
						style="height: 20px;margin: 0 auto;display: block;text-align: center;"
						src="<?= base_url() ?>assets/images/bars2.svg"/></button>
				<button type="button" class="cancel_btn close btn btn-sm clean"
						data-dismiss="modal"
						aria-label="Close">
					<?= lang('cancel') ?>
				</button>
				<button data-dismiss="modal"
						aria-label="Close" id="add_event" type="button"
						class=" btn close btn-outline-success cancel_btn"><?= lang('save') ?>
				</button>
			</div>
		</div>
	</div>
</div>


<script>

	$('#add_event').click(function  () {
		var new_event = $('input[name="title"]').val();
		console.log(new_event)
		var day = $('input[name="day"]').val();
		console.log(day)

		$('td.current').each(function () {

			if($(this).data('day') == day){
				$(this).append('<span class="mt-1 badge badge-pill badge-primary event" style="cursor: pointer; display: block; background-color: rgb(121,134,203)">'+new_event+'</span>')
			}

		});
	});

	$('td').click(function () {
		var day = $(this).data('day');
		console.log(day)
		$('input[name="day"]').val(day);
	})

	$('.cancel_btn').click(function () {
		$('input[name="title"]').val('');
		$('textarea[name="description"]').text('');
		$('input[name="from"]').val('');
	})

</script>
