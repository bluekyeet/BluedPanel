<?php $__env->startSection('title'); ?>
    Server — <?php echo e($server->name); ?>: Details
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1><?php echo e($server->name); ?><small>Edit details for this server including owner and container.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li><a href="<?php echo e(route('admin.servers')); ?>">Servers</a></li>
        <li><a href="<?php echo e(route('admin.servers.view', $server->id)); ?>"><?php echo e($server->name); ?></a></li>
        <li class="active">Details</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.servers.partials.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Base Information</h3>
            </div>
            <form action="<?php echo e(route('admin.servers.view.details', $server->id)); ?>" method="POST">
                <div class="box-body">
                    <div class="form-group">
                        <label for="name" class="control-label">Server Name <span class="field-required"></span></label>
                        <input type="text" name="name" value="<?php echo e(old('name', $server->name)); ?>" class="form-control" />
                        <p class="text-muted small">Character limits: <code>a-zA-Z0-9_-</code> and <code>[Space]</code>.</p>
                    </div>
                    <div class="form-group">
                        <label for="external_id" class="control-label">External Identifier</label>
                        <input type="text" name="external_id" value="<?php echo e(old('external_id', $server->external_id)); ?>" class="form-control" />
                        <p class="text-muted small">Leave empty to not assign an external identifier for this server. The external ID should be unique to this server and not be in use by any other servers.</p>
                    </div>
                    <div class="form-group">
                        <label for="pUserId" class="control-label">Server Owner <span class="field-required"></span></label>
                        <select name="owner_id" class="form-control" id="pUserId">
                            <option value="<?php echo e($server->owner_id); ?>" selected><?php echo e($server->user->email); ?></option>
                        </select>
                        <p class="text-muted small">You can change the owner of this server by changing this field to an email matching another use on this system. If you do this a new daemon security token will be generated automatically.</p>
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label">Server Description</label>
                        <textarea name="description" rows="3" class="form-control"><?php echo e(old('description', $server->description)); ?></textarea>
                        <p class="text-muted small">A brief description of this server.</p>
                    </div>
                    <div class="form-group">
                        <label for="renewable" class="control-label">Renewable <span class="field-required"></span></label>
                        <select name="renewable" class="form-control">
                            <option <?php if(!$server->renewable): ?> selected <?php endif; ?> value="0">Disabled</option>
                            <option <?php if($server->renewable): ?> selected <?php endif; ?> value="1">Enabled</option>
                        </select>
                        <p class="text-muted small">Determines whether this server is renewed by the renewal system or not.</p>
                    </div>
                    <div class="form-group">
                        <label for="renewal" class="control-label">Days until renewal <span class="field-required"></span></label>
                        <input type="text" name="renewal" value="<?php echo e($server->renewal); ?>" class="form-control" />
                        <p class="text-muted small">Set the amount of days until the server must be renewed.</p>
                    </div>
                </div>
                <div class="box-footer">
                    <?php echo csrf_field(); ?>

                    <?php echo method_field('PATCH'); ?>

                    <input type="submit" class="btn btn-sm btn-primary" value="Update Details" />
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('footer-scripts'); ?>
    <script>
    function escapeHtml(str) {
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(str));
        return div.innerHTML;
    }

    $('#pUserId').select2({
        ajax: {
            url: '/admin/users/accounts.json',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    filter: { email: params.term },
                    page: params.page,
                };
            },
            processResults: function (data, params) {
                return { results: data };
            },
            cache: true,
        },
        escapeMarkup: function (markup) { return markup; },
        minimumInputLength: 2,
        templateResult: function (data) {
            if (data.loading) return escapeHtml(data.text);

            return '<div class="user-block"> \
                <img class="img-circle img-bordered-xs" src="https://www.gravatar.com/avatar/' + escapeHtml(data.md5) + '?s=120" alt="User Image"> \
                <span class="username"> \
                    <a href="#">' + escapeHtml(data.name_first) + ' ' + escapeHtml(data.name_last) +'</a> \
                </span> \
                <span class="description"><strong>' + escapeHtml(data.email) + '</strong> - ' + escapeHtml(data.username) + '</span> \
            </div>';
        },
        templateSelection: function (data) {
            if (typeof data.name_first === 'undefined') {
                data = {
                    md5: '<?php echo e(md5(strtolower($server->user->email))); ?>',
                    name_first: '<?php echo e($server->user->name_first); ?>',
                    name_last: '<?php echo e($server->user->name_last); ?>',
                    email: '<?php echo e($server->user->email); ?>',
                    id: <?php echo e($server->owner_id); ?>

                };
            }

            return '<div> \
                <span> \
                    <img class="img-rounded img-bordered-xs" src="https://www.gravatar.com/avatar/' + escapeHtml(data.md5) + '?s=120" style="height:28px;margin-top:-4px;" alt="User Image"> \
                </span> \
                <span style="padding-left:5px;"> \
                    ' + escapeHtml(data.name_first) + ' ' + escapeHtml(data.name_last) + ' (<strong>' + escapeHtml(data.email) + '</strong>) \
                </span> \
            </div>';
        }
    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/servers/view/details.blade.php ENDPATH**/ ?>