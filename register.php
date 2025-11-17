<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Antrian Klinik</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .register-container {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="password"],
        input[type="tel"] {
            width: 100%;
            padding: 12px 20px;
            border: 2px solid #ddd;
            border-radius: 25px;
            font-size: 14px;
            transition: border-color 0.3s;
            outline: none;
        }

        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="tel"]:focus {
            border-color: #667eea;
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-daftar {
            background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
            color: white;
        }

        .btn-reset {
            background: #9e9e9e;
            color: white;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .login-link a {
            color: #0072ff;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .message {
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            display: none;
        }

        .message.show {
            display: block;
        }

        .error-message {
            background: #ff4444;
            color: white;
        }

        .success-message {
            background: #4CAF50;
            color: white;
        }

        .input-error {
            border-color: #ff4444 !important;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1>Register</h1>
        
        <div class="message error-message" id="errorMessage"></div>
        <div class="message success-message" id="successMessage"></div>

        <form id="registerForm" method="POST" action="proses_register.php">
            <div class="form-group">
                <input type="text" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" required>
            </div>
            
            <div class="form-group">
                <input type="text" name="nik" id="nik" placeholder="NIK (16 Digit)" required maxlength="16" pattern="[0-9]{16}">
            </div>
            
            <div class="form-group">
                <input type="tel" name="nomor_hp" id="nomor_hp" placeholder="Nomor Handphone" required pattern="[0-9]{10,15}">
            </div>
            
            <div class="form-group">
                <input type="text" name="alamat" id="alamat" placeholder="Alamat" required>
            </div>
            
            <div class="form-group">
                <input type="text" name="username" id="username" placeholder="Username" required>
            </div>
            
            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="Password" required minlength="6">
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-daftar">Daftar</button>
                <button type="reset" class="btn btn-reset">Reset</button>
            </div>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="login.php">Login disini</a>
        </div>
    </div>

    <script>
        // Validasi NIK (16 digit)
        document.getElementById('nik').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length > 16) {
                this.value = this.value.slice(0, 16);
            }
        });

        // Validasi nomor HP (hanya angka)
        document.getElementById('nomor_hp').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value.length > 15) {
                this.value = this.value.slice(0, 15);
            }
        });

        // Validasi form sebelum submit
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const namaLengkap = document.getElementById('nama_lengkap').value.trim();
            const nik = document.getElementById('nik').value.trim();
            const nomorHp = document.getElementById('nomor_hp').value.trim();
            const alamat = document.getElementById('alamat').value.trim();
            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value;

            // Reset error styling
            document.querySelectorAll('input').forEach(input => {
                input.classList.remove('input-error');
            });

            let errors = [];

            if (namaLengkap === '') {
                errors.push('Nama lengkap harus diisi');
                document.getElementById('nama_lengkap').classList.add('input-error');
            }

            if (nik.length !== 16) {
                errors.push('NIK harus 16 digit');
                document.getElementById('nik').classList.add('input-error');
            }

            if (nomorHp.length < 10) {
                errors.push('Nomor HP minimal 10 digit');
                document.getElementById('nomor_hp').classList.add('input-error');
            }

            if (alamat === '') {
                errors.push('Alamat harus diisi');
                document.getElementById('alamat').classList.add('input-error');
            }

            if (username.length < 4) {
                errors.push('Username minimal 4 karakter');
                document.getElementById('username').classList.add('input-error');
            }

            if (password.length < 6) {
                errors.push('Password minimal 6 karakter');
                document.getElementById('password').classList.add('input-error');
            }

            if (errors.length > 0) {
                e.preventDefault();
                showError(errors.join('<br>'));
            }
        });

        function showError(message) {
            const errorDiv = document.getElementById('errorMessage');
            errorDiv.innerHTML = message;
            errorDiv.classList.add('show');
            
            setTimeout(() => {
                errorDiv.classList.remove('show');
            }, 5000);
        }

        function showSuccess(message) {
            const successDiv = document.getElementById('successMessage');
            successDiv.innerHTML = message;
            successDiv.classList.add('show');
            
            setTimeout(() => {
                successDiv.classList.remove('show');
            }, 3000);
        }

        // Cek jika ada pesan dari URL
        const urlParams = new URLSearchParams(window.location.search);
        const error = urlParams.get('error');
        const success = urlParams.get('success');
        
        if (error) {
            if (error === 'empty') {
                showError('Semua field harus diisi!');
            } else if (error === 'nik_exists') {
                showError('NIK sudah terdaftar!');
                document.getElementById('nik').classList.add('input-error');
            } else if (error === 'username_exists') {
                showError('Username sudah digunakan!');
                document.getElementById('username').classList.add('input-error');
            } else if (error === 'nik_invalid') {
                showError('NIK harus 16 digit!');
                document.getElementById('nik').classList.add('input-error');
            } else if (error === 'failed') {
                showError('Registrasi gagal! Silakan coba lagi.');
            }
        }
        
        if (success === 'registered') {
            showSuccess('Registrasi berhasil! Silakan login.');
            setTimeout(() => {
                window.location.href = 'login.php';
            }, 2000);
        }
    </script>
</body>
</html>