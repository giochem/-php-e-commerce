@extends('admin.layouts.template')
@section('page_title')
    Edit User - Ecommerce
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Page/</span> Edit User</h4>
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Edit User</h5>
                    <small class="text-muted float-end">Input information</small>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('updateuser') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $user_info->id }}" name="user_id">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="is_admin">Is Admin</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="is_admin" name="is_admin"
                                    value="{{ $user_info->is_admin }}" />
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update Category</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
