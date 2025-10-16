<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#070707">
    <title>Tokoku - Shop Anytime Anywhere</title>
    <link rel="shortcut icon" href="{{ asset('admin/images/brand_icons/bitmap.jpg')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
</head>

<body>
    <header class="header">
        <nav class="nav-container">
            <div class="logo-container">
                <span class="logo-text">Toko Drwya</span>
            </div>
            <ul class="nav-menu">
                <li><a href="#home">Home<span class="underline"></span></a></li>
                <li><a href="#products">Products<span class="underline"></span></a></li>
                <li><a href="#about">About<span class="underline"></span></a></li>
                <li><a href="#contact">Contact<span class="underline"></span></a></li>
            </ul>
            <a class="sign-in-btn" href="{{ route('signin') }}">Sign in</a>
        </nav>
    </header>

    <section id="home" class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <span class="badge">
                    <span class="badge-dot"></span>
                    New features available
                </span>
                <h1>Shop Anytime <br><span class="highlight">Anywhere</span></h1>
                <p>Experience seamless shopping with our innovative platform. Discover products, enjoy secure payments,
                    and get fast delivery.</p>
                <a class="get-started-btn" href="">Get Started Free <span
                        style="font-size: 1.25em;">→</span></a>
                <div class="user-count">
                    <div class="avatars">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=40&h=40&fit=crop"
                            alt="User 1" class="avatar">
                        <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=40&h=40&fit=crop"
                            alt="User 2" class="avatar">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=40&h=40&fit=crop"
                            alt="User 3" class="avatar">
                        <span class="avatar"
                            style="background-color: #2563eb; color: white; font-size: 0.8em; display: flex; align-items: center; justify-content: center;">+2k</span>
                    </div>
                    <p style="color: #475569; font-size: 0.9rem; font-weight: 500;"><b>2,000+</b> users joined this week
                    </p>
                </div>
            </div>
            <div class="hero-right">
                <img src="{{ asset('landingpage/img/Hero image.png')}}" alt="Happy man with groceries">
            </div>
        </div>
    </section>

    <section id="products" class="products">
        <div class="products-container">
            <h2>Most popular Product</h2>
            <p>most popular product in this year</p>
            <div class="product-grid">
            </div>
        </div>
    </section>

    <section id="about" class="about">
        <div class="about-container">
            <h2>About Us</h2>
            <p>We believe shopping should be an experience that's simple, enjoyable, and accessible to everyone.</p>
            <div class="about-grid">
                <div class="mission-section">
                    <div class="mission-text">
                        <h3>Our Mission</h3>
                        <p>At Tokoku, we're committed to transforming the way you shop. With our comprehensive product
                            selection, competitive pricing, and dedicated customer service, we make shopping more
                            convenient than ever before.</p>
                    </div>
                    <div class="mission-buttons">
                        <a href="#" class="mission-btn-active">Quality Products</a>
                        <a href="#" class="mission-btn">Fast Delivery</a>
                        <a href="#" class="mission-btn">24/7 Support</a>
                    </div>
                </div>
                <div class="trusted-card">
                    <h3><i class="fa-solid fa-circle-check"></i> Trusted by Thousands</h3>
                    <p>Join our growing community of satisfied customers who trust us for their shopping needs every
                        day.</p>
                </div>
            </div>

            <div class="values-grid">
                <div class="value-card">
                    <div class="icon-box">
                        <i class="fa-solid fa-border-all"></i>
                    </div>
                    <h4>Wide Selection</h4>
                    <p>Thousands of products across multiple categories to meet all your needs.</p>
                </div>
                <div class="value-card">
                    <div class="icon-box">
                        <i class="fa-solid fa-user-gear"></i>
                    </div>
                    <h4>Customer First</h4>
                    <p>Dedicated support team ready to help you 24/7 with any questions or concerns.</p>
                </div>
                <div class="value-card">
                    <div class="icon-box">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <h4>Secure Shopping</h4>
                    <p>Advanced security measures to protect your data and ensure safe transactions.</p>
                </div>
                {{--
            </div> --}}
        </div>
    </section>

    <section id="contact" class="contact">
        <div class="contact-container">
            <header class="heading-section">
                <h1>Contact Us</h1>
                <p>We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
            </header>

            <div class="contact-content">
                <div class="form-section">
                    <h2>Get In Touch</h2>
                    <form action="" method="POST">
                        @csrf
                        <div class="form-fields">
                            <div class="form-group">
                                <label for="first_name">First name *</label>
                                <input type="text" id="first_name" name="first_name" required>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last name *</label>
                                <input type="text" id="last_name" name="last_name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone *</label>
                                <input type="tel" id="phone" name="phone" required>
                            </div>
                            <div class="form-group full-width">
                                <label for="message">Your message *</label>
                                <textarea id="message" name="message" required></textarea>
                            </div>
                        </div>
                        <button type="submit" class="send-button">
                            Send Message <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </form>
                </div>

                <div class="info-section">
                    <div class="contact-info-box">
                        <h2>Contact Information</h2>
                        <div class="contact-item">
                            <i class="fa-solid fa-phone"></i>
                            <div class="contact-details">
                                <h3>Phone</h3>
                                +628 967 334 694
                                <span>Mon-Fri 9AM-6PM</span>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fa-solid fa-envelope"></i>
                            <div class="contact-details">
                                <h3>Email</h3>
                                Wulanzunet@gmail.com
                                <span>We'll respond within 24 hours</span>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fa-solid fa-map-marker-alt"></i>
                            <div class="contact-details">
                                <h3>Address</h3>
                                Middleeichh
                                <span>Visit our office</span>
                            </div>
                        </div>
                    </div>

                    <div class="social-follow-response">
                        <div class="follow-us">
                            <h3>Follow Us</h3>
                            <p>Stay connected with us on social media for updates and promotions.</p>
                            <div class="social-icons">
                                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                                <a href="https://id.pinterest.com/wulanzunet/"><i
                                        class="fa-brands fa-pinterest"></i></a>
                                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="quick-response">
                            <h3>Quick Response</h3>
                            <p>Need immediate assistance? Our support team is available 24/7.</p>
                            <div class="avg-response">
                                <span class="dot"></span>
                                Average response: 2 hours
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="loginModal" class="modal">
            <div class="modal-content">
                <div class="modal-body-custom">
                    <div class="stat-icon">
                        <img src="{{ asset('member/img/apple-icon.png')}}" alt="">
                    </div>
                    <h3>Masuk untuk Melanjutkan</h3>
                    <p>Silakan masuk atau daftar akun untuk melanjutkan proses pembelian Anda.</p>
                </div>
                <div class="modal-actions-custom">
                    <button class="modal-cancel-btn">Batal</button>
                    <a href="" class="modal-confirm-btn">Masuk / Daftar</a>
                </div>
            </div>
        </div>

    </section>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="footer-logo">
                        <span class="footer-logo-icon">T</span>
                        <h3>Toko Drwya</h3>
                    </div>
                    <p>Tokoku adalah platform e-commerce terkemuka yang menyediakan produk berkualitas dengan harga
                        kompetitif dan layanan pelanggan terbaik.</p>
                    <div class="social-icons">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#products">Products</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Support</h3>
                    <ul>
                        <li><a href="#contact">Contact Us</a></li>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">Affiliates</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Newsletter</h3>
                    <p style="color: #d1d5db; font-size: 0.9rem;">Dapatkan pembaruan dan penawaran terbaru!</p>
                    <div class="newsletter">
                        <input type="email" placeholder="Masukkan email Anda">
                        <button class="newsletter-btn"><i class="fa-solid fa-paper-plane"></i></button>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; 2024 Tokoku. All rights reserved.
            </div>
        </div>
    </footer>
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }


        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #070707;
        }

        /* --- Navbar Styles --- */
        .header {
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            background-color: rgba(255, 255, 255, 0.6);
            /* transparan */
            backdrop-filter: blur(12px);
            /* blur */
            -webkit-backdrop-filter: blur(12px);
            /* safari support */
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            /* biar lebih clean */
            transition: background 0.3s ease;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0.15rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2.5rem;
        }

        /* Perbarui CSS untuk nav-menu agar bisa menggunakan position: relative */
        .nav-menu a {
            text-decoration: none;
            color: #475569;
            font-weight: 500;
            font-size: 1em;
            transition: color 0.3s ease;
            position: relative;
            /* Penting untuk penempatan .underline */
            padding-bottom: 5px;
            /* Memberi ruang di bawah teks untuk garis */
        }

        /* Garis bawah default (tersembunyi) */
        .nav-menu a .underline {
            position: absolute;
            bottom: 0;
            left: 50%;
            /* Posisi awal di tengah */
            transform: translateX(-50%);
            height: 3px;
            background-color: #2563eb;
            border-radius: 9999px;
            width: 0;
            /* Awalnya tidak terlihat */
            transition: width 0.3s ease;
            /* Transisi untuk lebar */
        }

        /* Animasi saat hover */
        .nav-menu a:hover .underline {
            width: 60%;
            /* Garis menjadi lebih pendek saat di-hover */
        }

        /* Tautan yang sedang aktif (kelas .active) */
        .nav-menu a.active {
            color: #2563eb;
            font-weight: 600;
        }

        /* Garis bawah untuk tautan yang aktif */
        .nav-menu a.active .underline {
            width: 100%;
            /* Garis menjadi panjang penuh */
        }

        .sign-in-btn {
            background: #2563eb;
            color: white;
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
            text-decoration: none;
        }

        .sign-in-btn:hover {
            background: #1d4ed8;
        }

        /* --- Hero Section Styles --- */
        .hero {
            padding: 5rem 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            padding-top: 90px;
        }

        .hero-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15rem;
        }

        .hero-left {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-left: 50px;
        }

        .hero-content {
            flex: 1;
        }

        .badge {
            background: #dbeafe;
            color: #2563eb;
            border-style: solid;
            border-width: 1px;
            /* Lebar border agar terlihat */
            border-color: #2563eb;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            margin-bottom: 1rem;
        }

        .badge-dot {
            width: 8px;
            height: 8px;
            background-color: #2563eb;
            border-radius: 50%;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 900;
            color: #0f172a;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .hero-content h1 .highlight {
            color: #2563eb;
        }

        .hero-content p {
            font-size: 1.1rem;
            color: #64748b;
            margin-bottom: 2rem;
            max-width: 500px;
        }

        .get-started-btn {
            background: #2563eb;
            color: white;
            padding: 1rem 2.5rem;
            border: none;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .get-started-btn:hover {
            background: #1d4ed8;
        }

        .user-count {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        .avatars {
            display: flex;
            position: relative;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid white;
            object-fit: cover;
        }

        .avatar:not(:first-child) {
            margin-left: -1rem;
        }

        .hero-right {
            position: relative;
        }


        /* Other sections below remain the same as your original code to maintain full functionality */
        .products {
            padding: 5rem 0;
            background: white;
        }

        .products-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            text-align: center;
        }

        .products h2 {
            font-size: 3rem;
            font-weight: 900;
            color: #2563eb;
            margin-bottom: 1rem;
        }

        .products>p {
            color: #6b7280;
            margin-bottom: 4rem;
            font-size: 1.2rem;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2.5rem;
            margin-top: 4rem;
        }

        /* --- CARD STYLE BARU --- */
        .product-card {
            background: #fff;
            max-width: 360px;
            width: 100%;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            padding: 1.5rem;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .product-image-container {
            background-color: #f1f5f9;
            border-radius: 12px;
            width: 100%;
            max-width: 330px;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin-bottom: 1rem;
            position: relative;
        }

        .product-image-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            /* Pastikan gambar tidak terpotong */
            border-radius: 12px;
        }

        .product-image-placeholder {
            font-size: 1.5rem;
            font-weight: bold;
            color: #94a3b8;
        }

        .wishlist-icon {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.2rem;
            color: #ef4444;
            cursor: pointer;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }

        .product-info {
            display: flex;
            flex-direction: column;
            flex: 1;
            text-align: left;
            /* dari center → left */
        }

        .product-tags-rating {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .product-tags {
            display: flex;
            gap: 0.5rem;
        }

        .product-tag {
            background: #fff;
            color: #2563eb;
            border-width: 1px;
            border-color: #2563eb;
            border-style: solid;
            padding: 0.4rem 0.8rem;
            border-radius: 16px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .product-rating {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            background: #fff;
            padding: 0.4rem 0.8rem;
            border-radius: 16px;
            font-size: 0.85rem;
            font-weight: 700;
            color: #2563eb;
            border: 1px solid #e0e7ff;
        }

        .product-rating i {
            color: #fbbf24;
            font-size: 1rem;
        }

        .product-header h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
            margin: 5px;

        }

        .product-company {
            color: #64748b;
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .product-description {
            color: #475569;
            font-size: 0.8rem;
            line-height: 1.5;
            margin-bottom: 1rem;
            font-style: sans-serif;
        }

        .product-price-section {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
            margin-bottom: 1.5rem;
        }

        .price {
            font-size: 1rem;
            font-weight: 700;
            color: #0f172a;
        }

        .price-old {
            font-size: 0.7rem;
            color: #94a3b8;
            text-decoration: line-through;
        }

        .product-actions {
            display: flex;
            gap: 1rem;
            margin-top: auto;
            /* Push to the bottom */
        }

        .buy-now-btn {
            background: #2563eb;
            color: white;
            padding: 1rem 1.5rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .buy-now-btn:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
        }

        .cart-btn {
            background: #e0e7ff;
            color: #2563eb;
            padding: 1rem;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .cart-btn:hover {
            background: #c7d2fe;
            transform: translateY(-2px);
        }

        /* Interaktif pada tombol */
        .get-started-btn:hover,
        .buy-now-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .cart-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(69, 90, 100, 0.1);
        }

        /* Interaktif pada product card */
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.12);
        }

        /* Interaktif pada ikon sosial */
        .social-icons a i {
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .social-icons a:hover i {
            color: #2563eb;
            transform: scale(1.1);
        }

        /* Animasi untuk mission buttons */
        .mission-btn:hover {
            background-color: #e0e7ff;
            color: #2563eb;
        }

        .mission-btn-active {
            background-color: #2563eb;
            color: white;
        }

        .mission-btn {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* Animasi untuk input form saat fokus */
        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
            outline: none;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 0.5rem;
        }

        .quantity-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #64748b;
            cursor: pointer;
        }

        .quantity-display {
            font-size: 1rem;
            font-weight: 600;
            color: #0f172a;
        }

        /* --- END CARD STYLE BARU --- */

        /* --- ABOUT US STYLES (UPDATED) --- */
        .about {
            padding: 5rem 0;
            background: #fff;
            text-align: center;
        }

        .about-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2rem;
        }

        .about h2 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #2563eb;
            position: relative;
            margin-bottom: 0.5rem;
        }

        .about h2::after {
            content: '';
            display: block;
            width: 50px;
            height: 4px;
            background-color: #2563eb;
            margin: 0.5rem auto 0;
            border-radius: 2px;
        }

        .about p {
            font-size: 1rem;
            color: #475569;
            max-width: 600px;
            margin-bottom: 2rem;
        }

        .about-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            width: 100%;
        }

        .mission-section {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            text-align: left;
            min-width: 300px;
            max-width: 500px;
            /* Tambahkan max-width agar tidak terlalu lebar di desktop */
        }

        .mission-text {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .mission-text h3 {
            font-size: 1.8rem;
            font-weight: 800;
            color: #0f172a;
        }

        .mission-text p {
            font-size: 1rem;
            color: #475569;
            margin: 0;
        }

        .mission-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .mission-btn-active {
            background-color: #2563eb;
            color: #e2e8f0;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .mission-btn-active:hover {
            background-color: #1b58dd;
        }

        .mission-btn {
            background-color: #e0e7ff;
            color: #2563eb;
            border-width: 1px;
            border-style: solid;
            border-color: #2563eb;
            padding: 0.75rem 1.5rem;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .mission-btn:hover {
            background-color: #c7d2fe;
        }

        .trusted-card {
            background-color: #2563eb;
            color: white;
            padding: 2.5rem;
            border-radius: 2rem;
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.3);
            display: flex;
            flex-direction: column;
            gap: 1rem;
            text-align: left;
            position: relative;
            max-width: 500px;
            /* Tambahkan max-width agar tidak terlalu lebar di desktop */
        }

        .trusted-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .trusted-card h3 i {
            color: white;
            font-size: 1.25em;
        }

        .trusted-card p {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #e0e7ff;
            margin: 0;
        }

        .values-grid {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            margin-top: 2rem;
        }

        .value-card {
            background: #fff;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            text-align: center;
            flex: 1;
            min-width: 250px;
            max-width: 320px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.75rem;
        }

        .value-card .icon-box {
            background: #f1f5f9;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .value-card .icon-box i {
            font-size: 1.5rem;
            color: #0f172a;
        }

        .value-card h4 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        .value-card p {
            font-size: 0.9rem;
            color: #64748b;
            line-height: 1.5;
            margin: 0;
        }

        /* Styling untuk Modal (Diperbarui agar mirip gambar) */
        .modal {
            display: none;
            /* Sembunyikan modal secara default */
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(5px);
            /* Efek blur pada background */
            -webkit-backdrop-filter: blur(5px);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            display: flex;
            /* Gunakan flexbox untuk menengahkan konten */
            align-items: center;
            justify-content: center;
        }

        .modal.show {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background-color: #ffffff;
            /* Latar belakang putih */
            padding: 2.5rem;
            /* Padding lebih besar */
            border-radius: 12px;
            max-width: 480px;
            /* Ukuran lebih lebar */
            width: 90%;
            position: relative;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            /* Shadow lebih lembut */
            transform: translateY(-20px);
            /* Mulai sedikit di atas */
            transition: transform 0.3s ease-out, opacity 0.3s ease-out;
            opacity: 0;
        }

        .modal.show .modal-content {
            transform: translateY(0);
            /* Kembali ke posisi normal */
            opacity: 1;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background-color: #F3F4F6;
            border-radius: 12px;
            display: flex;
            margin: auto;
            /* Mengaktifkan Flexbox */
            justify-content: center;
            /* Menengahkan ikon secara horizontal */
            align-items: center;
            /* Menengahkan ikon secara vertikal */
            margin-bottom: 20px;
        }

        .stat-icon img {
            width: 24px;
            height: 24px;
            filter: brightness(0);
            /* Mengubah warna ikon menjadi hitam */
        }

        .modal-body-custom h3 {
            font-size: 1.625rem;
            /* Ukuran judul lebih besar */
            color: #1a202c;
            /* Warna teks gelap */
            margin-bottom: 0.75rem;
            font-weight: 700;
            /* Bold */
        }

        .modal-body-custom p {
            color: #4a5568;
            /* Warna teks abu-abu */
            margin-bottom: 2rem;
            font-size: 1rem;
            line-height: 1.5;
        }

        .modal-actions-custom {
            display: flex;
            justify-content: center;
            /* Tengah tombol */
            gap: 1rem;
            /* Jarak antar tombol */
        }

        .modal-cancel-btn,
        .modal-confirm-btn {
            padding: 0.875rem 1.75rem;
            /* Padding tombol */
            border-radius: 8px;
            /* Sudut tombol */
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            border: none;
            text-decoration: none;
            /* Penting untuk tag <a> */
            display: inline-flex;
            /* Agar padding dan tinggi sama */
            align-items: center;
            justify-content: center;
        }

        .modal-cancel-btn {
            background-color: #e2e8f0;
            /* Warna abu-abu terang */
            color: #2d3748;
            /* Warna teks gelap */
        }

        .modal-cancel-btn:hover {
            background-color: #cbd5e0;
        }

        .modal-confirm-btn {
            background-color: #1b58dd;
            /* Warna ungu */
            color: white;
        }

        .modal-confirm-btn:hover {
            background-color: #152cff;
        }

        /* Karena .modal.show sekarang adalah display: flex, kita perlu mengatur display: none */
        /* ini adalah perbaikan untuk display modal yang tidak muncul */
        .modal:not(.show) {
            display: none;
        }

        /* --- END ABOUT US STYLES (UPDATED) --- */

        /* Contact Section Styling */
        #contact {
            padding: 80px 20px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #fdfdfd;
            text-align: center;
        }

        #contact .heading-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        #contact .heading-section p {
            color: #666;
            max-width: 600px;
            margin: 0 auto 40px;
            font-size: 1rem;
        }

        /* Layout */
        .contact-content {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 30px;
            max-width: 1100px;
            margin: 0 auto;
            text-align: left;
        }

        /* Form Section */
        .form-section {
            background: #fff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        }

        .form-section h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .form-fields {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 0.95rem;
            outline: none;
            transition: border 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #2563eb;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        textarea {
            min-height: 120px;
            resize: none;
        }

        /* Button */
        .send-button {
            margin-top: 20px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #2563eb;
            color: #fff;
            border: none;
            padding: 12px 22px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 500;
            transition: background 0.3s;
        }

        .send-button:hover {
            background: #1d4ed8;
        }

        /* Info Section */
        .info-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .contact-info-box {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: #fff;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .contact-info-box h2 {
            margin-bottom: 20px;
            font-size: 1.3rem;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 18px;
        }

        .contact-item i {
            font-size: 1.3rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px;
            border-radius: 50%;
        }

        .contact-details h3 {
            margin: 0;
            font-size: 1rem;
            font-weight: 600;
        }

        .contact-details span {
            display: block;
            font-size: 0.85rem;
            color: #e0e0e0;
        }

        /* Follow + Quick Response */
        .social-follow-response {
            display: flex;
            gap: 20px;
        }

        .follow-us,
        .quick-response {
            flex: 1;
            background: #fff;
            padding: 20px;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        }

        .follow-us h3,
        .quick-response h3 {
            font-size: 1rem;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .follow-us p,
        .quick-response p {
            font-size: 0.9rem;
            color: #555;
        }

        .social-icons a {
            margin-right: 10px;
            font-size: 1.2rem;
            color: #444;
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: #2563eb;
        }

        /* Avg Response */
        .avg-response {
            margin-top: 10px;
            font-size: 0.9rem;
            font-weight: 500;
            color: #2563eb;
        }

        .avg-response .dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            margin-right: 6px;
            background: #2563eb;
            border-radius: 50%;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .contact-content {
                grid-template-columns: 1fr;
            }

            .social-follow-response {
                flex-direction: column;
            }
        }


        /* Footer Styling */
        .footer {
            background: #1f1f1f;
            color: #fff;
            padding: 60px 20px 30px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-content {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1.5fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        /* Brand */
        .footer-brand {
            max-width: 320px;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .footer-logo-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            background: #2563eb;
            color: #fff;
            border-radius: 50%;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .footer-logo h3 {
            font-size: 1.3rem;
            font-weight: 700;
        }

        .footer-brand p {
            font-size: 0.9rem;
            line-height: 1.5;
            color: #d1d5db;
            margin-bottom: 20px;
        }

        /* Social Icons */
        .social-icons {
            display: flex;
            gap: 15px;
        }

        .social-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #2d2d2d;
            color: #fff;
            font-size: 0.95rem;
            transition: background 0.3s, color 0.3s;
        }

        .social-icon:hover {
            background: #2563eb;
            color: #fff;
        }

        /* Footer Sections */
        .footer-section h3 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin-bottom: 10px;
        }

        .footer-section ul li a {
            text-decoration: none;
            color: #d1d5db;
            font-size: 0.9rem;
            transition: color 0.3s;
        }

        .footer-section ul li a:hover {
            color: #fff;
        }

        /* Newsletter */
        .newsletter {
            display: flex;
            margin-top: 15px;
        }

        .newsletter input {
            flex: 1;
            padding: 12px 15px;
            border: none;
            border-radius: 8px 0 0 8px;
            outline: none;
            font-size: 0.9rem;
        }

        .newsletter-btn {
            background: #2563eb;
            border: none;
            padding: 0 20px;
            border-radius: 0 8px 8px 0;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s;
        }

        .newsletter-btn:hover {
            background: #1d4ed8;
        }

        /* Bottom */
        .footer-bottom {
            border-top: 1px solid #333;
            padding-top: 20px;
            text-align: center;
            font-size: 0.85rem;
            color: #aaa;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .footer-content {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 600px) {
            .footer-content {
                grid-template-columns: 1fr;
            }

            .footer-brand {
                margin-bottom: 30px;
            }
        }


        /* Responsive */
        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }

            .hero-container {
                flex-direction: column-reverse;
                text-align: center;
            }

            .hero-content {
                text-align: center;
            }

            .badge {
                justify-content: center;
            }

            .user-count {
                justify-content: center;
            }

            .hero-image-container {
                width: 300px;
                height: 300px;
            }

            .products-container,
            .about-container,
            .contact-container,
            .footer-container {
                padding: 0 1rem;
            }

            .about-grid {
                grid-template-columns: 1fr;
            }

            .mission-section,
            .trusted-card {
                text-align: center;
                align-items: center;
            }

            .mission-buttons {
                justify-content: center;
            }

            .contact-content,
            .footer-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }

        /* --- Animations --- */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Apply animations */
        .hero-content {
            animation: fadeInUp 1s ease-out forwards;
        }

        .hero-right img {
            animation: fadeInUp 1s ease-out forwards;
        }

        .get-started-btn {
            animation: fadeIn 1.5s ease forwards;
            transition: transform 0.3s ease, background 0.3s ease;
        }

        .get-started-btn:hover {
            transform: scale(1.05) translateY(-3px);
        }

        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
        }
    </style>
    <script>
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
    </script>
</body>

</html>