<?php $__env->startSection('content'); ?>
<div class="container">

    <?php if(count($errors) > 0): ?>
      <div class="alert alert-danger">
        <ul>
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li> <?php echo e($error); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="POST" action="/projects" enctype="multipart/form-data">

      <div class="form-group row">
          <label for="title" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Judul Proyek')); ?></label>

          <div class="col-md-6">
              <input id="title" type="text" class="form-control<?php echo e($errors->has('title') ? ' is-invalid' : ''); ?>" name="title" value="<?php echo e(old('title')); ?>" required>

              <?php if($errors->has('title')): ?>
                  <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($errors->first('title')); ?></strong>
                  </span>
              <?php endif; ?>
          </div>
      </div>


      <div class="form-group row">
          <label for="opened_at" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Tanggal dibuka project')); ?></label>

          <div class="col-md-6">
              <input id="opened_at" type="date" class="form-control<?php echo e($errors->has('opened_at') ? ' is-invalid' : ''); ?>" name="opened_at" value="<?php echo e(old('opened_at')); ?>" required>

              <?php if($errors->has('opened_at')): ?>
                  <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($errors->first('opened_at')); ?></strong>
                  </span>
              <?php endif; ?>
          </div>
      </div>

      <div class="form-group row">
          <label for="closed_at" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Tanggal ditutup project')); ?></label>

          <div class="col-md-6">
              <input id="closed_at" type="date" class="form-control<?php echo e($errors->has('closed_at') ? ' is-invalid' : ''); ?>" name="closed_at" value="<?php echo e(old('closed_at')); ?>" required>

              <?php if($errors->has('closed_at')): ?>
                  <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($errors->first('closed_at')); ?></strong>
                  </span>
              <?php endif; ?>
          </div>
      </div>

      <div class="form-group row">
          <label for="description" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Deskripsi Project')); ?></label>

          <div class="col-md-6">
              <textarea rows="4" cols="50" style="resize:none" id="description" type="text" class="form-control<?php echo e($errors->has('description') ? ' is-invalid' : ''); ?>" name="description" value="<?php echo e(old('description')); ?>" required></textarea>
              <?php if($errors->has('description')): ?>
                  <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($errors->first('description')); ?></strong>
                  </span>
              <?php endif; ?>
          </div>
      </div>

      <div class="form-group row">
          <label for="project_price" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Dana yang Dibutuhkan')); ?></label>

          <div class="col-md-6">
              <input id="project_price" type="number" class="form-control<?php echo e($errors->has('project_price') ? ' is-invalid' : ''); ?>" name="project_price" value="<?php echo e(old('project_price')); ?>" required>

              <?php if($errors->has('project_price')): ?>
                  <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($errors->first('project_price')); ?></strong>
                  </span>
              <?php endif; ?>
          </div>
      </div>

      <div class="form-group row">
          <label for="slot" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Banyak Slot')); ?></label>

          <div class="col-md-6">
              <input id="slot" type="number" class="form-control<?php echo e($errors->has('slot') ? ' is-invalid' : ''); ?>" name="slot" value="<?php echo e(old('slot')); ?>" required>

              <?php if($errors->has('slot')): ?>
                  <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($errors->first('slot')); ?></strong>
                  </span>
              <?php endif; ?>
          </div>
      </div>

      <!-- Featured Image -->
      <div class="form-group row">
          <label for="project_image" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Submit Gambar')); ?></label>

          <div class="col-md-6">
              <input id="project_image" type="file" class="form-control<?php echo e($errors->has('project_image') ? ' is-invalid' : ''); ?>" name="project_image" value="<?php echo e(old('project_image')); ?>" required>

              <?php if($errors->has('project_image')): ?>
                  <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($errors->first('project_image')); ?></strong>
                  </span>
              <?php endif; ?>
          </div>
      </div>


      <?php echo e(csrf_field()); ?>



      <div class="form-group row mb-0">
          <div class="col-md-6 offset-md-4">
              <button type="submit" class="btn btn-primary">
                  <?php echo e(__('Buat Project')); ?>

              </button>

              <a class="btn btn-light" href="/home">
                  <?php echo e(__('Kembali')); ?>

              </a>
          </div>
      </div>

    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>