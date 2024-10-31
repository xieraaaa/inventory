<section>
    <div class="container my-5">
        <header class="mb-4">
            <h2 class="h4 text-dark">
                {{ __('Profile Information') }}
            </h2>
            <p class="text-muted">
                {{ __("Update your account's profile information and email address.") }}
            </p>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-4 needs-validation" novalidate>
            @csrf
            @method('patch')

            <div class="mb-3">
                <x-input-label for="name" :value="__('Name')" class="form-label" />
                <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="invalid-feedback" :messages="$errors->get('name')" />
            </div>

            <div class="mb-3">
                <x-input-label for="email" :value="__('Email')" class="form-label" />
                <x-text-input id="email" name="email" type="email" class="form-control" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="invalid-feedback" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="text-muted">
                            {{ __('Your email address is unverified.') }}
                            <button form="send-verification" class="btn btn-link p-0 text-decoration-none">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-success">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label for="profile_photo" class="form-label">Foto Profil</label>
                <input type="file" class="form-control" id="profile_photo" name="profile_photo">
            </div>

            <div class="d-flex align-items-center gap-3">
                <x-primary-button class="btn btn-primary">{{ __('Save') }}</x-primary-button>

                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-muted"
                    >{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>
</section>
