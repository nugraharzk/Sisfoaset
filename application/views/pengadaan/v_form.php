<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Pengadaan</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post">
              <div class="box-body">
                <div class="form-group">
                  <label for="kelompok" class="col-sm-2 control-label">Kelompok</label>

                  <div class="col-sm-10">
                  <select name="id_kelompok" id="kelompok_id" class="form-control">
                        <option>Pilih Kelompok Aset</option>
                        <?php foreach($kelompok as $data):;?>
                        <option value="<?=$data->id;?>"><?=$data->kelompok;?></option>
                        <?php endforeach;?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="nama" class="col-sm-2 control-label">Nama</label>

                  <div class="col-sm-10">
                    <input name="nama" type="text" class="form-control" id="nama" placeholder="Nama">
                  </div>
                </div>
                <div class="form-group">
                  <label for="jenis" class="col-sm-2 control-label">Jenis</label>

                  <div class="col-sm-10">
                    <!-- <input name="jenis" type="text" class="form-control" id="jenis" placeholder="Jenis"> -->
                    <select name="jenis" id="jenis" class="form-control">
                      <option>Pilih Jenis Asset</option>
                      <option value="Kendaraan">Kendaraan</option>
                      <option value="AlatLabMekTan">Alat Lab MekTan</option>
                      <option value="AlatSurvey">Alat Survey</option>
                      <option value="AlatKantor">Alat Kantor</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="tanggal_pengadaan" class="col-sm-2 control-label">Tanggal Pengadaan</label>

                  <div class="col-sm-10">
                    <input name="tanggal_pengadaan" type="date" class="form-control" id="tanggal_pengadaan" placeholder="Tanggal Pengadaan">
                  </div>
                </div>
                <div class="form-group">
                  <label for="quantity" class="col-sm-2 control-label">Banyaknya</label>

                  <div class="col-sm-10">
                    <input name="quantity" type="text" class="form-control" id="quantity" placeholder="Banyaknya">
                  </div>
                </div>
                <div class="form-group">
                  <label for="nilai_akuisisi" class="col-sm-2 control-label">Nilai Akuisisi</label>

                  <div class="col-sm-10">
                    <input name="nilai_akuisisi" type="text" class="form-control" id="nilai_akuisisi" placeholder="Nilai Akuisisi">
                  </div>
                </div>
                <div class="form-group">
                  <label for="merek" class="col-sm-2 control-label">Merek</label>

                  <div class="col-sm-10">
                    <input name="merek" type="text" class="form-control" id="merek" placeholder="Merek">
                  </div>
                </div>
                <div class="form-group">
                  <label for="type" class="col-sm-2 control-label">Type</label>

                  <div class="col-sm-10">
                    <input name="type" type="text" class="form-control" id="type" placeholder="Type">
                  </div>
                </div>
                <div class="form-group">
                  <label for="spesifikasi" class="col-sm-2 control-label">Spesifikasi</label>

                  <div class="col-sm-10">
                    <input name="spesifikasi" type="text" class="form-control" id="spesifikasi" placeholder="Spesifikasi">
                  </div>
                </div>
                <div class="form-group">
                  <label for="serial_number" class="col-sm-2 control-label">Serial Number</label>

                  <div class="col-sm-10">
                    <input name="serial_number" type="text" class="form-control" id="serial_number" placeholder="Serial Number">
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