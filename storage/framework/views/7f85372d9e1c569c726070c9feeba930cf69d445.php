<?php $__env->startSection('title'); ?>
    Server — <?php echo e($server->name); ?>: Mounts
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1><?php echo e($server->name); ?><small>Manage server mounts.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li><a href="<?php echo e(route('admin.servers')); ?>">Servers</a></li>
        <li><a href="<?php echo e(route('admin.servers.view', $server->id)); ?>"><?php echo e($server->name); ?></a></li>
        <li class="active">Mounts</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.servers.partials.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Available Mounts</h3>
                </div>

                <div class="box-body table-responsible no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Source</th>
                            <th>Target</th>
                            <th>Status</th>
                            <th></th>
                        </tr>

                        <?php $__currentLoopData = $mounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="col-sm-1 middle"><code><?php echo e($mount->id); ?></code></td>
                                <td class="middle"><a href="<?php echo e(route('admin.mounts.view', $mount->id)); ?>"><?php echo e($mount->name); ?></a></td>
                                <td class="middle"><code><?php echo e($mount->source); ?></code></td>
                                <td class="col-sm-2 middle"><code><?php echo e($mount->target); ?></code></td>

                                <?php if(! in_array($mount->id, $server->mounts->pluck('id')->toArray())): ?>
                                    <td class="col-sm-2 middle">
                                        <span class="label label-primary">Unmounted</span>
                                    </td>

                                    <td class="col-sm-1 middle">
                                        <form action="<?php echo e(route('admin.servers.view.mounts.store', [ 'server' => $server->id ])); ?>" method="POST">
                                            <?php echo csrf_field(); ?>

                                            <input type="hidden" value="<?php echo e($mount->id); ?>" name="mount_id" />
                                            <button type="submit" class="btn btn-xs btn-success"><i class="fa fa-plus"></i></button>
                                        </form>
                                    </td>
                                <?php else: ?>
                                    <td class="col-sm-2 middle">
                                        <span class="label label-success">Mounted</span>
                                    </td>

                                    <td class="col-sm-1 middle">
                                        <form action="<?php echo e(route('admin.servers.view.mounts.delete', [ 'server' => $server->id, 'mount' => $mount->id ])); ?>" method="POST">
                                            <?php echo method_field('DELETE'); ?>
                                            <?php echo csrf_field(); ?>


                                            <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                                        </form>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/servers/view/mounts.blade.php ENDPATH**/ ?>