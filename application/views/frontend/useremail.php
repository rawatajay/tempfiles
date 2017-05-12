<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-9 col-lg-push-3 ">

                            <div class="container-fluid"> 
                                
                            <div class="row">
                       
                                    
                                  <div class="col-md-12 "> 
                                    <div class="text-block text-block-typical sendApplybtn">


                                             <a href="<?php echo base_url()  ?>user/userDatasetlistData" > <span class="col-lg-2 col-lg-push-10  btn btn-rounded btn-inline btn-success pull-right"><i class="fa fa-mail-reply" aria-hidden="true"></i> Go back  </span></a>

                                      </div>
                                    <section class="box-typical">
                                        <header class="box-typical-header profile_header">
					  <div class="tbl-row">
						<div class="tbl-cell tbl-cell-title">
						<h3>Email Detail</h3>
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

                                                              <th > Company Name  </th> 
                                                              <th>Email</th>  
                                                              <th>Dowload Resume </th>
                                                              <th >Open Email</th>
                                                               <th >City</th>
                                                              <th >Created Date</th>
                                                         </tr>
                                                         </thead>
                                                        <tbody>
                                                            <?php foreach ($company_data as $cValue){     ?>   
                                                           <tr id="1">
 
                                                                 
                                                                 <td class="color-blue-grey-lighter "><?php echo $cValue['companyName']; ?></td>
                                                                 <td class="color-blue-grey-lighter "><?php echo $cValue['primaryEmail']; ?></td>
                                                                 
                                                                 <td><?php echo ($cValue['isdownLoaded'])?'<label class="label label-success"> YES</label>':'<label class="label label-danger"> N/A</label>'; ?></td>
                                                                <td><?php echo ($cValue['isopenedEmail'])?'<label class="label label-success"> YES</label>':'<label class="label label-danger"> N/A</label>'; ?></td>
                                                                  <td class="color-blue-grey-lighter "> <?php echo $cValue['cityName'];  ?></td>
                                                                  <td class="color-blue-grey-lighter "><?php echo date('d-m-Y',strtotime($cValue['createdAt'])); ?></td>
                                                                 </tr>
                                                            <?php } ?>        
                                                        </tbody>
                                                   </table>     
                                                       
                                                 <?php      }else {   ?> 
                             

                              <section class="box-typical">
                                <div class="add-customers-screen tbl" style="height: 240px;">
                                    <div class="add-customers-screen-in">
                                        <div class="add-customers-screen-user">
                                            <i class="font-icon font-icon-user"></i>
                                        </div>
                                        <h2>Your <?php echo $page_name; ?> list is empty</h2>						
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





