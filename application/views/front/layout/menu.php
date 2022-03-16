<?php
$id             = $this->session->userdata('id');
$user           = $this->user_model->user_detail($id);
$meta           = $this->meta_model->get_meta();
$menu           = $this->menu_model->get_menu();

?>


<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark shadow-sm" id="top">
  <div class="container">
    <a class="navbar-brand" href="<?php echo base_url() ?>"><img class="img-fluid" src="<?php echo base_url('assets/img/logo/' . $meta->logo) ?>"></a>
    <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav">
        <?php foreach ($menu as $data) : ?>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url($data->url); ?>"> <?php echo $data->nama_menu_ind; ?> </a></li>
        <?php endforeach; ?>
      </ul>
      <ul class="navbar-nav ml-auto">

        <?php if ($this->session->userdata('email')) { ?>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="ti-user"></i> <?php echo $user->fullname; ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?php echo base_url('myaccount') ?>"> <i class="ri-user-line"></i> Profile</a>
              <a class="dropdown-item" href="<?php echo base_url('myaccount/update') ?>"> <i class="ri-draft-line"></i> Ubah Profile</a>
              <a class="dropdown-item" href="<?php echo base_url('myaccount/ubah_password') ?>"> <i class="ri-lock-password-line"></i> Ubah Password</a>
              <a class="dropdown-item" href="<?php echo base_url('myaccount/transaction') ?>"> <i class="ri-file-list-3-line"></i> Transaksi</a>

              <div class="dropdown-divider"></div>
              <?php if ($user->role_id == 1) : ?>
                <a class="dropdown-item" href="<?php echo base_url('admin/dashboard'); ?>"> <i class="ri-dashboard-3-line"></i> Panel Admin</a>
              <?php endif; ?>
              <a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>"> <i class="ri-shut-down-line"></i> Logout</a>
            </div>
          </li>
        <?php } else { ?>
          <a class="btn btn-info text-white my-auto mr-5" href="<?php echo base_url('transaction'); ?>"> Cek Order</a>

          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('auth') ?>"><i class="bi-box-arrow-in-right" style="font-size: 1.5rem;"></i> Login</a></li>
          <span class="border-right border-secondary"></span>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url('auth/register') ?>"> <i class="bi bi-person" style="font-size: 1.5rem;"></i> Register</a></li>

        <?php } ?>
      </ul>
    </div>
  </div>
</nav>