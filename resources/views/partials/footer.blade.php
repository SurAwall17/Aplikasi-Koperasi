
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer pt-5">
    <div class="container py-5">
        <div class="row g-5">
            
            <!-- Tentang Koperasi -->
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                <a href="/" class="d-inline-block mb-3">
                    <h1 class="text-white">Koperasi Digital</h1>
                </a>
                <p class="mb-0">
                    Koperasi modern berbasis teknologi untuk memudahkan anggota dalam 
                    mengakses layanan keuangan, pengajuan dokumen, laporan transparan, 
                    dan informasi terkini melalui aplikasi digital.
                </p>
            </div>

            <!-- Kontak -->
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                <h5 class="text-white mb-4">Kontak Kami</h5>
                <p><i class="fa fa-map-marker-alt me-3"></i>Jl. Merdeka No.123, Jakarta, Indonesia</p>
                <p><i class="fa fa-phone-alt me-3"></i>+62 812 3456 7890</p>
                <p><i class="fa fa-envelope me-3"></i>info@koperasidigital.id</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-outline-primary btn-square border-2 me-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-primary btn-square border-2 me-2" href="#!"><i class="fab fa-instagram"></i></a>
                    <a class="btn btn-outline-primary btn-square border-2 me-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <!-- Link Cepat -->
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.5s">
                <h5 class="text-white mb-4">Link Cepat</h5>
                <a class="btn btn-link" href="#!">Tentang Kami</a>
                <a class="btn btn-link" href="#!">Layanan</a>
                <a class="btn btn-link" href="#!">Berita</a>
                <a class="btn btn-link" href="#!">Kontak</a>
                <a class="btn btn-link" href="#!">FAQ</a>
            </div>

            <!-- Layanan Koperasi -->
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
                <h5 class="text-white mb-4">Layanan Kami</h5>
                <a class="btn btn-link" href="#!">Manajemen Anggota</a>
                <a class="btn btn-link" href="#!">Pengajuan Dokumen</a>
                <a class="btn btn-link" href="#!">Laporan Keuangan</a>
                <a class="btn btn-link" href="#!">Transaksi Digital</a>
                <a class="btn btn-link" href="#!">Akses via Aplikasi</a>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="container wow fadeIn" data-wow-delay="0.1s">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="#!">Koperasi Digital</a>, All Rights Reserved.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="footer-menu">
                        <a href="#!">Home</a>
                        <a href="#!">Kebijakan Privasi</a>
                        <a href="#!">Syarat & Ketentuan</a>
                        <a href="#!">Bantuan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#!" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.3.3/datatables.min.js" integrity="sha384-TPbfnwPjOXla/xgRKrdEJc3CxsVpmUvo8H8FYUEdxCuZwGuinMchFsj6FCtCd5vU" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                title: "Berhasil!",
                text: "{{ session('success') }}",
                icon: "success",
                draggable: true
            });
        </script>
    @endif

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form dengan id tertentu
                    document.getElementById('form-' + id).submit();
                }
            });
        }

        </script>

</body>

</html>