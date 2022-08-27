<?php $__env->startSection('title'); ?>
    <?php echo e($node->name); ?>: Configuration
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1><?php echo e($node->name); ?><small>Your daemon configuration file.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li><a href="<?php echo e(route('admin.nodes')); ?>">Nodes</a></li>
        <li><a href="<?php echo e(route('admin.nodes.view', $node->id)); ?>"><?php echo e($node->name); ?></a></li>
        <li class="active">Configuration</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom nav-tabs-floating">
            <ul class="nav nav-tabs">
                <li><a href="<?php echo e(route('admin.nodes.view', $node->id)); ?>">About</a></li>
                <li><a href="<?php echo e(route('admin.nodes.view.settings', $node->id)); ?>">Settings</a></li>
                <li class="active"><a href="<?php echo e(route('admin.nodes.view.configuration', $node->id)); ?>">Configuration</a></li>
                <li><a href="<?php echo e(route('admin.nodes.view.allocation', $node->id)); ?>">Allocation</a></li>
                <li><a href="<?php echo e(route('admin.nodes.view.servers', $node->id)); ?>">Servers</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Configuration File</h3>
            </div>
            <div class="box-body">
                <pre class="no-margin"><?php echo e($node->getYamlConfiguration()); ?></pre>
            </div>
            <div class="box-footer">
                <p class="no-margin">This file should be placed in your daemon's root directory (usually <code>/etc/pterodactyl</code>) in a file called <code>config.yml</code>.</p>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Auto-Deploy</h3>
            </div>
            <div class="box-body">
                <p class="text-muted small">
                    Use the button below to generate a custom deployment command that can be used to configure
                    wings on the target server with a single command.
                </p>
            </div>
            <div class="box-footer">
                <button type="button" id="configTokenBtn" class="btn btn-sm btn-default" style="width:100%;">Generate Token</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('footer-scripts'); ?>
    <script>
    $('#configTokenBtn').on('click', function (event) {
        $.ajax({
            method: 'POST',
            url: '<?php echo e(route('admin.nodes.view.configuration.token', $node->id)); ?>',
            headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
        }).done(function (data) {
            swal({
                type: 'success',
                title: 'Token created.',
                text: '<p>To auto-configure your node run the following command:<br /><small><pre>cd /etc/pterodactyl && sudo wings configure --panel-url <?php echo e(config('app.url')); ?> --token ' + data.token + ' --node ' + data.node + '<?php echo e(config('app.debug') ? ' --allow-insecure' : ''); ?></pre></small></p>',
                html: true
            })
        }).fail(function () {
            swal({
                title: 'Error',
                text: 'Something went wrong creating your token.',
                type: 'error'
            });
        });
    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/nodes/view/configuration.blade.php ENDPATH**/ ?>