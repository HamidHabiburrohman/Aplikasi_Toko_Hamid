<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Toko Drwya Sign Up</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('landingpage/img/Logo.svg')}}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        xintegrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13lV9lgY1Nx4Y4Lw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('Signin & Signup/style.css') }}">
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body>
    <div class="login-card-container">
        <div class="left-card" x-data="realtimeValidation()">
            <div class="title-login">Register Now!</div>
            <div class="subtitle-login">Enter your details to create an account</div>
            <form action="{{ route('action-signup') }}" method="POST">
                @csrf
                <div class="form-group-up">
                    <label class="title-input">Name</label>
                    <input type="text" name="name" required value="{{ old('name') }}" x-model="formData.name"
                        x-on:input.debounce.500ms="validateField('name')" :class="errors.name ? 'input-error' : ''" />
                    <span x-show="loading.name" class="spinner-inline">
                        <i class="fa-solid fa-spinner fa-spin"></i>
                    </span>
                </div>
                <div class="error-message" x-show="errors.name" x-text="errors.name"></div>
                @error('name')
                    <div class="error-message-laravel">{{ $message }}</div>
                @enderror

                <div class="form-group-up">
                    <label class="title-input">Email</label>
                    <input type="email" name="email" required value="{{ old('email') }}" x-model="formData.email"
                        x-on:input.debounce.500ms="validateField('email')" :class="errors.email ? 'input-error' : ''" />
                    <span x-show="loading.email" class="spinner-inline">
                        <i class="fa-solid fa-spinner fa-spin"></i>
                    </span>
                </div>
                <div class="error-message" x-show="errors.email" x-text="errors.email"></div>
                @error('email')
                    <div class="error-message-laravel">{{ $message }}</div>
                @enderror

                <div class="form-group-up">
                    <label class="title-input">Password</label>
                    <input type="password" name="password" id="password" required />
                    <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('password', this)"></i>
                </div>
                @error('password')
                    <div class="error-message-laravel">{{ $message }}</div>
                @enderror

                <div class="form-group-up">
                    <label class="title-input">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required />
                    <i class="fa-solid fa-eye toggle-password"
                        onclick="togglePassword('password_confirmation', this)"></i>
                </div>
                @error('password_confirmation')
                    <div class="error-message-laravel">{{ $message }}</div>
                @enderror

                <button type="submit" class="btn-login"
                    :disabled="loading.name || loading.email || errors.name || errors.email">Sign up</button>
            </form>
            <div class="register">
                Already have an account? <a href="{{ route('signin')}}">Sign in</a>
            </div>
        </div>
        <div class="right-card">
            <video autoplay loop muted playsinline class="bg-video">
                <source src="{{ asset('landingpage/video/Blue.mp4')}}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
    <script>
        function realtimeValidation() {
            return {
                formData: {
                    name: @json(old('name', '')),
                    email: @json(old('email', '')),
                },
                errors: {
                    name: '',
                    email: '',
                },
                loading: {
                    name: false,
                    email: false
                },

                async validateField(fieldName) {
                    const value = this.formData[fieldName];

                    if (value.length === 0) {
                        this.errors[fieldName] = fieldName === 'name' ? 'Nama wajib diisi.' : 'Email wajib diisi.';
                        return;
                    }

                    if (fieldName === 'email' && (!value.includes('@') || value.length < 5)) {
                        this.errors[fieldName] = 'Format email belum benar.';
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

        function togglePassword(id, icon) {
            const input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    </script>
</body>

</html>