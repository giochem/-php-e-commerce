@extends('admin.layouts.template')
@section('page_title')
    All User - Ecommerce
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Page/</span> All User</h4>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="card">
            <h5 class="card-header">User Infomation</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th style="display:none;">Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>is_admin</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($users as $user)
                            <tr>
                                <td style="display:none;">{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->is_admin }}</td>
                                <td>
                                    <a href="{{ route('edituser', $user->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ route('deleteuser', $user->id) }}" class="btn btn-warning">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
