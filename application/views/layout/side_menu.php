<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=base_url('assets/img/user2-160x160.jpg')?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$this->session->userdata('nama')?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="<?=site_url('asset')?>"><i class="fa fa-link"></i><span>Asset Tetap</span></a></li>
        <?php if($this->session->userdata('level') != 'logistik' && $this->session->userdata('level') != 'admin'){ ?>
          <li class="active"><a href="<?=site_url('pengadaan')?>"><i class="fa fa-link"></i><span>Daftar Persetujuan</span></a></li>
          <li class="active"><a href="<?=site_url('notifikasi')?>"><i class="fa fa-link"></i><span>Riwayat</span></a></li>
        <?php } ?>
        <?php if($this->session->userdata('level') == 'admin'){ ?>
          <li class="active"><a href="<?=site_url('user')?>"><i class="fa fa-link"></i><span>Kelola Akun</span></a></li>
          <li class="active"><a href="<?=site_url('pengadaan')?>"><i class="fa fa-link"></i><span>Pengadaan</span></a></li>
        <?php } ?>
        <?php if($this->session->userdata('level') == 'logistik'){ ?>
          <li class="active"><a href="<?=site_url('pengadaan')?>"><i class="fa fa-link"></i><span>Pengadaan</span></a></li>
          <li class="active"><a href="<?=site_url('penghapusan')?>"><i class="fa fa-link"></i><span>Penghapusan</span></a></li>
        <?php } ?>
        <li class="active"><a href="<?=site_url('perawatan')?>"><i class="fa fa-link"></i><span>Perawatan</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
