<?php $event = $event ?? null; ?>

<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" name="title" class="form-control" value="<?php echo e(old('title', $event->title ?? '')); ?>" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Type <span class="text-danger">*</span></label>
        <select name="type" class="form-select" required>
            <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($type); ?>" <?php if(old('type', $event->type ?? '') == $type): echo 'selected'; endif; ?>><?php echo e($type); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Event Date <span class="text-danger">*</span></label>
        <input type="date" name="event_date" class="form-control"
               value="<?php echo e(old('event_date', isset($event) ? $event->event_date->format('Y-m-d') : '')); ?>" required>
    </div>

    <div class="col-md-4">
        <label class="form-label">Event Time</label>
        <input type="time" name="event_time" class="form-control"
               value="<?php echo e(old('event_time', $event->event_time ?? '')); ?>">
    </div>

    <div class="col-md-4">
        <label class="form-label">Status <span class="text-danger">*</span></label>
        <select name="status" class="form-select" required>
            <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($status); ?>" <?php if(old('status', $event->status ?? 'Upcoming') == $status): echo 'selected'; endif; ?>><?php echo e($status); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label">Venue</label>
        <input type="text" name="venue" class="form-control" value="<?php echo e(old('venue', $event->venue ?? '')); ?>" placeholder="e.g. BMB Seminar Room, SUST">
    </div>

    <div class="col-md-6">
        <label class="form-label">Speaker / Guest</label>
        <input type="text" name="speaker" class="form-control" value="<?php echo e(old('speaker', $event->speaker ?? '')); ?>" placeholder="e.g. Dr. Ajit Ghosh">
    </div>

    <div class="col-md-12">
        <label class="form-label">Description <span class="text-danger">*</span></label>
        <textarea name="description" class="form-control" rows="4" required><?php echo e(old('description', $event->description ?? '')); ?></textarea>
    </div>

    <div class="col-md-12">
        <label class="form-label">Event Image</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        <small class="text-muted">JPG, PNG or WEBP. Max 2MB.</small>

        <?php if(isset($event) && $event->image): ?>
            <div class="mt-2">
                <img src="<?php echo e(asset('storage/' . $event->image)); ?>" style="max-height:120px; border-radius:8px;" alt="Current image">
                <p class="text-muted small mt-1">Current image (uploading a new one will replace it)</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\Laragon\www\aglab-events\resources\views/events/_form.blade.php ENDPATH**/ ?>