@extends('layouts.app')

@section('content')
<div class="container mt-4">
  <div class="card">
    <div class="card-header">
      <h2 class="mb-0">Add New Student</h2>
    </div>
    <div class="card-body">
      <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
          @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="roll_no" class="form-label">Roll No</label>
            <input type="text" class="form-control @error('roll_no') is-invalid @enderror" id="roll_no" name="roll_no" value="{{ old('roll_no') }}">
            @error('roll_no') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
          <div class="col-md-6 mb-3">
            <label for="classroom_id" class="form-label">Class</label>
            <select class="form-control @error('classroom_id') is-invalid @enderror" id="classroom_id" name="classroom_id">
              <option value="">Select class</option>
              @foreach($classes as $c)
                <option value="{{ $c->id }}" @selected(old('classroom_id') == $c->id)>{{ $c->name }}</option>
              @endforeach
            </select>
            @error('classroom_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="contact" class="form-label">Contact</label>
            <input type="text" class="form-control" id="contact" name="contact" value="{{ old('contact') }}">
          </div>
          <div class="col-md-6 mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob') }}">
          </div>
        </div>

        <div class="mb-3">
          <label for="photo" class="form-label">Photo</label>
          <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo">
          @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
          <label for="address" class="form-label">Address</label>
          <textarea class="form-control" id="address" name="address" rows="3">{{ old('address') }}</textarea>
        </div>

        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-success">Save</button>
          <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
