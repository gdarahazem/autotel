<x-main>
    <x-slot name="title">
        Dashboard
    </x-slot>
    <x-slot name="cssSlot">
        <link rel="stylesheet" href="{{asset("assets/plugins/datatable/css/dataTables.bootstrap5.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/plugins/select2/css/select2.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/plugins/fancy-file-uploader/fancy_fileupload.css")}}">
        <link rel="stylesheet" href="{{asset("assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css")}}">
    </x-slot>

    <x-slot name="bodyContent">

        <div class="card-header border-bottom-0 bg-transparent">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="font-weight-bold mb-0">Listing des téléphone</h5>
                </div>
                <div class="ms-auto">
                    <button type="button" class="btn btn-primary radius-10" data-bs-toggle="modal"
                            data-bs-target="#addModal"><i class="fas fa-plus"></i> Ajouter
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered " id="kt_datatable" style="width:100%">
                    <thead>
                    <tr>
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Crée Le</th>
                        <th>Modifiée Le</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>N°</th>
                        <th>Nom</th>
                        <th>Crée Le</th>
                        <th>Modifiée Le</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
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
        <x-modal>
            <x-slot name="modalTitle">
                Modifier un téléphone
            </x-slot>
            <x-slot name="buttonlabel">
                Modifier
            </x-slot>
            <x-slot name="method">
                POST
            </x-slot>
            <x-slot name="route">
                posts.update
            </x-slot>
            <x-slot name="formId">
                updateForm
            </x-slot>
            <x-slot name="modalName">
                updateModal
            </x-slot>
            <x-slot name="modalContent">
                @csrf
                @method('put')
                <div class="row mb-3">
                    <div class="form-group col-6">
                        <x-input type="text" id="nameUpdate" name="name" placeholder="Nom"
                                 class="form-control" autofocus="autofocus"/>
                    </div>
                    <div class="form-group col-6">
                        <div class="input-group ">
                            <x-input type="text" id="ramUpdate" name="ram" class="form-control"
                                     placeholder="Mémoire Ram"/>
                            <span
                                class="input-group-text" id="basic-addon2">Go</span>
                        </div>
                    </div>


                </div>

                <div class="row mb-3">
                    <div class="form-group col-6">
                        <x-input type="text" id="priceUpdate" name="price" placeholder="Prix"
                                 class="form-control" autofocus="autofocus"/>
                    </div>

                    <div class="form-group col-6">
                        <div class="input-group">
                            <select class="form-select" id="markUpdate" name="mark">
                                <option selected>Choose...</option>
                                @foreach($marks as $mark)
                                    <option value="{{$mark->name}}">{{ $mark->name }}</option>
                                @endforeach
                            </select>
                            <label class="input-group-text" for="markUpdate">marque</label>
                        </div>
                    </div>

                </div>

                <div class="row mb-3">
                    <div class="input-group"><span class="input-group-text">Description</span>
                        <textarea class="form-control" aria-label="With textarea" id="descriptionUpdate"
                                  name="description"></textarea>
                    </div>
                </div>

                <div class="row mb-3">

                    <div class="form-group col-4">
                        <div class="input-group">
                            <x-input type="text" class="form-control" placeholder="Battrie" id="battryUpdate"
                                     name="battry"/>
                            <span
                                class="input-group-text" id="basic-addon2">mAh</span>
                        </div>
                    </div>

                    <div class="form-group col-4">
                        <div class="input-group">
                            <x-input type="text" class="form-control" placeholder="Stockage" id="storageUpdate"
                                     name="storage"/>
                            <span
                                class="input-group-text" id="basic-addon2">Go</span>
                        </div>
                    </div>

                    <div class="form-group col-4 mt-2">
                        <x-input type="color" id="colorUpdate" name="color" class="form-control"/>
                    </div>


                </div>
                <div class="row mb-3">
                    <div class="form-group col-6">
                        <div class="input-group">
                            <x-input type="text" class="form-control" placeholder="Caméra avant" id="fontCameraUpdate"
                                     name="frontCamera"/>
                            <span class="input-group-text" id="basic-addon2">MégaPixels</span>
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <div class="input-group">
                            <x-input type="text" class="form-control" placeholder="Caméra arrière" id="backCameraUpdate"
                                     name="backCamera"/>
                            <span class="input-group-text" id="basic-addon2">MégaPixels</span>
                        </div>
                    </div>

                </div>

                <div class="row mb-3">
                    <div class="form-group col-6">
                        <div class="input-group">
                            <x-input type="text" class="form-control" placeholder="processeur" id="processorUpdate"
                                     name="processor"/>
                            <span class="input-group-text" id="basic-addon2">Processeur</span>
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <div class="input-group">
                            <x-input type="link" class="form-control" placeholder="review" id="reviewsUpdate"
                                     name="reviews"/>
                            <span class="input-group-text" id="basic-addon2">Link</span>
                        </div>
                    </div>

                </div>


            </x-slot>
        </x-modal>
        <x-modal>
            <x-slot name="modalTitle">
                Modifier Images
            </x-slot>
            <x-slot name="buttonlabel">
                Modifier
            </x-slot>
            <x-slot name="method">
                POST
            </x-slot>
            <x-slot name="route">
                image.update
            </x-slot>
            <x-slot name="formId">
                updateFormImage
            </x-slot>
            <x-slot name="modalName">
                updateModalImage
            </x-slot>
            <x-slot name="modalContent">
                @csrf
                @method('put')
                <div class="row">
                    <div class=" mx-auto">
                        <h6 class="mb-0 text-uppercase">Image Uploadify</h6>
                        <hr/>
                        <div class="card">
                            <div class="card-body">
                                <x-input id="image-upload-update" name="image-uploadify[]" type="file"
                                         accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf"
                                         multiple/>
                            </div>
                        </div>
                    </div>
                </div>
            </x-slot>
        </x-modal>

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
            $.ajaxSetup({
                async: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#kt_datatable').DataTable({
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.22/i18n/French.json"
                },
                processing: true,
                serverSide: true,
                scrollX: true,
                order: [[0, 'desc']],
                ajax: "{{route("myposts.index")}}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'created_at', name: 'created_at', searchable: false},
                    {data: 'updated_at', name: 'updated_at', searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

        </script>
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
                $('#image-upload-update').imageuploadify();
            })
        </script>

        <script>
            var id;
            var nom;
            $('#updateForm').validate({
                rules: {
                    nameUpdate: {
                        required: true,
                        min: 2
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
            $('body').on('click', '.edit', function () {
                id = $(this).data("id");
                console.log(id);
                $("#updateForm").attr("action", "{{route("posts.update",["phone"=>""])}}" + "/" + id);
                nom = $(this).data("name");
                ram = $(this).data("ram");
                price = $(this).data("price");
                mark = $(this).data("mark");
                description = $(this).data("description");
                battery = $(this).data("battery");
                storage = $(this).data("storage");
                color = $(this).data("color");
                front_camera = $(this).data("frontcamera");
                back_camera = $(this).data("backcamera");
                processor = $(this).data("processor");
                reviews = $(this).data("reviews");
                $('#nameUpdate').val(nom);
                $('#ramUpdate').val(ram);
                $('#priceUpdate').val(price);
                $('#markUpdate').val(mark);
                $('#descriptionUpdate').val(description);
                $('#battryUpdate').val(battery);
                $('#colorUpdate').val(color);
                $('#storageUpdate').val(storage);
                $('#fontCameraUpdate').val(front_camera);
                $('#backCameraUpdate').val(back_camera);
                $('#processorUpdate').val(processor);
                $('#reviewsUpdate').val(reviews);
            });
        </script>

        <script>
            var id;
            $('body').on('click', '.editImage', function () {
                id = $(this).data("id");
                console.log(id);
                $("#updateFormImage").attr("action", "{{route("image.update",["phone"=>""])}}" + "/" + id);

            })
        </script>

    </x-slot>
</x-main>
