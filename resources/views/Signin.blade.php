<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Toko Drwya Signin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('landingpage/img/Logo.svg')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        xintegrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13lV9lgY1Nx4Y4Lw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('Signin & Signup/style.css')}}">
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body>
    <div class="login-card-container">
        <div class="left-card" x-data="realtimeValidation()">
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

            <form method="POST" action="{{ route('action-signin') }}">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required x-model="formData.email"
                        x-on:input.debounce.500ms="validateField('email')" :class="errors.email ? 'input-error' : ''" />
                    <span x-show="loading.email" class="spinner-inline">
                        <i class="fa-solid fa-spinner fa-spin"></i>
                    </span>
                </div>

                <div class="error-message" x-show="errors.email" x-text="errors.email"></div>
                @error('email')
                    <div class="error-message-laravel">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required />
                </div>
                @error('password')
                    <div class="error-message-laravel">{{ $message }}</div>
                @enderror

                <div class="forget-password">
                    <a href="" class="forget-text">Forget Password?</a>
                </div>
                <button type="submit" class="btn-login">
                    Log In
                </button>
            </form>
            <div class="register">
                Don't have an account? <a href="{{ route('signup')}}">Sign Up</a>
            </div>
        </div>

        <div class="right-card">
            <video autoplay loop muted playsinline class="bg-video">
                <source src="{{ asset('landingpage/video/Blue.mp4') }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
    <script>
        function realtimeValidation() {
            return {
                formData: {
                    email: @json(old('email', '')),
                },
                errors: {
                    email: '',
                },
                loading: {
                    email: false
                },

                async validateField(fieldName) {
                    const value = this.formData[fieldName];

                    if (value.length === 0) {
                        this.errors[fieldName] = 'Email wajib diisi';
                        return;
                    }

                    if (!value.includes('@') || value.length < 5) {
                        this.errors[fieldName] = 'Format email belum benar';
                        return;
                    }

                    this.loading[fieldName] = true;
                    this.errors[fieldName] = '';

                    try {
                        const response = await fetch('/validate-field-realtime', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                field: fieldName,
                                value: value
                            })
                        });

                        const data = await response.json();

                        if (response.ok && data.valid === false) {
                            this.errors[fieldName] = data.message;
                        } else if (response.status === 404) {
                            this.errors[fieldName] = 'Error: Rute validasi tidak ditemukan.';
                        } else if (response.status === 419) {
                            this.errors[fieldName] = 'Error: Sesi expired. Coba refresh halaman.';
                        } else if (response.status !== 200) {
                            this.errors[fieldName] = 'Terjadi kesalahan pada server saat validasi (' + response.status + ').';
                        } else {
                            this.errors[fieldName] = '';
                        }

                    } catch (error) {
                        console.error('Network Error:', error);
                        this.errors[fieldName] = 'Gagal menghubungi server untuk validasi.';
                    } finally {
                        this.loading[fieldName] = false;
                    }
                }
            }
        }
    </script>
</body>

</html>