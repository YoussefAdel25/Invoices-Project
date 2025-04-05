@extends('layouts.master')

@section('css')
<!--Internal Font Awesome -->
<link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<!--Internal Treeview -->
<link href="{{URL::asset('assets/plugins/treeview/treeview-rtl.css')}}" rel="stylesheet" type="text/css" />
@section('title')
تعديل الصلاحيات - مورا سوفت للادارة القانونية
@stop
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الصلاحيات</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل الصلاحيات</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>خطأ!</strong>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('roles.update', $role->id) }}" method="POST">
    @csrf
    @method('PATCH')

    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        <div class="form-group">
                            <p>اسم الصلاحية :</p>
                            <input type="text" name="name" value="{{ old('name', $role->name) }}" placeholder="اسم الصلاحية" class="form-control">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- تحديد الكل -->
                        <div class="col-lg-12">
                            <label>
                                <input type="checkbox" id="checkAll">
                                <strong>تحديد الكل</strong>
                            </label>
                            <hr>
                        </div>

                        @php
                            $groupedPermissions = $permission->groupBy(function($item) {
                                return explode(' ', $item->name)[0]; // تصنيف حسب أول كلمة في الاسم
                            });
                        @endphp

                        @foreach($groupedPermissions as $group => $permissions)
                        <div class="col-lg-4">
                            <div class="card p-3">
                                <h6 class="text-primary">{{ ucfirst($group) }}</h6>
                                <ul id="treeview1">
                                    @foreach($permissions as $value)
                                    <li>
                                        <label>
                                            <input type="checkbox" name="permission[]" value="{{ $value->id }}"
                                                class="permission-checkbox"
                                                {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                                            {{ $value->name }}
                                        </label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-main-primary">تحديث</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->

</form>
@endsection

@section('js')
<!-- Internal Treeview js -->
<script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>

<script>
    document.getElementById('checkAll').addEventListener('change', function () {
        let checkboxes = document.querySelectorAll('.permission-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
</script>
@endsection
