<script type="text/javascript" >
    var search_form = $('#search_form');

    /** Call Level table view **/
    function attendanceTable(link = '') {
      $.ajax({
        type: 'POST',
        url:  "{{ route('attendance.table') }}",
        data: search_form.serialize() + '&_token={{ csrf_token() }}' ,
        success: function(res) {
          console.log(res);
          let attendanceTable_row = $(res).find('tr').clone();
          let attendancePage_link = $(res).find('#attendancePagination_row').clone();
          $('#attendanceTable_body').html(attendanceTable_row);
          $('#attendanceTbl_paginate_row').remove();
          //$('#attendanceTable_pagination').html(attendancePage_link);
        },
        error: function(msg){
          $('#attendanceTable_body').html('<tr><td colspan="6">'+msg.responseText+'</td></tr>');
        }
      });
    }

    function data_table() {
      $('#attendanceTable').DataTable({
          pageLength: 20,
          responsive: true,
          dom: '<"html4buttons"B>lTfgitp',
          buttons: [
              { extend: 'copy'},
              {extend: 'csv'},
              {extend: 'excel', title: 'Attendance'},
              {extend: 'pdf', title: 'Attendance'},
          ]
        });
    }

    /** call show table function **/
    $(document).ready(function() {
      attendanceTable();

      search_form.on('keyup change',function() {
        attendanceTable();
      });

      data_table()
    });

    /** Pagination link **/
    $(document).on('click','.attendanceTable_pagination a',function(e) {
      e.preventDefault();
      var link = $(this).attr('href');
      attendanceTable(link);
    });
</script>