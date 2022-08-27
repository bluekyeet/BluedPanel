<?php $__env->startSection('title'); ?>
    List Servers
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1>Servers<small>All servers available on the system.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li class="active">Servers</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Server List</h3>
                <div class="box-tools search01">
                    <form action="<?php echo e(route('admin.servers')); ?>" method="GET">
                        <div class="input-group input-group-sm">
                            <input type="text" name="filter[*]" class="form-control pull-right" value="<?php echo e(request()->input()['filter']['*'] ?? ''); ?>" placeholder="Search Servers">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                <a href="<?php echo e(route('admin.servers.new')); ?>"><button type="button" class="btn btn-sm btn-primary" style="border-radius: 0 3px 3px 0;margin-left:-1px;">Create New</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Server Name</th>
                            <th>UUID</th>
                            <th>Owner</th>
                            <th>Node</th>
                            <th>Connection</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php $__currentLoopData = $servers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $server): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr data-server="<?php echo e($server->uuidShort); ?>">
                                <td><a href="<?php echo e(route('admin.servers.view', $server->id)); ?>"><?php echo e($server->name); ?></a></td>
                                <td><code title="<?php echo e($server->uuid); ?>"><?php echo e($server->uuid); ?></code></td>
                                <td><a href="<?php echo e(route('admin.users.view', $server->user->id)); ?>"><?php echo e($server->user->username); ?></a></td>
                                <td><a href="<?php echo e(route('admin.nodes.view', $server->node->id)); ?>"><?php echo e($server->node->name); ?></a></td>
                                <td>
                                    <code><?php echo e($server->allocation->alias); ?>:<?php echo e($server->allocation->port); ?></code>
                                </td>
                                <td class="text-center">
                                    <?php if($server->isSuspended()): ?>
                                        <span class="label bg-maroon">Suspended</span>
                                    <?php elseif(! $server->isInstalled()): ?>
                                        <span class="label label-warning">Installing</span>
                                    <?php else: ?>
                                        <span class="label label-success">Active</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-xs btn-default" href="/server/<?php echo e($server->uuidShort); ?>"><i class="fa fa-wrench"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php if($servers->hasPages()): ?>
                <div class="box-footer with-border">
                    <div class="col-md-12 text-center"><?php echo $servers->appends(['filter' => Request::input('filter')])->render(); ?></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('footer-scripts'); ?>
    <script>
        $('.console-popout').on('click', function (event) {
            event.preventDefault();
            window.open($(this).attr('href'), 'Pterodactyl Console', 'width=800,height=400');
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/servers/index.blade.php ENDPATH**/ ?>