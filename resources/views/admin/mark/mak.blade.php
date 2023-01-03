<x-main>
    <x-slot name="title">
        Marques
    </x-slot>
    <x-slot name="cssSlot">
        <link href="{{asset("assets/plugins/datatable/css/dataTables.bootstrap5.min.css")}}" rel="stylesheet"/>
    </x-slot>

    <x-slot name="bodyContent">
        <div class="card-header border-bottom-0 bg-transparent">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="font-weight-bold mb-0">Listes des marque</h5>
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


        <x-modal modal-title=" Ajouter un marque" method="POST">

            <x-slot name="buttonlabel">
                Ajouter
            </x-slot>
            <x-slot name="route">
                mark.store
            </x-slot>
            <x-slot name="formId">
                addForm
            </x-slot>
            <x-slot name="modalName">
                addModal
            </x-slot>
            <x-slot name="modalContent">
                @csrf
                <div class="form-group">
                    <x-label for="nom">Marque : </x-label>
                    <x-input type="text" id="nom" name="nom" placeholder="Entrer le nom du marque"
                             class="form-control" required autofocus/>
                </div>
            </x-slot>
        </x-modal>

        <x-modal>
            <x-slot name="modalTitle">
                Modifier un marque
            </x-slot>
            <x-slot name="method">
                post
            </x-slot>
            <x-slot name="buttonlabel">
                Update
            </x-slot>
            <x-slot name="route">
                mark.update
            </x-slot>
            <x-slot name="modalName">
                updateModal
            </x-slot>
            <x-slot name="formId">
                updateForm
            </x-slot>
            <x-slot name="modalContent">
                @csrf
                @method('put')
                <div class="form-group">
                    <x-label for="name">Nom</x-label>
                    <x-input type="text" id="nomUpdate" name="nom" class="form-control" required/>
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
                ajax: "{{route("mark.index")}}",
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
            var id;
            var nom;
            $('#updateForm').validate({
                rules: {
                    nomUpdate: {
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
                $("#updateForm").attr("action", "{{route("mark.update",["mark"=>""])}}" + "/" + id);
                nom = $(this).data("name");
                $('#nomUpdate').val(nom);
            });
        </script>

        <script>
            $('body').on('click', '.delete', function () {
                var id = $(this).data("id");
                var nom = $(this).data("name");

                Swal.fire({
                    title: 'Êtes-vous sûr de supprimer ' + nom + ' !',
                    showCancelButton: true,
                    confirmButtonText: 'Delete'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'POST',
                            dataType: 'json',
                            data: {"_method": 'delete', "_token": "{{csrf_token()}}"},
                            url: "{{route('mark.destroy',["mark" => ''])}}" + "/" + id
                        })
                        Swal.fire('success', 'Opération effectuée avec succès!', 'success')
                        table.ajax.reload();
                    } else if (result.isDenied) {
                        Swal.fire('error', 'Votre demande a été rejeter !', 'error')
                    }
                });

            })
        </script>
    </x-slot>
</x-main>
