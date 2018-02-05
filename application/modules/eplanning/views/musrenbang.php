<?php $this->load->view('template\head.php'); ?>
<?php $this->load->view('template\sidebar.php'); ?> 
<?php $this->load->view('template\header.php'); ?>  
         <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>                    
                    <li class="active">Dashboard</li>
                </ul>
                <!-- END BREADCRUMB -->                       
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    
                    <!-- START WIDGETS -->                    
                    
                    <!-- END WIDGETS -->                    
                    
                    
                    <div class="row">
						
                        
                        <div class="col-md-6 col-xs-6">
                            
                            <!-- START SALES & EVENTS BLOCK -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title-box">
                                        <h3>Musrenbang Nagari</h3>
                                        <span>Jumlah Usulan dan Pagu</span>
                                    </div>
                                    <ul class="panel-controls" style="margin-top: 2px;">
                                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                                            <ul class="dropdown-menu">
                                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                                            </ul>                                        
                                        </li>                                        
                                    </ul>
                                </div>
                                <div class="panel-body padding-2" align="center">
                                    <div  style="height: 0px;"></div>

                              
                            <div class="col-md-12 col-xs-12" style="padding-top: 12px;">

                                    <table class="table table-striped table-bordered " style="table-layout: fixed; word-break: break-word;" >
                                        <thead>
                                        <tr>
                                            <th width="8%" rowspan="2" class="text-center valign-middle" >No</th>
                                            <th width="30%" rowspan="2" class="text-center valign-middle" >Nagari</th>
                                            <th width="15%" rowspan="2" class="text-center valign-middle" >Usulan</th>
                                            <th width="30%" rowspan="2" class="text-center valign-middle" >Pagu</th>
                                            <th width="10%" rowspan="2" class="text-center valign-middle" >Detail</th>
                                            <!--th width="15%" rowspan="2" class="text-center valign-middle" >Hide</th-->
                                        </tr>   
                                </thead>
                                <tbody id="realisasi">
                                <?php $no = 1;foreach ($nagari as $key => $data) {
                                  # code...
                                  echo '<tr>';
                                  echo '<td align="center">'.$no++.'</td>';
                                  echo '<td>'.$data->refkecamatan_nama.'</td>';
                                  echo '<td align="center">'.$data->jumlah.'</td>';
                                  echo '<td align="right">'.$data->pagu.'</td>';
                                  echo '<td align="center"> <button id= "val_'.$data->refkecamatan_id.'" value= "0" onclick="detail('.number_format($data->refkecamatan_id,2).')"> <i class="glyphicon glyphicon-record"></i></button></td>
                                  </tr>';
                                  echo '<tr class="rownagari" id= "kec_'.$data->refkecamatan_id.'"><td colspan="5"><table class="table table-striped table-bordered" width="100%"  id= "'.$data->refkecamatan_id.'" ></table>';
                                } ?>
                                            
                                 </tbody>
                                    </table> 
                            </div>                            
                                </div>
                            </div>
                            <!-- END SALES & EVENTS BLOCK -->
                            
                        </div>

                    </div>
                    
                    
                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

<?php $this->load->view('template\addscript.php'); ?>
<script type="text/javascript">


$('.rownagari').hide();

function detail(id){
  v= $('#val_'+id).val();
  var panel = $(".panel-refresh").parents(".panel");
                    panel_refresh(panel);
if (v=='0'){
  $('.rownagari').hide();
  console.log(id);
          $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          formData = {
            }
          console.log(formData);
         
              tipe = 'POST';
             dturl = '<?php echo site_url('eplanning/datamusrenbang');?>/'+id;
        
          $.ajax({
            type: tipe,
            url: dturl ,
            data: formData,
            dataType: 'json',
            success: function (data) {

                console.log(data);
                $('#val_'+id).val('1');

            $('.rownagari#kec_'+id).show();

              i = 1;
              r = '';
              for (data of data) {
                console.log(data);
                r += '<tr><td width="10%" align="center">'+id+'.'+i+'</td><td width="40%" >'+data.refkelurahan_nama+'</td><td width="20%" align="center" >'+data.jumlah+'</td><td width="20%" align="right" >'+data.pagu+'</td></tr>'
                $("#"+id).html(r);
                i++;
              };
               setTimeout(function(){
                        panel_refresh(panel); 
                    },100);
            },
            error: function (data) {
              console.log(data);
            }
          })
  } else { $('.rownagari').hide(); 
            $('#val_'+id).val('0');
           setTimeout(function(){
                        panel_refresh(panel); 
                    },100);}
}

</script>

<?php $this->load->view('template\foot.php'); ?> 
<?php $this->load->view('template\script.php'); ?>
