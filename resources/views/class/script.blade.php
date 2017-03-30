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