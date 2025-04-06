<?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <a class="d-flex p-3 mb-2 border rounded bg-light shadow-sm text-right"
       href="<?php echo e(url('InvoicesDetails')); ?>/<?php echo e($notification->data['id']); ?>">
        <div class="notifyimg bg-pink rounded-circle d-flex align-items-center justify-content-center"
             style="width: 40px; height: 40px;">
            <i class="la la-file-alt text-white"></i>
        </div>

        <div class="flex-grow-1 mr-3">
            <h5 class="notification-label mb-1 tx-14 text-dark">
                <?php echo e($notification->data['title']); ?>

                <span class="text-primary font-weight-bold">
                    <?php echo e($notification->data['user']); ?>

                </span>
            </h5>
            <div class="notification-subtext tx-12 text-muted">
                <?php echo e($notification->created_at->diffForHumans()); ?>

            </div>
        </div>

        <div class="ml-2 align-self-center text-muted">
            <i class="las la-angle-left"></i>
        </div>
    </a>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <div class="text-center py-3 text-muted">
        لا توجد إشعارات حالياً
    </div>
<?php endif; ?>
<?php /**PATH E:\invoices\resources\views/partials/notifications.blade.php ENDPATH**/ ?>