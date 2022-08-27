<?php
    /** @var \Pterodactyl\Models\Server $server */
    $router = app('router');
?>
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom nav-tabs-floating">
            <ul class="nav nav-tabs">
                <li class="<?php echo e($router->currentRouteNamed('admin.servers.view') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('admin.servers.view', $server->id)); ?>">About</a></li>
                <?php if($server->isInstalled()): ?>
                    <li class="<?php echo e($router->currentRouteNamed('admin.servers.view.details') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.servers.view.details', $server->id)); ?>">Details</a>
                    </li>
                    <li class="<?php echo e($router->currentRouteNamed('admin.servers.view.build') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.servers.view.build', $server->id)); ?>">Build Configuration</a>
                    </li>
                    <li class="<?php echo e($router->currentRouteNamed('admin.servers.view.startup') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.servers.view.startup', $server->id)); ?>">Startup</a>
                    </li>
                    <li class="<?php echo e($router->currentRouteNamed('admin.servers.view.database') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.servers.view.database', $server->id)); ?>">Database</a>
                    </li>
                    <li class="<?php echo e($router->currentRouteNamed('admin.servers.view.mounts') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('admin.servers.view.mounts', $server->id)); ?>">Mounts</a>
                    </li>
                <?php endif; ?>
                <li class="<?php echo e($router->currentRouteNamed('admin.servers.view.manage') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('admin.servers.view.manage', $server->id)); ?>">Manage</a>
                </li>
                <li class="tab-danger <?php echo e($router->currentRouteNamed('admin.servers.view.delete') ? 'active' : ''); ?>">
                    <a href="<?php echo e(route('admin.servers.view.delete', $server->id)); ?>">Delete</a>
                </li>
                <li class="tab-success">
                    <a href="/server/<?php echo e($server->uuidShort); ?>" target="_blank"><i class="fa fa-external-link"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH /var/www/jexactyl/resources/views/admin/servers/partials/navigation.blade.php ENDPATH**/ ?>