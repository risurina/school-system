<script type="text/javascript" >
    var studentFee_modal = $('#studentFee_modal');
    var studentFee_form = $('#studentFee_form');

    /** Show modal **/
    function studentFeeCreateModal(student_progress_id) {
      $('#studentFeeSave').attr({
        "onClick" : "studentFeeCreate("+ student_progress_id +")",
        "disabled" : false,
      });

      studentFee_form.trigger('reset');
      studentFee_modal.modal('show');

      /** Select Fees */
      let selectedFee = $.parseJSON( studentFee_form.find('select[name=fee]').val() );
      
      studentFee_form.find('input[name=fee_id]').val( selectedFee.id );
      studentFee_form.find('input[name=feeAmount]').val( selectedFee.amount );
      studentFee_form.find('input[name=discount]').val( 0 );

      studentFee_form.find('select[name=fee]').on('change select',function() {
        let selectedFee = $.parseJSON( studentFee_form.find('select[name=fee]').val() );

        studentFee_form.find('input[name=fee_id]').val( selectedFee.id );
        studentFee_form.find('input[name=feeAmount]').val( selectedFee.amount );
        studentFee_form.find('input[name=discount]').val( 0 );

      }); 
      /** Select Fees */

      studentFee_form.find('.has-error').removeClass('has-error');
      $('#studentFee_form [id^="error_"] .help-block').addClass('hidden');
    }

    function studentFeeCreate(student_progress_id) {
      $('#studentFeeSave').attr('disabled',true);
      $.ajax({
        type: 'POST',
        url: "{{ route('studentFee.create') }}",
        data: studentFee_form.serialize() + 
              "&student_progress_id=" + 
              student_progress_id + 
              "&_token={{ csrf_token() }}",
        success: function(data) {
          $('#studentFeeSave').attr('disabled',false);
          var result = data.fee + ' was added!';
          toastr.success( result, 'Saved!' );
          
          studentFee_modal.modal('hide');
          setInterval(function(){ 
            location.reload();
          }, 1000);
        },
        error: function(resp){
          $('#studentFeeSave').attr('disabled',false);
          studentFee_form.find('.has-error').removeClass('has-error');
          $('#studentFee_form [id^="error_"] .help-block').addClass('hidden');

          var error = resp.responseJSON;
        
          $.each(error, function(i, v) {
            var resp = '* ' + v;
              $('#error_' + i).addClass('has-error');
              $('#error_'+i+' .help-block').removeClass('hidden').html(resp);
          });
          var keys = Object.keys(resp);
          $('input[name="'+keys[0]+'"]').focus();          
        }
      }); // end ajax
    }

    /** Show update modal **/
    function studentFeeUpdateModal(data) {
      $('#studentFeeSave').attr({
        "onClick" : "studentFeeUpdate("+data.id+")",
        "disabled" : false,
      });

      studentFee_form.find('select[name=fee_id]').val( data.fee_id ).attr( 'disabled',true );
      studentFee_form.find('input[name=feeAmount]').val( data.feeAmount );
      studentFee_form.find('input[name=discount]').val( data.discount );

      studentFee_modal.modal('show');

      studentFee_form.find('.has-error').removeClass('has-error');
      $('#studentFee_form [id^="error_"] .help-block').addClass('hidden');
    }

    function studentFeeUpdate(id) {
      $('#studentFeeSave').attr('disabled',true);
      $.ajax({
        type: 'POST',
        url: "{{ route('studentFee.update') }}",
        data: studentFee_form.serialize() + "&id=" + id + "&_token={{ csrf_token() }}",
        success: function(data) {
          $('#studentFeeSave').attr('disabled',false);
          var result = data.fee + ' was updated!';
          toastr.success( result, 'Updated!' );
          
          studentFee_modal.modal('hide');
          setInterval(function(){ 
            location.reload();
          }, 1000);
          
        },
        error: function(resp){
          $('#studentFeeSave').attr('disabled',false);
          studentFee_form.find('.has-error').removeClass('has-error');
          $('#studentFee_form [id^="error_"] .help-block').addClass('hidden');

          var error = resp.responseJSON;
        
          $.each(error, function(i, v) {
            var resp = '* ' + v;
              $('#error_' + i).addClass('has-error');
              $('#error_'+i+' .help-block').removeClass('hidden').html(resp);
          });
          var keys = Object.keys(resp);
          $('input[name="'+keys[0]+'"]').focus();          
        }
      }); // end ajax
    }

    function studentFeeDelete(id) {
      $.ajax({
        type: 'POST',
        url: "{{ route('studentFee.delete') }}",
        data:  "id=" + id + "&_token={{ csrf_token() }}",
        success: function(data) {
          if (data.error) {
            var result = data.error;
            toastr.warning( result, 'Warning!' );
          }else{
            var result = data.fee + ' was deleted!';
            toastr.warning( result, 'Deleted!' );
            setInterval(function(){ 
              location.reload();
            }, 1000);
          }
        }
      }); // end ajax
    }

</script>