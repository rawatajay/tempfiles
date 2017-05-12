<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Class name: App
 * @description :  This class contains all functions which will be used to show error message, warnings and success message
 * @author: Rachit Agarwal
 */
class App extends CI_Model {
  /*
   * @description :  This function called automatically when we call this call function or use any class variable
   * @Method name: __construct
   */
  public function __construct(){
    parent  :: __construct();
  }

  /*
   * @parameter : message, status
   * @description :  This function is developed for showing messages
   * @Method name: message
   */
  public function message($message, $status) {
    if ($status == 'warning') {
        return $this->session->set_flashdata('msg', '<div class="alert alert-warning alert-no-border alert-close alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'. $message .'</div>');
    }
    if ($status == 'success') {

       return $this->session->set_flashdata('msg', '<div class="alert alert-success alert-no-border alert-close alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'. $message .'</div>');
    }
    if ($status == 'error') {      
        return $this->session->set_flashdata('msg', '<div class="alert alert-danger alert-no-border alert-close alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>'. $message .'</div>');
    }
  }

  /*
   * @parameter : message, status
   * @description :  This function is developed for showing messages
   * @Method name: display
   */
  public function display($message, $status) {
    if ($status == 'warning') {
        return '<div class="alert bounce alert-animate alert-warning alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
            <b>Warning! </b>' . $message . '</div>';
    }
    if ($status == 'success') {
        return '<div class="alert bounce alert-animate alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
            <b>Success! </b>' . $message . '</div>';
    }
    if ($status == 'error') {
        return '<div class="alert bounce alert-animate alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
            <b>Error! </b>' . $message . '</div>';
    }
  }

  /*
   * @parameter : date
   * @description :  This function is developed for converting dates from "/" to "-"
   * @Method name: convertDate
   */
  public function convertDate($date) {
    return date('Y-m-d',strtotime(str_replace('/', '-', $date)));
  }
}
