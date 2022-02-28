<x-main-guest-layout :route='isset($url)?($url.".password.update"):"password.update"'>
    <x-slot name="validation">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')"/>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>
    </x-slot>
    <x-slot name="head">
        <div class="text-start">
            <img src="{{asset("assets/images/logo-img.png")}}" width="180" alt="">
        </div>
        <h4 class="mt-5 font-weight-bold">Genrate New Password</h4>
        <p class="text-muted">We received your reset password request. Please enter your new password!</p>

    </x-slot>
    <x-slot name="formContent">
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="col-12">
            <x-label for="email" class="form-label">{{ __('messages.Email_Address') }}</x-label>
            <x-input type="email" class="form-control" id="email" name="email" :value="old('email', $request->email)"
                     placeholder="Adresse mail"/>
        </div>

        <div class="col-12">
            <x-label for="password" class="form-label" :value="__('messages.Password')"/>
            <div class="input-group" id="show_hide_password">
                <x-input type="password" class="form-control border-end-0" id="password" name="password"
                         placeholder="Mot de passe" autofocus required
                         autocomplete="new-password"/>
                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
            </div>
        </div>

        <div class="col-12">
            <x-label for="password_confirmation" class="form-label" :value="__('messages.Confirm_Password')"/>
            <div class="input-group" id="show_hide_password">
                <x-input type="password" class="form-control border-end-0" id="password_confirmation"
                         name="password_confirmation" placeholder="Mot de passe" required/>
                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
            </div>
        </div>
        @php
            if(Route::currentRouteName() == 'admin.register')
                {
                  $route = route('admin.login');
                }
                else{
                   $route =  route('login');
                }
        @endphp

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">{{ __('messages.Change_Password') }}</button>
            <a href="{{ $route }}" class="btn btn-light"><i class='bx bx-arrow-back mr-1'></i>Back to Login</a>
        </div>
    </x-slot>
</x-main-guest-layout>
