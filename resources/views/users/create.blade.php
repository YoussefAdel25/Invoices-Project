@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{ URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet" />
@section('title')
اضافة مستخدم - مورا سوفت للادارة القانونية
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافة مستخدم</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">
        @if ($errors->any())
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>خطأ</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}">رجوع</a>
                    </div>
                </div><br>
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="row mg-b-20">
                        <div class="col-md-6">
                            <label>اسم المستخدم: <span class="tx-danger">*</span></label>
                            <input class="form-control" name="name" required type="text">
                        </div>
                        <div class="col-md-6">
                            <label>البريد الإلكتروني: <span class="tx-danger">*</span></label>
                            <input class="form-control" name="email" required type="email">
                        </div>
                    </div>
                    <div class="row mg-b-20">
                        <div class="col-md-6">
                            <label>كلمة المرور: <span class="tx-danger">*</span></label>
                            <input class="form-control" name="password" required type="password">
                        </div>
                        <div class="col-md-6">
                            <label>تأكيد كلمة المرور: <span class="tx-danger">*</span></label>
                            <input class="form-control" name="password_confirmation" required type="password">
                        </div>
                    </div>
                    <div class="row mg-b-20">
                        <div class="col-lg-6">
                            <label class="form-label">حالة المستخدم</label>
                            <select name="status" class="form-control nice-select custom-select">
                                <option value="مفعل">مفعل</option>
                                <option value="غير مفعل">غير مفعل</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mg-b-20">
                        <div class="col-md-12">
                            <label class="form-label">صلاحية المستخدم</label>
                            <select name="roles[]" class="form-control" multiple>
                                @foreach($roles as $role)
                                    <option value="{{ $role }}" {{ in_array($role, old('roles', [])) ? 'selected' : '' }}>
                                        {{ $role }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-main-primary pd-x-20" type="submit">تأكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<!-- Internal Nice-select js-->
<script src="{{ URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js') }}"></script>
<!--Internal Parsley.min js -->
<script src="{{ URL::asset('assets/plugins/parsleyjs/parsley.min.js') }}"></script>
<!-- Internal Form-validation js -->
<script src="{{ URL::asset('assets/js/form-validation.js') }}"></script>
@endsection
