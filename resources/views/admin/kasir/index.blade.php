@extends('layouts.admin.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card mt-5" style="margin: auto;">
        <div class="card" style="border-radius: 15px;">
            <div class="d-flex justify-content-between align-items-center mt-4 mx-4">
                <h1 class="fs-3 mb-0">Kasir Table</h1>
                <button class="btn btn-info btn-rounded" type="button" data-bs-toggle="modal" data-bs-target="#createModal">
                    Create
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="kasirTable">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Telepon</th>
                                <th>Role</th> <!-- ✅ TAMBAH KOLOM ROLE -->
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kasir as $s)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $s->name }}</td>
                                    <td>{{ $s->email }}</td>
                                    <td>{{ $s->kasir->username ?? '-' }}</td>
                                    <td>{{ $s->kasir->telepon ?? '-' }}</td>
                                    <td>
                                        <span class="badge 
                                        @if($s->role == 'admin') bg-danger
                                        @elseif($s->role == 'kasir') bg-warning
                                        @else bg-info @endif">
                                            {{ ucfirst($s->role) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($s->kasir)
                                            <button class="btn btn-warning btn-rounded btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editModal-{{ $s->id }}">
                                                Edit
                                            </button>
                                        @else
                                            <button class="btn btn-secondary btn-rounded btn-sm" disabled>
                                                No Data
                                            </button>
                                        @endif
                                        <form action="{{ route('admin.kasir.destroy', $s->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-rounded btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modern-modal">
                <div class="modal-header align-items-center border-0 pb-0">
                    <h1 class="modal-title fs-5 fw-regular text-dark mb-0">Create Kasir</h1>
                    <button type="button" class="btn-close btn-modern-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.kasir.store') }}" method="POST" id="createForm">
                    @csrf
                    <div class="modal-body pt-3">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama kasir:</label>
                            <input type="text" id="name" name="name"
                                class="form-control input-modern @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" id="email" name="email"
                                class="form-control input-modern @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" id="username" name="username"
                                class="form-control input-modern @error('username') is-invalid @enderror"
                                value="{{ old('username') }}" required>
                            @error('username')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon:</label>
                            <input type="text" id="telepon" name="telepon"
                                class="form-control input-modern @error('telepon') is-invalid @enderror"
                                value="{{ old('telepon') }}" required>
                            @error('telepon')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role:</label>
                            <select name="role" class="form-control input-modern @error('role') is-invalid @enderror"
                                required>
                                <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="member" {{ old('role') == 'member' ? 'selected' : '' }}>Member</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" id="password" name="password"
                                class="form-control input-modern @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password:</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                class="form-control input-modern" required>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-end align-items-center border-0 pt-0">
                        <button type="button" class="button-modern button-cancel" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="button-modern button-created">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modals -->
    @foreach ($kasir as $s)
        @if($s->kasir)
            <div class="modal fade" id="editModal-{{ $s->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $s->id }}"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modern-modal">
                        <div class="modal-header align-items-center border-0 pb-0">
                            <h1 class="modal-title fs-5 fw-regular text-dark mb-0" id="editModalLabel-{{ $s->id }}">
                                Edit Kasir
                            </h1>
                            <button type="button" class="btn-close btn-modern-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <form action="{{ route('admin.kasir.update', $s->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body pt-3">
                                <div class="mb-3">
                                    <label for="edit_name_{{ $s->id }}" class="form-label text-muted fw-regular">Nama kasir:</label>
                                    <input type="text" class="form-control input-modern @error('name') is-invalid @enderror"
                                        id="edit_name_{{ $s->id }}" name="name" value="{{ old('name', $s->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="edit_email_{{ $s->id }}" class="form-label text-muted fw-regular">Email:</label>
                                    <input type="email" class="form-control input-modern @error('email') is-invalid @enderror"
                                        id="edit_email_{{ $s->id }}" name="email" value="{{ old('email', $s->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="edit_username_{{ $s->id }}"
                                        class="form-label text-muted fw-regular">Username:</label>
                                    <input type="text" class="form-control input-modern @error('username') is-invalid @enderror"
                                        id="edit_username_{{ $s->id }}" name="username"
                                        value="{{ old('username', $s->kasir->username) }}" required>
                                    @error('username')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="edit_telepon_{{ $s->id }}" class="form-label text-muted fw-regular">Telepon:</label>
                                    <input type="text" class="form-control input-modern @error('telepon') is-invalid @enderror"
                                        id="edit_telepon_{{ $s->id }}" name="telepon"
                                        value="{{ old('telepon', $s->kasir->telepon) }}" required>
                                    @error('telepon')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="edit_role_{{ $s->id }}" class="form-label text-muted fw-regular">Role:</label>
                                    <select name="role" class="form-control input-modern @error('role') is-invalid @enderror"
                                        id="edit_role_{{ $s->id }}" required>
                                        <option value="kasir" {{ old('role', $s->role) == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                        <option value="admin" {{ old('role', $s->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="member" {{ old('role', $s->role) == 'member' ? 'selected' : '' }}>Member
                                        </option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="edit_password_{{ $s->id }}" class="form-label text-muted fw-regular">Password
                                        (kosongkan jika tidak diubah):</label>
                                    <input type="password" class="form-control input-modern @error('password') is-invalid @enderror"
                                        id="edit_password_{{ $s->id }}" name="password">
                                    @error('password')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="edit_password_confirmation_{{ $s->id }}"
                                        class="form-label text-muted fw-regular">Confirm Password:</label>
                                    <input type="password" class="form-control input-modern"
                                        id="edit_password_confirmation_{{ $s->id }}" name="password_confirmation">
                                </div>
                            </div>

                            <div class="modal-footer d-flex justify-content-end align-items-center border-0 pt-0">
                                <button type="button" class="button-modern button-cancel" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="button-modern button-update">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection

@section('scripts')
    <script>
        // Edit Modal Handler - PASTIKAN URLNYA BENAR
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const email = this.getAttribute('data-email');
                const username = this.getAttribute('data-username');
                const telepon = this.getAttribute('data-telepon');

                // Pastikan URL update sesuai dengan route
                document.getElementById('editForm').action = `{{ url('admin/kasir') }}/${id}`;
                document.getElementById('edit_name').value = name;
                document.getElementById('edit_email').value = email;
                document.getElementById('edit_username').value = username;
                document.getElementById('edit_telepon').value = telepon;

                // Reset password fields
                document.getElementById('edit_password').value = '';
                document.getElementById('edit_password_confirmation').value = '';
            });
        });

        // Delete Modal Handler - PASTIKAN URLNYA BENAR
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');

                document.getElementById('deleteForm').action = `{{ url('admin/kasir') }}/${id}`;
                document.getElementById('deleteKasirName').textContent = name;
                new bootstrap.Modal(document.getElementById('deleteModal')).show();
            });
        });

        // Initialize DataTable
        $(document).ready(function () {
            $('#kasirTable').DataTable({
                "pageLength": 10,
                "ordering": true,
                "searching": true,
                "language": {
                    "paginate": {
                        "previous": "<i class='fa fa-chevron-left'></i>",
                        "next": "<i class='fa fa-chevron-right'></i>"
                    },
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                    "infoFiltered": "(disaring dari _MAX_ total data)"
                }
            });
        });

        // SweetAlert untuk notifikasi
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    </script>
@endsection


@push('styles')
    <style>
        /* Modern Modal Styling */
        .modern-modal {
            border-radius: 15px;
            border: none;
        }

        .input-modern {
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            padding: 10px 15px;
        }

        .input-modern:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .button-modern {
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .button-cancel {
            background-color: #6c757d;
            color: white;
        }

        .button-cancel:hover {
            background-color: #5a6268;
        }

        .button-created {
            background-color: #28a745;
            color: white;
        }

        .button-created:hover {
            background-color: #218838;
        }

        .button-update {
            background-color: #ffc107;
            color: black;
        }

        .button-update:hover {
            background-color: #e0a800;
        }

        .button-danger {
            background-color: #dc3545;
            color: white;
        }

        .button-danger:hover {
            background-color: #c82333;
        }

        .btn-modern-close {
            background: none;
            border: none;
            font-size: 1.2rem;
            opacity: 0.7;
        }

        .btn-modern-close:hover {
            opacity: 1;
        }
    </style>


@endpush