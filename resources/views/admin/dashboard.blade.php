@extends('layouts.applicant_app')

@section('content')
<div class="container">
    <h3>Admin Dashboard</h3>
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('admin.pending') }}" >
            <div class="alert alert-warning">Pending: {{ $pending }}</div>
            </a>
        </div>
        <div class="col-md-4">
            <div class="alert alert-success">Approved: {{ $approved }}</div>
        </div>
        <div class="col-md-4">
            <div class="alert alert-danger">Rejected: {{ $rejected }}</div>
        </div>
    </div>
</div>
@endsection
