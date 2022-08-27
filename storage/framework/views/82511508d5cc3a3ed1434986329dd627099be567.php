<?php $__env->startSection('jexactyl::nav'); ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li <?php if($activeTab === 'index'): ?>class="active"<?php endif; ?>><a href="<?php echo e(route('admin.index')); ?>">Home</a></li>
                    <li <?php if($activeTab === 'theme'): ?>class="active"<?php endif; ?>><a href="<?php echo e(route('admin.jexactyl.theme')); ?>">Appearance</a></li>
                    <li <?php if($activeTab === 'mail'): ?>class="active"<?php endif; ?>><a href="<?php echo e(route('admin.jexactyl.mail')); ?>">Mail</a></li>
                    <li <?php if($activeTab === 'advanced'): ?>class="active"<?php endif; ?>><a href="<?php echo e(route('admin.jexactyl.advanced')); ?>">Advanced</a></li>
                    <li style="margin-left: 5px; margin-right: 5px;"><a>-</a></li>
                    <li <?php if($activeTab === 'store'): ?>class="active"<?php endif; ?>><a href="<?php echo e(route('admin.jexactyl.store')); ?>">Storefront</a></li>
                    <li <?php if($activeTab === 'registration'): ?>class="active"<?php endif; ?>><a href="<?php echo e(route('admin.jexactyl.registration')); ?>">Registration</a></li>
                    <li <?php if($activeTab === 'approvals'): ?>class="active"<?php endif; ?>><a href="<?php echo e(route('admin.jexactyl.approvals')); ?>">Approvals</a></li>
                    <li <?php if($activeTab === 'server'): ?>class="active"<?php endif; ?>><a href="<?php echo e(route('admin.jexactyl.server')); ?>">Server Settings</a></li>
                    <li <?php if($activeTab === 'referrals'): ?>class="active"<?php endif; ?>><a href="<?php echo e(route('admin.jexactyl.referrals')); ?>">Referrals</a></li>
                    
                </ul>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php /**PATH /var/www/jexactyl/resources/views/partials/admin/jexactyl/nav.blade.php ENDPATH**/ ?>