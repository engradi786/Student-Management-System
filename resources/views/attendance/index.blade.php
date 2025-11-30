<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance - Student Management System</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Configure Tailwind for Inter font and custom colors -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#4f46e5', // Indigo 600
                        'primary-light': '#6366f1', // Indigo 500
                        'background-light': '#f9fafb', // Gray 50
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    boxShadow: {
                        'subtle': '0 1px 3px rgba(0, 0, 0, 0.05)',
                        'medium': '0 4px 6px rgba(0, 0, 0, 0.08)',
                    }
                }
            }
        }
    </script>
    <style>
        /* Apply Inter font globally and ensure clean padding/margin */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; /* Gray 100 for overall body background */
        }
        /* Custom styles for the radio buttons to look like toggle buttons */
        .attendance-radio-group input[type="radio"] {
            display: none;
        }
        .attendance-radio-group label {
            display: inline-block;
            padding: 0.5rem 0.75rem;
            border-radius: 9999px; /* Full rounded pill shape */
            cursor: pointer;
            transition: all 0.2s;
            font-size: 0.875rem; /* sm text */
            font-weight: 500;
            text-align: center;
            min-width: 50px;
        }

        /* Default state */
        .attendance-radio-group label {
            background-color: #e5e7eb; /* Gray 200 */
            color: #4b5563; /* Gray 600 */
        }

        /* Present - Selected */
        #status-P:checked + label { background-color: #10b981; color: white; box-shadow: 0 1px 2px rgba(16, 185, 129, 0.4); } /* Emerald 500 */
        /* Absent - Selected */
        #status-A:checked + label { background-color: #ef4444; color: white; box-shadow: 0 1px 2px rgba(239, 68, 68, 0.4); } /* Red 500 */
        /* Late - Selected */
        #status-L:checked + label { background-color: #f59e0b; color: white; box-shadow: 0 1px 2px rgba(245, 158, 11, 0.4); } /* Amber 500 */
        /* Excused - Selected */
        #status-E:checked + label { background-color: #3b82f6; color: white; box-shadow: 0 1px 2px rgba(59, 130, 246, 0.4); } /* Blue 500 */
        
        /* Hover effect */
        .attendance-radio-group label:hover {
            opacity: 0.8;
        }

        /* Adjusting layout for small screens */
        @media (max-width: 640px) {
            .attendance-radio-group {
                display: flex;
                flex-wrap: wrap;
                gap: 0.25rem;
                justify-content: center;
            }
            .attendance-radio-group label {
                padding: 0.4rem 0.6rem;
                font-size: 0.75rem; /* xs text */
                min-width: 40px;
            }
        }
    </style>
</head>
<body class="min-h-screen p-4 sm:p-6 md:p-8">

    <div class="max-w-7xl mx-auto bg-white p-6 md:p-8 shadow-medium rounded-xl">
        
        <!-- Header -->
        <header class="mb-8 border-b border-gray-200 pb-4">
            <h1 class="text-3xl font-extrabold text-gray-800">Attendance</h1>
        </header>

        <!-- Controls Section: Date Picker and Search Bar -->
        <div class="flex flex-col md:flex-row gap-4 mb-6 items-center">
            
            <!-- Date Picker -->
            <div class="w-full md:w-auto flex-shrink-0">
                <label for="attendance-date" class="block text-sm font-medium text-gray-700 mb-1">Select Attendance Date</label>
                <input type="date" id="attendance-date" value="2025-11-30" 
                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-subtle 
                              focus:ring-primary focus:border-primary p-2.5 transition duration-150 ease-in-out">
            </div>

            <!-- Search Bar -->
            <div class="w-full md:flex-1">
                <label for="student-search" class="block text-sm font-medium text-gray-700 mb-1">Search Student (Name or Roll No.)</label>
                <input type="text" id="student-search" placeholder="Enter name or roll number..."
                       onkeyup="filterStudents()"
                       class="mt-1 block w-full rounded-lg border-gray-300 shadow-subtle 
                              focus:ring-primary focus:border-primary p-2.5 transition duration-150 ease-in-out">
            </div>
        </div>

        <!-- Attendance Table Section -->
        <div class="overflow-x-auto rounded-lg shadow-subtle border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-700 sm:pl-6">
                            Photo
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-700">
                            Name
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-700 hidden sm:table-cell">
                            Roll No.
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-700 hidden lg:table-cell">
                            Class
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-700 w-60">
                            Attendance Status
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white" id="attendance-table-body">
                    <!-- Student rows will be injected here by JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Save Button -->
        <div class="mt-8 flex justify-end">
            <button onclick="saveAttendance()"
                    class="px-8 py-3 bg-primary hover:bg-primary-light text-white font-semibold rounded-lg shadow-medium 
                           transition duration-300 ease-in-out transform hover:scale-[1.01] focus:outline-none focus:ring-4 focus:ring-primary-light/50">
                Save Attendance (12 Students)
            </button>
        </div>
        
    </div>

    <!-- Message Box for Save/Error Feedback -->
    <div id="message-box" class="fixed bottom-4 right-4 p-4 rounded-lg text-white font-medium shadow-xl hidden transition-opacity duration-300"></div>


    <script>
        // --- Mock Student Data ---
        const students = [
            { id: 101, photo: 'https://placehold.co/40x40/94a3b8/ffffff?text=AD', name: 'Alice Davis', rollNo: 'S001', class: '10A', status: 'P' },
            { id: 102, photo: 'https://placehold.co/40x40/f87171/ffffff?text=BJ', name: 'Bob Johnson', rollNo: 'S002', class: '10A', status: 'P' },
            { id: 103, photo: 'https://placehold.co/40x40/4ade80/ffffff?text=CC', name: 'Charlie Clark', rollNo: 'S003', class: '10A', status: 'A' },
            { id: 104, photo: 'https://placehold.co/40x40/60a5fa/ffffff?text=DN', name: 'Dana Nichols', rollNo: 'S004', class: '10A', status: 'L' },
            { id: 105, photo: 'https://placehold.co/40x40/c084fc/ffffff?text=ES', name: 'Emily Scott', rollNo: 'S005', class: '10A', status: 'E' },
            { id: 106, photo: 'https://placehold.co/40x40/fb923c/ffffff?text=FG', name: 'Frank Green', rollNo: 'S006', class: '10B', status: 'P' },
            { id: 107, photo: 'https://placehold.co/40x40/475569/ffffff?text=HA', name: 'Hannah Allen', rollNo: 'S007', class: '10B', status: 'P' },
            { id: 108, photo: 'https://placehold.co/40x40/34d399/ffffff?text=IL', name: 'Ian Lewis', rollNo: 'S008', class: '10B', status: 'P' },
            { id: 109, photo: 'https://placehold.co/40x40/a78bfa/ffffff?text=JS', name: 'Julia Smith', rollNo: 'S009', class: '10B', status: 'A' },
            { id: 110, photo: 'https://placehold.co/40x40/f472b6/ffffff?text=KM', name: 'Kevin Miller', rollNo: 'S010', class: '11A', status: 'L' },
            { id: 111, photo: 'https://placehold.co/40x40/9ca3af/ffffff?text=LG', name: 'Laura Garcia', rollNo: 'S011', class: '11A', status: 'P' },
            { id: 112, photo: 'https://placehold.co/40x40/1e40af/ffffff?text=MZ', name: 'Mark Zukos', rollNo: 'S012', class: '11A', status: 'P' },
        ];

        // Map status codes to colors for row highlight
        const statusColors = {
            'P': 'hover:bg-emerald-50/50', // Present - Green
            'A': 'hover:bg-red-50/50',     // Absent - Red
            'L': 'hover:bg-amber-50/50',   // Late - Yellow
            'E': 'hover:bg-blue-50/50'     // Excused - Blue
        };

        // --- Core Functions ---

        /**
         * Renders the student list to the table body.
         * @param {Array<Object>} list The list of students to render.
         */
        function renderStudents(list) {
            const tbody = document.getElementById('attendance-table-body');
            tbody.innerHTML = ''; // Clear existing rows

            list.forEach(student => {
                const row = document.createElement('tr');
                // Subtle hover effect with background color based on current status
                const hoverClass = statusColors[student.status] || 'hover:bg-gray-50';
                row.className = `transition-colors duration-150 ${hoverClass}`;
                row.dataset.studentId = student.id;

                row.innerHTML = `
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                        <div class="flex items-center">
                            <img class="h-10 w-10 rounded-full object-cover" src="${student.photo}" alt="${student.name[0]} Photo" onerror="this.onerror=null;this.src='https://placehold.co/40x40/cccccc/333333?text=${student.name.split(' ').map(n=>n[0]).join('')}'">
                            <div class="ml-4 flex-grow sm:hidden">
                                <div class="font-medium text-gray-900">${student.name}</div>
                                <div class="text-gray-500">Roll: ${student.rollNo}</div>
                            </div>
                        </div>
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900 hidden sm:table-cell">
                        ${student.name}
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 hidden sm:table-cell">
                        ${student.rollNo}
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 hidden lg:table-cell">
                        ${student.class}
                    </td>
                    <td class="py-4 px-3 text-sm text-gray-500 text-center">
                        <div class="attendance-radio-group flex justify-center space-x-1.5" onchange="updateRowStatus(${student.id}, event)">
                            <!-- Present -->
                            <input type="radio" id="status-P-${student.id}" name="attendance-status-${student.id}" value="P" ${student.status === 'P' ? 'checked' : ''} class="hidden">
                            <label for="status-P-${student.id}" id="status-P" class="bg-emerald-100/70 text-emerald-800 hover:bg-emerald-200">Present</label>
                            
                            <!-- Absent -->
                            <input type="radio" id="status-A-${student.id}" name="attendance-status-${student.id}" value="A" ${student.status === 'A' ? 'checked' : ''} class="hidden">
                            <label for="status-A-${student.id}" id="status-A" class="bg-red-100/70 text-red-800 hover:bg-red-200">Absent</label>
                            
                            <!-- Late -->
                            <input type="radio" id="status-L-${student.id}" name="attendance-status-${student.id}" value="L" ${student.status === 'L' ? 'checked' : ''} class="hidden">
                            <label for="status-L-${student.id}" id="status-L" class="bg-amber-100/70 text-amber-800 hover:bg-amber-200">Late</label>
                            
                            <!-- Excused -->
                            <input type="radio" id="status-E-${student.id}" name="attendance-status-${student.id}" value="E" ${student.status === 'E' ? 'checked' : ''} class="hidden">
                            <label for="status-E-${student.id}" id="status-E" class="bg-blue-100/70 text-blue-800 hover:bg-blue-200">Excused</label>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);
            });
            // Update the save button count
            document.querySelector('.mt-8 button').textContent = `Save Attendance (${list.length} Students)`;
        }

        /**
         * Updates the student's status in the local data and updates the row's hover class.
         * @param {number} studentId ID of the student.
         * @param {Event} event The change event from the radio group.
         */
        function updateRowStatus(studentId, event) {
            const newStatus = event.target.value;
            const studentIndex = students.findIndex(s => s.id === studentId);
            
            if (studentIndex !== -1) {
                // Update the student object in the mock data
                students[studentIndex].status = newStatus;
                
                // Get the table row element
                const row = document.querySelector(`[data-student-id="${studentId}"]`);
                if (row) {
                    // Remove all existing hover classes and apply the new one
                    Object.values(statusColors).forEach(c => row.classList.remove(c));
                    const newHoverClass = statusColors[newStatus] || 'hover:bg-gray-50';
                    row.classList.add(newHoverClass);
                }
            }
        }

        /**
         * Filters the student list based on search input.
         */
        function filterStudents() {
            const searchValue = document.getElementById('student-search').value.toLowerCase();
            const filteredList = students.filter(student => 
                student.name.toLowerCase().includes(searchValue) || 
                student.rollNo.toLowerCase().includes(searchValue)
            );
            renderStudents(filteredList);
        }

        /**
         * Placeholder function to simulate saving attendance data.
         */
        function saveAttendance() {
            // In a real app, this is where you'd collect the data from the 'students' array
            // or directly from the form inputs and send it to a backend API/Firestore.
            
            const attendanceDate = document.getElementById('attendance-date').value;
            const attendanceRecords = students.map(s => ({
                id: s.id,
                name: s.name,
                status: s.status
            }));
            
            console.log("--- Saving Attendance Records ---");
            console.log("Date:", attendanceDate);
            console.log("Records:", attendanceRecords);
            
            // Show success message
            showNotification('Attendance records saved successfully!', 'success');
        }

        /**
         * Displays a temporary notification message.
         * @param {string} message The message to display.
         * @param {string} type 'success' or 'error'.
         */
        function showNotification(message, type) {
            const box = document.getElementById('message-box');
            box.textContent = message;
            box.classList.remove('hidden', 'bg-emerald-600', 'bg-red-600');
            box.classList.add(type === 'success' ? 'bg-emerald-600' : 'bg-red-600');
            box.style.opacity = '1';

            setTimeout(() => {
                box.style.opacity = '0';
                setTimeout(() => box.classList.add('hidden'), 300);
            }, 3000);
        }

        // --- Initialization ---

        window.onload = () => {
            // Set today's date in the date picker on load
            document.getElementById('attendance-date').valueAsDate = new Date();
            renderStudents(students);
        };
    </script>

</body>
</html>