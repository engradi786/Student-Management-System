@extends('layouts.app')

@section('content')
<div class="max-w-4xl bg-white shadow rounded p-6">
  <div class="flex items-center gap-6">
    <img src="{{ $student->photo ? asset('storage/'.$student->photo) : asset('images/avatar-placeholder.png') }}" class="w-32 h-32 rounded object-cover" alt="photo">
    <div>
      <h2 class="text-2xl font-semibold">{{ $student->name }}</h2>
      <p class="text-sm text-gray-600">Roll No: {{ $student->roll_no }}</p>
      <p class="text-sm text-gray-600">Class: {{ $student->classroom->name ?? '-' }}</p>
    </div>
  </div>

  <div class="mt-6 grid grid-cols-3 gap-6">
    <div class="col-span-2">
      <h3 class="font-medium mb-2">About</h3>
      <p class="text-sm text-gray-700">{{ $student->bio ?? 'No additional information.' }}</p>

      <h3 class="font-medium mt-6 mb-2">Attendance Summary</h3>
      <!-- Placeholder table -->
      <table class="w-full text-sm border rounded">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-3 py-2 text-left">Month</th>
            <th class="px-3 py-2 text-left">Present</th>
            <th class="px-3 py-2 text-left">Absent</th>
          </tr>
        </thead>
        <tbody>
          @foreach($attendanceSummary as $row)
          <tr>
            <td class="px-3 py-2">{{ $row['month'] }}</td>
            <td class="px-3 py-2">{{ $row['present'] }}</td>
            <td class="px-3 py-2">{{ $row['absent'] }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <aside>
      <h3 class="font-medium mb-2">Quick Links</h3>
      <ul class="text-sm space-y-2">
        <li><a href="{{ route('fees.history', $student) }}" class="text-blue-600">View Fees History</a></li>
        <li><a href="{{ route('attendance.report', ['student'=>$student->id]) }}" class="text-blue-600">Attendance Report</a></li>
        <li><a href="{{ route('students.edit', $student) }}" class="text-blue-600">Edit Student</a></li>
      </ul>
    </aside>
  </div>
</div>
@endsection
