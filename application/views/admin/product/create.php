<div class="card mb-4">
    <div class="card-header py-3">
        <?php echo $title; ?>
    </div>
    <div class="card-body">


        <div class="text-center">
            <?php
            echo $this->session->flashdata('message');
            if (isset($errors_upload)) {
                echo '<div class="alert alert-warning">' . $error_upload . '</div>';
            }
            ?>
        </div>
        <?php
        echo form_open_multipart('admin/product/create',  array('class' => 'needs-validation', 'novalidate' => 'novalidate'));
        ?>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nama Game <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="product_name" placeholder="Nama Produk" value="<?php echo set_value('berita_title'); ?>" required>
                <div class="invalid-feedback">Nama Game Harus Di isi</div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Status <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <select name="product_status" class="form-control custom-select" required>
                    <option value="">Pilih Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
                <div class="invalid-feedback">Silahkan pilih status Product</div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Upload Gambar <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <div class="input-group mb-3">
                    <input type="file" name="product_image" required>
                    <div class="invalid-feedback">Silahkan pilih gambar</div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Product Description <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">

                <textarea class="form-control" id="summernote" name="product_desc" placeholder="Deskripsi Berita" required></textarea>
                <div class="invalid-feedback">Silahkan Isi Deskripsi Produk</div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Cara Topup <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">

                <textarea class="form-control" id="summernote2" name="topup_rules" placeholder="Cara Topup" required></textarea>
                <div class="invalid-feedback">Silahkan Isi Deskripsi Produk</div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Keywords
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="product_keywords" placeholder="Pisahkan dengan koma" value="<?php echo set_value('product_keywords'); ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Field
            </label>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="field1" placeholder="Nama Field 1" value="<?php echo set_value('field1'); ?>">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="field2" placeholder="Nama Field 2" value="<?php echo set_value('field2'); ?>">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="field3" placeholder="Nama Field 3" value="<?php echo set_value('field3'); ?>">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="field4" placeholder="Nama Field 4" value="<?php echo set_value('field4'); ?>">
                    </div>
                </div>
            </div>
        </div>



        <div class="form-group row">
            <div class="col-lg-3"></div>
            <div class="col-lg-9">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Publish Game
                </button>
            </div>
        </div>
        <?php echo form_close() ?>
    </div>
</div>