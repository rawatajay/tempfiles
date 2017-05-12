<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
| http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
| $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
| $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
| $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples: my-controller/index -> my_controller/index
|   my-controller/my-method -> my_controller/my_method
*/

/***************************************************
|
|start :  frontend route
|
***************************************************/
$route['default_controller'] 		= 'auth';
$route['login']						= 'auth/login';
$route['logout'] 					= 'auth/logout';
$route['dashboard'] 				= 'home';
$route['admin/dashboard']			= 'admin/admin';
$route['forgot-password'] 			= 'auth/forgotpassword';
$route['forgotpassword_process'] 	= 'auth/forgotpassword_process';
$route['setpassword/(:any)']		= 'auth/setpassword/$1';
$route['setpassword_process/(:any)']= 'auth/setpassword_process/$1';
$route['register-employee']			= 'auth/register-employee';



$route['signup/(:any)'] 			= 'auth/signup/$1';
$route['signin'] 					= 'auth/signin';
$route['blog'] 						= 'home/blog';
$route['aboutus'] 					= 'home/aboutus';
$route['privacy-policy'] 			= 'home/privacypolicy';
$route['terms-condition'] 			= 'home/termsandcondition';
$route['searchquery'] 				= 'home/searchquery';
$route['academicrecord']			= 'home/academicrecord';
$route['blog_details/(:any)'] 			= 'home/blog_details/$1';
$route['jobseeker']				= 'home/jobseeker';
$route['translate_uri_dashes'] 		        = FALSE;
$route['404_override'] 				= 'home/page_404';
/***************************************************
|
|start :  admin route
|
***************************************************/
$route['admin/userlist']			= 'admin/admin/users';
$route['admin/user/edit']			= 'admin/admin/useredit';
$route['admin/user/save']			= 'admin/admin/usersave';
$route['admin/user/delete']			= 'admin/admin/userdelete';	
$route['admin/jobseekerlist']		= 'admin/admin/jobseekerlist';

$route['admin/salaryrangelist']		= 'admin/admin/salaryrangelist';
$route['admin/functionalAreaList'] 	= 'admin/admin/functionalarealist';
$route['admin/companylist']			= 'admin/admin/companylist';
$route['admin/jobtypelist']			= 'admin/admin/jobtypelist';
$route['admin/jobtype/add']			= 'admin/admin/jobtypeadd';
$route['admin/jobtype/edit']		= 'admin/admin/jobtypeedit';
$route['admin/jobtype/update']		= 'admin/admin/jobtypeupdate';
$route['admin/jobtype/delete']		= 'admin/admin/jobtypedelete';
$route['admin/ftype/add']           = 'admin/admin/funtionaltypeadd';
$route['admin/ftype/edit']          = 'admin/admin/funtionaltypeedit';
$route['admin/ftype/update']        = 'admin/admin/funtionaltypeupdate';
$route['admin/ftype/delete']        = 'admin/admin/fareadelete';


$route['admin/company'] 			= 'admin/admin/company';
$route['admin/company/add']                = 'admin/admin/createCompany';
$route['admin/company/edit/(:any)']        = 'admin/admin/companyedit/$1';
$route['admin/company/update']             = 'admin/admin/companyupdate';
$route['admin/company/delete']          = 'admin/admin/companydelete';

$route['admin/datasetlist']      	= 'admin/admin/datasetlist';

$route['admin/state'] 				= 'admin/admin/getstate';
$route['admin/city'] 				= 'admin/admin/getcity';
$route['admin/exportcountry']		= 'admin/admin/exportcountry';
$route['admin/exportstate']			= 'admin/admin/exportstate';
$route['admin/exportcity']			= 'admin/admin/exportcity';
$route['admin/importcompany']		= 'admin/admin/importcompany';
$route['admin/importcompanycsv']	= 'admin/admin/importcompanycsv';
$route['admin/exportcompany']		= 'admin/admin/exportcompany';
$route['admin/exportfunctionalarea']= 'admin/admin/exportfunctionalarea';
$route['admin/dataset']				= 'admin/admin/dataset';
$route['admin/getTotCompanies']		= 'admin/admin/getTotCompanies';
$route['admin/dataset/add']			= 'admin/admin/datasetadd';
$route['admin/dataset/edit/(:any)'] = 'admin/admin/datasetedit/$1';	
$route['admin/dataset/update'] 		= 'admin/admin/datasetupdate';
$route['admin/dataset/delete']		= 'admin/admin/datasetdelete';	
$route['admin/exportdataset']		= 'admin/admin/exportdataset';	
$route['admin/importdataset']		= 'admin/admin/importdataset';
$route['admin/importdatasetcsv']	= 'admin/admin/importdatasetcsv';

$route['admin/addtemplate'] 	        = 'admin/admin/addtemplate';
$route['admin/editTemplate/(:any)'] 	= 'admin/admin/editTemplate/$1';
$route['admin/updateTemplate/(:any)'] 	= 'admin/admin/updateTemplate/$1';
$route['admin/createtemplate'] 		= 'admin/admin/createtemplate';
$route['admin/template'] 		= 'admin/admin/manageTemplate';
$route['admin/getpreviewmail'] 		= 'admin/admin/getpreviewmail';
$route['admin/getpreviewmail'] 		= 'admin/admin/getpreviewmail';
$route['admin/userDatasetlistData']     = 'admin/admin/userDatasetlistData';
$route['admin/payu_TransactionHistory']        = 'admin/admin/payu_TransactionHistory';
$route['admin/addBlog']                 = 'admin/admin/addBlog';
$route['admin/saveBlog']                = 'admin/admin/saveBlog';
$route['admin/blog']                    = 'admin/admin/manageBlog';
$route['admin/editBlog/(:any)']         = 'admin/admin/editBlog/$1';
$route['admin/deleteBlog']              ='admin/admin/deleteBlog';


$route['admin/addTestimonial']          = 'admin/admin/addTestimonial';
$route['admin/saveTestimonial']         = 'admin/admin/saveTestimonial';
$route['admin/testimonial']             = 'admin/admin/manageTestimonial';
$route['admin/editTestimonial/(:any)']         = 'admin/admin/editTestimonial/$1';
$route['admin/deleteTestimonial']              ='admin/admin/deleteTestimonial';


$route['admin/addQuestion']                 = 'admin/admin/addQuestion';
$route['admin/saveQuestion']                = 'admin/admin/saveQuestion';
$route['admin/question']                    = 'admin/admin/manageQuestion';
$route['admin/editQuestion/(:any)']         = 'admin/admin/editQuestion/$1';
$route['admin/deleteQuestion']              ='admin/admin/deleteQuestion';





/***************************************************
|
|start :  jobseeker dashboard route
|
***************************************************/
$route['jobseeker-dashboard']		= 'frontend/jobseeker';
$route['myaccount']					= 'frontend/Jobseeker/myaccount';
$route['user/logout']				= 'frontend/Jobseeker/logout';
$route['user/signup']				= 'frontend/Jobseeker/signup';
$route['user/login']				= 'frontend/Jobseeker/login';
$route['user/editprofile']			= 'frontend/Jobseeker/editprofile';
$route['user/updateProfile']		= 'frontend/Jobseeker/updateProfile';
$route['user/academicDetail']		= 'frontend/Jobseeker/academicDetail';
$route['user/forgotpassword']		= 'frontend/Jobseeker/forgotpassword';
$route['activation/(:any)']			= 'frontend/Jobseeker/checkactivation/$1';
$route['user/editAcademicDetail']		= 'frontend/Jobseeker/editAcademicDetail';
$route['user/settingProfile']	        = 'frontend/Jobseeker/settingProfile';
$route['user/editSettingProfile']       = 'frontend/Jobseeker/editSettingProfile';
$route['user/profile']                  = 'frontend/Jobseeker/profileDetail';
$route['user/datasetList']              = 'frontend/Jobseeker/datasetList';
$route['user/companylist']              = 'frontend/Jobseeker/companylist';

$route['user/profile_view']             = 'frontend/Jobseeker/profileviewdata';
$route['user/dataset/detail/(:any)']    = 'frontend/Jobseeker/datasetview/$1';
$route['user/dataset/mail/(:any)']      = 'frontend/Jobseeker/datasetmail/$1';
$route['user/dataset/sendmail']         = 'frontend/Jobseeker/send_mail';

$route['user/dataset/getpreviewmail']             = 'frontend/Jobseeker/getpreviewmail';
$route['user/dataset/getpreviewmailData']             = 'frontend/Jobseeker/getpreviewmailData';

$route['user/dataset/getcityDatafilter']          = 'frontend/Jobseeker/getcityDatafilter';
$route['user/dataset/getdatasetdata']             = 'frontend/Jobseeker/getdatasetdata';

$route['user/profiledownLoad/(:any)']          = 'frontend/Jobseeker/profiledownLoad/$1';
$route['user/openEmail/(:any)']                = 'frontend/Jobseeker/openEmail/$1';
$route['user/uploadFileData']                  = 'frontend/Jobseeker/uploadFileData';


$route['user/userDatasetlistData']            = 'frontend/Jobseeker/userDatasetlistData';
$route['user/userEmailList/(:any)']           = 'frontend/Jobseeker/emailuserlist/$1';
$route['user/userPaymentPage']                = 'frontend/Jobseeker/userPaymentPage';
$route['user/payu_Payment']                   = 'frontend/Jobseeker/payu_Payment';
$route['user/payu_PaymentSuccess']            = 'frontend/Jobseeker/payu_PaymentSuccess';
$route['user/payu_Paymentfailure']            = 'frontend/Jobseeker/payu_Paymentfailure';
$route['user/payu_TransactionHistory']        = 'frontend/Jobseeker/payu_TransactionHistory';
$route['user/payu_PaymentHistory']            = 'frontend/Jobseeker/payu_PaymentHistory';
$route['user/user_TransactionHistory']        = 'frontend/Jobseeker/user_TransactionHistory';


$route['user/getgmailData']                   = 'frontend/Jobseeker/getgmailData';
$route['user/getsocialsitesData']             = 'frontend/Jobseeker/getsocialsitesData';
$route['user/sendrefferalMail']               = 'frontend/Jobseeker/sendrefferalMail';
$route['user/questionData']               = 'frontend/Jobseeker/questionListData';
$route['user/getquestionData']               = 'frontend/Jobseeker/getquestionData';




         
          

