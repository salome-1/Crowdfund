<?php $__env->startSection('content'); ?>
<div class="container">
  <div class="jumbotron">
    <div class="row">
      <div class="col-sm">
        <img src="<?php echo e(asset('storage/project_image/' . $project->project_image)); ?>" alt="" width="150">
        <h1><?php echo e($project->title); ?></h1>
        <p><?php echo e($project->description); ?></p>
        <p>Project dimulai pada : <?php echo e($project->opened_at); ?></p>
        <p>Project ditutup pada : <?php echo e($project->closed_at); ?></p>
        <p>Dana yang dibutuhkan : <?php echo e($project->project_price); ?></p>
        <p>Slot yang tersedia : <?php echo e($project->slot); ?></p>
        <p>Jumlah uang per slot : <?php echo e($project->slot_price); ?></p>
        <!-- <p>dibuat oleh : {project-user-name}</p> -->

        <p><a href="/projects" class="btn btn-primary btg-lg">Kembali Ke List Project</a></p>


        
        <?php if($project->isOwner()): ?>
          <p><a href="/projects/<?php echo e($project->id); ?>/edit" class="btn btn-primary btg-lg">Edit Project</a></p>
          <form method="POST" action="/projects/<?php echo e($project->id); ?>">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="btn btn-danger">
                <?php echo e(__('Hapus Project')); ?>

            </button>
          </form>
        <?php endif; ?>
      </div>

      
      <div class="col sm">
        <h1 class="text-center">Beli Slot</h1>
        
      </div>

    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>