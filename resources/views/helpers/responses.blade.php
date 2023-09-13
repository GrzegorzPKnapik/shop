<script>
    @if(session('status'))
    $(document).ready(function() {
        Swal.fire({
            position: 'top',
            icon: 'success',
            title: '{{session('status')}}',
            showConfirmButton: false,
            timer: 3500,
        })
    });
    @endif
</script>
