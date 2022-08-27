<?php echo $__env->make('partials/admin.users.nav', ['activeTab' => 'storefront', 'user' => $user], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title'); ?>
    Storefront Details: <?php echo e($user->username); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1><?php echo e($user->name_first); ?> <?php echo e($user->name_last); ?><small><?php echo e($user->username); ?></small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li><a href="<?php echo e(route('admin.users')); ?>">Users</a></li>
        <li class="<?php echo e(route('admin.users.view', ['user' => $user])); ?>"><?php echo e($user->username); ?></li>
        <li class="active">Storefront</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->yieldContent('users::nav'); ?>
    <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">User Resources</h3>
                    </div>
                    <form action="<?php echo e(route('admin.users.store', $user->id)); ?>" method="POST">
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="store_balance" class="control-label">Total balance</label>
                                    <input type="text" id="store_balance" value="<?php echo e($user->store_balance); ?>" name="store_balance" class="form-control form-autocomplete-stop">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="store_cpu" class="control-label">Total CPU available</label>
                                    <input type="text" id="store_cpu" value="<?php echo e($user->store_cpu); ?>" name="store_cpu" class="form-control form-autocomplete-stop">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="store_memory" class="control-label">Total Memory (RAM) available</label>
                                    <input type="text" id="store_memory" value="<?php echo e($user->store_memory); ?>" name="store_memory" class="form-control form-autocomplete-stop">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="store_disk" class="control-label">Total Disk available</label>
                                    <input type="text" id="store_disk" value="<?php echo e($user->store_disk); ?>" name="store_disk" class="form-control form-autocomplete-stop">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="store_slots" class="control-label">Server slots available</label>
                                    <input type="text" id="store_slots" value="<?php echo e($user->store_slots); ?>" name="store_slots" class="form-control form-autocomplete-stop">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="store_ports" class="control-label">Total Ports available</label>
                                    <input type="text" id="store_ports" value="<?php echo e($user->store_ports); ?>" name="store_ports" class="form-control form-autocomplete-stop">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="store_backups" class="control-label">Total Backups available</label>
                                    <input type="text" id="store_backups" value="<?php echo e($user->store_backups); ?>" name="store_backups" class="form-control form-autocomplete-stop">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="store_databases" class="control-label">Total Databases available</label>
                                    <input type="text" id="store_databases" value="<?php echo e($user->store_databases); ?>" name="store_databases" class="form-control form-autocomplete-stop">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <?php echo csrf_field(); ?>

                            <button type="submit" name="_method" value="PATCH" class="btn btn-sm btn-primary pull-right">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/users/store.blade.php ENDPATH**/ ?>