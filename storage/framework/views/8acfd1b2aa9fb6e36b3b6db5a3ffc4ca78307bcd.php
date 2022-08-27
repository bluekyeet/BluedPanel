<?php echo $__env->make('partials/admin.jexactyl.nav', ['activeTab' => 'server'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title'); ?>
    Jexactyl Servers
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1>Server Settings<small>Configure Jexactyl's server settings.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li class="active">Jexactyl</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->yieldContent('jexactyl::nav'); ?>
    <div class="row">
        <div class="col-xs-12">
            <form action="<?php echo e(route('admin.jexactyl.server')); ?>" method="POST">
                <div class="box
                    <?php if($enabled == 'true'): ?>
                        box-success
                    <?php else: ?>
                        box-danger
                    <?php endif; ?>
                ">
                    <div class="box-header with-border">
                        <i class="fa fa-clock-o"></i> <h3 class="box-title">Server Renewals <small>Configure settings for server renewals.</small></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">Renewal System</label>
                                <div>
                                    <select name="enabled" class="form-control">
                                        <option <?php if($enabled == 'false'): ?> selected <?php endif; ?> value="false">Disabled</option>
                                        <option <?php if($enabled == 'true'): ?> selected <?php endif; ?> value="true">Enabled</option>
                                    </select>
                                    <p class="text-muted"><small>Determines whether users must renew their servers.</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Default Renewal Timer</label>
                                <div>
                                    <div class="input-group">
                                        <input type="text" id="default" name="default" class="form-control" value="<?php echo e($default); ?>" />
                                        <span class="input-group-addon">days</span>
                                    </div>
                                    <p class="text-muted"><small>Determines the amount of days that servers have before their first renewal is due.</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Renewal cost</label>
                                <div>
                                    <div class="input-group">
                                        <input type="text" id="cost" name="cost" class="form-control" value="<?php echo e($cost); ?>" />
                                        <span class="input-group-addon">credits</span>
                                    </div>
                                    <p class="text-muted"><small>Determines the amount of credits that a renewal costs.</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box
                    <?php if($editing == 'true'): ?>
                        box-success
                    <?php else: ?>
                        box-danger
                    <?php endif; ?>
                ">
                    <div class="box-header with-border">
                        <i class="fa fa-server"></i> <h3 class="box-title">Server Settings <small>Configure settings for servers.</small></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">Server Resource Editing</label>
                                <div>
                                    <select name="editing" class="form-control">
                                        <option <?php if($editing == 'false'): ?> selected <?php endif; ?> value="false">Disabled</option>
                                        <option <?php if($editing == 'true'): ?> selected <?php endif; ?> value="true">Enabled</option>
                                    </select>
                                    <p class="text-muted"><small>Determines whether users can edit the amount of resources assigned to their server.</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo csrf_field(); ?>

                <button type="submit" name="_method" value="PATCH" class="btn btn-default pull-right">Save Changes</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/jexactyl/server.blade.php ENDPATH**/ ?>