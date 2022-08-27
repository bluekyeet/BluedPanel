<?php $__env->startSection('title'); ?>
    Server — <?php echo e($server->name); ?>: Build Details
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1><?php echo e($server->name); ?><small>Control allocations and system resources for this server.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li><a href="<?php echo e(route('admin.servers')); ?>">Servers</a></li>
        <li><a href="<?php echo e(route('admin.servers.view', $server->id)); ?>"><?php echo e($server->name); ?></a></li>
        <li class="active">Build Configuration</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.servers.partials.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="row">
    <form action="<?php echo e(route('admin.servers.view.build', $server->id)); ?>" method="POST">
        <div class="col-sm-5">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Resource Management</h3>
                </div>
                <div class="box-body">
                <div class="form-group">
                        <label for="cpu" class="control-label">CPU Limit</label>
                        <div class="input-group">
                            <input type="text" name="cpu" class="form-control" value="<?php echo e(old('cpu', $server->cpu)); ?>"/>
                            <span class="input-group-addon">%</span>
                        </div>
                        <p class="text-muted small">Each <em>virtual</em> core (thread) on the system is considered to be <code>100%</code>. Setting this value to <code>0</code> will allow a server to use CPU time without restrictions.</p>
                    </div>
                    <div class="form-group">
                        <label for="threads" class="control-label">CPU Pinning</label>
                        <div>
                            <input type="text" name="threads" class="form-control" value="<?php echo e(old('threads', $server->threads)); ?>"/>
                        </div>
                        <p class="text-muted small"><strong>Advanced:</strong> Enter the specific CPU cores that this process can run on, or leave blank to allow all cores. This can be a single number, or a comma seperated list. Example: <code>0</code>, <code>0-1,3</code>, or <code>0,1,3,4</code>.</p>
                    </div>
                    <div class="form-group">
                        <label for="memory" class="control-label">Allocated Memory</label>
                        <div class="input-group">
                            <input type="text" name="memory" data-multiplicator="true" class="form-control" value="<?php echo e(old('memory', $server->memory)); ?>"/>
                            <span class="input-group-addon">MB</span>
                        </div>
                        <p class="text-muted small">The maximum amount of memory allowed for this container. Setting this to <code>0</code> will allow unlimited memory in a container.</p>
                    </div>
                    <div class="form-group">
                        <label for="swap" class="control-label">Allocated Swap</label>
                        <div class="input-group">
                            <input type="text" name="swap" data-multiplicator="true" class="form-control" value="<?php echo e(old('swap', $server->swap)); ?>"/>
                            <span class="input-group-addon">MB</span>
                        </div>
                        <p class="text-muted small">Setting this to <code>0</code> will disable swap space on this server. Setting to <code>-1</code> will allow unlimited swap.</p>
                    </div>
                    <div class="form-group">
                        <label for="cpu" class="control-label">Disk Space Limit</label>
                        <div class="input-group">
                            <input type="text" name="disk" class="form-control" value="<?php echo e(old('disk', $server->disk)); ?>"/>
                            <span class="input-group-addon">MB</span>
                        </div>
                        <p class="text-muted small">This server will not be allowed to boot if it is using more than this amount of space. If a server goes over this limit while running it will be safely stopped and locked until enough space is available. Set to <code>0</code> to allow unlimited disk usage.</p>
                    </div>
                    <div class="form-group">
                        <label for="io" class="control-label">Block IO Proportion</label>
                        <div>
                            <input type="text" name="io" class="form-control" value="<?php echo e(old('io', $server->io)); ?>"/>
                        </div>
                        <p class="text-muted small"><strong>Advanced</strong>: The IO performance of this server relative to other <em>running</em> containers on the system. Value should be between <code>10</code> and <code>1000</code>.</code></p>
                    </div>
                    <div class="form-group">
                        <label for="cpu" class="control-label">OOM Killer</label>
                        <div>
                            <div class="radio radio-danger radio-inline">
                                <input type="radio" id="pOomKillerEnabled" value="0" name="oom_disabled" <?php if(!$server->oom_disabled): ?>checked <?php endif; ?>>
                                <label for="pOomKillerEnabled">Enabled</label>
                            </div>
                            <div class="radio radio-success radio-inline">
                                <input type="radio" id="pOomKillerDisabled" value="1" name="oom_disabled" <?php if($server->oom_disabled): ?>checked <?php endif; ?>>
                                <label for="pOomKillerDisabled">Disabled</label>
                            </div>
                            <p class="text-muted small">
                                Enabling OOM killer may cause server processes to exit unexpectedly.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Application Feature Limits</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-xs-6">
                                    <label for="database_limit" class="control-label">Database Limit</label>
                                    <div>
                                        <input type="text" name="database_limit" class="form-control" value="<?php echo e(old('database_limit', $server->database_limit)); ?>"/>
                                    </div>
                                    <p class="text-muted small">The total number of databases a user is allowed to create for this server.</p>
                                </div>
                                <div class="form-group col-xs-6">
                                    <label for="allocation_limit" class="control-label">Allocation Limit</label>
                                    <div>
                                        <input type="text" name="allocation_limit" class="form-control" value="<?php echo e(old('allocation_limit', $server->allocation_limit)); ?>"/>
                                    </div>
                                    <p class="text-muted small">The total number of allocations a user is allowed to create for this server.</p>
                                </div>
                                <div class="form-group col-xs-6">
                                    <label for="backup_limit" class="control-label">Backup Limit</label>
                                    <div>
                                        <input type="text" name="backup_limit" class="form-control" value="<?php echo e(old('backup_limit', $server->backup_limit)); ?>"/>
                                    </div>
                                    <p class="text-muted small">The total number of backups that can be created for this server.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Allocation Management</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="pAllocation" class="control-label">Game Port</label>
                                <select id="pAllocation" name="allocation_id" class="form-control">
                                    <?php $__currentLoopData = $assigned; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($assignment->id); ?>"
                                            <?php if($assignment->id === $server->allocation_id): ?>
                                                selected="selected"
                                            <?php endif; ?>
                                        ><?php echo e($assignment->alias); ?>:<?php echo e($assignment->port); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <p class="text-muted small">The default connection address that will be used for this game server.</p>
                            </div>
                            <div class="form-group">
                                <label for="pAddAllocations" class="control-label">Assign Additional Ports</label>
                                <div>
                                    <select name="add_allocations[]" class="form-control" multiple id="pAddAllocations">
                                        <?php $__currentLoopData = $unassigned; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($assignment->id); ?>"><?php echo e($assignment->alias); ?>:<?php echo e($assignment->port); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <p class="text-muted small">Please note that due to software limitations you cannot assign identical ports on different IPs to the same server.</p>
                            </div>
                            <div class="form-group">
                                <label for="pRemoveAllocations" class="control-label">Remove Additional Ports</label>
                                <div>
                                    <select name="remove_allocations[]" class="form-control" multiple id="pRemoveAllocations">
                                        <?php $__currentLoopData = $assigned; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assignment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($assignment->id); ?>"><?php echo e($assignment->alias); ?>:<?php echo e($assignment->port); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <p class="text-muted small">Simply select which ports you would like to remove from the list above. If you want to assign a port on a different IP that is already in use you can select it from the left and delete it here.</p>
                            </div>
                        </div>
                        <div class="box-footer">
                            <?php echo csrf_field(); ?>

                            <button type="submit" class="btn btn-primary pull-right">Update Build Configuration</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('footer-scripts'); ?>
    <script>
    $('#pAddAllocations').select2();
    $('#pRemoveAllocations').select2();
    $('#pAllocation').select2();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/servers/view/build.blade.php ENDPATH**/ ?>