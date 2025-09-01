<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Form</title>
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

  <div class="card shadow-lg px-4 py-2 rounded-4" style="max-width: 400px; width: 100%;">
    <div class="text-center mb-1">
        <img src="{{ asset('images/logo/logo.jpeg') }}" alt="Logo" class="mb-2" style="width: 80px; height: 80px;">
        <h4>Register Akun</h4>
        <p class="text-muted">Silakan isi data diri Anda untuk membuat akun baru</p>
    </div>



    <form method="post" action="/register">
        @csrf
      <!-- NIK -->
      <div class="mb-3 input-group">
        <span class="input-group-text bg-white"><i class="bi bi-credit-card-2-front"></i></span>
        <input type="text" name="nik" class="form-control" placeholder="NIK" required>
      </div>

      <!-- Name -->
      <div class="mb-3 input-group">
        <span class="input-group-text bg-white"><i class="bi bi-person"></i></span>
        <input type="text" name="name" class="form-control" placeholder="Full Name" required>
      </div>

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

       <!-- Retype Password -->
      <div class="mb-3">
        {{-- <label for="retypePassword" class="form-label">Retype Password</label> --}}
        <div class="input-group">
          <span class="input-group-text bg-white"><i class="bi bi-lock"></i></span>
          <input type="password" name="password_confirmation" class="form-control" id="retypePassword" placeholder="Retype password" required>
          <span class="input-group-text bg-white" onclick="togglePassword('retypePassword', this)" style="cursor: pointer;">
            <i class="bi bi-eye"></i>
          </span>
        </div>
      </div>

      <!-- Button -->
      <button type="submit" class="btn btn-primary w-100 mb-3">Register</button>

      <!-- Login Link -->
      <p class="text-center mb-0">
        Already have an account? <a href="/login" class="text-decoration-none">Login</a>
      </p>
    </form>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
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
