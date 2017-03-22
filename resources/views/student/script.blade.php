<script type="text/javascript" >
    var search_form = $('#search_form');
    var student_modal = $('#student_modal');
    var student_form = $('#student_form');

    /** Call student table view **/
    function studentTable (link = '') {
      var url = "{{ route('student.table') }}";
      if (link != '') { url = link; };

      $.ajax({
        type: 'POST',
        url: url,
        data: search_form.serialize() + '&_token={{ csrf_token() }}',
        success: function(res) {
          var table_row = $(res).find('tr').clone();
          var page_link = $(res).find('#pagination_row').clone();
          console.log(page_link);
          $('#table_body').html(table_row);
          $('#tbl_paginate_row').remove();
          $('#table_pagination').html(page_link);
          $('.pagination').addClass('pagination-sm pull-right no-margin');
        },
        error: function(msg){
          $('#table_body').html('<tr><td colspan="6">'+msg.responseText+'</td></tr>');
        }
      });
    }
    
    /** Show create modal **/
    function studentCreateModal() {
      $('#studentSave').attr({
        "onClick" : "studentSave()",
        "disabled" : false,
      });

      student_form.trigger('reset');
      student_modal.find('#studentSave').attr('onClick',"studentCreate()");
      student_modal.modal('show');

      student_form.find('.has-error').removeClass('has-error');
      $('#student_form [id^="error_"] .help-block').addClass('hidden');
    }

    function studentCreate() {
      $('#studentSave').attr('disabled',true);
      $.ajax({
        type: 'POST',
        url: "{{ route('student.create') }}",
        data: student_form.serialize() + "&_token={{ csrf_token() }}",
        success: function(data) {
          $('#studentSave').attr('disabled',false);
          var result = data.firstName + ' was added!';
          toastr.success( result, 'Saved!' );
          
          student_modal.modal('hide');
          studentTable();
        },
        error: function(resp){
          $('#studentSave').attr('disabled',false);
          student_form.find('.has-error').removeClass('has-error');
          $('#lvl_form [id^="error_"] .help-block').addClass('hidden');

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
    function studentUpdateModal(data) {
      $('#studentSave').attr({
        "onClick" : "studentUpdate()",
        "disabled" : false,
      });
      student_form.find('input[name=lrnNo]').val(data.lrnNo);
      student_form.find('input[name=firstName]').val(data.firstName);
      student_form.find('input[name=lastName]').val(data.lastName);
      student_form.find('input[name=middleName]').val(data.middleName);
      student_form.find('input[name=dateOfBirth]').val(data.dateOfBirth);
      student_form.find('select[name=gender]').val(data.gender);

      student_modal.find('#studentSave')
            .attr('onClick',"studentUpdate('"+data.id+"')");
      student_modal.modal('show');

      student_form.find('.has-error').removeClass('has-error');
      $('#student_form [id^="error_"] .help-block').addClass('hidden');
    }

    function studentUpdate(id) {
      console.log(student_form.serialize()+ "&id="+ id);
      $('#studentSave').attr('disabled',true);
      $.ajax({
        type: 'POST',
        url: "{{ route('student.update') }}",
        data: student_form.serialize() +"&id="+ id + "&_token={{ csrf_token() }}",
        success: function(data) {
          $('#studentSave').attr('disabled',false);
          var result = data.firstName + ' was updated!';
          toastr.success( result, 'Saved!' );
          
          student_modal.modal('hide');
          studentTable();
        },
        error: function(resp){
          $('#table_body').html(
            "<tr><td>"+resp.responseText+"</td></tr>"
          );
          $('#studentSave').attr('disabled',false);
          student_form.find('.has-error').removeClass('has-error');
          $('#lvl_form [id^="error_"] .help-block').addClass('hidden');

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
      studentTable();

      search_form.on('change keyup', function() {
        studentTable();
      });
    });

    /** Pagination link **/
    $(document).on('click','.pagination a',function(e) {
      e.preventDefault();
      var link = $(this).attr('href');
      studentTable(link);
    });
</script>