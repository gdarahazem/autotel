<x-main>
    <x-slot name="title">
        Estimation de prix
    </x-slot>
    <x-slot name="cssSlot">
        <link href="{{asset("plugins/custom/datatables/datatables.bundle.css")}}" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{asset("assets/plugins/select2/css/select2.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/plugins/fancy-file-uploader/fancy_fileupload.css")}}">
        <link rel="stylesheet" href="{{asset("assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css")}}">
    </x-slot>

    <x-slot name="bodyContent">
        <div class="card-header">
            <h3>Entrez le buget que vous souhaitez pour voir des propositions</h3>
        </div>
        <div class="card-body">

            <form action="{{ route('budget.price') }}" method="get">
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Budget</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <input type="text" class="form-control" id="budget" name="budget"
                               value="{{$budget != ""? $budget: ''}}" placeholder="budget"/>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9 text-secondary">
                        <input type="submit" class="btn btn-primary px-4" value="Chercher"/>
                    </div>
                </div>
            </form>

            @if(count($phones)> 0)
                <div class="text-center">
                    <h4>Proposition</h4>
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xxl-5 product-grid">
                    @foreach($phones as $phone)
                        <div class="col">
                            <div class="card">
                                <img src="{{asset("assets/images/phones/" . $phone->photos[0]->src)}}"
                                     class="card-img-top"
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
                                    <div class="d-flex align-items-center mt-3 fs-6">

                                        <a href="{{ route('posts.show', $phone->id) }}"
                                           class="btn btn-sm btn-outline-dark">
                                            Détail </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>

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
    </x-slot>
</x-main>
