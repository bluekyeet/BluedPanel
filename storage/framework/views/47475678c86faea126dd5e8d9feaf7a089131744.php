<?php $__env->startSection('title'); ?>
    New Server
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1>Create Server<small>Add a new server to the panel.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li><a href="<?php echo e(route('admin.servers')); ?>">Servers</a></li>
        <li class="active">Create Server</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('admin.servers.new')); ?>" method="POST">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Core Details</h3>
                </div>

                <div class="box-body row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pName">Server Name</label>
                            <input type="text" class="form-control" id="pName" name="name" value="<?php echo e(old('name')); ?>" placeholder="Server Name">
                            <p class="small text-muted no-margin">Character limits: <code>a-z A-Z 0-9 _ - .</code> and <code>[Space]</code>.</p>
                        </div>

                        <div class="form-group">
                            <label for="pUserId">Server Owner</label>
                            <select id="pUserId" name="owner_id" class="form-control" style="padding-left:0;"></select>
                            <p class="small text-muted no-margin">Email address of the Server Owner.</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pDescription" class="control-label">Server Description</label>
                            <textarea id="pDescription" name="description" rows="3" class="form-control"><?php echo e(old('description')); ?></textarea>
                            <p class="text-muted small">A brief description of this server.</p>
                        </div>

                        <div class="form-group">
                            <div class="checkbox checkbox-primary no-margin-bottom">
                                <input id="pStartOnCreation" name="start_on_completion" type="checkbox" <?php echo e(\Pterodactyl\Helpers\Utilities::checked('start_on_completion', 1)); ?> />
                                <label for="pStartOnCreation" class="strong">Start Server when Installed</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="overlay" id="allocationLoader" style="display:none;"><i class="fa fa-refresh fa-spin"></i></div>
                <div class="box-header with-border">
                    <h3 class="box-title">Allocation Management</h3>
                </div>

                <div class="box-body row">
                    <div class="form-group col-sm-4">
                        <label for="pNodeId">Node</label>
                        <select name="node_id" id="pNodeId" class="form-control">
                            <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <optgroup label="<?php echo e($location->long); ?> (<?php echo e($location->short); ?>)">
                                <?php $__currentLoopData = $location->nodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $node): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <option value="<?php echo e($node->id); ?>"
                                    <?php if($location->id === old('location_id')): ?> selected <?php endif; ?>
                                ><?php echo e($node->name); ?></option>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </optgroup>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                        <p class="small text-muted no-margin">The node which this server will be deployed to.</p>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="pAllocation">Default Allocation</label>
                        <select id="pAllocation" name="allocation_id" class="form-control"></select>
                        <p class="small text-muted no-margin">The main allocation that will be assigned to this server.</p>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="pAllocationAdditional">Additional Allocation(s)</label>
                        <select id="pAllocationAdditional" name="allocation_additional[]" class="form-control" multiple></select>
                        <p class="small text-muted no-margin">Additional allocations to assign to this server on creation.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="overlay" id="allocationLoader" style="display:none;"><i class="fa fa-refresh fa-spin"></i></div>
                <div class="box-header with-border">
                    <h3 class="box-title">Application Feature Limits</h3>
                </div>

                <div class="box-body row">
                    <div class="form-group col-xs-6">
                        <label for="pDatabaseLimit" class="control-label">Database Limit</label>
                        <div>
                            <input type="text" id="pDatabaseLimit" name="database_limit" class="form-control" value="<?php echo e(old('database_limit', 0)); ?>"/>
                        </div>
                        <p class="text-muted small">The total number of databases a user is allowed to create for this server.</p>
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="pAllocationLimit" class="control-label">Allocation Limit</label>
                        <div>
                            <input type="text" id="pAllocationLimit" name="allocation_limit" class="form-control" value="<?php echo e(old('allocation_limit', 0)); ?>"/>
                        </div>
                        <p class="text-muted small">The total number of allocations a user is allowed to create for this server.</p>
                    </div>
                    <div class="form-group col-xs-6">
                        <label for="pBackupLimit" class="control-label">Backup Limit</label>
                        <div>
                            <input type="text" id="pBackupLimit" name="backup_limit" class="form-control" value="<?php echo e(old('backup_limit', 0)); ?>"/>
                        </div>
                        <p class="text-muted small">The total number of backups that can be created for this server.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Resource Management</h3>
                </div>

                <div class="box-body row">
                    <div class="form-group col-xs-6">
                        <label for="pCPU">CPU Limit</label>

                        <div class="input-group">
                            <input type="text" id="pCPU" name="cpu" class="form-control" value="<?php echo e(old('cpu', 0)); ?>" />
                            <span class="input-group-addon">%</span>
                        </div>

                        <p class="text-muted small">If you do not want to limit CPU usage, set the value to <code>0</code>. To determine a value, take the number of threads and multiply it by 100. For example, on a quad core system without hyperthreading <code>(4 * 100 = 400)</code> there is <code>400%</code> available. To limit a server to using half of a single thread, you would set the value to <code>50</code>. To allow a server to use up to two threads, set the value to <code>200</code>.<p>
                    </div>

                    <div class="form-group col-xs-6">
                        <label for="pThreads">CPU Pinning</label>

                        <div>
                            <input type="text" id="pThreads" name="threads" class="form-control" value="<?php echo e(old('threads')); ?>" />
                        </div>

                        <p class="text-muted small"><strong>Advanced:</strong> Enter the specific CPU threads that this process can run on, or leave blank to allow all threads. This can be a single number, or a comma separated list. Example: <code>0</code>, <code>0-1,3</code>, or <code>0,1,3,4</code>.</p>
                    </div>
                </div>

                <div class="box-body row">
                    <div class="form-group col-xs-6">
                        <label for="pMemory">Memory</label>

                        <div class="input-group">
                            <input type="text" id="pMemory" name="memory" class="form-control" value="<?php echo e(old('memory')); ?>" />
                            <span class="input-group-addon">MB</span>
                        </div>

                        <p class="text-muted small">The maximum amount of memory allowed for this container. Setting this to <code>0</code> will allow unlimited memory in a container.</p>
                    </div>

                    <div class="form-group col-xs-6">
                        <label for="pSwap">Swap</label>

                        <div class="input-group">
                            <input type="text" id="pSwap" name="swap" class="form-control" value="<?php echo e(old('swap', 0)); ?>" />
                            <span class="input-group-addon">MB</span>
                        </div>

                        <p class="text-muted small">Setting this to <code>0</code> will disable swap space on this server. Setting to <code>-1</code> will allow unlimited swap.</p>
                    </div>
                </div>

                <div class="box-body row">
                    <div class="form-group col-xs-6">
                        <label for="pDisk">Disk Space</label>

                        <div class="input-group">
                            <input type="text" id="pDisk" name="disk" class="form-control" value="<?php echo e(old('disk')); ?>" />
                            <span class="input-group-addon">MB</span>
                        </div>

                        <p class="text-muted small">This server will not be allowed to boot if it is using more than this amount of space. If a server goes over this limit while running it will be safely stopped and locked until enough space is available. Set to <code>0</code> to allow unlimited disk usage.</p>
                    </div>

                    <div class="form-group col-xs-6">
                        <label for="pIO">Block IO Weight</label>

                        <div>
                            <input type="text" id="pIO" name="io" class="form-control" value="<?php echo e(old('io', 500)); ?>" />
                        </div>

                        <p class="text-muted small"><strong>Advanced</strong>: The IO performance of this server relative to other <em>running</em> containers on the system. Value should be between <code>10</code> and <code>1000</code>. Please see <a href="https://docs.docker.com/engine/reference/run/#block-io-bandwidth-blkio-constraint" target="_blank">this documentation</a> for more information about it.</p>
                    </div>
                    <div class="form-group col-xs-12">
                        <div class="checkbox checkbox-primary no-margin-bottom">
                            <input type="checkbox" id="pOomDisabled" name="oom_disabled" value="0" <?php echo e(\Pterodactyl\Helpers\Utilities::checked('oom_disabled', 0)); ?> />
                            <label for="pOomDisabled" class="strong">Enable OOM Killer</label>
                        </div>

                        <p class="small text-muted no-margin">Terminates the server if it breaches the memory limits. Enabling OOM killer may cause server processes to exit unexpectedly.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Nest Configuration</h3>
                </div>

                <div class="box-body row">
                    <div class="form-group col-xs-12">
                        <label for="pNestId">Nest</label>

                        <select id="pNestId" name="nest_id" class="form-control">
                            <?php $__currentLoopData = $nests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($nest->id); ?>"
                                    <?php if($nest->id === old('nest_id')): ?>
                                        selected="selected"
                                    <?php endif; ?>
                                ><?php echo e($nest->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>

                        <p class="small text-muted no-margin">Select the Nest that this server will be grouped under.</p>
                    </div>

                    <div class="form-group col-xs-12">
                        <label for="pEggId">Egg</label>
                        <select id="pEggId" name="egg_id" class="form-control"></select>
                        <p class="small text-muted no-margin">Select the Egg that will define how this server should operate.</p>
                    </div>
                    <div class="form-group col-xs-12">
                        <div class="checkbox checkbox-primary no-margin-bottom">
                            <input type="checkbox" id="pSkipScripting" name="skip_scripts" value="1" <?php echo e(\Pterodactyl\Helpers\Utilities::checked('skip_scripts', 0)); ?> />
                            <label for="pSkipScripting" class="strong">Skip Egg Install Script</label>
                        </div>

                        <p class="small text-muted no-margin">If the selected Egg has an install script attached to it, the script will run during the install. If you would like to skip this step, check this box.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Docker Configuration</h3>
                </div>

                <div class="box-body row">
                    <div class="form-group col-xs-12">
                        <label for="pDefaultContainer">Docker Image</label>
                        <select id="pDefaultContainer" name="image" class="form-control"></select>
                        <input id="pDefaultContainerCustom" name="custom_image" value="<?php echo e(old('custom_image')); ?>" class="form-control" placeholder="Or enter a custom image..." style="margin-top:1rem"/>
                        <p class="small text-muted no-margin">This is the default Docker image that will be used to run this server. Select an image from the dropdown above, or enter a custom image in the text field above.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Startup Configuration</h3>
                </div>

                <div class="box-body row">
                    <div class="form-group col-xs-12">
                        <label for="pStartup">Startup Command</label>
                        <input type="text" id="pStartup" name="startup" value="<?php echo e(old('startup')); ?>" class="form-control" />
                        <p class="small text-muted no-margin">The following data substitutes are available for the startup command: <code>{{SERVER_MEMORY}}</code>, <code>{{SERVER_IP}}</code>, and <code>{{SERVER_PORT}}</code>. They will be replaced with the allocated memory, server IP, and server port respectively.</p>
                    </div>
                </div>

                <div class="box-header with-border" style="margin-top:-10px;">
                    <h3 class="box-title">Service Variables</h3>
                </div>

                <div class="box-body row" id="appendVariablesTo"></div>

                <div class="box-footer">
                    <?php echo csrf_field(); ?>

                    <input type="submit" class="btn btn-success pull-right" value="Create Server" />
                </div>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('footer-scripts'); ?>
    <?php echo Theme::js('vendor/lodash/lodash.js'); ?>


    <script type="application/javascript">
        // Persist 'Service Variables'
        function serviceVariablesUpdated(eggId, ids) {
            <?php if(old('egg_id')): ?>
                // Check if the egg id matches.
                if (eggId != '<?php echo e(old('egg_id')); ?>') {
                    return;
                }

                <?php if(old('environment')): ?>
                    <?php $__currentLoopData = old('environment'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        $('#' + ids['<?php echo e($key); ?>']).val('<?php echo e($value); ?>');
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endif; ?>
            <?php if(old('image')): ?>
                $('#pDefaultContainer').val('<?php echo e(old('image')); ?>');
            <?php endif; ?>
        }
        // END Persist 'Service Variables'
    </script>

    <?php echo Theme::js('js/admin/new-server.js?v=20220530'); ?>


    <script type="application/javascript">
        $(document).ready(function() {
            // Persist 'Server Owner' select2
            <?php if(old('owner_id')): ?>
                $.ajax({
                    url: '/admin/users/accounts.json?user_id=<?php echo e(old('owner_id')); ?>',
                    dataType: 'json',
                }).then(function (data) {
                    initUserIdSelect([ data ]);
                });
            <?php else: ?>
                initUserIdSelect();
            <?php endif; ?>
            // END Persist 'Server Owner' select2

            // Persist 'Node' select2
            <?php if(old('node_id')): ?>
                $('#pNodeId').val('<?php echo e(old('node_id')); ?>').change();

                // Persist 'Default Allocation' select2
                <?php if(old('allocation_id')): ?>
                    $('#pAllocation').val('<?php echo e(old('allocation_id')); ?>').change();
                <?php endif; ?>
                // END Persist 'Default Allocation' select2

                // Persist 'Additional Allocations' select2
                <?php if(old('allocation_additional')): ?>
                    const additional_allocations = [];

                    <?php for($i = 0; $i < count(old('allocation_additional')); $i++): ?>
                        additional_allocations.push('<?php echo e(old('allocation_additional.'.$i)); ?>');
                    <?php endfor; ?>

                    $('#pAllocationAdditional').val(additional_allocations).change();
                <?php endif; ?>
                // END Persist 'Additional Allocations' select2
            <?php endif; ?>
            // END Persist 'Node' select2

            // Persist 'Nest' select2
            <?php if(old('nest_id')): ?>
                $('#pNestId').val('<?php echo e(old('nest_id')); ?>').change();

                // Persist 'Egg' select2
                <?php if(old('egg_id')): ?>
                    $('#pEggId').val('<?php echo e(old('egg_id')); ?>').change();
                <?php endif; ?>
                // END Persist 'Egg' select2
            <?php endif; ?>
            // END Persist 'Nest' select2
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/servers/new.blade.php ENDPATH**/ ?>