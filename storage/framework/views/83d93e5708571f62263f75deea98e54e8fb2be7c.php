<?php echo $__env->make('partials/admin.users.nav', ['activeTab' => 'overview', 'user' => $user], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title'); ?>
    Manager User: <?php echo e($user->username); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1><?php echo e($user->name_first); ?> <?php echo e($user->name_last); ?><small><?php echo e($user->username); ?></small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li><a href="<?php echo e(route('admin.users')); ?>">Users</a></li>
        <li class="active"><?php echo e($user->username); ?></li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->yieldContent('users::nav'); ?>
    <div class="row">
        <form action="<?php echo e(route('admin.users.view', $user->id)); ?>" method="post">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Identity</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="email" class="control-label">Email</label>
                            <div>
                                <input type="email" name="email" value="<?php echo e($user->email); ?>" class="form-control form-autocomplete-stop">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="registered" class="control-label">Username</label>
                            <div>
                                <input type="text" name="username" value="<?php echo e($user->username); ?>" class="form-control form-autocomplete-stop">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="registered" class="control-label">Client First Name</label>
                            <div>
                                <input type="text" name="name_first" value="<?php echo e($user->name_first); ?>" class="form-control form-autocomplete-stop">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="registered" class="control-label">Client Last Name</label>
                            <div>
                                <input type="text" name="name_last" value="<?php echo e($user->name_last); ?>" class="form-control form-autocomplete-stop">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Default Language</label>
                            <div>
                                <select name="language" class="form-control">
                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($key); ?>" <?php if($user->language === $key): ?> selected <?php endif; ?>><?php echo e($value); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <p class="text-muted"><small>The default language to use when rendering the Panel for this user.</small></p>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <?php echo csrf_field(); ?>

                        <?php echo method_field('PATCH'); ?>

                        <input type="submit" value="Update User" class="btn btn-primary btn-sm">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Password</h3>
                    </div>
                    <div class="box-body">
                        <div class="alert alert-success" style="display:none;margin-bottom:10px;" id="gen_pass"></div>
                        <div class="form-group no-margin-bottom">
                            <label for="password" class="control-label">Password <span class="field-optional"></span></label>
                            <div>
                                <input type="password" id="password" name="password" class="form-control form-autocomplete-stop">
                                <p class="text-muted small">Leave blank to keep this user's password the same. User will not receive any notification if password is changed.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Permissions</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="root_admin" class="control-label">Administrator</label>
                            <div>
                                <select name="root_admin" class="form-control">
                                    <option value="0"><?php echo app('translator')->get('strings.no'); ?></option>
                                    <option value="1" <?php echo e($user->root_admin ? 'selected="selected"' : ''); ?>><?php echo app('translator')->get('strings.yes'); ?></option>
                                </select>
                                <p class="text-muted"><small>Setting this to 'Yes' gives a user full administrative access.</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Delete User</h3>
                </div>
                <div class="box-body">
                    <p class="no-margin">There must be no servers associated with this account in order for it to be deleted.</p>
                </div>
                <div class="box-footer">
                    <form action="<?php echo e(route('admin.users.view', $user->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <?php echo method_field('DELETE'); ?>

                        <input id="delete" type="submit" class="btn btn-sm btn-danger pull-right" <?php echo e($user->servers->count() < 1 ?: 'disabled'); ?> value="Delete User" />
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/users/view.blade.php ENDPATH**/ ?>