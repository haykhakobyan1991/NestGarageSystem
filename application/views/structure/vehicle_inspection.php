<div class="row col-sm-12 col-md-12 bpp_o">
	<div class="container-fluid">
		<table id="ex_1" class="table table-striped table-borderless w-100">
			<thead class="thead_tables">
			<tr>
				<th class="table_th">ID</th>
				<th class="table_th">Երբ</th>
				<th class="table_th">Ում Կողմից</th>
				<th class="table_th">Վերջնաժամկետ</th>
				<th class="table_th">Գումար</th>
				<th class="">
					<button class="add_new_tr btn btn-outline-secondary btn-sm " data-id="ex_1"
							style="padding: .25rem .5rem !important;">
						<i class="fa fa-plus"> </i>
					</button>
				</th>
			</tr>
			</thead>
			<tbody class="ex_1">
			<tr>
				<td class="sorting_1">1</td>
				<td><input title="" readonly type="text" name="date[1]" value="<?= mdate('%Y-%m-%d', now()) ?>"
						   class="in_row_input text-center"/></td>
				<td><input title="" readonly type="text" name="user[1]" value="<?= $user['name'] ?>"
						   class="in_row_input text-center"/></td>
				<td><input title="" type="text" name="end_date[1]" value="" class="in_row_input text-center"/></td>
				<td><input title="" type="text" name="price[1]" value="" class="in_row_input text-center"/></td>
				<td></td>
			</tr>
			</tbody>
		</table>
	</div>
</div>


