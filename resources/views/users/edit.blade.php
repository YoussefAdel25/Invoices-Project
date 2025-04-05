@extends('layouts.master')

@section('css')
<link href="{{ URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet" />
@endsection

@section('title', 'تعديل مستخدم - مورا سوفت للادارة القانونية')

@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المستخدمين</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل مستخدم</span>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        @if ($errors->any())
        <div class="alert alert-danger">
            <button class="close" data-dismiss="alert" type="button">&times;</button>
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
                <a class="btn btn-primary btn-sm mb-3" href="{{ route('users.index') }}">رجوع</a>

                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>اسم المستخدم: <span class="tx-danger">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>البريد الإلكتروني: <span class="tx-danger">*</span></label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>كلمة المرور:</label>
                            <input type="password" name="password" class="form-control" placeholder="اتركها فارغة إذا لم ترغب في التغيير">
                        </div>
                        <div class="col-md-6">
                            <label>تأكيد كلمة المرور:</label>
                            <input type="password" name="confirm-password" class="form-control" placeholder="اتركها فارغة إذا لم ترغب في التغيير">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label class="form-label">حالة المستخدم</label>
                            <select name="Status" class="form-control nice-select">
                                <option value="مفعل" {{ $user->Status == 'مفعل' ? 'selected' : '' }}>مفعل</option>
                                <option value="غير مفعل" {{ $user->Status == 'غير مفعل' ? 'selected' : '' }}>غير مفعل</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">صلاحية المستخدم</label>
                            <select name="roles[]" class="form-control" multiple>
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}" {{ in_array($role, $userRole) ? 'selected' : '' }}>
                                        {{ $role }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button class="btn btn-main-primary pd-x-20" type="submit">تحديث</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/parsleyjs/parsley.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/form-validation.js') }}"></script>
@endsection
