<?php $__env->startSection('content'); ?>
<div class="container">

    
    <div class="table-responsive">


      <table class="table table-striped" border="solid">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Nama Bank User</td>
            <th scope="col">Atas Nama</td>
            <th scope="col">Nominal</td>
            <th scope="col">Bukti Foto</td>
            <th scope="col">Status</td>
            <th scope="col">Action</td>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $topups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($topup->bank); ?></td>
            <td><?php echo e($topup->nama); ?></td>
            <td><?php echo e($topup->nominal); ?></td>
            <td><img src="<?php echo e(asset('storage/gambar_bukti/' . $topup->bukti_image)); ?>" alt="" width="50"></td>
            <td>
            <?php if( $topup->status == 0 ): ?>
            <span class="label label-primary">Pending</span>
            <?php elseif( $topup->status == 1 ): ?>
            <span class="label label-success">Approved</span>
            <?php elseif( $topup->status == 2 ): ?>
            <span class="label label-danger">Rejected</span>
            <?php endif; ?>
            </td>
            <td><a href="<?php echo e(action('TopupController@edit', $topups->id)); ?>" class="btn btn-warning">Action</a></td>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>