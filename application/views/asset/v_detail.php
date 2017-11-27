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
                  <th>Waranty Expired</th>
                  <td><?=$asset->waranty_expired?></td>
                </tr>
                <tr>
                  <th>Jenis Perawatan</th>
                  <?php if($perawatan != NULL){ ?>
                  <td><?=$perawatan->jenis_rawat?></td>
                  <?php }else{ ?>
                  <td>-</td>
                  <?php } ?>
                </tr>
                <tr>
                  <th>Biaya Perawatan</th>
                  <?php if($perawatan != NULL){ ?>
                  <?php $biaya = $asset->quantity * $perawatan->biaya_rawat; ?>
                  <td>Rp. <?=$biaya?></td>
                  <?php }else{ ?>
                  <td>-</td>
                  <?php } ?>
                </tr>
                <tr>
                  <th>Nilai Buku</th>
                  <?php if($perawatan != NULL){ ?>
                  <?php $a = $asset->nilai - $biaya; ?>
                  <td><b>Rp. <?=$nilai_buku?></b></td>
                  <?php }else{ ?>
                  <td><b>Rp. <?=$nilai_buku?></b></td>
                  <?php } ?>
                </tr>
              
             
            </tbody></table><br>
            <div class="col-md-2 col-md-push-5">
              <?=anchor('asset', 'Kembali', [
                'class' => 'btn btn-primary',
                'role'  => 'button'
              ])?>
            </div>
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