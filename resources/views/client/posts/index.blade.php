<x-main>
    <x-slot name="title">
        Dashboard
    </x-slot>
    <x-slot name="cssSlot">
        <link href="{{asset("plugins/custom/datatables/datatables.bundle.css")}}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{asset("assets/plugins/select2/css/select2.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/plugins/fancy-file-uploader/fancy_fileupload.css")}}">
        <link rel="stylesheet" href="{{asset("assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css")}}">
    </x-slot>

    <x-slot name="bodyContent">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-lg-4 col-xl-3">
                                @if($guard_web)
                                    <button type="button" class="btn btn-primary mb-3 mb-lg-0" data-bs-toggle="modal"
                                            data-bs-target="#addModal">
                                        <i class='bx bxs-plus-square'></i>Publier votre annonce
                                    </button>
                                @endif
                            </div>
                            <div class="col-lg-9 col-xl-9">
                                <form class="float-lg-end">
                                    <div class="row row-cols-lg-2 row-cols-xl-auto g-2">
                                        <div class="col">
                                            <div class="position-relative">
                                                <input type="text" class="form-control ps-5"
                                                       placeholder="nom, marque" id="searchPhones"> <span
                                                    class="position-absolute top-50 product-show translate-middle-y"><i
                                                        class="bx bx-search"></i></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="btn-group" role="group"
                                                 aria-label="Button group with nested dropdown">
                                                <button type="button" class="btn btn-white">Trier par</button>
                                                <div class="btn-group" role="group">
                                                    <button id="btnGroupDrop1" type="button"
                                                            class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class='bx bx-chevron-down'></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                        @if($guard_admin)
                                                            <li><a class="dropdown-item"
                                                                   href="{{route("admin.index.home","croissant")}}">Prix
                                                                    croissant</a></li>
                                                            <li><a class="dropdown-item"
                                                                   href="{{route("admin.index.home","decroissant")}}">Prix
                                                                    décroissant</a></li>
                                                        @else
                                                            <li><a class="dropdown-item"
                                                                   href="{{route("search.home.index","croissant")}}">Prix
                                                                    croissant</a></li>
                                                            <li><a class="dropdown-item"
                                                                   href="{{route("search.home.index","decroissant")}}">Prix
                                                                    décroissant</a></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

{{--                                        <div class="col">--}}
{{--                                            <div class="btn-group" role="group">--}}
{{--                                                <button type="button" class="btn btn-white">Price Range</button>--}}
{{--                                                <div class="btn-group" role="group">--}}
{{--                                                    <button id="btnGroupDrop1" type="button"--}}
{{--                                                            class="btn btn-white dropdown-toggle dropdown-toggle-nocaret px-1"--}}
{{--                                                            data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                                        <i class='bx bx-slider'></i>--}}
{{--                                                    </button>--}}
{{--                                                    <ul class="dropdown-menu dropdown-menu-start"--}}
{{--                                                        aria-labelledby="btnGroupDrop1">--}}
{{--                                                        <li><a class="dropdown-item" href="#">Dropdown link</a></li>--}}
{{--                                                        <li><a class="dropdown-item" href="#">Dropdown link</a></li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 product-grid">

            @foreach($phones as $phone)
                <div class="col">
                    <div class="card">
                        <img src="{{asset("assets/images/phones/" . $phone->photos[0]->src)}}" class="card-img-top"
                             alt="phone image" width="400px" height="200px">
                        <p class="m-2" style="font-size: 10px;">
                            <span> Publier par: <strong>{{ $phone->user->first_name}} {{$phone->user->last_name}}</strong></span>

                        <div class="card-body">
                            <h6 class="card-title cursor-pointer">{{ $phone->name }}</h6>
                            <div class="clearfix">
                                <p class="mb-0 float-start"><strong>{{ $phone->mark }}</strong></p>
                                <p class="mb-0 float-end fw-bold"><span
                                        style="color: #8833ff">{{ $phone->price }} dt</span>
                                </p>
                            </div>
                            <div class="d-flex align-items-center mt-3 fs-6 ">

                                <div class="d-inline" style="margin-right: 5px;">
                                    <a href="{{ route('posts.show', $phone->id) }}" class="btn btn-sm btn-outline-dark">
                                        Détail </a>
                                </div>
                                @if($guard_admin)
                                    <div class="d-inline mr-2">
                                        <a href="{{ route('posts.delete', $phone->id) }}"
                                           onclick="return confirm('vous etes sur');"
                                           class="btn btn-sm btn-outline-danger">
                                            Supprimer </a>
                                    </div>

                                @endif


                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <x-modal>
            <x-slot name="modalTitle">
                Ajouter un téléphone
            </x-slot>
            <x-slot name="buttonlabel">
                Ajouter
            </x-slot>
            <x-slot name="method">
                POST
            </x-slot>
            <x-slot name="route">
                posts.store
            </x-slot>
            <x-slot name="formId">
                addForm
            </x-slot>
            <x-slot name="modalName">
                addModal
            </x-slot>
            <x-slot name="modalContent">
                @csrf
                <div class="row mb-3">
                    <div class="form-group col-6">
                        <x-input type="text" id="nameAdd" name="name" placeholder="Nom"
                                 class="form-control" autofocus="autofocus"/>
                    </div>
                    <div class="form-group col-6">
                        <div class="input-group ">
                            <x-input type="text" id="ramAdd" name="ram" class="form-control" placeholder="Mémoire Ram"/>
                            <span
                                class="input-group-text" id="basic-addon2">Go</span>
                        </div>
                    </div>


                </div>

                <div class="row mb-3">
                    <div class="form-group col-6">
                        <x-input type="text" id="priceAdd" name="price" placeholder="Prix"
                                 class="form-control" autofocus="autofocus"/>
                    </div>

                    <div class="form-group col-6">
                        <select class="form-control select2" id="markAdd" name="mark" required>
                            <option></option>
                            @foreach($marks as $mark)
                                <option value="{{$mark->name}}">{{ $mark->name }}</option>
                            @endforeach
                        </select>

                    </div>

                </div>

                <div class="row mb-3">
                    <div class="input-group"><span class="input-group-text">Description</span>
                        <textarea class="form-control" aria-label="With textarea" id="descriptionAdd"
                                  name="description"></textarea>
                    </div>
                </div>

                <div class="row mb-3">

                    <div class="form-group col-4">
                        <div class="input-group">
                            <x-input type="text" class="form-control" placeholder="Battrie" id="battryAdd"
                                     name="battry"/>
                            <span
                                class="input-group-text" id="basic-addon2">mAh</span>
                        </div>
                    </div>

                    <div class="form-group col-4">
                        <div class="input-group">
                            <x-input type="text" class="form-control" placeholder="Stockage" id="storagrAdd"
                                     name="storage"/>
                            <span
                                class="input-group-text" id="basic-addon2">Go</span>
                        </div>
                    </div>

                    <div class="form-group col-4 mt-2">
                        <x-input type="color" id="colorAdd" name="color" class="form-control"/>
                    </div>


                </div>
                <div class="row mb-3">
                    <div class="form-group col-6">
                        <div class="input-group">
                            <x-input type="text" class="form-control" placeholder="Caméra avant" id="fontCameraAdd"
                                     name="frontCamera"/>
                            <span class="input-group-text" id="basic-addon2">MégaPixels</span>
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <div class="input-group">
                            <x-input type="text" class="form-control" placeholder="Caméra arrière" id="backCameraAdd"
                                     name="backCamera"/>
                            <span class="input-group-text" id="basic-addon2">MégaPixels</span>
                        </div>
                    </div>

                </div>

                <div class="row mb-3">
                    <div class="form-group col-6">
                        <div class="input-group">
                            <x-input type="text" class="form-control" placeholder="processeur" id="processorAdd"
                                     name="processor"/>
                            <span class="input-group-text" id="basic-addon2">Processeur</span>
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <div class="input-group">
                            <x-input type="link" class="form-control" placeholder="review" id="reviewsAdd"
                                     name="reviews"/>
                            <span class="input-group-text" id="basic-addon2">Link</span>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class=" mx-auto">
                        <h6 class="mb-0 text-uppercase">Image Uploadify</h6>
                        <hr/>
                        <div class="card">
                            <div class="card-body">
                                <x-input id="image-uploadify" name="image-uploadify[]" type="file"
                                         accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf"
                                         multiple value="hazem.png"/>
                            </div>
                        </div>
                    </div>
                </div>

            </x-slot>
        </x-modal>
        <form id="searchForm" method="GET" class="d-none">@</form>
    </x-slot>

    <x-slot name="jsSlot">
        <script src="{{asset("assets/plugins/datatable/js/jquery.dataTables.min.js")}}"></script>
        <script src="{{asset("assets/plugins/datatable/js/dataTables.bootstrap5.min.js")}}"></script>
        <script src="{{asset("assets/plugins/jquery-validation/jquery.validate.min.js")}}"></script>
        <script src="{{asset("assets/plugins/jquery-validation/additional-methods.min.js")}}"></script>
        <script src="{{asset("assets/plugins/jquery-validation/localization/messages_fr.min.js")}}"></script>
        <script src="{{asset("assets/plugins/fancy-file-uploader/jquery.ui.widget.js")}}"></script>
        <script src="{{asset("assets/plugins/fancy-file-uploader/jquery.fileupload.js")}}"></script>
        <script src="{{asset("assets/plugins/fancy-file-uploader/jquery.iframe-transport.js")}}"></script>
        <script src="{{asset("assets/plugins/fancy-file-uploader/jquery.fancy-fileupload.js")}}"></script>
        <script src="{{asset("assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js")}}"></script>
        <script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
        <script>
            $('#fancy-file-upload').FancyFileUpload({
                params: {
                    action: 'fileuploader'
                },
                maxfilesize: 1000000
            });
        </script>
        <script>
            $(document).ready(function () {
                $('#image-uploadify').imageuploadify();
            })
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#markAdd').select2({
                    theme: 'bootstrap4',
                    placeholder: 'Selectionner un marque',
                    allowClear: true,
                    dropdownParent: $("#addModal")
                });

            });
        </script>
        <script>
            var input = document.getElementById("searchPhones");
            input.addEventListener("keyup", function (event) {
                if (event.keyCode === 13) {
                    event.preventDefault();
                    @if($guard_web)
                    $("#searchForm").attr("action", "{{route("search.phone.name",["search"=>""])}}" + "/" + input.value)
                    @else
                    $("#searchForm").attr("action", "{{route("admin.search.phone.name",["search"=>""])}}" + "/" + input.value)
                    @endif
                    $("#searchForm").submit();
                }
            });
        </script>
    </x-slot>
</x-main>
