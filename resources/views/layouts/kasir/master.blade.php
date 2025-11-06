<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Toko Drwya</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/font-awesome/css/font-awesome.min.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('admin/vendors/font-awesome/css/font-awesome.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/custom-style.css') }}">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{ asset('landingpage/img/Logo.svg')}}" type="image/x-icon">
  @stack('styles')
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('layouts.kasir.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">

        @include('layouts.kasir.sidebar')

      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')
        </div>
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  @stack('scripts')
  <script src="{{ asset('admin/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ asset('admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('admin/js/chart.js') }}"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('admin/js/off-canvas.js') }}"></script>
  <script src="{{ asset('admin/js/misc.js') }}"></script>
  <script src="{{ asset('admin/js/settings.js') }}"></script>
  <script src="{{ asset('admin/js/todolist.js') }}"></script>
  <script src="{{ asset('admin/js/jquery.cookie.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="{{ asset('admin/js/dashboard.js') }}"></script>
  <!-- End custom js for this page -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const deleteButtons = document.querySelectorAll(".btn-danger");

      // MIXIN INI DIBUAT UNTUK MEMBANTU STYLING GLOBAL PADA TOMBOL
      const swalRounded = Swal.mixin({
        customClass: {
          popup: "swal-rounded-popup",
          confirmButton: "swal-rounded-btn",
          cancelButton: "swal-rounded-btn"
        },
        buttonsStyling: true
      });

      deleteButtons.forEach((btn) => {
        btn.addEventListener("click", function (e) {
          e.preventDefault();
          const form = this.closest("form");

          swalRounded.fire({
            title: "Beneran di hapus nih?",
            text: "Kamu gak bisa ngembaliin lagi nih",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Tidak, batalin!",
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
              form.submit();
              swalRounded.fire({
                title: "Terhapus!",
                text: "Data berhasil di hapus",
                icon: "success"
              });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
              swalRounded.fire({
                title: "Dibatalkan",
                text: "Data kamu aman :)",
                icon: "error"
              });
            }
          });
        });
      });

      // Bagian Alert Sukses/Error (Setelah Hapus/Edit/Create)
      const editMessage = @json(session('edit'));
      const createMessage = @json(session('create'));
      const succesLMessage = @json(session('succesL'));
      const sendMessage = @json(session('send'));

      // DEFINISIKAN KELAS KUSTOM UNTUK PESAN SUKSES
      const customRounded = { popup: "swal-rounded-popup", confirmButton: "swal-rounded-btn" };


      if (editMessage) {
        Swal.fire({
          title: "Data berhasil di edit",
          text: editMessage,
          icon: "success",
          confirmButtonText: "OK",
          customClass: customRounded
        });
      }

      if (createMessage) {
        Swal.fire({
          title: "Data di tambahkan",
          text: createMessage,
          icon: "success",
          confirmButtonText: "OK",
          customClass: customRounded
        });
      }

      if (succesLMessage) {
        Swal.fire({
          title: "Berhasil login",
          text: succesLMessage,
          icon: "success",
          confirmButtonText: "OK",
          customClass: customRounded
        });
      }

      if (sendMessage) {
        Swal.fire({
          title: "Pesan berhasil dikirim!",
          text: succesLMessage,
          icon: "success",
          confirmButtonText: "OK",
          customClass: customRounded
        });
      }
    });
  </script>
  <style>
    .swal-rounded-popup {
      border-radius: 25px !important;
    }

    .swal-rounded-btn {
      border-radius: 12px !important;
    }
  </style>
</body>

</html>