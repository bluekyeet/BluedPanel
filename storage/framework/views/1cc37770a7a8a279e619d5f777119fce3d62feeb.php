<?php $__env->startSection('title'); ?>
    Server — <?php echo e($server->name); ?>: Manage
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1><?php echo e($server->name); ?><small>Additional actions to control this server.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li><a href="<?php echo e(route('admin.servers')); ?>">Servers</a></li>
        <li><a href="<?php echo e(route('admin.servers.view', $server->id)); ?>"><?php echo e($server->name); ?></a></li>
        <li class="active">Manage</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.servers.partials.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-sm-4">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Reinstall Server</h3>
                </div>
                <div class="box-body">
                    <p>This will reinstall the server with the assigned service scripts. <strong>Danger!</strong> This could overwrite server data.</p>
                </div>
                <div class="box-footer">
                    <?php if($server->isInstalled()): ?>
                        <form action="<?php echo e(route('admin.servers.view.manage.reinstall', $server->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <button type="submit" class="btn btn-danger">Reinstall Server</button>
                        </form>
                    <?php else: ?>
                        <button class="btn btn-danger disabled">Server Must Install Properly to Reinstall</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Install Status</h3>
                </div>
                <div class="box-body">
                    <p>If you need to change the install status from uninstalled to installed, or vice versa, you may do so with the button below.</p>
                </div>
                <div class="box-footer">
                    <form action="<?php echo e(route('admin.servers.view.manage.toggle', $server->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <button type="submit" class="btn btn-primary">Toggle Install Status</button>
                    </form>
                </div>
            </div>
        </div>

        <?php if(! $server->isSuspended()): ?>
            <div class="col-sm-4">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Suspend Server</h3>
                    </div>
                    <div class="box-body">
                        <p>This will suspend the server, stop any running processes, and immediately block the user from being able to access their files or otherwise manage the server through the panel or API.</p>
                    </div>
                    <div class="box-footer">
                        <form action="<?php echo e(route('admin.servers.view.manage.suspension', $server->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <input type="hidden" name="action" value="suspend" />
                            <button type="submit" class="btn btn-warning <?php if(! is_null($server->transfer)): ?> disabled <?php endif; ?>">Suspend Server</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="col-sm-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Unsuspend Server</h3>
                    </div>
                    <div class="box-body">
                        <p>This will unsuspend the server and restore normal user access.</p>
                    </div>
                    <div class="box-footer">
                        <form action="<?php echo e(route('admin.servers.view.manage.suspension', $server->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>

                            <input type="hidden" name="action" value="unsuspend" />
                            <button type="submit" class="btn btn-success">Unsuspend Server</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if(is_null($server->transfer)): ?>
            <div class="col-sm-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Transfer Server</h3>
                    </div>
                    <div class="box-body">
                        <p>
                            Transfer this server to another node connected to this panel.
                            <strong>Warning!</strong> This feature has not been fully tested and may have bugs.
                        </p>
                    </div>

                    <div class="box-footer">
                        <?php if($canTransfer): ?>
                            <button class="btn btn-success" data-toggle="modal" data-target="#transferServerModal">Transfer Server</button>
                        <?php else: ?>
                            <button class="btn btn-success disabled">Transfer Server</button>
                            <p style="padding-top: 1rem;">Transferring a server requires more than one node to be configured on your panel.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="col-sm-4">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Transfer Server</h3>
                    </div>
                    <div class="box-body">
                        <p>
                            This server is currently being transferred to another node.
                            Transfer was initiated at <strong><?php echo e($server->transfer->created_at); ?></strong>
                        </p>
                    </div>

                    <div class="box-footer">
                        <button class="btn btn-success disabled">Transfer Server</button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="modal fade" id="transferServerModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?php echo e(route('admin.servers.view.manage.transfer', $server->id)); ?>" method="POST">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Transfer Server</h4>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="pNodeId">Node</label>
                                <select name="node_id" id="pNodeId" class="form-control">
                                    <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <optgroup label="<?php echo e($location->long); ?> (<?php echo e($location->short); ?>)">
                                            <?php $__currentLoopData = $location->nodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $node): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <?php if($node->id != $server->node_id): ?>
                                                    <option value="<?php echo e($node->id); ?>"
                                                            <?php if($location->id === old('location_id')): ?> selected <?php endif; ?>
                                                    ><?php echo e($node->name); ?></option>
                                                <?php endif; ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </optgroup>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <p class="small text-muted no-margin">The node which this server will be transferred to.</p>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="pAllocation">Default Allocation</label>
                                <select name="allocation_id" id="pAllocation" class="form-control"></select>
                                <p class="small text-muted no-margin">The main allocation that will be assigned to this server.</p>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="pAllocationAdditional">Additional Allocation(s)</label>
                                <select name="allocation_additional[]" id="pAllocationAdditional" class="form-control" multiple></select>
                                <p class="small text-muted no-margin">Additional allocations to assign to this server on creation.</p>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <?php echo csrf_field(); ?>

                        <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success btn-sm">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('footer-scripts'); ?>
    <?php echo Theme::js('vendor/lodash/lodash.js'); ?>


    <?php if($canTransfer): ?>
        <?php echo Theme::js('js/admin/server/transfer.js'); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/servers/view/manage.blade.php ENDPATH**/ ?>