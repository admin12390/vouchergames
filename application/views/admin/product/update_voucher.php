<div class="col-md-6 mx-auto">
  <div class="card shadow-sm">
    <div class="card-header bg-white">
      <?php echo $title; ?>
    </div>
    <div class="card-body">
      <?php
      //Form Open
      echo form_open(base_url('admin/product/update_voucher/' . $voucher->id));
      ?>

      <input type="hidden" name="product_id" value="<?php echo $voucher->product_id ?>">

      <div class="form-group">
        <label>Nama Voucher</label>
        <input type="text" class="form-control" name="voucher_name" value="<?php echo $voucher->voucher_name ?>">
      </div>

      <div class="form-group">
        <label>Harga</label>
        <input type="text" class="form-control" name="voucher_price" value="<?php echo $voucher->voucher_price ?>">
      </div>

      <div class="form-group">
        <input type="submit" class="btn btn-primary" name="submit" value="Update Data">
      </div>
      <?php
      //Form Close
      echo form_close();
      ?>
    </div>
  </div>
</div>