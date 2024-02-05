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
        @endforeach
        </div>
    </div>
</x-app-layout>
