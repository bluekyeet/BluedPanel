<?php $__env->startSection('title'); ?>
    Mounts
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1>Mounts<small>Configure and manage additional mount points for servers.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li class="active">Mounts</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Mount List</h3>

                    <div class="box-tools">
                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#newMountModal">Create New</button>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Source</th>
                                <th>Target</th>
                                <th class="text-center">Eggs</th>
                                <th class="text-center">Nodes</th>
                                <th class="text-center">Servers</th>
                            </tr>

                            <?php $__currentLoopData = $mounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><code><?php echo e($mount->id); ?></code></td>
                                    <td><a href="<?php echo e(route('admin.mounts.view', $mount->id)); ?>"><?php echo e($mount->name); ?></a></td>
                                    <td><code><?php echo e($mount->source); ?></code></td>
                                    <td><code><?php echo e($mount->target); ?></code></td>
                                    <td class="text-center"><?php echo e($mount->eggs_count); ?></td>
                                    <td class="text-center"><?php echo e($mount->nodes_count); ?></td>
                                    <td class="text-center"><?php echo e($mount->servers_count); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="newMountModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?php echo e(route('admin.mounts')); ?>" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="color: #FFFFFF">&times;</span>
                        </button>

                        <h4 class="modal-title">Create Mount</h4>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="pName" class="form-label">Name</label>
                                <input type="text" id="pName" name="name" class="form-control" />
                                <p class="text-muted small">Unique name used to separate this mount from another.</p>
                            </div>

                            <div class="col-md-12">
                                <label for="pDescription" class="form-label">Description</label>
                                <textarea id="pDescription" name="description" class="form-control" rows="4"></textarea>
                                <p class="text-muted small">A longer description for this mount, must be less than 191 characters.</p>
                            </div>

                            <div class="col-md-6">
                                <label for="pSource" class="form-label">Source</label>
                                <input type="text" id="pSource" name="source" class="form-control" />
                                <p class="text-muted small">File path on the host system to mount to a container.</p>
                            </div>

                            <div class="col-md-6">
                                <label for="pTarget" class="form-label">Target</label>
                                <input type="text" id="pTarget" name="target" class="form-control" />
                                <p class="text-muted small">Where the mount will be accessible inside a container.</p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Read Only</label>

                                <div>
                                    <div class="radio radio-success radio-inline">
                                        <input type="radio" id="pReadOnlyFalse" name="read_only" value="0" checked>
                                        <label for="pReadOnlyFalse">False</label>
                                    </div>

                                    <div class="radio radio-warning radio-inline">
                                        <input type="radio" id="pReadOnly" name="read_only" value="1">
                                        <label for="pReadOnly">True</label>
                                    </div>
                                </div>

                                <p class="text-muted small">Is the mount read only inside the container?</p>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">User Mountable</label>

                                <div>
                                    <div class="radio radio-success radio-inline">
                                        <input type="radio" id="pUserMountableFalse" name="user_mountable" value="0" checked>
                                        <label for="pUserMountableFalse">False</label>
                                    </div>

                                    <div class="radio radio-warning radio-inline">
                                        <input type="radio" id="pUserMountable" name="user_mountable" value="1">
                                        <label for="pUserMountable">True</label>
                                    </div>
                                </div>

                                <p class="text-muted small">Should users be able to mount this themselves?</p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <?php echo csrf_field(); ?>

                        <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success btn-sm">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/mounts/index.blade.php ENDPATH**/ ?>