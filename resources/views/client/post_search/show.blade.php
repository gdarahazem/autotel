<x-main>
    <x-slot name="title">
        show
    </x-slot>
    <x-slot name="cssSlot">
        <link href="{{asset("assets/plugins/datatable/css/dataTables.bootstrap5.min.css")}}" rel="stylesheet"/>
        <link rel="stylesheet" href="{{asset("assets/plugins/select2/css/select2.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">
    </x-slot>

    <x-slot name="bodyContent">
        <div class="card">
            <div class="row g-0">
                <div class="col-md-4 border-end">
                    <img src="{{asset("assets/images/phones/looking.jpg")}}" class="img-fluid" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h4 class="card-title">{{ $phone->name }}</h4>

                        <dl class="row">
                            <dt class="col-sm-3">Model</dt>
                            <dd class="col-sm-9">{{ $phone->mark }}</dd>

                            <dt class="col-sm-3">Ram</dt>
                            <dd class="col-sm-9">{{$phone->ram }} Go</dd>

                            <dt class="col-sm-3">stockage</dt>
                            <dd class="col-sm-9">{{ $phone->storage }} Go</dd>

                            <dt class="col-sm-3">Processeur</dt>
                            <dd class="col-sm-9">{{ $phone->processor }}</dd>


                            <dt class="col-sm-3">Batterie</dt>
                            <dd class="col-sm-9">{{ $phone->battery }} mAh</dd>

                        </dl>
                        <hr>
                        <div class="d-flex gap-3 mt-3">
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sendMailTo">Contacter</a>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showNumber">afficher
                                numéro de téléphone</a>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="card-body">
                <ul class="nav nav-tabs nav-primary mb-0" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab"
                           aria-selected="true">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bx-comment-detail font-18 me-1'></i>
                                </div>
                                <div class="tab-title"> Description</div>
                            </div>
                        </a>
                    </li>

                </ul>
                <div class="tab-content pt-3">
                    <div class="tab-pane fade show active" id="primaryhome" role="tabpanel">
                        <p>{{ $phone->description }}</p>

                    </div>
                    {{--                    <div class="tab-pane fade text-center" id="primarycontact" role="tabpanel">--}}
                    {{--                        <iframe width="560" height="315" src="{{ $phone->reviews }}"--}}
                    {{--                                title="YouTube video player" frameborder="0"--}}
                    {{--                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"--}}
                    {{--                                allowfullscreen></iframe>--}}
                    {{--                    </div>--}}
                </div>
            </div>

        </div>

        <x-modal>
            <x-slot name="modalTitle">
                Contacter
            </x-slot>
            <x-slot name="buttonlabel">
                Envoyer
            </x-slot>
            <x-slot name="method">
                POST
            </x-slot>
            <x-slot name="route">
                sendMail
            </x-slot>
            <x-slot name="routeParam">
                {{ $phone->id }}
            </x-slot>
            <x-slot name="formId">
                sendMailTo
            </x-slot>
            <x-slot name="modalName">
                sendMailTo
            </x-slot>
            <x-slot name="modalContent">
                @csrf

                <div class="row mb-3">
                    <div class="input-group"><span class="input-group-text">To</span>
                        <x-input class="form-control" id="destination"
                                 name="destination" value="{{ $phone->user->email }}"/>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="input-group"><span class="input-group-text">Object</span>
                        <x-input class="form-control" id="object"
                                 name="object"/>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="input-group"><span class="input-group-text">Description</span>
                        <textarea class="form-control" aria-label="With textarea" id="description"
                                  name="description"></textarea>
                    </div>
                </div>
            </x-slot>
        </x-modal>

        <div class="modal fade" id="showNumber" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Numéro de téléphone</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h1>{{ $phone->user->phone }}</h1>
                    </div>
                </div>
            </div>
        </div>

    </x-slot>

    <x-slot name="jsSlot">
        <script src="{{asset("assets/plugins/datatable/js/jquery.dataTables.min.js")}}"></script>
        <script src="{{asset("assets/plugins/datatable/js/dataTables.bootstrap5.min.js")}}"></script>
        <script src="{{asset("assets/plugins/jquery-validation/jquery.validate.min.js")}}"></script>
        <script src="{{asset("assets/plugins/jquery-validation/additional-methods.min.js")}}"></script>
        <script src="{{asset("assets/plugins/jquery-validation/localization/messages_fr.min.js")}}"></script>
    </x-slot>
</x-main>
