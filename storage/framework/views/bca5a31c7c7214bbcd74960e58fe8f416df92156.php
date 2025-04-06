<?php $__env->startSection('title'); ?>
    لوحة التحكم - برنامج الفواتير
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <!--  Owl-carousel css-->
    <link href="<?php echo e(URL::asset('assets/plugins/owl-carousel/owl.carousel.css')); ?>" rel="stylesheet" />
    <!-- Maps css -->
    <link href="<?php echo e(URL::asset('assets/plugins/jqvmap/jqvmap.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">اهلا:<?php echo e(Auth::user()->name); ?></h2>
                
            </div>
        </div>

    </div>
    <!-- /breadcrumb -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-primary-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">اجمالي الفواتير</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">
                                    <?php echo e(number_format($sumInvoices)); ?>

                                </h4>
                               عدد الفواتير: <?php echo e($countInvoices); ?>

                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7">100%</span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-danger-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">الفواتير الغير مدفوعة</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h3 class="tx-20 font-weight-bold mb-1 text-white">

                                   <?php echo e(number_format($sumUnpaid)); ?>


                                </h3>
                                عدد الفواتير: <?php echo e($countUnpaid); ?>

                                </p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7">
                                    <?php echo e($percentageUnpaid); ?>%
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-success-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">الفواتير المدفوعة</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">

                                    <?php echo e(number_format($sumPaid)); ?>


                                </h4>
                                <p class="mb-0 tx-12 text-white op-7">
                                    عدد الفواتير: <?php echo e($countPaid); ?>

                                </p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7">
                                    <?php echo e($percentagePaid); ?>%

                                </span>
                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="card overflow-hidden sales-card bg-warning-gradient">
                <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                    <div class="">
                        <h6 class="mb-3 tx-12 text-white">الفواتير المدفوعة جزئيا</h6>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex">
                            <div class="">
                                <h4 class="tx-20 font-weight-bold mb-1 text-white">

<?php echo e(number_format($sumPartial)); ?>

                                </h4>
                                <p class="mb-0 tx-12 text-white op-7">
                                    عدد الفواتير: <?php echo e($countPartial); ?>


                                </p>
                            </div>
                            <span class="float-right my-auto mr-auto">
                                <i class="fas fa-arrow-circle-up text-white"></i>
                                <span class="text-white op-7">
                                    <?php echo e($percentagePartial); ?>%

                            </span>
                        </div>
                    </div>
                </div>
                <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
            </div>
        </div>
    </div>
    <!-- row closed -->

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-md-12 col-lg-12 col-xl-7">
            <div class="card">
                <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">نسبة احصائية الفواتير</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>

                </div>
                <div style="width: 50%;">
                    <?php echo $barChart->container(); ?>

                </div>
            </div>
        </div>


        <div class="col-lg-12 col-xl-5">
            <div class="card card-dashboard-map-one">
                <label class="main-content-label">نسبة احصائية الفواتير</label>
                <div style="width: 50%;">
                    <?php echo $pieChart->container(); ?>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    </div>
    <!-- Container closed -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <!--Internal  Chart.bundle js -->
    <script src="<?php echo e(URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')); ?>"></script>
    <!-- Moment js -->
    <script src="<?php echo e(URL::asset('assets/plugins/raphael/raphael.min.js')); ?>"></script>
    <!--Internal  Flot js-->
    <script src="<?php echo e(URL::asset('assets/plugins/jquery.flot/jquery.flot.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/dashboard.sampledata.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/chart.flot.sampledata.js')); ?>"></script>
    <!--Internal Apexchart js-->
    <script src="<?php echo e(URL::asset('assets/js/apexcharts.js')); ?>"></script>
    <!-- Internal Map -->
    <script src="<?php echo e(URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/modal-popup.js')); ?>"></script>
    <!--Internal  index js -->
    <script src="<?php echo e(URL::asset('assets/js/index.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/jquery.vmap.sampledata.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart Scripts -->
<?php echo $pieChart->script(); ?>

<?php echo $barChart->script(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\invoices\resources\views/home.blade.php ENDPATH**/ ?>