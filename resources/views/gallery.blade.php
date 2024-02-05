@push('css')
    <!-- @vite('resources/css/home.css') -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <style>
         body {
            /* background-color:#1d1d1d !important; */
            font-family: "Asap", sans-serif;
            color:#989898;
            /* margin:10px; */
            font-size:16px;
        }

        #demo {
            height:100%;
            position:relative;
            overflow:hidden;
        }

        .green{
            background-color:#6fb936;
        }

        .thumb{
            margin-bottom: 30px;
        }

        .page-top{
            margin-top:85px;
        }

        img.zoom {
            width: 100%;
            height: 200px;
            border-radius:5px;
            object-fit:cover;
            -webkit-transition: all .3s ease-in-out;
            -moz-transition: all .3s ease-in-out;
            -o-transition: all .3s ease-in-out;
            -ms-transition: all .3s ease-in-out;
        }

        .transition {
            -webkit-transform: scale(1.2);
            -moz-transform: scale(1.2);
            -o-transform: scale(1.2);
            transform: scale(1.2);
        }

        .modal-header {
            border-bottom: none;
        }

        .modal-title {
            color:#000;
        }

        .modal-footer{
            display:none;
        }
    </style>
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
