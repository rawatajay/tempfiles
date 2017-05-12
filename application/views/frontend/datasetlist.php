<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 col-lg-push-3 ">
              
                <div class="container-fluid"> 
                    
                      <section class="box-typical ">
                         <div class="box-typical-header card-block ">  
                              
                                
                                  <form id="searchform"  method="POST" action="">
                                      
                                      <fieldset class=" col-md-4">
				          <div class="frmSearch">
                                              <lable> </lable>
                                              <input type="text" id="search-box" class="form-control" placeholder="City Name" autocomplete="false" />
                                            <div id="suggesstion-box"></div>
                                           </div>
											
					</fieldset>
                    	            <div  class="form-group col-md-4">
						

						<select name="funID" class="form-control"  id="funID"  data-validation-message="Select atleast 1 option">
							   <option value="">-- Select Option --</option>							  
							<?php if($funtionalArealist){ foreach($funtionalArealist as $fv){?>
								<option <?php if($companyDetail->companyFunctionalId ==  $fv['functionalID']) echo "selected"?> value="<?php echo $fv['functionalID']?>"><?php echo ucwords($fv['functionalName'])?></option>
							<?php }}?>							
						</select>
									
					</div>
					
                       <fieldset class="form-group col-md-4">                
                        <button type="button" onclick="searchdataset()"  class="btn pull-right  btn-info btn-success">Search</button>
                       </fieldset>
                                      <input type="hidden" name="cityID" id="cityID" value=""/>            
                    </form>
                                 </div>             
                            
                           
                    </section>
                    <section class="box-typical">
                        <header class="box-typical-header profile_header">
                            <div class="tbl-row">
                                <div class="tbl-cell tbl-cell-title">
                                    <h3><?php echo $page_name; ?></h3>
                                </div>
                            </div>
                        </header>
                    </section>  
                         
                              
                  
                    <div class="row card-user-grid serch-data">
                        	

                        <?php
                        if (!empty($datasetlist)) {
                            foreach ($datasetlist as $data){
                                ?>  
                                    <div class="col-sm-6 col-md-4 col-xl-3">
                                    
                                  
                                    <article class="card-user box-typical  " style="height: 240px;">
                                          <div class="card-user-status">
                                            <?php
                                            echo $data['stateName'];
                                            echo '<br/>';
                                            $cities = $this->common->_getCityName($data['city']);
                                            echo rtrim($cities, ', ');
                                            ?>
                                        </div>
                                            
                                        <div class="card-user-photo">
                                            <a href="<?php echo base_url()  ?>user/dataset/detail/<?php echo $data['datasetId']; ?>">  
                                                <img src="<?php echo base_url() ?>assets/admin/img/townhouse.jpg" alt=""> </a>
                                        </div>
                                        <div class="card-user-name"><?php echo $data['title']; ?></div>
                                         <div class="card-user-name">Company :  <?php echo $data['comp_count']; ?></div>
                                       
                                         <div class="card-user-name"> <i class="fa fa-rupee"></i> <?php  echo ($data['price'])?$data['price']:'0 ' ; ?></div>
                                      <a href="<?php echo base_url()  ?>user/dataset/detail/<?php echo $data['datasetId']; ?>" class="btn btn-rounded">Apply</a>
                                         
                                    </article><!--.card-user--> 
                                </div>    
                           <?php }
                            } else {
                                ?> 

                              <section class="box-typical">
                                <div class="add-customers-screen tbl" style="height: 240px;">
                                    <div class="add-customers-screen-in">
                                        <div class="add-customers-screen-user">
                                            <i class="font-icon font-icon-user"></i>
                                        </div>
                                        <h2>Your <?php echo $page_name; ?>  is empty</h2>						
                                    </div>
                                </div>
                             </section>
                        <?php } ?>
                    </div><!--.card-user-grid-->

                </div>



            </div>      
     
            
          <?php  include_once("common/jobseekerSidebar.php") ?>

        </div>
    </div><!--.container-fluid-->
</div><!--.page-content-->





