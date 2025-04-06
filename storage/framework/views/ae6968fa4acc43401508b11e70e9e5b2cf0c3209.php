<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تغير حالة
                    الدفع</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo e(route("Status_Update",['id'=>$invoices->id])); ?>" method="post" autocomplete="off">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label"></label>
                                <input type="hidden" name="invoice_id" value="<?php echo e($invoices->id); ?>">
                                <input type="text" name="invoice_number" id="invoice_number" class="form-control"
                                    title="" value="<?php echo e($invoices->invoice_number); ?>" readonly>
                            </div>

                            <div class="col">
                                <label for=""></label>
                                <input type="text" name="invoice_date" value="<?php echo e($invoices->invoice_date); ?>"
                                    class="form-control fc-datepicker" placeholder="YYYY-MM-DD" required readonly>
                            </div>

                            <div class="col">
                                <label for=""></label>
                                <input type="text" class="form-control fc-datepicker" name="due_date"
                                    value="<?php echo e($invoices->due_date); ?>" readonly required placeholder="YYYY-MM-DD">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label"></label>
                                <select name="section" id="section" class="form-control SelectBox"
                                    onclick="console.log($(this).val())" onchange="console.log('change is firing')"
                                    readonly>
                                    <option value="<?php echo e($invoices->section_id); ?>"><?php echo e($invoices->section->section_name); ?>

                                    </option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label"></label>
                                <select name="product" id="product" class="form-control" readonly required>
                                    <option value="<?php echo e($invoices->product); ?>"><?php echo e($invoices->product); ?></option>
                                </select>

                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label"></label>
                                <input type="text" class="form-control" id="inputName" name="Amount_collection"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="<?php echo e($invoices->Amount_collection); ?>" required readonly>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label"></label>
                                <input type="text" name="Amount_Commission" class="form-control form-control-lg"
                                    id="Amount_Commission"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="<?php echo e($invoices->Amount_Commission); ?>" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label"></label>
                                <input type="text" class="form-control form-control-lg" id="discount" name="discount"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="<?php echo e($invoices->discount); ?>" required readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label"></label>
                                <select type="text" id="rate_vat" name="rate_vat" class="form-control"
                                    onchange="myFunction()" readonly>
                                    <option value="<?php echo e($invoices->rate_vat); ?>"><?php echo e($invoices->rate_vat); ?></option>

                                </select>
                            </div>



                        </div>

                        <div class="row">
                            <div class="col">

                                <label for="inputName" class="control-label"></label>
                                <input type="text" name="value_rat" value="<?php echo e($invoices->value_rat); ?>"
                                    class="form-control" id="value_rat" readonly>

                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label"></label>
                                <input type="text" class="form-control" id="total" name="total"
                                    value="<?php echo e($invoices->total); ?>" readonly required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea"></label>
                                <textarea name="note" id="exampleTextarea" class="form-control" rows="3" readonly>
                                    <?php echo e($invoices->note); ?>

                                </textarea>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea"></label>
                                <select name="status" id="status" required class="form-control">
                                    <option selected="true" disabled="disabled">-- حدد حالة الدفع --</option>
                                    <option value="مدفوعة">مدفوعة</option>
                                    <option value="دفوعة جزئيا">مدفوعة جزئيا</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for=""></label>
                                <input type="text" class="form-control fc-datepicker" name="payment_date"
                                    placeholder="YYYY-MM-DD" required>
                            </div>
                        </div><br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">تحديث حالة الدفع</button>
                        </div>



                    </form>
                </div>
            </div>

        </div>

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(URL::asset('assets/plugins/select2/js/select2.min.js')); ?>"></script>
    <!--Internal  Form-elements js-->
    <script src="<?php echo e(URL::asset('assets/js/advanced-form-elements.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/select2.js')); ?>"></script>
    <!--Internal Sumoselect js-->
    <script src="<?php echo e(URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js')); ?>"></script>
    <!--Internal  Datepicker js -->
    <script src="<?php echo e(URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')); ?>"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="<?php echo e(URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')); ?>"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="<?php echo e(URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')); ?>"></script>
    <!-- Internal form-elements js -->
    <script src="<?php echo e(URL::asset('assets/js/form-elements.js')); ?>"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\invoices\resources\views/invoices/edit_status.blade.php ENDPATH**/ ?>