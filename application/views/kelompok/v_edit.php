<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Kelompok</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="" method="post">
            <<input type="hidden" value="<?=$kelompok->id?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="kelompok" class="col-sm-2 control-label">Kelompok</label>

                  <div class="col-sm-10">
                    <input name="kelompok" type="text" value="<?=isset($kelompok->kelompok) ? $kelompok->kelompok : '' ?>" class="form-control" id="kelompok" placeholder="Kelompok">
                  </div>
                </div>
                <div class="form-group">
                  <label for="masa_manfaat" class="col-sm-2 control-label">Masa Manfaat</label>

                  <div class="col-sm-10">
                    <input name="masa_manfaat" type="text" value="<?=isset($kelompok->masa_manfaat) ? $kelompok->masa_manfaat : '' ?>" class="form-control" id="masa_manfaat" placeholder="Masa Manfaat">
                  </div>
                </div>
                <div class="form-group">
                  <label for="tarif_penyusutan" class="col-sm-2 control-label">Tarif Penyusutan</label>

                  <div class="col-sm-10">
                    <input name="tarif_penyusutan" type="text" value="<?=isset($kelompok->tarif_penyusutan) ? $kelompok->tarif_penyusutan : '' ?>" class="form-control" id="tarif_penyusutan" placeholder="Tarif Penyusutan">
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