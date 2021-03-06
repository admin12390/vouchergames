<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Tambah">
  <i class="fa fa-plus"></i> Tambah Baru
</button>

<div class="modal modal-default fade" id="Tambah">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>

      </div>
      <div class="modal-body">
        <?php
        //Form Open
        echo form_open(base_url('admin/product/voucher/' . $product_id));
        ?>

        <div class="form-group">
          <label>Nama Voucher</label>
          <input type="text" class="form-control" name="voucher_name" placeholder="Nama Voucher" required="required">
        </div>

        <div class="form-group">
          <label>Harga Voucher</label>
          <input type="text" class="form-control" name="voucher_price" placeholder="Harga" required="required">
        </div>

        <div class="form-group">
          <input type="submit" class="btn btn-primary" name="submit" value="Simpan Data">
        </div>

        <?php
        //Form Close
        echo form_close();
        ?>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary pull-right" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>

      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->