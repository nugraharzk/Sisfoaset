<div class="box">
            <?php if($this->session->userdata('level') == 'logistik'){ ?>
            <div class="box-header with-border">
              <h3 class="box-title">Pengajuan Perawatan</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">

                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 10px">No</th>
                  <th>Nama Asset</th>
                  <th>Action</th>
                </tr>
                <?php
                $no=1;
                foreach($asset as $data):
                ?>
                <tr>
                  <?php if($data->status_rawat < 2){ ?>
                    <td><?=$no?></td>
                    <td><?=$data->nama?></td>
                    <td>
                      <?php if ($data->status_rawat == 0) {?>
                        <a href="<?=site_url('perawatan/add/'.$data->id)?>" data-id="<?=$data->id?>" class="btn btn-success">Ajukan Perawatan <?=$data->nama?></button>
                      <?php }elseif($data->status_rawat == 1){ ?>
                      <a href="<?=site_url('perawatan/addDetail/'.$data->id)?>" data-id="<?=$data->id?>" class="btn btn-primary">Isi Detail Perawatan <?=$data->nama?></button>
                        <a href="<?=site_url('perawatan/delete/'.$data->id)?>" data-id="<?=$data->id?>" onclick="return warnDelete();"  class="btn btn-danger">Hapus</button>
                        <?php } ?>
                    </td>
                  <?php } ?>
                </tr>
                <?php
                $no++;
                endforeach;
                ?>
                
               
              </tbody></table>
            </div><br>
            <?php } ?>
            <div class="box-header with-border">
              <h3 class="box-title">List Pengajuan Perawatan</h3>
              <div class="box-tools">
              </div>
            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 10px">No</th>
                  <th>Nama Asset</th>
                  <th>Jenis Asset</th>
                  <th>Jenis Perawatan</th>
                  <th>Biaya Perawatan</th>
                  <th>Action</th>
                </tr>
                <?php
                $no=1;
                foreach($asset_rawat as $data):
                ?>
                <tr>
                  <td><?=$no?></td>
                  <td><?=$data->nama?></td>
                  <td><?=$data->jenis?></td>
                  <td><?=$data->jenis_rawat?></td>
                  <td><?=$data->biaya_rawat?></td>
                  <td>
                    <?php if($this->session->userdata('level')=='dirut' && $data->status==0){ ?>
                    <p>Data sedang diproses oleh Bendahara</p>
                  <?php }elseif ($this->session->userdata('level')=='logistik' && $data->status==0) {?>
                    <p>Data sedang diproses oleh Bendahara</p>
                  <?php } ?>

                  <?php if($this-> session->userdata('level')=='bendahara' && $data->status==0){?>
                    <a href="<?=site_url('perawatan/acc_bendahara/'.$data->id)?>" class="btn btn-info">Acc ajuan by Bendahara</a>
                    <a href="<?=site_url('perawatan/delete/'.$data->id)?>" data-id="<?=$data->id?>" onclick="return warnDelete();"  class="btn btn-danger">Tolak</button>
                  <?php }elseif(($this->session->userdata('level')=='bendahara' && $data->status==1) || ($this->session->userdata('level')=='logistik' && $data->status==1)){?>
                    <p>Data sedang diproses oleh Direktur Utama</p>
                  <?php } ?>

                  <?php if($this->session->userdata('level')=='dirut' && $data->status == 1){?>
                  <a href="<?=site_url('perawatan/acc_dirut/'.$data->id)?>" class="btn btn-info">Acc ajuan by Dirut</a>
                  <a href="<?=site_url('perawatan/delete/'.$data->id)?>" data-id="<?=$data->id?>" onclick="return warnDelete();"  class="btn btn-danger">Tolak</button>
                  <?php }elseif(($this->session->userdata('level')=='dirut' && $data->status==2) || ($this->session->userdata('level')=='logistik' && $data->status==2)){ ?>
                    <p>Data sedang diproses oleh Bendahara</p>
                  <?php } ?>

                  <?php if($this->session->userdata('level')=='bendahara' && $data->status == 2){?>
                    <a href="<?=site_url('perawatan/pencairan_dana/'.$data->id)?>" class="btn btn-info">Pencairan Dana</a>
                  <?php }elseif(($this->session->userdata('level')=='bendahara' && $data->status==3) || ($this->session->userdata('level')=='dirut' && $data->status==3)){ ?>
                    <p>Dana sudah dicairkan kepada Logistik</p>
                  <?php } ?>

                  <?php if($this->session->userdata('level')=='logistik' && $data->status == 3){?>
                    <a href="<?=site_url('perawatan/terima_dana/'.$data->id)?>" class="btn btn-info">Terima Dana</a>
                  <?php }elseif($this->session->userdata('level')=='logistik' && $data->status==4){ ?>
                    <p>Dana sudah diterima dan siap melakukan perawatan.</p>
                  <?php }elseif(($this->session->userdata('level')=='dirut' || $this->session->userdata('level')=='bendahara') && $data->status==4){ ?>
                    <p>Dana sudah diterima oleh Logistik</p>
                  <?php } ?>

                  <?php if($this->session->userdata('level')=='logistik' && $data->status == 4){?>
                    <a href="<?=site_url('perawatan/rawat_aset/'.$data->id)?>" class="btn btn-info">Rawat Asset</a>
                  <?php }elseif($this->session->userdata('level')=='logistik' && $data->status==5){ ?>
                    <p>Aset sudah dirawat dan siap input nota.</p>
                  <?php }elseif(($this->session->userdata('level')=='dirut' || $this->session->userdata('level')=='bendahara') && $data->status==5){ ?>
                    <p>Aset sudah dirawat oleh Logistik</p>
                  <?php } ?>

                  <?php if($this->session->userdata('level')=='logistik' && $data->status == 5){?>
                    <a href="<?=site_url('perawatan/input_nota/'.$data->id)?>" class="btn btn-info">Input Nota Perawatan</a>
                  <?php }elseif($this->session->userdata('level')=='logistik' && $data->status==6){ ?>
                    <p>Data sedang diproses oleh Bendahara.</p>
                  <?php } ?>

                  <?php if($this->session->userdata('level')=='bendahara' && $data->status == 6){?>
                    <a href="<?=site_url('perawatan/acc_laporan_rawat_bendahara/'.$data->id)?>" class="btn btn-info">Acc Laporan Rawat by Bendahara</a>
                    <a href="<?=site_url('perawatan/delete/'.$data->id)?>" data-id="<?=$data->id?>" onclick="return warnDelete();"  class="btn btn-danger">Tolak</button>
                  <?php }elseif($this->session->userdata('level')=='dirut' && $data->status==6){ ?>
                    <p>Data sedang diproses Bendahara</p>
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