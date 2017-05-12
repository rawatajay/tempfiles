<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 col-lg-push-3 ">

                            <div class="container-fluid"> 
                                
                                  <div class="row">
                                                                      
                      
                                      
                                 <div class="col-md-12 ">  
        
                                   <section class="">
                                       
                                       <?php if(empty($company_data) || !empty($this->session->flashdata('msg'))){   ?>
                                         <div id="message"><?php echo $this->session->flashdata('msg'); ?></div> 
                                            <div class="text-block text-block-typical sendApplybtn">
                                           
                                          
                                                <a href="<?php echo base_url()  ?>user/datasetList" > <span class="col-lg-2 col-lg-push-10  btn btn-rounded btn-inline btn-success pull-right"><i class="fa fa-mail-reply" aria-hidden="true"></i> Go back  </span></a>
                                             
                                         </div>
                                         
                                       <?php }else{ ?>
                                          <div class="text-block text-block-typical sendApplybtn">
                                            
<!--                                           <a href="#">   <span class="btn btn-rounded col-lg-2 col-lg-push-5 btn-info btn-file">
                                            <span>Step One</span>
                                               </span></a>-->
                                            <a href="<?php echo base_url()  ?>user/dataset/mail/<?php echo $dataset_data->datasetId; ?>">   <span class="btn btn-rounded col-lg-2 col-lg-push-5 btn-info btn-file">
                                            <span>Apply</span>
                                               </span></a>
                                              <a href="<?php echo base_url()  ?>user/datasetList" > <span class="col-lg-2 col-lg-push-8 btn btn-rounded btn-inline btn-success"><i class="fa fa-mail-reply" aria-hidden="true"></i> Go back </span></a>
                                           
                                         </div>
                                       <?php } ?> 
                                         
                                  </section>
                                     
                                    
                                     
                                      
                                   
                                 </div> 
                           
                          
                              
                                    
                                <div class="col-md-12 "> 
                                    
                                 	
                                   
                                    <section class="box-typical steps-numeric-block">
                                        
                                        <header class="box-typical-header profile_header">
					  <div class="tbl-row">
						<div class="tbl-cell tbl-cell-title">
						<h3>Dataset Detail</h3>
						</div>
					   </div>
				         </header>
                                        
                                        
                                 	<div class="steps-numeric-header">
                                            <div class="steps-numeric-header-in">
                                            <ul>
                                                  <li class="active"><div class="item"><span class="num">1</span>View Dataset</div></li>
                                                <li ><div class="item"><span class="num">2</span>Create Mail</div></li>
                                                <li><div class="item"><span class="num">3</span>Preview Mail</div></li>
                                               
                                            </ul>
                                            </div>
				     </div>   
                                        
                                        <article class="">

                                            <div class="text-block text-block-typical">
                                                <!--						<div class="col-xl-12">-->
                                                <div class="row ">
                                                    <div class="col-md-12">
                                                      
                                                           <table id="table-edit" class="table table-bordered table-hover">
			                        	
                                                        <tbody>
                                                         <tr id="1">

                                                                 <th > Title </th>
                                                                 <td class="color-blue-grey-lighter "> <?php echo $dataset_data->title; ?></td>
                                                                 
                                                         </tr>
                                                         <tr id="1">

                                                                 <th >Description  </th>
                                                                 <td class="color-blue-grey-lighter "><?php echo $dataset_data->description; ?></td>
 

                                                                 </tr>
                                                                 <tr id="1">

                                                                 <th >Price</th>
                                                                 <td class="color-blue-grey-lighter "> <?php echo $dataset_data->price; ?></td>
 
                                                                 </tr>
                                                                 <tr id="1">
                                                                   <th >Discount</th>
                                                                 <td class="color-blue-grey-lighter "> <?php echo $dataset_data->discount; ?></td>
 
                                                                 </tr>
                                                                 <tr id="1">
                                                                   <th >City</th>
                                                                 <td class="color-blue-grey-lighter "> <?php echo rtrim($dataset_city, ', '); ?></td>
 
                                                                 </tr>
                                                                 <tr id="1">
                                                                   <th >Employee Range</th>
                                                                 <td class="color-blue-grey-lighter "> <?php echo rtrim($dataset_emprange, ', '); ?></td>
 
                                                                 </tr>
                                                                 
                                                     
                                                        </tbody>
                                                   </table>     
                                                       
                                                     
                                                    </div>					
                                                </div><!--.row-->
                                                <!--	            				                 </div>-->
                                            </div>
                                        </article><!--.profile-info-item-->
                                        
                                    </section><!--.box-typical-->
                               </div>   
                                    
                               <div class="col-md-12 ">  
                                    <section class="box-typical">
                                        <header class="box-typical-header profile_header">
					  <div class="tbl-row">
						<div class="tbl-cell tbl-cell-title">
						<h3>Company Detail</h3>
						</div>
					   </div>
				         </header>
                                        <article class="">

                                               <div class="text-block text-block-typical">
                                                <!--						<div class="col-xl-12">-->
                                                <div class="row ">
                                                    <div class="col-md-12">
                                                        
                                                        <?php   if (!empty($company_data)) { ?>
                                                      
                                                           <table id="table-edit" class="table table-bordered table-hover">
			                        	
                                                         <thead>
                                                          <tr id="1">

                                                              <th > Company Name  </th><th>Company Website</th>  <th >Founded Years</th>
<!--                                                                 <th >Contact</th>-->
                                                         </tr>
                                                         </thead>
                                                        <tbody>
                                                            <?php foreach ($company_data as $cValue){     ?>   
                                                           <tr id="1">
 
                                                               <td class="color-blue-grey-lighter "> <a href="<?php echo $cValue['website']; ?>"target="_blank" ><?php echo $cValue['companyName'];  ?></a></td>
                                                                <td class="color-blue-grey-lighter "> <a href="<?php echo $cValue['website']; ?>"target="_blank" ><?php echo $cValue['website'];  ?></a></td>
                                                                
                                                                <td class="color-blue-grey-lighter "><?php echo $cValue['foundedYear']; ?></td>
                                                             
                                                                 </tr>
                                                            <?php } ?>        
                                                        </tbody>
                                                   </table>     
                                                       
                                                 <?php      } else {     ?>
                             

                                                            <section class="box-typical">
                                                              <div class="add-customers-screen tbl" style="height: 240px;">
                                                                  <div class="add-customers-screen-in">
                                                                      <div class="add-customers-screen-user">
                                                                          <i class="font-icon font-icon-user"></i>
                                                                      </div>
                                                                      <h2>Your Company list is empty</h2>						
                                                                  </div>
                                                              </div>
                                                           </section>
                                                            <?php } ?>
                                                    </div>					
                                                </div><!--.row-->
                                                <!--	            				                 </div>-->
                                            </div>
                                        </article><!--.profile-info-item-->
                                        
                                    </section><!--.box-typical-->
                               </div>
                             </div>
                            </div>


                         </div>     
                           
            
<?php  include_once("common/jobseekerSidebar.php") ?>
<?php // include_once("common/jobseekerLeftSidebar.php")  ?>


        </div>
    </div><!--.container-fluid-->
</div><!--.page-content-->





