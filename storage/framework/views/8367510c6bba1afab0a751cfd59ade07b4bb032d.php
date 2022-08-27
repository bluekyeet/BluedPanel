<?php echo $__env->make('partials/admin.jexactyl.nav', ['activeTab' => 'referrals'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title'); ?>
    Referral System
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1>Referral System<small>Allow users to refer others to the Panel to earn resources.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li class="active">Jexactyl</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->yieldContent('jexactyl::nav'); ?>
    <div class="row">
        <div class="col-xs-12">
        <form action="<?php echo e(route('admin.jexactyl.referrals')); ?>" method="POST">
                <div class="box
                    <?php if($enabled == 'true'): ?>
                        box-success
                    <?php else: ?>
                        box-danger
                    <?php endif; ?>
                ">
                    <div class="box-header with-border">
                        <i class="fa fa-user-plus"></i> <h3 class="box-title">Referrals <small>Allow users to refer others to the Panel.</small></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">Referral System</label>
                                <div>
                                    <select name="enabled" class="form-control">
                                        <option <?php if($enabled == 'false'): ?> selected <?php endif; ?> value="false">Disabled</option>
                                        <option <?php if($enabled == 'true'): ?> selected <?php endif; ?> value="true">Enabled</option>
                                    </select>
                                    <p class="text-muted"><small>Determines whether users can refer others.</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Reward per referral</label>
                                <div>
                                    <div class="input-group">
                                        <input type="text" id="reward" name="reward" class="form-control" value="<?php echo e($reward); ?>" />
                                        <span class="input-group-addon">credits</span>
                                    </div>
                                    <p class="text-muted"><small>The amount of credits to give users when they refer someone, and when someone uses a referral code.</small></p>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/jexactyl/referrals.blade.php ENDPATH**/ ?>