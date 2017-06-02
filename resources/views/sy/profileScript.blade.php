<script type="text/javascript">
	var sy_modal = $('#sy_modal');
  var sy_form = $('#sy_form');

	/** Show update modal **/
    function syUpdateModal(data) {
      sy_modal.find('#year').html(data.year);
      sy_modal.find('#code').html(data.code);
      sy_form.find('input[name=start]').val(data.start);
      sy_form.find('input[name=end]').val(data.end);
      sy_form.find('input[name=firstGrading]').val(data.firstGrading);
      sy_form.find('input[name=secondGrading]').val(data.secondGrading);
      sy_form.find('input[name=thirdGrading]').val(data.thirdGrading);
      sy_form.find('input[name=fourthGrading]').val(data.fourthGrading);
      sy_form.find('input[name=monthlyDue]').val(data.monthlyDue);
      sy_form.find('input[name=monthlyExam]').val(data.monthlyExam);
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
          setInterval(function(){ 
            location.reload();
          }, 1000);
        },
        error: function(resp){
	        $('#sySave').attr('disabled',false);
	        sy_form.find('.has-error').removeClass('has-error');
	        $('#sy_form [id^="error_"] .help-block').addClass('hidden');

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

<script type="text/javascript">
$(document).ready(function() {    
        
    $('#tabs a').click(function(){
        var t = $(this).attr('id');

        if(!$(this).hasClass('active')){
          $('#tabs span a').removeClass('active');           
          $(this).addClass('active');

          $('.tab-pane').hide();
          $('#content-'+ t).fadeIn('slow'); 
        }
    });

});

</script>

<script type="text/javascript">
  /** Call student table view **/
var search_form = $('#search_form');

function studentTable (link = '') {
    var url = "{{ route('sy.studentTable', [ 'year' => $sy->year]) }}";
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
            $('#table_body').html('<tr><td colspan="6">'+msg.responseText+'</td></tr>');
        }
    });
}

$(document).ready(function() {
    studentTable();

    search_form.find('select[name=level]').on('change', function () {
        let sectionOptions = '<option value="">All sections!</option>';

        if ( $(this).val() ) {
            let lvlSections = $.parseJSON( $(this).val() );
            let sections = lvlSections.sections
            $.each(sections, function(i, section) {
              sectionOptions += "<option value='" +section.id+ "'>"+
                                    section.section+
                                 "</option>";
            });

            search_form.find( 'input[name=level_id]' ).val( lvlSections.level_id );
        }else{
            search_form.find( 'input[name=level_id]' ).val('');
        }

        
        search_form.find( 'select[name=section_id]' ).html( sectionOptions );
        studentTable();
    });

    search_form.on('change keyup', function() {
        studentTable();
    });
});

/** Pagination link **/
$(document).on('click','.pagination a',function(e) {
    e.preventDefault();
    var link = $(this).attr('href');
    studentTable(link);
});
</script>

<!-- Print -->
<script type="text/javascript">
 // Print Master List
 function printMaterListModal( $year ) {
  let masterListModal = $('#printMaterList_modal');

  masterListModal.modal( 'show' );
  masterListModal.find( '#year' ).html( $year );

  let printType = masterListModal.find( 'select[name=printType]' );

  printType.on('click change', function() {
    console.log( printType.val() );
  } );
 }
 // End Print Master List  
</script>
<!-- End Print -->