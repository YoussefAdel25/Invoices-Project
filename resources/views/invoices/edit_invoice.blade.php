@extends('layouts.master')


@section('title')
    تعديل فاتورة
@stop
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل
                    الفاتورة</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

@if (session()->has('edit'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('edit') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif


    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ url('invoices/update') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        {{ method_field('patch') }}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">رقم الفاتورة</label>
                                <input type="hidden" name="invoice_id" value="{{ $invoices->id }}">
                                <input type="text" class="form-control" id="inputName" name="invoice_number"
                                    value="{{ $invoices->invoice_number }}" title="يرجي ادخال رقم الفاتورة">
                            </div>

                            <div class="col">
                                <label>تاريخ الفاتورة</label>
                                <input type="text" name="invoice_date" class="form-control fc-datepicker"
                                    placeholder="YYYY-MM-DD" value="{{ $invoices->invoice_date }}" required>
                            </div>

                            <div class="col">
                                <label for="">تاريخ الاستحقاق</label>
                                <input type="text" class="form-control fc-datepicker" placeholder="YYYY-MM-DD"
                                    name="due_date" value="{{ $invoices->due_date }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">القسم</label>
                                <select name="section" class="form-control SlectBox" onclick="console.log($(this).val())"
                                onchange="console.log('change is firing')">
                                   value="{{ $invoices->section->id }}">{{ $invoices->section->section_name }}

                                        @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">  {{ $section->section_name }}
                                        </option>
                                        @endforeach
                                </select>

                            </div>

                            <div class="col">
                                <label for="inputName" class="label-control">المنتج</label>
                                <select name="product" id="product" class="form-control">
                                    <option value="{{ $invoices->product }}">{{ $invoices->product }}</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">مبلغ التحصيل</label>
                                <input type="text" class="form-control" id="inputName" name="Amount_collection"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoices->Amount_collection }}">
                            </div>
                        </div>


                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">مبلغ العمولة</label>
                                <input type="text" class="form-control form-control-lg" id="Amount_Commission"
                                    name="Amount_Commission" title="يرجي ادخال مبلغ العمولة "
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoices->Amount_Commission }}" required>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">الخصم</label>
                                <input type="text" class="form-control form-control-lg" id="Discount" name="Discount"
                                    title="يرجي ادخال مبلغ الخصم "
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoices->discount }}" required>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                <select name="Rate_VAT" id="Rate_VAT" class="form-control" onchange="myFunction()">
                                    <!--placeholder-->
                                    <option value=" {{ $invoices->rate_vat }}">
                                        {{ $invoices->rate_vat }}
                                    <option value=" 5%">5%</option>
                                    <option value="10%">10%</option>
                                </select>
                            </div>

                        </div>


                          <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                <input type="text" class="form-control" id="Value_VAT" name="Value_VAT"
                                    value="{{ $invoices->value_rat }}" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                                <input type="text" class="form-control" id="Total" name="Total" readonly
                                    value="{{ $invoices->total }}">
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3">{{ $invoices->note }}</textarea>
                            </div>
                        </div>
                        <br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">حقظ البيانات</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal Fileuploads js-->
<script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
<!--Internal Fancy uploader js-->
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
<!--Internal  Form-elements js-->
<script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
<script src="{{ URL::asset('assets/js/select2.js') }}"></script>
<!--Internal Sumoselect js-->
<script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>


<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();

</script>


<script>
    $('select[name="section"]').on('change', function() {
        var SectionId = $(this).val();
        if (SectionId) {
            $.ajax({
                url: "/section/" + SectionId, // تأكد من صحة الرابط
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log("Products received:", data); // تحقق من البيانات في الكونسول
                    var productSelect = $('select[name="product"]');
                    productSelect.empty();
                    if (Object.keys(data).length > 0) {
                        $.each(data, function(key, value) {
                            productSelect.append('<option value="' + value + '">' + value + '</option>');
                        });
                    } else {
                        productSelect.append('<option value="" disabled>لا توجد منتجات</option>');
                    }
                },
                error: function(xhr) {
                    console.error("Error fetching products:", xhr);
                }
            });
        }
    });


    </script>



<script>
    function myFunction() {

        var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
        var Discount = parseFloat(document.getElementById("Discount").value);
        var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
        var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);

        var Amount_Commission2 = Amount_Commission - Discount;


        if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {

            alert('يرجي ادخال مبلغ العمولة ');

        } else {
            var intResults = Amount_Commission2 * Rate_VAT / 100;

            var intResults2 = parseFloat(intResults + Amount_Commission2);

            sumq = parseFloat(intResults).toFixed(2);

            sumt = parseFloat(intResults2).toFixed(2);

            document.getElementById("Value_VAT").value = sumq;

            document.getElementById("Total").value = sumt;

        }

    }

</script>


@endsection
