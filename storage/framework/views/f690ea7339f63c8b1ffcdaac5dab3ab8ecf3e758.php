<?php $__env->startSection('title'); ?>
    List Nodes
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>
    <?php echo Theme::css('vendor/fontawesome/animation.min.css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1>Nodes<small>All nodes available on the system.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li class="active">Nodes</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Node List</h3>
                <div class="box-tools search01">
                    <form action="<?php echo e(route('admin.nodes')); ?>" method="GET">
                        <div class="input-group input-group-sm">
                            <input type="text" name="filter[name]" class="form-control pull-right" value="<?php echo e(request()->input('filter.name')); ?>" placeholder="Search Nodes">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                <a href="<?php echo e(route('admin.nodes.new')); ?>"><button type="button" class="btn btn-sm btn-primary" style="border-radius: 0 3px 3px 0;margin-left:-1px;">Create New</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Memory</th>
                            <th>Disk</th>
                            <th class="text-center">Servers</th>
                            <th class="text-center">SSL</th>
                            <th class="text-center">Public</th>
                        </tr>
                        <?php $__currentLoopData = $nodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $node): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center text-muted left-icon" data-action="ping" data-secret="<?php echo e($node->getDecryptedKey()); ?>" data-location="<?php echo e($node->scheme); ?>://<?php echo e($node->fqdn); ?>:<?php echo e($node->daemonListen); ?>/api/system"><i class="fa fa-fw fa-refresh fa-spin"></i></td>
                                <td><?php echo $node->maintenance_mode ? '<span class="label label-warning"><i class="fa fa-wrench"></i></span> ' : ''; ?><a href="<?php echo e(route('admin.nodes.view', $node->id)); ?>"><?php echo e($node->name); ?></a></td>
                                <td><?php echo e($node->location->short); ?></td>
                                <td><?php echo e($node->memory); ?> MB</td>
                                <td><?php echo e($node->disk); ?> MB</td>
                                <td class="text-center"><?php echo e($node->servers_count); ?></td>
                                <td class="text-center" style="color:<?php echo e(($node->scheme === 'https') ? '#50af51' : '#d9534f'); ?>"><i class="fa fa-<?php echo e(($node->scheme === 'https') ? 'lock' : 'unlock'); ?>"></i></td>
                                <td class="text-center"><i class="fa fa-<?php echo e(($node->public) ? 'eye' : 'eye-slash'); ?>"></i></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php if($nodes->hasPages()): ?>
                <div class="box-footer with-border">
                    <div class="col-md-12 text-center"><?php echo $nodes->appends(['query' => Request::input('query')])->render(); ?></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('footer-scripts'); ?>
    <script>
    (function pingNodes() {
        $('td[data-action="ping"]').each(function(i, element) {
            $.ajax({
                type: 'GET',
                url: $(element).data('location'),
                headers: {
                    'Authorization': 'Bearer ' + $(element).data('secret'),
                },
                timeout: 5000
            }).done(function (data) {
                $(element).find('i').tooltip({
                    title: 'v' + data.version,
                });
                $(element).removeClass('text-muted').find('i').removeClass().addClass('fa fa-fw fa-heartbeat faa-pulse animated').css('color', '#50af51');
            }).fail(function (error) {
                var errorText = 'Error connecting to node! Check browser console for details.';
                try {
                    errorText = error.responseJSON.errors[0].detail || errorText;
                } catch (ex) {}

                $(element).removeClass('text-muted').find('i').removeClass().addClass('fa fa-fw fa-heart-o').css('color', '#d9534f');
                $(element).find('i').tooltip({ title: errorText });
            });
        }).promise().done(function () {
            setTimeout(pingNodes, 10000);
        });
    })();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/nodes/index.blade.php ENDPATH**/ ?>