<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$page_title?>
        <small><?=$page_desc?></small>
      </h1>
      <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active"><?=$this->session->userdata('level')?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      <?php
      if($this->session->flashdata('k')):
      ?>
      <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Sukses!</h4>
                <?=$this->session->flashdata('k')?>
              </div>
      <?php endif;?>

      <?=$page?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->