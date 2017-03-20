<script type="text/javascript" >
    var lvlSearch_form = $('#lvlSearch_form');
    var lvl_modal = $('#lvl_modal');
    var lvl_form = $('#lvl_form');

    /** Call school table view **/
    function lvlTable (link = '') {
      var url = "{{ route('lvl.table') }}";
      if (link != '') { url = link; };

      $.ajax({
        type: 'POST',
        url: url,
        data: lvlSearch_form.serialize() + '&_token={{ csrf_token() }}',
        success: function(res) {
          var table_row = $(res).find('tr').clone();
          $('#table_body').html(table_row);
        },
        error: function(msg){
          $('#table_body').html('<tr><td colspan="6">'+msg.responseText+'</td></tr>');
        }
      });
    }
    
    /** Show modal **/
    function lvlCreateModal() {
      $('#lvlSave').attr({
        "onClick" : "lvlCreate()",
        "disabled" : false,
      });

      lvl_form.find('#id').remove();
      lvl_form.trigger('reset');
      lvl_modal.modal('show');
      lvl_modal.find('#lvlSave').attr('onClick',"lvlCreate()");

      sectionAppend.find('.col-lg-12').remove();

      var yearSelected = lvlSearch_form.find('select[name=year]').val();
      lvl_form.find('select[name=year]').val(yearSelected).attr('disabled',false);
      lvl_form.find('input[name=name]').attr('disabled',false);

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
          var result = data.name + ' was added!';
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
      lvl_form.find('select[name=year]').val(data.year).attr("disabled",true);
      lvl_form.find('input[name=name]').val(data.level.name).attr("disabled",false);;

      lvl_form.find('input[name=id]').val(data.level.id);
      sectionAppend.find('.col-lg-12').remove();

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
          var result = data.name + ' was updated!';
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

      lvlSearch_form.on('change keyup', function() {
        lvlTable();
      });

      lvlSearch_form.on('submit',function(e) {
        e.preventDefault();
      });
    });

    /** Pagination link **/
    $(document).on('click','.pagination a',function(e) {
      e.preventDefault();
      var link = $(this).attr('href');
      lvlTable(link);
    });
</script>

<!-- Section Script -->
<script>
  var sectionAppend = $('#sectionAppend');
  var sectionName = '<div class="col-xs-12 col-lg-12">'+
                      '<div class="form-group" id="error_section">'+
                        '<label for="section" class="col-sm-5 control-label">'+
                          '<i>Section <span>*</span></i>'+
                        '</label>'+
                        '<div class="col-sm-7">'+
                          '<input type="text" name="section" '+
                            'class="form-control col-md-7 col-xs-12" '+
                            'placeholder="Section">'+
                          '<span class="help-block"></span>'+
                        '</div>'+
                      '</div>'+
                    '</div><!-- /.col -->';
  var scheduleHtml = '<div class="col-xs-12 col-lg-12">'+
                      '<div class="form-group" id="error_schedule">'+
                        '<label for="schedule" class="col-sm-5 control-label">'+
                          '<i>Schedule <span>*</span></i>'+
                        '</label>'+
                        '<div class="col-sm-7">'+
                          '<input type="time" name="schedule" '+
                            'class="form-control col-md-7 col-xs-12" '+
                            'placeholder="schedule">'+
                          '<span class="help-block"></span>'+
                        '</div>'+
                      '</div>'+
                    '</div><!-- /.col -->';
  var adviserHtml = '<div class="col-xs-12 col-lg-12">'+
                      '<div class="form-group" id="error_employee">'+
                        '<label for="employee" class="col-sm-5 control-label">'+
                          '<i>Adviser <span>*</span></i>'+
                        '</label>'+
                        '<div class="col-sm-7">'+
                          '<select  name="employee_id" class="form-control col-md-7 col-xs-12 input-sm">'+
                              @foreach($employeeList as $emp)
                                  '<option value="{{ $emp->id }}">'+
                                      '{{ $emp->lastName. ', ' .$emp->firstName }}' +
                                  '</option>'+
                              @endforeach
                          '</select>'+
                          '<span class="help-block"></span>'+
                        '</div>'+
                      '</div>'+
                    '</div><!-- /.col -->';

  function secCreateModal(data) {
      lvl_form.find('select[name=year]').val(data.year).attr("disabled",true);
      lvl_form.find('input[name=name]').val(data.level.name).attr("disabled",true);

      lvl_form.find('input[name=id]').val(data.level.id);

      lvl_modal.find('#lvlSave').
        attr('onClick', 'secCreate()');

      lvl_modal.modal('show');
      lvl_modal.find('.ibox-title h4').text('Section Form');
      lvl_form.find('.modal-dialog').removeClass('modal-sm');

      /** Remove error class in form **/
      lvl_form.find('.has-error').removeClass('has-error');
      $('#lvl_form [id^="error_"] .help-block').addClass('hidden');

      sectionAppend.html(sectionName + scheduleHtml + adviserHtml);
  }

  function secCreate(dtYear,dtLevelID) {
      $('#lvlSave').attr('disabled',true);
      dtYear =  "&year=" + dtYear;
      dtLevelID = "&levelID=" + dtLevelID; 

      $.ajax({
        type: 'POST',
        url: "{{ route('sec.create') }}",
        data: lvl_form.serialize() + dtYear + dtLevelID + "&_token={{ csrf_token() }}",
        success: function(data) {
          $('#lvlSave').attr('disabled',false);
          var result = 'Section ' + data.section + ' was added!';
          toastr.success( result, 'Saved!' );
          
          lvl_modal.modal('hide');
          lvlTable();
        },
        error: function(resp){
          $('#table_body').html(
            "<tr><td colspan='10'>"+resp.responseText+"</td></tr>"
          );

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

  function secUpdateModal(year,lvl,data) {
      sectionAppend.html(sectionName + scheduleHtml + adviserHtml);

      lvl_form.find('select[name=year]').val(year).attr("disabled",true);
      lvl_form.find('input[name=name]').val(lvl).attr("disabled",true);

      lvl_form.find('input[name=section]').val(data.section);
      lvl_form.find('input[name=schedule]').val(data.schedule);
      lvl_form.find('select[name=employee_id]').val(data.employee.id);
      lvl_form.find('input[name=id]').val(data.id);

      lvl_modal.find('#lvlSave').
        attr('onClick', 'secUpdate()');

      lvl_modal.modal('show');
      lvl_modal.find('.ibox-title h4').text('Section Form');

      /** Remove error class in form **/
      lvl_form.find('.has-error').removeClass('has-error');
      $('#lvl_form [id^="error_"] .help-block').addClass('hidden');
  }

  function secUpdate(data) {
      $('#lvlSave').attr('disabled',true);

      $.ajax({
        type: 'POST',
        url: "{{ route('sec.update') }}",
        data: lvl_form.serialize() + "&_token={{ csrf_token() }}",
        success: function(data) {
          $('#lvlSave').attr('disabled',false);
          var result = 'Section ' + data.section + ' was updated!';
          toastr.success( result, 'Saved!' );
          
          lvl_modal.modal('hide');
          lvlTable();
        },
        error: function(resp){
          $('#table_body').html(
            "<tr><td colspan='10'>"+resp.responseText+"</td></tr>"
          );

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
</script>