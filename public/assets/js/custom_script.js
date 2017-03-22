
/** Toast **/
toastr.options = {
    closeButton: true,
    progressBar: true,
    showMethod: 'slideDown',
    timeOut: 4000
};

$('input').on('keyup change',function() {
    let $this = $(this);
    let $thisVal = $this.val();
    $this.val($thisVal.toUpperCase());
});