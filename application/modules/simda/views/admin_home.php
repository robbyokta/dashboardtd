<?php $this->load->view('template\head.php'); ?>
<?php $this->load->view('template\datatablescriptcss.php'); ?> 
<?php $this->load->view('template\sidebar.php'); ?> 
<?php $this->load->view('template\header.php'); ?>  
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> <?php echo $title; ?></h3>
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
                    <h2>Grafik Realisasi & Target <small></small></h2>
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
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
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
                    <div class="col-md-10 col-sm-offset-1">
                      <canvas id="grafikrealisasi" width="3px" height="1"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
            <div class="col-md-12 col-sm-6 col-xs-12">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Jumlah Laporan Per-SKPD <small></small></h2>
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
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="form-group col-md-10 col-sm-offset-2" >
                            <label class="control-label col-md-2 col-sm-3 col-xs-12"  for="first-name">Bulan <span class="required"></span></label>
                              <div class="col-md-6 col-sm-4 col-xs-12">
                                <select type="text" id="bulan" name='bulan'   class="chosen-select col-md-7 col-xs-12"  >
                                  <option value=''> Pilih Bulan </option>
                                  <option value='1'> Januari </option>
                                  <option value='2'> Februari </option>
                                  <option value='3'> Maret </option>
                                  <option value='4'> April </option>
                                  <option value='5'> Mei </option>
                                  <option value='6'> Juni </option>
                                  <option value='7'> Juli </option>
                                  <option value='8'> Agustus </option>
                                  <option value='9'> September </option>
                                  <option value='10'> Oktober </option>
                                  <option value='11'> November </option>
                                  <option value='12'> Desember </option>
                                </select>
                              </div>
                    </div>
                  <br>
                  <table width="100%"  cellspacing="0" class ="data" id="records">
                    <thead>
                      <tr>
                        <th width= "2%"> No </th>
                        <th width= "50%"> SKPD </th>
                        <th> Jumlah Kegiatan</th>
                        <th> Jumlah Input </th>
                      </tr>
                    </thead>
                    
                    <tbody>
                    </tbody>
                  </table>      
                    
                  </div>  
                  </div>

                  </div>
               
             
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Bar graph <small></small></h2>
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
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="form-group col-md-10 col-sm-offset-2" >
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


          $(".chosen-select").chosen({
          width: "100%"
          });

        var table = $('#records').DataTable( {
            "scrollY":        "200px",
            "scrollCollapse": false,
            "paging":         false,
            "searching":     false,
             "columnDefs": [
                 { "targets": [ 0,2,3 ], "className" : "text-center"},
                ]
            
        } );
        counter = 1;
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
          var dturl = '<?php echo site_url('skpd/inputskpd');?>';
         
          $.ajax({
            type: tipe,
            url: dturl ,
            data: formData,
            dataType: 'json',
            success: function (data) {
              //$('#inputskpd').html(data);
              table.clear();
              i = 1;
              for (val of data){
                table.row.add( [
                i ,
                val.nama_skpd,
                val.jml_kegiatan,
                val.inputan,
                ],  ).draw( false );
                i++;
              }
           

           


           
             
              
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
                  backgroundColor: "#3e95cd",
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

                responsive: true,
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
        scaleLabel: {
                            display: true,
                            labelString: 'BULAN'
                        },
      }],
      yAxes: [{
        scaleLabel: {
                            display: true,
                            labelString: 'PESENTASE'
                        },
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
