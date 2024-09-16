@extends('layout.app')
@section('title', 'Registrasi')
@section('content')
<div class="container mt-5">
    <div class="col-md-12 text-center mt-2">
        <h4 class="fw-bold mb-4">Registrasi</h4>
    </div>

    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body text-start p-2">
                <form class="row g-3 needs-validation" method="POST" novalidate="" autocomplete="off" action="{{ route('actionRegister') }}">
                    @csrf
                    <div class="col-md-12">
                        <label for="first-name" class="form-label fw-bold mt-3">Nama Depan</label>
                        <input type="text" class="form-control" id="first-name" name="first_name" placeholder="Ketik Nama Pertama" required>
                        <div class="invalid-feedback">
                            Name Depan harus diisi
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="last-name" class="form-label fw-bold mt-3">Nama Belakang</label>
                        <input type="text" class="form-control" id="last-name" name="last_name" placeholder="Ketik Nama Belakang" required>
                        <div class="invalid-feedback">
                            Name Belakang harus diisi
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="born-date" class="form-label fw-bold mt-3">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="born-date" name="born_date" placeholder="Pilih Tanggal" required>
                        <div class="invalid-feedback">
                            Tanggal Lahir harus diisi
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="username" class="form-label fw-bold mt-3">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Ketik Username" required>
                        <div class="invalid-feedback">
                            Username harus diisi
                        </div>
                    </div>                        
                    <div class="col-12">
                        <label for="password" class="form-label fw-bold mt-3">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Ketik Password" required>
                        <div class="invalid-feedback">
                            Password harus diisi
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="confirm-password" class="form-label fw-bold mt-3">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="confirm-password " name="confirm_password" placeholder="Ketik Password" required>
                        <div class="invalid-feedback">
                            Konfirmasi Password harus diisi
                        </div>
                    </div>
                </div>
                <button type="submit" id="btn-submit-register" class="btn btn-primary float-end">Daftar</button>
            </form>
            <div class="card-footer">
                <div class="text-center">
                    Sudah punya akun? <a href="login" class="text-dark">Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {

                    var password = form.querySelector('#password').value;
                    var passwordConfirmation = form.querySelector('#confirm-password').value;

                    if (!form.checkValidity() || password !== passwordConfirmation) {
                        event.preventDefault()
                        event.stopPropagation()

                        if (password !== passwordConfirmation) {
                            swal("Error", "Passwords do not match", "error");
                        }
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endsection