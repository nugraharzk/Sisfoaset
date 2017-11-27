<div class="row">
  <div class="col-md-3 col-md-offset-9">
    <a href="<?=site_url('approve')?>" class="btn btn-block btn-primary">Approval List</a>
  </div>
</div>
<div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Approval List</h3>
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
                  <th>Id</th>
                  <th>Id Barang</th>
                  <th>Nama Barang</th>
                  <th>Tanggal Pengajuan</th>
                  <th>Approve Dirut</th>
                  <th>Approve Bendahara</th>
                  <th>Tanggal Approve Dirut</th>
                  <th>Tanggal Approve Bendahara</th>
                </tr>
                <?php
                $no=1;$val="Ya";$vel="Ya";$tag="-";$teg="-";
                foreach($approval as $data):
                if($data->apv_dirut == 0){
                  $val = "Tidak";
                }
                if ($data->apv_bendahara == 0){
                  $vel = "Tidak";
                }
                if ($data->tgl_apv_dirut!=NULL) {
                  $tag = $data->tgl_apv_dirut;
                }
                if ($data->tgl_apv_bendahara!=NULL) {
                  $teg = $data->tgl_apv_bendahara;
                }
                ?>
                <tr>
                  <td><?=$no?></td>
                  <td><?=$data->id?></td>
                  <td><?=$data->id_barang?></td>
                  <td><?=$data->nama_barang?></td>
                  <td><?=$data->tgl_pengajuan?></td>
                  <td><?=$val?></td>
                  <td><?=$vel?></td>
                  <td><?=$tag?></td>
                  <td><?=$teg?></td>
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