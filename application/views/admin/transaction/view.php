<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <address>
                    <strong><?php echo $transaction->user_name; ?> </strong> <br>
                    Alamat Jemput : <?php echo $transaction->alamat_jemput; ?> <br>
                    Phone : <?php echo $transaction->user_phone; ?> <br>
                    Email : <?php echo $transaction->user_email; ?>
                </address>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <b>Invoice #<?php echo $transaction->kode_transaction; ?></b><br>
                <b>Tanggal jemput :</b> <?php echo $transaction->tanggal_jemput; ?><br>
                <b>Tipe Pembayaran :</b> <?php echo $transaction->tipe_pembayaran; ?><br>
                <b>Status Pembayaran :</b> <?php if ($transaction->status_bayar == "Pending") : ?>
                    <div class="badge badge-warning badge-pill"> <?php echo $transaction->status_bayar; ?></div>
                <?php elseif ($transaction->status_bayar == "Process") : ?>
                    <div class="badge badge-info badge-pill"> <?php echo $transaction->status_bayar; ?></div>
                <?php elseif ($transaction->status_bayar == "Cancel") : ?>
                    <div class="badge badge-danger badge-pill"> <?php echo $transaction->status_bayar; ?></div>
                <?php else : ?>
                    <div class="badge badge-success badge-pill"> <?php echo $transaction->status_bayar; ?></div>
                <?php endif; ?>
            </div><!-- /.col -->
        </div><!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Paket Kendaraan</th>

                            <th>Harga</th>
                            <th>Kode Unik</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>


                        <tr>
                            <td><strong><?php echo $transaction->nama_mobil; ?></strong><br>
                                <small><?php echo $transaction->nama_paket; ?> , <?php echo $transaction->lama_sewa; ?> Hari </small>
                            </td>

                            <td>IDR. <?php echo number_format($transaction->harga_satuan, 0, ",", "."); ?></td>
                            <td><?php echo $transaction->kode_unik; ?></td>
                            <td>IDR. <?php echo number_format($transaction->total_harga, 0, ",", "."); ?></td>
                        </tr>
                    <tfoot>
                        <tr>
                            <th> </th>

                            <th></th>
                            <th>Total</th>
                            <th>IDR. <?php echo number_format($transaction->total_harga, 0, ",", "."); ?></th>
                        </tr>
                    </tfoot>
                    </tbody>
                </table>
            </div><!-- /.col -->

            <?php if ($transaction->tipe_pembayaran == "Cash" && $transaction->status_bayar == "Pending") : ?>
                <div class="col  d-grid gap-2">
                    <a href="<?php echo base_url('admin/transaction/process/' . $transaction->id); ?>" class="btn btn-success"><i class="fa fa-check"></i> Konfirmasi Order</a>
                </div>
                <div class="col d-grid gap-2">
                    <a href="<?php echo base_url('admin/transaction/cancel/' . $transaction->id); ?>" class="btn btn-danger"><i class="fa fa-times"></i> Batalkan Pesanan</a>
                </div>
            <?php elseif ($transaction->tipe_pembayaran == "Cash" && $transaction->status_bayar == "Process") : ?>
                <a href="<?php echo base_url('admin/transaction/cancel/' . $transaction->id); ?>" class="btn btn-danger d-grid gap-2"><i class="fa fa-times"></i> Batalkan Pesanan</a>
                <a href="<?php echo base_url('admin/transaction/confirm/' . $transaction->id); ?>" class="btn btn-success d-grid gap-2"><i class="fa fa-times"></i> Selesai</a>
            <?php elseif ($transaction->tipe_pembayaran == "Cash" && $transaction->status_bayar == "Cancel") : ?>
            <?php else : ?>
                <div class="col-md-4">

                    <?php if ($transaction->bukti_bayar == NULL) : ?>

                        <div class="alert alert-danger">Belum Ada Pembayaran</div>
                    <?php else : ?>

                        <img src="<?php echo base_url('assets/img/struk/' . $transaction->bukti_bayar); ?>" class="img-fluid">
                    <?php endif; ?>

                </div>
                <div class="col-md-8">

                    <?php if ($transaction->status_bayar == "Done") : ?>

                    <?php elseif ($transaction->bukti_bayar == NULL) : ?>
                        <a href="<?php echo base_url('admin/transaction/cancel/' . $transaction->id); ?>" class="btn btn-danger pull-right"><i class="fa fa-times"></i> Batalkan Pesanan</a>

                    <?php elseif ($transaction->status_bayar == "Process") : ?>
                        <a href="<?php echo base_url('admin/transaction/confirm/' . $transaction->id); ?>" class="btn btn-success pull-right"><i class="fa fa-check"></i> Konfirmasi Pembayaran</a>
                        <a href="<?php echo base_url('admin/transaction/cancel/' . $transaction->id); ?>" class="btn btn-danger pull-right"><i class="fa fa-times"></i> Batalkan Pesanan</a>

                    <?php elseif ($transaction->status_bayar == "Pending") : ?>
                        <a href="<?php echo base_url('admin/transaction/confirm/' . $transaction->id); ?>" class="btn btn-success pull-right"><i class="fa fa-check"></i> Konfirmasi Pembayaran</a>
                        <a href="<?php echo base_url('admin/transaction/cancel/' . $transaction->id); ?>" class="btn btn-danger pull-right"><i class="fa fa-times"></i> Batalkan Pesanan</a>
                    <?php else : ?>

                    <?php endif; ?>

                </div>
            <?php endif; ?>
        </div><!-- /.row -->


    </div>
</div>