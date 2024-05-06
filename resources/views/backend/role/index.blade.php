@extends('backend.master')

@push('css')
@endpush

@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">Roles Manage</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class=" float-right">
                            <a href="{{ route('roles.create') }}" class="btn-shadow btn btn-sm btn-primary">
                                <i class="fa fa-plus-circle"></i>
                                Create
                            </a>
                        </ol>
                    </div>
                </div> <!-- end row -->
            </div>
            <!-- end page-title -->

            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center">#SL</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Permissions</th>
                                        <th class="text-center">Updated At</th>
                                        @if (Auth::user()->hasPermission('roles.edit') || Auth::user()->hasPermission('roles.destroy'))
                                        <th class="text-center">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach($roles as $key => $role)
                                    <tr>
                                        <td class="text-center text-muted">#{{ $key + 1 }}</td>
                                        <td class="text-center">{{ $role->name }}</td>
                                        <td class="text-center">
                                            @if($role->permissions->count() > 0)
                                            <span class="badge badge-info">{{ $role->permissions->count() }}</span>
                                            @else
                                            <span class="badge badge-warning">No permission found &#128546;</span>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $role->updated_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            @if (Auth::user()->hasPermission('roles.edit'))
                                            <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-success btn-sm" title="Edit">
                                                <i class="fa fa-edit"></i>
                                                <span>Edit</span>
                                            </a>
                                            @endif

                                            @if (Auth::user()->hasPermission('roles.destroy'))
                                            @if($role->deletable == true)
                                            <button type="button" onclick="deleteData({{ $role->id }})" class="btn btn-danger btn-sm" title="Delete">
                                                <i class="fa fa-trash-alt"></i>
                                                <span>Delete</span>
                                            </button>
                                            @endif

                                            <form id="delete-form-{{ $role->id }}" method="POST" action="{{ route('roles.destroy',$role->id) }}" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- content -->
@endsection

@push('js')
@endpush
