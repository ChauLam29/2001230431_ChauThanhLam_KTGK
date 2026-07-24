<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title','Quản lý sản phẩm'); ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f8f9fa;
        }

        .sidebar{
            min-height:100vh;
            background:#212529;
        }

        .sidebar a{
            color:white;
            text-decoration:none;
            display:block;
            padding:12px;
        }

        .sidebar a:hover{
            background:#343a40;
        }

        .topbar{
            background:white;
            padding:15px;
            border-bottom:1px solid #ddd;
        }

        .content{
            padding:20px;
        }

        img.thumb{
            width:70px;
            height:70px;
            object-fit:cover;
            border-radius:5px;
        }
    </style>

</head>

<body>

<div class="container-fluid">

<div class="row">

    <!-- Sidebar -->
    <div class="col-md-2 sidebar">

        <h4 class="text-white text-center mt-3">
            ADMIN
        </h4>

        <hr class="text-white">

        <a href="<?php echo e(route('products.index')); ?>">
            Quản lý sản phẩm
        </a>

        <a href="<?php echo e(route('products.create')); ?>">
            Thêm sản phẩm
        </a>

    </div>

    <!-- Nội dung -->
    <div class="col-md-10">

        <!-- Topbar -->
        <div class="topbar d-flex justify-content-between">

            <h4>
                <?php echo $__env->yieldContent('title'); ?>
            </h4>

            <strong>
                Xin chào Admin
            </strong>

        </div>

        <!-- Flash Message -->
        <div class="content">

            <?php if(session('ok')): ?>

                <div class="alert alert-success alert-dismissible fade show">

                    <?php echo e(session('ok')); ?>


                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                    </button>

                </div>

            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>

        </div>

    </div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html><?php /**PATH E:\LuuDuLieuSinhVien\laragon\www\kiemtra\resources\views/admin/layouts/main.blade.php ENDPATH**/ ?>