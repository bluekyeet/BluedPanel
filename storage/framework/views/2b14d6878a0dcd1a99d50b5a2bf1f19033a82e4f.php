<?php $__env->startSection('title'); ?>
    Nests &rarr; Egg: <?php echo e($egg->name); ?> &rarr; Install Script
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1><?php echo e($egg->name); ?><small>Manage the install script for this Egg.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li><a href="<?php echo e(route('admin.nests')); ?>">Nests</a></li>
        <li><a href="<?php echo e(route('admin.nests.view', $egg->nest->id)); ?>"><?php echo e($egg->nest->name); ?></a></li>
        <li><a href="<?php echo e(route('admin.nests.egg.view', $egg->id)); ?>"><?php echo e($egg->name); ?></a></li>
        <li class="active"><?php echo e($egg->name); ?></li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom nav-tabs-floating">
            <ul class="nav nav-tabs">
                <li><a href="<?php echo e(route('admin.nests.egg.view', $egg->id)); ?>">Configuration</a></li>
                <li><a href="<?php echo e(route('admin.nests.egg.variables', $egg->id)); ?>">Variables</a></li>
                <li class="active"><a href="<?php echo e(route('admin.nests.egg.scripts', $egg->id)); ?>">Install Script</a></li>
            </ul>
        </div>
    </div>
</div>
<form action="<?php echo e(route('admin.nests.egg.scripts', $egg->id)); ?>" method="POST">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Install Script</h3>
                </div>
                <?php if(! is_null($egg->copyFrom)): ?>
                    <div class="box-body">
                        <div class="callout callout-warning no-margin">
                            This service option is copying installation scripts and container options from <a href="<?php echo e(route('admin.nests.egg.view', $egg->copyFrom->id)); ?>"><?php echo e($egg->copyFrom->name); ?></a>. Any changes you make to this script will not apply unless you select "None" from the dropdown box below.
                        </div>
                    </div>
                <?php endif; ?>
                <div class="box-body no-padding">
                    <div id="editor_install"style="height:300px"><?php echo e($egg->script_install); ?></div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label class="control-label">Copy Script From</label>
                            <select id="pCopyScriptFrom" name="copy_script_from">
                                <option value="">None</option>
                                <?php $__currentLoopData = $copyFromOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($opt->id); ?>" <?php echo e($egg->copy_script_from !== $opt->id ?: 'selected'); ?>><?php echo e($opt->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <p class="text-muted small">If selected, script above will be ignored and script from selected option will be used in place.</p>
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="control-label">Script Container</label>
                            <input type="text" name="script_container" class="form-control" value="<?php echo e($egg->script_container); ?>" />
                            <p class="text-muted small">Docker container to use when running this script for the server.</p>
                        </div>
                        <div class="form-group col-sm-4">
                            <label class="control-label">Script Entrypoint Command</label>
                            <input type="text" name="script_entry" class="form-control" value="<?php echo e($egg->script_entry); ?>" />
                            <p class="text-muted small">The entrypoint command to use for this script.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 text-muted">
                            The following service options rely on this script:
                            <?php if(count($relyOnScript) > 0): ?>
                                <?php $__currentLoopData = $relyOnScript; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rely): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('admin.nests.egg.view', $rely->id)); ?>">
                                        <code><?php echo e($rely->name); ?></code><?php if(!$loop->last): ?>,&nbsp;<?php endif; ?>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <em>none</em>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <?php echo csrf_field(); ?>

                    <textarea name="script_install" class="hidden"></textarea>
                    <button type="submit" name="_method" value="PATCH" class="btn btn-primary btn-sm pull-right">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('footer-scripts'); ?>
    <?php echo Theme::js('vendor/ace/ace.js'); ?>

    <?php echo Theme::js('vendor/ace/ext-modelist.js'); ?>

    <script>
    $(document).ready(function () {
        $('#pCopyScriptFrom').select2();

        const InstallEditor = ace.edit('editor_install');
        const Modelist = ace.require('ace/ext/modelist')

        InstallEditor.setTheme('ace/theme/chrome');
        InstallEditor.getSession().setMode('ace/mode/sh');
        InstallEditor.getSession().setUseWrapMode(true);
        InstallEditor.setShowPrintMargin(false);

        $('form').on('submit', function (e) {
            $('textarea[name="script_install"]').val(InstallEditor.getValue());
        });
    });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/eggs/scripts.blade.php ENDPATH**/ ?>