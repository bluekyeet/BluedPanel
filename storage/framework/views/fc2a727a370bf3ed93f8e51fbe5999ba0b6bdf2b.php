<?php $__env->startSection('title'); ?>
    Nests &rarr; New Egg
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1>New Egg<small>Create a new Egg to assign to servers.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li><a href="<?php echo e(route('admin.nests')); ?>">Nests</a></li>
        <li class="active">New Egg</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('admin.nests.egg.new')); ?>" method="POST">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Configuration</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pNestId" class="form-label">Associated Nest</label>
                                <div>
                                    <select name="nest_id" id="pNestId">
                                        <?php $__currentLoopData = $nests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($nest->id); ?>" <?php echo e(old('nest_id') != $nest->id ?: 'selected'); ?>><?php echo e($nest->name); ?> &lt;<?php echo e($nest->author); ?>&gt;</option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <p class="text-muted small">Think of a Nest as a category. You can put multiple Eggs in a nest, but consider putting only Eggs that are related to each other in each Nest.</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pName" class="form-label">Name</label>
                                <input type="text" id="pName" name="name" value="<?php echo e(old('name')); ?>" class="form-control" />
                                <p class="text-muted small">A simple, human-readable name to use as an identifier for this Egg. This is what users will see as their game server type.</p>
                            </div>
                            <div class="form-group">
                                <label for="pDescription" class="form-label">Description</label>
                                <textarea id="pDescription" name="description" class="form-control" rows="8"><?php echo e(old('description')); ?></textarea>
                                <p class="text-muted small">A description of this Egg.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pDockerImage" class="control-label">Docker Images</label>
                                <textarea id="pDockerImages" name="docker_images" rows="4" placeholder="quay.io/pterodactyl/service" class="form-control"><?php echo e(old('docker_images')); ?></textarea>
                                <p class="text-muted small">The docker images available to servers using this egg. Enter one per line. Users will be able to select from this list of images if more than one value is provided.</p>
                            </div>
                            <div class="form-group">
                                <label for="pStartup" class="control-label">Startup Command</label>
                                <textarea id="pStartup" name="startup" class="form-control" rows="10"><?php echo e(old('startup')); ?></textarea>
                                <p class="text-muted small">The default startup command that should be used for new servers created with this Egg. You can change this per-server as needed.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Process Management</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="alert alert-warning">
                                <p>All fields are required unless you select a separate option from the 'Copy Settings From' dropdown, in which case fields may be left blank to use the values from that option.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pConfigFrom" class="form-label">Copy Settings From</label>
                                <select name="config_from" id="pConfigFrom" class="form-control">
                                    <option value="">None</option>
                                </select>
                                <p class="text-muted small">If you would like to default to settings from another Egg select it from the dropdown above.</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigStop" class="form-label">Stop Command</label>
                                <input type="text" id="pConfigStop" name="config_stop" class="form-control" value="<?php echo e(old('config_stop')); ?>" />
                                <p class="text-muted small">The command that should be sent to server processes to stop them gracefully. If you need to send a <code>SIGINT</code> you should enter <code>^C</code> here.</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigLogs" class="form-label">Log Configuration</label>
                                <textarea data-action="handle-tabs" id="pConfigLogs" name="config_logs" class="form-control" rows="6"><?php echo e(old('config_logs')); ?></textarea>
                                <p class="text-muted small">This should be a JSON representation of where log files are stored, and whether or not the daemon should be creating custom logs.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pConfigFiles" class="form-label">Configuration Files</label>
                                <textarea data-action="handle-tabs" id="pConfigFiles" name="config_files" class="form-control" rows="6"><?php echo e(old('config_files')); ?></textarea>
                                <p class="text-muted small">This should be a JSON representation of configuration files to modify and what parts should be changed.</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigStartup" class="form-label">Start Configuration</label>
                                <textarea data-action="handle-tabs" id="pConfigStartup" name="config_startup" class="form-control" rows="6"><?php echo e(old('config_startup')); ?></textarea>
                                <p class="text-muted small">This should be a JSON representation of what values the daemon should be looking for when booting a server to determine completion.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <?php echo csrf_field(); ?>

                    <button type="submit" class="btn btn-success btn-sm pull-right">Create</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('footer-scripts'); ?>
    <?php echo Theme::js('vendor/lodash/lodash.js'); ?>

    <script>
    $(document).ready(function() {
        $('#pNestId').select2().change();
        $('#pConfigFrom').select2();
    });
    $('#pNestId').on('change', function (event) {
        $('#pConfigFrom').html('<option value="">None</option>').select2({
            data: $.map(_.get(Pterodactyl.nests, $(this).val() + '.eggs', []), function (item) {
                return {
                    id: item.id,
                    text: item.name + ' <' + item.author + '>',
                };
            }),
        });
    });
    $('textarea[data-action="handle-tabs"]').on('keydown', function(event) {
        if (event.keyCode === 9) {
            event.preventDefault();

            var curPos = $(this)[0].selectionStart;
            var prepend = $(this).val().substr(0, curPos);
            var append = $(this).val().substr(curPos);

            $(this).val(prepend + '    ' + append);
        }
    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/eggs/new.blade.php ENDPATH**/ ?>