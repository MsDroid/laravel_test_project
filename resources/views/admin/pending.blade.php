@extends('layouts.applicant_app')

@section('content')
<div class="container">
    <h3>Pending Applications</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Subject</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($applicants as $app)
                <tr>
                    <td>{{ $app->full_name }}</td>
                    <td>{{ $app->subject }}</td>
                    <td>{{ $app->category }}</td>
                    <td><span class="badge bg-warning">Pending</span></td>
                    <td>
                        <a href="{{ route('admin.applicant.view', $app->id) }}" class="btn btn-primary btn-sm">View</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No pending applications</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection