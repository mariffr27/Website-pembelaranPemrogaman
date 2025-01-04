<?php
// Memeriksa apakah parameter 'course' ada dalam URL
$course = isset($_GET['course']) ? $_GET['course'] : 'default';


// Memuat file JSON
$jsonData = file_get_contents('course.json');
$courses = json_decode($jsonData, true); // Mengonversi JSON menjadi array PHP

// Memeriksa apakah course yang diminta ada dalam array courses
$courseData = isset($courses[$course]) ? $courses[$course] : $courses['frontend']; // Default jika course tidak ditemukan
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Player</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f4f4f4;
        }
        .video-container {
            margin-bottom: 20px;
            width: 80%;
            max-width: 600px;
        }
        iframe {
            width: 100%;
            height: 340px;
            border: 2px solid #ccc;
            border-radius: 8px;
        }
        .buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }
        .button-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 15px;
            width: 200px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .button-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .button-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }
        .button-duration {
            font-size: 14px;
            color: #555;
        }

        

      
    </style>
</head>
<body>
    <div class="video-container">
        <iframe id="videoPlayer" src="https://www.youtube.com/embed/_swJQVGuauw?si=ZMoClbjMk4b03sF-" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>

    <div class="buttons" id="videoButtons"></div>

    <script> 

// Mendapatkan nilai 'course' dari PHP atau URL parameter jika ada
const course = "<?php echo $course; ?>"; // Dapatkan nilai kursus dari PHP

// Ambil data kursus dari file JSON
fetch('course.json')
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {
    // Pastikan kursus yang dipilih ada dalam data JSON
    if (data[course]) {
      const videoData = data[course].videoUrls;  // Ambil video berdasarkan kursus yang dipilih
      displayVideoData(videoData); // Tampilkan video sesuai data yang dipilih
    } else {
      console.error("Course not recognized:", course);
    }
  })
  .catch(error => {
    console.error('There was a problem with the fetch operation:', error);
  });

// Fungsi untuk menampilkan video berdasarkan data yang diambil
function displayVideoData(videoData) {
    const videoButtons = document.getElementById('videoButtons');
    const videoPlayer = document.getElementById('videoPlayer');

    // Hapus konten video yang ada sebelumnya
    videoButtons.innerHTML = '';

    // Iterasi untuk membuat tombol untuk setiap video
    videoData.forEach(video => {
        const buttonCard = document.createElement('div');
        buttonCard.className = 'button-card';
        buttonCard.innerHTML = `
            <div class="button-title">${video.title}</div>
            <div class="button-duration">${video.duration}</div>
        `;
        buttonCard.addEventListener('click', () => {
            // Ubah sumber video yang diputar saat tombol diklik
            videoPlayer.src = video.url;
        });
        videoButtons.appendChild(buttonCard);
    });
}

</script>

</body>
</html>
