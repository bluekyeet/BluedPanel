<!DOCTYPE html>
<html>
    <head>
        <title><?php echo e(config('app.name', 'Pterodactyl')); ?></title>

        <?php $__env->startSection('meta'); ?>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
            <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
            <meta name="robots" content="noindex">
            <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
            <link rel="icon" type="image/png" href="/favicons/favicon-32x32.png" sizes="32x32">
            <link rel="icon" type="image/png" href="/favicons/favicon-16x16.png" sizes="16x16">
            <link rel="manifest" href="/favicons/manifest.json">
            <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#bc6e3c">
            <link rel="shortcut icon" href="/favicons/favicon.ico">
            <meta name="msapplication-config" content="/favicons/browserconfig.xml">
            <meta name="theme-color" content="#0e4688">
        <?php echo $__env->yieldSection(); ?>

        <?php $__env->startSection('user-data'); ?>
            <?php if(!is_null(Auth::user())): ?>
                <script>
                    window.JexactylUser = <?php echo json_encode(Auth::user()->toVueObject()); ?>;
                </script>
            <?php endif; ?>
            <?php if(!empty($siteConfiguration)): ?>
                <script>
                    window.SiteConfiguration = <?php echo json_encode($siteConfiguration); ?>;
                </script>
            <?php endif; ?>
            <?php if(!empty($storeConfiguration)): ?>
                <script>
                    window.StoreConfiguration = <?php echo json_encode($storeConfiguration); ?>;
                </script>
            <?php endif; ?>
        <?php echo $__env->yieldSection(); ?>
        <style>
            @import  url('//fonts.googleapis.com/css?family=Rubik:300,400,500&display=swap');
            @import  url('//fonts.googleapis.com/css?family=IBM+Plex+Mono|IBM+Plex+Sans:500&display=swap');
        </style>

        <?php echo $__env->yieldContent('assets'); ?>

        <?php echo $__env->make('layouts.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </head>
    <body>
        <?php $__env->startSection('content'); ?>
            <?php echo $__env->yieldContent('above-container'); ?>
            <?php echo $__env->yieldContent('container'); ?>
            <?php echo $__env->yieldContent('below-container'); ?>
        <?php echo $__env->yieldSection(); ?>
        <?php $__env->startSection('scripts'); ?>
            <?php echo $asset->js('main.js'); ?>

        <?php echo $__env->yieldSection(); ?>
    </body>
</html>
<?php /**PATH /var/www/jexactyl/resources/views/templates/wrapper.blade.php ENDPATH**/ ?>