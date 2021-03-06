<div class="row">

  <div class="col-md-12">
    <?php
    //Notifikasi
    if ($this->session->flashdata('sukses')) {
      echo $this->session->flashdata('sukses');
    }

    //Error warning
    echo validation_errors('<div class="alert alert-warning">', '</div>');
    //include Tambah


    ?>
  </div>

  <div class="col-md-4">
    <div class="card mb-2">
      <div class="card-body">
        <img src="<?php echo base_url('assets/img/product/' . $product->product_image) ?>" class="img-fluid">
        <h2> <?php echo $product->product_name; ?></h2>
      </div>
    </div>
  </div>

  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <?php include('create_voucher.php'); ?>
      </div>


      <div class="table-responsive">
        <table class="table table-flush">
          <thead>
            <tr>
              <th>Paket Name</th>
              <th>Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>

            <?php $i = 1;
            foreach ($voucher as $data) { ?>

              <tr>

                <td><?php echo $data->voucher_name ?></td>
                <td>Rp. <?php echo number_format($data->voucher_price, '0', ',', ','); ?></td>
                <td>

                  <a href="<?php echo base_url('admin/product/update_voucher/' . $data->id) ?>" title="Edit Mobil" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                  <?php
                  //link Delete
                  include('delete_voucher.php');
                  ?>



                </td>
              </tr>

            <?php } ?>

          </tbody>
        </table>
      </div>

    </div>

  </div>


</div>