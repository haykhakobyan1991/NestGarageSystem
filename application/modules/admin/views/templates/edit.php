<?
$controller = $this->router->fetch_class();
$page =  $this->router->fetch_method();
$url=base_url().'admin/'.$this->uri->segment(0);
//var_dump($this->uri->segment(0));
?>


<script src="<?=base_url()?>assets/jquery/choosen/chosen.jquery.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/jquery/choosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
<script src="<?=base_url()?>assets/jquery/choosen/docsupport/init.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?=base_url()?>assets/jquery/jquery.dragsort-0.5.2.min.js"></script>
<!--<script src="--><?//=base_url()?><!--application/js/base.js"></script>-->
<script src="<?=base_url()?>assets/ckeditor/ckeditor.js"></script>
<script src="<?=base_url()?>assets/ckfinder/ckfinder.js"></script>
<script src="<?=base_url()?>assets/jquery-ui/jquery-ui.min.js"></script>

<script src="<?=base_url()?>assets/js/bootstrap/popper.min.js"></script>
<script src="<?=base_url()?>assets/js/bootstrap/bootstrap.min.js"></script>



<script type='text/javascript'>

	function close_message() {
		setTimeout(function(){ $('.alert-success, .alert-danger').addClass('d-none'); }, 3000);
	}

	function scroll_top(){
		$('html, body').animate({scrollTop:0},700);
	}
	function progressHandlingFunction(e){
		if(e.lengthComputable){
			var percentComplete = e.loaded/e.total*100;
			$('#head_load').css('width', percentComplete+'%');
		}
	}


	function beforeSendHandler(e){
		$('.alert-success, .alert-danger').addClass('d-none');
	}

	function completeHandler(e){
		var error = '';
		$('.alert-danger').removeClass('d-none');
		if ($.isArray(e.error.elements)) {
			scroll_top();
			$.each(e.error.elements, function( index ) {
				$.each(e.error.elements[index], function( index, value  ) {
					if(value != '') {

						$("input[name='" + index + "']").addClass('border border-danger');
						$("textarea[name='" + index + "']").addClass('border border-danger');
						error += value + ' ';
					}
				});
			});
		} else {
			scroll_top();
			error = e.error;
		}
		if (e.success == '1') {
			scroll_top();
			$('.alert-danger').addClass('d-none');
			$('.alert-success').removeClass('d-none');
			$('.alert-success').html(e.message);
			var url = "<?=$url?>";
			$(location).attr('href',url);
			close_message();
		} else {
			scroll_top();
			$('.alert-success').addClass('d-none');
			$('.alert-danger').removeClass('d-none');
			$('.alert-danger').html(error);
		}
	}

	function errorHandler(e){
		scroll_top();
		$('.alert-danger').removeClass('d-none');
		$('.alert-danger').html(e);
	}

	$(document).ready(function() {
		$('#submit').click(function() {
			var url = "<?=base_url().'admin/'.$controller?>/<?=$this->uri->segment(0).'_ax'?>";
			var formData = new FormData($('form')[0]);
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'json',
				xhr: function() {
					var myXhr = $.ajaxSettings.xhr();
					if(myXhr.upload){
						myXhr.upload.addEventListener('progress', progressHandlingFunction, false);
					}
					return myXhr;
				},
				beforeSend: beforeSendHandler,
				success: completeHandler,
				error: errorHandler,
				data: formData,
				cache: false,
				contentType: false,
				processData: false
			});
		});
	});
</script>
