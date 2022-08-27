<?php echo $__env->make('partials/admin.jexactyl.nav', ['activeTab' => 'theme'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title'); ?>
    Theme Settings
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1>Jexactyl Appearance<small>Configure the theme for Jexactyl.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li class="active">Jexactyl</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->yieldContent('jexactyl::nav'); ?>
    <div class="row">
        <div class="col-xs-12">
            <form action="<?php echo e(route('admin.jexactyl.theme')); ?>" method="POST">
                <div class="box box-info
                ">
                    <div class="box-header with-border">
                        <h3 class="box-title">Admin Themes <small>The selection for Jexactyl's theme.</small></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">Admin Theme</label>
                                <div>
                                    <select name="theme:admin" class="form-control">
                                        <option <?php if($admin == 'jexactyl'): ?> selected <?php endif; ?> value="jexactyl">Default Theme</option>
                                        <option <?php if($admin == 'dark'): ?> selected <?php endif; ?> value="dark">Dark Theme</option>
                                        <option <?php if($admin == 'light'): ?> selected <?php endif; ?> value="light">Light Theme</option>
                                        <option <?php if($admin == 'blue'): ?> selected <?php endif; ?> value="blue">Blue Theme</option>
                                        <option <?php if($admin == 'minecraft'): ?> selected <?php endif; ?> value="minecraft">Minecraft&#8482; Theme</option>
                                    </select>
                                    <p class="text-muted"><small>Determines the theme for Jexactyl's Admin UI.</small></p>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/jexactyl/theme.blade.php ENDPATH**/ ?>