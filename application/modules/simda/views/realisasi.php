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
						
                        
                        <div class="col-md-12 col-xs-12">
                            
                            <!-- START SALES & EVENTS BLOCK -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title-box">
                                        <h3>Realisasi Simda</h3>
                                        <span>Realisasi Keuangan Periode</span>
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

                                <form class="form-horizontal"  action="javascript:lihat()" class="forms method="get" >

                                    <div class="form-group col-md-12" align="center">
                                        <label  class="control-label col-md-4">Unit</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select name = "unit" id="unit" class="form-control select" data-live-search="true">
                                            <?php foreach( $unit as $unit) {?>
                                                <option value="<?php echo $unit->Kd_Urusan.'.'.$unit->Kd_Bidang.'.'.$unit->Kd_Unit ?>" ><?php echo $unit->Nm_Unit; ?></option>
                                            <?php }?>
                                            </select>
                                        </div>
                                    </div> 

                                    <div class="form-group col-md-12" align="center">
                                        <label  class="control-label col-md-4">Sub Unit</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select name = "subunit" id="subunit" class="form-control select" data-live-search="true">
                                            </select>
                                        </div>
                                    </div> 

                                    <div class="form-group col-md-12" align="center">
                                            <button type="submit" id="tombol" class="btn btn-info" >Lihat Realisasi</button>
                                    </div> 

                                </form>  
                            <div class="col-md-12 col-xs-12" style="padding-top: 12px;">

                                    <table class="table table-striped table-bordered " style="table-layout: fixed; word-break: break-word;" >
                                        <thead>
                                        <tr>
                                            <th width="10%" rowspan="2" class="text-center valign-middle" >Kode</th>
                                            <th width="50%" rowspan="2" class="text-center valign-middle" >Urusan/Bidang Urusan Pemerintahan Daerah Dan Program/Kegiatan</th>
                                            <th width="15%" rowspan="2" class="text-center valign-middle" >Jumlah Anggaran</th>
                                            <th width="15%" rowspan="2" class="text-center valign-middle" >Relisasi</th>
                                            <th width="15%" rowspan="2" class="text-center valign-middle" >% Relisasi</th>
                                            <th width="15%" rowspan="2" class="text-center valign-middle" >Sisa</th>
                                            <!--th width="15%" rowspan="2" class="text-center valign-middle" >Hide</th-->
                                        </tr>   
                                </thead>

                                        <tbody id="realisasi">
                                            
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
$("#tombol").hide();

     $("#unit").change(function(){

$("#tombol").show();
          var skpd = $(this).val();
            console.log(skpd);
        $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          formData = {
            unit: $('#unit').val(),

          }
           console.log(formData);
          var tipe = 'POST';
          var dturl = '<?php echo site_url('simda/subunit');?>';
          $.ajax({
             type: tipe,
             url: dturl,
             data: formData,
             
             success: function(msg){
                 console.log(msg);
                  $("#subunit").html(msg).selectpicker('refresh');  
                  //$('.select').selectpicker('refresh');                                                     
                 
                                                                    
             }
          });                    
      }); 

function lihat(){
    var panel = $(".panel-refresh").parents(".panel");
                    panel_refresh(panel);
    $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          formData = {
            unit: $('#unit').val(),
            sub: $('#subunit').val(),

          }
           console.log(formData);
          var tipe = 'POST';
          var dturl = '<?php echo site_url('simda/lihatdata');?>';
          $.ajax({
             type: tipe,
             url: dturl,
             data: formData,
             
             success: function(msg){
                 //console.log(msg);
                   

                    setTimeout(function(){
                        panel_refresh(panel); 
                    },100);
                    
                  $("#realisasi").html(msg);  
                  //$('.select').selectpicker('refresh');  

                
                                                                    
                 
                                                                    
             }
          });             

}

</script>

<?php $this->load->view('template\foot.php'); ?> 
<?php $this->load->view('template\script.php'); ?>
