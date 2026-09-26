<?php $__env->startSection('title', 'All Events & Activities'); ?>

<?php $__env->startSection('content'); ?>
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="fa-solid fa-calendar-days"></i> Events & Activities</h2>
        <a href="<?php echo e(route('events.create')); ?>" class="btn btn-ag">
            <i class="fa-solid fa-plus"></i> Add New Event
        </a>
    </div>

    <form method="GET" action="<?php echo e(route('events.index')); ?>" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="q" value="<?php echo e(request('q')); ?>" class="form-control"
                   placeholder="Search by title, venue, or speaker...">
        </div>
        <div class="col-md-3">
            <select name="type" class="form-select">
                <option value="">All Types</option>
                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($type); ?>" <?php if(request('type') == $type): echo 'selected'; endif; ?>><?php echo e($type); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">All Statuses</option>
                <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($status); ?>" <?php if(request('status') == $status): echo 'selected'; endif; ?>><?php echo e($status); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-ag"><i class="fa-solid fa-filter"></i> Filter</button>
        </div>
    </form>

    <?php if($events->isEmpty()): ?>
        <div class="alert alert-info">No events found. Try adjusting your filters or add a new event.</div>
    <?php else: ?>
        <div class="row g-4">
            <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <div class="card card-event">
                        <?php if($event->image): ?>
                            <img src="<?php echo e(asset('storage/' . $event->image)); ?>" class="card-img-top" style="height:180px; object-fit:cover; border-radius:12px 12px 0 0;" alt="<?php echo e($event->title); ?>">
                        <?php else: ?>
                            <div class="d-flex align-items-center justify-content-center bg-light" style="height:180px; border-radius:12px 12px 0 0;">
                                <i class="fa-solid fa-image fa-2x text-muted"></i>
                            </div>
                        <?php endif; ?>
                        <div class="card-body">
                            <div class="mb-2">
                                <span class="badge badge-type"><?php echo e($event->type); ?></span>
                                <span class="badge badge-status-<?php echo e($event->status); ?>"><?php echo e($event->status); ?></span>
                            </div>
                            <h5 class="card-title"><?php echo e($event->title); ?></h5>
                            <p class="text-muted mb-1">
                                <i class="fa-regular fa-calendar"></i> <?php echo e($event->event_date->format('d M, Y')); ?>

                                <?php if($event->event_time): ?>
                                    &middot; <i class="fa-regular fa-clock"></i> <?php echo e(\Carbon\Carbon::parse($event->event_time)->format('h:i A')); ?>

                                <?php endif; ?>
                            </p>
                            <?php if($event->venue): ?>
                                <p class="text-muted mb-2"><i class="fa-solid fa-location-dot"></i> <?php echo e($event->venue); ?></p>
                            <?php endif; ?>
                            <p class="card-text"><?php echo e(Str::limit($event->description, 80)); ?></p>
                        </div>
                        <div class="card-footer bg-white border-0 d-flex justify-content-between">
                            <a href="<?php echo e(route('events.show', $event)); ?>" class="btn btn-sm btn-outline-secondary">
                                <i class="fa-solid fa-eye"></i> View
                            </a>
                            <a href="<?php echo e(route('events.edit', $event)); ?>" class="btn btn-sm btn-outline-primary">
                                <i class="fa-solid fa-pen"></i> Edit
                            </a>
                            <form action="<?php echo e(route('events.destroy', $event)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mt-4">
            <?php echo e($events->links()); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Laragon\www\aglab-events\resources\views/events/index.blade.php ENDPATH**/ ?>