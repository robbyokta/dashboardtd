<?php $this->load->view('template\head.php'); ?>
<?php $this->load->view('template\sidebar.php'); ?> 
<?php $this->load->view('template\header.php'); ?>  
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> <?php echo $title; ?> </h3>
              </div>

              <div class="title_right">
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Penilaian KPA & PPTK<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <div class="form-group col-md-6 col-sm-offset-4" >
                          <label class="control-label col-md-2 col-sm-3 col-xs-12"  for="first-name">Bulan <span class="required"></span></label>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                              <select type="text" id="bulan" name='bulan'   class="form-control col-md-7 col-xs-12">
                                <option value=''> Pilih Bulan </option>
                                <option value='Januari'> Januari </option>
                                <option value='Februari'> Februari </option>
                                <option value='Maret'> Maret </option>
                                <option value='April'> April </option>
                                <option value='Mei'> Mei </option>
                                <option value='Juni'> Juni </option>
                                <option value='Juli'> Juli </option>
                                <option value='Agustus'> Agustus </option>
                                <option value='September'> September </option>
                                <option value='Oktober'> Oktober </option>
                                <option value='November'> November </option>
                                <option value='Desember'> Desember </option>
                              </select>
                            </div>
                      </div>
                  <br>
                  <table width="100%" class ="records" id="records">
                  <thead>
                    <tr>
                          <th rowspan="3">No</th>

                          <th rowspan="3">KPA / PPTK</th>

                          <th rowspan="3" width="3%">Jumlah Kegiatan</th>

                          <th rowspan="2" colspan="4">Anggaran</th>

                          <th rowspan="2" colspan="2" width = "6%">Target</th>

                          <th colspan="6">Realisasi</th>

                          <th rowspan="2" colspan="2" width = "8%">Deviasi</th>



                      </tr>

                      <tr>
                          <th colspan="5">Keuangan</th>
                          <th rowspan="2">Fisik (%)</th>

                      </tr>

                      <tr>

                          <th>Pegawai</th>

                          <th>Barang/Jasa</th>

                          <th>Modal</th>

                          <th>Jumlah</th>

                          <th>Keu (%)</th>

                          <th>Fisik (%)</th>

                          <th>Pegawai</th>

                          <th>Barang/Jasa</th>

                          <th>Modal</th>

                          <th>Jumlah</th>

                          <th>Keu (%)</th>

                          <th>Keu ( % )</th>

                          <th>Fisik (%)</th>

                      </tr>
                  </thead>
                  <tbody id="kpapptk">
                  </tbody>
                  </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              

              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Grafik Realisasi Target & Realisasi Per-Bulan</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                    <?php foreach ($realisasi as $realisasi) {
                      $tg_fisik[] = round($realisasi->tg_fisik,2);
                      $bulan[] = $realisasi->bulan;
                      $tg_keu[] = round($realisasi->tg_keu,2);
                      $rl_fisik[] = round($realisasi->rl_fisik,2);
                      $rl_keu[] = round($realisasi->rl_keu,2);
                    }?>
                  </div>
                  <div class="x_content">
                    <canvas id="grafikrealisasi"></canvas>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Realisasi Fisik & Keuangan Per Program </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="form-group col-md-10 col-sm-offset-2" >
                            <label class="control-label col-md-4 col-sm-3 col-xs-12"  for="first-name">Bulan <span class="required"></span></label>
                              <div class="col-md-8 col-sm-4 col-xs-12">
                                <select type="text" id="bulan3" name='bulan3'   class="form-control col-md-7 col-xs-12">
                                  <option value=''> Pilih Bulan </option>
                                  <option value='Januari'> Januari </option>
                                  <option value='Februari'> Februari </option>
                                  <option value='Maret'> Maret </option>
                                  <option value='April'> April </option>
                                  <option value='Mei'> Mei </option>
                                  <option value='Juni'> Juni </option>
                                  <option value='Juli'> Juli </option>
                                  <option value='Agustus'> Agustus </option>
                                  <option value='September'> September </option>
                                  <option value='Oktober'> Oktober </option>
                                  <option value='November'> November </option>
                                  <option value='Desember'> Desember </option>
                                </select>
                              </div>
                    </div>
                    <div id="realisasi">
                    
                    </div>               
                    
                  </div>  
                  </div>

                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>

        <?php $this->load->view('template\datatablescript.php'); ?> 
        <script>
        $('#bulan').on('change', function(){
          $('#kpapptk').append('');
          console.log($(this).val());
          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          formData = {
              bulan :$(this).val(),
            }
          console.log(formData);
          state = $('#tombol').val(); 
          var tipe = 'POST';
          var dturl = '<?php echo site_url('skpd/datakpapptk');?>';
         
          $.ajax({
            type: tipe,
            url: dturl ,
            data: formData,
            dataType: 'json',
            success: function (data) {
              $('#kpapptk').html(data);

             
              
            },
            
          })
        })

         $('#bulan2').on('change', function(){
          
          console.log($(this).val());
          var aa= $(this).val();
          
          
        })


         $('#bulan3').on('change', function(){
          
          console.log($(this).val());
          var bulan= $(this).val();
          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          formData = {
              bulan :$(this).val(),
            }
          console.log(formData);
          state = $('#tombol').val(); 
          var tipe = 'POST';
          var dturl = '<?php echo site_url('skpd/realisasiskpd');?>';
         
          $.ajax({
            type: tipe,
            url: dturl ,
            data: formData,
            dataType: 'json',
            success: function (data) {
              $('#realisasi').html(data);

             
              
            },
            
          })
          
          
        })

         new Chart(document.getElementById("grafikrealisasi"), {
            type: 'line',
            data: {
              labels: <?php echo json_encode($bulan);?>,
              datasets: [{ 
                  data: <?php echo json_encode($tg_keu);?>,
                  label: "Target Keuangan",
                  borderColor: "#3e95cd",
                  fill: false
                }, { 
                  data: <?php echo json_encode($tg_fisik);?>,
                  label: "Target Fisik",
                  borderColor: "#8e5ea2",
                  fill: false
                }, { 
                  data: <?php echo json_encode($rl_keu);?>,
                  label: "Realisasi Keuanagn",
                  borderColor: "#3cba9f",
                  fill: false
                }, { 
                  data: <?php echo json_encode($rl_fisik);?>,
                  label: "Realisasi Fisik",
                  borderColor: "#e8c3b9",
                  fill: false
                }, 
              ]
            },
            options: {
              title: {
                display: true,
                text: 'Grafik Target Dan Realisasi SKPD'
              },

              
    scales: {
      xAxes: [{
        time: {
          displayFormats: {
            quarter: ' YYYY'
          }
        },
        barPercentage: 0.1,
        gridLines: {
          display: true
        },
      }],
      yAxes: [{
        
        gridLines: {
          display: true
        },
      }, {
        ticks: {
          display: false,
          max: 100,
          min: 00,
          stepSize: 50,
          callback: function(value, index, values) {
            if (value === 0) {
              return value;
            } else {
              return null;
            }
          },
        },
        gridLines: {
          display: true
        },
      }]
    },


            }
          });
          
        </script>

        <!-- page content -->
<?php $this->load->view('template\footer.php'); ?> 
<?php $this->load->view('template\script.php'); ?>
