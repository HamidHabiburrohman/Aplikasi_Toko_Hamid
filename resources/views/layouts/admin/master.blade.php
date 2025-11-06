<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Toko Drwya</title>
  
  <link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
  
  <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/custom-style.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/dataTables.bootstrap4.min.css') }}">
  
  <link rel="shortcut icon" href="{{ asset('landingpage/img/Logo.svg')}}" type="image/x-icon">
  
  @stack('styles')
</head>

<body>
  <div class="container-scroller">
    @include('layouts.admin.navbar')
    
    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        @include('layouts.admin.sidebar')
      </nav>
      
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')
        </div>
      </div>
    </div>
  </div>

  @stack('scripts')
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="{{ asset('admin/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('admin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('admin/vendors/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('admin/js/chart.js') }}"></script>
  <script src="{{ asset('admin/plugins/datatables.min.js') }}"></script>
  
  <script src="{{ asset('admin/js/off-canvas.js') }}"></script>
  <script src="{{ asset('admin/js/misc.js') }}"></script>
  <script src="{{ asset('admin/js/settings.js') }}"></script>
  <script src="{{ asset('admin/js/todolist.js') }}"></script>
  <script src="{{ asset('admin/js/jquery.cookie.js') }}"></script>
  <script src="{{ asset('admin/js/keuangan.js') }}"></script>
  
  <script src="{{ asset('admin/js/dashboard.js') }}"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const deleteButtons = document.querySelectorAll(".btn-danger");
      const swalRounded = Swal.mixin({
        customClass: {
          popup: "swal-rounded-popup",
          confirmButton: "swal-rounded-btn",
          cancelButton: "swal-rounded-btn"
        },
        buttonsStyling: true
      });

      deleteButtons.forEach((btn) => {
        btn.addEventListener("click", function(e) {
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

      const editMessage = @json(session('edit'));
      const createMessage = @json(session('create'));
      const succesLMessage = @json(session('succesL'));
      const sendMessage = @json(session('send'));
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
          text: sendMessage,
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