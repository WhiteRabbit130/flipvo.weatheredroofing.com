@push('css')
    <!-- @vite('resources/css/home.css') -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
@endpush

@push('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

    <script>
        $(document).ready(function(){
            $(".fancybox").fancybox({
                openEffect: "none",
                closeEffect: "none"
            });

            $(".zoom").hover(function(){
                $(this).addClass('transition');
            }, function(){

                $(this).removeClass('transition');
            });
        });
    </script>
@endpush

<x-app-layout>
    <h3>Gallery Page</h3>
    <div class="container page-top">
        <div class="row">
        @foreach ($images as $image)
        <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    <a href="/storage/{{ $image->path }}?auto=compress&cs=tinysrgb&h=650&w=940" class="fancybox" rel="ligthbox">
                        <img  src="/storage/{{ $image->path }}?auto=compress&cs=tinysrgb&h=650&w=940" class="zoom img-fluid "  alt="{{ $image->title }}">
                    </a>
                </div>
        @endforeach
        </div>
    </div>
</x-app-layout>
