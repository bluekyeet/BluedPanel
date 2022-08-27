<?php $__env->startSection('title'); ?>
    Database Hosts
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1>Database Hosts<small>Database hosts that servers can have databases created on.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li class="active">Database Hosts</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Host List</h3>
                <div class="box-tools">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#newHostModal">Create New</button>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Host</th>
                            <th>Port</th>
                            <th>Username</th>
                            <th class="text-center">Databases</th>
                            <th class="text-center">Node</th>
                        </tr>
                        <?php $__currentLoopData = $hosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $host): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><code><?php echo e($host->id); ?></code></td>
                                <td><a href="<?php echo e(route('admin.databases.view', $host->id)); ?>"><?php echo e($host->name); ?></a></td>
                                <td><code><?php echo e($host->host); ?></code></td>
                                <td><code><?php echo e($host->port); ?></code></td>
                                <td><?php echo e($host->username); ?></td>
                                <td class="text-center"><?php echo e($host->databases_count); ?></td>
                                <td class="text-center">
                                    <?php if(! is_null($host->node)): ?>
                                        <a href="<?php echo e(route('admin.nodes.view', $host->node->id)); ?>"><?php echo e($host->node->name); ?></a>
                                    <?php else: ?>
                                        <span class="label label-default">None</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="newHostModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?php echo e(route('admin.databases')); ?>" method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Create New Database Host</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pName" class="form-label">Name</label>
                        <input type="text" name="name" id="pName" class="form-control" />
                        <p class="text-muted small">A short identifier used to distinguish this location from others. Must be between 1 and 60 characters, for example, <code>us.nyc.lvl3</code>.</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="pHost" class="form-label">Host</label>
                            <input type="text" name="host" id="pHost" class="form-control" />
                            <p class="text-muted small">The IP address or FQDN that should be used when attempting to connect to this MySQL host <em>from the panel</em> to add new databases.</p>
                        </div>
                        <div class="col-md-6">
                            <label for="pPort" class="form-label">Port</label>
                            <input type="text" name="port" id="pPort" class="form-control" value="3306"/>
                            <p class="text-muted small">The port that MySQL is running on for this host.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="pUsername" class="form-label">Username</label>
                            <input type="text" name="username" id="pUsername" class="form-control" />
                            <p class="text-muted small">The username of an account that has enough permissions to create new users and databases on the system.</p>
                        </div>
                        <div class="col-md-6">
                            <label for="pPassword" class="form-label">Password</label>
                            <input type="password" name="password" id="pPassword" class="form-control" />
                            <p class="text-muted small">The password to the account defined.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pNodeId" class="form-label">Linked Node</label>
                        <select name="node_id" id="pNodeId" class="form-control">
                            <option value="">None</option>
                            <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <optgroup label="<?php echo e($location->short); ?>">
                                    <?php $__currentLoopData = $location->nodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $node): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($node->id); ?>"><?php echo e($node->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </optgroup>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <p class="text-muted small">This setting does nothing other than default to this database host when adding a database to a server on the selected node.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <p class="text-danger small text-left">The account defined for this database host <strong>must</strong> have the <code>WITH GRANT OPTION</code> permission. If the defined account does not have this permission requests to create databases <em>will</em> fail. <strong>Do not use the same account details for MySQL that you have defined for this panel.</strong></p>
                    <?php echo csrf_field(); ?>

                    <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success btn-sm">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('footer-scripts'); ?>
    <script>
        $('#pNodeId').select2();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/databases/index.blade.php ENDPATH**/ ?>