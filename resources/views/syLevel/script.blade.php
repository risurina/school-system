<script type="text/javascript" >
    var sylvl_modal = $('#sylvl_modal');
    var sylvl_form = $('#sylvl_form');

    /** Show modal **/
    function sylvlCreateModal() {
      $('#sylvlSave').attr({
        "onClick" : "sylvlCreate()",
        "disabled" : false,
      });

      sylvl_form.trigger('reset');
      sylvl_modal.modal('show');

      sylvl_form.find('.has-error').removeClass('has-error');
      $('#sylvl_form [id^="error_"] .help-block').addClass('hidden');
    }

    function sylvlCreate() {
      $('#sylvlSave').attr('disabled',true);
      $.ajax({
        type: 'POST',
        url: "{{ route('syLevel.create') }}",
        data: sylvl_form.serialize() + "&_token={{ csrf_token() }}",
        success: function(data) {
          $('#sylvlSave').attr('disabled',false);

          if (data.error) {
            toastr.warning( data.error, 'Warning!' );
          }else{
            toastr.success( data.level + ' was added!', 'Saved!' );

            setInterval(function(){ 
              location.reload();
            }, 1000);
          }

          sylvl_modal.modal('hide');
          
        },
        error: function(resp){
          $('.ibox-title').html( resp.responseText );
          $('#sylvlSave').attr('disabled',false);
          sylvl_form.find('.has-error').removeClass('has-error');
          $('#sylvl_form [id^="error_"] .help-block').addClass('hidden');

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

    /** Delete Level **/
    function syLevelDelete(id) {
      $.ajax({
        type: 'POST',
        url: "{{ route('syLevel.delete') }}",
        data:  "id=" + id + "&_token={{ csrf_token() }}",
        success: function(data) {
          if (data.error) {
            var result = data.error;
            toastr.warning( result, 'Warning!' );
          }else{
            var result = data.level + ' was deleted!';
            toastr.warning( result, 'Deleted!' );
            setInterval(function(){ 
              location.reload();
            }, 1000);
          }
        }
      }); // end ajax
    }
</script>