<x-main-guest-layout :route='isset($url)?($url.".register"):"register"' cardTitle="Connectez-vous"
                     cardDescription="Entrez vos informations">
    <x-slot name="validation">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')"/>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>
    </x-slot>
    @php
        if(Route::currentRouteName() == 'admin.register')
            {
              $route = route('admin.login');
            }
            else{
               $route =  route('login');
            }
    @endphp
    <x-slot name="head">
        <div class="text-center">
            <h3 class="">Sign Up</h3>
            <p>Already have an account? <a href="{{ $route }}">Sign in here</a>
            </p>
        </div>
    </x-slot>
    <x-slot name="formContent">
        @if(!isset($url))
            <div class="col-12">
                <x-label for="first_name" class="form-label">{{ __('messages.first_name') }}</x-label>
                <x-input type="text" class="form-control" id="first_name" name="first_name" placeholder="Nom"/>
            </div>

            <div class="col-12">
                <x-label for="last_name" class="form-label">{{ __('messages.last_name') }}</x-label>
                <x-input type="text" class="form-control" id="last_name" name="last_name" placeholder="Prénom"/>
            </div>

            <div class="col-12">
                <x-label for="phone" class="form-label" :value="__('messages.phone')"/>
                <x-input type="text" class="form-control border-end-0" id="phone" name="phone"
                         placeholder="Téléphone" required/>
            </div>
        @else
            <div class="col-12">
                <x-label for="name" class="form-label">{{ __('messages.name') }}</x-label>
                <x-input type="text" class="form-control" id="name" name="name" placeholder="Nom"/>
            </div>
        @endif


        <div class="col-12">
            <x-label for="email" class="form-label">{{ __('messages.Email_Address') }}</x-label>
            <x-input type="email" class="form-control" id="email" name="email" placeholder="Adresse mail"/>
        </div>

        <div class="col-12">
            <x-label for="password" class="form-label" :value="__('messages.Password')"/>
            <div class="input-group" id="show_hide_password">
                <x-input type="password" class="form-control border-end-0" id="password" name="password"
                         placeholder="Mot de passe" required autocomplete="new-password"/>
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



        <div class="col-12">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                <label class="form-check-label" for="flexSwitchCheckChecked">I read and agree to Terms &
                    Conditions</label>
            </div>
        </div>
        <div class="col-12">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary"><i class='bx bx-user'></i>{{ __('messages.Sign_up') }}
                </button>
            </div>
        </div>

    </x-slot>
</x-main-guest-layout>
