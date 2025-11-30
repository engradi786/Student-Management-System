<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Load Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* Custom font import for aesthetics */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; /* Light gray background */
        }
        .card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    <div class="min-h-screen p-4 sm:p-6 lg:p-8 bg-gray-50">
        <main class="max-w-7xl mx-auto">
            <!-- Dashboard Header & Welcome -->
            <div class="pb-6 border-b border-gray-200 mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                            Welcome Back, Jane Doe
                        </h1>
                        <p class="mt-1 text-lg text-gray-500">
                            Your personalized student dashboard is ready.
                        </p>
                    </div>
                    <div class="mt-4 sm:mt-0">
                        <span class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 transition duration-150 ease-in-out">
                            Student ID: 120498
                        </span>
                    </div>
                </div>
            </div>

            <!-- Key Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

                <!-- Card 1: Current GPA -->
                <div class="card bg-white p-6 rounded-xl shadow-lg border-l-4 border-indigo-500">
                    <div class="flex items-center justify-between">
                        <div class="text-sm font-medium text-gray-500 uppercase">Current GPA</div>
                        <i data-lucide="award" class="w-6 h-6 text-indigo-500"></i>
                    </div>
                    <p class="mt-2 text-4xl font-bold text-gray-900">3.85</p>
                    <p class="text-xs text-green-500 mt-1 font-semibold">+0.1 improvement from last term</p>
                </div>

                <!-- Card 2: Attendance Rate -->
                <div class="card bg-white p-6 rounded-xl shadow-lg border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div class="text-sm font-medium text-gray-500 uppercase">Attendance Rate</div>
                        <i data-lucide="check-circle" class="w-6 h-6 text-green-500"></i>
                    </div>
                    <p class="mt-2 text-4xl font-bold text-gray-900">95%</p>
                    <p class="text-xs text-gray-400 mt-1">Excellent record</p>
                </div>

                <!-- Card 3: Total Enrolled Courses -->
                <div class="card bg-white p-6 rounded-xl shadow-lg border-l-4 border-yellow-500">
                    <div class="flex items-center justify-between">
                        <div class="text-sm font-medium text-gray-500 uppercase">Active Courses</div>
                        <i data-lucide="book-open" class="w-6 h-6 text-yellow-500"></i>
                    </div>
                    <p class="mt-2 text-4xl font-bold text-gray-900">5</p>
                    <p class="text-xs text-gray-400 mt-1">View all courses</p>
                </div>

            </div>

            <!-- Main Content Grid (Deadlines & Schedule) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Column 1: Upcoming Deadlines/Assignments -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-xl p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                            <i data-lucide="bell" class="w-5 h-5 mr-2 text-red-500"></i>
                            Upcoming Deadlines
                        </h3>
                        
                        <!-- Assignment List -->
                        <ul role="list" class="divide-y divide-gray-200">
                            <!-- Deadline Item 1 -->
                            <li class="py-4 flex justify-between items-center hover:bg-red-50 p-2 rounded-lg transition duration-150">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">CS 301: Final Project Proposal</p>
                                    <p class="text-xs text-red-600 mt-0.5 font-semibold">Due: 2 Days</p>
                                </div>
                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    High Priority
                                </span>
                            </li>
                            <!-- Deadline Item 2 -->
                            <li class="py-4 flex justify-between items-center hover:bg-blue-50 p-2 rounded-lg transition duration-150">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">ENGL 101: Essay Revision Submission</p>
                                    <p class="text-xs text-blue-600 mt-0.5 font-semibold">Due: Fri, Nov 29</p>
                                </div>
                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Medium
                                </span>
                            </li>
                            <!-- Deadline Item 3 -->
                            <li class="py-4 flex justify-between items-center hover:bg-yellow-50 p-2 rounded-lg transition duration-150">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">MATH 202: Chapter 5 Quiz</p>
                                    <p class="text-xs text-yellow-600 mt-0.5 font-semibold">Due: Next Week</p>
                                </div>
                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Low Priority
                                </span>
                            </li>
                        </ul>
                        <div class="mt-6">
                            <a href="#" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium flex items-center">
                                View Full Calendar
                                <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Column 2: Quick Links / Schedule -->
                <div>
                    <!-- Schedule Card -->
                    <div class="bg-white rounded-xl shadow-xl p-6 mb-8">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                            <i data-lucide="calendar-check" class="w-5 h-5 mr-2 text-indigo-500"></i>
                            Today's Schedule
                        </h3>
                        <div class="space-y-4">
                            <div class="border-l-4 border-indigo-400 pl-3">
                                <p class="text-sm font-medium text-gray-900">10:00 AM - CS 301 (Algorithms)</p>
                                <p class="text-xs text-gray-500">Room 301, Engineering Building</p>
                            </div>
                            <div class="border-l-4 border-gray-300 pl-3 opacity-70">
                                <p class="text-sm font-medium text-gray-900">1:00 PM - Lunch Break</p>
                                <p class="text-xs text-gray-500">Cafeteria</p>
                            </div>
                            <div class="border-l-4 border-indigo-400 pl-3">
                                <p class="text-sm font-medium text-gray-900">2:30 PM - ENGL 101 (Literature)</p>
                                <p class="text-xs text-gray-500">Online/Zoom Link</p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions Card -->
                    <div class="bg-white rounded-xl shadow-xl p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                            <i data-lucide="zap" class="w-5 h-5 mr-2 text-yellow-500"></i>
                            Quick Actions
                        </h3>
                        <div class="grid grid-cols-2 gap-3">
                            <button class="flex flex-col items-center justify-center p-4 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition duration-150">
                                <i data-lucide="mail" class="w-5 h-5 text-indigo-600 mb-1"></i>
                                <span class="text-xs font-medium text-indigo-700">Message Profs</span>
                            </button>
                            <button class="flex flex-col items-center justify-center p-4 bg-green-50 hover:bg-green-100 rounded-lg transition duration-150">
                                <i data-lucide="credit-card" class="w-5 h-5 text-green-600 mb-1"></i>
                                <span class="text-xs font-medium text-green-700">Pay Fees</span>
                            </button>
                            <button class="flex flex-col items-center justify-center p-4 bg-red-50 hover:bg-red-100 rounded-lg transition duration-150">
                                <i data-lucide="file-text" class="w-5 h-5 text-red-600 mb-1"></i>
                                <span class="text-xs font-medium text-red-700">View Transcripts</span>
                            </button>
                            <button class="flex flex-col items-center justify-center p-4 bg-yellow-50 hover:bg-yellow-100 rounded-lg transition duration-150">
                                <i data-lucide="help-circle" class="w-5 h-5 text-yellow-600 mb-1"></i>
                                <span class="text-xs font-medium text-yellow-700">Support</span>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Initialize Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>