@push('js')
<script src="{{asset('js/webcam.min.js')}}"></script>
<script language="JavaScript">
    function take_snapshot() {
        Webcam.snap(function(data_uri) {
            $(".image-tag").val(data_uri);
            $("#image-webcam").attr('src', data_uri);
        });
        $('#modal-webcam').modal('hide')
    }
</script>
<script>
    $('form').submit(function() {
        @this.set('state.foto', $('.image-tag').val());
    })
</script>
@endpush