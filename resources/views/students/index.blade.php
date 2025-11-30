<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Configure Tailwind to use Inter font and accent colors -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-accent': '#4f46e5', // Indigo-600
                        'secondary-accent': '#10b981', // Emerald-500
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        /* Custom scrollbar styling for a cleaner look */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-thumb {
            background-color: #d1d5db; /* gray-300 */
            border-radius: 10px;
        }
        ::-webkit-scrollbar-track {
            background-color: #f3f4f6; /* gray-100 */
        }
        /* Mobile specific style for the table to prevent horizontal overflow */
        .responsive-table-wrapper {
            overflow-x: auto;
        }
        /* Style for the custom file input button */
        .file-upload-label {
            @apply inline-flex items-center justify-center px-4 py-2 bg-gray-200 text-gray-700 font-medium text-sm rounded-lg shadow-sm cursor-pointer hover:bg-gray-300 transition duration-150 ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased min-h-screen p-4 md:p-8">

    <div id="app" class="max-w-7xl mx-auto space-y-12">
        <!-- Header -->
        <header class="pb-4 border-b border-gray-200">
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Students</h1>
        </header>

        <!-- Student Form Section -->
        <section class="bg-white p-6 md:p-8 rounded-xl shadow-2xl border border-gray-100 space-y-6">
            <h2 class="text-2xl font-semibold text-gray-800 border-b pb-4 mb-4" id="form-title">Add New Student</h2>

            <form id="student-form" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Hidden Input for Editing -->
                <input type="hidden" id="student-id" value="">

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
                    <input type="text" id="name" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-primary-accent focus:border-primary-accent transition duration-150">
                </div>

                <!-- Roll Number -->
                <div>
                    <label for="rollNumber" class="block text-sm font-medium text-gray-700 mb-1">Roll Number <span class="text-red-500">*</span></label>
                    <input type="text" id="rollNumber" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-primary-accent focus:border-primary-accent transition duration-150">
                </div>

                <!-- Class -->
                <div>
                    <label for="class" class="block text-sm font-medium text-gray-700 mb-1">Class</label>
                    <input type="text" id="class" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-primary-accent focus:border-primary-accent transition duration-150">
                </div>

                <!-- Age -->
                <div>
                    <label for="age" class="block text-sm font-medium text-gray-700 mb-1">Age</label>
                    <input type="number" id="age" min="5" max="99" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-primary-accent focus:border-primary-accent transition duration-150">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-primary-accent focus:border-primary-accent transition duration-150">
                </div>

                <!-- Profile Image Upload -->
                <div class="md:col-span-2 lg:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Profile Image</label>
                    <div class="flex items-center space-x-4">
                        <input type="file" id="profileImage" accept="image/*" class="hidden" onchange="previewImage()">
                        <label for="profileImage" class="file-upload-label">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            Upload Photo
                        </label>
                        <img id="image-preview" src="https://placehold.co/50x50/374151/FFFFFF?text=P" alt="Profile Preview" class="w-12 h-12 object-cover rounded-full border border-gray-300">
                    </div>
                    <p class="text-xs text-gray-500 mt-1">PNG, JPG, or GIF (Max 100KB recommended for fast saving)</p>
                </div>

                <!-- Action Buttons -->
                <div class="col-span-1 md:col-span-2 lg:col-span-3 flex justify-end space-x-4 pt-4 border-t border-gray-100">
                    <button type="submit" id="add-update-btn" class="px-6 py-3 bg-primary-accent text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 transition duration-150 ease-in-out transform hover:scale-[1.01]">
                        Add Student
                    </button>
                    <button type="button" onclick="resetForm()" class="px-6 py-3 bg-gray-500 text-white font-semibold rounded-lg shadow-md hover:bg-gray-600 transition duration-150 ease-in-out">
                        Reset
                    </button>
                </div>
            </form>
        </section>

        <!-- Search and Table Section -->
        <section class="space-y-6">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <h2 class="text-2xl font-semibold text-gray-800">Student Roster</h2>
                <!-- Search Bar -->
                <div class="relative w-full md:w-80">
                    <input type="text" id="search-input" onkeyup="searchStudents()" placeholder="Search by name or roll number..." class="w-full p-3 pl-10 border border-gray-300 rounded-lg focus:ring-secondary-accent focus:border-secondary-accent transition duration-150 shadow-sm">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>

            <!-- Student Table -->
            <div class="responsive-table-wrapper bg-white rounded-xl shadow-lg border border-gray-100">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tl-xl">Photo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Roll Number</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Class</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Age</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider rounded-tr-xl">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="students-table-body" class="bg-white divide-y divide-gray-200">
                        <!-- Student rows will be injected here by JavaScript -->
                    </tbody>
                </table>
                <div id="no-students" class="text-center p-8 text-gray-500 hidden">
                    No students found. Add a new student above!
                </div>
            </div>
        </section>

        <!-- Loading and Status Messages -->
        <div id="status-message" class="fixed bottom-4 right-4 bg-primary-accent text-white p-3 rounded-lg shadow-xl hidden transition-opacity duration-300"></div>

    </div>

    <script type="module">
        // Import Firebase modules
        import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
        import { getAuth, signInAnonymously, signInWithCustomToken, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";
        import { getFirestore, doc, addDoc, setDoc, deleteDoc, onSnapshot, collection, query, orderBy, setLogLevel } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

        // --- GLOBAL VARIABLES & FIREBASE INITIALIZATION ---
        // Ensure globals are defined or fallback to defaults
        const appId = typeof __app_id !== 'undefined' ? __app_id : 'default-app-id';
        const firebaseConfig = typeof __firebase_config !== 'undefined' ? JSON.parse(__firebase_config) : {};
        const initialAuthToken = typeof __initial_auth_token !== 'undefined' ? __initial_auth_token : null;

        let app, db, auth;
        let userId = null;
        let isAuthReady = false;
        let students = [];
        let editingId = null; // Stores the ID of the student currently being edited

        // DOM Elements
        const form = document.getElementById('student-form');
        const formTitle = document.getElementById('form-title');
        const addUpdateBtn = document.getElementById('add-update-btn');
        const studentsTableBody = document.getElementById('students-table-body');
        const searchInput = document.getElementById('search-input');
        const statusMessage = document.getElementById('status-message');
        const noStudentsMessage = document.getElementById('no-students');

        // --- UTILITY FUNCTIONS ---

        /**
         * Shows a temporary status message in the corner of the screen.
         * @param {string} message - The message to display.
         * @param {string} type - 'success' or 'error'.
         */
        function showStatus(message, type = 'success') {
            statusMessage.textContent = message;
            statusMessage.classList.remove('hidden', 'bg-red-500', 'bg-primary-accent');
            statusMessage.classList.add(type === 'error' ? 'bg-red-500' : 'bg-primary-accent', 'opacity-100');
            statusMessage.classList.remove('opacity-0');

            setTimeout(() => {
                statusMessage.classList.add('opacity-0');
                statusMessage.classList.remove('opacity-100');
                setTimeout(() => statusMessage.classList.add('hidden'), 300); // Hide after transition
            }, 3000);
        }

        /**
         * Converts a local file to a base64 string.
         * @param {File} file - The file object from the input.
         * @returns {Promise<string>} - Base64 string of the file.
         */
        function fileToBase64(file) {
            return new Promise((resolve, reject) => {
                if (!file) return resolve(null);
                // Simple size check: warn if image is too big for a Firestore document
                if (file.size > 100000) { // 100KB limit for warning
                    console.warn(`Image size is ${file.size} bytes. Storing large images (over 100KB) as base64 in Firestore documents is strongly discouraged as documents have a 1MB limit.`);
                }
                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = () => resolve(reader.result);
                reader.onerror = (error) => reject(error);
            });
        }

        /**
         * Previews the selected image in the form.
         */
        window.previewImage = function() {
            const fileInput = document.getElementById('profileImage');
            const imagePreview = document.getElementById('image-preview');
            const file = fileInput.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    imagePreview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.src = 'https://placehold.co/50x50/374151/FFFFFF?text=P'; // Default placeholder
            }
        }

        /**
         * Renders the student table based on the current search filter.
         */
        window.renderStudents = function() {
            const searchTerm = searchInput.value.toLowerCase();

            const filteredStudents = students.filter(student =>
                student.name.toLowerCase().includes(searchTerm) ||
                student.rollNumber.toLowerCase().includes(searchTerm)
            ).sort((a, b) => a.rollNumber.localeCompare(b.rollNumber)); // Sort by Roll Number

            studentsTableBody.innerHTML = '';

            if (filteredStudents.length === 0) {
                noStudentsMessage.classList.remove('hidden');
                return;
            } else {
                noStudentsMessage.classList.add('hidden');
            }

            filteredStudents.forEach(student => {
                const studentRow = document.createElement('tr');
                studentRow.className = 'hover:bg-indigo-50 transition duration-150 ease-in-out cursor-pointer';
                studentRow.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <img src="${student.photo || 'https://placehold.co/40x40/9ca3af/FFFFFF?text=P'}" 
                             alt="${student.name}'s Photo" 
                             class="w-10 h-10 rounded-full object-cover border border-gray-200">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${student.name}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${student.rollNumber}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${student.class || 'N/A'}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${student.age || 'N/A'}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 truncate max-w-xs">${student.email || 'N/A'}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                        <button onclick="event.stopPropagation(); editStudent('${student.id}')" 
                                class="text-primary-accent hover:text-indigo-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-accent p-1 rounded-md transition duration-150">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-7-3l2 2m-2-2l-4 4m6-6l-4 4"></path></svg>
                        </button>
                        <button onclick="event.stopPropagation(); deleteStudent('${student.id}')" 
                                class="text-red-600 hover:text-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 p-1 rounded-md transition duration-150">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </td>
                `;
                studentsTableBody.appendChild(studentRow);
            });
        }

        /**
         * Filters the students list based on search input and re-renders the table.
         */
        window.searchStudents = function() {
            renderStudents();
        }

        /**
         * Clears the form and resets the UI state to 'Add New Student'.
         */
        window.resetForm = function() {
            form.reset();
            editingId = null;
            document.getElementById('student-id').value = '';
            formTitle.textContent = 'Add New Student';
            addUpdateBtn.textContent = 'Add Student';
            addUpdateBtn.classList.replace('bg-secondary-accent', 'bg-primary-accent');
            document.getElementById('image-preview').src = 'https://placehold.co/50x50/374151/FFFFFF?text=P';
            // Clear the file input explicitly
            document.getElementById('profileImage').value = null;
        }

        /**
         * Populates the form with a student's data for editing.
         * @param {string} id - The Firestore document ID of the student.
         */
        window.editStudent = function(id) {
            const student = students.find(s => s.id === id);
            if (!student) return showStatus('Student not found.', 'error');

            editingId = id;
            document.getElementById('student-id').value = id;
            document.getElementById('name').value = student.name || '';
            document.getElementById('rollNumber').value = student.rollNumber || '';
            document.getElementById('class').value = student.class || '';
            document.getElementById('age').value = student.age || '';
            document.getElementById('email').value = student.email || '';
            document.getElementById('image-preview').src = student.photo || 'https://placehold.co/50x50/374151/FFFFFF?text=P';
            document.getElementById('profileImage').value = null; // Clear file input on edit

            formTitle.textContent = 'Edit Student: ' + student.name;
            addUpdateBtn.textContent = 'Update Student';
            addUpdateBtn.classList.replace('bg-primary-accent', 'bg-secondary-accent');

            // Scroll to the top of the form
            document.getElementById('form-title').scrollIntoView({ behavior: 'smooth' });
        }

        /**
         * Deletes a student document from Firestore.
         * @param {string} id - The Firestore document ID of the student to delete.
         */
        window.deleteStudent = async function(id) {
            if (!userId) {
                return showStatus('Authentication not ready. Cannot delete.', 'error');
            }

            // Custom confirmation dialog replacement
            const confirmed = window.confirm(`Are you sure you want to delete this student (ID: ${id})?`);
            if (!confirmed) return;

            try {
                const studentDocRef = doc(db, `artifacts/${appId}/public/data/students`, id);
                await deleteDoc(studentDocRef);
                showStatus('Student record deleted successfully.', 'success');
                // Data will refresh automatically via onSnapshot
            } catch (error) {
                console.error('Error deleting document: ', error);
                showStatus('Failed to delete student.', 'error');
            }
        }

        /**
         * Handles form submission to add or update a student.
         * @param {Event} e - The form submit event.
         */
        async function handleSubmit(e) {
            e.preventDefault();

            if (!userId) {
                return showStatus('Authentication not ready. Cannot save data.', 'error');
            }

            const name = document.getElementById('name').value.trim();
            const rollNumber = document.getElementById('rollNumber').value.trim();
            const classVal = document.getElementById('class').value.trim();
            const age = document.getElementById('age').value.trim();
            const email = document.getElementById('email').value.trim();
            const imageFile = document.getElementById('profileImage').files[0];
            const existingId = document.getElementById('student-id').value;

            if (!name || !rollNumber) {
                return showStatus('Name and Roll Number are required.', 'error');
            }

            let photoBase64 = existingId ? students.find(s => s.id === existingId)?.photo : null;

            if (imageFile) {
                try {
                    // Convert new image file to base64
                    photoBase64 = await fileToBase64(imageFile);
                } catch (error) {
                    console.error("Image conversion failed:", error);
                    return showStatus('Failed to process image file.', 'error');
                }
            }

            const studentData = {
                name: name,
                rollNumber: rollNumber,
                class: classVal,
                age: age ? parseInt(age) : null,
                email: email,
                photo: photoBase64,
                updatedAt: new Date().toISOString(),
                // Add userId for security rules although it's public data
                createdBy: userId,
            };

            try {
                if (existingId) {
                    // UPDATE
                    const studentDocRef = doc(db, `artifacts/${appId}/public/data/students`, existingId);
                    await setDoc(studentDocRef, studentData, { merge: true });
                    showStatus(`Student ${name} updated successfully.`, 'success');
                } else {
                    // ADD
                    const studentCollectionRef = collection(db, `artifacts/${appId}/public/data/students`);
                    await addDoc(studentCollectionRef, {
                        ...studentData,
                        createdAt: new Date().toISOString(),
                    });
                    showStatus(`New student ${name} added successfully.`, 'success');
                }
                resetForm();
            } catch (error) {
                console.error('Firestore operation failed:', error);
                showStatus(`Failed to save student: ${error.message}`, 'error');
            }
        }

        // --- FIREBASE INITIALIZATION & AUTHENTICATION ---

        /**
         * Initializes Firebase app and sets up authentication.
         */
        async function authInitialization() {
            try {
                setLogLevel('error'); // Only show error logs for cleaner console
                app = initializeApp(firebaseConfig);
                db = getFirestore(app);
                auth = getAuth(app);

                // Check for custom token, otherwise sign in anonymously
                if (initialAuthToken) {
                    await signInWithCustomToken(auth, initialAuthToken);
                } else {
                    await signInAnonymously(auth);
                }

                // Listen for authentication state changes
                onAuthStateChanged(auth, (user) => {
                    if (user) {
                        userId = user.uid;
                        isAuthReady = true;
                        console.log("Authenticated with User ID:", userId);
                        // Once authenticated, start the data listener
                        firestoreListener();
                    } else {
                        userId = null;
                        isAuthReady = true;
                        console.log("Signed out or using anonymous session.");
                        // Even if anonymous, we set isAuthReady to true to start fetching public data
                        firestoreListener();
                    }
                });

                form.addEventListener('submit', handleSubmit);
            } catch (error) {
                console.error('Firebase initialization error:', error);
                showStatus(`Initialization failed: ${error.message}`, 'error');
            }
        }

        /**
         * Sets up the real-time listener for the students collection.
         */
        function firestoreListener() {
            if (!isAuthReady) {
                console.log('Waiting for authentication to complete before setting up Firestore listener...');
                return;
            }

            try {
                // Public data path
                const studentsColRef = collection(db, `artifacts/${appId}/public/data/students`);

                // Create a query to order by name (optional but good practice)
                // Note: orderBy is commented out as it often requires indexes in a real app,
                // and we're relying on client-side sorting for simplicity here.
                const studentQuery = query(studentsColRef); //, orderBy('name', 'asc'));

                onSnapshot(studentQuery, (snapshot) => {
                    students = [];
                    snapshot.forEach((doc) => {
                        students.push({
                            id: doc.id,
                            ...doc.data()
                        });
                    });
                    console.log(`Fetched ${students.length} student records.`);
                    renderStudents();
                }, (error) => {
                    console.error('Firestore snapshot listener error:', error);
                    showStatus('Failed to load student data.', 'error');
                });
            } catch (error) {
                console.error('Error setting up Firestore listener:', error);
                showStatus('Error connecting to database.', 'error');
            }
        }

        // Start the application initialization
        authInitialization();

    </script>
</body>
</html>