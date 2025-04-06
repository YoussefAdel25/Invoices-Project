<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    

    <!-- User Info -->
    <div class="app-sidebar__user clearfix">
        <div class="dropdown user-pro-body">
            <div>
                <img alt="user-img" class="avatar avatar-xl brround" src="<?php echo e(URL::asset('assets/img/faces/6.jpg')); ?>">
                <span class="avatar-status profile-status bg-green"></span>
            </div>
            <div class="user-info">
                <h4 class="font-weight-semibold mt-3 mb-0"><?php echo e(Auth::user()->name); ?></h4>
                
            </div>
        </div>
    </div>

    <!-- Side Menu -->
    <div class="main-sidemenu">
        <ul class="side-menu">
            <!-- الرئيسية -->
            <li class="slide">
                <a class="side-menu__item" href="<?php echo e(url('/' . ($page = 'home'))); ?>">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8z"/>
                    </svg>
                    <span class="side-menu__label">الرئيسية</span>
                </a>
            </li>

            <!-- الفواتير -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('الفواتير')): ?>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5H3zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
                    </svg>
                    <span class="side-menu__label">الفواتير</span>
                    <i class="angle fe fe-chevron-down"></i>
                </a>
                <ul class="slide-menu">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('قائمة الفواتير')): ?> <li><a class="slide-item" href="<?php echo e(url('/invoices')); ?>">قائمة الفواتير</a></li> <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('الفواتير المدفوعة')): ?> <li><a class="slide-item" href="<?php echo e(url('/invoices_paid')); ?>">الفواتير المدفوعة</a></li> <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('الفواتير الغير مدفوعة')): ?> <li><a class="slide-item" href="<?php echo e(url('/invoices_unpaid')); ?>">الفواتير الغيرمدفوعة</a></li> <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ارشيف الفواتير')): ?> <li><a class="slide-item" href="<?php echo e(url('/invoices_archive')); ?>">ارشيف الفواتير</a></li> <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>

            <!-- التقارير -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('التقارير')): ?>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10V2z"/>
                    </svg>
                    <span class="side-menu__label">التقارير</span>
                    <i class="angle fe fe-chevron-down"></i>
                </a>
                <ul class="slide-menu">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('تقرير الفواتير')): ?> <li><a class="slide-item" href="<?php echo e(url('/invoices_report')); ?>">تقارير الفواتير</a></li> <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('تقرير العملاء')): ?> <li><a class="slide-item" href="<?php echo e(url('/customers/report')); ?>">تقارير العملاء</a></li> <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>

            <!-- المستخدمين -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('المستخدمين')): ?>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7z"/>
                    </svg>
                    <span class="side-menu__label">المستخدمين</span>
                    <i class="angle fe fe-chevron-down"></i>
                </a>
                <ul class="slide-menu">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('قائمة المستخدمين')): ?> <li><a class="slide-item" href="<?php echo e(url('/users')); ?>">قائمة المستخدمين</a></li> <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('صلاحيات المستخدمين')): ?> <li><a class="slide-item" href="<?php echo e(url('/roles')); ?>">صلاحيات المستخدمين</a></li> <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>

            <!-- الاعدادات -->
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('الاعدادات')): ?>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M21 5c-1.11-.35-2.33-.5-3.5-.5-1.95 0-4.05.4-5.5 1.5-1.45-1.1-3.55-1.5-5.5-1.5S2.45 4.9 1 6v14.65c0 .25.25.5.5.5.1 0 .15-.05.25-.05C3.1 20.45 5.05 20 6.5 20c1.95 0 4.05.4 5.5 1.5 1.35-.85 3.8-1.5 5.5-1.5 1.65 0 3.35.3 4.75 1.05.1.05.15.05.25.05.25 0 .5-.25.5-.5V6c-.6-.45-1.25-.75-2-1z"/>
                    </svg>
                    <span class="side-menu__label">الاعدادات</span>
                    <i class="angle fe fe-chevron-down"></i>
                </a>
                <ul class="slide-menu">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('الاقسام')): ?> <li><a class="slide-item" href="<?php echo e(url('/sections')); ?>">الاقسام</a></li> <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('المنتجات')): ?> <li><a class="slide-item" href="<?php echo e(url('/products')); ?>">المنتجات</a></li> <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</aside>
<!-- main-sidebar -->
<?php /**PATH E:\invoices\resources\views/layouts/main-sidebar.blade.php ENDPATH**/ ?>