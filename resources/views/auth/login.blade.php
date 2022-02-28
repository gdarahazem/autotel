<x-main-guest-layout :route='isset($url)?($url.".login"):"login"' cardTitle="Connectez-vous"
                     cardDescription="Entrez vos informations">
    <x-slot name="validation">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')"/>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>
    </x-slot>
    <x-slot name="head">
        <div class="text-center">
            <h3 class="">{{ __('messages.Log_in') }}</h3>
            <p>{{ __('messages.dont_have_an_account_yet?') }} <a href="{{ route('admin.register') }}">{{ __('messages.Sign_up_here') }}</a>
            </p>
        </div>
    </x-slot>
    <x-slot name="formContent">

        <div class="col-12">
            <x-label for="email" class="form-label">{{ __('messages.Email_Address') }}</x-label>
            <x-input type="email" class="form-control" id="email" name="email" placeholder="Adresse mail" :value="old('email')" />
        </div>
        <div class="col-12">
            <label for="password" class="form-label">{{ __('messages.Password') }}</label>
            <div class="input-group" id="show_hide_password">
                <input type="password" class="form-control border-end-0" id="password" name="password" placeholder="Mot de passe"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                <label class="form-check-label" for="flexSwitchCheckChecked">{{ __('messages.Remember_me') }}</label>
            </div>
        </div>
        @php
            if(Route::currentRouteName() == 'admin.login')
                {
                  $route = route('admin.password.request');
                }
                else{
                   $route =  route('password.request');
                }
        @endphp

        <div class="col-md-6 text-end">	<a href="{{ $route  }}">{{ __('messages.Forgot_your_password?') }}</a>
        </div>
        <div class="col-12">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>{{ __('messages.Log_in') }}</button>
            </div>
        </div>


    </x-slot>
</x-main-guest-layout>
