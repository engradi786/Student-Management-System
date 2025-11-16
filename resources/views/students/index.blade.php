@extends('layouts.app')

@section('content')
<div class="flex items-center justify-between mb-6">
  <h2 class="text-2xl font-semibold">Students</h2>
  <div>
    <a href="{{ route('students.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded">+ Add Student</a>
  </div>
</div>

<div class="bg-white shadow rounded">
  <div class="p-4 border-b">
    <form method="GET" action="{{ route('students.index') }}" class="flex gap-2">
      <input name="q" value="{{ request('q') }}" placeholder="Search name, roll, class..." class="border rounded px-3 py-2 flex-1">
      <button type="submit" class="px-4 py-2 bg-gray-100 rounded">Search</button>
    </form>
  </div>

  <div class="overflow-x-auto">
    <table class="min-w-full divide-y">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-4 py-3 text-left text-sm font-medium">#</th>
          <th class="px-4 py-3 text-left text-sm font-medium">Photo</th>
          <th class="px-4 py-3 text-left text-sm font-medium">Name</th>
          <th class="px-4 py-3 text-left text-sm font-medium">Roll</th>
          <th class="px-4 py-3 text-left text-sm font-medium">Class</th>
          <th class="px-4 py-3 text-left text-sm font-medium">Contact</th>
          <th class="px-4 py-3 text-left text-sm font-medium">Actions</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y">
        @forelse($students as $student)
        <tr>
          <td class="px-4 py-3">{{ $loop->iteration + (($students->currentPage()-1) * $students->perPage()) }}</td>
          <td class="px-4 py-3">
            <img src="{{ $student->photo ? asset('storage/'.$student->photo) : asset('images/avatar-placeholder.png') }}" alt="" class="w-10 h-10 rounded-full object-cover">
          </td>
          <td class="px-4 py-3">{{ $student->name }}</td>
          <td class="px-4 py-3">{{ $student->roll_no }}</td>
          <td class="px-4 py-3">{{ $student->classroom->name ?? '-' }}</td>
          <td class="px-4 py-3">{{ $student->contact }}</td>
          <td class="px-4 py-3">
            <a href="{{ route('students.show', $student) }}" class="text-sm mr-2">View</a>
            <a href="{{ route('students.edit', $student) }}" class="text-sm mr-2 text-blue-600">Edit</a>
            <form action="{{ route('students.destroy', $student) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this student?')">
              @csrf
              @method('DELETE')
              <button class="text-sm text-red-600">Delete</button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="px-4 py-6 text-center text-gray-500">No students found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="p-4">
    {{ $students->withQueryString()->links() }}
  </div>
</div>
@endsection
