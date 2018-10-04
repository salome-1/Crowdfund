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

  <?php if(session('msg')): ?>
    <div class="alert alert-succes">
      <p> <?php echo e(session('msg')); ?></p>
    </div>
  <?php endif; ?>

    <form method="POST" action="/topups" enctype="multipart/form-data">
    
    <div class="form-group row">
        <label for="username" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Nama Anda')); ?></label>

        <div class="col-md-6">
            
            <textarea placeholder="" class="form-control" id="username" name="username" rows="1" readonly=""><?php echo e($user->username); ?></textarea>

            <?php if($errors->has('username')): ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($errors->first('username')); ?></strong>
                </span>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group row">
        <label for="user_name" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Atas Nama')); ?></label>

        <div class="col-md-6">
            <input id="user_name" type="text" class="form-control<?php echo e($errors->has('user_name') ? ' is-invalid' : ''); ?>" name="user_name" value="<?php echo e(old('user_name')); ?>" required>

            <?php if($errors->has('user_name')): ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($errors->first('user_name')); ?></strong>
                </span>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group row">
        <label for="nominal" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Masukkan nominal saldo untuk Top Up')); ?></label>

        <div class="col-md-6">
            <input id="nominal" type="number" class="form-control<?php echo e($errors->has('nominal') ? ' is-invalid' : ''); ?>" name="nominal" value="<?php echo e(old('nominal')); ?>" required>

            <?php if($errors->has('nominal')): ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($errors->first('nominal')); ?></strong>
                </span>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group row">
        <label for="bank" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Bank yang anda gunakan')); ?></label>

        <div class="col-md-6">
            <input id="bank" type="text" class="form-control<?php echo e($errors->has('bank') ? ' is-invalid' : ''); ?>" name="bank" value="<?php echo e(old('bank')); ?>" required>

            <?php if($errors->has('bank')): ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($errors->first('bank')); ?></strong>
                </span>
            <?php endif; ?>
        </div>
    </div>

     <!-- Featured Image -->
     <div class="form-group row">
          <label for="proof_image" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Submit Bukti')); ?></label>

          <div class="col-md-6">
              <input id="proof_image" type="file" class="form-control<?php echo e($errors->has('proof_image') ? ' is-invalid' : ''); ?>" name="proof_image" value="<?php echo e(old('proof_image')); ?>" required>

              <?php if($errors->has('proof_image')): ?>
                  <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($errors->first('proof_image')); ?></strong>
                  </span>
              <?php endif; ?>
          </div>
      </div>

      <div class="form-group row">
          <label for="password" class="col-md-4 col-form-label text-md-right"></label>

          <div class="col-md-6 captcha">
              <span><?php echo captcha_img(); ?></span>
              <!-- <button type="button" class="btn btn-success btn-refresh">Refresh</button> -->
          </div>

          <div class="col-md-6 offset-md-4">
              <input type="text" id="captcha" class="form-control<?php echo e($errors->has('captcha') ? ' is-invalid' : ''); ?>" placeholder="Masukkan Captcha" name ="captcha" required>
          </div>
              <?php if($errors->has('captcha')): ?>
                  <span class="invalid-feedback" role="alert">
                      <strong><?php echo e($errors->first('captcha')); ?></strong>
                  </span>
              <?php endif; ?>
      </div>

    <?php echo e(csrf_field()); ?>


    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                <?php echo e(__('TOP UP')); ?>

            </button>

            <a class="btn btn-light" href="/home">
                <?php echo e(__('Batal')); ?>

            </a>
        </div>
    </div>
  </form>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>