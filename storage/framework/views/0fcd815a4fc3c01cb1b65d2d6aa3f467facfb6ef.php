<?php $__env->startSection('title'); ?>
    <?php echo e($node->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1><?php echo e($node->name); ?><small>A quick overview of your node.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li><a href="<?php echo e(route('admin.nodes')); ?>">Nodes</a></li>
        <li class="active"><?php echo e($node->name); ?></li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom nav-tabs-floating">
            <ul class="nav nav-tabs">
                <li class="active"><a href="<?php echo e(route('admin.nodes.view', $node->id)); ?>">About</a></li>
                <li><a href="<?php echo e(route('admin.nodes.view.settings', $node->id)); ?>">Settings</a></li>
                <li><a href="<?php echo e(route('admin.nodes.view.configuration', $node->id)); ?>">Configuration</a></li>
                <li><a href="<?php echo e(route('admin.nodes.view.allocation', $node->id)); ?>">Allocation</a></li>
                <li><a href="<?php echo e(route('admin.nodes.view.servers', $node->id)); ?>">Servers</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-8">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Information</h3>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <td>Daemon Version</td>
                                <td><code data-attr="info-version"><i class="fa fa-refresh fa-fw fa-spin"></i></code> (Latest: <code><?php echo e($version->getDaemon()); ?></code>)</td>
                            </tr>
                            <tr>
                                <td>System Information</td>
                                <td data-attr="info-system"><i class="fa fa-refresh fa-fw fa-spin"></i></td>
                            </tr>
                            <tr>
                                <td>Total CPU Threads</td>
                                <td data-attr="info-cpus"><i class="fa fa-refresh fa-fw fa-spin"></i></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <?php if($node->description): ?>
                <div class="col-xs-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            Description
                        </div>
                        <div class="box-body table-responsive">
                            <pre><?php echo e($node->description); ?></pre>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-xs-12">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Delete Node</h3>
                    </div>
                    <div class="box-body">
                        <p class="no-margin">Deleting a node is a irreversible action and will immediately remove this node from the panel. There must be no servers associated with this node in order to continue.</p>
                    </div>
                    <div class="box-footer">
                        <form action="<?php echo e(route('admin.nodes.view.delete', $node->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <?php echo method_field('DELETE'); ?>

                            <button type="submit" class="btn btn-danger btn-sm pull-right" <?php echo e(($node->servers_count < 1) ?: 'disabled'); ?>>Yes, Delete This Node</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">At-a-Glance</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <?php if($node->maintenance_mode): ?>
                    <div class="col-sm-12">
                        <div class="info-box bg-grey">
                            <span class="info-box-icon"><i class="ion ion-wrench"></i></span>
                            <div class="info-box-content" style="padding: 23px 10px 0;">
                                <span class="info-box-text">This node is under</span>
                                <span class="info-box-number">Maintenance</span>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="col-sm-12">
                        <div class="info-box bg-<?php echo e($stats['disk']['css']); ?>">
                            <span class="info-box-icon"><i class="ion ion-ios-folder-outline"></i></span>
                            <div class="info-box-content" style="padding: 15px 10px 0;">
                                <span class="info-box-text">Disk Space Allocated</span>
                                <span class="info-box-number"><?php echo e($stats['disk']['value']); ?> / <?php echo e($stats['disk']['max']); ?> MB</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: <?php echo e($stats['disk']['percent']); ?>%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="info-box bg-<?php echo e($stats['memory']['css']); ?>">
                            <span class="info-box-icon"><i class="ion ion-ios-barcode-outline"></i></span>
                            <div class="info-box-content" style="padding: 15px 10px 0;">
                                <span class="info-box-text">Memory Allocated</span>
                                <span class="info-box-number"><?php echo e($stats['memory']['value']); ?> / <?php echo e($stats['memory']['max']); ?> MB</span>
                                <div class="progress">
                                    <div class="progress-bar" style="width: <?php echo e($stats['memory']['percent']); ?>%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="info-box bg-blue">
                            <span class="info-box-icon"><i class="ion ion-social-buffer-outline"></i></span>
                            <div class="info-box-content" style="padding: 23px 10px 0;">
                                <span class="info-box-text">Total Servers</span>
                                <span class="info-box-number"><?php echo e($node->servers_count); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('footer-scripts'); ?>
    <script>
    (function getInformation() {
        $.ajax({
            method: 'GET',
            url: '/admin/nodes/view/<?php echo e($node->id); ?>/system-information',
            timeout: 5000,
        }).done(function (data) {
            $('[data-attr="info-version"]').html(data.version);
            $('[data-attr="info-system"]').html(data.system.type + ' (' + data.system.arch + ') <code>' + data.system.release + '</code>');
            $('[data-attr="info-cpus"]').html(data.system.cpus);
        }).fail(function (jqXHR) {

        }).always(function() {
            setTimeout(getInformation, 10000);
        });
    })();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/nodes/view/index.blade.php ENDPATH**/ ?>