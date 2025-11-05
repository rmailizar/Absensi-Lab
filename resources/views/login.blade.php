<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        .gradient-custom {
            background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
        }
    </style>
</head>
<body>
    <section class="vh-100 gradient-custom">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">

                                <div class="mb-md-5 mt-md-4 pb-5">

                                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                    <p class="text-white-50 mb-5">Please enter your login and password!</p>

                                    {{-- Email Field --}}
                                    <div class="form-outline form-white mb-4 text-start">
                                        <label class="form-label" for="typeEmailX">Email</label>
                                        <input type="email" name="email" id="typeEmailX"
                                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" required autofocus autocomplete="username"/>

                                        {{-- Error Email --}}
                                        @error('email')
                                            <div class="text-danger mt-1 small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Password Field --}}
                                    <div class="form-outline form-white mb-4 text-start">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" name="password" id="password"
                                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                                            required autocomplete="current-password"/>

                                        {{-- Error Password --}}
                                        @error('password')
                                            <div class="text-danger mt-1 small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <p class="small mb-5 pb-lg-2">
                                        <a class="text-white-50" href="{{ route('password.request') }}">Forgot password?</a>
                                    </p>

                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

                                    <div class="d-flex justify-content-center text-center mt-4 pt-1">
                                        <a href="#" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                                        <a href="#" class="text-white mx-4"><i class="fab fa-twitter fa-lg"></i></a>
                                        <a href="#" class="text-white"><i class="fab fa-google fa-lg"></i></a>
                                    </div>
                                </div>

                                <div>
                                    <p class="mb-0">Don't have an account?
                                        <a href="{{ route('register') }}" class="text-white-50 fw-bold">Sign Up</a>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
