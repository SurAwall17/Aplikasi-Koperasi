<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

  <div class="card shadow-lg px-4 py-3 rounded-4" style="max-width: 400px; width: 100%;">
    <div class="text-center mb-1">
        <img src="{{ asset('images/logo/logo.jpeg') }}" alt="Logo" class="mb-2" style="width: 80px; height: 80px;">
        <h4>Login Akun</h4>
        <p class="text-muted">Silakan isi username dan password untuk login</p>
    </div>
    <form method="post" action="/login">
      @csrf
      @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Register Berhasil!</strong> Silahkan login.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
      @endif

      <!-- Email -->
      <div class="mb-3 input-group">
        <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
        <input type="email" name="email" class="form-control" placeholder="Email" required>
      </div>

      <!-- Password -->
      <div class="mb-3 input-group">
        <span class="input-group-text bg-white"><i class="bi bi-lock"></i></span>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
        <span class="input-group-text bg-white" onclick="togglePassword()" style="cursor: pointer;">
          <i class="bi bi-eye" id="toggleIcon"></i>
        </span>
      </div>

      <!-- Forgot Password -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="rememberMe">
          <label class="form-check-label" for="rememberMe">Remember Me</label>
        </div>
        <a href="#" class="text-decoration-none">Forgot Password?</a>
      </div>


      <!-- Button -->
      <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>

      <!-- Register Link -->
      <p class="text-center mb-0">Don't have an account? <a href="/register" class="text-decoration-none">Register</a></p>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Cek cookie saat halaman load
    window.onload = function() {
      const savedEmail = getCookie("email");
      if (savedEmail) {
        document.getElementById("email").value = savedEmail;
        document.getElementById("rememberMe").checked = true;
      }
    }

    // Saat submit form
    document.getElementById("loginForm").addEventListener("submit", function(event) {
      event.preventDefault();
      const email = document.getElementById("email").value;
      const remember = document.getElementById("rememberMe").checked;

      if (remember) {
        setCookie("email", email, 7); // Simpan email 7 hari
      } else {
        setCookie("email", "", -1); // Hapus cookie
      }

      alert("Login Berhasil! (Cookie diset jika Remember Me dicentang)");
    });

    // Fungsi set cookie
    function setCookie(name, value, days) {
      let expires = "";
      if (days) {
        const date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
      }
      document.cookie = name + "=" + (value || "")  + expires + "; path=/";
    }

    // Fungsi get cookie
    function getCookie(name) {
      const nameEQ = name + "=";
      const ca = document.cookie.split(';');
      for(let i=0;i < ca.length;i++) {
        let c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
      }
      return null;
    }


    function togglePassword() {
      const password = document.getElementById("password");
      const toggleIcon = document.getElementById("toggleIcon");

      if (password.type === "password") {
        password.type = "text";
        toggleIcon.classList.remove("bi-eye");
        toggleIcon.classList.add("bi-eye-slash");
      } else {
        password.type = "password";
        toggleIcon.classList.remove("bi-eye-slash");
        toggleIcon.classList.add("bi-eye");
      }
    }
  </script>
  

</body>
</html>
