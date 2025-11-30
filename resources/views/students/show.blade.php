@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-3">
          <img src="{{ $student->photo ? asset('storage/'.$student->photo) : asset('images/avatar-placeholder.png') }}" class="img-fluid rounded" alt="photo">
        </div>
        <div class="col-md-9">
          <h2 class="mb-2">{{ $student->name }}</h2>
          <p class="text-muted mb-3">
            <strong>Roll:</strong> {{ $student->roll_no }} • 
            <strong>Class:</strong> {{ $student->classroom->name ?? 'N/A' }}
          </p>
          <p class="mb-3">{{ $student->address }}</p>

          <div class="mt-4">
            <a href="{{ route('students.edit', $student) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('students.profile', $student) }}" class="btn btn-outline-primary">View Profile</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <hr class="my-4">

  <div class="row">
    <div class="col-md-6 mb-3">
      <h5 class="text-muted">Contact</h5>
      <p>{{ $student->contact ?? '-' }}</p>
    </div>
    <div class="col-md-6 mb-3">
      <h5 class="text-muted">Date of Birth</h5>
      <p>{{ $student->dob?->format('d M, Y') ?? '-' }}</p>
    </div>

    <div class="col-md-6 mb-3">
      <h5 class="text-muted">Guardian</h5>
      <p>{{ $student->guardian_name ?? '-' }}</p>
    </div>

    <div class="col-md-6 mb-3">
      <h5 class="text-muted">Fees Status</h5>
      <p>{{ $student->fees_status ?? 'Not available' }}</p>
    </div>
  </div>
</div>
@endsection
