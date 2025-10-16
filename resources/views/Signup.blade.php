<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tokoku Sign Up</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13lV9lgY1Nx4Y4Lw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            font-size: 0.8rem;
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

        /* Form container */
        form {
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-group {
            position: relative;
            width: 100%;
            max-width: 280px;
            margin-bottom: 7px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            color: #555;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            height: 40px;
            border: 1px solid #ddd;
            border-radius: 25px;
            padding: 0 40px 0 14px;
            font-size: 12px;
            padding-left: 30px;
            transition: all 0.3s ease;
        }

        .password-group {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            margin-top: 12px;
            ;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #777;
            font-size: 14px;
        }



        .form-group input:focus {
            border-color: #1909ff;
            box-shadow: 0 0 0 3px rgba(25, 9, 255, 0.2);
            outline: none;
        }

        /* Login Button */
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
            border: 1px solid #ddd;
            border-radius: 20px;
            background: #fff;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            color: #555;
            transition: all 0.3s ease;
        }

        .social-login button:hover {
            background: #f0f2ff;
            border-color: #1909ff;
            color: #1909ff;
        }

        .social-login button:focus {
            border-color: #1909ff;
            box-shadow: 0 0 0 3px rgba(25, 9, 255, 0.2);
            outline: none;
        }

        .social-login .icon {
            width: 18px;
            height: 18px;
        }

        .register {
            text-align: center;
            font-size: 12px;
            margin-top: 10px;
        }

        .register a {
            color: #5d50fe;
            font-weight: 600;
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
            padding: 10px 15px;
            border-radius: 50px;
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
    <!-- Main container for the sign-up card -->
    <div class="login-card-container">
        <!-- Left side: The sign-up form -->
        <div class="left-card">
            <a href="{{ url()->previous() }}" class="back-btn">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div class="title-login">Register Now!</div>
            <div class="subtitle-login">Enter your details to create an account</div>
            <!-- The main sign-up form -->
            <form action="{{ route('signup.store')}}" method="POST">
                @csrf
                <!-- Replace '#' with your actual form submission route -->
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" required />
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password" required />
                    <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('password', this)"></i>
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required />
                </div>



                <button type="submit" class="btn-login">Sign up</button>
            </form>
            <div class="register">
                Already have an account? <a href="{{ route('signin')}}">Sign in</a>
            </div>
        </div>

        <!-- Right side: The background video -->
        <div class="right-card">
            <video autoplay loop muted playsinline class="bg-video">
                <!-- Make sure the video path is correct relative to your project -->
                <source src="video/Blue.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
    <script>
        function togglePassword(id, el) {
            const input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
                el.classList.remove("fa-eye");
                el.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                el.classList.remove("fa-eye-slash");
                el.classList.add("fa-eye");
            }
        }
    </script>


</body>


</html>