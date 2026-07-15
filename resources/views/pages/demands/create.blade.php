@extends('layouts.master')

@section('styles')
	<link href="/assets/css/wizard/wizard.css?v={{ time() }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="card">
    <div class="card-body py-4">
        <!--begin::Wizard-->
        <div class="wizard wizard-1" id="kt_contact_add" data-wizard-state="step-first" data-wizard-clickable="true" data-kt-stepper="false">
            <div class="kt-grid__item">
                <!--begin::Wizard Nav-->
                <div class="wizard-nav border-bottom">
                    <div class="wizard-steps p-8">
                        <div class="wizard-step header-step1" data-wizard-type="step" data-kt-stepper-element="nav" data-wizard-state="current">
                            <div class="wizard-label">
                                <span class="svg-icon svg-icon-4x wizard-icon">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Chat-check.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            <path d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z" fill="#000000" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <h3 class="wizard-title">1. Recherche</h3>
                            </div>
                            <span class="svg-icon svg-icon-xl wizard-arrow">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                                        <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <div class="wizard-step header-step2" data-wizard-type="step" data-kt-stepper-element="nav">
                            <div class="wizard-label">
                                <span class="svg-icon svg-icon-4x wizard-icon">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Devices/Display1.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M11,20 L11,17 C11,16.4477153 11.4477153,16 12,16 C12.5522847,16 13,16.4477153 13,17 L13,20 L15.5,20 C15.7761424,20 16,20.2238576 16,20.5 C16,20.7761424 15.7761424,21 15.5,21 L8.5,21 C8.22385763,21 8,20.7761424 8,20.5 C8,20.2238576 8.22385763,20 8.5,20 L11,20 Z" fill="#000000" opacity="0.3" />
                                            <path d="M3,5 L21,5 C21.5522847,5 22,5.44771525 22,6 L22,16 C22,16.5522847 21.5522847,17 21,17 L3,17 C2.44771525,17 2,16.5522847 2,16 L2,6 C2,5.44771525 2.44771525,5 3,5 Z M4.5,8 C4.22385763,8 4,8.22385763 4,8.5 C4,8.77614237 4.22385763,9 4.5,9 L13.5,9 C13.7761424,9 14,8.77614237 14,8.5 C14,8.22385763 13.7761424,8 13.5,8 L4.5,8 Z M4.5,10 C4.22385763,10 4,10.2238576 4,10.5 C4,10.7761424 4.22385763,11 4.5,11 L7.5,11 C7.77614237,11 8,10.7761424 8,10.5 C8,10.2238576 7.77614237,10 7.5,10 L4.5,10 Z" fill="#000000" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <h3 class="wizard-title">2. Utilisateurs</h3>
                            </div>
                            <span class="svg-icon svg-icon-xl wizard-arrow">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                                        <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <div class="wizard-step header-step3" data-wizard-type="step" data-kt-stepper-element="nav">
                            <div class="wizard-label">
                                <span class="svg-icon svg-icon-4x wizard-icon">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Globe.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z" fill="#000000" fill-rule="nonzero" />
                                            <circle fill="#000000" opacity="0.3" cx="12" cy="10" r="6" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <h3 class="wizard-title">3. Demandes</h3>
                            </div>
                            <span class="svg-icon svg-icon-xl wizard-arrow">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                                        <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                        <div class="wizard-step header-step4" data-wizard-type="step" data-kt-stepper-element="nav">
                            <div class="wizard-label">
                                <span class="svg-icon svg-icon-4x wizard-icon">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000" />
                                            <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                                <h3 class="wizard-title">4. Résumé</h3>
                            </div>
                            <span class="svg-icon svg-icon-xl wizard-arrow last">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1" />
                                        <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)" />
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                        </div>
                    </div>
                </div>
                <!--end::Wizard Nav-->
            </div>
            <div class="row justify-content-center my-10 px-8 px-lg-10">
                <div class="col-xl-12 col-xxl-7">
                    <!--begin::Form Wizard Form-->
                    <form class="formField" id="kt_contact_add_form" data-wizard-validation="false">
                        <input type="hidden" id="rootForm" value="demands">
                        <input type="hidden" id="user_id" name="user_id" value="0">
                        <input type="hidden" id="codeDoc" name="codeDoc" value="{{ old('code', $firstDoc->code) }}">
                        <input type="hidden" id="step2" value="0">
                        <input type="hidden" id="step3" value="0">
                        <!--begin::Form Wizard Step 1-->
                        <div class="body-step1 pb-5 m-auto w-75 current" data-wizard-type="step-content" data-kt-stepper-element="content">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div id="kt_modal_users_search_handler" data-kt-search-keypress="true" data-kt-search-min-length="2" data-kt-search-enter="enter" data-kt-search-layout="inline" data-kt-search="true">
                                        <!--begin::Form-->
                                        <div data-kt-search-element="form" class="w-100 position-relative mb-5" autocomplete="off">
                                            <!--begin::Icon-->
                                            <i class="ki-duotone ki-magnifier fs-2 fs-lg-1 text-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <!--end::Icon-->
                                            <!--begin::Input-->
                                            <input type="text" id="search" placeholder="Rechercher par nom ou prénoms" class="form-control form-control-lg form-control-solid px-15" data-kt-search-element="input">
                                            <!--end::Input-->
                                            <!--begin::Spinner-->
                                            <span class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5" data-kt-search-element="spinner">
                                                <span class="spinner-border h-15px w-15px align-middle text-muted"></span>
                                            </span>
                                            <!--end::Spinner-->
                                            <!--begin::Reset-->
                                            <span class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 me-5 d-none" data-kt-search-element="clear">
                                                <i class="ki-duotone ki-cross fs-2 fs-lg-1 me-0">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <!--end::Reset-->
                                        </div>
                                        <!--end::Form-->
                                        <!--begin::Wrapper-->
                                        <div class="py-5">
                                            <!--begin::Suggestions-->
                                            <div id="users-list" data-kt-search-element="suggestions"></div>
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Form Wizard Step 1-->
                        <!--begin::Form Wizard Step 2-->
                        <div class="body-step2 pb-5" data-wizard-type="step-content" data-kt-stepper-element="content">
                            <div class="row mb-5">
                                <div class="col-md-12 userError text-danger fw-bold fs-5 text-center"></div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-12">
                                    <label class="fw-bolder text-dark fs-5">Civilité : <span class="text-danger">*</span></label>
                                    <select id="civility" name="civility" class="form-control requiredUser" data-valid="1">
                                        <option value="" selected>Sélectionner</option>
                                        @foreach($civility as $civil)
                                            <option value="{{ $civil }}">{{ $civil }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label class="fw-bolder text-dark fs-5">Nom : <span class="text-danger">*</span></label>
                                    <input type="text" name="lastname" class="form-control requiredUser" placeholder="Saisir nom" data-valid="1" />
                                </div>
                                <div class="col-md-4 col-12">
                                    <label class="fw-bolder text-dark fs-5">Prénoms : <span class="text-danger">*</span></label>
                                    <input type="text" name="firstname" class="form-control requiredUser" placeholder="Saisir prénoms" data-valid="1" />
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-12">
                                    <label class="fw-bolder text-dark fs-5">Numéro de téléphone : <span class="text-danger">*</span></label>
                                    <input type="text" id="phone_number" name="phone_number" class="form-control requiredUser" onKeyUp="verif_int(this)" data-valid="1">
                                </div>
                                <div class="col-md-4 col-12">
                                    <label class="fw-bolder text-dark fs-5">Email :</label>
                                    <input type="text" name="email" class="form-control email" placeholder="Saisir email" />
                                </div>
                                <div class="col-md-4 col-12">
                                    <label class="fw-bolder text-dark fs-5">Profession : <span class="text-danger">*</span></label>
                                    <input type="text" name="profession" class="form-control requiredUser" placeholder="Saisir profession" data-valid="1" />
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-3" col-12">
                                    <label class="fw-bolder text-dark fs-5">Date de naissance : <span class="text-danger">*</span></label>
                                    <input type="text" name="birthday_at" class="form-control date_at" readonly>
                                </div>
                                <div class="col-md-3" col-12">
                                    <label class="fw-bolder text-dark fs-5">Lieu de naissance : <span class="text-danger">*</span></label>
                                    <input type="text" name="birthplace" class="form-control requiredUser" placeholder="Saisir lieu de naissance" data-valid="1" />
                                </div>
                                <div class="col-md-3" col-12">
                                    <label class="fw-bolder text-dark fs-5">Pays de naissance : <span class="text-danger">*</span></label>
                                    <select id="country_id" name="country_id" class="form-control">
                                        <option value="" selected>Sélectionner</option>
                                        @foreach($country as $data)
                                            <option value="{{ $data->id }}" data-alpha="{{ $data->alpha }}" data-code="+{{ $data->code }}" @php echo $data->id == 61 ? 'selected':'' @endphp>{{ $data->country }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3" col-12">
                                    <label class="fw-bolder text-dark fs-5">Préfecture de naissance : <span class="text-danger">*</span></label>
                                    <select id="town_id" name="town_id" class="form-control requiredUser" data-valid="1">
                                        <option value="" selected>Sélectionner</option>
                                        @foreach($town as $data)
                                            <option value="{{ $data->id }}">{{ $data->label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-12">
                                    <label class="fw-bolder text-dark fs-5">Nationalité : <span class="text-danger">*</span></label>
                                    <select id="nationality_id" name="nationality_id" class="form-control">
                                        <option value="" selected>Sélectionner</option>
                                        @foreach($nationality as $data)
                                            <option value="{{ $data->id }}" data-alpha="{{ $data->alpha }}" data-code="+{{ $data->code }}" @php echo $data->id == 61 ? 'selected':'' @endphp>{{ $data->nationality }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label class="fw-bolder text-dark fs-5">Nom et prénoms du père : <span class="text-danger">*</span></label>
                                    <input type="text" name="father_fullname" class="form-control requiredUser" placeholder="Saisir nom et prénoms du père" data-valid="1" />
                                </div>
                                <div class="col-md-4 col-12">
                                    <label class="fw-bolder text-dark fs-5">Nom et prénoms de la mère : <span class="text-danger">*</span></label>
                                    <input type="text" name="mother_fullname" class="form-control requiredUser" placeholder="Saisir nom et prénoms de la mère" data-valid="1" />
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-12">
                                    <label class="fw-bolder text-dark fs-5">Taille : <span class="text-danger">*</span></label>
                                    <input type="text" name="size" class="form-control requiredUser" placeholder="Saisir taille" data-valid="1" />
                                </div>
                                <div class="col-md-4 col-12">
                                    <label class="fw-bolder text-dark fs-5">Teint : <span class="text-danger">*</span></label>
                                    <input type="text" name="complexion" class="form-control requiredUser" placeholder="Saisir teint" data-valid="1" />
                                </div>
                                <div class="col-md-4 col-12">
                                    <label class="fw-bolder text-dark fs-5">Cheveux : <span class="text-danger">*</span></label>
                                    <input type="text" name="hairs" class="form-control requiredUser" placeholder="Saisir cheveux" data-valid="1" />
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-12">
                                    <label class="fw-bolder text-dark fs-5">Signes particuliers : <span class="text-danger">*</span></label>
                                    <input type="text" name="particular_sign" class="form-control requiredUser" placeholder="Saisir signes particuliers" data-valid="1" />
                                </div>
                                <div class="col-md-4 col-12">
                                    <label class="fw-bolder text-dark fs-5">Domicile : <span class="text-danger">*</span></label>
                                    <input type="text" name="home_address" class="form-control requiredUser" placeholder="Saisir domicile" data-valid="1" />
                                </div>
                                <div class="col-md-4 col-12">
                                    <label class="fw-bolder text-dark fs-5">Date d'arrivée : <span class="text-danger">*</span></label>
                                    <input type="text" name="arrival_at" class="form-control date_at" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 col-12">
                                    <label class="fw-bolder text-dark fs-4">Personne à prévenir :</label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-12">
                                    <label class="fw-bolder text-dark fs-5">Nom et prénoms : <span class="text-danger">*</span></label>
                                    <input type="text" name="person_fullname" class="form-control requiredUser" placeholder="Saisir nom complet" data-valid="1" />
                                </div>
                                <div class="col-md-4 col-12">
                                    <label class="fw-bolder text-dark fs-5">Numéro de téléphone : <span class="text-danger">*</span></label>
                                    <input type="text" id="person_number" name="person_number" class="form-control requiredUser" placeholder="Saisir numéro" data-valid="1" />
                                </div>
                                <div class="col-md-4 col-12">
                                    <label class="fw-bolder text-dark fs-5">Adresse : <span class="text-danger">*</span></label>
                                    <input type="text" name="person_address" class="form-control requiredUser" placeholder="Saisir adresse" data-valid="1" />
                                </div>
                            </div>
                        </div>
                        <!--end::Form Wizard Step 2-->
                        <!--begin::Form Wizard Step 3-->
                        <div class="body-step3 pb-5" data-wizard-type="step-content" data-kt-stepper-element="content">
                            <div class="row mb-5">
                                <div class="col-md-12 dmdError text-danger fw-bold fs-5 text-center"></div>
                            </div>
                            <div class="row mb-10">
                                <div class="col-md-4 col-12">
                                    <label class="fw-bolder text-dark fs-5">Document : <span class="text-danger">*</span></label>
                                    <select id="document_id" name="document_id" class="form-control">
                                        <option value="" selected>Sélectionner</option>
                                        @foreach($documents as $data)
                                            <option value="{{ $data->id }}" @php echo $data->id == $firstDoc->id ? 'selected':'' @endphp>{{ $data->label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 col-12">
                                    <label class="fw-bolder text-dark fs-5">Nombre : <span class="text-danger">*</span></label>
                                    <input type="text" id="number" name="number" value="{{ old('number', $firstDoc->number) }}" class="form-control requiredDmd text-center" placeholder="0" onKeyUp="verif_int(this)" data-valid="0" />
                                </div>
                                <div class="col-md-2 col-12">
                                    <label class="fw-bolder text-dark fs-5">Montant : <span class="text-danger">*</span></label>
                                    <input type="text" id="price" name="price" value="{{ old('price', $firstDoc->price) }}" class="form-control requiredDmd text-center" placeholder="0" onKeyUp="verif_int(this)" data-valid="0" />
                                </div>
                                <div class="col-md-2 col-12">
                                    <label class="fw-bolder text-dark fs-5">Copie : <span class="text-danger">*</span></label>
                                    <input type="text" id="copy" name="copy" value="1" class="form-control requiredDmd text-center" onKeyUp="verif_int(this)" data-valid="0" />
                                </div>
                                <div class="col-md-2 col-12">
                                    <label class="fw-bolder text-dark fs-5">Total : <span class="text-danger">*</span></label>
                                    <input type="text" id="total" name="total" value="{{ old('price', $firstDoc->price) }}" class="form-control text-center" readonly />
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-12 col-12">
                                    <label class="fw-bolder text-dark fs-4">Pièces jointes :</label>
                                </div>
                            </div>
                            <div class="files-list">
                                @foreach ($docFiles as $data)
                                    <div class="row mb-2">
                                        <div class="col-md-6 col-12">
                                            <label class="fw-bolder text-dark fs-6">
                                                {{ $data->files->label }} : <span class="text-danger">*</span>
                                                <a href="/storage/{{ $data->files->path }}" target="_blank">
                                                (Voir le specimen)
                                                </a>
                                            </label>
                                            <input type="file" name="filename[{{ $data->files->id }}]" class="form-control filename" accept=".pdf,.png,.jpg,.jpeg" />
                                        </div>
                                        <div class="col-md-1 col-12 position-relative">
                                            <a href="/storage/{{ $data->files->path }}" target="_blank">
                                                <i class="ki-duotone ki-paper-clip fs-1 text-primary position-absolute start-50 bottom-0 translate-middle"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!--end::Form Wizard Step 3-->
                        <!--begin::Form Wizard Step 4-->
                        <div class="body-step4 pb-5" data-wizard-type="step-content" data-kt-stepper-element="content">
                            <div class="row mb-5">
                                <div class="col-md-12 text-primary fw-bold fs-2">Informations de l'utilisateur</div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-2 col-12">
                                    <label class="fs-5">Civilité : <span class="civility fw-bold fs-5 text-dark"></span></label>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label class="fs-5">Nom : <span class="lastname fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Prénoms : <span class="firstname fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Numéro de téléphone : <span class="phone_number fw-bold fs-5 text-dark"></span></label>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Email : <span class="email fw-bold fs-5 text-lowercase text-dark"></span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6" col-12">
                                    <label class="fs-5">Date de naissance : <span class="birthday_at fw-bold fs-5 text-dark">@php echo date('d-m-Y') @endphp</span></label>
                                </div>
                                <div class="col-md-6" col-12">
                                    <label class="fs-5">Lieu de naissance : <span class="birthplace fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6" col-12">
                                    <label class="fs-5">
                                        Pays de naissance : 
                                        <span class="country_id fw-bold fs-5 text-uppercase text-dark">                                            
                                        @foreach($country as $data)
                                            @php echo $data->id == 61 ? $data->country : '' @endphp
                                        @endforeach
                                        </span>
                                </label>
                                </div>
                                <div class="col-md-6" col-12">
                                    <label class="fs-5">Préfecture de naissance : <span class="town_id fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Profession : <span class="profession fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">
                                        Nationalité : 
                                        <span class="nationality_id fw-bold fs-5 text-uppercase text-dark">
                                        @foreach($nationality as $data)
                                            @php echo $data->id == 61 ? $data->nationality : '' @endphp
                                        @endforeach
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Nom et prénoms du père : <span class="father_fullname fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Nom et prénoms de la mère : <span class="mother_fullname fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-4 col-12">
                                    <label class="fs-5">Taille : <span class="size fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label class="fs-5">Teint : <span class="complexion fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                                <div class="col-md-4 col-12">
                                    <label class="fs-5">Cheveux : <span class="hairs fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Date d'arrivée : <span class="arrival_at fw-bold fs-5 text-dark">@php echo date('d-m-Y') @endphp</span></label>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Signes particuliers : <span class="particular_sign fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-12 col-12">
                                    <label class="fs-5">Domicile : <span class="home_address fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12 col-12">
                                    <label class="fw-bolder text-dark fs-4">Personne à prévenir :</label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Nom et prénoms : <span class="person_fullname fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                                <div class="col-md-6 col-12">
                                    <label class="fs-5">Numéro de téléphone : <span class="person_number fw-bold fs-5 text-dark"></span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-12 col-12">
                                    <label class="fs-5">Adresse : <span class="person_address fw-bold fs-5 text-uppercase text-dark"></span></label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-12 text-primary fw-bold fs-2">Informations de la demande</div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-12 col-12">
                                    <label class="document_id fw-bold fs-4 text-uppercase text-dark">{{ $firstDoc->label }}</label>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-3 col-12">
                                    <label class="fs-5">Nombre : <span class="number fw-bold fs-5 text-uppercase text-dark">{{ $firstDoc->number }}</span></label>
                                </div>
                                <div class="col-md-3 col-12">
                                    <label class="fs-5">Montant : <span class="price fw-bold fs-5 text-uppercase text-dark">{{ number_format($firstDoc->price, 0, ',', ' ') }}</span></label>
                                </div>
                                <div class="col-md-3 col-12">
                                    <label class="fs-5">Copie : <span class="copy fw-bold fs-5 text-uppercase text-dark">1</span></label>
                                </div>
                                <div class="col-md-3 col-12">
                                    <label class="fs-5">Total : <span class="total fw-bold fs-5 text-uppercase text-dark">{{ number_format($firstDoc->price, 0, ',', ' ') }}</span></label>
                                </div>
                            </div>
                        </div>
                        <!--end::Form Wizard Step 4-->
                        <!--begin::Wizard Actions-->
                        <div class="d-flex justify-content-between border-top pt-10">
                            <div class="mr-2">
                                <button type="button" class="btn btn-light-danger font-weight-bold px-6 py-3 fs-4 btn-previous btn-step">Précédent</button>
                            </div>
                            <div>
                                <button type="button" class="btn btn-success font-weight-bold px-6 py-3 fs-4 btn-submit btn-step submitForm" data-step="1">Envoyer</button>
                                <button type="button" class="btn btn-primary font-weight-bold px-6 py-3 fs-4 btn-next btn-step" data-step="1">Suivant</button>
                            </div>
                        </div>
                        <!--end::Wizard Actions-->
                    </form>
                    <!--end::Form Wizard Form-->
                </div>
            </div>
        </div>
        <!--end::Wizard-->
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="/assets/js/custom/wizard.js?v={{ time() }}"></script>
    <script>
        $(document).ready(function() {
            // Masquer les boutons précédent et envoyer
            $('.btn-previous, .btn-submit').hide();
            // Rechercher les utilisateurs
            $(document).on('keyup', '#search', function() {
                // Initialiser l'ID de l'utilisateur à 0
                $('#user_id').val(0);
                let emptyUsers = `
                    <div class="mh-375px scroll-y me-n7 pe-7">
                        <div class="fw-semibold">
                            <span class="fs-6 text-gray-800">Aucun utilisateur trouvé</span>
                        </div>
                    </div>
                `;
                $('#users-list').html(emptyUsers);
                let search = $('#search').val();
                if (search.length > 1) {
                    const searchUsers = async () => {
                        try {
                            const response = await axios.post('/searchUsers', {
                                search: search
                            }, {
                                headers: {
                                    'Content-Type': 'application/json',
                                }
                            });
                            return response.data.data || [];
                        } catch (e) {
                            console.error(e);
                            return [];
                        }
                    }

                    searchUsers().then(
                        response => {
                            let outUsers = ``;
                            if (response.length > 0) {
                                response.map(data => {
                                    outUsers += `
                                        <!--begin::Users-->
                                        <div class="mh-375px scroll-y me-n7 pe-7">
                                            <!--begin::User-->
                                            <a class="d-flex align-items-center p-3 rounded bg-state-light bg-state-opacity-50 mb-1">
                                                <!--begin::Avatar-->
                                                <label class="boxcheck"><input type="radio" name="user" value="${data.id}" class="iCheck user_id"></label>
                                                <div class="symbol symbol-35px symbol-circle mx-5">
                                                    <img src="/storage/${data.avatar}" alt="${data.username}" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Info-->
                                                <div class="fw-semibold">
                                                    <div class="fs-6 text-gray-800 me-2">${data.username}</div>
                                                    <div class="fs-6 badge badge-primary">${data.nationality}</div>
                                                </div>
                                                <!--end::Info-->
                                            </a>
                                            <!--end::User-->
                                        </div>
                                    `;
                                });
                            } else {
                                outUsers += emptyUsers;
                            }
                            $('#users-list').html(outUsers);
                            $('.iCheck').iCheck({
                                checkboxClass: 'icheckbox_square-blue',
                                radioClass: 'iradio_square-blue',
                                increaseArea: '20%'
                            });
                        }
                    );
                }
            });
            // Récupérer l'ID de l'utilisateur sélectionné
            $(document).on('ifChecked', '.user_id', function(event) {
                $('#user_id').val($(this).parents('label').find('input').val());
            });
            // Rechercher les documents
            $(document).on('change', '#document_id', function() {
                let id = $(this).val();
				if (!id) return;
                const getDocs = async (id) => {
                    try {
                        const response = await axios.get( `/getDocs/${id}`);
                        return response.data?.data || null;
                    } catch (e) {
                        console.error(e);
                    }
                }
                getDocs(id).then(
                    response => {
                        if (response) {
                            $('#copy').val(1);
                            $('#codeDoc').val(response.docs.code);
                            $('#number').val(response.docs.number);
                            $('.number').text(response.docs.number);
                            $('#price, #total').val(response.docs.price);
                            $('.price, .total').text(response.docs.price);
                            $('.files-list').html(response.files.map(file => `<div class="row mb-5">
                                <div class="col-md-6 col-12">
                                    <label class="fw-bolder text-dark fs-6">
                                        ${file.label} : <span class="text-danger">*</span>
                                        <a href="/storage/${file.path}" target="_blank">
                                        (Voir le specimen)
                                        </a>
                                    </label>
                                    <input type="file" name="filename[${file.id}]" class="form-control filename" accept=".pdf,.png,.jpg,.jpeg" />
                                </div>
                                <div class="col-md-1 col-12 position-relative">
                                    <a href="/storage/${file.path}" target="_blank">
                                        <i class="ki-duotone ki-paper-clip fs-1 text-primary position-absolute start-50 bottom-0 translate-middle"></i>
                                    </a>
                                </div>
                            </div>`).join(''));
                            dmdForm();
                        }
                    }
                );
            });
            // Bouton précédent
            $('.btn-previous').on('click', function() {
                var step = $(this).data('step') - 1;
                $('.btn-step').data('step', step).attr('data-step', step);
                // Step 1
                if (step == 1) {
                    $('.btn-previous').hide();
                    $('.body-step1').addClass('current');
                    $('.body-step2').removeClass('current');
                    $('.header-step2').removeAttr('data-wizard-state');
                    $('.btn-next').addClass('btn-primary').removeClass('not-active');
                }
                // Step 2
                if (step == 2) {
                    $('.body-step2').addClass('current');
                    $('.body-step3').removeClass('current');
                    $('.header-step3').removeAttr('data-wizard-state');
                }
                // Step 3
                if (step == 3) {
                    $('.body-step3').addClass('current');
                    $('.body-step4').removeClass('current');
                    $('.header-step4').removeAttr('data-wizard-state');
                    $('.btn-next').show();
                    $('.btn-submit').hide();
                }
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
            // Bouton suivant
            $('.btn-next').on('click', function () {
                // Gestion visibilité des boutons
                $('.btn-previous').show();
                var step = $(this).data('step') + 1;
                // Action de data-wizard-type="action-next"
                $('.btn-step').data('step', step).attr('data-step', step);
                // Step 2
                if (step == 2) {
                    // let step2 = $('#step2').val();
                    // if (step2 == 0) {
                    //     $('.btn-next').addClass('not-active');
                    // } else {
                    //     $('.btn-next').addClass('btn-primary').removeClass('not-active');
                    // }
                    $('.body-step2').addClass('current');
                    $('.body-step1').removeClass('current');
                    $('.header-step2').attr('data-wizard-state', 'current');
                }
                // Step 3
                if (step == 3) {
                    // let step3 = $('#step3').val();
                    // if (step3 == 0) {
                    //     $('.btn-next').addClass('not-active');
                    // } else {
                    //     $('.btn-next').addClass('btn-primary').removeClass('not-active');
                    // }
                    $('.body-step3').addClass('current');
                    $('.body-step2').removeClass('current');
                    $('.header-step3').attr('data-wizard-state', 'current');
                }
                // Step 4
                if (step == 4) {
                    $('.body-step4').addClass('current');
                    $('.body-step3').removeClass('current');
                    $('.header-step4').attr('data-wizard-state', 'current');
                    $('.btn-next').hide();
                    $('.btn-submit').show();
                }
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
            // Changement du pays
            $(document).on('change', '#country_id', function() {
                // $('.userError').show().html("Veuillez renseigner tous les champs obligatoires.");
                // $('.btn-next').addClass('not-active').removeClass('btn-primary');
            });
            // Changement de la civilité et de la préfecture
            $(document).on('change', '#civility, #town_id', function() {
                if ($(this).val() == '') {
                    $(this).data('valid', 1).attr('data-valid', 1);
                } else {
                    $(this).data('valid', 0).attr('data-valid', 0);
                }
                userForm();
            });
            // Zone de texte Utilisateur
            $(document).on('keyup', '.requiredUser', function() {
                if ($(this).val() == '') {
                    $(this).data('valid', 1).attr('data-valid', 1);
                } else {
                    $(this).data('valid', 0).attr('data-valid', 0);
                }
                userForm();
            });
            // Zone de email
            $(document).on('keyup', '.email', function() {
                let value = jQuery.trim($(this).val());
                if (value != '') {
                    let regex = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                    if (!regex.test(value)) {
                        $('#step2').val(0);
                        $('.userError').show().html("Adresse e-mail non valide.");
                        $('.btn-next').addClass('not-active').removeClass('btn-primary');
                    } else userForm();
                } else userForm();
            });
            // Validation du formulaire de l'utilisateur
            function userForm() {
                var sum = 0;
                $('.body-step2 .requiredUser').each(function() {
                    let value = $(this).attr('name') == undefined ? 0 : 1;
                    if (value == 1) {
                        sum += $(this).data('valid');
                    }
                });
                // if (sum > 0) {
                //     $('#step2').val(0);
                //     $('.userError').show().html("Veuillez renseigner tous les champs obligatoires.");
                //     $('.btn-next').addClass('not-active').removeClass('btn-primary');
                // } else {
                //     $('#step2').val(1);
                //     $('.userError').hide().html("");
                //     $('.btn-next').addClass('btn-primary').removeClass('not-active');
                // }
            }
            // Zone de Montant et de Copie
            $(document).on('keyup', '#price, #copy', function() {
                let price = parseInt($('#price').val()) || 0;
                let copy = parseInt($('#copy').val()) || 1;
                let total = price * copy;
                $('#total').val(total);
                $('.total').text(total);
            });
            // Validation des fichiers
            $(document).on('change', '.filename', function() {
                $('.dmdError').html('');
                var imgObj = $(this)[0].files[0];
                var iSize = imgObj.size;
                var value = $(this).val();
                var file = value.toLowerCase();
                var iExt = file.substr((file.lastIndexOf('.')+1));
                var ValidImageTypes = ['pdf', 'jpg', 'jpeg', 'png'];
                if ($.inArray(iExt, ValidImageTypes) < 0) {
                    $('#step3').val(0);
                    $('.btn-next').addClass('not-active').removeClass('btn-primary');
                    $('.dmdError').html('Les types de fichier autorisés sont : PDF ou Image.');
                } else if(iSize > 2000000) {
                    $('#step3').val(0);
                    $('.btn-next').addClass('not-active').removeClass('btn-primary');
                    $('.dmdError').html('La taille du fichier doit être inférieure ou égale à 2MB.');
                } else {
                    dmdForm();
                }
            });
            // Zone de texte Document
            $(document).on('keyup', '.requiredDmd', function() {
                if ($(this).val() == '') {
                    $(this).data('valid', 1).attr('data-valid', 1);
                } else {
                    $(this).data('valid', 0).attr('data-valid', 0);
                }
                dmdForm();
            });
            // Validation du formulaire de l'document
            function dmdForm() {
                var sum = 0;
                $('.body-step3 .requiredDmd').each(function() {
                    let value = $(this).attr('name') == undefined ? 0 : 1;
                    if (value == 1) {
                        sum += $(this).data('valid');
                    }
                });
                if (sum > 0) {
                    $('#step3').val(0);
                    $('.dmdError').show().html("Veuillez renseigner tous les champs obligatoires.");
                    $('.btn-next').addClass('not-active').removeClass('btn-primary');
                } else {
                    $('#step3').val(1);
                    $('.dmdError').hide().html("");
                    $('.btn-next').addClass('btn-primary').removeClass('not-active');
                }
            }
            // Champs texte / input
            var textFields = [
                'lastname', 'firstname', 'phone_number', 'email', 'profession', 'birthplace', 'father_fullname', 'mother_fullname', 'size', 'complexion', 'hairs', 'particular_sign', 'home_address', 'person_fullname', 'person_number', 'person_address', 'number', 'price', 'copy', 'total',
            ];
            $.each(textFields, function (i, field) {
                $('[name="' + field + '"]').on('keyup change', function () {
                    $('.' + field).text($(this).val());
                });
            });
            // Dates : reformatage Y-m-d → d-m-Y
            var dateFields = ['birthday_at', 'arrival_at'];
            $.each(dateFields, function (i, field) {
                $('[name="' + field + '"]').on('change', function () {
                    var val = $(this).val();
                    if (val) {
                        var parts     = val.split('-');
                        var formatted = parts[2] + '-' + parts[1] + '-' + parts[0];
                        $('.' + field).text(formatted);
                    } else {
                        $('.' + field).text('');
                    }
                });
            });
            var selectFields = [
                'civility', 'country_id', 'town_id', 'nationality_id', 'document_id',
            ];
            $.each(selectFields, function (i, field) {
                $('[name="' + field + '"]').on('change', function () {
                    $('.' + field).text($('option:selected', this).text());
                });
            });
        });
    </script>
@endsection