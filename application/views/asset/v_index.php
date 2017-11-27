          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Jenis Aset</h3>
            </div>
            <div class="box-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Jenis</th>
                    <th>Banyak</th>
                    <th>Total Nilai Asset</th>
                  </tr>  
                </thead>
                <tbody>
                  <?php foreach($asset as $data){ ?>
                  <tr>
                    <td><a href="<?php base_url();?>asset/open/<?=$data->jenis?>"><?=$data->jenis?></a></td>
                    <?php if($data->jenis == 'Kendaraan'){ ?>
                      <td><?=$kendaraan?></td>
                    <?php }elseif($data->jenis == 'AlatLabMekTan'){ ?>
                      <td><?=$mektan?></td>
                    <?php }elseif($data->jenis == 'AlatSurvey'){ ?>
                      <td><?=$survey?></td>
                    <?php }elseif($data->jenis == 'AlatKantor'){ ?>
                      <td><?=$kantor?></td>
                    <?php } ?>

                    <?php if($data->jenis == 'Kendaraan'){ ?>
                      <td>Rp. <?=$nKendaraan->nilai_buku?></td>
                    <?php }elseif($data->jenis == 'AlatLabMekTan'){ ?>
                      <td>Rp. <?=$nMektan->nilai_buku?></td>
                    <?php }elseif($data->jenis == 'AlatSurvey'){ ?>
                      <td>Rp. <?=$nSurvey->nilai_buku?></td>
                    <?php }elseif($data->jenis == 'AlatKantor'){ ?>
                      <td>Rp. <?=$nKantor->nilai_buku?></td>
                    <?php } ?>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <br>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 38.7%;">Total</th>
                    <th style="width: 21.7%;"><?=$sum?></th>
                    <th style="background-color: pink;">Rp. <?=$jumlah->nilai_buku?></th>
                  </tr>
                </thead>
              </table>

            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
             <?=$paging?>
              
            </div>
          </div>
          <script>
            $(document).ready(function(){
              $('#myTable').DataTable();
            });
          </script>