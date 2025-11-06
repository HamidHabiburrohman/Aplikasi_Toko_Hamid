@extends('layouts.admin.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card mt-5" style="margin: auto;">
        <div class="card" style="border-radius: 15px;">
            <div class="d-flex justify-content-between align-items-center mt-4 mx-4">
                <h1 class="fs-3 mb-0">Category Table</h1>
                <button class="btn btn-info btn-rounded" type="submit" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Create
                </button>
            </div>
            <div class="card-body">
                </p>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama user</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $s)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="font-weight-regular">{{ $s->name }}</td>
                                <td class="font-weight-regular">{{ $s->email }}</td>
                                <td class="font-weight-regular">{{ $s->role }}</td>
                                <td class="text-secondary font-weight-regular">
                                    <button class="btn btn-warning btn-rounded btn-sm type=" button" data-bs-toggle="modal"
                                        data-bs-target="#editModal-{{$s->id }}">Edit</button>
                                    <form action="{{ route('admin.pengguna.destroy', $s->id) }}" method="POST"
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


    <!-- Form create -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modern-modal">

                <div class="modal-header align-items-center border-0 pb-0">
                    <h1 class="modal-title fs-5 fw-regular text-dark mb-0" id="exampleModalLabel">
                        Create user
                    </h1>
                    <button type="btn" class="btn-close btn-modern-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <form action="{{ route('admin.pengguna.store') }}" method="POST">
                    @csrf
                    <div class="modal-body pt-3">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama user:</label>
                            <input type="text" id="name" name="name" class="form-control input-modern" value="{{ old('name') }}">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" id="email" name="email" class="form-control input-modern" value="{{ old('email') }}">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" id="password" name="password" class="form-control input-modern">
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role:</label>
                            <select id="role" name="role" class="form-select">
                                <option value="admin">Admin</option>
                                <option value="kasir">Kasir</option>
                                <option value="member">Member</option>
                            </select>
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
    <!-- Form create -->

    <!-- Form edit -->
    @foreach ($users as $s)
        <div class="modal fade" id="editModal-{{$s->id }}" tabindex="-1" aria-labelledby="editModalLabel-{{$s->id }}"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modern-modal">

                    <div class="modal-header align-items-center border-0 pb-0">
                        <h1 class="modal-title fs-5 fw-regular text-dark mb-0" id="editModalLabel-{{$s->id }}">
                            Edit User
                        </h1>
                        <button type="button" class="btn-close btn-modern-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <form action="{{ route('admin.pengguna.update', $s->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body pt-3">
                            <div class="mb-3">
                                <label for="name{{$s->id }}" class="form-label text-muted fw-regular">
                                    Nama user:
                                </label>
                                <input type="text" class="form-control input-modern @error('name') is-invalid @enderror"
                                    id="name{{$s->id }}" name="name" value="{{ old('name', $s->name) }}">
                                @error('name')
                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email{{ $s->id }}" class="form-label text-muted fw-regular">
                                    Email:
                                </label>
                                <input type="email" class="form-control input-modern @error('email') is-invalid @enderror"
                                    id="email{{$s->id }}" name="email" value="{{ old('email', $s->email) }}">
                                @error('email')
                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password{{$s->id }}" class="form-label text-muted fw-regular">
                                    Password:
                                </label>
                                <input type="password" class="form-control input-modern @error('password') is-invalid @enderror"
                                    id="password{{$s->id }}" name="password" value="{{ old('password', $s->password) }}">
                                @error('password')
                                    <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                @enderror
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
    @endforeach
    <!-- Form edit -->
@endsection