<x-main>
    <x-slot name="title">
        update profile
    </x-slot>
    <x-slot name="cssSlot">
        <link href="{{asset("assets/plugins/datatable/css/dataTables.bootstrap5.min.css")}}" rel="stylesheet"/>
        <link rel="stylesheet" href="{{asset("assets/plugins/select2/css/select2.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">
    </x-slot>

    <x-slot name="bodyContent">
        <div class="card border-top border-0 border-4 border-danger">
            <div class="card-body p-5">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bxs-user me-1 font-22 text-danger"></i>
                    </div>
                    <h5 class="mb-0 text-danger">Modifier photo de profile</h5>
                </div>
                <hr>
                @php
                    $route = "client.pictures.edit";
                    if (Auth::guard('admin')->check()) {
                        $route = "admin.pictures.edit";
                    }
                @endphp
                <form class="row g-3" id="updateProfilePicture" method="POST" action="{{ route($route) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="picture-update">image de profile</label>
                        <input type="file" class="form-control-file" id="picture-update" name="picture-update" required>
                    </div>


                    <div class="col-12">
                        <button type="submit" class="btn btn-danger px-5">Modifier</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-top border-0 border-4 border-danger">
            <div class="card-body p-5">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bxs-user me-1 font-22 text-danger"></i>
                    </div>
                    <h5 class="mb-0 text-danger">Mes informations</h5>
                </div>
                <hr>
                @php
                    $route = "user.store.update.profile";
                    if (Auth::guard('admin')->check()) {
                        $route = "admin.store.update.profile";
                    }
                @endphp
                <form class="row g-3" id="updateProfile" method="POST" action="{{ route($route, $user->id) }}">
                    @csrf

                    @if(Auth::guard('admin')->check())
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nom</label>
                            <div class="input-group"><span class="input-group-text bg-transparent"><i
                                        class='bx bxs-user'></i></span>
                                <input type="text" class="form-control border-start-0" name="name" id="name"
                                       placeholder="Nom" value="{{ $user->name }}"/>
                            </div>
                        </div>
                    @else
                        <div class="col-md-6">
                            <label for="firstName" class="form-label">Nom</label>
                            <div class="input-group"><span class="input-group-text bg-transparent"><i
                                        class='bx bxs-user'></i></span>
                                <input type="text" class="form-control border-start-0" name="firstName" id="firstName"
                                       placeholder="Nom" value="{{ $user->first_name }}"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">Prenom</label>
                            <div class="input-group"><span class="input-group-text bg-transparent"><i
                                        class='bx bxs-user'></i></span>
                                <input type="text" class="form-control border-start-0" id="lastName" name="lastName"
                                       placeholder="Prenom" value="{{ $user->last_name }}"/>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="phone" class="form-label">Téléphone</label>
                            <div class="input-group"><span class="input-group-text bg-transparent"><i
                                        class='bx bxs-microphone'></i></span>
                                <input type="text" class="form-control border-start-0" name="phone" id="phone"
                                       placeholder="Téléphone" value="{{ $user->phone }}"/>
                            </div>
                        </div>
                    @endif


                    <div class="col-12">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-group"><span class="input-group-text bg-transparent"><i
                                    class='bx bxs-message'></i></span>
                            <input type="text" class="form-control border-start-0" id="email" name="email"
                                   placeholder="Email Address" value="{{ $user->email }}"/>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="new_password" class="form-label">Mot de passe</label>
                        <div class="input-group"><span class="input-group-text bg-transparent"><i
                                    class='bx bxs-lock-open'></i></span>
                            <input type="password" class="form-control border-start-0" id="new_password"
                                   name="new_password"
                                   placeholder="Mot de passe" value=""/>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="new_password_confirmation" class="form-label">Confirmer mot de passe</label>
                        <div class="input-group"><span class="input-group-text bg-transparent"><i
                                    class='bx bxs-lock'></i></span>
                            <input type="password" class="form-control border-start-0" name="new_password_confirmation"
                                   id="new_password_confirmation"
                                   placeholder="Confirmer mot de passe"/>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-danger px-5">Modifier</button>
                    </div>
                </form>
            </div>
        </div>

    </x-slot>

    <x-slot name="jsSlot">
        <script src="{{asset("assets/plugins/datatable/js/jquery.dataTables.min.js")}}"></script>
        <script src="{{asset("assets/plugins/datatable/js/dataTables.bootstrap5.min.js")}}"></script>
        <script src="{{asset("assets/plugins/jquery-validation/jquery.validate.min.js")}}"></script>
        <script src="{{asset("assets/plugins/jquery-validation/additional-methods.min.js")}}"></script>
        <script src="{{asset("assets/plugins/jquery-validation/localization/messages_fr.min.js")}}"></script>

        <script>
            var id;

            $(function () {
                $('#updateProfile').validate({
                    rules: {
                        firstName: {
                            required: true,
                            minlength: 2
                        },
                        lastName: {
                            required: true,
                            minlength: 2
                        },
                        phone: {
                            required: true,
                            minlength: 8,
                            maxlength: 8,
                        },
                        // new_password: {
                        //     required: false,
                        //     minlength: 8
                        // },
                        // new_password_confirmation: {
                        //     required: false,
                        //     minlength: 8
                        // },
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


        </script>
    </x-slot>
</x-main>
