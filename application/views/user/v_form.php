<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="nama" class="col-sm-2 control-label">Nama</label>

                  <div class="col-sm-10">
                    <input name="nama" type="text" class="form-control" id="nama" placeholder="nama">
                  </div>
                </div>
                
                
                <div class="form-group">
                  <label for="username" class="col-sm-2 control-label">Username</label>

                  <div class="col-sm-10">
                    <input name="username" type="text" class="form-control" id="username" placeholder="Username">
                  </div>
                </div>
                <div class="form-group">
                  <label for="penulis" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <input name="password" type="password" class="form-control" id="subjek" placeholder="Password">
                  </div>
                </div>
                <div class="form-group">
                  <label for="level" class="col-sm-2 control-label">Level</label>

                  <div class="col-sm-10">
                    <select name="level" class="form-control">
                      <option>Pilih Level User</option>
                      <option value="dirut">Direktur Utama</option>
                      <option value="bendahara">Bendahara</option>
                      <option value="logistik">Logistik</option>
                    </select>
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-info pull-right">Tambah</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>