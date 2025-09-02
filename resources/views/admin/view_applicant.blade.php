@extends('layouts.applicant_app')

@section('content')
<div class="container">
    <h3>Applicant Details</h3>

    <p><strong>Name:</strong> {{ $applicant->full_name }}</p>
    <p><strong>Subject:</strong> {{ $applicant->subject }}</p>
    <p><strong>Category:</strong> {{ $applicant->category }}</p>
    <p><strong>Status:</strong> {{ ucfirst($applicant->status) }}</p>

    {{-- Show education, experience, documents tables here --}}

    <form method="POST" action="{{ route('admin.applicant.approve', $applicant->id) }}">
        @csrf
        <button type="submit" class="btn btn-success">Approve & Generate Registration No.</button>
    </form>
</div>
@endsection
