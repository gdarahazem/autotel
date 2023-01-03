<x-main>
    <x-slot name="title">
        Dashboard
    </x-slot>
    <x-slot name="cssSlot">
        <link href="{{asset("assets/plugins/datatable/css/dataTables.bootstrap5.min.css")}}" rel="stylesheet"/>
        <link rel="stylesheet" href="{{asset("assets/plugins/select2/css/select2.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">
    </x-slot>

    <x-slot name="bodyContent">
        <div class="card-header border-bottom-0 bg-transparent">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="font-weight-bold mb-0">Listing des Utilisateurs</h5>
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
                        <th>Email</th>
                        <th>email_verified_at</th>
                        <th>Status</th>
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
                        <th>Email</th>
                        <th>email_verified_at</th>
                        <th>Status</th>
                        <th>Crée Le</th>
                        <th>Modifiée Le</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        {{--        Begin::add user modam--}}
        <x-modal>
            <x-slot name="modalTitle">
                Ajouter un utilisateur
            </x-slot>
            <x-slot name="buttonlabel">
                Ajouter
            </x-slot>
            <x-slot name="method">
                POST
            </x-slot>
            <x-slot name="route">
                admin.register
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
                    <x-label for="name">Nom</x-label>
                    <x-input type="text" id="name" name="name" placeholder="Entrer un Nom"
                             class="form-control" required autofocus="autofocus"/>
                </div>
                <div class="form-group">
                    <x-label for="email">Email</x-label>
                    <x-input type="email" id="email" name="email" placeholder="Entrer un Email"
                             class="form-control" required/>
                </div>
                <div class="form-group">
                    <x-label for="password">Mot de passe</x-label>
                    <x-input type="password" id="password" name="password"
                             placeholder="Entrer un mot de passe"
                             class="form-control" required/>

                </div>
                <div class="form-group">
                    <x-label for="password_confirmation">Mot de passe</x-label>
                    <x-input type="password" id="password_confirmation" name="password_confirmation"
                             placeholder="Confirmer le mot de passe"
                             class="form-control" required/>

                </div>
            </x-slot>
        </x-modal>
        {{--        End::add user modam--}}

        {{--        Begin:: update user modal--}}
        <x-modal>
            <x-slot name="modalTitle">
                Modifier un utilisateur
            </x-slot>
            <x-slot name="buttonlabel">
                Modifier
            </x-slot>
            <x-slot name="method">
                post
            </x-slot>
            <x-slot name="route">
                users.update
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
                <x-input type="hidden" id="idUpdate" name="idUpdate" class="form-control" required/>


                <div class="form-group">
                    <x-label for="name">Nom</x-label>
                    <x-input type="text" id="nameUpdate" name="name" class="form-control" placeholder="Entrer votre nom"
                             class="form-control" required/>
                </div>
                <div class="form-group">
                    <x-label for="email">Email</x-label>
                    <x-input type="email" id="emailUpdate" name="email" class="form-control"
                             placeholder="Entrer un Email"
                             class="form-control" required/>
                </div>
            </x-slot>
        </x-modal>

        {{--        End:: update user modal--}}

        {{--        End:: update password modal--}}
        <x-modal>
            <x-slot name="modalTitle">
                Modifier le mot de passe
            </x-slot>
            <x-slot name="buttonlabel">
                Modifier
            </x-slot>
            <x-slot name="method">
                POST
            </x-slot>
            <x-slot name="route">
                users.changePassword
            </x-slot>
            <x-slot name="formId">
                updatePasswordForm
            </x-slot>
            <x-slot name="modalName">
                updatePassword
            </x-slot>
            <x-slot name="modalContent">
                @csrf
                <x-input type="hidden" id="idUpdatePassword" name="idUpdatePassword" class="form-control" required/>

                <div class="form-group">
                    <x-label for="password">Nouveau mot de passe</x-label>
                    <x-input type="password" id="new_password" name="new_password"
                             class="form-control" placeholder="Entrez nouveau mot de passe" required autofocus/>
                </div>
                <div class="form-group">
                    <x-label for="password">Confirmer le nouveau mot de passe</x-label>
                    <x-input type="password" id="new_password_confirmation" name="new_password_confirmation"
                             class="form-control" placeholder="confirmer votre mot de passe" required/>
                </div>
            </x-slot>
        </x-modal>
        {{--        End:: update password modal--}}


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
                ajax: "{{route("users.index")}}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'email_verified_at', name: 'email_verified_at'},
                    {
                        data: 'status', name: 'status', render: function (data, type, full, meta) {
                            if (full.status == 0) {
                                return '<span class="badge bg-danger" >Désactivé</span>';
                            } else if (full.status == 1) {
                                return ' <span class="badge bg-success" >Actif</span>';
                            }
                        }
                    },
                    {data: 'created_at', name: 'created_at', searchable: false},
                    {data: 'updated_at', name: 'updated_at', searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

        </script>

        <script>
            var id;
            var name;
            var email;
            $('#updateForm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    },
                    email: {
                        required: true,
                        email: true
                    },

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
                $("#updateForm").attr("action", "{{route("users.update",["admin"=>""])}}" + "/" + id);
                name = $(this).data("name");
                email = $(this).data("email");
                $('#idUpdate').val(id);
                $('#nameUpdate').val(name);
                $('#emailUpdate').val(email);
            });
        </script>

        <script>
            var id;
            $('body').on('click', '.reset', function () {
                $(function () {
                    $('#updatePasswordForm').validate({
                        rules: {
                            new_password: {
                                required: true,
                                minlength: 8
                            },
                            new_password_confirmation: {
                                required: true,
                                minlength: 8
                            },
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
                });
                id = $(this).data("id");
                $("#updatePasswordForm").attr("action", "{{route("users.changePassword",["admin"=>""])}}" + "/" + id);
                $('#idUpdatePassword').val(id);
            });
        </script>
        <script>
            $('body').on('click', '.desactiver', function () {
                console.log('status');
                var id = $(this).data("id");
                var message = $(this).data("name");
                swal.fire({
                    title: "Êtes-vous sûr ?",
                    text: message + id,
                    icon: 'warning',
                    buttons: {
                        cancel: true,
                        delete: 'Oui !'
                    }
                }).then(function (willDelete) {
                    if (willDelete) {
                        $.ajax({
                            method: 'get',
                            dataType: 'json',
                            data: {"_method": 'delete', "_token": "{{csrf_token()}}"},
                            url: "{{route('users.desactivateAccount',["admin" => ''])}}" + "/" + id,
                            success: function (data) {
                                if (!data.error) {
                                    swal.fire({
                                        title: 'Succès',
                                        text: "Opération effectuée avec succès",
                                        icon: 'success'
                                    });
                                    location.reload();
                                }
                            },
                            error: function (data) {
                                console.log(data.responseText);
                                console.log("error");
                                location.reload();
                            }
                        });
                    }
                });
            })
        </script>
    </x-slot>
</x-main>
