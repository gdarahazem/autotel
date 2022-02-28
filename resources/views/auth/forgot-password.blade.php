<x-main-guest-layout :route='isset($url)?($url.".password.email"):"password.email"' cardTitle="Mot de passe obliée?"

                     cardDescription="Mot de passe oublié? Aucun problème. Communiquez-nous simplement votre adresse e-mail et nous vous enverrons par e-mail un lien de réinitialisation de mot de passe qui vous permettra d'en choisir un niveau.">
    <x-slot name="validation">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')"/>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>
    </x-slot>
    <x-slot name="head">
        <div class="text-center">
            <img src="{{asset("assets/images/icons/lock.png")}}" width="120" alt=""/>
        </div>
        <h4 class="mt-5 font-weight-bold">Forgot Password?</h4>
        <p class="text-muted">Enter your registered email ID to reset the password</p>
    </x-slot>
    <x-slot name="formContent">
        <div class="my-4">
            <x-label for="email" class="form-label" :value="__('messages.Email')"></x-label>
            <x-input type="email" class="form-control form-control-lg" placeholder="example@user.com" name="email" id="email"/>
        </div>
        @php
            if(Route::currentRouteName() == 'admin.password.request')
                {
                  $route = route('admin.login');
                }
            elseif (Route::currentRouteName() == 'provider.password.request')
                {
                  $route = route('provider.login');
                }
                else{
                   $route =  route('login');
                }
        @endphp
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg">{{__('messages.Send')}}</button>
            <a href="{{ $route }}" class="btn btn-white btn-lg"><i class='bx bx-arrow-back me-1'></i>Back to Login</a>
        </div>
    </x-slot>
</x-main-guest-layout>
