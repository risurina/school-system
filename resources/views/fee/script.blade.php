<script type="text/javascript" >
    var fee_modal = $('#fee_modal');
    var fee_form = $('#fee_form');

    /** Call school table view **/
    function feeTable (link = '') {
      let url = "{{ route('fee.table') }}";
      if (link != '') { url = link; };
      let data = 'feeSearch_key='+$('input[name=feeSearch_key]').val() + '&_token={{ csrf_token() }}';
      $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(resp) {
          let feeTable_row = $(resp).find('tr').clone();
          let feePage_link = $(resp).find('#feePagination_row').clone();
          $('#testSample').html(feeTable_row);
          $('#feeTbl_paginate_row').remove();
          $('#feeTable_pagination').html(feePage_link);
          $('.pagination').addClass('pagination-sm no-margin');
        },
        error: function(msg){
          $('#feeTable_body').html('<tr><td colspan="6">Please reload!</td></tr>');
        }
      });
    }

    /** Show modal **/
    function feeCreateModal() {
      $('#feeSave').attr({
        "onClick" : "feeCreate()",
        "disabled" : false,
      });

      fee_form.find('#feeID').html('');
      fee_form.trigger('reset');
      fee_modal.modal('show');
      fee_modal.find('#feeSave').attr('onClick',"feeCreate()");

      fee_form.find('.has-error').removeClass('has-error');
      $('#fee_form [id^="error_"] .help-block').addClass('hidden');
    }

    function feeCreate() {
      $('#feeSave').attr('disabled',true);
      $.ajax({
        type: 'POST',
        url: "{{ route('fee.create') }}",
        data: fee_form.serialize() + "&_token={{ csrf_token() }}",
        success: function(data) {
          $('#feeTable_body').html(
            '<tr><td>'+data.responseText+'</td></tr>'
          );

          $('#feeSave').attr('disabled',false);
          var result = data.fee + ' was added!';
          toastr.success( result, 'Saved!' );
          
          fee_modal.modal('hide');
          feeTable();
        },
        error: function(resp){
          $('#feeSave').attr('disabled',false);
          fee_form.find('.has-error').removeClass('has-error');
          $('#fee_form [id^="error_"] .help-block').addClass('hidden');

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
    function feeUpdateModal(data) {
      fee_form.find('#feeID').html('<input type="hidden" name="id" value="'+data.id+'">');
      fee_form.find('input[name=code]').val(data.code);
      fee_form.find('input[name=fee]').val(data.fee);
      fee_form.find('input[name=amount]').val(data.amount);
      fee_form.find('select[name=isDefault]').val(data.isDefault);

      fee_modal.find('#feeSave').attr('onClick', 'feeUpdate()');
      fee_modal.modal('show');

      /** Remove error class in form **/
      fee_form.find('.has-error').removeClass('has-error');
      $('#fee_form [id^="error_"] .help-block').addClass('hidden');
    }

    function feeUpdate() {
      $('#feeSave').attr('disabled',true);
      $.ajax({
        type: 'POST',
        url: "{{ route('fee.update') }}",
        data: fee_form.serialize() + "&_token={{ csrf_token() }}",
        success: function(data) {
          $('#feeSave').attr('disabled',false);
          var result = data.fee + ' was updated!';
          toastr.success( result, 'Updated!' );
          
          fee_modal.modal('hide');
          feeTable();
        },
        error: function(resp){
          $('#feeSave').attr('disabled',false);
          fee_form.find('.has-error').removeClass('has-error');
          $('#fee_form [id^="error_"] .help-block').addClass('hidden');

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
      feeTable();
    });

    $('input[name=feeSearch_key]').on('keyup',function() {
        feeTable();
    });

    /** Pagination link **/
    $(document).on('click','.feeTable_pagination a',function(e) {
      e.preventDefault();
      var link = $(this).attr('href');
      feeTable(link);
    });
</script>