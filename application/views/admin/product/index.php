<div class="card">
    <div class="card-header d-flex flex-row align-items-center justify-content-between">
        <?php echo $title; ?>
        <a href="<?php echo base_url('admin/product/create'); ?>" class="btn btn-info waves-effect waves-light">Create Product</a>
    </div>

    <?php
    if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
        unset($_SESSION['message']);
    }
    ?>


    <div class="table-responsive">
        <table class="table table-flush">
            <thead>
                <tr>
                    <th width="3%">No</th>
                    <th width="10%">Image</th>
                    <th>Product Name</th>
                    <th>Voucher</th>
                    <th>Views</th>
                    <th width="25%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($product as $data) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><img class="img-fluid" src="<?php echo base_url('assets/img/product/' . $data->product_image); ?>"> </td>
                    <td><?php echo $data->product_name; ?></td>
                    <td> <a href="<?php echo base_url('admin/product/voucher/' . $data->id); ?>" class="btn btn-info btn-sm"><i class="ti-ticket"></i> Voucher</a>
                    </td>
                    <td><?php echo $data->product_views; ?></td>
                    <td>
                        <a href="<?php echo base_url('product/item/' . $data->product_slug); ?>" class="btn btn-primary btn-sm"><i class="ti-eye"></i> Lihat</a>
                        <a href="<?php echo base_url('admin/product/update/' . $data->id); ?>" class="btn btn-info btn-sm"><i class="ti-pencil-alt"></i> Edit</a>
                        <?php include "delete.php"; ?>
                    </td>
                </tr>

            <?php $no++;
            }; ?>
        </table>

        <div class="pagination col-md-12 text-center">
            <?php if (isset($pagination)) {
                echo $pagination;
            } ?>
        </div>

    </div>

</div>