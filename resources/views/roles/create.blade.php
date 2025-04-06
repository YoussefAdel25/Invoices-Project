@extends('layouts.master')

@section('css')
    <!--Internal Font Awesome -->
    <link href="{{ URL::asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!--Internal Treeview -->
    <link href="{{ URL::asset('assets/plugins/treeview/treeview-rtl.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('title', 'إضافة الصلاحيات - مورا سوفت للادارة القانونية')

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الصلاحيات</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ إضافة نوع مستخدم</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')

<!-- عرض الأخطاء إن وجدت -->
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

<!-- نموذج إضافة الصلاحية -->
<form action="{{ route('roles.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="name">اسم الصلاحية:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- قائمة الصلاحيات -->
                        <div class="col-lg-4">
                            <ul id="treeview1">
                                <li><a href="#">الصلاحيات</a>
                                    <ul>
                                        @foreach ($permission as $value)
                                            <li>
                                                <label style="font-size: 16px;">
                                                    <input type="checkbox" name="permission[]" value="{{ $value->id }}">
                                                    {{ $value->name }}
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!-- /col -->

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-main-primary">تأكيد</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('js')
    <!-- Internal Treeview js -->
    <script src="{{ URL::asset('assets/plugins/treeview/treeview.js') }}"></script>
@endsection
