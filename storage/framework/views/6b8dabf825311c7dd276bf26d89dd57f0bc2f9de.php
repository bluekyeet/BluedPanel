<?php echo $__env->make('partials/admin.jexactyl.nav', ['activeTab' => 'store'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title'); ?>
    Jexactyl Settings
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1>Jexactyl Store<small>Configure the Jexactyl storefront.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li class="active">Jexactyl</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->yieldContent('jexactyl::nav'); ?>
    <div class="row">
        <div class="col-xs-12">
            <form action="<?php echo e(route('admin.jexactyl.store')); ?>" method="POST">
                <div class="box
                    <?php if($enabled == 'true'): ?>
                        box-success
                    <?php else: ?>
                        box-danger
                    <?php endif; ?>
                ">
                    <div class="box-header with-border">
                        <i class="fa fa-shopping-cart"></i> <h3 class="box-title">Jexactyl Storefront <small>Configure whether certain options for the store are enabled.</small></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">Storefront Enabled</label>
                                <div>
                                    <select name="store:enabled" class="form-control">
                                        <option <?php if($enabled == 'false'): ?> selected <?php endif; ?> value="false">Disabled</option>
                                        <option <?php if($enabled == 'true'): ?> selected <?php endif; ?> value="true">Enabled</option>
                                    </select>
                                    <p class="text-muted"><small>Determines whether users can access the store UI.</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">PayPal Enabled</label>
                                <div>
                                    <select name="store:paypal:enabled" class="form-control">
                                        <option <?php if($paypal_enabled == 'false'): ?> selected <?php endif; ?> value="false">Disabled</option>
                                        <option <?php if($paypal_enabled == 'true'): ?> selected <?php endif; ?> value="true">Enabled</option>
                                    </select>
                                    <p class="text-muted"><small>Determines whether users can buy credits with PayPal.</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Stripe Enabled</label>
                                <div>
                                    <select name="store:stripe:enabled" class="form-control">
                                        <option <?php if($stripe_enabled == 'false'): ?> selected <?php endif; ?> value="false">Disabled</option>
                                        <option <?php if($stripe_enabled == 'true'): ?> selected <?php endif; ?> value="true">Enabled</option>
                                    </select>
                                    <p class="text-muted"><small>Determines whether users can buy credits with Stripe.</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Name of currency</label>
                                <div>
                                    <select name="store:currency" class="form-control">
                                        <option <?php if($currency == 'EUR'): ?> selected <?php endif; ?> value="EUR">EUR (Euro)</option>
                                        <option <?php if($currency == 'USD'): ?> selected <?php endif; ?> value="USD">USD (US dollar)</option>
                                        <option <?php if($currency == 'JPY'): ?> selected <?php endif; ?> value="JPY">JPY (Japanese yen)</option>
                                        <option <?php if($currency == 'GBP'): ?> selected <?php endif; ?> value="EUR">GBP (Pound sterling)</option>                                        <option <?php if($currency == 'GBP'): ?> selected <?php endif; ?> value="EUR">GBP (Pound sterling)</option>
                                        <option <?php if($currency == 'CAD'): ?> selected <?php endif; ?> value="CAD">CAD (Canadian dollar)</option>
                                        <option <?php if($currency == 'AUD'): ?> selected <?php endif; ?> value="AUD">AUD (Australian dollar)</option>
                                    </select>
                                    <p class="text-muted"><small>The name of the currency used for Jexactyl.</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-info">
                    <div class="box-header with-border">
                        <i class="fa fa-money"></i> <h3 class="box-title">Idle Earning <small>Configure settings for passive credit earning.</small></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">Enabled</label>
                                <div>
                                    <select name="earn:enabled" class="form-control">
                                        <option <?php if($earn_enabled == 'false'): ?> selected <?php endif; ?> value="false">Disabled</option>
                                        <option <?php if($earn_enabled == 'true'): ?> selected <?php endif; ?> value="true">Enabled</option>
                                    </select>
                                    <p class="text-muted"><small>Determines whether users can earn credits passively.</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Amount of credits per minute</label>
                                <div>
                                    <input type="text" class="form-control" name="earn:amount" value="<?php echo e($earn_amount); ?>" />
                                    <p class="text-muted"><small>The amount of credits a user should be given per minute of AFK.</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-info">
                    <div class="box-header with-border">
                        <i class="fa fa-dollar"></i> <h3 class="box-title">Resource Pricing <small>Set specific pricing for resources.</small></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">Cost per 50% CPU</label>
                                <div>
                                    <input type="text" class="form-control" name="store:cost:cpu" value="<?php echo e($cpu); ?>" />
                                    <p class="text-muted"><small>Used to calculate the total cost for 50% CPU.</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Cost per 1GB RAM</label>
                                <div>
                                    <input type="text" class="form-control" name="store:cost:memory" value="<?php echo e($memory); ?>" />
                                    <p class="text-muted"><small>Used to calculate the total cost for 1GB of RAM.</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Cost per 1GB Disk</label>
                                <div>
                                    <input type="text" class="form-control" name="store:cost:disk" value="<?php echo e($disk); ?>" />
                                    <p class="text-muted"><small>Used to calculate the total cost for 1GB of disk.</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Cost per 1 Server Slot</label>
                                <div>
                                    <input type="text" class="form-control" name="store:cost:slot" value="<?php echo e($slot); ?>" />
                                    <p class="text-muted"><small>Used to calculate the total cost for 1 server slot.</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Cost per 1 Network Allocation</label>
                                <div>
                                    <input type="text" class="form-control" name="store:cost:port" value="<?php echo e($port); ?>" />
                                    <p class="text-muted"><small>Used to calculate the total cost for 1 port.</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Cost per 1 Server Backup</label>
                                <div>
                                    <input type="text" class="form-control" name="store:cost:backup" value="<?php echo e($backup); ?>" />
                                    <p class="text-muted"><small>Used to calculate the total cost for 1 backup.</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Cost per 1 Server Database</label>
                                <div>
                                    <input type="text" class="form-control" name="store:cost:database" value="<?php echo e($database); ?>" />
                                    <p class="text-muted"><small>Used to calculate the total cost for 1 database.</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-info">
                    <div class="box-header with-border">
                        <i class="fa fa-area-chart"></i> <h3 class="box-title">Resource Limits <small>Set limits for how many of each resource a server can be deployed with.</small></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">CPU limit</label>
                                <div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="store:limit:cpu" value="<?php echo e($limit_cpu); ?>" />
                                        <span class="input-group-addon">%</span>
                                    </div>
                                    <p class="text-muted"><small>The maximum amount of CPU a server can be deployed with. </small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">RAM limit</label>
                                <div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="store:limit:memory" value="<?php echo e($limit_memory); ?>" />
                                        <span class="input-group-addon">MB</span>
                                    </div>
                                    <p class="text-muted"><small>The maximum amount of RAM a server can be deployed with. </small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Disk limit</label>
                                <div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="store:limit:disk" value="<?php echo e($limit_disk); ?>" />
                                        <span class="input-group-addon">MB</span>
                                    </div>
                                    <p class="text-muted"><small>The maximum amount of disk a server can be deployed with. </small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Network Allocation limit</label>
                                <div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="store:limit:port" value="<?php echo e($limit_port); ?>" />
                                        <span class="input-group-addon">ports</span>
                                    </div>
                                    <p class="text-muted"><small>The maximum amount of ports (allocations) a server can be deployed with. </small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Backup limit</label>
                                <div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="store:limit:backup" value="<?php echo e($limit_backup); ?>" />
                                        <span class="input-group-addon">backups</span>
                                    </div>
                                    <p class="text-muted"><small>The maximum amount of backups a server can be deployed with. </small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Database limit</label>
                                <div>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="store:limit:database" value="<?php echo e($limit_database); ?>" />
                                        <span class="input-group-addon">databases</span>
                                    </div>
                                    <p class="text-muted"><small>The maximum amount of databases a server can be deployed with. </small></p>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/jexactyl/store.blade.php ENDPATH**/ ?>