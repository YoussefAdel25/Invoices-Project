<?php $__env->startSection('css'); ?>
    <!--Internal Notify -->
    <link href="<?php echo e(URL::asset('assets/plugins/notify/css/notifIt.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title', 'صلاحيات المستخدمين - مورا سوفت للادارة القانونية'); ?>

<?php $__env->startSection('page-header'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('status')): ?>
    <script>
        window.onload = function() {
            notif({
                msg: "<?php echo e(session('status')); ?>",
                type: "<?php echo e(session('type')); ?>"
            });
        }
    </script>
<?php endif; ?>

<!-- row -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('اضافة صلاحية')): ?>
                                <a class="btn btn-primary btn-sm" href="<?php echo e(route('roles.create')); ?>">إضافة</a>
                            <?php endif; ?>
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
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($role->name); ?></td>
                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('عرض صلاحية')): ?>
                                        <a class="btn btn-success btn-sm" href="<?php echo e(route('roles.show', $role->id)); ?>">عرض</a>
                                        <?php endif; ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('تعديل صلاحية')): ?>
                                            <a class="btn btn-primary btn-sm" href="<?php echo e(route('roles.edit', $role->id)); ?>">تعديل</a>
                                        <?php endif; ?>

                                        <?php if($role->name !== 'owner'): ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('حذف صلاحية')): ?>
                                                <form action="<?php echo e(route('roles.destroy', $role->id)); ?>" method="POST" style="display:inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟');">حذف</button>
                                                </form>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    <?php echo e($roles->links()); ?>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<!--Internal Notify js -->
<script src="<?php echo e(URL::asset('assets/plugins/notify/js/notifIt.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/notify/js/notifit-custom.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\invoices\resources\views/roles/index.blade.php ENDPATH**/ ?>