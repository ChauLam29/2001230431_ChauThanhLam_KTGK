

<?php $__env->startSection('title', 'Danh sách sản phẩm'); ?>

<?php $__env->startSection('content'); ?>

<div class="card">

    <div class="card-header">

        <div class="d-flex justify-content-between align-items-center">

            <h5 class="mb-0">Danh sách sản phẩm</h5>

            <div class="d-flex gap-2">

                
                <form action="<?php echo e(route('products.import')); ?>"
                      method="POST"
                      enctype="multipart/form-data"
                      class="d-flex gap-2">

                    <?php echo csrf_field(); ?>

                    <input type="file"
                           name="excel_file"
                           class="form-control form-control-sm"
                           accept=".xlsx,.xls"
                           required>

                    <button type="submit"
                            class="btn btn-success btn-sm">

                        Import Excel

                    </button>

                </form>

                <a href="<?php echo e(route('products.trash')); ?>"
                   class="btn btn-dark">

                    Thùng rác

                </a>

                <a href="<?php echo e(route('products.create')); ?>"
                   class="btn btn-primary">

                    Thêm sản phẩm

                </a>

            </div>

        </div>

    </div>

    <div class="card-body">

        <?php if(session('ok')): ?>

            <div class="alert alert-success">

                <?php echo e(session('ok')); ?>


            </div>

        <?php endif; ?>

        <form method="GET"
              action="<?php echo e(route('products.index')); ?>"
              class="row g-3 mb-4">

            <div class="col-md-4">

                <input type="text"
                       name="keyword"
                       class="form-control"
                       placeholder="Tên sản phẩm..."
                       value="<?php echo e(request('keyword')); ?>">

            </div>

            <div class="col-md-3">

                <select name="category_id"
                        class="form-select">

                    <option value="">--Danh mục--</option>

                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <option
                            value="<?php echo e($category->id); ?>"
                            <?php echo e(request('category_id')==$category->id?'selected':''); ?>>

                            <?php echo e($category->name); ?>


                        </option>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </select>

            </div>

            <div class="col-md-3">

                <select
                    name="status"
                    class="form-select">

                    <option value="">--Trạng thái--</option>

                    <option
                        value="draft"
                        <?php echo e(request('status')=='draft'?'selected':''); ?>>

                        Draft

                    </option>

                    <option
                        value="published"
                        <?php echo e(request('status')=='published'?'selected':''); ?>>

                        Published

                    </option>

                </select>

            </div>

            <div class="col-md-2 d-grid">

                <button class="btn btn-success">

                    Tìm kiếm

                </button>

            </div>

        </form>

        <table class="table table-bordered table-hover align-middle">

            <thead class="table-dark text-center">

            <tr>

                <th>ID</th>

                <th>Ảnh</th>

                <th>Tên sản phẩm</th>

                <th>Danh mục</th>

                <th>Giá</th>

                <th>Trạng thái</th>

                <th>Tài liệu</th>

                <th width="180">

                    Thao tác

                </th>

            </tr>

            </thead>

            <tbody>

            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                <tr>

                    <td class="text-center">

                        <?php echo e($product->id); ?>


                    </td>

                    <td class="text-center">

                        <?php if($product->image_path): ?>

                            <img
                                src="<?php echo e(asset('storage/'.$product->image_path)); ?>"
                                width="80"
                                class="img-thumbnail">

                        <?php else: ?>

                            <span class="text-muted">

                                Chưa có ảnh

                            </span>

                        <?php endif; ?>

                    </td>

                    <td>

                        <?php echo e($product->name); ?>


                    </td>

                    <td>

                        <?php echo e($product->category->name ?? ''); ?>


                    </td>

                    <td>

                        <?php echo e(number_format($product->price,0,',','.')); ?> đ

                    </td>

                    <td class="text-center">

                        <?php if($product->status=='published'): ?>

                            <span class="badge bg-success">

                                Published

                            </span>

                        <?php else: ?>

                            <span class="badge bg-secondary">

                                Draft

                            </span>

                        <?php endif; ?>

                    </td>

                    <td class="text-center">

                        <?php if($product->document_path): ?>

                            <a href="<?php echo e(route('products.download',$product->id)); ?>"
                               class="btn btn-info btn-sm">

                                Tải

                            </a>

                        <?php else: ?>

                            <span class="badge bg-warning">

                                Chưa có

                            </span>

                        <?php endif; ?>

                    </td>

                    <td class="text-center">

                        <a href="<?php echo e(route('products.edit',$product)); ?>"
                           class="btn btn-warning btn-sm">

                            Sửa

                        </a>

                        <form action="<?php echo e(route('products.destroy',$product)); ?>"
                              method="POST"
                              class="d-inline">

                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>

                            <button
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Chuyển sản phẩm vào thùng rác?')">

                                Xóa

                            </button>

                        </form>

                    </td>

                </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                <tr>

                    <td colspan="8"
                        class="text-center">

                        Không có dữ liệu.

                    </td>

                </tr>

            <?php endif; ?>

            </tbody>

        </table>

        <div class="mt-3">

            <?php echo e($products->withQueryString()->links()); ?>


        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\LuuDuLieuSinhVien\laragon\www\kiemtra\resources\views/admin/products/index.blade.php ENDPATH**/ ?>