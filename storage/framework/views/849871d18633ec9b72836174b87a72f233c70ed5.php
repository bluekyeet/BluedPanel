




<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo e(config('app.name', 'Jexactyl')); ?> - <?php echo $__env->yieldContent('title'); ?></title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="_token" content="<?php echo e(csrf_token()); ?>">

        <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="/favicons/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/favicons/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/favicons/manifest.json">
        <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#bc6e3c">
        <link rel="shortcut icon" href="/favicons/favicon.ico">
        <meta name="msapplication-config" content="/favicons/browserconfig.xml">
        <meta name="theme-color" content="#0e4688">

        <script src="https://unpkg.com/feather-icons"></script>

        <?php echo $__env->make('layouts.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php $__env->startSection('scripts'); ?>
            <?php echo Theme::css('vendor/select2/select2.min.css?t={cache-version}'); ?>

            <?php echo Theme::css('vendor/bootstrap/bootstrap.min.css?t={cache-version}'); ?>

            <?php echo Theme::css('vendor/adminlte/admin.min.css?t={cache-version}'); ?>

            <?php echo Theme::css('vendor/adminlte/colors/skin-blue.min.css?t={cache-version}'); ?>

            <?php echo Theme::css('vendor/sweetalert/sweetalert.min.css?t={cache-version}'); ?>

            <?php echo Theme::css('vendor/animate/animate.min.css?t={cache-version}'); ?>

            <!-- Ability to customize Jexactyl theme -->
            <link rel="stylesheet" href="/themes/<?php echo e(config('theme.admin', 'jexactyl')); ?>/css/<?php echo e(config('theme.admin', 'jexactyl')); ?>.css">

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <?php echo $__env->yieldSection(); ?>
    </head>
    <body class="skin-blue fixed">
        <div class="wrapper">
            <header class="main-header">
                <a href="<?php echo e(route('index')); ?>" class="logo">
                    <img src="https://avatars.githubusercontent.com/u/91636558" width="48" height="48" />
                </a>
            </header>
            <aside class="main-sidebar">
                <section class="sidebar">
                    <ul class="sidebar-menu">
                        <li class="<?php echo e(! starts_with(Route::currentRouteName(), 'admin.index') ?: 'active'); ?>">
                            <a href="<?php echo e(route('admin.index')); ?>">
                                <i data-feather="tool" style="margin-left: 12px;"></i> 
                            </a>
                        </li>
                        <li class="<?php echo e(! starts_with(Route::currentRouteName(), 'admin.api') ?: 'active'); ?>">
                            <a href="<?php echo e(route('admin.api.index')); ?>">
                                <i data-feather="git-branch" style="margin-left: 12px;"></i>
                            </a>
                        </li>
                        <li class="<?php echo e(! starts_with(Route::currentRouteName(), 'admin.databases') ?: 'active'); ?>">
                            <a href="<?php echo e(route('admin.databases')); ?>">
                                <i data-feather="database" style="margin-left: 12px;"></i>
                            </a>
                        </li>
                        <li class="<?php echo e(! starts_with(Route::currentRouteName(), 'admin.locations') ?: 'active'); ?>">
                            <a href="<?php echo e(route('admin.locations')); ?>">
                                <i data-feather="navigation" style="margin-left: 12px;"></i>
                            </a>
                        </li>
                        <li class="<?php echo e(! starts_with(Route::currentRouteName(), 'admin.nodes') ?: 'active'); ?>">
                            <a href="<?php echo e(route('admin.nodes')); ?>">
                                <i data-feather="layers" style="margin-left: 12px;"></i>
                            </a>
                        </li>
                        <li class="<?php echo e(! starts_with(Route::currentRouteName(), 'admin.servers') ?: 'active'); ?>">
                            <a href="<?php echo e(route('admin.servers')); ?>">
                                <i data-feather="server" style="margin-left: 12px;"></i>
                            </a>
                        </li>
                        <li class="<?php echo e(! starts_with(Route::currentRouteName(), 'admin.users') ?: 'active'); ?>">
                            <a href="<?php echo e(route('admin.users')); ?>">
                                <i data-feather="users" style="margin-left: 12px;"></i>
                            </a>
                        </li>
                        <li class="<?php echo e(! starts_with(Route::currentRouteName(), 'admin.mounts') ?: 'active'); ?>">
                            <a href="<?php echo e(route('admin.mounts')); ?>">
                                <i data-feather="hard-drive" style="margin-left: 12px;"></i>
                            </a>
                        </li>
                        <li class="<?php echo e(! starts_with(Route::currentRouteName(), 'admin.nests') ?: 'active'); ?>">
                            <a href="<?php echo e(route('admin.nests')); ?>">
                                <i data-feather="archive" style="margin-left: 12px;"></i>
                            </a>
                        </li>
                    </ul>
                </section>
            </aside>
            <div class="content-wrapper">
                <section class="content-header">
                    <?php echo $__env->yieldContent('content-header'); ?>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <?php if(count($errors) > 0): ?>
                                <div class="alert alert-danger">
                                    There was an error validating the data provided.<br><br>
                                    <ul>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <?php $__currentLoopData = Alert::getMessages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $messages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="alert alert-<?php echo e($type); ?> alert-dismissable" role="alert">
                                        <?php echo $message; ?>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php echo $__env->yieldContent('content'); ?>
                </section>
            </div>
        </div>
        <?php $__env->startSection('footer-scripts'); ?>
            <script src="/js/keyboard.polyfill.js" type="application/javascript"></script>
            <script>keyboardeventKeyPolyfill.polyfill();</script>

            <?php echo Theme::js('vendor/jquery/jquery.min.js?t={cache-version}'); ?>

            <?php echo Theme::js('vendor/sweetalert/sweetalert.min.js?t={cache-version}'); ?>

            <?php echo Theme::js('vendor/bootstrap/bootstrap.min.js?t={cache-version}'); ?>

            <?php echo Theme::js('vendor/slimscroll/jquery.slimscroll.min.js?t={cache-version}'); ?>

            <?php echo Theme::js('vendor/adminlte/app.min.js?t={cache-version}'); ?>

            <?php echo Theme::js('vendor/bootstrap-notify/bootstrap-notify.min.js?t={cache-version}'); ?>

            <?php echo Theme::js('vendor/select2/select2.full.min.js?t={cache-version}'); ?>

            <?php echo Theme::js('js/admin/functions.js?t={cache-version}'); ?>

            <script src="/js/autocomplete.js" type="application/javascript"></script>

            <script>
                feather.replace()
            </script>

            <?php if(Auth::user()->root_admin): ?>
                <script>
                    $('#logoutButton').on('click', function (event) {
                        event.preventDefault();

                        var that = this;
                        swal({
                            title: 'Do you want to log out?',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d9534f',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Log out'
                        }, function () {
                             $.ajax({
                                type: 'POST',
                                url: '<?php echo e(route('auth.logout')); ?>',
                                data: {
                                    _token: '<?php echo e(csrf_token()); ?>'
                                },complete: function () {
                                    window.location.href = '<?php echo e(route('auth.login')); ?>';
                                }
                        });
                    });
                });
                </script>
            <?php endif; ?>

            <script>
                $(function () {
                    $('[data-toggle="tooltip"]').tooltip();
                })
            </script>
        <?php echo $__env->yieldSection(); ?>
    </body>
</html>
<?php /**PATH /var/www/jexactyl/resources/views/layouts/admin.blade.php ENDPATH**/ ?>