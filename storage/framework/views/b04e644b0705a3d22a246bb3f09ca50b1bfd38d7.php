<?php $__env->startSection('title'); ?>
    Nests
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1>Nests<small>All nests currently available on this system.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li class="active">Nests</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="alert alert-danger">
            Eggs are a powerful feature of Pterodactyl Panel that allow for extreme flexibility and configuration. Please note that while powerful, modifying an egg wrongly can very easily brick your servers and cause more problems. Please avoid editing our default eggs — those provided by <code>support@pterodactyl.io</code> — unless you are absolutely sure of what you are doing.
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Configured Nests</h3>
                <div class="box-tools">
                    <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#importServiceOptionModal" role="button"><i class="fa fa-upload"></i> Import Egg</a>
                    <a href="<?php echo e(route('admin.nests.new')); ?>" class="btn btn-primary btn-sm">Create New</a>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th class="text-center">Eggs</th>
                        <th class="text-center">Servers</th>
                    </tr>
                    <?php $__currentLoopData = $nests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="middle"><code><?php echo e($nest->id); ?></code></td>
                            <td class="middle"><a href="<?php echo e(route('admin.nests.view', $nest->id)); ?>" data-toggle="tooltip" data-placement="right" title="<?php echo e($nest->author); ?>"><?php echo e($nest->name); ?></a></td>
                            <td class="col-xs-6 middle"><?php echo e($nest->description); ?></td>
                            <td class="text-center middle"><?php echo e($nest->eggs_count); ?></td>
                            <td class="text-center middle"><?php echo e($nest->servers_count); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="importServiceOptionModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Import an Egg</h4>
            </div>
            <form action="<?php echo e(route('admin.nests.egg.import')); ?>" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label" for="pImportFile">Egg File <span class="field-required"></span></label>
                        <div>
                            <input id="pImportFile" type="file" name="import_file" class="form-control" accept="application/json" />
                            <p class="small text-muted">Select the <code>.json</code> file for the new egg that you wish to import.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="pImportToNest">Associated Nest <span class="field-required"></span></label>
                        <div>
                            <select id="pImportToNest" name="import_to_nest">
                                <?php $__currentLoopData = $nests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <option value="<?php echo e($nest->id); ?>"><?php echo e($nest->name); ?> &lt;<?php echo e($nest->author); ?>&gt;</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <p class="small text-muted">Select the nest that this egg will be associated with from the dropdown. If you wish to associate it with a new nest you will need to create that nest before continuing.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php echo e(csrf_field()); ?>

                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('footer-scripts'); ?>
    <script>
        $(document).ready(function() {
            $('#pImportToNest').select2();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/nests/index.blade.php ENDPATH**/ ?>