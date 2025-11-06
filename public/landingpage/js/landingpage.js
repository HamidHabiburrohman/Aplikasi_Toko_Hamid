 document.addEventListener('DOMContentLoaded', () => {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-menu a');

            function updateActiveNavLink() {
                let currentSectionId = '';

                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    // Gunakan sedikit buffer untuk deteksi lebih akurat
                    const buffer = window.innerHeight * 0.3; // 30% tinggi viewport
                    if (window.scrollY >= sectionTop - buffer) {
                        currentSectionId = section.id;
                    }
                });

                // Hapus kelas 'active' dari semua tautan dan garis bawah
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    const underline = link.querySelector('.underline');
                    if (underline) {
                        underline.classList.remove('active');
                    }
                });

                // Tambahkan kelas 'active' ke tautan dan garis bawah yang sesuai
                if (currentSectionId) {
                    const activeLink = document.querySelector(`.nav-menu a[href="#${currentSectionId}"]`);
                    if (activeLink) {
                        activeLink.classList.add('active');
                        const underline = activeLink.querySelector('.underline');
                        if (underline) {
                            underline.classList.add('active');
                        }
                    }
                }
            }

            // Panggil fungsi saat halaman digulir dan saat halaman dimuat
            window.addEventListener('scroll', updateActiveNavLink);
            updateActiveNavLink();
        });

        const loginModal = document.getElementById('loginModal');
        const cartButtons = document.querySelectorAll('.cart-btn');
        const buyButtons = document.querySelectorAll('.buy-now-btn');
        const closeBtn = document.querySelector('.close-btn'); // Ini tidak dipakai lagi, tapi biarkan saja dulu
        const cancelBtn = document.querySelector('.modal-cancel-btn'); // Ambil tombol batal

        // Tambahkan event listener ke setiap tombol keranjang
        cartButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault(); // Mencegah navigasi default jika ada
                loginModal.classList.add('show');
            });
        });

        // Event listener untuk tombol Batal
        cancelBtn.addEventListener('click', function () {
            loginModal.classList.remove('show');
        });

        // Tutup modal jika mengklik di luar modal-content
        window.addEventListener('click', function (event) {
            if (event.target == loginModal) {
                loginModal.classList.remove('show');
            }
        });


        buyButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault(); // Mencegah navigasi default jika ada
                loginModal.classList.add('show');
            });
        });

        // Event listener untuk tombol Batal
        cancelBtn.addEventListener('click', function () {
            loginModal.classList.remove('show');
        });

        // Tutup modal jika mengklik di luar modal-content
        window.addEventListener('click', function (event) {
            if (event.target == loginModal) {
                loginModal.classList.remove('show');
            }
        });