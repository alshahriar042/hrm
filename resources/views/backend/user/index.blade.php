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
                        <h4 class="page-title">Users Manage</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class=" float-right">
                            @if (Auth::user()->hasPermission('users.create'))
                            <a href="{{ route('users.create') }}" class="btn-shadow btn btn-sm btn-primary">
                                <i class="fa fa-plus-circle"></i>
                                Create
                            </a>
                            @endif
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
                                        <th class="text-center">E-mail</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Joined At</th>
                                        @if (Auth::user()->hasPermission('users.show') || Auth::user()->hasPermission('users.edit') || Auth::user()->hasPermission('users.destroy'))
                                        <th class="text-center">Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach($users as $key => $user)
                                        <tr>
                                            <td class="text-center text-muted">#{{ $key + 1 }}</td>
                                            <td>
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-3">
                                                            <div class="widget-content-left">
                                                                <img  width="40" class="rounded-circle"
                                                                src="{{ $user->avatar != null ? asset('upload/user_images/'.$user->avatar) : asset('backend/assets/images/placeholder.png') }}" alt="User Avatar">
                                                            </div>
                                                        </div>
                                                        <div class="widget-content-left flex2">
                                                            <div class="widget-heading">{{ $user->name }}</div>
                                                            <div class="widget-subheading opacity-7">
                                                                @if($user->role)
                                                                    <span class="badge badge-info">{{ $user->role->name }}</span>
                                                                @else
                                                                    <span class="badge badge-warning">No role found &#128546;</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">{{ $user->email }}</td>
                                            <td class="text-center">
                                                @if($user->status == true)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $user->created_at->diffForHumans() }}</td>
                                            <td class="text-center">
                                                @if (Auth::user()->hasPermission('users.show'))
                                                    @if ($user->role_id != 1)
                                                        <a href="{{ route('users.show',$user->id) }}" class="btn btn-primary btn-sm" title="Edit">
                                                            <i class="fa fa-eye"></i>
                                                            <span>Show</span>
                                                        </a>
                                                    @endif
                                                @endif

                                                @if (Auth::user()->hasPermission('users.edit'))
                                                    @if ($user->role_id != 1)
                                                        <a href="{{ route('users.edit',$user->id) }}" class="btn btn-success btn-sm" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                    @endif
                                                @endif

                                                {{-- @if (Auth::user()->hasPermission('users.destroy'))
                                                    @if ($user->role_id != 1)
                                                        <button type="button" onclick="deleteData({{ $user->id }})" class="btn btn-danger btn-sm" title="Delete">
                                                            <i class="fa fa-trash-alt"></i>
                                                            <span>Delete</span>
                                                        </button>
                                                    @endif
                                                @endif

                                                <form id="delete-form-{{ $user->id }}" method="POST" action="{{ route('users.destroy',$user->id) }}" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form> --}}
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
