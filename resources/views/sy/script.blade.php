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
          $('#table_body').html(table_row);
          $('#tbl_paginate_row').remove();
          $('#table_pagination').html(page_link);
          $('.pagination').addClass('pagination-sm pull-right no-margin');
        },
        error: function(msg){
          $('#table_body').html('<tr><td colspan="6" class="text-center">Please reload!</td></tr>');
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