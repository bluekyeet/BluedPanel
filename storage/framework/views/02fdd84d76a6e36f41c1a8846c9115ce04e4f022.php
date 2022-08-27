<?php $__env->startSection('title'); ?>
    <?php echo e($node->name); ?>: Servers
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1><?php echo e($node->name); ?><small>All servers currently assigned to this node.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li><a href="<?php echo e(route('admin.nodes')); ?>">Nodes</a></li>
        <li><a href="<?php echo e(route('admin.nodes.view', $node->id)); ?>"><?php echo e($node->name); ?></a></li>
        <li class="active">Servers</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom nav-tabs-floating">
            <ul class="nav nav-tabs">
                <li><a href="<?php echo e(route('admin.nodes.view', $node->id)); ?>">About</a></li>
                <li><a href="<?php echo e(route('admin.nodes.view.settings', $node->id)); ?>">Settings</a></li>
                <li><a href="<?php echo e(route('admin.nodes.view.configuration', $node->id)); ?>">Configuration</a></li>
                <li><a href="<?php echo e(route('admin.nodes.view.allocation', $node->id)); ?>">Allocation</a></li>
                <li class="active"><a href="<?php echo e(route('admin.nodes.view.servers', $node->id)); ?>">Servers</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Process Manager</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Server Name</th>
                        <th>Owner</th>
                        <th>Service</th>
                    </tr>
                    <?php $__currentLoopData = $servers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $server): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr data-server="<?php echo e($server->uuid); ?>">
                            <td><code><?php echo e($server->uuidShort); ?></code></td>
                            <td><a href="<?php echo e(route('admin.servers.view', $server->id)); ?>"><?php echo e($server->name); ?></a></td>
                            <td><a href="<?php echo e(route('admin.users.view', $server->owner_id)); ?>"><?php echo e($server->user->username); ?></a></td>
                            <td><?php echo e($server->nest->name); ?> (<?php echo e($server->egg->name); ?>)</td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
                <?php if($servers->hasPages()): ?>
                    <div class="box-footer with-border">
                        <div class="col-md-12 text-center"><?php echo $servers->render(); ?></div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/nodes/view/servers.blade.php ENDPATH**/ ?>