<script type="text/javascript" >
    var search_form = $('#search_form');
    var school_modal = $('#school_modal');
    var school_form = $('#school_form');

    /** Call school table view **/
    function schoolTable (link = '') {
      var url = "{{ route('school.table') }}";
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
    
    /** Delete Functions **/
    function schoolDelete(id,name) {
      $.ajax({
          type: 'POST',
          url: "{{ route('school.delete') }}",
          data: 'id='+ id + '&_token={{ csrf_token() }}',
          success: function(data) {
              var result = name + ' was deleted!'
              toastr.error(result + "<a onClick='(schoolRestore(\""+id+"\",\""+name+"\"))'> Undo?</a>",
                            'Deleted!');
              schoolTable();
          },
          error: function(msg){
            alert('Somethine went wrong. \n'+
              'Please contact your system administrator or software distributor!');
          }
      }); // end ajax
    }

    /** Restore Funstions **/
    function schoolRestore(id,schoolName) {
      $.ajax({
          type: 'POST',
          url: "{{ route('school.restore') }}",
          data: 'id='+ id + '&_token={{ csrf_token() }}',
          success: function(data) {
              var result = schoolName + ' was restored!'
              toastr.success(result,
                            'Restored!');
              schoolTable();
          },
          error: function(msg){
            alert('Somethine went wrong. \n'+
              'Please contact your system administrator or software distributor!');
          }
      }); // end ajax
    }

    /** Show create modal **/
    function schoolCreate() {
      $('#schoolSave').attr("onClick","schoolSave('')").attr('disabled',false);;
      school_form.trigger('reset');
      school_modal.modal('show');
      $('input[name=code]').attr('disabled',false);

      school_form.find('.has-error').removeClass('has-error');
      $('#school_form [id^="error_"] .help-block').addClass('hidden');
    }

    /** Show update modal **/
    function schoolUpdate(data) {
      $('#schoolSave').attr("onClick","schoolSave('"+ data.id +"')").attr('disabled',false);
      $('input[name=code]').val(data.code).attr('disabled',true);
      $('input[name=name]').val(data.name);
      $('input[name=address]').val(data.address);

      school_modal.modal('show');

      school_form.find('.has-error').removeClass('has-error');
      $('#school_form [id^="error_"] .help-block').addClass('hidden');
    }

    /** Save function for create and update **/
    function schoolSave(id) {
      $('#schoolSave').attr('disabled',true);
      var dt = school_form.serialize() +  '&_token={{ csrf_token() }}';
      var $url = "{{ route('school.create') }}";
      if (id != '') {
        dt = dt + '&id='+ id;
        var $url = "{{ route('school.update') }}";
      }
      $.ajax({
          type: 'POST',
          url: $url,
          data: dt,
          success: function(data) {
            school_modal.modal('hide');
            $('.modal-backdrop').remove();
            var msg = data.name + ' was added!';
            if (id != '') { msg = data.name + ' was updated!'; }
            toastr.success(msg, 'Saved!');
            
            schoolTable();
          },
          error: function(resp){
              $('#schoolSave').attr('disabled',false);
              school_form.find('.has-error').removeClass('has-error');
              $('#school_form [id^="error_"] .help-block').addClass('hidden');

              var error = resp.responseJSON;
              $.each(error, function(i, v) {
                console.log(i + " => " + v); // view in console for error messages
                var msg = '* ' + v;
                $('#error_' + i).addClass('has-error');
                $('#error_'+i+' .help-block').removeClass('hidden').html(msg);
              });
              var keys = Object.keys(resp);
              $('input[name="'+keys[0]+'"]').focus();
          }
      }); // end ajax
    }

    /** call show table function **/
    $(document).ready(function() {
      schoolTable();

      search_form.on('change keyup', function() {
        schoolTable();
      });
    });

    /** Pagination link **/
    $(document).on('click','.pagination a',function(e) {
      e.preventDefault();
      var link = $(this).attr('href');
      schoolTable(link);
    });
</script>