@extends('layout.app')

@section('content')
<div class="container">

    <div class="container h-100">
        <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        {{-- <div class="text-center my-5">
                            <img src="{{ asset('assets\images\astronout.png') }}" alt="logo" width="100">
                        </div> --}}
                        <h1 class="fs-4 card-title fw-bold mb-4">Login</h1>
                        <form method="POST" class="needs-validation" novalidate="" autocomplete="off" action="{{ route('actionLogin') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="mb-2 text-muted" for="email">Username</label>
                                <input id="username" type="text" class="form-control" name="username" value="" required>
                                <div class="invalid-feedback">
                                    Username harus diisi!
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="mb-2 w-100">
                                    <label class="text-muted" for="password">Password</label>
                                    <a href="forgot.html" class="float-end">
                                        Lupa Password?
                                    </a>
                                </div>
                                <input id="password" type="password" class="form-control" name="password" required>
                                <div class="invalid-feedback">
                                    Password harus diisi!
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <button type="submit" class="btn btn-primary ms-auto">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer py-3 border-0">
                        <div class="text-center">
                            Belum punya akun? <a href="register" class="text-dark">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endsection