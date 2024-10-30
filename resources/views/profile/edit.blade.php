@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Profile</h4>
            </div>
            <div class="col-md-7 align-self-center text-end">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb justify-content-end">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Profile and Tabs -->
        <div class="row py-12">
            <!-- Profile Information Column -->
            <div class="col-md-4">
                <div class="p-4 bg-white shadow sm:rounded-lg">
                    <h5>Profile Information</h5>
                    <!-- Include profile information content here -->
                    @include('profile.partials.profile-summary')
                </div>
            </div>

            <!-- Tabs Column -->
            <div class="col-md-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-12">
                    <ul class="nav nav-tabs" id="profileTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profile-info-tab" data-bs-toggle="tab" data-bs-target="#profile-info" type="button" role="tab" aria-controls="profile-info" aria-selected="true">Update Profile Information</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab" aria-controls="password" aria-selected="false">Update Password</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="delete-account-tab" data-bs-toggle="tab" data-bs-target="#delete-account" type="button" role="tab" aria-controls="delete-account" aria-selected="false">Delete Account</button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content p-4 bg-white shadow sm:rounded-lg" id="profileTabContent">
                        <div class="tab-pane fade show active" id="profile-info" role="tabpanel" aria-labelledby="profile-info-tab">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                        <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                            @include('profile.partials.update-password-form')
                        </div>
                        <div class="tab-pane fade" id="delete-account" role="tabpanel" aria-labelledby="delete-account-tab">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
