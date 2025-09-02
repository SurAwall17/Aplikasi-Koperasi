<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Koperasi dan UMKM</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Space+Grotesk&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.3.3/datatables.min.css" rel="stylesheet" integrity="sha384-MsFmJuPKkTT2RH+sHl3CS88wA7fFK6JQIUcxUWLkizshdCyYQ1LB6560OTAn6SIo" crossorigin="anonymous">
 

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <div class="container-fluid sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light border-bottom border-2 border-white">
                <a href="/" class="navbar-brand">
                    <img src="{{ asset('images/logo/logo.png') }}" class="w-25">
                </a>
                <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav d-flex align-items-center ms-auto">
                        <a href="/" class="nav-item nav-link {{ ($title == "Home")? "active" : "" }}">Home</a>
                        <a href="/pengajuan" class="nav-item nav-link {{ ($title == "Pengajuan")? "active" : "" }}">Pengajuan</a>
                        <a href="/notifikasi" class="nav-item nav-link {{ ($title == "Notifikasi")? "active" : "" }}">Notifikasi</a>
                        <a href="/about" class="nav-item nav-link {{ ($title == "About")? "active" : "" }}">About</a>
                        <a href="/contact" class="nav-item nav-link">Contact</a>
                        <div class="nav-item dropdown">
                            <a href="#!" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-person-circle"></i> {{ Auth()->user()->name }}</a>
                            <div class="dropdown-menu bg-light mt-2">
                                <a href="/testimonial" class="dropdown-item"><i class="bi bi-gear"></i> Settings</a>
                                <form action="/logout" method="post">
                                @csrf
                                    {{-- <a href="/logout" class="dropdown-item text-danger"><i class="bi bi-box-arrow-in-right"></i> Logout</a> --}}
                                    <button class="dropdown-item text-danger"><i class="bi bi-box-arrow-in-right"></i> Logout</button>
                                </form>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->