@extends('layouts.applicant_app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg rounded-3">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Applicant Registration</h4>
                </div>
                <div class="card-body p-4">

                    {{-- Show Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

                    <form id="applicantForm" action="{{ route('register.applicant.post') }}" method="POST" novalidate>
                        @csrf

                        <!-- 1 -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Have you already applied in Advt. No. 01/2024?</label>
                            <select name="already_applied" class="form-select" required>
                                <option value="">Select</option>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                            <div class="form-text">If applied, payment option will not be activated.</div>
                        </div>

                        <!-- 2 -->
                        <input type="hidden" name="post" value="Teacher">

                        <!-- 3 -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Subject</label>
                            <select name="subject" class="form-select" required>
                                <option value="">Select Subject</option>
                                <option value="English">English</option>
                                <option value="Maths">Maths</option>
                                <option value="Hindi">Hindi</option>
                                <option value="Agriculture">Agriculture</option>
                            </select>
                            <div class="form-text">For Agriculture, B.Ed is not mandatory. For others, B.Ed is required.</div>
                        </div>

                        <!-- 4 -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Gender</label>
                            <select name="gender" class="form-select" required>
                                <option value="">Select Gender</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Others</option>
                            </select>
                        </div>

                        <!-- 5 -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Are you physically handicapped?</label>
                            <select name="physically_handicapped" id="is_handicapped" class="form-select" required>
                                <option value="">Select</option>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>

                        <div id="handicap_details_box" class="mb-3 d-none">
                            <label class="form-label fw-bold">Mention Details</label>
                            <input type="text" name="handicap_details" id="handicap_details" class="form-control">
                            <div class="form-text text-muted">Required if handicapped.</div>
                        </div>

                        <!-- 6 -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Category</label>
                            <select name="category" class="form-select" required>
                                <option value="">Select Category</option>
                                <option>General</option>
                                <option>ST</option>
                                <option>SC</option>
                                <option>OBC</option>
                            </select>
                            <div class="form-text">Other than General, caste certificate will be required during document upload.</div>
                        </div>

                        <!-- 7 -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Date of Birth</label>
                            <input type="date" name="dob" class="form-control" required>
                            <div class="form-text">Age should be between 25 and 40 as on 01-01-2024 (Relaxation applies).</div>
                        </div>

                        <!-- 8 -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Full Name</label>
                            <input type="text" name="full_name" class="form-control" required>
                        </div>

                        <!-- 9 -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mobile No.</label>
                            <input type="text" name="mobile" class="form-control" maxlength="10" pattern="\d{10}" required>
                        </div>

                        <!-- 10 -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email (Username)</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <!-- 11-12 -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Password</label>
                            <input type="password" name="password" id="password" class="form-control" minlength="8" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-4">Create Account</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const isHandicapped = document.getElementById('is_handicapped');
    const handicapDetailsBox = document.getElementById('handicap_details_box');
    const handicapDetails = document.getElementById('handicap_details');
    const form = document.getElementById('applicantForm');

    // Toggle "Mention details"
    isHandicapped.addEventListener('change', function() {
        if (this.value == "1") {
            handicapDetailsBox.classList.remove('d-none');
            handicapDetails.setAttribute('required', 'required');
        } else {
            handicapDetailsBox.classList.add('d-none');
            handicapDetails.removeAttribute('required');
            handicapDetails.value = '';
        }
    });

    // Password match validation
    form.addEventListener('submit', function(e) {
        if (document.getElementById('password').value !== document.getElementById('password_confirmation').value) {
            e.preventDefault();
            alert("Password and Confirm Password must match!");
        }
    });
</script>
@endsection
