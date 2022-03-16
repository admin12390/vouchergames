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
        echo form_open_multipart('admin/product/update/' . $product->id,  array('class' => 'needs-validation', 'novalidate' => 'novalidate'));
        ?>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nama Game <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="product_name" placeholder="Nama Produk" value="<?php echo $product->product_name; ?>" required>
                <div class="invalid-feedback">Nama Game Harus Di isi</div>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Status <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <select name="product_status" class="form-control custom-select" required>
                    <option value="">Pilih Status</option>
                    <option value="1" <?php if ($product->product_status == 1) {
                                            echo "selected";
                                        }; ?>>Active</option>
                    <option value="0" <?php if ($product->product_status == 0) {
                                            echo "selected";
                                        }; ?>>Inactive</option>
                </select>
                <div class="invalid-feedback">Silahkan pilih status Product</div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Ganti Gambar <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <div class="input-group mb-3">
                    <input type="file" name="product_image">
                    <div class="invalid-feedback">Silahkan pilih gambar</div>
                </div><br>
                <img width="50%" src="<?php echo base_url('assets/img/product/' . $product->product_image); ?>" class="img-fluid">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Product Description <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">

                <textarea class="form-control" id="summernote" name="product_desc" placeholder="Deskripsi Berita" required><?php echo $product->product_desc; ?> </textarea>
                <div class="invalid-feedback">Silahkan Isi Deskripsi Produk</div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Cara Topup <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">

                <textarea class="form-control" id="summernote2" name="topup_rules" placeholder="Cara Topup" required><?php echo $product->topup_rules; ?></textarea>
                <div class="invalid-feedback">Silahkan Isi Deskripsi Produk</div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Keywords
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="product_keywords" placeholder="Pisahkan dengan koma" value="<?php echo $product->product_keywords; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Field
            </label>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="field1" placeholder="Nama Field 1" value="<?php echo $product->field1; ?>">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="field2" placeholder="Nama Field 2" value="<?php echo $product->field2; ?>">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="field3" placeholder="Nama Field 3" value="<?php echo $product->field3; ?>">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="field4" placeholder="Nama Field 4" value="<?php echo $product->field4; ?>">
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