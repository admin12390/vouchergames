<div class="breadcrumb">
    <div class="container">
        <ul class="breadcrumb my-3">
            <li class="breadcrumb-item text-muted"><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
            <li class="breadcrumb-item text-muted"><a href="<?php echo base_url('berita') ?>"> Berita</a></li>

            <li class="breadcrumb-item active"><?php echo $title ?></li>
        </ul>
    </div>
</div>
<div class="container mb-3">
    <div class="row">
        <div class="col-md-9">
            <div class="card mb-3 bg-dark shadow text-muted">
                <div class="card-body">
                    <h2><?php echo $berita->berita_title; ?></h2>
                </div>
                <img class="img-fluid" src="<?php echo base_url('assets/img/artikel/' . $berita->berita_gambar); ?>">
                <div class="card-body">
                    <?php echo $berita->berita_desc; ?>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <span><i class="bi-person"></i> <?php echo $berita->user_name; ?></span>
                    <span><i class="bi-eye"></i> <?php echo $berita->berita_views; ?></span>
                    <span><i class="bi-calendar"></i><?php echo date('d/m/Y', strtotime($berita->date_created)); ?>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <?php include "sidebar.php"; ?>
        </div>

    </div>
</div>