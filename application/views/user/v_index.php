<div class="row">
  <div class="col-md-3 col-md-offset-9">
    <a href="<?=site_url('user/add')?>" class="btn btn-block btn-primary">Tambah</a>
  </div>
</div>
<div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar User</h3>
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
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Level</th>
                  <th>Action</th>
                </tr>
                <?php
                $no=1;
                foreach($user as $data):
                ?>
                <tr>
                  <td><?=$no?></td>
                  <td><?=$data->nama?></td>
                  <td><?=$data->username?></td>
                  <td><?=$data->level?></td>
                  <td>
                    <a href="<?=site_url('user/update/'.$data->id)?>" class="btn btn-primary">Edit</a>
                    <a href="<?=site_url('user/delete/'.$data->id)?>" data-id="<?=$data->id?>" onclick="return warnDelete();"  class="btn btn-danger">Hapus</button>
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