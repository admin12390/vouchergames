<div class="breadcrumb">
    <div class="container">
        <ul class="breadcrumb my-3">
            <li class="breadcrumb-item text-white"><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
            <li class="breadcrumb-item active text-muted"><?php echo $title ?></li>
        </ul>
    </div>
</div>

<div class="container mb-3">

    <div class="row">

        <div class="col-md-9">
            <div class="row">
                <?php foreach ($product as $product) : ?>
                    <div class="col-4">
                        <div class="card mb-2 bg-dark shadow">
                            <a class="text-decoration-none text-muted" href="<?php echo base_url('product/item/' . $product->product_slug); ?>">
                                <div class="img-frame">
                                    <img src="<?php echo base_url('assets/img/product/' . $product->product_image); ?>" class="card-img-top" alt="...">
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title lh-lg"><?php echo substr($product->product_name, 0, 35); ?>..</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="pagination col-md-12 text-center">
                <?php if (isset($pagination)) {
                    echo $pagination;
                } ?>
            </div>
        </div>
        <div class="col-md-3">
            <?php include "sidebar.php"; ?>
        </div>
    </div>


    <div class="pagination col-md-12 text-center">
        <?php if (isset($paginasi)) {
            echo $paginasi;
        } ?>
    </div>
</div>