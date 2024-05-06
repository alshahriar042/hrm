@extends('backend.master')

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" rel="stylesheet">
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <ol class="d-flex justify-content-between">
                            <div style="font-size: 1.25rem;">{{ @$user ? 'Edit User' : 'Create User' }}</div>
                            <a href="{{ route('users.index') }}" class="float-right btn-shadow mr-3 btn btn-danger">
                                <i class="fa fa-arrow-circle-left"></i>
                                <span>Back to list</span>
                            </a>
                        </ol>
                    </div>
                </div> <!-- end row -->
            </div>
            <!-- end page-title -->

            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card" style="padding: 10px;">
                        <form method="POST"
                            action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            @isset($user)
                                @method('PUT')
                            @endisset
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="main-card mb-3 card shadow" style="padding: 10px;">
                                        <div class="card-body">
                                            <h5 class="card-title">User Info</h5>

                                            <div class="form-group">
                                                <label for="name">Name <sup class="text-danger">*</sup></label>
                                                <input id="name" type="text"
                                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                                    value="{{ $user->name ?? old('name') }}" placeholder="Enter user name"
                                                    autofocus>

                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email <sup class="text-danger">*</sup></label>
                                                <input id="email" type="text"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ $user->email ?? old('email') }}"
                                                    placeholder="Enter user email" autofocus>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Password <sup class="text-danger">*</sup></label>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" placeholder="Enter user password" autofocus>

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="confirm_password">Confirm Password <sup
                                                        class="text-danger">*</sup></label>
                                                <input id="confirm_password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password_confirmation" placeholder="Re-Type password" autofocus>

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="phone">Phone <sup class="text-danger">*</sup></label>
                                                    <input id="phone" type="text"
                                                        class="form-control @error('phone') is-invalid @enderror"
                                                        name="phone" value="{{ $user->phone ?? old('phone') }}"
                                                        placeholder="Enter user phone" autofocus>

                                                    @error('phone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="address">Address <sup class="text-danger">*</sup></label>
                                                    <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="" cols="30"
                                                        rows="5" placeholder="Type here...">{{ old('address') ?? @$user->address }}</textarea>

                                                    @error('address')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="phone">Department <sup
                                                            class="text-danger">*</sup></label>
                                                    <select id="department"
                                                        class="form-control select2 @error('department') is-invalid @enderror"
                                                        name="department" autofocus>
                                                        <option value="">Select department</option>
                                                        @foreach ($departments as $department)
                                                            <option value="{{ $department->id }}"
                                                                {{ @$user->department->id == $department->id ? 'selected' : '' }}>
                                                                {{ $department->name }}</option>
                                                        @endforeach
                                                    </select>

                                                    @error('phone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="designation">Designation <sup
                                                            class="text-danger">*</sup></label>
                                                    <input id="designation" type="text"
                                                        class="form-control @error('designation') is-invalid @enderror"
                                                        name="designation"
                                                        value="{{ @$user->designation ?? old('designation') }}"
                                                        placeholder="Enter user designation" autofocus>
                                                    @error('designation')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="main-card mb-3 card shadow" style="padding: 10px;">
                                        <div class="card-body">
                                            <h5 class="card-title">Select Roles and Others</h5>

                                            <div class="form-group">
                                                <label for="role">Role <sup class="text-danger">*</sup></label>
                                                <select id="role"
                                                    class="form-control select2 @error('role') is-invalid @enderror"
                                                    name="role" autofocus>
                                                    <option value="">Select role</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}"
                                                            {{ @$user->role->id == $role->id ? 'selected' : '' }}>
                                                            {{ $role->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('role')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="employee_id">Employee ID<sup
                                                        class="text-danger">*</sup></label>
                                                <input id="employee_id" type="text"
                                                    class="form-control @error('employee_id') is-invalid @enderror"
                                                    name="employee_id"
                                                    value="{{ @$user->employee_id ?? old('employee_id') }}"
                                                    placeholder="Enter employee ID" autofocus>

                                                @error('employee_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="joining_date">Joining Date<sup
                                                        class="text-danger">*</sup></label>
                                                <input id="joining_date" type="date"
                                                    class="form-control @error('joining_date') is-invalid @enderror"
                                                    name="joining_date"
                                                    value="{{ @$user->joining_date ?? old('joining_date') }}" autofocus>

                                                @error('joining_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="blood_group">Blood Group<sup
                                                        class="text-danger">*</sup></label>
                                                <select id="blood_group"
                                                    class="form-control select2 @error('blood_group') is-invalid @enderror"
                                                    name="blood_group" autofocus>
                                                    <option value="">Select blood group</option>
                                                    <option value="A+" {{ @$user->blood_group == 'A+' ? 'selected' : '' }}>A+</option>
                                                    <option value="A-" {{ @$user->blood_group == 'A-' ? 'selected' : '' }}>A-</option>
                                                    <option value="B+" {{ @$user->blood_group == 'B+' ? 'selected' : '' }}>B+</option>
                                                    <option value="B-" {{ @$user->blood_group == 'B-' ? 'selected' : '' }}>B-</option>
                                                    <option value="O+" {{ @$user->blood_group == 'O+' ? 'selected' : '' }}>O+</option>
                                                    <option value="O-" {{ @$user->blood_group == 'O-' ? 'selected' : '' }}>O-</option>
                                                    <option value="AB+" {{ @$user->blood_group == 'AB+' ? 'selected' : '' }}>AB+</option>
                                                    <option value="AB-" {{ @$user->blood_group == 'AB-' ? 'selected' : '' }}>AB-</option>
                                                </select>

                                                @error('blood_group')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="avatar">Avatar <sup class="text-danger">*</sup></label>
                                                <input id="avatar" type="file"
                                                    class="dropify form-control @error('avatar') is-invalid @enderror"
                                                    name="avatar" data-height="165" autofocus
                                                    data-default-file="{{ @$user->avatar != null ? asset('upload/user_images/' . @$user->avatar) : '' }}">

                                                @error('avatar')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" name="status"
                                                        id="status" {{ @$user->status == true ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="status">Status</label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">
                                                    <i
                                                        class="fa {{ @$user ? 'fa-arrow-circle-up' : 'fa-plus-circle' }}"></i>
                                                    <span>{{ @$user ? 'Update User' : 'Save User' }}</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify();
    </script>
@endpush
