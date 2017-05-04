<!-- Student Information -->
<script type="text/javascript" >
  var student_modal = $('#student_modal');
  var student_form = $('#student_form');

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
        setInterval(function(){ 
            location.reload();
        }, 1000);
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
</script>
<!-- End Student Information -->

<!-- Student Progress -->
<script type="text/javascript">
  var progress_modal = $('#progress_modal');
  var progress_form = $('#progress_form');

  function progressCreateModal() {
    $('#progressSave').text('Enroll').attr({
      "onClick" : "progressCreate()",
      "disabled" : false,
    });

    progress_modal.find('.modal-title').html('Enrollment Form');
    progress_modal.modal('show');

    progress_form.find('.has-error').removeClass('has-error');
    $('#progress_form [id^="error_"] .help-block').addClass('hidden');
  }

  function progressCreate() {
      $('#progressSave').attr('disabled',true);
      $.ajax({
        type: 'POST',
        url: "{{ route('studentProgress.enroll') }}",
        data: progress_form.serialize() + "&_token={{ csrf_token() }}",
        success: function(data) {
          $('#progressSave').attr('disabled',false);
          var result = data.name + ' was enrolled!';
          toastr.success( result, 'Enrolled!' );
          
          progress_modal.modal('hide');
          setInterval(function(){ 
            location.reload();
          }, 1000);
        },
        error: function(resp){
          $('#progressSave').attr('disabled',false);
          progress_form.find('.has-error').removeClass('has-error');
          $('#progress_form [id^="error_"] .help-block').addClass('hidden');

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

  function progressUpdateModal($details,$sy_id,$level_id,$section_id) {
    $('#progressSave').text('Update').attr({
      "onClick" : "progressUpdate("+ $details.id +")",
      "disabled" : false,
    });
    progress_form.find( 'input[name=enrolledDate]' ).val( $details.enrolledDate );
    progress_form.find( 'select[name=isCash]' ).val( $details.isCash );
    progress_form.find( 'input[name=address]' ).val( $details.address );
    progress_form.find( 'input[name=mobileNo]' ).val( $details.mobileNo );
    progress_form.find( 'input[name=landlineNo]' ).val( $details.landlineNo );
    progress_form.find( 'input[name=guardianName]' ).val( $details.guardianName );
    progress_form.find( 'input[name=guardianRelationship]' ).val( $details.guardianRelationship );
    progress_form.find( 'input[name=healthProblem]' ).val( $details.healthProblem );
    progress_form.find( 'select[name=school_year]' ).val( $sy_id );

    getLevels( $sy_id );

    setTimeout(function(){ 
        progress_form.find( 'select[name=level]' ).val( $level_id );
        getLevelSection( $level_id ); 
    }, 200);

    setTimeout(function(){ 
        progress_form.find( 'select[name=section]' ).val( $section_id );
    }, 100);

    progress_modal.find('.modal-title').html('Enrollment Form');

    setTimeout(function(){
        progress_modal.modal('show').fadeIn('slow');
    }, 300);

    progress_form.find('.has-error').removeClass('has-error');
    $('#progress_form [id^="error_"] .help-block').addClass('hidden');
  }

  function progressUpdate(student_progress_id) {
      $('#progressSave').attr('disabled',true);
      $.ajax({
        type: 'POST',
        url: "{{ route('studentProgress.update') }}",
        data: progress_form.serialize() 
              + "&student_progress_id=" + student_progress_id 
              + "&_token={{ csrf_token() }}",
        success: function(data) {
          console.log( data );
          $('#progressSave').attr('disabled',false);
          var result = data.name + ' was updated!';
          toastr.success( result, 'Updated!' );
          
          progress_modal.modal('hide');
          setInterval(function(){ 
            location.reload();
          }, 1000);
        },
        error: function(resp){
          $('#progressSave').attr('disabled',false);
          progress_form.find('.has-error').removeClass('has-error');
          $('#progress_form [id^="error_"] .help-block').addClass('hidden');

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

  /** Get Levels Base on selected School Year **/
  function getLevels(school_year_id) {
    $.ajax({
      type: 'POST',
      url: "{{ route('syLevel.list') }}",
      data: "id=" + school_year_id + "&_token={{ csrf_token() }}",
      success: function(data) {
        var options = '';
        $.each(data, function(i, level) {
          if (i == 0) {
            getLevelSection( level.id );
          }

          options += "<option value='"+level.id+"'>"+
                        level.level +
                     "</option>";
        });
        progress_form.find('select[name=level]')
          .html( options )
          .attr('readonly',false);
      }
    }); // end ajax
  }
  /** End Get Level Base on selected School Year **/

  /** Get Section Base on selected Level **/
  function getLevelSection(school_year_level_id) {
    $.ajax({
      type: 'POST',
      url: "{{ route('section.list') }}",
      data: "id=" + school_year_level_id + "&_token={{ csrf_token() }}",
      success: function(data) {
        var options = '';
        $.each(data, function(i, section) {
          options += "<option value='"+section.id+"'>"+
                        section.section+
                     "</option>";
        });
        progress_form.find('select[name=section]')
          .html( options )
          .attr('readonly',false);
      }
    }); // end ajax
  }
  /** End Get Section Base on selected Level **/

  /** Print Student Registration Form */
  function progressPrint( $details ) {
      let schoolYearLevelSectionID = $details.school_year_level_section_id;
      let studentID = $details.student_id;

      $.ajax({
        type: "POST",
        url: "{{ route('studentProgress.print') }}",
        data: { "student_id":studentID, "schoolYearLevelSectionID":schoolYearLevelSectionID, "_token":"{{ csrf_token() }}" },
        success: function(resp){
            var pwa = window.open("about:blank", "_new");
            pwa.document.open();
            pwa.document.write(resp);
            pwa.document.close();
        },
        error: function(resp) {
          $('body').html( resp.responseText );
          console.log( resp );
        }
      }); // end ajax
    }
  /** End Print Student Registration form **/
</script>

<script type="text/javascript">
  $(document).ready(function() {

    getLevels( progress_form.find('select[name=school_year]').val() );
    progress_form.find('select[name=school_year]').on('change',function () {
      let sy_id = progress_form.find('select[name=school_year]').val();
      getLevels( sy_id );
    });

    progress_form.find('select[name=level]').on('change',function () {
      let level_id = progress_form.find('select[name=level]').val();
      getLevelSection( level_id );
    });
  });
</script>
<!-- End Student Progress -->
