</div>
</div>


<script src="<?= base_url() ?>assets/js/main.js"></script>

<script class="">
	$(document).ready(function () {
		$(document).on('change', '.btn-file :file', function () {
			var input = $(this),
				label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [label]);
		});

		$('.btn-file :file').on('fileselect', function (event, label) {

			var input = $(this).parents('.input-group').find(':text'),
				log = label;

			if (input.length) {
				input.val(log);
			} else {
				if (log) alert(log);
			}

		});





	});




	$(document).on('click', '.remove_document', function () {
		$(this).parent('div').parent('div').remove();
	});

	$('.add_new_row').click(function () {
		var l = 2;
		$('.first_row').append('<div class="form-group row" style="position: relative;">\n' +
			'<label\n' +
			'class="col-sm-2 col-form-label"></label>\n' +
			'<div class="col-sm-9">\n' +
			'<select value="" class="currency form-control form-control-sm">\n' +
			'<option>opton 1</option>\n' +
			'<option>option 2</option>\n' +
			'</select>\n' +
			'</div>\n' +
			'<div class="col-1">\n' +
			'<button type="button" style="border:none;"\n' +
			'class="remove_new_row btn btn-outline-secondary float-right">\n' +
			'<i class="fas fa-trash"></i></i></button>\n' +
			'</div>\n' +
			'</div>');
		l++;
	});

	$(document).on('click', '.remove_new_row', function () {
		$(this).parent('div').parent('div').remove();
	});



</script>

<!--todo delete -->
	<a href="http://www.link.ru/promote/?partner=215369" target="_blank"><img src="http://link.link.ru/img/120x60-1.gif" border="0" width="120" height="60" alt="Контекстная Реклама на Link.ru"></a>

	<!-- start Link.Ru -->
	<script type="text/javascript">
		var LinkRuRND = Math.round(Math.random() * 100000000); document.write('<div id="linkru' + LinkRuRND  + '"></div>'); document.write('<scr'+'ipt src="http://link.link.ru/show?squareid=123404&showtype=28&output_style=1&shift_count=1&cat_id=10140&tar_id=1&theme=0&sc=3&bg=FFFFFF&bc=FFFFFF&tc=D5EFFF&tt=333333&tu=333333&th=525252&c7=&css=0&bwidth=undefined&bheight=undefined&fontsize=&h=&div=' +LinkRuRND+ '&r='+LinkRuRND+'&ref='+escape(document.referrer)+'&url='+escape(window.location.href)+'" type="text/javascript"></scr'+'ipt>');
	</script>
	<!-- end Link.Ru -->
<!--end of todo-->


</body>

