@extends('backend.master')

@push('css')
@endpush

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <ol class="d-flex justify-content-between">
                            <div style="font-size: 1.25rem;">{{ @$role? 'Edit Role' : 'Create Role' }}</div>
                            <a href="{{ route('roles.index') }}" class="float-right btn-shadow mr-3 btn btn-danger">
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
                        <form method="POST" action="{{ isset($role) ? route('roles.update',$role->id) : route('roles.store') }}">
                            @csrf

                            @isset($role)
                                @method('PUT')
                            @endisset
                            <div class="card-body">
                                <h5 class="card-title">Manage Roles</h5>

                                <div class="form-group">
                                    <label for="name">Role Name</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $role->name ?? old('name') }}" placeholder="Enter role name"  autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="text-center mb-2">
                                    <strong>Manage permissions for role</strong>

                                    @error('permissions')
                                        <p class="p-2">
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        </p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="select-all">
                                        <label class="custom-control-label" for="select-all">Select All</label>
                                    </div>
                                </div>

                                @forelse($modules->chunk(2) as $key=>$chunks)
                                    <div class="form-row">
                                        @foreach($chunks as $key => $module)
                                            <div class="col">
                                                <h5>Module: {{ $module->name }}</h5>

                                                @foreach($module->permissions as $key => $permission)
                                                    <div class="mb-3 ml-4">
                                                        <div class="custom-control custom-checkbox mb-2">
                                                            <input type="checkbox" class="custom-control-input"  id="permission-{{ $permission->id }}"
                                                            name="permissions[]" value="{{ $permission->id }}"

                                                            @isset($role)
                                                                @foreach($role->permissions as $rPermission)
                                                                    {{ $permission->id == $rPermission->id ? 'checked' : '' }}
                                                                @endforeach
                                                            @endisset

                                                            >

                                                            <label for="permission-{{ $permission->id }}" class="custom-control-label">{{ $permission->name }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                @empty
                                    <div class="row">
                                        <div class="col text-center">
                                            <strong>No module found.</strong>
                                        </div>
                                    </div>
                                @endforelse

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa {{ @$role? 'fa-arrow-circle-up' : 'fa-plus-circle' }}"></i>
                                        <span>{{ @$role? 'Update Role' : 'Save Role' }}</span>
                                    </button>
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
    <script>
        $('#select-all').click(function (event){

            if (this.checked) {
                $(':checkbox').each(function(){
                    this.checked = true;
                });

            } else {
                $(':checkbox').each(function(){
                    this.checked = false;
                });
            }
        });
    </script>
@endpush
