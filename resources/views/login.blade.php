<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <style>
        .bg-image-vertical {
            position: relative;
            overflow: hidden;
            background-repeat: no-repeat;
            background-position: right center;
            background-size: auto 100%;
        }

        @media (min-width: 1025px) {
            .h-custom-2 {
                height: 100%;
            }
        }

        .gradient-text {
            font-weight: 900;
            letter-spacing: -0.05em;
            /* Mirip 'tracking-tighter' */
            /* Ukuran font responsif */
            font-size: 2rem;
            /* Ukuran desktop besar */
        }

        .gradient-text span {
            /* Terapkan gradien sebagai background */
            background-image: var(--letter-gradient);

            /* Potong background agar sesuai dengan bentuk teks */
            -webkit-background-clip: text;
            background-clip: text;

            /* Buat teksnya transparan agar gradien terlihat */
            color: transparent;

            /* Mencegah pemecahan baris antar huruf */
            display: inline-block;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/manageuser.css') }}">
</head>

<body>
    <div class="bg-shape"></div>
    <div class="bg-gradient"></div>
    <section class="vh-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 mt-5 text-black">

                    <div
                        class="d-flex align-items-center justify-content-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                        <form style="width: 23rem;" method="POST" action="{{ route('login') }}">
                            @csrf
                            <h1 class="gradient-text text-center" aria-label="LabLogix">
                                <!--
                                    Setiap huruf diberi variabel CSS untuk gradiennya,
                                    sesuai dengan palet warna di gambar.
                                  -->
                                <span style="--letter-gradient: linear-gradient(to right, #0077b6, #48cae4);">L</span>
                                <span style="--letter-gradient: linear-gradient(to right, #0077b6, #90e0ef);">a</span>
                                <span style="--letter-gradient: linear-gradient(to right, #0077b6, #c8f7c5);">b</span>
                                <span style="--letter-gradient: linear-gradient(to right, #0077b6, #dbeafe);">L</span>
                                <span style="--letter-gradient: linear-gradient(to right, #0077b6, #48cae4);">o</span>
                                <span style="--letter-gradient: linear-gradient(to right, #90e0ef, #0077b6);">g</span>
                                <span style="--letter-gradient: linear-gradient(to right, #0077b6, #c8f7c5);">i</span>
                                <span style="--letter-gradient: linear-gradient(to right, #0077b6, #dbeafe);">x</span>
                            </h1>
                            <h3 class="font-weight-bold text-center" style="letter-spacing: 1px;">Log in</h3>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="form2Example18">Email address:</label>
                                <input type="email" name="email" id="form2Example18"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" required autofocus autocomplete="username" />
                            </div>

                            {{-- Error Email --}}
                            @error('email')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror

                            <div data-mdb-input-init class="form-outline mb-4">
                                <label class="form-label" for="form2Example28">Password:</label>
                                <input type="password" id="form2Example28" name="password" id="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    required autocomplete="current-password" />
                            </div>

                            {{-- Error Password --}}
                            @error('password')
                                <div class="text-danger mt-1 small">{{ $message }}</div>
                            @enderror

                            <div class="pt-1 mb-4">
                                <button data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-lg btn-block"
                                    type="submit">Login</button>
                            </div>

                            <p>Forgot password? <a href="#!" class="link-info">Click here</a></p>

                        </form>

                    </div>

                </div>
                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="{{ asset('assets/img/lab2.jpg') }}" alt="Login image" class="w-100 vh-100"
                        style="object-fit: cover; object-position: left;">
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
</body>

</html>
