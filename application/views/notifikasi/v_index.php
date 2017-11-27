  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Riwayat</h3>
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
          <th>Jenis Riwayat</th>
          <th>Pesan</th>
          <th>Waktu</th>
        </tr>
        <?php
        $no=1;
        foreach($user as $data):
        ?>
        <tr>
          <td><?=$no?></td>
          <td><?=$data->title?></td>
          <td><?=$data->message?></td>
          <td><?=$data->date?></td>
        </tr>
        <?php
        $no++;
        endforeach;
        ?>
        
       
      </tbody></table>
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
      <a href="<?php site_url();?>print" target="_blank" class="btn btn-info">Print</a>
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