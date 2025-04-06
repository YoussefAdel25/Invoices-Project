<?php $__env->startSection('css'); ?>
<!--Internal Font Awesome -->
<link href="<?php echo e(URL::asset('assets/plugins/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet">
<!--Internal Treeview -->
<link href="<?php echo e(URL::asset('assets/plugins/treeview/treeview-rtl.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->startSection('title'); ?>
تعديل الصلاحيات - مورا سوفت للادارة القانونية
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php if($errors->any()): ?>
<div class="alert alert-danger">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>خطأ!</strong>
    <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
</div>
<?php endif; ?>

<form action="<?php echo e(route('roles.update', $role->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PATCH'); ?>

    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        <div class="form-group">
                            <p>اسم الصلاحية :</p>
                            <input type="text" name="name" value="<?php echo e(old('name', $role->name)); ?>" placeholder="اسم الصلاحية" class="form-control">
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-danger"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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

                        <?php
                            $groupedPermissions = $permission->groupBy(function($item) {
                                return explode(' ', $item->name)[0]; // تصنيف حسب أول كلمة في الاسم
                            });
                        ?>

                        <?php $__currentLoopData = $groupedPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group => $permissions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4">
                            <div class="card p-3">
                                <h6 class="text-primary"><?php echo e(ucfirst($group)); ?></h6>
                                <ul id="treeview1">
                                    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <label>
                                            <input type="checkbox" name="permission[]" value="<?php echo e($value->id); ?>"
                                                class="permission-checkbox"
                                                <?php echo e(in_array($value->id, $rolePermissions) ? 'checked' : ''); ?>>
                                            <?php echo e($value->name); ?>

                                        </label>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<!-- Internal Treeview js -->
<script src="<?php echo e(URL::asset('assets/plugins/treeview/treeview.js')); ?>"></script>

<script>
    document.getElementById('checkAll').addEventListener('change', function () {
        let checkboxes = document.querySelectorAll('.permission-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\invoices\resources\views/roles/edit.blade.php ENDPATH**/ ?>