<script type="text/javascript" >
    var studentPayment_modal = $('#studentPayment_modal');
    var studentPayment_form = $('#studentPayment_form');

    /** Show modal **/
    function studentPaymentCreateModal( $paymentBy ) {
      $('#studentPaymentSave').attr({
        "onClick" : "studentPaymentCreate()",
        "disabled" : false,
      });

      studentPayment_form.trigger('reset');
      studentPayment_modal.modal('show');

      studentPayment_form.find('#feeGroup1').show();
      studentPayment_form.find('#feeGroup2').hide();

      /** Select Fees */
      if ( studentPayment_form.find('select[name=fee]').val() ) {
        let selectedFee = $.parseJSON( studentPayment_form.find('select[name=fee]').val() );

        studentPayment_form.find('input[name=student_fee_id]').val( selectedFee.id );
        studentPayment_form.find('input[name=balance]').val( selectedFee.balance ).attr('disabled',true);
        studentPayment_form.find('input[name=amount]').val( selectedFee.balance );

        studentPayment_form.find('select[name=fee]').on('change select',function() {
          let selectedFee = $.parseJSON( studentPayment_form.find('select[name=fee]').val() );

          studentPayment_form.find('input[name=student_fee_id]').val( selectedFee.id );
          studentPayment_form.find('input[name=balance]').val( selectedFee.balance ).attr('disabled',true);
          studentPayment_form.find('input[name=amount]').val( selectedFee.balance );
        }); 
      } else {
        studentPayment_modal.find('.ibox-content').html(
          "<center><h4>All fees are paid!</h4></center>"
        );
      }
      /** Select Fees */

      studentPayment_form.find('input[name=payment_by]').val( $paymentBy )

      studentPayment_form.find('.has-error').removeClass('has-error');
      $('#studentPayment_form [id^="error_"] .help-block').addClass('hidden');
    }

    function studentPaymentCreate() {
      $('#studentPaymentSave').attr('disabled',true);
      $.ajax({
        type: 'POST',
        url: "{{ route('studentPayment.create') }}",
        data: studentPayment_form.serialize() + "&_token={{ csrf_token() }}",
        success: function(data) {
          $('#studentPaymentSave').attr('disabled',false);
          var result = 'Payment for ' + data.fee + ' was added!';
          toastr.success( result, 'Saved!' );
          
          studentPayment_modal.modal('hide');
          setInterval(function(){ 
            location.reload();
          }, 1000);
        },
        error: function(resp){
          $('#studentPaymentSave').attr('disabled',false);
          studentPayment_form.find('.has-error').removeClass('has-error');
          $('#studentPayment_form [id^="error_"] .help-block').addClass('hidden');

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

    function studentPaymentUpdateModal( data ) {
      console.log( data );
      $('#studentPaymentSave').attr({
        "onClick" : "studentPaymentUpdate()",
        "disabled" : false,
      });

      studentPayment_form.find('#feeGroup1').hide();
      studentPayment_form.find('#feeGroup2').show();
      studentPayment_form.find('input[name=id]').val( data.id );
      studentPayment_form.find('input[name=feeName]').val( data.fee )
      studentPayment_form.find( 'input[name=amount]' ).val( data.amount );
      studentPayment_form.find( 'input[name=invNo]' ).val( data.invNo );
      studentPayment_form.find( 'input[name=payment_by]' ).val( data.payment_by );
      studentPayment_form.find( 'input[name=payment_date]' ).val( data.payment_date );

      studentPayment_modal.modal('show');
    }

    function studentPaymentUpdate() {
      $('#studentPaymentSave').attr('disabled',true);
      $.ajax({
        type: 'POST',
        url: "{{ route('studentPayment.update') }}",
        data: studentPayment_form.serialize() + "&_token={{ csrf_token() }}",
        success: function(data) {
          $('#studentPaymentSave').attr('disabled',false);
          var result = 'Payment for ' + data.fee + ' was updated!';
          toastr.success( result, 'Updated!' );
          
          studentPayment_modal.modal('hide');
          setInterval(function(){ 
            location.reload();
          }, 1000);
        },
        error: function(resp){
          $('#studentPaymentSave').attr('disabled',false);
          studentPayment_form.find('.has-error').removeClass('has-error');
          $('#studentPayment_form [id^="error_"] .help-block').addClass('hidden');

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

    function studentPaymentCancel(id) {
      $.ajax({
        type: 'POST',
        url: "{{ route('studentPayment.cancel') }}",
        data:  "id=" + id + "&_token={{ csrf_token() }}",
        success: function(data) {
            var result = 'Payment for ' + data.payment + ' was cancelled!';
            toastr.error( result, 'Cancelled!' );
            setInterval(function(){ 
              location.reload();
            }, 1000);
        }
      }); // end ajax
    }

    function studentPaymentRestore(id) {
      $.ajax({
        type: 'POST',
        url: "{{ route('studentPayment.restore') }}",
        data:  "id=" + id + "&_token={{ csrf_token() }}",
        success: function(data) {
            var result = 'Payment for ' + data.payment + ' was restored!';
            toastr.success( result, 'Restored!' );
            setInterval(function(){ 
              location.reload();
            }, 1000);
        },
        error: function(resp) {
          //$('.ibox-content').html(resp.responseText);
        }
      }); // end ajax
    }

</script>