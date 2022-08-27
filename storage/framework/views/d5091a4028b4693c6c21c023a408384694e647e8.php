<?php $__env->startSection('title'); ?>
    Server — <?php echo e($server->name); ?>: Startup
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1><?php echo e($server->name); ?><small>Control startup command as well as variables.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li><a href="<?php echo e(route('admin.servers')); ?>">Servers</a></li>
        <li><a href="<?php echo e(route('admin.servers.view', $server->id)); ?>"><?php echo e($server->name); ?></a></li>
        <li class="active">Startup</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.servers.partials.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<form action="<?php echo e(route('admin.servers.view.startup', $server->id)); ?>" method="POST">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Startup Command Modification</h3>
                </div>
                <div class="box-body">
                    <label for="pStartup" class="form-label">Startup Command</label>
                    <input id="pStartup" name="startup" class="form-control" type="text" value="<?php echo e(old('startup', $server->startup)); ?>" />
                    <p class="small text-muted">Edit your server's startup command here. The following variables are available by default: <code>{{SERVER_MEMORY}}</code>, <code>{{SERVER_IP}}</code>, and <code>{{SERVER_PORT}}</code>.</p>
                </div>
                <div class="box-body">
                    <label for="pDefaultStartupCommand" class="form-label">Default Service Start Command</label>
                    <input id="pDefaultStartupCommand" class="form-control" type="text" readonly />
                </div>
                <div class="box-footer">
                    <?php echo csrf_field(); ?>

                    <button type="submit" class="btn btn-primary btn-sm pull-right">Save Modifications</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Service Configuration</h3>
                </div>
                <div class="box-body row">
                    <div class="col-xs-12">
                        <p class="small text-danger">
                            Changing any of the below values will result in the server processing a re-install command. The server will be stopped and will then proceed.
                            If you would like the service scripts to not run, ensure the box is checked at the bottom.
                        </p>
                        <p class="small text-danger">
                            <strong>This is a destructive operation in many cases. This server will be stopped immediately in order for this action to proceed.</strong>
                        </p>
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="pNestId">Nest</label>
                        <select name="nest_id" id="pNestId" class="form-control">
                            <?php $__currentLoopData = $nests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($nest->id); ?>"
                                    <?php if($nest->id === $server->nest_id): ?>
                                        selected
                                    <?php endif; ?>
                                ><?php echo e($nest->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <p class="small text-muted no-margin">Select the Nest that this server will be grouped into.</p>
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="pEggId">Egg</label>
                        <select name="egg_id" id="pEggId" class="form-control"></select>
                        <p class="small text-muted no-margin">Select the Egg that will provide processing data for this server.</p>
                    </div>
                    <div class="form-group col-xs-12">
                        <div class="checkbox checkbox-primary no-margin-bottom">
                            <input id="pSkipScripting" name="skip_scripts" type="checkbox" value="1" <?php if($server->skip_scripts): ?> checked <?php endif; ?> />
                            <label for="pSkipScripting" class="strong">Skip Egg Install Script</label>
                        </div>
                        <p class="small text-muted no-margin">If the selected Egg has an install script attached to it, the script will run during install. If you would like to skip this step, check this box.</p>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Docker Image Configuration</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="pDockerImage">Image</label>
                        <select id="pDockerImage" name="docker_image" class="form-control"></select>
                        <input id="pDockerImageCustom" name="custom_docker_image" value="<?php echo e(old('custom_docker_image')); ?>" class="form-control" placeholder="Or enter a custom image..." style="margin-top:1rem"/>
                        <p class="small text-muted no-margin">This is the Docker image that will be used to run this server. Select an image from the dropdown or enter a custom image in the text field above.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row" id="appendVariablesTo"></div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('footer-scripts'); ?>
    <?php echo Theme::js('vendor/lodash/lodash.js'); ?>

    <script>
    $(document).ready(function () {
        $('#pEggId').select2({placeholder: 'Select a Nest Egg'}).on('change', function () {
            var selectedEgg = _.isNull($(this).val()) ? $(this).find('option').first().val() : $(this).val();
            var parentChain = _.get(Pterodactyl.nests, $("#pNestId").val());
            var objectChain = _.get(parentChain, 'eggs.' + selectedEgg);

            const images = _.get(objectChain, 'docker_images', [])
            $('#pDockerImage').html('');
            const keys = Object.keys(images);
            for (let i = 0; i < keys.length; i++) {
                let opt = document.createElement('option');
                opt.value = images[keys[i]];
                opt.innerHTML = keys[i] + " (" + images[keys[i]] + ")";
                if (objectChain.id === parseInt(Pterodactyl.server.egg_id) && Pterodactyl.server.image == opt.value) {
                    opt.selected = true
                }
                $('#pDockerImage').append(opt);
            }
            $('#pDockerImage').on('change', function () {
                $('#pDockerImageCustom').val('');
            })

            if (objectChain.id === parseInt(Pterodactyl.server.egg_id)) {
                if ($('#pDockerImage').val() != Pterodactyl.server.image) {
                    $('#pDockerImageCustom').val(Pterodactyl.server.image);
                }
            }

            if (!_.get(objectChain, 'startup', false)) {
                $('#pDefaultStartupCommand').val(_.get(parentChain, 'startup', 'ERROR: Startup Not Defined!'));
            } else {
                $('#pDefaultStartupCommand').val(_.get(objectChain, 'startup'));
            }

            $('#appendVariablesTo').html('');
            $.each(_.get(objectChain, 'variables', []), function (i, item) {
                var setValue = _.get(Pterodactyl.server_variables, item.env_variable, item.default_value);
                var isRequired = (item.required === 1) ? '<span class="label label-danger">Required</span> ' : '';
                var dataAppend = ' \
                    <div class="col-xs-12"> \
                        <div class="box"> \
                            <div class="box-header with-border"> \
                                <h3 class="box-title">' + isRequired + item.name + '</h3> \
                            </div> \
                            <div class="box-body"> \
                                <input name="environment[' + item.env_variable + ']" class="form-control" type="text" id="egg_variable_' + item.env_variable + '" /> \
                                <p class="no-margin small text-muted">' + item.description + '</p> \
                            </div> \
                            <div class="box-footer"> \
                                <p class="no-margin text-muted small"><strong>Startup Command Variable:</strong> <code>' + item.env_variable + '</code></p> \
                                <p class="no-margin text-muted small"><strong>Input Rules:</strong> <code>' + item.rules + '</code></p> \
                            </div> \
                        </div> \
                    </div>';
                $('#appendVariablesTo').append(dataAppend).find('#egg_variable_' + item.env_variable).val(setValue);
            });
        });

        $('#pNestId').select2({placeholder: 'Select a Nest'}).on('change', function () {
            $('#pEggId').html('').select2({
                data: $.map(_.get(Pterodactyl.nests, $(this).val() + '.eggs', []), function (item) {
                    return {
                        id: item.id,
                        text: item.name,
                    };
                }),
            });

            if (_.isObject(_.get(Pterodactyl.nests, $(this).val() + '.eggs.' + Pterodactyl.server.egg_id))) {
                $('#pEggId').val(Pterodactyl.server.egg_id);
            }

            $('#pEggId').change();
        }).change();
    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/servers/view/startup.blade.php ENDPATH**/ ?>