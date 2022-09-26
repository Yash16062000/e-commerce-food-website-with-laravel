

<?php $__env->startSection('main'); ?>
<div id="page-wrapper">
    <div class="main-page">
        <div class="tables">
        <h2 class="title1">Team</h2>
            <div class="panel-body widget-shadow">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Role Type</th>
                            <th >Name</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $team; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->index +1); ?></td>
                            <td><?php echo e($menu->role_type); ?></td>
                            <td><?php echo e(ucwords($menu->name)); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.dashboard.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\e-commerce\resources\views/backend/dashboard/team.blade.php ENDPATH**/ ?>