@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-2 text-center">
          <img src="{{ $student->photo ? asset('storage/'.$student->photo) : asset('images/avatar-placeholder.png') }}" class="img-fluid rounded" style="max-width: 128px;" alt="photo">
        </div>
        <div class="col-md-10">
          <h2 class="mb-2">{{ $student->name }}</h2>
          <p class="text-muted mb-1">
            <strong>Roll No:</strong> {{ $student->roll_no }}
          </p>
          <p class="text-muted">
            <strong>Class:</strong> {{ $student->classroom->name ?? '-' }}
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-md-9">
      <div class="card mb-3">
        <div class="card-header">
          <h5 class="mb-0">About</h5>
        </div>
        <div class="card-body">
          <p class="text-muted">{{ $student->bio ?? 'No additional information.' }}</p>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">Attendance Summary</h5>
        </div>
        <div class="table-responsive">
          <table class="table table-sm table-striped">
            <thead class="table-light">
              <tr>
                <th>Month</th>
                <th>Present</th>
                <th>Absent</th>
              </tr>
            </thead>
            <tbody>
              @foreach($attendanceSummary as $row)
              <tr>
                <td>{{ $row['month'] }}</td>
                <td>{{ $row['present'] }}</td>
                <td>{{ $row['absent'] }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">Quick Links</h5>
        </div>
        <div class="list-group list-group-flush">
          <a href="{{ route('fees.history', $student) }}" class="list-group-item list-group-item-action">View Fees History</a>
          <a href="{{ route('attendance.report', ['student'=>$student->id]) }}" class="list-group-item list-group-item-action">Attendance Report</a>
          <a href="{{ route('students.edit', $student) }}" class="list-group-item list-group-item-action">Edit Student</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
