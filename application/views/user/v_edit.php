<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="nama" class="col-sm-2 control-label">Nama</label>

                  <div class="col-sm-10">
                    <input name="nama" type="text" value="<?=$user->nama ? $user->nama : ''?>" class="form-control" id="nama" placeholder="nama">
                  </div>
                </div>
                <div class="form-group">
                  <label for="email" class="col-sm-2 control-label">Username</label>

                  <div class="col-sm-10">
                    <input name="username" type="text" value="<?=$user->username ? $user->username : ''?>" class="form-control" id="username" placeholder="Your Username">
                  </div>
                </div>
                <div class="form-group">
                  <label for="penulis" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <input name="password" type="password" class="form-control" id="password" placeholder="Type to change password">
                  </div>
                </div>
                <div class="form-group">
                  <label for="level" class="col-sm-2 control-label">Level</label>

                  <div class="col-sm-10">
                    <input name="level" type="text" class="form-control" id="level" placeholder="<?=$user->level?>" value="<?=$user->level?>" readonly>
                  </div>
                </div> 
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-primary pull-right">Update</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>