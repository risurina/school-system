<script type="text/javascript" >
    var sylvlfee_modal = $('#sylvlfee_modal');
    var sylvlfee_form = $('#sylvlfee_form');

    /** Show modal **/
    function sylvlfeeCreateModal($lvl_id,$lvlName) {
      $('#sylvlfeeSave').attr({
        "onClick" : "sylvlfeeCreate("+$lvl_id+")",
        "disabled" : false,
      });

      sylvlfee_form.trigger('reset');
      sylvlfee_modal.modal('show');

      sylvlfee_form.find('input[name=level]').val( $lvlName ).attr('disabled',true);

      /** Select Fees */
      let selectedFee = $.parseJSON( sylvlfee_form.find('select[name=fee]').val() );

      sylvlfee_form.find('input[name=fee_id]').val( selectedFee.id );
      sylvlfee_form.find('input[name=feeAmount]').val( selectedFee.amount );

      sylvlfee_form.find('select[name=fee]').on('change select',function() {
        let selectedFee = $.parseJSON( sylvlfee_form.find('select[name=fee]').val() );

        sylvlfee_form.find('input[name=fee_id]').val( selectedFee.id );
        sylvlfee_form.find('input[name=feeAmount]').val( selectedFee.amount );
      });
      /** Select Fees */

      sylvlfee_form.find('.has-error').removeClass('has-error');
      $('#sylvlfee_form [id^="error_"] .help-block').addClass('hidden');
    }

    function sylvlfeeCreate($lvl_id) {
      $('#sylvlfeeSave').attr('disabled',true);
      $.ajax({
        type: 'POST',
        url: "{{ route('sylvlfee.create') }}",
        data: sylvlfee_form.serialize() + "&level_id=" + $lvl_id + "&_token={{ csrf_token() }}",
        success: function(data) {
          $('#sylvlfeeSave').attr('disabled',false);
          var result = data.fee + ' was added!';
          toastr.success( result, 'Saved!' );
          
          sylvlfee_modal.modal('hide');
          setInterval(function(){ 
            location.reload();
          }, 1000);
        },
        error: function(resp){
          $('#sylvlfeeSave').attr('disabled',false);
          sylvlfee_form.find('.has-error').removeClass('has-error');
          $('#sylvlfee_form [id^="error_"] .help-block').addClass('hidden');

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
    function sylvlfeeUpdateModal($lvlName,$feeName,data) {
      $('#sylvlfeeSave').attr({
        "onClick" : "sylvlfeeUpdate("+data.id+")",
        "disabled" : false,
      });

      sylvlfee_form.trigger('reset');
      sylvlfee_modal.modal('show');

      sylvlfee_form.find('#feeGroup').html(
        '<input class="form-control text-left"' + 
            'type="text"'+ 
            ' name="fee" ' +
            'value="'+ $feeName +'"' +
            'disabled'+
        '>'
      );


      sylvlfee_form.find('input[name=level]').val( $lvlName ).attr('disabled',true);
      sylvlfee_form.find('input[name=feeAmount]').val( data.feeAmount );

      sylvlfee_form.find('.has-error').removeClass('has-error');
      $('#sylvlfee_form [id^="error_"] .help-block').addClass('hidden');
    }

    function sylvlfeeUpdate(id) {
      $('#sylvlfeeSave').attr('disabled',true);
      $.ajax({
        type: 'POST',
        url: "{{ route('sylvlfee.update') }}",
        data: sylvlfee_form.serialize() + "&id=" + id + "&_token={{ csrf_token() }}",
        success: function(data) {
          $('#sylvlfeeSave').attr('disabled',false);
          var result = data.sylvlfee + ' was updated!';
          toastr.success( result, 'Updated!' );
          
          sylvlfee_modal.modal('hide');
          setInterval(function(){ 
            location.reload();
          }, 1000);
          
        },
        error: function(resp){
          $('#sylvlfeeSave').attr('disabled',false);
          sylvlfee_form.find('.has-error').removeClass('has-error');
          $('#sylvlfee_form [id^="error_"] .help-block').addClass('hidden');

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

    function sylvlfeeDelete(id) {
      $.ajax({
        type: 'POST',
        url: "{{ route('sylvlfee.delete') }}",
        data:  "id=" + id + "&_token={{ csrf_token() }}",
        success: function(data) {
          console.log(data);
          if (data.error) {
            var result = data.error;
            toastr.warning( result, 'Deleted!' );
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