<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Asset</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post">
              <input type="hidden" value="<?=$asset->id?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="kelompok" class="col-sm-2 control-label">Kelompok</label>

                  <div class="col-sm-10">
                  <select name="id_kelompok" id="kelompok_id" class="form-control">
                        <option>Pilih Kelompok Aset</option>
                        <?php foreach($kelompok as $data):;?>
                        <option <?=$data->id == $asset->id_kelompok ? 'selected' : ''?> value="<?=$data->id;?>"><?=$data->kelompok;?></option>
                        <?php endforeach;?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="jenis" class="col-sm-2 control-label">Jenis</label>

                  <div class="col-sm-10">
                    <input name="jenis" type="text" value="<?=isset($asset->jenis) ? $asset->jenis : ''?>" class="form-control" id="jenis" placeholder="Jenis">
                  </div>
                </div>
                <div class="form-group">
                  <label for="tanggal_pengadaan" class="col-sm-2 control-label">Tanggal Pengadaan</label>

                  <div class="col-sm-10">
                    <input name="tanggal_pengadaan" type="date"value="<?=isset($asset->tanggal_pengadaan) ? $asset->tanggal_pengadaan : ''?>"  class="form-control" id="tanggal_pengadaan" placeholder="Tanggal Pengadaan">
                  </div>
                </div>
                <div class="form-group">
                  <label for="nilai_akuisisi" class="col-sm-2 control-label">Nilai Akuisisi</label>

                  <div class="col-sm-10">
                    <input name="nilai_akuisisi" type="text" value="<?=isset($asset->nilai_akuisisi) ? $asset->nilai_akuisisi : ''?>" class="form-control" id="nilai_akuisisi" placeholder="NIlai Akuisisi">
                  </div>
                </div>
                <div class="form-group">
                  <label for="nik" class="col-sm-2 control-label">NIK</label>

                  <div class="col-sm-10">
                    <input name="nik" type="text" value="<?=isset($asset->nik) ? $asset->nik : ''?>" class="form-control" id="nik" placeholder="NIK">
                  </div>
                </div>
                <div class="form-group">
                  <label for="merek" class="col-sm-2 control-label">Merek</label>

                  <div class="col-sm-10">
                    <input name="merek" type="text" value="<?=isset($asset->merek) ? $asset->merek : ''?>" class="form-control" id="merek" placeholder="Merek">
                  </div>
                </div>
                <div class="form-group">
                  <label for="type" class="col-sm-2 control-label">Type</label>

                  <div class="col-sm-10">
                    <input name="type" type="text" value="<?=isset($asset->type) ? $asset->type : ''?>" class="form-control" id="type" placeholder="Type">
                  </div>
                </div>
                <div class="form-group">
                  <label for="spesifikasi" class="col-sm-2 control-label">Spesifikasi</label>

                  <div class="col-sm-10">
                    <input name="spesifikasi" type="text" value="<?=isset($asset->spesifikasi) ? $asset->spesifikasi : ''?>" class="form-control" id="spesifikasi" placeholder="Spesifikasi">
                  </div>
                </div>
                <div class="form-group">
                  <label for="serial_number" class="col-sm-2 control-label">Serial Number</label>

                  <div class="col-sm-10">
                    <input name="serial_number" type="text" value="<?=isset($asset->serial_number) ? $asset->serial_number : ''?>" class="form-control" id="serial_number" placeholder="Serial Number">
                  </div>
                </div>
                <div class="form-group">
                  <label for="waranty_expired" class="col-sm-2 control-label">Waranty Expired</label>

                  <div class="col-sm-10">
                    <input name="waranty_expired" type="date" value="<?=isset($asset->waranty_expired) ? $asset->waranty_expired : ''?>" class="form-control" id="waranty_expired" placeholder="Waranty Expired">
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                
                <button type="submit" class="btn btn-info pull-right">Edit</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>