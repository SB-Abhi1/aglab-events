<?php $__env->startSection('title', $event->title); ?>

<?php $__env->startSection('content'); ?>
    <div class="card shadow-sm">
        <?php if($event->image): ?>
            <img src="<?php echo e(asset('storage/' . $event->image)); ?>" class="card-img-top" style="max-height:350px; object-fit:cover;" alt="<?php echo e($event->title); ?>">
        <?php endif; ?>
        <div class="card-body p-4">
            <div class="mb-2">
                <span class="badge badge-type"><?php echo e($event->type); ?></span>
                <span class="badge badge-status-<?php echo e($event->status); ?>"><?php echo e($event->status); ?></span>
            </div>
            <h2><?php echo e($event->title); ?></h2>

            <ul class="list-unstyled mt-3">
                <li class="mb-2"><i class="fa-regular fa-calendar text-muted"></i>
                    <strong>Date:</strong> <?php echo e($event->event_date->format('d M, Y (l)')); ?>

                </li>
                <?php if($event->event_time): ?>
                    <li class="mb-2"><i class="fa-regular fa-clock text-muted"></i>
                        <strong>Time:</strong> <?php echo e(\Carbon\Carbon::parse($event->event_time)->format('h:i A')); ?>

                    </li>
                <?php endif; ?>
                <?php if($event->venue): ?>
                    <li class="mb-2"><i class="fa-solid fa-location-dot text-muted"></i>
                        <strong>Venue:</strong> <?php echo e($event->venue); ?>

                    </li>
                <?php endif; ?>
                <?php if($event->speaker): ?>
                    <li class="mb-2"><i class="fa-solid fa-user text-muted"></i>
                        <strong>Speaker/Guest:</strong> <?php echo e($event->speaker); ?>

                    </li>
                <?php endif; ?>
            </ul>

            <hr>
            <h5>Description</h5>
            <p style="white-space: pre-line;"><?php echo e($event->description); ?></p>

            <div class="mt-4 d-flex gap-2">
                <a href="<?php echo e(route('events.edit', $event)); ?>" class="btn btn-outline-primary">
                    <i class="fa-solid fa-pen"></i> Edit
                </a>
                <form action="<?php echo e(route('events.destroy', $event)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="fa-solid fa-trash"></i> Delete
                    </button>
                </form>
                <a href="<?php echo e(route('events.index')); ?>" class="btn btn-outline-secondary ms-auto">
                    <i class="fa-solid fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Laragon\www\aglab-events\resources\views/events/show.blade.php ENDPATH**/ ?>