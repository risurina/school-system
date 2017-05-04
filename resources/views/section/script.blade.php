<script type="text/javascript" >
    var section_modal = $('#section_modal');
    var section_form = $('#section_form');

    /** Show modal **/
    function sectionCreateModal($lvl_id,$lvlName) {
      $('#sectionSave').attr({
        "onClick" : "sectionCreate("+$lvl_id+")",
        "disabled" : false,
      });

      section_form.trigger('reset');
      section_modal.modal('show');

      section_form.find('input[name=level]').val( $lvlName ).attr('disabled',true);

      section_form.find('.has-error').removeClass('has-error');
      $('#section_form [id^="error_"] .help-block').addClass('hidden');
    }

    function sectionCreate($lvl_id) {
      $('#sectionSave').attr('disabled',true);
      $.ajax({
        type: 'POST',
        url: "{{ route('section.create') }}",
        data: section_form.serialize() + "&level_id=" + $lvl_id + "&_token={{ csrf_token() }}",
        success: function(data) {
          $('#sectionSave').attr('disabled',false);
          var result = data.section + ' was added!';
          toastr.success( result, 'Saved!' );
          
          section_modal.modal('hide');
          setInterval(function(){ 
            location.reload();
          }, 1000);
        },
        error: function(resp){
          $('#sectionSave').attr('disabled',false);
          section_form.find('.has-error').removeClass('has-error');
          $('#section_form [id^="error_"] .help-block').addClass('hidden');

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
    function sectionUpdateModal($lvlName,data) {
      $('#sectionSave').attr({
        "onClick" : "sectionUpdate("+data.id+")",
        "disabled" : false,
      });

      section_form.trigger('reset');
      section_modal.modal('show');

      section_form.find('input[name=level]').val( $lvlName ).attr('disabled',true);
      section_form.find('input[name=section]').val( data.section );
      section_form.find('select[name=employee_id]').val( data.employee_id );
      section_form.find('select[name=schedule_id]').val( data.schedule_id );

      section_form.find('.has-error').removeClass('has-error');
      $('#section_form [id^="error_"] .help-block').addClass('hidden');
    }

    function sectionUpdate(id) {
      $('#sectionSave').attr('disabled',true);
      $.ajax({
        type: 'POST',
        url: "{{ route('section.update') }}",
        data: section_form.serialize() + "&id=" + id + "&_token={{ csrf_token() }}",
        success: function(data) {
          $('#sectionSave').attr('disabled',false);
          var result = data.section + ' was updated!';
          toastr.success( result, 'Updated!' );
          
          section_modal.modal('hide');
          setInterval(function(){ 
            location.reload();
          }, 1000);
          
        },
        error: function(resp){
          $('#sectionSave').attr('disabled',false);
          section_form.find('.has-error').removeClass('has-error');
          $('#section_form [id^="error_"] .help-block').addClass('hidden');

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

    function sectionDelete(id) {
      $.ajax({
        type: 'POST',
        url: "{{ route('section.delete') }}",
        data:  "id=" + id + "&_token={{ csrf_token() }}",
        success: function(data) {
          if (data.error) {
            var result = data.error;
            toastr.warning( result, 'Warning!' );
          }else{
            var result = data.section + ' was deleted!';
            toastr.warning( result, 'Deleted!' );
            setInterval(function(){ 
              location.reload();
            }, 1000);
          }
        }
      }); // end ajax
    }

</script>