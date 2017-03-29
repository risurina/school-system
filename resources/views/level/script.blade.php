<script type="text/javascript" >
    var lvl_modal = $('#lvl_modal');
    var lvl_form = $('#lvl_form');

    /** Call Level table view **/
    function lvlTable (link = '') {
      let url = "{{ route('lvl.table') }}";
      if (link != '') { url = link; };
      let data = 'lvlSearch_key='+$('input[name=lvlSearch_key]').val() + '&_token={{ csrf_token() }}';
      $.ajax({
        type: 'POST',
        url: url,
        data: data,
        success: function(res) {
          let lvlTable_row = $(res).find('tr').clone();
          let lvlPage_link = $(res).find('#lvlPagination_row').clone();
          $('#lvlTable_body').html(lvlTable_row);
          $('#lvlTbl_paginate_row').remove();
          $('#lvlTable_pagination').html(lvlPage_link);
        },
        error: function(msg){
          $('#lvlTable_body').html('<tr><td colspan="6">'+msg.responseText+'</td></tr>');
        }
      });
    }

    /** Show modal **/
    function lvlCreateModal() {
      $('#lvlSave').attr({
        "onClick" : "lvlCreate()",
        "disabled" : false,
      });

      lvl_form.find('#lvlID').html('');
      lvl_form.trigger('reset');
      lvl_modal.modal('show');
      lvl_modal.find('#lvlSave').attr('onClick',"lvlCreate()");

      lvl_form.find('.has-error').removeClass('has-error');
      $('#lvl_form [id^="error_"] .help-block').addClass('hidden');
    }

    function lvlCreate() {
      $('#lvlSave').attr('disabled',true);
      $.ajax({
        type: 'POST',
        url: "{{ route('lvl.create') }}",
        data: lvl_form.serialize() + "&_token={{ csrf_token() }}",
        success: function(data) {
          $('#lvlSave').attr('disabled',false);
          var result = data.level + ' was added!';
          toastr.success( result, 'Saved!' );
          
          lvl_modal.modal('hide');
          lvlTable();
        },
        error: function(resp){
          $('#lvlSave').attr('disabled',false);
          lvl_form.find('.has-error').removeClass('has-error');
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
    function lvlUpdateModal(data) {
      lvl_form.find('#lvlID').html('<input type="hidden" name="id" value="'+data.id+'">');
      lvl_form.find('input[name=code]').val(data.code);
      lvl_form.find('input[name=level]').val(data.level);

      lvl_modal.find('#lvlSave').attr('onClick', 'lvlUpdate()');
      lvl_modal.modal('show');

      /** Remove error class in form **/
      lvl_form.find('.has-error').removeClass('has-error');
      $('#lvl_form [id^="error_"] .help-block').addClass('hidden');
    }

    function lvlUpdate() {
      $('#lvlSave').attr('disabled',true);
      $.ajax({
        type: 'POST',
        url: "{{ route('lvl.update') }}",
        data: lvl_form.serialize() + "&_token={{ csrf_token() }}",
        success: function(data) {
          $('#lvlSave').attr('disabled',false);
          var result = data.level + ' was updated!';
          toastr.success( result, 'Updated!' );
          
          lvl_modal.modal('hide');
          lvlTable();
        },
        error: function(resp){
          $('#lvlSave').attr('disabled',false);
          lvl_form.find('.has-error').removeClass('has-error');
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
      lvlTable();

      $('input[name=lvlSearch_key]').on('keyup',function() {
        lvlTable();
      });
    });

    /** Pagination link **/
    $(document).on('click','.lvlTable_pagination a',function(e) {
      e.preventDefault();
      var link = $(this).attr('href');
      lvlTable(link);
    });
</script>