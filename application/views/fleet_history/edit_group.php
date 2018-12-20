<div class="modal-body">
	<form id="group_edit">
		<div class="form-group row">
			<div class="col-sm-1"></div>
			<label class="col-sm-2 col-form-label"><?= lang('company_name') ?></label>
			<div class="col-sm-8">
				<input name="title" type="text" class="form-control"
					   placeholder="<?= lang('company_name') ?>">
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-1"></div>
			<label class="col-sm-2 col-form-label"><?= lang('more_info') ?></label>
			<div class="col-sm-8">
							<textarea name="description" type="text" class="form-control"
									  placeholder="<?= lang('more_info') ?>"></textarea>
			</div>
		</div>

		<input type="hidden" name="groups">

	</form>
	<hr class="my-2">
	<div class="row mt-1 pl-1 pr-1">
		<input id="sb_s" type="text" class="form-control" placeholder="<?= lang('search') ?>"
			   aria-label="Search" aria-describedby="basic-addon2" style="width: 50%;margin: 3px;">
		<div class="col-sm-6 scroll_style"
			 style="border: 5px solid #00000040;max-height: 300px; min-height: 300px; overflow-y: scroll;">

			<ul style="list-style: decimal;" class="list-group lg_1 mt-1">
				<? foreach ($result_fleets as $row_fleet) : ?>
					<li data-id="<?= $row_fleet['id'] ?>" style="cursor: pointer"
						class="p-1 sel_items mt-1 list-group-item"><?= $row_fleet['brand_model'] ?></li>
				<? endforeach; ?>
			</ul>
		</div>
		<div class="col-sm-1 text-center">

			<button class="save_cancel_btn btn btn-success mb-1 p-0 add_lg_2"
					style="margin-top: 100px;min-height: 30px !important;min-width: 35px !important;">
				<i style="font-size: 16px;" class="fas fa-long-arrow-alt-right"> </i>
			</button>

			<button class="save_cancel_btn btn btn-success p-0 remove_lg_2"
					style="min-height: 30px !important;min-width: 35px !important;">
				<i style="font-size: 16px;" class="fas fa-long-arrow-alt-left"> </i>
			</button>

		</div>
		<div class="col-sm-5 scroll_style"
			 style="border: 5px solid #00000040;max-height: 300px; min-height: 300px; overflow-y: scroll;">
			<ul class="list-group lg_2 mt-1">

			</ul>

		</div>

	</div>
</div>
<div class="modal-footer">
	<button id="edit_group" type="button"
			class="btn btn-outline-success cancel_btn"><?= lang('save') ?>
	</button>
	<button id="load" class="btn btn-sm btn-success d-none "><img
			style="height: 20px;margin: 0 auto;display: block;text-align: center;"
			src="<?= base_url() ?>assets/images/bars2.svg"/></button>
	<button type="button" class="cancel_btn close btn btn-sm"
			data-dismiss="modal"
			aria-label="Close">
		<?= lang('cancel') ?>
	</button>
</div>


