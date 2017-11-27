        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Detail Asset</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table">
              <tbody>
                <tr>
                  <th>Nama</th>
                  <td><?=$asset->nama?></td>
                </tr>
                <tr>
                  <th>Jenis</th>
                  <td><?=$asset->jenis?></td>
                </tr>
                <tr>
                  <th>Tanggal Pengadaan</th>
                  <td><?=$asset->tanggal_pengadaan?></td>
                </tr>
                <tr>
                  <th>Banyaknya</th>
                  <td><?=$asset->quantity?> Unit</td>
                </tr>
                <tr>
                  <th>Kelompok</th>
                  <td><?=$kelompok->kelompok?></td>
                </tr>
                <tr>
                  <th>Masa Manfaat</th>
                  <td><?=$kelompok->masa_manfaat?> Tahun</td>
                </tr>
                <tr>
                  <th>Nilai Akuisisi</th>
                  <td>Rp. <?=$asset->nilai?></td>
                </tr>
                <tr>
                  <th>Spesifikasi</th>
                  <td><?=$asset->spesifikasi?></td>
                </tr>
                <tr>
                  <th>Merk</th>
                  <td><?=$asset->merek?></td>
                </tr>
                <tr>
                  <th>Type</th>
                  <td><?=$asset->type?></td>
                </tr>
                <tr>
                  <th>Spesifikasi</th>
                  <td><?=$asset->spesifikasi?></td>
                </tr>
                <tr>
                  <th>Nomor Serial</th>
                  <td><?=$asset->serial_number?></td>
                </tr>
                <tr>
                  <th>Waranty Expired</th>
                  <td><?=$asset->waranty_expired?></td>
                </tr>
            </tbody></table><br>

            <div class="box-header with-border">
              <h3 class="box-title">Tambah detail</h3>
            </div>
            <form class="form-horizontal" method="post" action="<?= site_url('perawatan/addedDetail/'.$asset->id)?>">
              <table class="table">
                <tr>
                  <th>Jenis Perawatan</th>
                  <td><!-- <input type="text" name="jenis_rawat" placeholder="Jenis Perawatan"> -->
                    <select name="jenis_rawat" id="jenis_rawat" class="form-control">
                      <option>Pilih jenis perawatan</option>
                      <option value="berat">Berat</option>
                      <option value="ringan">Ringan</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <th>Nilai Satuan</th>
                  <td><input type="text" name="biaya_rawat" placeholder="Nilai Perawatan (diisi jika jenis adalah Berat)" class="form-control"></td>
                </tr>
              </table><br>
              <button type="submit" class="btn btn-success pull-right">OK</button>
            </form>
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