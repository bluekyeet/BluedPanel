<?php $__env->startSection('users::nav'); ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom nav-tabs-floating">
                <ul class="nav nav-tabs">
                    <li <?php if($activeTab === 'overview'): ?>class="active"<?php endif; ?>><a href="<?php echo e(route('admin.users.view', ['user' => $user])); ?>">Overview</a></li>
                    <li <?php if($activeTab === 'storefront'): ?>class="active"<?php endif; ?>><a href="<?php echo e(route('admin.users.store', ['user' => $user])); ?>">Resources</a></li>
                </ul>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?><?php /**PATH /var/www/jexactyl/resources/views/partials/admin/users/nav.blade.php ENDPATH**/ ?>