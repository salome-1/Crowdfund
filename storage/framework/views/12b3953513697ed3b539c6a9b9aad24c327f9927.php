<?php $__env->startSection('content'); ?>
<div class="container">
      <form method="post" action="<?php echo e(action('TopupController@update', $id)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
         <div class="row">
          <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <lable>Approval</lable>
                <select name="approve">
                  <option value="0" <?php if($topups->status==0): ?>selected <?php endif; ?>>Pending</option>
                  <option value="1" <?php if($topups->status==1): ?>selected <?php endif; ?>>Approve</option>
                  <option value="2" <?php if($topups->status==2): ?>selected <?php endif; ?>>Reject</option>
                </select>
            </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <button type="submit" class="btn btn-success" style="margin-top:40px">Update</button>
          </div>
        </div>
      </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>