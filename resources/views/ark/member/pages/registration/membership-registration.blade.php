@extends('layouts.membership')

@section('content')
    <style>
        .disable-nav .nav-link {
            pointer-events: none;
            opacity: 1;
            cursor: default;
        }
    </style>
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card form-card mb-4">
                <div class="card-header form-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-person-plus"></i> UAP Membership Registration</h4>
                </div>

                <div class="card-body">
                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <ul class="nav nav-pills nav-fill disable-nav">
                            <li class="nav-item">
                                <a class="nav-link {{ $currentStep == 1 ? 'active' : '' }}"
                                   href="{{ route('membership.form', ['step' => 1]) }}">
                                    Personal Info
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $currentStep == 2 ? 'active' : '' }}"
                                   href="{{ route('membership.form', ['step' => 2]) }}">
                                    Professional Info
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $currentStep == 3 ? 'active' : '' }}"
                                   href="{{ route('membership.form', ['step' => 3]) }}">
                                    PRC Details
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $currentStep == 4 ? 'active' : '' }}"
                                   href="{{ route('membership.form', ['step' => 4]) }}">
                                    Membership
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Step 1: Personal Information -->
                    @if($currentStep == 1)
                        <form method="POST" action="{{ route('membership.save-step', ['step' => 1]) }}">
                            @csrf
                            <h5 class="mb-4 text-primary"><i class="bi bi-person"></i> Personal Information</h5>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="family_name" class="form-label required-field">Family Name</label>
                                    <input type="text" class="form-control @error('family_name') is-invalid @enderror" id="family_name" name="family_name"
                                           value="{{ old('family_name', $memberData['family_name'] ?? '') }}">
                                    @error('family_name')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="first_name" class="form-label required-field">First Name</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name"
                                           value="{{ old('first_name', $memberData['first_name'] ?? '') }}">
                                    @error('first_name')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="middle_name" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control @error('middle_name') is-invalid @enderror" id="middle_name" name="middle_name"
                                           value="{{ old('middle_name', $memberData['middle_name'] ?? '') }}">
                                    @error('middle_name')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="birthdate" class="form-label required-field">Birthdate</label>
                                    <input type="date" class="form-control @error('birthdate') is-invalid @enderror" id="birthdate" name="birthdate"
                                           value="{{ old('birthdate', $memberData['birthdate'] ?? '') }}">
                                    @error('birthdate')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="birthplace" class="form-label required-field">Birthplace</label>
                                    <input type="text" class="form-control @error('birthplace') is-invalid @enderror" id="birthplace" name="birthplace"
                                           value="{{ old('birthplace', $memberData['birthplace'] ?? '') }}">
                                    @error('birthplace')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="sex" class="form-label required-field">Sex</label>
                                    <select class="form-select @error('sex') is-invalid @enderror" id="sex" name="sex">
                                        <option value="">Select...</option>
                                        <option value="Male" {{ (old('sex', $memberData['sex'] ?? '') == 'Male' ? 'selected' : '') }}>Male</option>
                                        <option value="Female" {{ (old('sex', $memberData['sex'] ?? '') == 'Female' ? 'selected' : '') }}>Female</option>
                                        <option value="Other" {{ (old('sex', $memberData['sex'] ?? '') == 'Other' ? 'selected' : '') }}>Other</option>
                                    </select>
                                    @error('sex')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="civil_status" class="form-label required-field">Civil Status</label>
                                    <select class="form-select @error('civil_status') is-invalid @enderror" id="civil_status" name="civil_status">
                                        <option value="">Select...</option>
                                        <option value="Single" {{ (old('civil_status', $memberData['civil_status'] ?? '') == 'Single' ? 'selected' : '') }}>Single</option>
                                        <option value="Married" {{ (old('civil_status', $memberData['civil_status'] ?? '') == 'Married' ? 'selected' : '') }}>Married</option>
                                        <option value="Divorced" {{ (old('civil_status', $memberData['civil_status'] ?? '') == 'Divorced' ? 'selected' : '') }}>Divorced</option>
                                        <option value="Widowed" {{ (old('civil_status', $memberData['civil_status'] ?? '') == 'Widowed' ? 'selected' : '') }}>Widowed</option>
                                    </select>
                                    @error('civil_status')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-8">
                                    <label for="permanent_address" class="form-label required-field">Permanent Address</label>
                                    <textarea class="form-control @error('permanent_address') is-invalid @enderror" id="permanent_address" name="permanent_address" rows="2">{{ old('permanent_address', $memberData['permanent_address'] ?? '') }}</textarea>
                                    @error('permanent_address')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="telephone" class="form-label">Telephone</label>
                                    <input type="text" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone"
                                           value="{{ old('telephone', $memberData['telephone'] ?? '') }}">
                                    @error('telephone')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="fax" class="form-label">Fax</label>
                                    <input type="text" class="form-control @error('fax') is-invalid @enderror" id="fax" name="fax"
                                           value="{{ old('fax', $memberData['fax'] ?? '') }}">
                                    @error('fax')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="mobile" class="form-label required-field">Mobile Number</label>
                                    <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="mobile" name="mobile"
                                           value="{{ old('mobile', $memberData['mobile'] ?? '') }}">
                                    @error('mobile')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label required-field">Email Address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                           value="{{ old('email', $memberData['email'] ?? '') }}">
                                    @error('email')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="facebook_id" class="form-label">Facebook ID</label>
                                    <input type="text" class="form-control @error('facebook_id') is-invalid @enderror" id="facebook_id" name="facebook_id"
                                           value="{{ old('facebook_id', $memberData['facebook_id'] ?? '') }}">
                                    @error('facebook_id')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="twitter_id" class="form-label">Twitter ID</label>
                                    <input type="text" class="form-control @error('twitter_id') is-invalid @enderror" id="twitter_id" name="twitter_id"
                                           value="{{ old('twitter_id', $memberData['twitter_id'] ?? '') }}">
                                    @error('twitter_id')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="skype_id" class="form-label">Skype ID</label>
                                    <input type="text" class="form-control @error('skype_id') is-invalid @enderror" id="skype_id" name="skype_id"
                                           value="{{ old('skype_id', $memberData['skype_id'] ?? '') }}">
                                    @error('skype_id')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="website" class="form-label">Website</label>
                                    <input type="url" class="form-control @error('website') is-invalid @enderror" id="website" name="website"
                                           value="{{ old('website', $memberData['website'] ?? '') }}">
                                    @error('website')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <div></div>
                                <button type="submit" class="btn btn-primary">
                                    Next: Professional Information <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </form>
                    @endif

                    <!-- Step 2: Professional Information -->
                    @if($currentStep == 2)
                        <form method="POST" action="{{ route('membership.save-step', ['step' => 2]) }}">
                            @csrf
                            <h5 class="mb-4 text-primary"><i class="bi bi-briefcase"></i> Professional Information</h5>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="company_name" class="form-label @error('company_name') is-invalid @enderror">Company Name</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name"
                                           value="{{ old('company_name', $memberData['company_name'] ?? '') }}">
                                    @error('company_name')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="designation" class="form-label @error('designation') is-invalid @enderror">Designation</label>
                                    <input type="text" class="form-control" id="designation" name="designation"
                                           value="{{ old('designation', $memberData['designation'] ?? '') }}">
                                    @error('designation')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="company_address" class="form-label">Company Address</label>
                                    <textarea class="form-control" id="company_address" name="company_address" rows="2">{{ old('company_address', $memberData['company_address'] ?? '') }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="company_telephone" class="form-label">Company Telephone</label>
                                    <input type="text" class="form-control @error('company_telephone') is-invalid @enderror" id="company_telephone" name="company_telephone"
                                           value="{{ old('company_telephone', $memberData['company_telephone'] ?? '') }}">
                                    @error('company_telephone')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="col-md-6">
                                    <label for="company_fax" class="form-label">Company Fax</label>
                                    <input type="text" class="form-control @error('company_fax') is-invalid @enderror" id="company_fax" name="company_fax"
                                           value="{{ old('company_fax', $memberData['company_fax'] ?? '') }}">
                                    @error('company_fax')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <h6 class="mt-4 mb-3 text-primary">Education Background</h6>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="school_graduated" class="form-label required-field">School Graduated</label>
                                    <input type="text" class="form-control @error('school_graduated') is-invalid @enderror" id="school_graduated" name="school_graduated"
                                           value="{{ old('school_graduated', $memberData['school_graduated'] ?? '') }}" >
                                    @error('school_graduated')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="year_graduated" class="form-label required-field">Year Graduated</label>
                                    <input type="number" class="form-control @error('year_graduated') is-invalid @enderror" id="year_graduated" name="year_graduated"
                                           value="{{ old('year_graduated', $memberData['year_graduated'] ?? '') }}" >
                                    @error('year_graduated')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="honors" class="form-label">Honors Received</label>
                                    <input type="text" class="form-control" id="honors" name="honors"
                                           value="{{ old('honors', $memberData['honors'] ?? '') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="post_graduate_school" class="form-label">Post Graduate School</label>
                                    <input type="text" class="form-control" id="post_graduate_school" name="post_graduate_school"
                                           value="{{ old('post_graduate_school', $memberData['post_graduate_school'] ?? '') }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="post_graduate_year" class="form-label">Year Graduated</label>
                                    <input type="number" class="form-control" id="post_graduate_year" name="post_graduate_year"
                                           value="{{ old('post_graduate_year', $memberData['post_graduate_year'] ?? '') }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="post_graduate_honors" class="form-label">Honors Received</label>
                                    <input type="text" class="form-control" id="post_graduate_honors" name="post_graduate_honors"
                                           value="{{ old('post_graduate_honors', $memberData['post_graduate_honors'] ?? '') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="special_courses" class="form-label">Special Courses Taken</label>
                                    <textarea class="form-control" id="special_courses" name="special_courses" rows="2">{{ old('special_courses', $memberData['special_courses'] ?? '') }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="awards" class="form-label">Awards Received</label>
                                    <textarea class="form-control" id="awards" name="awards" rows="2">{{ old('awards', $memberData['awards'] ?? '') }}</textarea>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('membership.form', ['step' => 1]) }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Next: PRC Details <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </form>
                    @endif

                    <!-- Step 3: PRC Information -->
                    @if($currentStep == 3)
                        <form method="POST" action="{{ route('membership.save-step', ['step' => 3]) }}">
                            @csrf
                            <h5 class="mb-4 text-primary"><i class="bi bi-file-earmark-medical"></i> PRC Details</h5>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="prc_registration_number" class="form-label required-field">PRC Registration Number</label>
                                    <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="prc_registration_number" name="prc_registration_number"
                                           value="{{ old('prc_registration_number', $memberData['prc_registration_number'] ?? '') }}" >
                                    @error('prc_registration_number')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="prc_date_issued" class="form-label required-field">Date Issued</label>
                                    <input type="date" class="form-control @error('prc_date_issued') is-invalid @enderror" id="prc_date_issued" name="prc_date_issued"
                                           value="{{ old('prc_date_issued', $memberData['prc_date_issued'] ?? '') }}" >
                                    @error('prc_date_issued')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="prc_valid_until" class="form-label required-field">Valid Until</label>
                                    <input type="date" class="form-control @error('prc_valid_until') is-invalid @enderror" id="prc_valid_until" name="prc_valid_until"
                                           value="{{ old('prc_valid_until', $memberData['prc_valid_until'] ?? '') }}" >
                                    @error('prc_valid_until')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <h6 class="mt-4 mb-3 text-primary">Professional Expertise</h6>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="expertise" class="form-label required-field">Expertise/Specialization</label>
                                    <textarea class="form-control @error('expertise') is-invalid @enderror" id="expertise" name="expertise" rows="2" >{{ old('expertise', $memberData['expertise'] ?? '') }}</textarea>
                                    @error('expertise')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="years_of_practice" class="form-label required-field">Years of Practice</label>
                                    <input type="number" class="form-control @error('years_of_practice') is-invalid @enderror" id="years_of_practice" name="years_of_practice"
                                           value="{{ old('years_of_practice', $memberData['years_of_practice'] ?? '') }}" >
                                    @error('years_of_practice')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="practice_type" class="form-label required-field">Type of Practice</label>
                                    <select class="form-select @error('practice_type') is-invalid @enderror" id="practice_type" name="practice_type" >
                                        <option value="">Select...</option>
                                        <option value="Private" {{ (old('practice_type', $memberData['practice_type'] ?? '') == 'Private') ? 'selected' : '' }}>Private</option>
                                        <option value="Government" {{ (old('practice_type', $memberData['practice_type'] ?? '') == 'Government') ? 'selected' : '' }}>Government</option>
                                        <option value="Academe" {{ (old('practice_type', $memberData['practice_type'] ?? '') == 'Academe') ? 'selected' : '' }}>Academe</option>
                                        <option value="Mixed" {{ (old('practice_type', $memberData['practice_type'] ?? '') == 'Mixed') ? 'selected' : '' }}>Mixed</option>
                                    </select>
                                    @error('practice_type')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="services_rendered" class="form-label required-field">Services Rendered</label>
                                    <textarea class="form-control  @error('services_rendered') is-invalid @enderror" id="services_rendered" name="services_rendered" rows="1" >{{ old('services_rendered', $memberData['services_rendered'] ?? '') }}</textarea>
                                    @error('services_rendered')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <h6 class="mt-4 mb-3 text-primary">CPE/CPD Information</h6>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="cpe_seminars_attended" class="form-label">Seminars/Conferences Attended (Last 3 Years)</label>
                                    <textarea class="form-control" id="cpe_seminars_attended" name="cpe_seminars_attended" rows="3">{{ old('cpe_seminars_attended', $memberData['cpe_seminars_attended'] ?? '') }}</textarea>
                                    <small class="text-muted">Please list the title, date, and venue for each seminar</small>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('membership.form', ['step' => 2]) }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Next: Membership Details <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </form>
                    @endif

                    <!-- Step 4: Membership Information -->
                    @if($currentStep == 4)
                        <form method="POST" action="{{ route('membership.save-step', ['step' => 4]) }}">
                            @csrf
                            <h5 class="mb-4 text-primary"><i class="bi bi-people"></i> Membership Details</h5>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="current_chapter" class="form-label required-field">Current Chapter</label>
                                    <input type="text" class="form-control  @error('current_chapter') is-invalid @enderror" id="current_chapter" name="current_chapter"
                                           value="{{ old('current_chapter', $memberData['current_chapter'] ?? '') }}" >
                                    @error('current_chapter')
                                    <div class="invalid-feedback d-flex align-items-center">
                                        <svg class="bi flex-shrink-0 me-2" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="previous_chapter" class="form-label">Previous Chapter (if any)</label>
                                    <input type="text" class="form-control" id="previous_chapter" name="previous_chapter"
                                           value="{{ old('previous_chapter', $memberData['previous_chapter'] ?? '') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="positions_held" class="form-label">Positions Held in UAP</label>
                                    <textarea class="form-control" id="positions_held" name="positions_held" rows="3">{{ old('positions_held', $memberData['positions_held'] ?? '') }}</textarea>
                                    <small class="text-muted">Please include the year and chapter for each position</small>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('membership.form', ['step' => 3]) }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle"></i> Submit Application
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
