@extends('layouts.applicant_app')

@section('content')
<div class="container">
    <h3 class="mb-4">Final Preview & Submit</h3>

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


    {{-- Payment Details --}}
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            <strong>Step 1: Payment Details</strong>
            {{-- <a href="{{ route('applicant.payment') }}" class="btn btn-sm btn-outline-primary">Edit</a> --}}
        </div>
        
        <div class="card-body">
            <p><strong>Bank:</strong> {{ $applicant->payments->bank_name ?? '--' }}</p>
            <p><strong>Amount:</strong> {{ $applicant->payments->amount ?? '--' }}</p>
            <p><strong>Reference No:</strong> {{ $applicant->payments->payment_ref ?? '--' }}</p>
            <p><strong>Date:</strong> {{ $applicant->payments->payment_date ?? '--' }}</p>
        </div>
    </div>

    {{-- Personal Info --}}
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            <strong>Step 2: Personal Information</strong>
            {{-- <a href="{{ route('applicant.personal') }}" class="btn btn-sm btn-outline-primary">Edit</a> --}}
        </div>
        
        <div class="card-body">
            <p><strong>Name:</strong> {{ $applicant->full_name }}</p>
            <p><strong>Date of Birth:</strong> {{ $applicant->dob }}</p>
            {{-- <p><strong>Age:</strong> {{ $applicant->age }}</p> --}}
            <p><strong>Gender:</strong> {{ $applicant->gender }}</p>
            <p><strong>Category:</strong> {{ $applicant->category }}</p>
            <p><strong>Address:</strong> {{ $applicant->address }}</p>
            <p><strong>Mobile:</strong> {{ $applicant->mobile }}</p>
            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
        </div>
    </div>

    {{-- Educational Information --}}
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            <strong>Educational Information</strong>
            {{-- <a href="{{ route('applicant.education') }}" class="btn btn-sm btn-outline-primary">Edit</a> --}}
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Level</th>
                        <th>Board/University</th>
                        <th>Subjects</th>
                        <th>Year</th>
                        <th>Marks</th>
                        <th>Division</th>
                        <th>Certificate No</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applicant->educations as $edu)
                        <tr>
                            <td>{{ $edu->level }}</td>
                            <td>{{ $edu->board_university }}</td>
                            <td>{{ $edu->subjects }}</td>
                            <td>{{ $edu->year }}</td>
                            <td>{{ $edu->marks }}</td>
                            <td>{{ $edu->division }}</td>
                            <td>{{ $edu->certificate_no }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Work Experience --}}
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            <strong>Work Experience</strong>
            {{-- <a href="{{ route('applicant.experience') }}" class="btn btn-sm btn-outline-primary">Edit</a> --}}
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Institution</th>
                        <th>Designation</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Total Period</th>
                        <th>Subjects Taught</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applicant->experiences as $exp)
                        <tr>
                            <td>{{ $exp->institution }}</td>
                            <td>{{ $exp->designation }}</td>
                            <td>{{ $exp->from_date }}</td>
                            <td>{{ $exp->to_date }}</td>
                            <td>{{ $exp->total_period }}</td>
                            <td>{{ $exp->subjects_taught }}</td>
                            <td>{{ $exp->current ? 'Current' : 'Previous' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Uploaded Documents --}}
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            <strong>Step 3: Uploaded Documents</strong>
            {{-- <a href="{{ route('applicant.documents') }}" class="btn btn-sm btn-outline-primary">Edit</a> --}}
        </div>
        <div class="card-body">
           
                
           
            <ul>
                 @foreach ($applicant->documents as $doc)
                <li>{{ $doc->type }} Certificate Photo: {!! $doc->path ? '✔ Uploaded' : '✖ Missing' !!}</li>
                 @endforeach
            </ul>
        </div>
    </div>

    {{-- Declaration --}}
    <form action="{{ route('applicant.submit') }}" method="POST">
        @csrf
        <div class="form-check mb-3">
            <input type="checkbox" name="declaration" class="form-check-input" required>
            <label class="form-check-label">
                I hereby declare that all the information furnished by me is true to the best of my knowledge.
            </label>
        </div>
        <button type="submit" class="btn btn-success w-100">Submit Application</button>
    </form>
</div>
@endsection
