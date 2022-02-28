@props(["homeUrl"=>"/","method"=>"POST","route", "validation" => "", "cardTitle" => "", "cardDescription" => "", "head"=>""])

    <!doctype html>
<html lang="en">
<head>
   <x-head title="autoTel">

   </x-head>
</head>

<body>
<!--wrapper-->
<div class="wrapper">
    <div class="authentication-header"></div>
    <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="mb-4 text-center">
                        <img src="{{asset("assets/images/logo-img.png")}}" width="180" alt="" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="p-4 rounded">
                                {{ $validation }}
                                {{ $head }}
                                <div class="form-body">
                                    <form class="row g-3" method="{{$method}}" action="{{ route($route) }}">
                                        @csrf
                                        {{$formContent}}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</div>
<!--end wrapper-->
<!-- Bootstrap JS -->
<x-js></x-js>
</body>
</html>
