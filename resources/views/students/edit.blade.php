@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <div class="card">
    <div class="card-header">
      <h2 class="mb-0">Edit Student</h2>
    </div>
    <div class="card-body">
      <form action="{{ route('students.update', $student) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $student->name) }}">
          @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="roll_no" class="form-label">Roll No</label>
            <input type="text" class="form-control" id="roll_no" name="roll_no" value="{{ old('roll_no', $student->roll_no) }}">
          </div>
          <div class="col-md-6 mb-3">
            <label for="classroom_id" class="form-label">Class</label>
            <select class="form-control" id="classroom_id" name="classroom_id">
              <option value="">Select class</option>
              @foreach($classes as $c)
                <option value="{{ $c->id }}" @selected(old('classroom_id', $student->classroom_id) == $c->id)>{{ $c->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="contact" class="form-label">Contact</label>
            <input type="text" class="form-control" id="contact" name="contact" value="{{ old('contact', $student->contact) }}">
          </div>
          <div class="col-md-6 mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob', $student->dob?->format('Y-m-d')) }}">
          </div>
        </div>

        <div class="mb-3">
          <label for="photo" class="form-label">Photo</label>
          <div class="d-flex align-items-center gap-3">
            <input type="file" class="form-control" id="photo" name="photo" style="flex: 1;">
            @if($student->photo)
              <img src="{{ asset('storage/'.$student->photo) }}" class="rounded" style="width: 64px; height: 64px; object-fit: cover;" alt="photo">
            @endif
          </div>
        </div>

        <div class="mb-3">
          <label for="address" class="form-label">Address</label>
          <textarea class="form-control" id="address" name="address" rows="3">{{ old('address', $student->address) }}</textarea>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary">Update</button>
          <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
