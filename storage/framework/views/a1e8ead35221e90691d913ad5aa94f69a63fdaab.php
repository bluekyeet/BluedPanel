<?php $__env->startSection('title'); ?>
    List Users
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content-header'); ?>
    <h1>Users<small>All registered users on the system.</small></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('admin.index')); ?>">Admin</a></li>
        <li class="active">Users</li>
    </ol>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">User List</h3>
                <div class="box-tools search01">
                    <form action="<?php echo e(route('admin.users')); ?>" method="GET">
                        <div class="input-group input-group-sm">
                            <input type="text" name="filter[email]" class="form-control pull-right" value="<?php echo e(request()->input('filter.email')); ?>" placeholder="Search">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                <a href="<?php echo e(route('admin.users.new')); ?>"><button type="button" class="btn btn-sm btn-primary" style="border-radius: 0 3px 3px 0;margin-left:-1px;">Create New</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Client Name</th>
                            <th>Username</th>
                            <th class="text-center">2FA</th>
                            <th class="text-center">Approved</th>
                            <th class="text-center"><span data-toggle="tooltip" data-placement="top" title="Servers that this user is marked as the owner of.">Servers Owned</span></th>
                            <th class="text-center"><span data-toggle="tooltip" data-placement="top" title="Servers that this user can access because they are marked as a subuser.">Can Access</span></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="align-middle">
                                <td><code><?php echo e($user->id); ?></code></td>
                                <td><a href="<?php echo e(route('admin.users.view', $user->id)); ?>"><?php echo e($user->email); ?></a> <?php if($user->root_admin): ?><i class="fa fa-star text-yellow"></i><?php endif; ?></td>
                                <td><?php echo e($user->name_last); ?>, <?php echo e($user->name_first); ?></td>
                                <td><?php echo e($user->username); ?></td>
                                <td class="text-center">
                                    <?php if($user->use_totp): ?>
                                        <i class="fa fa-lock text-green"></i>
                                    <?php else: ?>
                                        <i class="fa fa-unlock text-red"></i>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if($user->approved): ?>
                                        <i class="fa fa-check text-green"></i>
                                    <?php else: ?>
                                        <i class="fa fa-times text-red"></i>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?php echo e(route('admin.servers', ['filter[owner_id]' => $user->id])); ?>"><?php echo e($user->servers_count); ?></a>
                                </td>
                                <td class="text-center"><?php echo e($user->subuser_of_count); ?></td>
                                <td class="text-center"><img src="https://www.gravatar.com/avatar/<?php echo e(md5(strtolower($user->email))); ?>?s=100" style="height:20px;" class="img-circle" /></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php if($users->hasPages()): ?>
                <div class="box-footer with-border">
                    <div class="col-md-12 text-center"><?php echo $users->appends(['query' => Request::input('query')])->render(); ?></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/jexactyl/resources/views/admin/users/index.blade.php ENDPATH**/ ?>