<script type="text/javascript" >
    //$('body').addClass('mini-navbar');

    var search_form = $('#search_form');
    var id_modal = $('#id_modal');
    var id_form = $('#id_form');

    /** Call id table view **/
    function idTable (link = '') {
      var url = "{{ route('id.table') }}";
      if (link != '') { url = link; };

      $.ajax({
        type: 'POST',
        url: url,
        data: search_form.serialize() + '&_token={{ csrf_token() }}',
        success: function(res) {
          var table_row = $(res).find('tr').clone();
          var page_link = $(res).find('#pagination_row').clone();
          //console.log(page_link);
          $('#table_body').html(table_row);
          $('#tbl_paginate_row').remove();
          $('#table_pagination').html(page_link);
          $('.pagination').addClass('pagination-sm pull-right no-margin');
        },
        error: function(msg){
          //$('.ibox-content').html(msg.responseText)
          $('#table_body').html('<tr><td colspan="6" class="text-center">Please reload!</td></tr>');
        }
      });
    }

    /** Show create modal **/
    function idCreateModal() {
      $('#idSave').attr({
        "onClick" : "idCreate()",
        "disabled" : false,
      });

      id_form.trigger('reset');
      id_modal.modal('show');

      id_form.find('input[name=year_level]').val( localStorage.getItem('year_level') )
      id_form.find('input[name=section]').val( localStorage.getItem('section') )
      id_form.find('input[name=adviser]').val( localStorage.getItem('adviser') )

      id_form.find('.has-error').removeClass('has-error');
      $('#id_form [id^="error_"] .help-block').addClass('hidden');
    }

    function idCreate(addNew) {
      localStorage.setItem('year_level', id_form.find('input[name=year_level]').val() )
      localStorage.setItem('section', id_form.find('input[name=section]').val() )
      localStorage.setItem('adviser', id_form.find('input[name=adviser]').val() )

      let form_data = id_form.serialize() + "&_token={{ csrf_token() }}"
      $('#idSave').attr('disabled',true);
      $.ajax({
        type: 'POST',
        url: "{{ route('id.create') }}",
        data: form_data,
        success: function(data) {
          $('#idSave').attr('disabled',false);
          var result = data.full_name + ' was added!';
          toastr.success( result, 'Saved!' );

          id_modal.modal('hide');
          idTable();

          idCreateModal();
        },
        error: function(resp){
          //id_modal.html(resp.responseText)

          $('#idSave').attr('disabled',false);
          id_form.find('.has-error').removeClass('has-error');
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
    function idUpdateModal(data) {
      console.log(data)
      $('#idSave').attr({
        "onClick" : "idUpdate()",
        "disabled" : false,
      });

      id_form.find('select[name=type]').val(data.type);
      id_form.find('input[name=student_id_no]').val(data.student_id_no);
      id_form.find('input[name=lrn]').val(data.lrn);

      id_form.find('input[name=first_name]').val(data.first_name);
      id_form.find('input[name=last_name]').val(data.last_name);
      id_form.find('input[name=middle_name]').val(data.middle_name);

      id_form.find('input[name=year_level]').val(data.year_level);
      id_form.find('input[name=section]').val(data.section);
      id_form.find('input[name=phone_number]').val(data.phone_number);

      id_form.find('input[name=address]').val(data.address);
      id_form.find('input[name=address_two]').val(data.address_two);

      id_form.find('input[name=date_of_birth]').val(data.date_of_birth);
      id_form.find('select[name=gender]').val(data.gender);
      id_form.find('input[name=father_name]').val(data.father_name);
      id_form.find('input[name=mother_name]').val(data.mother_name);
      id_form.find('input[name=guardian]').val(data.guardian);

      id_form.find('input[name=card_id_no]').val(data.card_id_no);

      id_modal.find('#idSave')
            .attr('onClick',"idUpdate('"+data.id+"')");
      id_modal.modal('show');

      id_form.find('.has-error').removeClass('has-error');
      $('#id_form [id^="error_"] .help-block').addClass('hidden');
    }

    function idUpdate(id) {
      console.log(id_form.serialize()+ "&id="+ id);
      $('#idSave').attr('disabled',true);
      $.ajax({
        type: 'POST',
        url: "{{ route('id.update') }}",
        data: id_form.serialize() +"&id="+ id + "&_token={{ csrf_token() }}",
        success: function(data) {
          $('#idSave').attr('disabled',false);
          var result = data.full_name + ' was updated!';
          toastr.success( result, 'Saved!' );

          id_modal.modal('hide');
          idTable();
        },
        error: function(resp){
          $('#idSave').attr('disabled',false);
          id_form.find('.has-error').removeClass('has-error');
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
      idTable();

      search_form.on('change keyup', function() {
        idTable();
      });
    });

    /** Pagination link **/
    $(document).on('click','.pagination a',function(e) {
      e.preventDefault();
      var link = $(this).attr('href');
      idTable(link);
    });
</script>

<script type="text/javascript">
  $(document).on('click','.pagination a',function(e) {
    e.preventDefault();
    var link = $(this).attr('href');
    syTable(link);
  });

	var uploadImage_modal = $('#uploadImage_modal');
	var uploadImage_form = $('#uploadImage_form');

	function uploadImageModal($id) {
		uploadImage_form.find( 'input[name=id]' ).val( $id );
		uploadImage_modal.modal( 'show' );
	}

	function uploadImage() {
		$.ajax({
		    url:"{{ route('id.uploadImage') }}",
		    data: new FormData($("#uploadImage_form")[0]),
		    dataType:'json',
		    async:false,
		    type:'post',
		    processData: false,
		    contentType: false,
		    success:function(resp){
		      idTable();
          toastr.success( 'Image Uploaded!', 'Uploaded!' );
          uploadImage_modal.modal('hide');
		      //location.reload(true);
		    },
		    error: function(resp){
            //uploadImage_form.html(resp.responseText)
	          uploadImage_form.find('.has-error').removeClass('has-error');
	          $('#uploadImage_form [id^="error_"] .help-block').addClass('hidden');

	          var error = resp.responseJSON;

	          $.each(error, function(i, v) {
	            var resp = '* ' + v;
	              $('#error_' + i).addClass('has-error');
	              $('#error_'+i+' .help-block').removeClass('hidden').html(resp);
	          });
	        }
	    });
	}
</script>

<script>
/** This remove upon production **/
function clearIDprintQry() {
  studentProgresses = sessionStorage.studentProgresses;

  if (studentProgresses) {
    studentProgresses = studentProgresses.split( ':' );

    $.each( studentProgresses, function(i, v) {
        $('#addIDprintQry_' + v )
            .removeClass("label-info")
            .addClass("label-default")
            .attr("onClick","addIDprintQry( "+v+" )");
    });

    $( '#printID_count' ).html( '0' );

    sessionStorage.removeItem('studentProgresses');
  }
}

function addIDprintQry($studentProgress_id) {
  $('#addIDprintQry_' + $studentProgress_id )
      .removeClass('label-default')
      .addClass('label-info')
      .removeAttr('onClick');
  $( '#printID_count' ).html( parseInt($( '#printID_count' ).html()) + 1 );

  if (sessionStorage.studentProgresses) {
      studentProgresses = sessionStorage.studentProgresses + ':' + $studentProgress_id;
  }else{
      studentProgresses = $studentProgress_id;
  }
  sessionStorage.setItem('studentProgresses', studentProgresses);
}

function printID() {
  var selectedStudent = sessionStorage.studentProgresses;

  if(selectedStudent == undefined) {
    toastr.success( "Pumili ka muna ng ipi-print!", 'Hoy!' );
  }else{
    window.open( " {{ route( 'id.print' ) }}/" + selectedStudent );
  }
}
</script>