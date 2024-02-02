@push('js')
    <script>
        // Document ready
        $(document).ready(function() {
            // close alert
            // $('.alert').alert();

            // close alert after 5 seconds
            setTimeout(function() {
                $('.alert').alert('close');
            }, 3000);
        });
    </script>
@endpush

{{--Alerts--}}
<div class="">
    {{--errors--}}
    @if( $errors->any() )
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible mb-1 fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <i class="fas fa-times-circle"></i>
                </button>
                <i class="fa-solid fa-triangle-exclamation mr-1"></i>
                <strong>{{ $error }}</strong>
            </div>
        @endforeach
    @endif

    {{--success--}}
    @if( session('success') )
        <div class="alert alert-success alert-dismissible mb-1 fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <i class="fas fa-times-circle"></i>
            </button>
            <i class="fa-solid fa-check-circle mr-1"></i>
            {{ session('success') }}
        </div>
    @endif
</div>
