<?php
$file = '../data.json';
if (!file_exists($file)) {
    echo json_encode(['error' => 'Data file not found']);
    exit;
}

$data = json_decode(file_get_contents($file), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menambah pengguna baru
    $new_user = json_decode(file_get_contents('php://input'), true);
    if ($new_user) {
        $data[] = $new_user;
        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
        echo json_encode(['message' => 'User added successfully']);
    } else {
        echo json_encode(['error' => 'Invalid user data']);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/dashboard-admin.css">
</head>
<body>
    <div class="dashboard">
        <header>
            <h1>Admin Dashboard</h1>
        </header>
        <nav>
            <ul>
                <li><a href="#" id="view-users">View Users</a></li>
                <li><a href="#" id="edit-users">Edit Users</a></li>
                <li><a href="#" id="view-courses">View Courses</a></li>
                <li><a href="#" id="edit-courses">Edit Courses</a></li>
                <li><a href="../Index.php">Website</a></li>
            </ul>
        </nav>
        <main>
            <div id="content"></div>
        </main>
        <!-- Edit Course Form --><div id="edit-course-form" style="display: none;">
    <h3>Edit Course</h3>
    <input type="hidden" id="edit-course-id">
    <label>Title:</label>
    <input type="text" id="edit-title"><br><br>
    <label>Description:</label>
    <textarea id="edit-description"></textarea><br><br>
    <label>Materi:</label>
    <input type="text" id="edit-materi"><br><br>
    <label>Materi Video:</label>
    <input type="text" id="edit-materiVideo"><br><br>
    <label>Image URL:</label>
    <input type="text" id="edit-image"><br><br>
    <label>Enroll Link:</label>
    <input type="text" id="edit-link"><br><br>
    <label>Video Tutorials:</label>
    <textarea id="edit-videoUrls"></textarea><br><br>
    <button onclick="saveEditedCourse()">Save</button>
    <button onclick="cancelEditCourse()">Cancel</button>
</div>

<button onclick="showForm()">Tampilkan Form</button>
<div id="add-course-form">
    <form id="courseForm" onsubmit="event.preventDefault(); addCourse();" style="display: none;">
        <label for="add-course-id">Course ID:</label>
        <input type="text" id="add-course-id" placeholder="Enter Course ID" required>

        <label for="add-title">Title:</label>
        <input type="text" id="add-title" placeholder="Enter Title" required>

        <label for="add-description">Description:</label>
        <textarea id="add-description" placeholder="Enter Description"></textarea>

        <label for="add-materi">Materi:</label>
        <input type="text" id="add-materi" placeholder="Enter Materi">

        <label for="add-materiVideo">Materi Video:</label>
        <input type="text" id="add-materiVideo" placeholder="Enter Materi Video">

        <label for="add-image">Image URL:</label>
        <input type="text" id="add-image" placeholder="Enter Image URL">

        <label for="add-link">Link:</label>
        <input type="text" id="add-link" placeholder="Enter Link">

        <label for="add-videoUrls">Video URLs (Format: Title|URL|Duration per line):</label>
        <textarea id="add-videoUrls" placeholder="Title|URL|Duration\nExample:\nIntro|http://example.com|10 Min"></textarea>

        <button type="submit">Add Course</button>
        <button type="button" onclick="document.getElementById('add-course-form').style.display='none';">Cancel</button>
    </form>
</div>

    </div>

    

<script>
  

    // VIEW USER
    document.getElementById('view-users').addEventListener('click', function(event) {
    event.preventDefault(); // Mencegah perilaku default tautan

        // Fetch users and display them
        fetch('../data.json')
            .then(response => response.json())
            .then(users => {
                let userContent = '<h2>User List</h2>';
                userContent += `<table border="1">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Passowrd</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>`;

                // Loop through the users and display them in the table
                users.forEach(user => {
                    userContent += `
                        <tr>
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td>${user.password}</td>
                            <td>${user.role}</td>
                        </tr>
                    `;
                });

                userContent += `</tbody></table>`;

                // Display the content on the page
                document.getElementById('content').innerHTML = userContent;
            })
            .catch(error => {
                console.error('Error loading users:', error);
                document.getElementById('content').innerHTML = '<p class="error-message">Error loading users.</p>';
            });
    });

        // EDIT USER
        document.getElementById('edit-users').addEventListener('click', function(event) {
        event.preventDefault(); // Mencegah perilaku default tautan

        // Fetch users and display them
        fetch('users.php') // Ganti dengan path ke file PHP Anda
            .then(response => response.json())
            .then(users => {
                let userContent = '<h2>User List</h2>';
                userContent += `
                    <h3>Add User</h3>
                    <input type="text" id="new-name" placeholder="Name">
                    <input type="email" id="new-email" placeholder="Email">
                    <input type="password" id="new-password" placeholder="Password">
                    <input type="text" id="new-role" placeholder="Role">
                    <button id="add-user">Add User</button>
                    <br><br>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>`;

                // Loop through the users and display them in the table
                users.forEach((user, index) => {
                    userContent += `
                        <tr>
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td>${user.role}</td>
                            <td>
                                <button class="change-user" data-index="${index}">Change</button>
                                <button class="delete-user" data-index="${index}">Delete</button>
                            </td>
                        </tr>
                    `;
                });

                userContent += `</tbody></table>`;

                // Display the content on the page
                document.getElementById('content').innerHTML = userContent;

                // Event listener for Add User button
                document.getElementById('add-user').addEventListener('click', function() {
                    const newName = document.getElementById('new-name').value.trim();
                    const newEmail = document.getElementById('new-email').value.trim();
                    const newPassword = document.getElementById('new-password').value.trim();
                    const newRole = document.getElementById('new-role').value.trim();

                    if (newName && newEmail && newPassword && newRole) {
                        const newUser  = {
                            name: newName,
                            email: newEmail,
                            password: newPassword,
                            role: newRole
                        };

                        // Send new user to the server
                        fetch('users.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify(newUser ),
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response .json();
                        })
                        .then(data => {
                            console.log(data.message); // Log success message
                            document.getElementById('edit-users').click(); // Refresh the user list
                        })
                        .catch(error => {
                            console.error('Error adding user:', error);
                        });
                    } else {
                        alert('Please fill in all fields.');
                    }
                });

                // Event listener for Change button
                document.querySelectorAll('.change-user').forEach(button => {
                    button.addEventListener('click', function() {
                        const index = this.getAttribute('data-index');
                        const user = users[index];

                        // Prompt for new values
                        const newName = prompt('Edit Name:', user.name);
                        const newEmail = prompt('Edit Email:', user.email);
                        const newPassword = prompt('Edit Password:', user.password);
                        const newRole = prompt('Edit Role:', user.role);

                        // Update user if values are provided
                        if (newName && newEmail && newRole) {
                            users[index] = { ...user, name: newName, email: newEmail, password: newPassword, role: newRole };

                            // Send updated users to the server
                            fetch('users.php', {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify(users),
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log(data.message); // Log success message
                                document.getElementById('edit-users').click(); // Refresh the user list
                            })
                            .catch(error => {
                                console.error('Error updating users:', error);
                            });
                        }
                    });
                });

                // Event listener for Delete button
                document.querySelectorAll('.delete-user').forEach(button => {
                    button.addEventListener('click', function() {
                        const index = this.getAttribute('data-index');
                        users.splice(index, 1); // Remove user from the array

                        // Send updated users to the server
                        fetch('users.php', {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify(users),
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log(data.message); // Log success message
                            document.getElementById('edit-users').click(); // Refresh the user list
                        })
                        .catch(error => {
                            console.error('Error deleting user:', error);
                        });
                    });
                });
            })
            .catch(error => {
                console.error('Error fetching users:', error);
            });
    });


// VIEW COURSE
// Fetching course data from course.json and displaying it
document.getElementById('view-courses').addEventListener('click', function(event) {
    event.preventDefault(); 

    // Fetching course data from course.json and displaying it
    fetch('../?POST?course.json')
        .then(response => response.json())
        .then(data => {
            let courseContent = `
                <table border="1" cellspacing="0" cellpadding="10">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Materi</th>
                            <th>Materi Video</th>
                            <th>Image</th>
                            <th>Enroll Link</th>
                            <th>Video Tutorials</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            for (const key in data) {
                const course = data[key]; // Accessing each course data
                const videoLinks = course.videoUrls.map(video => `${video.title} (${video.duration})`).join(', ');

                // Adding table rows with course data
                courseContent += `
                    <tr>
                        <td>${course.title}</td>
                        <td>${course.description}</td>
                        <td>${course.materi}</td>
                        <td>${course.materiVideo}</td>
                        <td><img src="${course.image}" style="max-width: 100px;" alt="${course.title}"></td>
                        <td><a href="${course.link}" target="_blank">Enroll</a></td>
                        <td>${videoLinks}</td>
                    </tr>
                `;
            }

            courseContent += '</tbody></table>';
            document.getElementById('content').innerHTML = courseContent; // Displaying the course content
        })
        .catch(error => {
            console.error('Error fetching course data:', error);
            document.getElementById('content').innerHTML = '<p class="error-message">Error loading course data.</p>';
        });
});


// EDIT Course
document.getElementById('edit-courses').addEventListener('click', function(event) {
    event.preventDefault(); 

    // Fetching course data from course.json and displaying it
    fetch('../course.json')
        .then(response => response.json())
        .then(data => {
            let courseContent = `
                <table border="1" cellspacing="0" cellpadding="10">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Materi</th>
                            <th>Materi Video</th>
                            <th>Image</th>
                            <th>Enroll Link</th>
                            <th>Video Tutorials</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            for (const key in data) {
                const course = data[key]; // Accessing each course data
                const videoLinks = course.videoUrls.map(video => `${video.title} (${video.duration})`).join(', ');

                // Adding table rows with course data
                courseContent += `
                    <tr id="course-${key}">
                        <td>${course.title}</td>
                        <td>${course.description}</td>
                        <td>${course.materi}</td>
                        <td>${course.materiVideo}</td>
                        <td><img src="${course.image}" style="max-width: 100px;" alt="${course.title}"></td>
                        <td><a href="${course.link}" target="_blank">Enroll</a></td>
                        <td>${videoLinks}</td>
                        <td>
                            <button class="edit-btn" onclick="editCourse('${key}')">Edit</button>
                            <button  class="delete-btn" onclick="deleteCourse('${key}')">Delete</button>
                        </td>
                    </tr>
                `;
            }

            courseContent += '</tbody></table>';
            document.getElementById('content').innerHTML = courseContent; // Displaying the course content
        })
        .catch(error => {
            console.error('Error fetching course data:', error);
            document.getElementById('content').innerHTML = '<p class="error-message">Error loading course data.</p>';
        });
});

// Function to handle course editing
function editCourse(courseId) {
    fetch('../course.json')
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            const course = data[courseId]; // Cari kursus berdasarkan courseId
            if (!course) throw new Error(`Course with ID ${courseId} not found`);

            // Mengisi formulir dengan data kursus
            document.getElementById('edit-title').value = course.title;
            document.getElementById('edit-description').value = course.description;
            document.getElementById('edit-materi').value = course.materi;
            document.getElementById('edit-materiVideo').value = course.materiVideo;
            document.getElementById('edit-image').value = course.image;
            document.getElementById('edit-link').value = course.link;
            document.getElementById('edit-videoUrls').value = course.videoUrls
                .map(video => `${video.title}|${video.duration}`)
                .join('\n');

            // Tampilkan formulir edit
            document.getElementById('edit-course-form').style.display = 'block';
            document.getElementById('edit-course-id').value = courseId; // Simpan ID kursus
        })
        .catch(error => console.error('Error editing course:', error));
}

function saveEditedCourse() {
    const courseId = document.getElementById('edit-course-id').value; // Ambil ID kursus
    const updatedCourse = {
        title: document.getElementById('edit-title').value,
        description: document.getElementById('edit-description').value,
        materi: document.getElementById('edit-materi').value,
        materiVideo: document.getElementById('edit-materiVideo').value,
        image: document.getElementById('edit-image').value,
        link: document.getElementById('edit-link').value,
        
        videoUrls: document.getElementById('edit-videoUrls').value.split('\n').map(video => {
            const [title, duration] = video.split('|');
            return { title: title.trim(), duration: duration.trim() };
        })
    };

    // Kirim ke backend menggunakan API PHP
    fetch('course.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ courseId, updatedCourse })
    })
        .then(response => {
            if (response.ok) {
                alert('Course updated successfully!');
                document.getElementById('edit-course-form').style.display = 'none';
                document.getElementById('edit-courses').click(); // Refresh daftar kursus
            } else {
                throw new Error('Failed to update course');
            }
        })
        .catch(error => console.error('Error saving course:', error));
}

function cancelEditCourse() {
    document.getElementById('edit-course-form').style.display = 'none';
}



// Function to handle course deletion
function deleteCourse(courseId) {
    if (!confirm(`Are you sure you want to delete course "${courseId}"?`)) {
        return; // User canceled the deletion
    }

    fetch('course.php', {
        method: 'DELETE',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ courseId }) // Kirim ID kursus yang akan dihapus
    })
        .then(response => {
            if (response.ok) {
                alert('Course deleted successfully!');
                document.getElementById(`course-${courseId}`).remove(); // Hapus baris kursus dari tabel
            } else {
                throw new Error('Failed to delete course');
            }
        })
        .catch(error => console.error('Error deleting course:', error));


    }

    // ADD DATA COURSE
    function showForm() {
    const form = document.getElementById('courseForm');
    if (form) {
      form.style.display = 'block';
    } else {
      console.error('Form dengan ID "courseForm" tidak ditemukan.');
    }
  }
  function addCourse() {
    const newCourseId = document.getElementById('add-course-id').value.trim();
    const newCourse = {
      title: document.getElementById('add-title').value.trim(),
      description: document.getElementById('add-description').value.trim(),
      materi: document.getElementById('add-materi').value.trim(),
      materiVideo: document.getElementById('add-materiVideo').value.trim(),
      image: document.getElementById('add-image').value.trim(),
      link: document.getElementById('add-link').value.trim(),
      
      videoUrls: document.getElementById('add-videoUrls').value.split('\n').map(video => {
  const videoParts = video.split('|');
  
  // Validasi bahwa videoParts memiliki 3 elemen yang valid
  if (videoParts.length === 3) {
    const [title, url, duration] = videoParts;
    return { 
      title: title ? title.trim() : '', 
      url: url ? url.trim() : '', 
      duration: duration ? duration.trim() : '' 
    };
  } else {
    // Jika format tidak sesuai, kita bisa mengembalikan objek kosong atau bisa menangani error
    console.warn(`Skipping invalid video URL format: ${video}`);
    return null;  // Atau bisa dikembalikan objek kosong atau error handler lainnya
  }
}).filter(video => video !== null) // Hapus video yang tidak valid

    };

    fetch('course.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ action: 'add', courseId: newCourseId, courseData: newCourse })
    })
      .then(response => response.json())
      .then(data => {
        if (data.message === 'Course added successfully') {
          alert('Course added successfully!');
          location.reload(); // Muat ulang untuk menampilkan data baru
        } else {
          alert(`Failed to add course: ${data.message}`);
        }
      })
      .catch(error => console.error('Error adding course:', error));
  }



</script>



</body>
</html>
