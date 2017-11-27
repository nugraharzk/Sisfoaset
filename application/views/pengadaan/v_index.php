        <?php if ($this->session->userdata('level') == 'logistik') { ?>
          <div class="row">
            <div class="col-md-3 col-md-offset-9">
              <a href="<?=site_url('pengadaan/add')?>" class="btn btn-block btn-primary">Tambah</a>
            </div>
          </div>
        <?php } ?>
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Daftar Persetujuan</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered">
              <tbody><tr>
                <th style="width: 10px">No</th>
                <th>Jenis</th>
                <th>Merek</th>
                <th>Nilai Akuisisi</th>
                <th>Aksi / Pemberitahuan</th>
              </tr>
              <?php
              $no=1;
              foreach($pengadaan as $data):
              ?>
              <tr>
                <td><?=$no?></td>
                <td><?=$data->jenis?></td>
                <td><?=$data->merek?></td>
                <td>Rp. <?=$data->nilai?></td>
                <td>
                  <?php if($this->session->userdata('level')=='dirut' && $data->status==0){ ?>
                    <p>Data sedang diproses oleh Bendahara</p>
                  <?php }elseif ($this->session->userdata('level')=='logistik' && $data->status==0) {?>
                    <p>Data sedang diproses oleh Bendahara</p>
                  <?php } ?>

                  <?php if($this-> session->userdata('level')=='bendahara' && $data->status==0){?>
                    <a href="<?=site_url('pengadaan/acc_bendahara/'.$data->id)?>" class="btn btn-info">Acc ajuan by Bendahara</a>
                    <a href="<?=site_url('pengadaan/delete/'.$data->id)?>" data-id="<?=$data->id?>" onclick="return warnDelete();"  class="btn btn-danger">Tolak</button>
                  <?php }elseif($this->session->userdata('level')=='bendahara' && $data->status==1){?>
                    <p>Data sedang diproses oleh Direktur Utama</p>
                  <?php } ?>

                  <?php if($this->session->userdata('level')=='dirut' && $data->status == 1){?>
                  <a href="<?=site_url('pengadaan/acc_dirut/'.$data->id)?>" class="btn btn-info">Acc ajuan by Dirut</a>
                  <a href="<?=site_url('pengadaan/delete/'.$data->id)?>" data-id="<?=$data->id?>" onclick="return warnDelete();"  class="btn btn-danger">Tolak</button>
                  <?php }elseif($this->session->userdata('level')=='dirut' && $data->status==2){ ?>
                    <p>Data sedang diproses oleh Bendahara</p>
                  <?php } ?>

                  <?php if($this->session->userdata('level')=='bendahara' && $data->status == 2){?>
                    <a href="<?=site_url('pengadaan/pencairan_dana/'.$data->id)?>" class="btn btn-info">Pencairan Dana</a>
                  <?php }elseif($this->session->userdata('level')=='bendahara' && $data->status==3){ ?>
                    <p>Dana sudah dicairkan kepada Logistik</p>
                  <?php } ?>

                  <?php if($this->session->userdata('level')=='logistik' && $data->status == 3){?>
                    <a href="<?=site_url('pengadaan/terima_dana/'.$data->id)?>" class="btn btn-info">Terima Dana</a>
                  <?php }elseif($this->session->userdata('level')=='logistik' && $data->status==4){ ?>
                    <p>Dana sudah diterima dan siap beli aset.</p>
                  <?php }elseif(($this->session->userdata('level')=='dirut' || $this->session->userdata('level')=='bendahara') && $data->status==4){ ?>
                    <p>Dana sudah diterima oleh Logistik</p>
                  <?php } ?>

                  <?php if($this->session->userdata('level')=='logistik' && $data->status == 4){?>
                    <a href="<?=site_url('pengadaan/beli_aset/'.$data->id)?>" class="btn btn-info">Beli Aset</a>
                  <?php }elseif($this->session->userdata('level')=='logistik' && $data->status==5){ ?>
                    <p>Aset sudah dibeli dan siap input nota.</p>
                  <?php }elseif(($this->session->userdata('level')=='dirut' || $this->session->userdata('level')=='bendahara') && $data->status==5){ ?>
                    <p>Aset sudah dibeli oleh Logistik</p>
                  <?php } ?>

                  <?php if($this->session->userdata('level')=='logistik' && $data->status == 5){?>
                    <a href="<?=site_url('pengadaan/input_nota/'.$data->id)?>" class="btn btn-info">Input Nota Pembelian</a>
                  <?php }elseif($this->session->userdata('level')=='logistik' && $data->status==6){ ?>
                    <p>Data sedang diproses oleh Bendahara.</p>
                  <?php } ?>

                  <?php if($this->session->userdata('level')=='bendahara' && $data->status == 6){?>
                    <a href="<?=site_url('pengadaan/acc_laporan_beli_bendahara/'.$data->id)?>" class="btn btn-info">Acc Laporan Beli by Bendahara</a>
                    <a href="<?=site_url('pengadaan/delete/'.$data->id)?>" data-id="<?=$data->id?>" onclick="return warnDelete();"  class="btn btn-danger">Tolak</button>
                  <?php }elseif($this->session->userdata('level')=='dirut' && $data->status==6){ ?>
                    <p>Dana sedang diproses Bendahara</p>
                  <?php } ?>
                
                </td>
              </tr>
              <?php
              $no++;
              endforeach;
              ?>
              
             
            </tbody></table>
          </div>
          <!-- /.box-body -->
      <?php if($this->session->userdata('level')=='dirut'){ ?>
          <br>
          <div class="box-header with-border">
            <h3 class="box-title">Daftar Penghapusan</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered">
              <tbody><tr>
                <th style="width: 10px">No</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Nilai Akuisisi</th>
                <th>Spesifikasi</th>
                <th>Aksi / Pemberitahuan</th>
              </tr>
              <?php
              $no=1;
              foreach($asset as $data):
              ?>
              <tr>
                <td><?=$no?></td>
                <td><?=$data->nama?></td>
                <td><?=$data->jenis?></td>
                <td>Rp. <?=$data->nilai?></td>
                <td><?=$data->spesifikasi?></td>
                <td>
                  <a href="<?=site_url('pengadaan/acc_hapus_dirut/'.$data->id)?>" class="btn btn-info">Acc Penghapusan</a>
                  <a href="<?=site_url('pengadaan/tolak_hapus_dirut/'.$data->id)?>" class="btn btn-danger">Tolak Penghapusan</a>
                </td>
              </tr>
              <?php
              $no++;
              endforeach;
              ?>
              
             
            </tbody></table>
          </div>
          <!-- /.box-body -->
      <?php } ?>
          <div class="box-footer clearfix">
           <?=$paging?>
            
          </div>
        </div>
        <script>
function warnDelete() {
  job=confirm("Are you sure to delete permanently?");
  if(job!=true)
  {
      return false;
  }
  
}
</script>