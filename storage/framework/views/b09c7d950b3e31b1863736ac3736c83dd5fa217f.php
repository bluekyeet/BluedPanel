<?php $__env->startSection('title'); ?>
    Locations &rarr; View &rarr; <?php echo e($location->short); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1><?php echo e($location->short); ?><small><?php echo e(str_limit($location->long, 75)); ?></small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li><a href="<?php echo e(route('admin.locations')); ?>">Locations</a></li>
        <li class="active"><?php echo e($location->short); ?></li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Location Details</h3>
            </div>
            <form action="<?php echo e(route('admin.locations.view', $location->id)); ?>" method="POST">
                <div class="box-body">
                    <div class="form-group">
                        <label for="pShort" class="form-label">Short Code</label>
                        <input type="text" id="pShort" name="short" class="form-control" value="<?php echo e($location->short); ?>" />
                    </div>
                    <div class="form-group">
                        <label for="pLong" class="form-label">Description</label>
                        <textarea id="pLong" name="long" class="form-control" rows="4"><?php echo e($location->long); ?></textarea>
                    </div>
                </div>
                <div class="box-footer">
                    <?php echo csrf_field(); ?>

                    <?php echo method_field('PATCH'); ?>

                    <button name="action" value="edit" class="btn btn-sm btn-primary pull-right">Save</button>
                    <button name="action" value="delete" class="btn btn-sm btn-danger pull-left muted muted-hover"><i class="fa fa-trash-o"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Nodes</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>FQDN</th>
                        <th>Servers</th>
                    </tr>
                    <?php $__currentLoopData = $location->nodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $node): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><code><?php echo e($node->id); ?></code></td>
                            <td><a href="<?php echo e(route('admin.nodes.view', $node->id)); ?>"><?php echo e($node->name); ?></a></td>
                            <td><code><?php echo e($node->fqdn); ?></code></td>
                            <td><?php echo e($node->servers->count()); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/locations/view.blade.php ENDPATH**/ ?>