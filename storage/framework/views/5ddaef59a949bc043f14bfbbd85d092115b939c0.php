<?php $__env->startSection('title'); ?>
    Egg &rarr; <?php echo e($egg->name); ?> &rarr; Variables
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1><?php echo e($egg->name); ?><small>Managing variables for this Egg.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li><a href="<?php echo e(route('admin.nests')); ?>">Nests</a></li>
        <li><a href="<?php echo e(route('admin.nests.view', $egg->nest->id)); ?>"><?php echo e($egg->nest->name); ?></a></li>
        <li><a href="<?php echo e(route('admin.nests.egg.view', $egg->id)); ?>"><?php echo e($egg->name); ?></a></li>
        <li class="active">Variables</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="nav-tabs-custom nav-tabs-floating">
            <ul class="nav nav-tabs">
                <li><a href="<?php echo e(route('admin.nests.egg.view', $egg->id)); ?>">Configuration</a></li>
                <li class="active"><a href="<?php echo e(route('admin.nests.egg.variables', $egg->id)); ?>">Variables</a></li>
                <li><a href="<?php echo e(route('admin.nests.egg.scripts', $egg->id)); ?>">Install Script</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box no-border">
            <div class="box-body">
                <a href="#" class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#newVariableModal">Create New Variable</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <?php $__currentLoopData = $egg->variables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variable): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-sm-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo e($variable->name); ?></h3>
                </div>
                <form action="<?php echo e(route('admin.nests.egg.variables.edit', ['egg' => $egg->id, 'variable' => $variable->id])); ?>" method="POST">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" value="<?php echo e($variable->name); ?>" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"><?php echo e($variable->description); ?></textarea>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">Environment Variable</label>
                                <input type="text" name="env_variable" value="<?php echo e($variable->env_variable); ?>" class="form-control" />
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label">Default Value</label>
                                <input type="text" name="default_value" value="<?php echo e($variable->default_value); ?>" class="form-control" />
                            </div>
                            <div class="col-xs-12">
                                <p class="text-muted small">This variable can be accessed in the startup command by using <code><?php echo e($variable->env_variable); ?></code>.</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Permissions</label>
                            <select name="options[]" class="pOptions form-control" multiple>
                                <option value="user_viewable" <?php echo e((! $variable->user_viewable) ?: 'selected'); ?>>Users Can View</option>
                                <option value="user_editable" <?php echo e((! $variable->user_editable) ?: 'selected'); ?>>Users Can Edit</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Input Rules</label>
                            <input type="text" name="rules" class="form-control" value="<?php echo e($variable->rules); ?>" />
                            <p class="text-muted small">These rules are defined using standard <a href="https://laravel.com/docs/5.7/validation#available-validation-rules" target="_blank">Laravel Framework validation rules</a>.</p>
                        </div>
                    </div>
                    <div class="box-footer">
                        <?php echo csrf_field(); ?>

                        <button class="btn btn-sm btn-primary pull-right" name="_method" value="PATCH" type="submit">Save</button>
                        <button class="btn btn-sm btn-danger pull-left muted muted-hover" data-action="delete" name="_method" value="DELETE" type="submit"><i class="fa fa-trash-o"></i></button>
                    </div>
                </form>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="modal fade" id="newVariableModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create New Egg Variable</h4>
            </div>
            <form action="<?php echo e(route('admin.nests.egg.variables', $egg->id)); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Name <span class="field-required"></span></label>
                        <input type="text" name="name" class="form-control" value="<?php echo e(old('name')); ?>"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Description</label>
                        <textarea name="description" class="form-control" rows="3"><?php echo e(old('description')); ?></textarea>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label">Environment Variable <span class="field-required"></span></label>
                            <input type="text" name="env_variable" class="form-control" value="<?php echo e(old('env_variable')); ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Default Value</label>
                            <input type="text" name="default_value" class="form-control" value="<?php echo e(old('default_value')); ?>" />
                        </div>
                        <div class="col-xs-12">
                            <p class="text-muted small">This variable can be accessed in the startup command by entering <code>{{environment variable value}}</code>.</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Permissions</label>
                        <select name="options[]" class="pOptions form-control" multiple>
                            <option value="user_viewable">Users Can View</option>
                            <option value="user_editable">Users Can Edit</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Input Rules <span class="field-required"></span></label>
                        <input type="text" name="rules" class="form-control" value="<?php echo e(old('rules', 'required|string|max:20')); ?>" placeholder="required|string|max:20" />
                        <p class="text-muted small">These rules are defined using standard <a href="https://laravel.com/docs/5.7/validation#available-validation-rules" target="_blank">Laravel Framework validation rules</a>.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php echo csrf_field(); ?>

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Variable</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('footer-scripts'); ?>
    <script>
        $('.pOptions').select2();
        $('[data-action="delete"]').on('mouseenter', function (event) {
            $(this).find('i').html(' Delete Variable');
        }).on('mouseleave', function (event) {
            $(this).find('i').html('');
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/eggs/variables.blade.php ENDPATH**/ ?>