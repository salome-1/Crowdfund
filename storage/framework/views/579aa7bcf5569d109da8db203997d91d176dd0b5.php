<?php $__env->startSection('content'); ?>
<div class="container">

    <?php if(session('msg')): ?>
      <div class="alert alert-succes">
        <p> <?php echo e(session('msg')); ?></p>
      </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>