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
                                <th>Role</th>
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
                                        <span class="badge 
                                                    @if($s->role == 'admin') bg-danger
                                                    @elseif($s->role == 'kasir') bg-warning
                                                    @else bg-info @endif">
                                            {{ ucfirst($s->role) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($s->member)
                                            <button class="btn btn-warning btn-rounded btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editModal-{{ $s->id }}">
                                                Edit
                                            </button>
                                        @else
                                            <button class="btn btn-secondary btn-rounded btn-sm" disabled>
                                                No Data
                                            </button>
                                        @endif
                                        <form action="{{ route('admin.member.destroy', $s->id) }}" method="POST"
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
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modern-modal">
                <div class="modal-header align-items-center border-0 pb-0">
                    <h1 class="modal-title fs-5 fw-regular text-dark mb-0">Create Member</h1>
                    <button type="button" class="btn-close btn-modern-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.member.store') }}" method="POST" id="createForm">
                    @csrf
                    <div class="modal-body pt-3">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama member:</label>
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
                                <option value="member" {{ old('role') == 'member' ? 'selected' : '' }}>Member</option>
                                <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
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

    <!-- Edit Modals - Hanya buat modal untuk yang punya data member -->
    @foreach ($member as $m)
        @if($m->member)
            <div class="modal fade" id="editModal-{{ $m->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{ $m->id }}"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modern-modal">
                        <div class="modal-header align-items-center border-0 pb-0">
                            <h1 class="modal-title fs-5 fw-regular text-dark mb-0" id="editModalLabel-{{ $m->id }}">Edit Member</h1>
                            <button type="button" class="btn-close btn-modern-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.member.update', $m->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-body pt-3">
                                <div class="mb-3">
                                    <label for="edit_name_{{ $m->id }}" class="form-label text-muted fw-regular">Nama
                                        member:</label>
                                    <input type="text" class="form-control input-modern @error('name') is-invalid @enderror"
                                        id="edit_name_{{ $m->id }}" name="name" value="{{ old('name', $m->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="edit_email_{{ $m->id }}" class="form-label text-muted fw-regular">Email:</label>
                                    <input type="email" class="form-control input-modern @error('email') is-invalid @enderror"
                                        id="edit_email_{{ $m->id }}" name="email" value="{{ old('email', $m->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="edit_username_{{ $m->id }}"
                                        class="form-label text-muted fw-regular">Username:</label>
                                    <input type="text" class="form-control input-modern @error('username') is-invalid @enderror"
                                        id="edit_username_{{ $m->id }}" name="username"
                                        value="{{ old('username', $m->member->username) }}" required>
                                    @error('username')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="edit_telepon_{{ $m->id }}" class="form-label text-muted fw-regular">Telepon:</label>
                                    <input type="text" class="form-control input-modern @error('telepon') is-invalid @enderror"
                                        id="edit_telepon_{{ $m->id }}" name="telepon"
                                        value="{{ old('telepon', $m->member->telepon) }}" required>
                                    @error('telepon')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="edit_role_{{ $m->id }}" class="form-label text-muted fw-regular">Role:</label>
                                    <select name="role" class="form-control input-modern @error('role') is-invalid @enderror"
                                        id="edit_role_{{ $m->id }}" required>
                                        <option value="member" {{ old('role', $m->role) == 'member' ? 'selected' : '' }}>Member
                                        </option>
                                        <option value="kasir" {{ old('role', $m->role) == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                        <option value="admin" {{ old('role', $m->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="edit_password_{{ $m->id }}" class="form-label text-muted fw-regular">Password
                                        (kosongkan jika tidak diubah):</label>
                                    <input type="password" class="form-control input-modern @error('password') is-invalid @enderror"
                                        id="edit_password_{{ $m->id }}" name="password">
                                    @error('password')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="edit_password_confirmation_{{ $m->id }}"
                                        class="form-label text-muted fw-regular">Confirm Password:</label>
                                    <input type="password" class="form-control input-modern"
                                        id="edit_password_confirmation_{{ $m->id }}" name="password_confirmation">
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

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modern-modal">
                <div class="modal-header align-items-center border-0 pb-0">
                    <h1 class="modal-title fs-5 fw-regular text-dark mb-0">Confirm Delete</h1>
                    <button type="button" class="btn-close btn-modern-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
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
        // Delete Modal Handler
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');

                document.getElementById('deleteForm').action = `/admin/member/${id}`;
                document.getElementById('deleteMemberName').textContent = name;
                new bootstrap.Modal(document.getElementById('deleteModal')).show();
            });
        });

        // Initialize DataTable
        $(document).ready(function () {
            $('#memberTable').DataTable();
        });
    </script>
@endsection