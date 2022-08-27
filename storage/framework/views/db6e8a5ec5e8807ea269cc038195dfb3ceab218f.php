<?php echo $__env->make('partials/admin.jexactyl.nav', ['activeTab' => 'approvals'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title'); ?>
    User Approvals
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1>User Approvals<small>Allow or deny requests to create accounts.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li class="active">Jexactyl</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->yieldContent('jexactyl::nav'); ?>
    <form action="<?php echo e(route('admin.jexactyl.approvals')); ?>" method="POST">
        <div class="row">
            <div class="col-xs-12">
                <div class="box
                    <?php if($enabled == 'true'): ?>
                        box-success
                    <?php else: ?>
                        box-danger
                    <?php endif; ?>
                ">
                    <div class="box-header with-border">
                        <i class="fa fa-users"></i>
                        <h3 class="box-title">Approval System <small>Decide whether the approval system is enabled or disabled.</small></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">Enabled</label>
                                <div>
                                    <select name="enabled" class="form-control">
                                        <option <?php if($enabled == 'false'): ?> selected <?php endif; ?> value="false">Disabled</option>
                                        <option <?php if($enabled == 'true'): ?> selected <?php endif; ?> value="true">Enabled</option>
                                    </select>
                                    <p class="text-muted"><small>Determines whether users must be approved by an admin to use the Panel.</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box box-footer">
                        <?php echo csrf_field(); ?>

                        <button type="submit" name="_method" value="PATCH" class="btn btn-default pull-right">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <i class="fa fa-list"></i>
                    <h3 class="box-title">Approval Requests <small>Allow or deny reqursts to create accounts.</small></h3>
                 </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>User ID</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Registered</th>
                                <th></th>
                                <th></th>
                            </tr>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <code><?php echo e($user->id); ?></code>
                                    </td>
                                    <td>
                                        <?php echo e($user->email); ?>

                                    </td>
                                    <td>
                                        <code><?php echo e($user->username); ?></code> (<?php echo e($user->name_first); ?> <?php echo e($user->name_last); ?>)
                                    </td>
                                    <td>
                                        <?php echo e($user->created_at->diffForHumans()); ?>

                                    </td>
                                    <td class="text-center">
                                        <form id="approveform" action="<?php echo e(route('admin.jexactyl.approvals.approve', $user->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>

                                            <button id="approvalApproveBtn" class="btn btn-xs btn-default">
                                                <i class="fa fa-check text-success"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <form id="denyform" action="<?php echo e(route('admin.jexactyl.approvals.deny', $user->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>

                                            <button id="approvalDenyBtn" class="btn btn-xs btn-default">
                                                <i class="fa fa-times text-danger"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer-scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('footer-scripts'); ?>
    <script>
    $('#approvalDenyBtn').on('click', function (event) {
        event.preventDefault();

        swal({
            type: 'error',
            title: 'Deny this request?',
            text: 'This will remove this user from the Panel immediately.',
            showCancelButton: true,
            confirmButtonText: 'Deny',
            confirmButtonColor: 'red',
            closeOnConfirm: false
        }, function () {
            $('#denyform').submit()
        });
    });

    $('#approvalApproveBtn').on('click', function (event) {
        event.preventDefault();

        swal({
            type: 'success',
            title: 'Approve this request?',
            text: 'This user will gain access to the Panel immediately.',
            showCancelButton: true,
            confirmButtonText: 'Approve',
            confirmButtonColor: 'green',
            closeOnConfirm: false
        }, function () {
            $('#approveform').submit()
        });
    });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/jexactyl/approvals.blade.php ENDPATH**/ ?>