<?php $__env->startSection('title'); ?>
    Server — <?php echo e($server->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1><?php echo e($server->name); ?><small><?php echo e(str_limit($server->description)); ?></small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li><a href="<?php echo e(route('admin.servers')); ?>">Servers</a></li>
        <li class="active"><?php echo e($server->name); ?></li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.servers.partials.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="row">
    <div class="col-sm-8">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Information</h3>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <td>Internal Identifier</td>
                                <td><code><?php echo e($server->id); ?></code></td>
                            </tr>
                            <tr>
                                <td>External Identifier</td>
                                <?php if(is_null($server->external_id)): ?>
                                    <td><span class="label label-default">Not Set</span></td>
                                <?php else: ?>
                                    <td><code><?php echo e($server->external_id); ?></code></td>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td>UUID / Docker Container ID</td>
                                <td><code><?php echo e($server->uuid); ?></code></td>
                            </tr>
                            <tr>
                                <td>Current Egg</td>
                                <td>
                                    <a href="<?php echo e(route('admin.nests.view', $server->nest_id)); ?>"><?php echo e($server->nest->name); ?></a> ::
                                    <a href="<?php echo e(route('admin.nests.egg.view', $server->egg_id)); ?>"><?php echo e($server->egg->name); ?></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Server Name</td>
                                <td><?php echo e($server->name); ?></td>
                            </tr>
                            <tr>
                                <td>CPU Limit</td>
                                <td>
                                    <?php if($server->cpu === 0): ?>
                                        <code>Unlimited</code>
                                    <?php else: ?>
                                        <code><?php echo e($server->cpu); ?>%</code>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>CPU Pinning</td>
                                <td>
                                    <?php if($server->threads != null): ?>
                                        <code><?php echo e($server->threads); ?></code>
                                    <?php else: ?>
                                        <span class="label label-default">Not Set</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Memory</td>
                                <td>
                                    <?php if($server->memory === 0): ?>
                                        <code>Unlimited</code>
                                    <?php else: ?>
                                        <code><?php echo e($server->memory); ?>MB</code>
                                    <?php endif; ?>
                                    /
                                    <?php if($server->swap === 0): ?>
                                        <code data-toggle="tooltip" data-placement="top" title="Swap Space">Not Set</code>
                                    <?php elseif($server->swap === -1): ?>
                                        <code data-toggle="tooltip" data-placement="top" title="Swap Space">Unlimited</code>
                                    <?php else: ?>
                                        <code data-toggle="tooltip" data-placement="top" title="Swap Space"> <?php echo e($server->swap); ?>MB</code>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Disk Space</td>
                                <td>
                                    <?php if($server->disk === 0): ?>
                                        <code>Unlimited</code>
                                    <?php else: ?>
                                        <code><?php echo e($server->disk); ?>MB</code>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Block IO Weight</td>
                                <td><code><?php echo e($server->io); ?></code></td>
                            </tr>
                            <tr>
                                <td>Default Connection</td>
                                <td><code><?php echo e($server->allocation->ip); ?>:<?php echo e($server->allocation->port); ?></code></td>
                            </tr>
                            <tr>
                                <td>Connection Alias</td>
                                <td>
                                    <?php if($server->allocation->alias !== $server->allocation->ip): ?>
                                        <code><?php echo e($server->allocation->alias); ?>:<?php echo e($server->allocation->port); ?></code>
                                    <?php else: ?>
                                        <span class="label label-default">No Alias Assigned</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="box box-primary">
            <div class="box-body" style="padding-bottom: 0px;">
                <div class="row">
                    <?php if($server->isSuspended()): ?>
                        <div class="col-sm-12">
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3 class="no-margin">Suspended</h3>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(!$server->isInstalled()): ?>
                        <div class="col-sm-12">
                            <div class="small-box <?php echo e((! $server->isInstalled()) ? 'bg-blue' : 'bg-maroon'); ?>">
                                <div class="inner">
                                    <h3 class="no-margin"><?php echo e((! $server->isInstalled()) ? 'Installing' : 'Install Failed'); ?></h3>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-sm-12">
                        <div class="small-box bg-gray">
                            <div class="inner">
                                <h3><?php echo e(str_limit($server->user->username, 16)); ?></h3>
                                <p>Server Owner</p>
                            </div>
                            <div class="icon"><i class="fa fa-user"></i></div>
                            <a href="<?php echo e(route('admin.users.view', $server->user->id)); ?>" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="small-box bg-gray">
                            <div class="inner">
                                <h3><?php echo e(str_limit($server->node->name, 16)); ?></h3>
                                <p>Server Node</p>
                            </div>
                            <div class="icon"><i class="fa fa-codepen"></i></div>
                            <a href="<?php echo e(route('admin.nodes.view', $server->node->id)); ?>" class="small-box-footer">
                                More info <i class="fa fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/servers/view/index.blade.php ENDPATH**/ ?>