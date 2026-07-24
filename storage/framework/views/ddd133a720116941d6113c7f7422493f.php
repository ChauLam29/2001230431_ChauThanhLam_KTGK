

<?php $__env->startSection('title','Thùng rác'); ?>

<?php $__env->startSection('content'); ?>

<div class="card">

    <div class="card-header d-flex justify-content-between">

        <h5>Thùng rác</h5>

        <a href="<?php echo e(route('products.index')); ?>"
           class="btn btn-primary">
            Quay lại
        </a>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead class="table-dark">

            <tr>

                <th>ID</th>
                <th>Tên</th>
                <th>Danh mục</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>

            </tr>

            </thead>

            <tbody>

            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <tr>

                    <td><?php echo e($product->id); ?></td>

                    <td><?php echo e($product->name); ?></td>

                    <td><?php echo e($product->category->name ?? ''); ?></td>

                    <td><?php echo e($product->status); ?></td>

                    <td>

                        <form
                            action="<?php echo e(route('products.restore',$product->id)); ?>"
                            method="POST"
                            class="d-inline">

                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <button class="btn btn-success btn-sm">

                                Khôi phục

                            </button>

                        </form>

                        <form
                            action="<?php echo e(route('products.forceDelete',$product->id)); ?>"
                            method="POST"
                            class="d-inline">

                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>

                            <button
                                onclick="return confirm('Xóa vĩnh viễn?')"
                                class="btn btn-danger btn-sm">

                                Xóa vĩnh viễn

                            </button>

                        </form>

                    </td>

                </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <tr>

                    <td colspan="5" class="text-center">

                        Thùng rác trống.

                    </td>

                </tr>

            <?php endif; ?>

            </tbody>

        </table>

        <?php echo e($products->links()); ?>


    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\LuuDuLieuSinhVien\laragon\www\kiemtra\resources\views/admin/products/trash.blade.php ENDPATH**/ ?>