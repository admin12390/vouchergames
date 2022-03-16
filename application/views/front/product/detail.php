<style>
    .inputGroup {
        background-color: #343a40;
        display: block;
        margin: 10px 0;
        position: relative;

    }

    .inputGroup label {
        padding: 12px 30px;
        width: 100%;
        display: block;
        text-align: left;
        color: #ddd;
        cursor: pointer;
        position: relative;
        z-index: 2;
        transition: color 200ms ease-in;
        overflow: hidden;
        border: 1px solid #50575d;
        border-radius: 3px;

    }

    .inputGroup label:before {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        content: "";
        background-color: #495056;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%) scale3d(1, 1, 1);
        transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1);
        opacity: 0;
        z-index: -1;
        box-shadow: 0 20px 50px rgba(0, 0, 0, .1);

    }

    .inputGroup label:after {
        width: 32px;
        height: 32px;
        content: "";
        /* border: 2px solid #D1D7DC; */
        background-color: transparent;
        /* background-image: url("data:image/svg+xml,%3Csvg width='32' height='32' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5.414 11L4 12.414l5.414 5.414L20.828 6.414 19.414 5l-10 10z' fill='%23fff' fill-rule='nonzero'/%3E%3C/svg%3E "); */
        background-repeat: no-repeat;
        background-position: 2px 3px;
        border-radius: 50%;
        z-index: 2;
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        transition: all 200ms ease-in;
        /* border: 1px solid #005d46; */

    }

    .inputGroup input:checked~label {
        color: #fff;

    }

    .inputGroup input:checked~label:before {
        transform: translate(-50%, -50%) scale3d(56, 56, 1);
        opacity: 1;

    }

    .inputGroup input:checked~label:after {
        background-color: transparent;
        border-color: #005d46;

    }

    .inputGroup input {
        width: 32px;
        height: 32px;
        order: 1;
        z-index: 2;
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        visibility: hidden;
    }
</style>
<div class="breadcrumb">
    <div class="container">
        <ul class="breadcrumb my-3">
            <li class="breadcrumb-item text-muted"><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
            <li class="breadcrumb-item text-muted"><a href="<?php echo base_url('product') ?>"> Product</a></li>
            <li class="breadcrumb-item active text-muted"><?php echo $title ?></li>
        </ul>
    </div>
</div>
<div class="container mb-3">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3 bg-dark shadow text-muted">
                <div class="card-body">
                    <h3 class="text-white"><?php echo $product->product_name; ?></h3>
                </div>
                <img class="img-fluid" src="<?php echo base_url('assets/img/product/' . $product->product_image); ?>">
                <div class="card-body text-white">
                    <?php echo $product->topup_rules; ?>
                    <?php echo $product->product_desc; ?>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <span><i class="bi-eye"></i> <?php echo $product->product_views; ?> Kali dikunjungi</span>
                </div>
            </div>
        </div>
        <div class="col-md-8">

            <?php echo form_open('product/item'); ?>

            <div class="card bg-dark shadow">
                <div class="card-header text-white">
                    Informasi User
                </div>
                <div class="card-body text-white">
                    <div class="row">
                        <?php if ($product->field1 == null) : ?>
                        <?php else : ?>
                            <div class="col-md-6">
                                <label><?php echo $product->field1; ?></label>
                                <input type="text" class="form-control" name="field1" placeholder="<?php echo $product->field1; ?>" value="<?php echo set_value('field1'); ?>">
                            </div>
                        <?php endif; ?>
                        <?php if ($product->field2 == null) : ?>
                        <?php else : ?>
                            <div class="col-md-6">
                                <label><?php echo $product->field2; ?></label>
                                <input type="text" class="form-control" name="field2" placeholder="<?php echo $product->field2; ?>" value="<?php echo set_value('field2'); ?>">
                            </div>
                        <?php endif; ?>
                        <?php if ($product->field3 == null) : ?>
                        <?php else : ?>
                            <div class="col-md-6">
                                <label><?php echo $product->field3; ?></label>
                                <input type="text" class="form-control" name="field3" placeholder="<?php echo $product->field3; ?>" value="<?php echo set_value('field3'); ?>">
                            </div>
                        <?php endif; ?>
                        <?php if ($product->field4 == null) : ?>
                        <?php else : ?>
                            <div class="col-md-6">
                                <label><?php echo $product->field3; ?></label>
                                <input type="text" class="form-control" name="field3" placeholder="<?php echo $product->field3; ?>" value="<?php echo set_value('field3'); ?>">
                            </div>
                        <?php endif; ?>
                        <div class="col-md-12 my-2">
                            <label>Nomor Whatsapp</label>
                            <input type="text" class="form-control" name="whatsapp" placeholder="0813.." value="<?php echo set_value('whatsapp'); ?>">
                        </div>

                    </div>
                </div>
            </div>
            <h3 class="text-muted my-3">Pilih Voucher</h3>
            <div class="row">
                <?php foreach ($list_voucher as $voucher) : ?>
                    <div class="col-md-4 col-6">
                        <div class="inputGroup">
                            <input id="radio<?php echo $voucher->id; ?>" name="voucher_id" value="<?php echo $voucher->id; ?>" onclick="calculate(this);" type="radio">
                            <label for="radio<?php echo $voucher->id; ?>">
                                <?php echo $voucher->voucher_name;
                                ?>
                            </label>
                            <?php echo form_error('voucher_id', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
            <div class="card bg-dark text-white shadow my-3">
                <div class="card-header">
                    Informasi Harga
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <span style="font-size: 20px;"> IDR <output type="text" name="price" id="output"></output></span>

                        </div>
                        <div class="col-md-6"> <button class="btn btn-info btn-block btn-lg" type="submit">Checkout</button>
                        </div>
                    </div>

                </div>
            </div>

            <?php echo form_close(); ?>

        </div>
    </div>
</div>

<script>
    function calculate(obj) {
        document.getElementById("output").innerHTML = obj.value;
    }
</script>