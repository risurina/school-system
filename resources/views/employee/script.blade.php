<script type="text/javascript" >
    var search_form = $('#search_form');
    var emp_modal = $('#emp_modal');
    var emp_form = $('#emp_form');

    /** Call school table view **/
    function empTable (link = '') {
      var url = "{{ route('emp.table') }}";
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
          $('#table_body').html('<tr><td colspan="6">Please reload!</td></tr>');
        }
      });
    }
    
    /** Show modal **/
    function empCreateModal() {
      $('#empSave').attr({
        "onClick" : "empCreate()",
        "disabled" : false,
      });
      emp_form.find('#id').remove();
      emp_form.trigger('reset');
      emp_modal.modal('show');

      emp_form.find('.has-error').removeClass('has-error');
      $('#emp_form [id^="error_"] .help-block').addClass('hidden');
    }

    /** Show update modal **/
    function empUpdateModal(data) {
      emp_form.find('input[name=number]').val(data.number); 
      emp_form.find('input[name=eeNum]').val(data.eeNum); 
      emp_form.find('input[name=firstName]').val(data.firstName); 
      emp_form.find('input[name=middleName]').val(data.middleName); 
      emp_form.find('input[name=lastName]').val(data.lastName);
      emp_form.find('input[name=status]').val(data.status);
      emp_form.find('input[name=position]').val(data.position); 
      emp_form.find('input[name=level]').val(data.level); 
      emp_form.find('input[name=hiredDate]').val(data.hiredDate); 
      emp_form.find('input[name=dateOfBirth]').val(data.dateOfBirth); 
      emp_form.find('input[name=age]').val(data.age);
      emp_form.find('input[name=basicSalary]').val(data.basicSalary); 
      emp_form.find('input[name=allowance]').val(data.allowance); 
      emp_form.find('input[name=takeHome]').val(data.takeHome); 
      emp_form.find('input[name=daysOfWork]').val(data.daysOfWork); 
      emp_form.find('input[name=endDate]').val(data.endDate);
      emp_form.find('input[name=percent]').val(data.percent); 
      emp_form.find('input[name=bonus]').val(data.bonus); 
      emp_form.find('input[name=declare]').val(data.declare); 
      emp_form.find('input[name=er]').val(data.er); 
      emp_form.find('input[name=ee]').val(data.ee); 
      emp_form.find('input[name=tc]').val(data.tc); 

      if (data.isActive) {
        emp_form.find('input[name=isActive]').attr('checked',true);
      }

      emp_form.find('input[name=id]').val(data.id);

      emp_modal.find('#empSave').attr('onClick', 'empUpdate()');
      emp_modal.modal('show');

      /** Remove error class in form **/
      emp_form.find('.has-error').removeClass('has-error');
      $('#emp_form [id^="error_"] .help-block').addClass('hidden');
    }

    function empUpdate() {
      $('#empSave').attr('disabled',true);
      $.ajax({
        type: 'POST',
        url: "{{ route('emp.update') }}",
        data: emp_form.serialize() + "&_token={{ csrf_token() }}",
        success: function(data) {
          $('#empSave').attr('disabled',false);
          var result = data.firstName + ' was updated!';
          toastr.success( result, 'Updated!' );
          
          emp_modal.modal('hide');
          empTable();
        },
        error: function(resp){
          $('#empSave').attr('disabled',false);
          emp_form.find('.has-error').removeClass('has-error');
          $('#emp_form [id^="error_"] .help-block').addClass('hidden');

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

    function empCreate() {
      $('#empSave').attr('disabled',true);
      $.ajax({
        type: 'POST',
        url: "{{ route('emp.create') }}",
        data: emp_form.serialize() + "&_token={{ csrf_token() }}",
        success: function(data) {
          $('#table_body')
            .html('<tr><td colspan="6">'+data.responseText+'</td></tr>'
          );
          $('#empSave').attr('disabled',false);
          var result = data.firstName + ' was created!';
          toastr.success( result, 'Created!' );
          
          emp_modal.modal('hide');
          empTable();
        },
        error: function(resp){
          $('#empSave').attr('disabled',false);
          emp_form.find('.has-error').removeClass('has-error');
          $('#emp_form [id^="error_"] .help-block').addClass('hidden');

          var error = resp.responseJSON;
        
          $.each(error, function(i, v) {
            console.log(i + " => " + v); // view in console for error messages
            var resp = '* ' + v;
              $('#error_' + i).addClass('has-error');
              $('#error_'+i+' .help-block').removeClass('hidden').html(resp);
          });
          var keys = Object.keys(resp);
          $('input[name="'+keys[0]+'"]').focus();          
        }
      }); // end ajax
    }

    /** School Year  **/

    /** call show table function **/
    $(document).ready(function() {
      empTable();

      search_form.on('change keyup', function() {
        empTable();
      });
    });

    /** Pagination link **/
    $(document).on('click','.pagination a',function(e) {
      e.preventDefault();
      var link = $(this).attr('href');
      empTable(link);
    });
</script>