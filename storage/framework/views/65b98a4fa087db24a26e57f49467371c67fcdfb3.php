<?php $__env->startSection('title'); ?>
    Nodes &rarr; New
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1>New Node<small>Create a new local or remote node for servers to be installed to.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li><a href="<?php echo e(route('admin.nodes')); ?>">Nodes</a></li>
        <li class="active">New</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('admin.nodes.new')); ?>" method="POST">
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Basic Details</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="pName" class="form-label">Name</label>
                        <input type="text" name="name" id="pName" class="form-control" value="<?php echo e(old('name')); ?>"/>
                        <p class="text-muted small">Character limits: <code>a-zA-Z0-9_.-</code> and <code>[Space]</code> (min 1, max 100 characters).</p>
                    </div>
                    <div class="form-group">
                        <label for="pDescription" class="form-label">Description</label>
                        <textarea name="description" id="pDescription" rows="4" class="form-control"><?php echo e(old('description')); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="pLocationId" class="form-label">Location</label>
                        <select name="location_id" id="pLocationId">
                            <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($location->id); ?>" <?php echo e($location->id != old('location_id') ?: 'selected'); ?>><?php echo e($location->short); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Node Visibility</label>
                        <div>
                            <div class="radio radio-success radio-inline">

                                <input type="radio" id="pPublicTrue" value="1" name="public" checked>
                                <label for="pPublicTrue"> Public </label>
                            </div>
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" id="pPublicFalse" value="0" name="public">
                                <label for="pPublicFalse"> Private </label>
                            </div>
                        </div>
                        <p class="text-muted small">By setting a node to <code>private</code> you will be denying the ability to auto-deploy to this node.
                    </div>
                    <div class="form-group">
                        <label class="form-label">Deployable via Jexactyl Store</label>
                        <div>
                            <div class="radio radio-success radio-inline">
                                <input type="radio" id="pDeployableTrue" value="1" name="deployable" checked>
                                <label for="pDeployableTrue"> Allow </label>
                            </div>
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" id="pDeployableFalse" value="0" name="deployable">
                                <label for="pDeployableFalse"> Deny </label>
                            </div>
                        </div>
                        <p class="text-muted"><small>
                            This option allows you to control whether this node is visible via the Server Creation page of the Jexactyl Storefront.
                            If it is set to disabled, users will not be able to deploy on this node.
                        </small></p>
                    </div>
                    <div class="form-group">
                        <label for="pFQDN" class="form-label">FQDN</label>
                        <input type="text" name="fqdn" id="pFQDN" class="form-control" value="<?php echo e(old('fqdn')); ?>"/>
                        <p class="text-muted small">Please enter domain name (e.g <code>node.example.com</code>) to be used for connecting to the daemon. An IP address may be used <em>only</em> if you are not using SSL for this node.</p>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Communicate Over SSL</label>
                        <div>
                            <div class="radio radio-success radio-inline">
                                <input type="radio" id="pSSLTrue" value="https" name="scheme" checked>
                                <label for="pSSLTrue"> Use SSL Connection</label>
                            </div>
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" id="pSSLFalse" value="http" name="scheme" <?php if(request()->isSecure()): ?> disabled <?php endif; ?>>
                                <label for="pSSLFalse"> Use HTTP Connection</label>
                            </div>
                        </div>
                        <?php if(request()->isSecure()): ?>
                            <p class="text-danger small">Your Panel is currently configured to use a secure connection. In order for browsers to connect to your node it <strong>must</strong> use a SSL connection.</p>
                        <?php else: ?>
                            <p class="text-muted small">In most cases you should select to use a SSL connection. If using an IP Address or you do not wish to use SSL at all, select a HTTP connection.</p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Behind Proxy</label>
                        <div>
                            <div class="radio radio-success radio-inline">
                                <input type="radio" id="pProxyFalse" value="0" name="behind_proxy" checked>
                                <label for="pProxyFalse"> Not Behind Proxy </label>
                            </div>
                            <div class="radio radio-info radio-inline">
                                <input type="radio" id="pProxyTrue" value="1" name="behind_proxy">
                                <label for="pProxyTrue"> Behind Proxy </label>
                            </div>
                        </div>
                        <p class="text-muted small">If you are running the daemon behind a proxy such as Cloudflare, select this to have the daemon skip looking for certificates on boot.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Configuration</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="pDaemonBase" class="form-label">Daemon Server File Directory</label>
                            <input type="text" name="daemonBase" id="pDaemonBase" class="form-control" value="/var/lib/pterodactyl/volumes" />
                            <p class="text-muted small">Enter the directory where server files should be stored. <strong>If you use OVH you should check your partition scheme. You may need to use <code>/home/daemon-data</code> to have enough space.</strong></p>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pMemory" class="form-label">Total Memory</label>
                            <div class="input-group">
                                <input type="text" name="memory" data-multiplicator="true" class="form-control" id="pMemory" value="<?php echo e(old('memory')); ?>"/>
                                <span class="input-group-addon">MB</span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pMemoryOverallocate" class="form-label">Memory Over-Allocation</label>
                            <div class="input-group">
                                <input type="text" name="memory_overallocate" class="form-control" id="pMemoryOverallocate" value="<?php echo e(old('memory_overallocate')); ?>"/>
                                <span class="input-group-addon">%</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p class="text-muted small">Enter the total amount of memory available for new servers. If you would like to allow overallocation of memory enter the percentage that you want to allow. To disable checking for overallocation enter <code>-1</code> into the field. Entering <code>0</code> will prevent creating new servers if it would put the node over the limit.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="pDisk" class="form-label">Total Disk Space</label>
                            <div class="input-group">
                                <input type="text" name="disk" data-multiplicator="true" class="form-control" id="pDisk" value="<?php echo e(old('disk')); ?>"/>
                                <span class="input-group-addon">MB</span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pDiskOverallocate" class="form-label">Disk Over-Allocation</label>
                            <div class="input-group">
                                <input type="text" name="disk_overallocate" class="form-control" id="pDiskOverallocate" value="<?php echo e(old('disk_overallocate')); ?>"/>
                                <span class="input-group-addon">%</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p class="text-muted small">Enter the total amount of disk space available for new servers. If you would like to allow overallocation of disk space enter the percentage that you want to allow. To disable checking for overallocation enter <code>-1</code> into the field. Entering <code>0</code> will prevent creating new servers if it would put the node over the limit.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="pDaemonListen" class="form-label">Daemon Port</label>
                            <input type="text" name="daemonListen" class="form-control" id="pDaemonListen" value="8080" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pDaemonSFTP" class="form-label">Daemon SFTP Port</label>
                            <input type="text" name="daemonSFTP" class="form-control" id="pDaemonSFTP" value="2022" />
                        </div>
                        <div class="col-md-12">
                            <p class="text-muted small">The daemon runs its own SFTP management container and does not use the SSHd process on the main physical server. <Strong>Do not use the same port that you have assigned for your physical server's SSH process.</strong> If you will be running the daemon behind CloudFlare&reg; you should set the daemon port to <code>8443</code> to allow websocket proxying over SSL.</p>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <?php echo csrf_field(); ?>

                    <button type="submit" class="btn btn-success pull-right">Create Node</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('footer-scripts'); ?>
    <script>
        $('#pLocationId').select2();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/nodes/new.blade.php ENDPATH**/ ?>