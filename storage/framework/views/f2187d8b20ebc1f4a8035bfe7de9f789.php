

<?php $__env->startSection('title','Thêm sản phẩm'); ?>

<?php $__env->startSection('content'); ?>

<div class="card">

    <div class="card-body">

        <form
            action="<?php echo e(route('products.store')); ?>"
            method="POST"
            enctype="multipart/form-data">

            <?php echo csrf_field(); ?>

            <?php echo $__env->make('admin.products.form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        </form>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\LuuDuLieuSinhVien\laragon\www\kiemtra\resources\views/admin/products/create.blade.php ENDPATH**/ ?>