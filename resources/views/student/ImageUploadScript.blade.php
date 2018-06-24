<script type="text/javascript">
	var uploadImage_modal = $('#uploadImage_modal');
	var uploadImage_form = $('#uploadImage_form');

	function uploadImageModal($studentProgress_id) {
		uploadImage_form.find( 'input[name=studentProgress_id]' ).val( $studentProgress_id );
		uploadImage_modal.modal( 'show' );
	}

	function uploadImage() {
		$.ajax({
		    url:'{{ route('studentProgress.uploadImage') }}',
		    data: new FormData($("#uploadImage_form")[0]),
		    dataType:'json',
		    async:false,
		    type:'post',
		    processData: false,
		    contentType: false,
		    success:function(resp){
		        //studentTable();
		    	alert( 'Image Uploaded!' );
		        location.reload(true);
		    },
		    error: function(resp){
	          uploadImage_form.find('.has-error').removeClass('has-error');
	          $('#uploadImage_form [id^="error_"] .help-block').addClass('hidden');

	          var error = resp.responseJSON;
	        
	          $.each(error, function(i, v) {
	            var resp = '* ' + v;
	              $('#error_' + i).addClass('has-error');
	              $('#error_'+i+' .help-block').removeClass('hidden').html(resp);
	          });       
	        }
	    });
	}
</script>