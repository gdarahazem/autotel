<!doctype html>
<html lang="en" class="light-theme">
<x-head :title="$title" :css-slot="$cssSlot"></x-head>
<body>
<!--wrapper-->
<div class="wrapper">
    <!--sidebar wrapper -->
    <x-aside></x-aside>
    <!--end sidebar wrapper -->
    <!--start header -->
    <x-header></x-header>
    <!--end header -->
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">

            <div class="card radius-10">
                {{ $bodyContent }}
            </div>
        </div>
    </div>
    <!--end page wrapper -->
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
    @php
        use Carbon\Carbon;
      $now = Carbon::now()->year;
    @endphp
    <footer class="page-footer">
        <p class="mb-0">Copyright © {{$now}}. All right reserved.</p>
    </footer>
</div>
<!--end wrapper-->
<!--start switcher-->


<x-js>
    <x-slot name="jsSlot">

        {{$jsSlot}}
    </x-slot>
</x-js>

</body>


<!-- Mirrored from codervent.com/synadmin/demo/vertical/index3.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 25 Feb 2022 20:15:31 GMT -->
</html>
