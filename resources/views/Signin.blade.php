<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tokoku Login</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13lV9lgY1Nx4Y4Lw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Global & Body */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #ffffff;
        }

        /* Login Card Container */
        .login-card-container {
            display: flex;
            width: 900px;
            height: 550px;
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* Left Side (Login Form) */
        .left-card {
            flex: 1;
            padding: 20px 30px;
            /* Padding ditingkatkan untuk ruang yang lebih besar */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: left;
        }

        .logo {
            position: absolute;
            top: 50px;
            left: 200px;
            display: flex;
            align-items: center;
            font-size: 18px;
            font-weight: 600;
            gap: 8px;
            color: #333;
        }

        .logo img {
            width: 24px;
            height: 24px;
        }

        .title-login {
            font-size: 1.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 700;
            margin-top: 5px;
            margin-bottom: 5px;
            width: 100%;
            max-width: 400px;
        }

        .subtitle-login {
            font-size: 0.7rem;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 500;
            color: #777;
            margin-top: 10px;
            margin-bottom: 20px;
            width: 100%;
            max-width: 280px;
        }

        form {
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-group {
            width: 100%;
            max-width: 280px;
            margin-bottom: 7px;
        }

        .form-group input {
            width: 100%;
            height: 40px;
            border: 1px solid #ddd;
            border-radius: 25px;
            padding: 0 14px;
            font-size: 12px;
            padding-left: 30px;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            border-color: #1909ff;
            box-shadow: 0 0 0 3px rgba(25, 9, 255, 0.2);
            /* glow biru */
            outline: none;
            /* hilangin border biru default browser */
        }

        /* Samakan lebar button */
        .btn-login {
            width: 100%;
            max-width: 280px;
            height: 45px;
            border-radius: 25px;
            background: #1909ff;
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: 0.2s ease;
            margin-top: 15px;
        }



        .btn-login:hover {
            background: #1506dd;
            /* Warna hover sedikit lebih gelap */
        }

        .divider {
            text-align: center;
            font-size: 12px;
            color: #777;
            position: relative;
            margin: 10px 0;
            width: 100%;
            max-width: 280px;
        }

        .divider::before,
        .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 35%;
            /* Lebar garis */
            height: 1px;
            background-color: #ddd;
        }

        .divider::before {
            left: 0;
        }

        .divider::after {
            right: 0;
        }

        /* Social Login Buttons */
        .social-login {
            display: flex;
            flex-direction: column;
            gap: 8px;
            /* Jarak antar tombol */
            width: 100%;
            max-width: 280px;
        }

        .social-login button {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px;
            /* Padding tombol sosial */
            border: 1px solid #ddd;
            border-radius: 20px;
            background: #fff;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            color: #555;
            transition: all 0.3s ease;
            /* biar animasi halus */
        }

        /* Hover */
        .social-login button:hover {
            background: #f0f2ff;
            border-color: #1909ff;
            color: #1909ff;
        }

        /* Fokus (klik/tab) */
        .social-login button:focus {
            border-color: #1909ff;
            box-shadow: 0 0 0 3px rgba(25, 9, 255, 0.2);
            outline: none;
        }

        .social-login .icon {
            width: 18px;
            /* Ukuran ikon */
            height: 18px;
        }

        .register {
            text-align: center;
            font-size: 12px;
            margin-top: 10px;
        }

        .register a {
            color: #5d50fe;
            font-weight: 500;
            text-decoration: none;
        }
        .forget-password {
            text-align: end;
            margin-left: 165px;
            font-size: 12px;
            margin-top: 10px;
        }

        .forget-password a {
            color: #5d50fe;
            font-weight: 500;
            text-decoration: none;
        }

        /* Right Side (Video) */
        .right-card {
            flex: 1;
            position: relative;
            border-radius: 0 20px 20px 0;
        }

        .bg-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            z-index: 0;
            padding: 20px 15px;
            border-radius: 40px;
        }

        .back-btn {
            position: absolute;
            top: 40px;
            left: 210px;
            font-size: 14px;
            font-weight: 500;
            color: #333;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            /* kecil aja biar kayak pill button */
            background: rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            /* biar ada depth */
            transition: all 0.3s ease;
        }
    </style>
</head>

<body>
    <div class="login-card-container">
        <div class="left-card">
            <a href="{{ route('landing')}}" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i>
            </a>

            <div class="title-login">Sign in</div>
            <div class="subtitle-login">Please enter your details.</div>
            <div class="social-login">
                <button>
                    <img src="{{ asset('landingpage/img/Google icon.png') }}" alt="Google" class="icon"> Google
                </button>
            </div>
            <div class="divider">or</div>

            <form method="POST" action="{{ route('signin.action') }}">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required />
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required />
                </div>
                <div class="forget-password">
                    <a href="" class="forget-text">Forget Password?</a>
                </div>
                <button type="submit" class="btn-login">Log In</button>
            </form>
            <div class="register">
                Don't have an account? <a href="{{ route('signup.index')}}">Sign Up</a>
            </div>
        </div>

        <div class="right-card">
           <video autoplay loop muted playsinline class="bg-video">
                <source src="{{ asset('landingpage/video/Blue.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
</body>

</html>