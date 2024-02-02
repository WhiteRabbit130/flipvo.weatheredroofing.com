@push('css')
    @vite('resources/css/admin.css')
@endpush

@push('js')
    @vite('resources/js/admin.js')
    <script>

    </script>
@endpush

<x-app-layout>
    <div class="container mt-5">
        <div class="row my-2">
            <div class="col">
                <form
                    id="images-form"
                    action="{{ route('api.images.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf
                    <input type="hidden" name="page" value="gallery">
                    {{--Card--}}
                    <div class="card mb-1">
                        <div class="card-header">
                            <h5>
                                <i class="fas fa-images mr-1"></i>
                                Gallery Images
                            </h5>
                            {{--Errors--}}
                            @if( $errors->any() )
                                @foreach($errors->all() as $error)
                                    <span
                                        class="alert alert-danger text-center py-1 w-100 mb-0 animate__animated animate__zoomIn d-inline-block">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    <strong>Whoops!</strong>
                                    {{ $error }}
                                </span>
                                @endforeach
                            @endif
                            @if($errors->any() || session('badgeMessage'))
                                <div class="row mt-1">
                                    <div class="col-12">
                                        {{--Badge Message--}}
                                        @if( session('badgeMessage') )
                                            <span
                                                class="alert alert-success text-center py-1 w-100 mb-0 animate__animated animate__zoomIn d-inline-block">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    <strong>{{ session('badgeMessage') }}</strong>
                                </span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            {{--Images--}}
                            <div class="row">
                                <div class="col">
                                    <div class="p-3 border">
                                        <div class="text-center">
                                            <label for="images">
                                                <i class="fas fa-upload fa-2x hover:text-blue-600"
                                                   style="cursor: pointer"></i>
                                            </label>
                                            <div>
                                                <small id="images-help" class="text-sm text-gray-500">
                                                    Upload some images...
                                                </small>
                                            </div>
                                        </div>

                                        {{--Images Input--}}
                                        <input id="images" type="file" name="image" class="d-none"
                                               aria-describedby="images-help" accept="image/*"
                                               data-multiple-caption="{count} files selected" multiple>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    {{--Image Container--}}
                                    <div class="border">
{{--                                        <div class="image-container grid grid-cols-2 md:grid-cols-6"></div>--}}
                                        <div class="image-container grid grid-cols-4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit"
                                    class="btn btn-success bg-success btn-sm py-2 px-4 rounded float-right save">
                                <i class="fas fa-save mr-1"></i>
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--Image template - todo -  make a template--}}
    <div id="image-template" class="rounded border cursor-pointer relative d-none">
{{--    <div id="image-template" class="rounded m-1 p-1 border cursor-pointer relative pb-0 mb-0 hidden">--}}
        <button type="button"
                class="delete py-0.5 px-3 absolute -top-1 -left-1 rounded-md border shadow text-sm font-medium text-white sm:text-xs bg-red-600 hover:bg-red-700 focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
            <i class="fas fa-trash-alt"></i>
        </button>
        <img class="" src="" alt="">
        <div class="progress relative -top-1 rounded-t-none">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                 role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                 style="width: 0; background-color: #61D24F !important;">0%
            </div>
        </div>
    </div>

</x-app-layout>
