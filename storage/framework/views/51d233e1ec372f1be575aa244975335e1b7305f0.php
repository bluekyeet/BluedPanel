<?php $__env->startSection('title'); ?>
    Server — <?php echo e($server->name); ?>: Databases
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1><?php echo e($server->name); ?><small>Manage server databases.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li><a href="<?php echo e(route('admin.servers')); ?>">Servers</a></li>
        <li><a href="<?php echo e(route('admin.servers.view', $server->id)); ?>"><?php echo e($server->name); ?></a></li>
        <li class="active">Databases</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.servers.partials.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="row">
    <div class="col-sm-7">
        <div class="alert alert-info">
            Database passwords can be viewed when <a href="/server/<?php echo e($server->uuidShort); ?>/databases">visiting this server</a> on the front-end.
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Active Databases</h3>
            </div>
            <div class="box-body table-responsible no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>Database</th>
                        <th>Username</th>
                        <th>Connections From</th>
                        <th>Host</th>
                        <th>Max Connections</th>
                        <th></th>
                    </tr>
                    <?php $__currentLoopData = $server->databases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $database): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($database->database); ?></td>
                            <td><?php echo e($database->username); ?></td>
                            <td><?php echo e($database->remote); ?></td>
                            <td><code><?php echo e($database->host->host); ?>:<?php echo e($database->host->port); ?></code></td>
                            <?php if($database->max_connections != null): ?>
                                <td><?php echo e($database->max_connections); ?></td>
                            <?php else: ?>
                                <td>Unlimited</td>
                            <?php endif; ?>
                            <td class="text-center">
                                <button data-action="reset-password" data-id="<?php echo e($database->id); ?>" class="btn btn-xs btn-primary"><i class="fa fa-refresh"></i></button>
                                <button data-action="remove" data-id="<?php echo e($database->id); ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Create New Database</h3>
            </div>
            <form action="<?php echo e(route('admin.servers.view.database', $server->id)); ?>" method="POST">
                <div class="box-body">
                    <div class="form-group">
                        <label for="pDatabaseHostId" class="control-label">Database Host</label>
                        <select id="pDatabaseHostId" name="database_host_id" class="form-control">
                            <?php $__currentLoopData = $hosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $host): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($host->id); ?>"><?php echo e($host->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <p class="text-muted small">Select the host database server that this database should be created on.</p>
                    </div>
                    <div class="form-group">
                        <label for="pDatabaseName" class="control-label">Database</label>
                        <div class="input-group">
                            <span class="input-group-addon">s<?php echo e($server->id); ?>_</span>
                            <input id="pDatabaseName" type="text" name="database" class="form-control" placeholder="database" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pRemote" class="control-label">Connections</label>
                        <input id="pRemote" type="text" name="remote" class="form-control" value="%" />
                        <p class="text-muted small">This should reflect the IP address that connections are allowed from. Uses standard MySQL notation. If unsure leave as <code>%</code>.</p>
                    </div>
                    <div class="form-group">
                        <label for="pmax_connections" class="control-label">Concurrent Connections</label>
                        <input id="pmax_connections" type="text" name="max_connections" class="form-control"/>
                        <p class="text-muted small">This should reflect the max number of concurrent connections from this user to the database. Leave empty for unlimited.</p>
                    </div>
                </div>
                <div class="box-footer">
                    <?php echo csrf_field(); ?>

                    <p class="text-muted small no-margin">A username and password for this database will be randomly generated after form submission.</p>
                    <input type="submit" class="btn btn-sm btn-success pull-right" value="Create Database" />
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('footer-scripts'); ?>
    <script>
    $('#pDatabaseHost').select2();
    $('[data-action="remove"]').click(function (event) {
        event.preventDefault();
        var self = $(this);
        swal({
            title: '',
            type: 'warning',
            text: 'Are you sure that you want to delete this database? There is no going back, all data will immediately be removed.',
            showCancelButton: true,
            confirmButtonText: 'Delete',
            confirmButtonColor: '#d9534f',
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
        }, function () {
            $.ajax({
                method: 'DELETE',
                url: '/admin/servers/view/<?php echo e($server->id); ?>/database/' + self.data('id') + '/delete',
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
            }).done(function () {
                self.parent().parent().slideUp();
                swal.close();
            }).fail(function (jqXHR) {
                console.error(jqXHR);
                swal({
                    type: 'error',
                    title: 'Whoops!',
                    text: (typeof jqXHR.responseJSON.error !== 'undefined') ? jqXHR.responseJSON.error : 'An error occurred while processing this request.'
                });
            });
        });
    });
    $('[data-action="reset-password"]').click(function (e) {
        e.preventDefault();
        var block = $(this);
        $(this).addClass('disabled').find('i').addClass('fa-spin');
        $.ajax({
            type: 'PATCH',
            url: '/admin/servers/view/<?php echo e($server->id); ?>/database',
            headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
            data: { database: $(this).data('id') },
        }).done(function (data) {
            swal({
                type: 'success',
                title: '',
                text: 'The password for this database has been reset.',
            });
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error(jqXHR);
            var error = 'An error occurred while trying to process this request.';
            if (typeof jqXHR.responseJSON !== 'undefined' && typeof jqXHR.responseJSON.error !== 'undefined') {
                error = jqXHR.responseJSON.error;
            }
            swal({
                type: 'error',
                title: 'Whoops!',
                text: error
            });
        }).always(function () {
            block.removeClass('disabled').find('i').removeClass('fa-spin');
        });
    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/servers/view/database.blade.php ENDPATH**/ ?>