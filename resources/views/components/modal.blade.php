@props(['routeParam' => '', 'buttonlabel' => ''])
<div class="modal fade" id="{{ $modalName }}" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ $modalTitle }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="cmxform" id="{{ $formId }}" method="{{ $method }}" action="{{route("$route", $routeParam)}}" enctype="multipart/form-data">
                <div class="modal-body">
                   {{ $modalContent }}
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">{{ $buttonlabel }}</button>
                    </div>
                </div>

            </form>
        </div>

        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



