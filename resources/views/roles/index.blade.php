@extends('layouts.master')

@section('css')
    <!--Internal Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection

@section('title', 'صلاحيات المستخدمين - مورا سوفت للادارة القانونية')

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المستخدمين</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ صلاحيات المستخدمين</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')

@if(session('status'))
    <script>
        window.onload = function() {
            notif({
                msg: "{{ session('status') }}",
                type: "{{ session('type') }}"
            });
        }
    </script>
@endif

<!-- row -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            @can('اضافة صلاحية')
                                <a class="btn btn-primary btn-sm" href="{{ route('roles.create') }}">إضافة</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mg-b-0 text-md-nowrap table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @can('عرض صلاحية')
                                        <a class="btn btn-success btn-sm" href="{{ route('roles.show', $role->id) }}">عرض</a>
                                        @endcan

                                        @can('تعديل صلاحية')
                                            <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $role->id) }}">تعديل</a>
                                        @endcan

                                        @if ($role->name !== 'owner')
                                            @can('حذف صلاحية')
                                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟');">حذف</button>
                                                </form>
                                            @endcan
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $roles->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection

@section('js')
<!--Internal Notify js -->
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
