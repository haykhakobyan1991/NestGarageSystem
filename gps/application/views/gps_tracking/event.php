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
				<h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
