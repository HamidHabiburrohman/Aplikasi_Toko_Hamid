@extends('layouts.admin.master')

@section('content')
<div class="col-lg-12 grid-margin stretch-card mt-5" style="margin: auto;">
    <div class="card" style="border-radius: 15px;">
        <div class="d-flex justify-content-between align-items-center mt-4 mx-4">
            <h1 class="fs-3 mb-0">Member Table</h1>
            <button class="btn btn-info btn-rounded" type="button" data-bs-toggle="modal" data-bs-target="#createModal">
                Create
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered" id="memberTable">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($member as $s)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $s->name }}</td>
                                <td>{{ $s->email }}</td>
                                <td>{{ $s->member->username ?? '-' }}</td>
                                <td>{{ $s->member->telepon ?? '-' }}</td>
                                <td>
                                    <button class="btn btn-warning btn-rounded btn-sm edit-btn" 
                                        data-id="{{ $s->id }}"
                                        data-name="{{ $s->name }}"
                                        data-email="{{ $s->email }}"
                                        data-username="{{ $s->member->username ?? '' }}"
                                        data-telepon="{{ $s->member->telepon ?? '' }}"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal">
                                        Edit
                                    </button>
                                    <button class="btn btn-danger btn-rounded btn-sm delete-btn" 
                                        data-id="{{ $s->id }}"
                                        data-name="{{ $s->name }}">
                                        Delete
                                    </button>
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
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modern-modal">
            <div class="modal-header align-items-center border-0 pb-0">
                <h1 class="modal-title fs-5 fw-regular text-dark mb-0">Create Member</h1>
                <button type="button" class="btn-close btn-modern-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.member.store') }}" method="POST" id="createForm">
                @csrf
                <div class="modal-body pt-3">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama member:</label>
                        <input type="text" id="name" name="name" class="form-control input-modern" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" id="email" name="email" class="form-control input-modern" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" id="username" name="username" class="form-control input-modern" value="{{ old('username') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">Telepon:</label>
                        <input type="text" id="telepon" name="telepon" class="form-control input-modern" value="{{ old('telepon') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" id="password" name="password" class="form-control input-modern" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password:</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control input-modern" required>
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

<!-- Edit Modal (Single Modal) -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modern-modal">
            <div class="modal-header align-items-center border-0 pb-0">
                <h1 class="modal-title fs-5 fw-regular text-dark mb-0">Edit Member</h1>
                <button type="button" class="btn-close btn-modern-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="editForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body pt-3">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label text-muted fw-regular">Nama member:</label>
                        <input type="text" class="form-control input-modern" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label text-muted fw-regular">Email:</label>
                        <input type="email" class="form-control input-modern" id="edit_email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_username" class="form-label text-muted fw-regular">Username:</label>
                        <input type="text" class="form-control input-modern" id="edit_username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_telepon" class="form-label text-muted fw-regular">Telepon:</label>
                        <input type="text" class="form-control input-modern" id="edit_telepon" name="telepon" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_password" class="form-label text-muted fw-regular">Password (kosongkan jika tidak diubah):</label>
                        <input type="password" class="form-control input-modern" id="edit_password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="edit_password_confirmation" class="form-label text-muted fw-regular">Confirm Password:</label>
                        <input type="password" class="form-control input-modern" id="edit_password_confirmation" name="password_confirmation">
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

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modern-modal">
            <div class="modal-header align-items-center border-0 pb-0">
                <h1 class="modal-title fs-5 fw-regular text-dark mb-0">Confirm Delete</h1>
                <button type="button" class="btn-close btn-modern-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3">
                <p>Are you sure you want to delete <strong id="deleteMemberName"></strong>?</p>
            </div>
            <div class="modal-footer d-flex justify-content-end align-items-center border-0 pt-0">
                <button type="button" class="button-modern button-cancel" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button-modern button-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Edit Modal Handler
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const email = this.getAttribute('data-email');
            const username = this.getAttribute('data-username');
            const telepon = this.getAttribute('data-telepon');

            document.getElementById('editForm').action = `/admin/member/${id}`;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_username').value = username;
            document.getElementById('edit_telepon').value = telepon;
        });
    });

    // Delete Modal Handler
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');

            document.getElementById('deleteForm').action = `/admin/member/${id}`;
            document.getElementById('deleteMemberName').textContent = name;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        });
    });

    // Initialize DataTable
    $(document).ready(function() {
        $('#memberTable').DataTable();
    });
</script>
@endsection