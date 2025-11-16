@extends('layouts.app')

@section('content')
<div class="max-w-2xl bg-white shadow rounded p-6">
  <h2 class="text-xl font-semibold mb-4">Add New Student</h2>

  <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="grid grid-cols-1 gap-4">
      <div>
        <label class="block text-sm font-medium">Full Name</label>
        <input type="text" name="name" value="{{ old('name') }}" class="mt-1 block w-full border rounded px-3 py-2">
        @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium">Roll No</label>
          <input type="text" name="roll_no" value="{{ old('roll_no') }}" class="mt-1 block w-full border rounded px-3 py-2">
          @error('roll_no') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
          <label class="block text-sm font-medium">Class</label>
          <select name="classroom_id" class="mt-1 block w-full border rounded px-3 py-2">
            <option value="">Select class</option>
            @foreach($classes as $c)
              <option value="{{ $c->id }}" @selected(old('classroom_id') == $c->id)>{{ $c->name }}</option>
            @endforeach
          </select>
          @error('classroom_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium">Contact</label>
          <input type="text" name="contact" value="{{ old('contact') }}" class="mt-1 block w-full border rounded px-3 py-2">
        </div>
        <div>
          <label class="block text-sm font-medium">Date of Birth</label>
          <input type="date" name="dob" value="{{ old('dob') }}" class="mt-1 block w-full border rounded px-3 py-2">
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium">Photo</label>
        <input type="file" name="photo" class="mt-1">
        @error('photo') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="block text-sm font-medium">Address</label>
        <textarea name="address" class="mt-1 block w-full border rounded px-3 py-2">{{ old('address') }}</textarea>
      </div>

      <div class="flex items-center gap-3">
        <button type="submit" class="px-4 py-2 rounded bg-green-600 text-white">Save</button>
        <a href="{{ route('students.index') }}" class="px-4 py-2 rounded border">Cancel</a>
      </div>
    </div>
  </form>
</div>
@endsection
