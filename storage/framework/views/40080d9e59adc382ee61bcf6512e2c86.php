<div class="mb-3">
    <label class="form-label">Tên sản phẩm</label>
    <input
        type="text"
        name="name"
        class="form-control"
        value="<?php echo e(old('name', $product->name ?? '')); ?>">

    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <small class="text-danger"><?php echo e($message); ?></small>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="mb-3">
    <label class="form-label">Danh mục</label>

    <select name="category_id" class="form-select">

        <option value="">--Chọn danh mục--</option>

        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <option
                value="<?php echo e($category->id); ?>"
                <?php echo e(old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : ''); ?>>

                <?php echo e($category->name); ?>


            </option>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </select>

    <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <small class="text-danger"><?php echo e($message); ?></small>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

</div>

<div class="mb-3">

    <label class="form-label">Giá</label>

    <input
        type="number"
        step="0.01"
        name="price"
        class="form-control"
        value="<?php echo e(old('price', $product->price ?? '')); ?>">

    <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <small class="text-danger"><?php echo e($message); ?></small>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

</div>

<div class="mb-3">

    <label class="form-label">Mô tả</label>

    <textarea
        name="description"
        rows="5"
        class="form-control"><?php echo e(old('description', $product->description ?? '')); ?></textarea>

</div>

<div class="mb-3">

    <label class="form-label">

        Ảnh đại diện

    </label>

    <input
        type="file"
        name="image_up"
        class="form-control">

    <?php $__errorArgs = ['image_up'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <small class="text-danger"><?php echo e($message); ?></small>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <?php if(isset($product)): ?>

        <?php if($product->image_path): ?>

            <img
                src="<?php echo e(asset('storage/'.$product->image_path)); ?>"
                width="120"
                class="mt-2">

        <?php endif; ?>

    <?php endif; ?>

</div>

<div class="mb-3">

    <label class="form-label">

        File tài liệu

    </label>

    <input
        type="file"
        name="document_up"
        class="form-control">

    <?php $__errorArgs = ['document_up'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <small class="text-danger"><?php echo e($message); ?></small>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

</div>

<div class="mb-3">

    <label class="form-label">

        Trạng thái

    </label>

    <select
        name="status"
        class="form-select">

        <option value="draft"
            <?php echo e(old('status', $product->status ?? '') == 'draft' ? 'selected' : ''); ?>>
            Draft
        </option>

        <option value="published"
            <?php echo e(old('status', $product->status ?? '') == 'published' ? 'selected' : ''); ?>>
            Published
        </option>

    </select>

    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <small class="text-danger"><?php echo e($message); ?></small>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

</div>

<button class="btn btn-success">

    Lưu

</button>

<a
    href="<?php echo e(route('products.index')); ?>"
    class="btn btn-secondary">

    Quay lại

</a><?php /**PATH E:\LuuDuLieuSinhVien\laragon\www\kiemtra\resources\views/admin/products/form.blade.php ENDPATH**/ ?>