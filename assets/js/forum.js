// Function to open a discussion
function openDiscussion(discussionId) {
    alert(`Navigating to discussion: ${discussionId}`);
    // Implement navigation logic here, e.g., load a specific discussion page
    // window.location.href = `discussion.php?id=${discussionId}`;
}

// Fungsi untuk memuat data JSON
async function loadForums() {
    try {
        const response = await fetch('forum.json'); // Memuat file JSON
        const forums = await response.json();

        // Dapatkan elemen target untuk daftar forum
        const forumList = document.getElementById('forum-list');

        // Iterasi melalui data JSON dan buat elemen untuk setiap diskusi
        forums.forEach(forum => {
            const forumItem = document.createElement('div');
            forumItem.classList.add('forum-item');
            forumItem.setAttribute('onclick', `openDiscussion('${forum.id}')`);

            forumItem.innerHTML = `
                <div class="forum-icon">
                    <i class="${forum.icon}"></i>
                </div>
                <div class="forum-content">
                    <h3>${forum.title}</h3>
                    <p>Diskusi dimulai oleh <strong>${forum.author}</strong></p>
                    <span class="forum-meta">📅 ${forum.date} | 💬 ${forum.comments} Komentar</span>
                </div>
            `;

            // Tambahkan elemen ke dalam daftar
            forumList.appendChild(forumItem);
        });
        window.forumsData = forums;
    } catch (error) {
        console.error('Error loading forum data:', error);
    }
}

// Fungsi untuk membuka diskusi (Placeholder)
// Simpan data komentar secara lokal (menggunakan localStorage untuk persistensi sementara)
let commentsData = {};

// Fungsi untuk membuka popup dengan data diskusi
function openDiscussion(discussionId) {
    const forum = window.forumsData.find(f => f.id === discussionId);

    if (forum) {
        // Tampilkan detail forum
        const popupDetails = document.getElementById('popup-details');
        popupDetails.innerHTML = `
            <h3>${forum.title}</h3>
            <p><strong>Dimulai oleh:</strong> ${forum.author}</p>
            <p><strong>Tanggal:</strong> ${forum.date}</p>
            <p><strong>Jumlah Komentar:</strong> ${forum.comments}</p>
            <p>${forum.content}</p>
        `;

        // Muat komentar
        loadComments(discussionId);

        // Tampilkan popup
        const popupOverlay = document.getElementById('forum-popup');
        popupOverlay.style.display = 'flex';

        // Simpan ID diskusi aktif untuk komentar
        window.activeDiscussionId = discussionId;
    }
}

// Fungsi untuk menutup popup
function closePopup() {
    const popupOverlay = document.getElementById('forum-popup');
    popupOverlay.style.display = 'none';
}

// Fungsi untuk memuat komentar
function loadComments(discussionId) {
    const commentsList = document.getElementById('comments-list');
    commentsList.innerHTML = ''; // Kosongkan daftar komentar

    // Ambil komentar dari data lokal
    const comments = commentsData[discussionId] || [];

    if (comments.length === 0) {
        commentsList.innerHTML = '<p>Belum ada komentar. Jadilah yang pertama!</p>';
        return;
    }

    // Tampilkan komentar
    comments.forEach(comment => {
        const commentItem = document.createElement('div');
        commentItem.classList.add('comment-item');
        commentItem.innerHTML = `
            <span class="comment-author">${comment.author}</span>
            <p class="comment-content">${comment.content}</p>
        `;
        commentsList.appendChild(commentItem);
    });
}

// Fungsi untuk menambahkan komentar
function addComment(event) {
    event.preventDefault(); // Mencegah refresh halaman

    const commentInput = document.getElementById('comment-input');
    const commentContent = commentInput.value.trim();
    if (!commentContent) return;

    const discussionId = window.activeDiscussionId;

    // Simpan komentar baru
    if (!commentsData[discussionId]) {
        commentsData[discussionId] = [];
    }

    commentsData[discussionId].push({
        author: 'Anonim', // Anda bisa mengganti ini dengan nama pengguna sebenarnya
        content: commentContent
    });

    // Perbarui tampilan komentar
    loadComments(discussionId);

    // Kosongkan input komentar
    commentInput.value = '';
}




// Panggil fungsi loadForums saat halaman dimuat
document.addEventListener('DOMContentLoaded', loadForums);
