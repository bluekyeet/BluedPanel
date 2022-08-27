<?php echo $__env->make('partials/admin.jexactyl.nav', ['activeTab' => 'index'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title'); ?>
    Jexactyl Settings
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1>Jexactyl Settings<small>Configure Jexactyl-specific settings for the Panel.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li class="active">Jexactyl</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->yieldContent('jexactyl::nav'); ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box
                <?php if($version->isLatestPanel()): ?>
                    box-success
                <?php else: ?>
                    box-danger
                <?php endif; ?>
            ">
                <div class="box-header with-border">
                    <i class="fa fa-code-fork"></i> <h3 class="box-title">Software Release <small>Verify Jexactyl is up-to-date.</small></h3>
                </div>
                <div class="box-body">
                    <?php if($version->isLatestPanel()): ?>
                        You are running Jexactyl <code><?php echo e(config('app.version')); ?></code>. 
                    <?php else: ?>
                        Jexactyl is not up-to-date. Latest release is available <a href="https://github.com/jexactyl/jexactyl/releases/v<?php echo e($version->getPanel()); ?>" target="_blank">here</a>.
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-12 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon"><i class="fa fa-server"></i></span>
                    <div class="info-box-content" style="padding: 23px 10px 0;">
                        <span class="info-box-text">Total Servers</span>
                        <span class="info-box-number"><?php echo e(count($servers)); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon"><i class="fa fa-wifi"></i></span>
                    <div class="info-box-content" style="padding: 23px 10px 0;">
                        <span class="info-box-text">Total Allocations</span>
                        <span class="info-box-number"><?php echo e($allocations); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon"><i class="fa fa-pie-chart"></i></span>
                    <div class="info-box-content" style="padding: 23px 10px 0;">
                        <span class="info-box-text">Total RAM use</span>
                        <span class="info-box-number"><?php echo e($used['memory']); ?> MB of <?php echo e($available['memory']); ?> MB</span>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon"><i class="fa fa-hdd-o"></i></span>
                    <div class="info-box-content" style="padding: 23px 10px 0;">
                        <span class="info-box-text">Total disk use</span>
                        <span class="info-box-number"><?php echo e($used['disk']); ?> MB of <?php echo e($available['disk']); ?> MB </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-bar-chart"></i> <h3 class="box-title">Resource Utilization <small>A glance of the total amount of resources used.</small></h3>
                </div>
                <div class="box-body">
                    <div class="col-xs-12 col-md-4">
                        <canvas id="servers_chart" width="100%" height="50">
                            <p class="text-muted">No data is available for this chart.</p>
                        </canvas>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <canvas id="ram_chart" width="100%" height="50">
                            <p class="text-muted">No data is available for this chart.</p>
                        </canvas>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <canvas id="disk_chart" width="100%" height="50">
                            <p class="text-muted">No data is available for this chart.</p>
                        </canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('footer-scripts'); ?>
    <?php echo Theme::js('vendor/chartjs/chart.min.js'); ?>

    <?php echo Theme::js('js/admin/statistics.js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/jexactyl/index.blade.php ENDPATH**/ ?>