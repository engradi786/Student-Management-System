@extends('layouts.app')

@section('content')
<div class="max-w-3xl bg-white shadow rounded p-6">
  <div class="flex items-start gap-6">
    <img src="{{ $student->photo ? asset('storage/'.$student->photo) : asset('images/avatar-placeholder.png') }}" class="w-28 h-28 rounded object-cover" alt="photo">
    <div>
      <h2 class="text-2xl font-semibold">{{ $student->name }}</h2>
      <p class="text-sm text-gray-600">Roll: {{ $student->roll_no }} • Class: {{ $student->classroom->name ?? 'N/A' }}</p>
      <p class="mt-3">{{ $student->address }}</p>

      <div class="mt-4 flex gap-3">
        <a href="{{ route('students.edit', $student) }}" class="px-3 py-2 rounded bg-blue-600 text-white">Edit</a>
        <a href="{{ route('students.profile', $student) }}" class="px-3 py-2 rounded border">View Profile</a>
      </div>
    </div>
  </div>

  <hr class="my-6">

  <div class="grid grid-cols-2 gap-4">
    <div>
      <h3 class="text-sm font-medium text-gray-600">Contact</h3>
      <p class="mt-1">{{ $student->contact ?? '-' }}</p>
    </div>
    <div>
      <h3 class="text-sm font-medium text-gray-600">Date of Birth</h3>
      <p class="mt-1">{{ $student->dob?->format('d M, Y') ?? '-' }}</p>
    </div>

    <div>
      <h3 class="text-sm font-medium text-gray-600">Guardian</h3>
      <p class="mt-1">{{ $student->guardian_name ?? '-' }}</p>
    </div>

    <div>
      <h3 class="text-sm font-medium text-gray-600">Fees Status</h3>
      <p class="mt-1">{{ $student->fees_status ?? 'Not available' }}</p>
    </div>
  </div>
</div>
@endsection
