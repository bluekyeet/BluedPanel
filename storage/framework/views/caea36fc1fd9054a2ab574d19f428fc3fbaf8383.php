<?php $__env->startSection('title'); ?>
    Application API
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1>Application API<small>Create a new application API key.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li><a href="<?php echo e(route('admin.api.index')); ?>">Application API</a></li>
        <li class="active">New Credentials</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <form method="POST" action="<?php echo e(route('admin.api.new')); ?>">
            <div class="col-sm-8 col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Select Permissions</h3>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <?php $__currentLoopData = $resources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resource): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="col-sm-3 strong"><?php echo e(str_replace('_', ' ', title_case($resource))); ?></td>
                                    <td class="col-sm-3 radio radio-primary text-center">
                                        <input type="radio" id="r_<?php echo e($resource); ?>" name="r_<?php echo e($resource); ?>" value="<?php echo e($permissions['r']); ?>">
                                        <label for="r_<?php echo e($resource); ?>">Read</label>
                                    </td>
                                    <td class="col-sm-3 radio radio-primary text-center">
                                        <input type="radio" id="rw_<?php echo e($resource); ?>" name="r_<?php echo e($resource); ?>" value="<?php echo e($permissions['rw']); ?>">
                                        <label for="rw_<?php echo e($resource); ?>">Read &amp; Write</label>
                                    </td>
                                    <td class="col-sm-3 radio text-center">
                                        <input type="radio" id="n_<?php echo e($resource); ?>" name="r_<?php echo e($resource); ?>" value="<?php echo e($permissions['n']); ?>" checked>
                                        <label for="n_<?php echo e($resource); ?>">None</label>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label" for="memoField">Description <span class="field-required"></span></label>
                            <input id="memoField" type="text" name="memo" class="form-control">
                        </div>
                        <p class="text-muted">Once you have assigned permissions and created this set of credentials you will be unable to come back and edit it. If you need to make changes down the road you will need to create a new set of credentials.</p>
                    </div>
                    <div class="box-footer">
                        <?php echo e(csrf_field()); ?>

                        <button type="submit" class="btn btn-success btn-sm pull-right">Create Credentials</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('footer-scripts'); ?>
    <script>
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/api/new.blade.php ENDPATH**/ ?>