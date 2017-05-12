<div class="page-content">
    <div class="container-fluid">
        <div class="row">


                         <div class="col-lg-12">
                                     <div class="text-block text-block-typical ">


                                             <a href="<?php echo base_url()  ?>user/profile_view" > <span class="col-lg-1 col-lg-push-11  btn btn-rounded btn-inline btn-success pull-right"> Go back  </span></a>
                        </div>
                                      </div>
            <div class="col-lg-9 col-lg-push-3 col-md-12">
                
                <section class="box-typical">
                    <header class="box-typical-header-sm">User Profile</header>
                    <article class="profile-info-item">

                        <div class="text-block text-block-typical">
                            <!--						<div class="col-xl-12">-->
                            <div class="row m-t-lg">
                                <div class="col-md-12">
                                    <div id="message"><?php echo $this->session->flashdata('msg'); ?></div> 
                                    <form class="formvalidate"  method="POST" action="<?php echo base_url() ?>user/updateProfile" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="form-label" for="firstname">First Name</label>
                                            <div class="form-control-wrapper">
                                                <input id="firstname"
                                                       class="form-control"
                                                       value="<?php echo $this->session->all_userdata()['fname']; ?>"
                                                       name="firstname"
                                                       type="text" data-validation="[MIXED]"
                                                       data-validation-message="$ is required.">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="lastname">Last Name</label>
                                            <div class="form-control-wrapper">
                                                <input id="lastname"
                                                       value="<?php echo $this->session->all_userdata()['lname']; ?>"
                                                       class="form-control"
                                                       name="lastname"
                                                       type="text" data-validation="[MIXED]"
                                                       data-validation-message="$ is required.">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="email">Email</label>
                                            <div class="form-control-wrapper">
                                                <input id="email"
                                                       class="form-control"
                                                       name="email"
                                                       value="<?php echo $this->session->all_userdata()['email']; ?>"
                                                       type="text"
                                                       data-validation="[EMAIL]">
                                            </div>
                                        </div>


                                        <div class="form-group">  

                                            <div class="col-md-6">
                                                <label class="form-label " for="profilepic">Profile Pic</label>  
                                                <span class="btn btn-rounded btn-file">
                                                    <span>Choose file</span>
                                                    <input class="fileUpload"  name="profilepic" type="file" />
                                                </span> 
                                            </div>   
                                            <div class="col-md-6">
                                                <?php $image = 'http://www.placehold.it/200x150/EFEFEF/AAAAAA?text=no+image'; ?>
                                                <div id="image-holder" class="profile-card-photo img_border " style="width: 150px; height: 150px;"><img src="<?php echo $image; ?>" alt="">
                                                </div>
                                            </div>    
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn">Update</button>
                                        </div>
                                    </form>
                                </div>					
                            </div><!--.row-->
                            <!--	            				                 </div>-->
                        </div>
                    </article><!--.profile-info-item-->
                </section><!--.box-typical-->




                <section class="box-typical">
                    <header class="box-typical-header-sm">Setting Profile</header>
                    <article class="profile-info-item">

                        <div class="text-block text-block-typical">
                            <div class="col-xl-12">
                                <div class="row m-t-lg">                    
                                    <div class="col-md-12">
                                        <div id="message"><?php echo $this->session->flashdata('msg'); ?></div> 

                                        <form class="formvalidate"  method="POST" action="<?php echo base_url() ?>user/editSettingProfile" enctype="multipart/form-data">

                                            <div class="form-group pading-three">

<!--                                                <div class="form-control-wrapper col-md-6">

                                                    <label class="form-label " for="Resume">Resume</label>

                                                </div>
                                                <div class="form-control-wrapper  col-md-4">
                                                    <span class="btn btn-rounded  btn-info btn-file">
                                                        <span>Choose file</span>
                                                        <input type="file" id="resume" class="uploadimg" name="resume" >
                                                    </span>
                                                </div>
                                                <div class="form-control-wrapper  col-md-2">
                                                    <div id="progress-wrpresume"><div class="progress-bar"></div ><div class="status">0%</div></div>
                                                </div>-->


                                              <div class="form-control-wrapper col-md-4">

                                                    <label class="form-label " for="Resume">Resume</label>

                                                </div>
                                                 <div class="form-control-wrapper col-md-2">
                                                    <div class="img-zone text-center" id="img-zone">
                                                        <div class="img-drop">
                                                           
                                                          <span class="btn btn-rounded btn-file ">
                                                              Choose Files<input type="file"  class="uploadImg" id="resume"  name="resume[]"  multiple="">
                                                        </span>
                                                        </div>
                                                    </div>
                                                  </div>
                                                   <div class="form-control-wrapper  col-md-4">
                                                    <div class="progress hidden" id="progressresume">
                                                        <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" id="progress-barresume" role="progressbar" class="progress-bar progress-bar-success progress-bar-striped active">
                                                            <span class="sr-only">0% Complete</span>
                                                        </div>
                                                    </div>
                                                   </div>
                                                  <div class="form-control-wrapper  col-md-2">
                                                     <?php   $resumedata = explode(',',$settingProfile->resumeURL);
                                                                foreach ($resumedata as $key => $value) {
   
                                         echo ($value)?'<a href="'.$value.'" target="_blank" style="margin:5px;" > <i class="fa fa-download fa-2x"></i></a> ':'<label class="label label-danger"> N/A</label>'; 
                                                                 
                                                                  }
                                                                 ?>
                                                     </div>  
                                                   
                                             
                                             


                                            </div>

                                            <div class="form-group pading-three">

                                                <div class="form-control-wrapper col-md-4">
                                                    <label class="form-label" for="highschool">High School Mark Sheet</label>
 
                                                </div>
                                                 <div class="form-control-wrapper col-md-2">
                                                    <div class="img-zone text-center" id="img-zone">
                                                        <div class="img-drop">
                                                           
                                                          <span class="btn btn-rounded btn-file">
                                                             Choose Files   <input type="file"  class="uploadImg" multiple=""  id="hsmarksheet" name="hsmarksheet[]" >
                                                           
                                                        </span>
                                                        </div>
                                                    </div>
                                                  </div>
                                                   <div class="form-control-wrapper  col-md-4">
                                                    <div class="progress hidden" id="progresshsmarksheet">
                                                        <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" id="progress-barhsmarksheet" role="progressbar" class="progress-bar progress-bar-success progress-bar-striped active">
                                                            <span class="sr-only">0% Complete</span>
                                                        </div>
                                                    </div>
                                                   </div>
                                                  <div class="form-control-wrapper  col-md-2">
                                                     <?php echo ($settingProfile->highSchoolMarksheet)?"<a href='$settingProfile->highSchoolMarksheet' target='_blank'  ><i class='fa fa-download fa-2x'></i></a> ":"<label class='label label-danger'> N/A</label>"; ?>
                                                     </div>  


                                            </div>
                                            <div class="form-group pading-three">


                                                <div class=" col-md-4">
                                                    <label class="form-label" for="Intermediate">Intermediate Mark Sheet</label>
                        
                                                </div>
                                                  <div class="form-control-wrapper col-md-2">
                                                    <div class="img-zone text-center" id="img-zone">
                                                        <div class="img-drop">
                                                           
                                                          <span class="btn btn-rounded btn-file">
                                                             Choose Files   <input type="file"  class="uploadImg" multiple=""  id="intmarksheet" name="intmarksheet[]" >
                                                           
                                                        </span>
                                                        </div>
                                                    </div>
                                                  </div>
                                                   <div class="form-control-wrapper  col-md-4">
                                                    <div class="progress hidden" id="progressintmarksheet">
                                                        <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0"  id="progress-barintmarksheet" role="progressbar" class="progress-bar progress-bar-success progress-bar-striped active">
                                                            <span class="sr-only">0% Complete</span>
                                                        </div>
                                                    </div>
                                                   </div>  
                                                
                                                  <div class="form-control-wrapper  col-md-2">
                                                     <?php echo ($settingProfile->intermediateMarksheet)?"<a href='$settingProfile->intermediateMarksheet' target='_blank'  ><i class='fa fa-download fa-2x'></i></a>  ":"<label class='label label-danger'> N/A</label>"; ?>
                                                     </div>  
                                            </div>

                                            <div class="form-group pading-three">
                                                <div class="col-md-4">
                                                    <label class="form-label" for="other certification">Other Certification</label>
 
                                                </div>
                                                  <div class="form-control-wrapper col-md-2">
                                                    <div class="img-zone text-center" id="img-zone">
                                                        <div class="img-drop">
                                                           
                                                          <span class="btn btn-rounded btn-file">
                                                             Choose Files   <input type="file"  class="uploadImg" multiple=""  id="otherCertificate" name="otherCertificate[]" >
                                                           
                                                        </span>
                                                        </div>
                                                    </div>
                                                  </div>
                                                   <div class="form-control-wrapper  col-md-4">
                                                    <div class="progressfff hidden" id="progressotherCertificate">
                                                        <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" id="progress-barotherCertificate" class="progress-bar progress-bar-success progress-bar-striped active">
                                                            <span class="sr-only">0% Complete</span>
                                                        </div>
                                                    </div>
                                                   </div>  
                                                 <div class="form-control-wrapper  col-md-2">
                                                     <?php   $resumedata = explode(',',$settingProfile->certification);
                                                                foreach ($resumedata as $key => $value) {
   
                                                                 echo ($value)?'<a href="'.$value.'" target="_blank" > <i class="fa fa-download fa-2x"></i></a> ':'<label class="label label-danger"> N/A</label>'; 
                                                                 
                                                                  }
                                                                 ?>
                                                     </div>  
                                            </div>

                                            <div class="form-group pading-three">

                                                <div class="form-control-wrapper col-md-6">

                                                    <label class="form-label " for="postgraduaction">Notify By</label>
                                                </div>    

                                                <div class="form-control-wrapper col-md-6">
                                                    <div class="checkbox-bird col-md-4 green">
                                                        <input type="checkbox" name="notifyByEmail" id="check-bird-9" <?php if ($settingProfile->notifyByEmail) echo 'checked'; ?>  />

                                                        <label for="check-bird-9">Email</label> </div>

                                                    <div class="checkbox-bird col-md-4 green">
                                                        <input type="checkbox" name="notifyBySMS" id="check-bird-111"  <?php if ($settingProfile->notifyBySMS!='0') echo 'checked'; ?> />
                                                        <label for="check-bird-111">SMS</label> </div>

                                                    <div class="checkbox-bird col-md-4 green">
                                                        <input type="checkbox" name="notifyByCall" id="check-bird-999" <?php if ($settingProfile->notifyByCall) echo 'checked'; ?>  />
                                                        <label for="check-bird-999">Call</label> </div>
                                                </div>
                                            </div>
                                            <div class="form-group row_padding">

                                                <div class="form-control-wrapper col-md-6">
                                                    <label class="form-label" for="Available for Interview">Available For Interview</label>

                                                </div>
                                                <div class="form-control-wrapper col-md-6">
                                                    <div class="radio col-md-4 ">
                                                        <input type="radio" name="optionsRadios" id="radio-1" <?php if (isset($settingProfile->isAvailableF2F) && $settingProfile->isAvailableF2F == TRUE) echo 'checked'; ?> value="1">
                                                        <label for="radio-1">Yes </label>
                                                    </div>
                                                    <div class="radio col-md-4">
                                                        <input type="radio" name="optionsRadios" id="radio-2" <?php if (isset($settingProfile->isAvailableF2F) && $settingProfile->isAvailableF2F == FALSE) echo 'checked'; ?>  value="0">
                                                        <label for="radio-2">No</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" id="baseurl" value="<?php echo base_url(); ?>"/>

                                            <div class="form-group row_padding">
                                                <div class="form-control-wrapper col-md-12">
                                                    <br>
                                                    <button type="submit" class="btn ">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>					
                                </div><!--.row-->
                            </div>
                        </div>
                    </article><!--.profile-info-item-->
                </section><!--.box-typical-->





                <section class="box-typical">
                    <header class="box-typical-header-sm">Academic Detail</header>
                    <article class="profile-info-item">

                        <div class="text-block text-block-typical">
                            <div class="col-xl-12">
                                <div class="row m-t-lg">
                                    <div class="col-md-12">
                                        <div id="message"><?php echo $this->session->flashdata('msg'); ?></div> 

                                        <form class="formvalidate"  method="POST" action="<?php echo base_url() ?>user/editAcademicDetail" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="form-label" for="highschool">High School</label>
                                                <div class="form-control-wrapper col-md-6">
                                                    <input id="highSchoolPercentage"
                                                           class="form-control"
                                                           placeholder ="Percentage"
                                                           name="highSchoolPercentage"
                                                           type="text" data-validation="[NOTEMPTY]"
                                                           data-validation-message="$ is required."  value="<?php echo $academicDetail->highSchoolPercentage ?>" >
                                                </div>
                                                <div class="form-control-wrapper col-md-6">
                                                    <input id="highSchoolcollege_univ"
                                                           class="form-control"
                                                           value="<?php echo $academicDetail->highSchoolBoardCollege ?>"
                                                           placeholder ="Board/College"
                                                           name="highSchoolcollege_univ"
                                                           type="text" data-validation="[NOTEMPTY]" 
                                                           data-validation-message="$ is required."       >
                                                </div>													
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="inter">Intermediate</label>
                                                <div class="form-control-wrapper col-md-6">
                                                    <input id="interPercentage"
                                                           class="form-control"

                                                           placeholder ="Percentage"
                                                           name="interPercentage"
                                                           type="text" data-validation="[NOTEMPTY]"  
                                                           data-validation-message="$ is required."  value="<?php echo $academicDetail->intermediatePercentage ?>" >
                                                </div>
                                                <div class="form-control-wrapper col-md-6">
                                                    <input id="intercollege_univ"
                                                           class="form-control"
                                                           placeholder ="Board/College"
                                                           name="intercollege_univ"
                                                           type="text" data-validation="[NOTEMPTY]"  value="<?php echo $academicDetail->interBoardCollege; ?>"
                                                           data-validation-message="$ is required.">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="graduaction">Graduation</label>
                                                <div class="form-control-wrapper col-md-6">
                                                    <input id="graduactionPercentage"
                                                           class="form-control"

                                                           placeholder ="Percentage"
                                                           name="graduactionPercentage"  value="<?php echo $academicDetail->graduationPercentage; ?>"
                                                           type="text"
                                                           >
                                                </div>
                                                <div class="form-control-wrapper col-md-6">
                                                    <input id="graduactioncollege_univ"
                                                           class="form-control"
                                                           placeholder ="Board/College"
                                                           name="graduactioncollege_univ"  value="<?php echo $academicDetail->graduateUniversityCollege; ?>"
                                                           type="text" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="postgraduaction">Post Graduation</label>
                                                <div class="form-control-wrapper col-md-6">
                                                    <input id="postgraduactionPercentage"
                                                           class="form-control"

                                                           placeholder ="Percentage"
                                                           name="postgraduactionPercentage"   value="<?php echo $academicDetail->postGraduationPercentage; ?>"
                                                           type="text"
                                                           >
                                                </div>
                                                <div class="form-control-wrapper col-md-6">
                                                    <input id="postgraduactioncollege_univ"
                                                           class="form-control"
                                                           placeholder ="Board/College"
                                                           name="postgraduactioncollege_univ" value="<?php echo $academicDetail->pgUniversityCollege; ?>"
                                                           type="text" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="otherCertification">Other Certification</label>
                                                <div class="form-control-wrapper col-md-12">
                                                    <input id="postgraduactionPercentage"
                                                           class="form-control"

                                                           placeholder ="other Certification"  value="<?php echo $academicDetail->otherCertification; ?>"
                                                           name="otherCertification"
                                                           type="text"
                                                           >
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="form-control-wrapper col-md-12">
                                                    <br>
                                                    <button type="submit" class="btn ">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>					
                                </div><!--.row-->
                            </div>
                        </div>
                    </article><!--.profile-info-item-->
                </section><!--.box-typical-->
            </div>

          
	<?php  include_once("common/jobseekerSidebar.php") ?>



        </div><!--.row-->
    </div><!--.container-fluid-->
</div><!--.page-content-->





<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>


    $("#file_resume").on('change', function () {
        if (typeof (FileReader) != "undefined") {

            var image_holder = $("#resume_holder");
            image_holder.empty();

            var reader = new FileReader();

            reader.onload = function (e) {

                var data_img = e.target.result.split(';');
                var fileType = data_img[0].split(':');
                if (fileType[1] == "application/pdf") {
                    var image = '<?php echo base_url() ?>assets/admin/img/file-pdf.png';
                }
                if (fileType[1] == "application/doc" || fileType[1] == "application/docx") {
                    var image = '<?php echo base_url() ?>assets/admin/img/docs.png';
                }

                $("<img />", {
                    "src": image,
                    "class": "thumb-image img_width",
                }).appendTo(image_holder);


            }
            image_holder.show();

            reader.readAsDataURL($(this)[0].files[0]);

        } else {
            alert("File not supported");
        }


    });



    $("#file_int_mark").on('change', function () {
        if (typeof (FileReader) != "undefined") {

            var image_holder = $("#int_marks_holder");
            image_holder.empty();

            var reader = new FileReader();

            reader.onload = function (e) {

                var data_img = e.target.result.split(';');
                var fileType = data_img[0].split(':');
                if (fileType[1] == "application/pdf") {
                    var image = '<?php echo base_url() ?>assets/admin/img/file-pdf.png';
                }
                if (fileType[1] == "application/doc" || fileType[1] == "application/docx") {
                    var image = '<?php echo base_url() ?>assets/admin/img/docs.png';
                }

                $("<img />", {
                    "src": image,
                    "class": "thumb-image img_width",
                }).appendTo(image_holder);


            }
            image_holder.show();

            reader.readAsDataURL($(this)[0].files[0]);

        } else {
            alert("File not supported");
        }


    });



    $("#file_hsmark").on('change', function () {
        if (typeof (FileReader) != "undefined") {

            var image_holder = $("#hsmarks_holder");
            image_holder.empty();

            var reader = new FileReader();

            reader.onload = function (e) {

                var data_img = e.target.result.split(';');
                var fileType = data_img[0].split(':');
                if (fileType[1] == "application/pdf") {
                    var image = '<?php echo base_url() ?>assets/admin/img/file-pdf.png';
                }
                if (fileType[1] == "application/doc" || fileType[1] == "application/docx") {
                    var image = '<?php echo base_url() ?>assets/admin/img/docs.png';
                }

                $("<img />", {
                    "src": image,
                    "class": "thumb-image img_width"

                }).appendTo(image_holder);


            }
            image_holder.show();

            reader.readAsDataURL($(this)[0].files[0]);

        } else {
            alert("File not supported");
        }


    });


    $("#file_others").on('change', function () {
        if (typeof (FileReader) != "undefined") {

            var image_holder = $("#others_holder");
            image_holder.empty();

            var reader = new FileReader();

            reader.onload = function (e) {

                var data_img = e.target.result.split(';');
                var fileType = data_img[0].split(':');
                if (fileType[1] == "application/pdf") {
                    var image = '<?php echo base_url() ?>assets/admin/img/file-pdf.png';
                }
                if (fileType[1] == "application/doc" || fileType[1] == "application/docx") {
                    var image = '<?php echo base_url() ?>assets/admin/img/docs.png';
                }

                $("<img />", {
                    "src": image,
                    "class": "thumb-image img_width"

                }).appendTo(image_holder);


            }
            image_holder.show();

            reader.readAsDataURL($(this)[0].files[0]);

        } else {
            alert("File not supported");
        }


    });





    $(".fileUpload").on('change', function () {



        if (typeof (FileReader) != "undefined") {

            var image_holder = $("#image-holder");
            image_holder.empty();

            var reader = new FileReader();



            reader.onload = function (e) {
                var data_img = e.target.result.split(';');
                var fileType = data_img[0].split(':');

                $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image",
                    "width": "150",
                    "height": "150"
                }).appendTo(image_holder);

            }

            image_holder.show();

            reader.readAsDataURL($(this)[0].files[0]);

        } else {
            alert("File not supported");
        }
    });

</script>   