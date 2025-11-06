<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#070707">
    <title>Toko Drwya</title>
    <link rel="shortcut icon" href="{{ asset('landingpage/img/Logo.svg')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('landingpage/css/landingpage.css')}}">
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
            <a class="sign-in-btn" href="{{  route('signin') }}">Sign in</a>
        </nav>
    </header>

    <section id="home" class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <div class="dots-blur">
                    <img src="{{ asset('landingpage/img/Ellipse 4 (1).svg') }}" alt="">
                </div>
                <div class="dots-blur-1">
                    <img src="{{ asset('landingpage/img/Ellipse 4 (1).svg') }}" alt="">
                </div>
                <span class="badge">
                    <span class="badge-dot"></span>
                    New features available
                </span>
                <h1>Shop Anytime <br><span class="highlight">Anywhere</span></h1>
                <p>Experience seamless shopping with our innovative platform. Discover products, enjoy secure payments,
                    and get fast delivery.</p>
                <a class="get-started-btn" href="{{ route('signin') }}">Get Started Free <span
                        style="font-size: 1.25em;">→</span></a>
                <div class="user-count">
                    <div class="avatars">
                        <img src="{{ asset('landingpage/img/brucewayne.jpg') }}" alt="User 1" class="avatar">
                        <img src="{{  asset('landingpage/img/Sigantenk.jpg') }}" alt="User 2" class="avatar">
                        <img src="{{ asset('landingpage/img/SI owi.jpeg') }}" alt="User 3" class="avatar">
                        <span class="avatar"
                            style="background-color: #2563eb; color: white; font-size: 0.8em; display: flex; align-items: center; justify-content: center;">+2k</span>
                    </div>
                    <p style="color: #475569; font-size: 0.9rem; font-weight: 500;"><b>2,000+</b> users joined this week
                    </p>
                </div>
            </div>
            <div class="hero-right">
                <div class="dots-blur-2">
                    <img src="{{ asset('landingpage/img/Ellipse 4 (1).svg') }}" alt="">
                </div>
                <img src="{{ asset('landingpage/img/Hero image.png')}}" alt="Happy man with groceries" class="hero-img">
            </div>
        </div>
    </section>

    <section id="products" class="products">
        <div class="products-container">
            <h2>Most popular Product</h2>
            <p>most popular product in this year</p>
            <div class="product-grid">
                @foreach ($showProduk as $produk)
                    <div class="product-card">
                        <div class="product-image-container">
                            <img src="{{  url('admin/images/' . $produk->foto_produk) }}" alt="Indomie">
                            <span class="wishlist-icon"><i class="fa-solid fa-heart"></i></span>
                        </div>
                        <div class="product-tags-rating">
                            <div class="product-tags">
                                <span class="product-tag">{{ $produk->kategori->nama_kategori}}</span>
                            </div>
                            <div class="product-rating">
                                <i class="fa-solid fa-star"></i>
                                <span>4.8</span>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3>{{ $produk->nama_produk }}</h3>
                            <div class="product-company">{{ $produk->supplier->nama_supplier }}</div>
                            <p class="product-description">"Indomie Rendang original dengan rasa khas legendaris, mie
                                instan
                                favorit Indonesia."</p>
                            <div class="product-price-section">
                                <span class="price">{{ $produk->harga}}</span>
                                <span class="price-old">Rp. 4.000</span>
                            </div>
                            <div class="product-actions">
                                <button class="buy-now-btn">Beli Sekarang!</button>
                                <button class="cart-btn"><i class="fa-solid fa-cart-shopping"></i></button>
                            </div>
                        </div>
                    </div>
                @endforeach

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
                    <a href="{{  route('signin') }}" class="modal-confirm-btn">Masuk / Daftar</a>
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
</body>
<script src="{{ asset('landingpage/js/landingpage.js') }}"></script>

</html>