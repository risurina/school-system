<script type="text/javascript" >
    var schedule_modal = $('#schedule_modal');
    var schedule_form = $('#schedule_form');

    /** Call Level table view **/
    function scheduleTable (link = '') {
      let url = "{{ route('schedule.table') }}";
      if (link != '') { url = link; };
      let data = 'scheduleSearch_key='+$('input[name=scheduleSearch_key]')
                  .val() + '&_token={{ csrf_token() }}';
      $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(res) {
          let scheduleTable_row = $(res).find('tr').clone();
          let schedulePage_link = $(res).find('#schedulePagination_row').clone();
          $('#scheduleTable_body').html(scheduleTable_row);
          $('#scheduleTbl_paginate_row').remove();
          $('#scheduleTable_pagination').html(schedulePage_link);
        },
        error: function(msg){
          $('#scheduleTable_body').html('<tr><td colspan="6" class="text-center">Please reload!</td></tr>');
        }
      });
    }

    /** Show modal **/
    function scheduleCreateModal() {
      $('#scheduleSave').attr({
        "onClick" : "scheduleCreate()",
        "disabled" : false,
      });

      schedule_form.find('#scheduleID').html('');
      schedule_form.trigger('reset');
      schedule_modal.modal('show');
      schedule_modal.find('#scheduleSave').attr('onClick',"scheduleCreate()");

      schedule_form.find('.has-error').removeClass('has-error');
      $('#schedule_form [id^="error_"] .help-block').addClass('hidden');
    }

    function scheduleCreate() {
      $('#scheduleSave').attr('disabled',true);
      $.ajax({
        type: 'POST',
        url: "{{ route('schedule.create') }}",
        data: schedule_form.serialize() + "&_token={{ csrf_token() }}",
        success: function(data) {
          $('#scheduleSave').attr('disabled',false);
          var result = data.schedule + ' was added!';
          toastr.success( result, 'Saved!' );
          
          schedule_modal.modal('hide');
          scheduleTable();
        },
        error: function(resp){
          $('#scheduleSave').attr('disabled',false);
          schedule_form.find('.has-error').removeClass('has-error');
          $('#schedule_form [id^="error_"] .help-block').addClass('hidden');

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
    function scheduleUpdateModal(data) {
      schedule_form.find('#scheduleID').html('<input type="hidden" name="id" value="'+data.id+'">');
      schedule_form.find('input[name=schedule]').val(data.schedule);
      schedule_form.find('input[name=startTime]').val(data.startTime);
      schedule_form.find('input[name=endTime]').val(data.endTime);

      schedule_modal.find('#scheduleSave').attr('onClick', 'scheduleUpdate()');
      schedule_modal.modal('show');

      /** Remove error class in form **/
      schedule_form.find('.has-error').removeClass('has-error');
      $('#schedule_form [id^="error_"] .help-block').addClass('hidden');
    }

    function scheduleUpdate() {
      $('#scheduleSave').attr('disabled',true);
      $.ajax({
        type: 'POST',
        url: "{{ route('schedule.update') }}",
        data: schedule_form.serialize() + "&_token={{ csrf_token() }}",
        success: function(data) {
          $('#scheduleSave').attr('disabled',false);
          var result = data.schedule + ' was updated!';
          toastr.success( result, 'Updated!' );
          
          schedule_modal.modal('hide');
          scheduleTable();
        },
        error: function(resp){
          $('#scheduleSave').attr('disabled',false);
          schedule_form.find('.has-error').removeClass('has-error');
          $('#schedule_form [id^="error_"] .help-block').addClass('hidden');

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

    /** call show table function **/
    $(document).ready(function() {
      scheduleTable();

      $('input[name=scheduleSearch_key]').on('keyup',function() {
        scheduleTable();
      });
    });

    /** Pagination link **/
    $(document).on('click','.scheduleTable_pagination a',function(e) {
      e.preventDefault();
      var link = $(this).attr('href');
      scheduleTable(link);
    });
</script>