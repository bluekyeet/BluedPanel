<?php $__env->startSection('title'); ?>
    Nests &rarr; <?php echo e($nest->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1><?php echo e($nest->name); ?><small><?php echo e(str_limit($nest->description, 50)); ?></small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li><a href="<?php echo e(route('admin.nests')); ?>">Nests</a></li>
        <li class="active"><?php echo e($nest->name); ?></li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <form action="<?php echo e(route('admin.nests.view', $nest->id)); ?>" method="POST">
        <div class="col-md-6">
            <div class="box">
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label">Name <span class="field-required"></span></label>
                        <div>
                            <input type="text" name="name" class="form-control" value="<?php echo e($nest->name); ?>" />
                            <p class="text-muted"><small>This should be a descriptive category name that encompasses all of the options within the service.</small></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Description</label>
                        <div>
                            <textarea name="description" class="form-control" rows="7"><?php echo e($nest->description); ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <?php echo csrf_field(); ?>

                    <button type="submit" name="_method" value="PATCH" class="btn btn-primary btn-sm pull-right">Save</button>
                    <button id="deleteButton" type="submit" name="_method" value="DELETE" class="btn btn-sm btn-danger muted muted-hover"><i class="fa fa-trash-o"></i></button>
                </div>
            </div>
        </div>
    </form>
    <div class="col-md-6">
        <div class="box">
            <div class="box-body">
                <div class="form-group">
                    <label class="control-label">Nest ID</label>
                    <div>
                        <input type="text" readonly class="form-control" value="<?php echo e($nest->id); ?>" />
                        <p class="text-muted small">A unique ID used for identification of this nest internally and through the API.</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Author</label>
                    <div>
                        <input type="text" readonly class="form-control" value="<?php echo e($nest->author); ?>" />
                        <p class="text-muted small">The author of this service option. Please direct questions and issues to them unless this is an official option authored by <code>support@pterodactyl.io</code>.</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">UUID</label>
                    <div>
                        <input type="text" readonly class="form-control" value="<?php echo e($nest->uuid); ?>" />
                        <p class="text-muted small">A UUID that all servers using this option are assigned for identification purposes.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Nest Eggs</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th class="text-center">Servers</th>
                        <th class="text-center"></th>
                    </tr>
                    <?php $__currentLoopData = $nest->eggs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $egg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="align-middle"><code><?php echo e($egg->id); ?></code></td>
                            <td class="align-middle"><a href="<?php echo e(route('admin.nests.egg.view', $egg->id)); ?>" data-toggle="tooltip" data-placement="right" title="<?php echo e($egg->author); ?>"><?php echo e($egg->name); ?></a></td>
                            <td class="col-xs-8 align-middle"><?php echo $egg->description; ?></td>
                            <td class="text-center align-middle"><code><?php echo e($egg->servers->count()); ?></code></td>
                            <td class="align-middle">
                                <a href="<?php echo e(route('admin.nests.egg.export', ['egg' => $egg->id])); ?>"><i class="fa fa-download"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            </div>
            <div class="box-footer">
                <a href="<?php echo e(route('admin.nests.egg.new')); ?>"><button class="btn btn-success btn-sm pull-right">New Egg</button></a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('footer-scripts'); ?>
    <script>
        $('#deleteButton').on('mouseenter', function (event) {
            $(this).find('i').html(' Delete Nest');
        }).on('mouseleave', function (event) {
            $(this).find('i').html('');
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/nests/view.blade.php ENDPATH**/ ?>