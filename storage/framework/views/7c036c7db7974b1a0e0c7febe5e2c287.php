<?php $__env->startSection('title', 'Edit Event'); ?>

<?php $__env->startSection('content'); ?>
    <div class="card p-4 shadow-sm">
        <h3 class="mb-4"><i class="fa-solid fa-pen"></i> Edit Event / Activity</h3>

        <form action="<?php echo e(route('events.update', $event)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <?php echo $__env->make('events._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-ag"><i class="fa-solid fa-save"></i> Update Event</button>
                <a href="<?php echo e(route('events.index')); ?>" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Laragon\www\aglab-events\resources\views/events/edit.blade.php ENDPATH**/ ?>