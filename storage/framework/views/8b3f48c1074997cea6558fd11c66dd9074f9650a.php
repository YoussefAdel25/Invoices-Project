<!-- main-header opened -->
<div class="main-header sticky side-header nav nav-item">
    <div class="container-fluid">
        <div class="main-header-left ">
            <div class="responsive-logo">
                <a href="<?php echo e(url('/' . ($page = 'index'))); ?>"><img src="<?php echo e(URL::asset('assets/img/brand/logo.png')); ?>"
                        class="logo-1" alt="logo"></a>
                <a href="<?php echo e(url('/' . ($page = 'index'))); ?>"><img
                        src="<?php echo e(URL::asset('assets/img/brand/logo-white.png')); ?>" class="dark-logo-1" alt="logo"></a>
                <a href="<?php echo e(url('/' . ($page = 'index'))); ?>"><img src="<?php echo e(URL::asset('assets/img/brand/favicon.png')); ?>"
                        class="logo-2" alt="logo"></a>
                <a href="<?php echo e(url('/' . ($page = 'index'))); ?>"><img src="<?php echo e(URL::asset('assets/img/brand/favicon.png')); ?>"
                        class="dark-logo-2" alt="logo"></a>
            </div>
            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle" href="#"><i class="header-icon fe fe-align-left"></i></a>
                <a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
            </div>
            
        </div>
        <div class="main-header-right">
            
            <div class="nav nav-item  navbar-nav-right ml-auto">
                <div class="nav-link" id="bs-example-navbar-collapse-1">
                    <form class="navbar-form" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="input-group-btn">
                                <button type="reset" class="btn btn-default">
                                    <i class="fas fa-times"></i>
                                </button>
                                <button type="submit" class="btn btn-default nav-link resp-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-search">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>






                

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('الاشعارات')): ?>


                <div class="dropdown nav-item main-header-notification" style="position: relative;">
                    <a class="new nav-link" href="#" data-toggle="dropdown">
                        <div class="position-relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                                <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                            </svg>

                            <?php if(auth()->user()->unreadNotifications->count() > 0): ?>
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    style="font-size: 10px; ">
                                    <?php echo e(auth()->user()->unreadNotifications->count()); ?>

                                </span>
                            <?php endif; ?>
                        </div>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right shadow p-0 border-0 show" style="width: 350px; top: 100%; left: auto; right: 0; margin-top: 0.5rem;">
                        <div class="menu-header-content bg-primary text-white p-3 rounded-top">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 tx-15 font-weight-semibold">الإشعارات</h6>
                                <a href="/markAllRead" class="badge badge-warning text-dark">تعيين قراءة الكل</a>
                            </div>
                            <h6 class="d-block mt-1"  id="notification_count" style="color: yellow">
                                عدد الإشعارات الغير مقروءة:
                                <strong><?php echo e(auth()->user()->unreadNotifications->count()); ?></strong>
                            </h6>
                        </div>

                        <div class="main-notification-list Notification-scroll p-2" id="unreadNotification"
                            style="max-height: 300px; overflow-y: auto;" >
                            <?php $__empty_1 = true; $__currentLoopData = auth()->user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <a class="d-flex p-3 mb-2 border rounded bg-light shadow-sm text-right mark-as-read"
                              href="<?php echo e(route('markAsRead', $notification->id)); ?>"
                            data-notification-id="<?php echo e($notification->id); ?>">
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
                        </div>
                    </div>
                </div>

                <?php endif; ?>


                
                <div class="dropdown main-profile-menu nav nav-item nav-link">
                    <a class="profile-user d-flex" href=""><img alt=""
                            src="<?php echo e(URL::asset('assets/img/faces/6.jpg')); ?>"></a>
                    <div class="dropdown-menu">
                        <div class="main-header-profile bg-primary p-3">
                            <div class="d-flex wd-100p">
                                <div class="main-img-user"><img alt=""
                                        src="<?php echo e(URL::asset('assets/img/faces/6.jpg')); ?>" class=""></div>
                                <div class="mr-3 my-auto">
                                    <h6><?php echo e(Auth::User()->name); ?></h6><span><?php echo e(Auth::User()->email); ?></span>
                                </div>
                            </div>
                        </div>
                        <a class="dropdown-item" href=""><i class="bx bx-user-circle"></i>Profile</a>
                        <a class="dropdown-item" href=""><i class="bx bx-cog"></i> Edit Profile</a>
                        <a class="dropdown-item" href=""><i class="bx bxs-inbox"></i>Inbox</a>
                        <a class="dropdown-item" href=""><i class="bx bx-envelope"></i>Messages</a>
                        <a class="dropdown-item" href=""><i class="bx bx-slider-alt"></i> Account Settings</a>

                           <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i
                                class="bx bx-log-out"></i>تسجيل خروج</a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </div>
                <div class="dropdown main-header-message right-toggle">
                    <a class="nav-link pr-0" data-toggle="sidebar-left" data-target=".sidebar-left">
                        <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-menu">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    .dropdown-menu {
        display: none;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.3s ease-in-out;
    }

    .dropdown.show .dropdown-menu {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const dropdown = document.querySelector(".main-header-notification");

        dropdown.addEventListener("mouseenter", function () {
            dropdown.classList.add("show");
        });

        dropdown.addEventListener("mouseleave", function () {
            dropdown.classList.remove("show");
        });
    });
</script>



<!-- /main-header -->
<?php /**PATH E:\invoices\resources\views/layouts/main-header.blade.php ENDPATH**/ ?>