<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    
                    <?php if(session('status')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>
                    Hi <?php echo e(Auth::user()->username); ?> You are logged in!</br>
                    Email : <?php echo e(Auth::user()->email); ?></br></br>
                    
                    <?php if(auth()->user()->isAdmin()): ?>
                    <a href="<?php echo e(url('/admin')); ?>">Ke Page Admin</a></br></br>
                    <a href="<?php echo e(url('/projects/create')); ?>">Buat Project Baru</a></br></br>
                    <a href="<?php echo e(url('/users')); ?>">Lihat List User</a></br></br>
                    <a href="<?php echo e(url('/topups')); ?>">Approve User Top Up</a></br></br>
                    <?php else: ?>
                    <a href="<?php echo e(url('/topups/create')); ?>">Isi Saldo</a></br></br>
                    <?php endif; ?>
                    <a href="<?php echo e(url('/projects')); ?>">Lihat Project yang tersedia</a></br></br>
                    <a href="<?php echo e(url('/transaksi')); ?>">Lihat history transaksi</a></br></br>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>