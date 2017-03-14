<script type="text/javascript" >
    var search_form = $('#search_form');
    var sy_modal = $('#sy_modal');
    var sy_form = $('#sy_form');

    /** Call school table view **/
    function syTable (link = '') {
      var url = "{{ route('sy.table') }}";
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
    
    /** Generate School Year **/
    function syCreate() {
      $.ajax({
          type: 'POST',
          url: "{{ route('sy.create') }}",
          data: "_token={{ csrf_token() }}",
          success: function(data) {
            var result = 'School year for ' + data.year + ' was created!';
            if (data == 'notAllow') {
              toastr.warning( 'Not this time.', 'Warning!' );
            }else{
              toastr.success( result, 'Created!' );
            }
            syTable();
          },
          error: function(msg){
            $('#table_body').html('<tr><td colspan="6">'+msg.responseText+'</td></tr>');
          }
      }); // end ajax
    }

    /** Show update modal **/
    function syUpdateModal(data) {
      sy_form.find('input[name=year]').val(data.year).attr('readonly',true);
      sy_form.find('input[name=code]').val(data.code).attr('readonly', true);
      sy_form.find('input[name=start]').val(data.start);
      sy_form.find('input[name=end]').val(data.end);
      sy_form.find('input[name=id]').val(data.id);

      sy_modal.modal('show');

      /** Remove error class in form **/
      sy_form.find('.has-error').removeClass('has-error');
      $('#sy_form [id^="error_"] .help-block').addClass('hidden');
    }

    function syUpdate() {
      $('#sySave').attr('disabled',true);
      $.ajax({
        type: 'POST',
        url: "{{ route('sy.update') }}",
        data: sy_form.serialize() + "&_token={{ csrf_token() }}",
        success: function(data) {
          $('#sySave').attr('disabled',false);
          var result = 'School year ' + data.year + ' was updated!';
          toastr.success( result, 'Updated!' );
          
          sy_modal.modal('hide');
          syTable();
        },
        error: function(resp){
          $('#sySave').attr('disabled',false);
          sy_form.find('.has-error').removeClass('has-error');
          $('#sy_form [id^="error_"] .help-block').addClass('hidden');

          var error = resp.responseJSON;
        
          $.each(error, function(i, v) {
            console.log(i + " => " + v); // view in console for error messages
            var msg = '* ' + v;
              $('#error_' + i).addClass('has-error');
              $('#error_'+i+' .help-block').removeClass('hidden').html(msg);
          });
          var keys = Object.keys(resp);
          $('input[name="'+keys[0]+'"]')
            .focus();$('#table_body')
            .html('<tr><td colspan="6">'+msg.responseText+'</td></tr>'
          );          
        }
      }); // end ajax
    }

    /** School Year  **/

    /** call show table function **/
    $(document).ready(function() {
      syTable();

      search_form.on('change keyup', function() {
        syTable();
      });
    });

    /** Pagination link **/
    $(document).on('click','.pagination a',function(e) {
      e.preventDefault();
      var link = $(this).attr('href');
      syTable(link);
    });
</script>