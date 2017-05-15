<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Class name: Common
 * @description :  This class contains all functions which will be used to show error message, warnings and success message
 * @author: Ajay Singh
 */
class Common extends CI_Model {
  /*
   * @description :  This function called automatically when we call this call function or use any class variable
   * @Method name: __construct
   */
  public function __construct(){
    parent  :: __construct();
    $this->load->library('smtp');
    $this->load->library('phpmailer');

  }
#########################** INSERT FUNCTIONS START **######################
  /*
   * @parameter : table, data
   * @description :  This function is developed for insert
   * @Method name: insert
   */
  public function insert($table='', $data=''){
      $this->db->insert($table, $data); 
      //    echo $this->db->last_query();      die;
      return $this->db->insert_id();
  }
#########################** INSERT FUNCTIONS END **######################
#########################** SELECT FUNCTIONS START **######################
  /*
   * @parameter : table, condition, orderby, select_what, limit, offset
   * @description :  This function is developed for listing
   * @Method name: _getList
   */
  public function _getList($table='', $condition='',$orderby='',$select_what='', $limit='', $offset='') {
    if(!empty($table)){
      if($select_what){
        $this->db->select($select_what);
      }
      $this->db->from($table);
      if($limit!='' && ($offset==''||$offset==NULL))
        $this->db->limit($limit);
      else if($limit!='' && $offset!='')
        $this->db->limit($limit, $offset);
      if($condition){
        $this->db->where($condition);
      }
      if($orderby){
        $this->db->order_by($orderby);
      }
      $query = $this->db->get();          
     //  echo $this->db->last_query(); die;
      if($query->num_rows() > 0){
        return $query->result_array();
      }else{
        return array();
      }
    }   
  }

  /*
  * @parameter : table, condition, select_what
  * @description :  This function is developed for get single row
  * @Method name: _getRow
  */
  public function _getRow($table='', $condition='', $select_what='' ){
    if(!empty($table)){
      if($select_what){
        $this->db->select($select_what);
      }
      $this->db->limit(1);
      $this->db->from($table);
      if($condition){
        $this->db->where($condition);
      }
      $query = $this->db->get();
       //echo $this->db->last_query(); die;
      if($query->num_rows() > 0){
        return $query->row_array();
      }else{
        return false;
      }
    }
  }
  /*
  * @parameter : table, condition
  * @description :  This function is developed to count records
  * @Method name: _getCount
  */
  public function _getCount($table ,$condition=''){
    if(!empty($table)){
      $this->db->from($table);
      $this->db->where($condition);
      $query = $this->db->get();
    //  echo $this->db->last_query();
      if($query->num_rows() > 0){
        return $query->num_rows();
      }else{
        return 0;
      }
    }
  }
  /*
  * @parameter : query, retun_type shuld be in (1=>result_array, 2=>result, 3=> row_array, 4=> row)
  * @description :  This function is developed to customer query
  * @Method name: customeQuery
  */
  public function _getCustomeQuery($query='',$retun_type=''){
    $result =array();
    $queryResult = $this->db->query($query);
   // echo $this->db->last_query(); die;
    if($queryResult->num_rows()>0){
      if($retun_type==1)
         $result= $queryResult->result_array();
      else if($retun_type==2)
         $result= $queryResult->result();
      else if($retun_type==3)
         $result= $queryResult->row_array();
      else if($retun_type==4)
         $result= $queryResult->row();
    }
    return $result;
  }
#########################** SELECT FUNCTIONS END **######################
  
  /*
  * @parameter : table, condition , where
  * @description :  This function is developed to update data
  * @Method name: update
  */
  public function update($table,$condition,$data){
    $this->db->update($table, $data, $condition);  
    //echo $this->db->last_query();  die;
    return $this->db->affected_rows();
  }

  /*
  * @parameter : table, condition 
  * @description :  This function is developed to delete data
  * @Method name: delete_by_id
  */
  public function deletes($table,$condition){
    $this->db->where($condition);
    if($this->db->delete($table))
      return true;
    else
      return false;
  }

  /*
  * @parameter    : table, filename 
  * @description  :  This function is csv export
  * @Method name  : exportMysqlToCsv
  */
  function outputCSV($data,$file_name = 'file.csv') {
      header("Content-Type: text/csv");
      header("Content-Disposition: attachment; filename=$file_name");
      header("Cache-Control: no-cache, no-store, must-revalidate");
      header("Pragma: no-cache");
      header("Expires: 0");
      $output = fopen("php://output", "w");
        foreach ($data as $row) {
        fputcsv($output, $row);
        }
      fclose($output);
  }

  public function getsendgridDetails() {
        $result =array();
        $api_user = 'Jobhunters';
        $password = 'atayal123';
        $curl_handle = curl_init();
        $url ="https://api.sendgrid.com/api/stats.get.json?api_user=$api_user&api_key=$password&aggregate=1";
        curl_setopt($curl_handle, CURLOPT_URL, $url);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_POST, 1);
      
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
       
        $buffer = curl_exec($curl_handle);
        curl_close($curl_handle);
        $result = json_decode($buffer);
       return $result;
  }
  /**
  * Prepare INSERT IGNORE SQL query
  * @param Array $data Array in form of "Column" => "Value", ... 
  * @return Null
  */
  protected function insert_ignore(array $data) {
      $_prepared = array();
      foreach ($data as $col => $val)
          $_prepared[$this->db->escape_identifiers($col)] = $this->db->escape($val); 
      $this->db->query('INSERT IGNORE INTO `table` ('.implode(',',array_keys($_prepared)).') VALUES('.implode(',',array_values($_prepared)).');');
  }

  public function send_mail($ebody_contact,$esubject_contact,$toemail, $toname, $fromemail, $fromname){
    $this->phpmailer->IsSMTP();                                      // set mailer to use SMTP
    $this->phpmailer->Host        = SMTPHOST;  // specify main and backup server
    $this->phpmailer->SMTPAuth    = true;     // turn on SMTP authentication
    $this->phpmailer->SMTPSecure  = "ssl";
    $this->phpmailer->Port        = SMTPPORT;
    $this->phpmailer->Username    = SMTPEMAIL;  // SMTP username
    $this->phpmailer->Password    = SMTPPASS; // SMTP password
    $this->phpmailer->SMTPAuth    = true;
    $this->phpmailer->From        = $fromemail;
    $this->phpmailer->FromName    = $fromname;
    $this->phpmailer->AddAddress($toemail, $toname);   // name is optional
    $this->phpmailer->AddReplyTo($fromemail, $fromname);
    $this->phpmailer->IsHTML(true);                                  // set email format to HTML
    $this->phpmailer->Subject     = $esubject_contact;
    $this->phpmailer->Body        = $ebody_contact;
    if(!$this->phpmailer->Send())
    {
      return false;
    }   
    return true;
  }
  
  /**
  * Populate datatable in data table server side
  * @param Array $data Array in form of "Column" => "Value", ... 
  * @return Null
  */
  public function populateDatatable($aColumns,$sIndexColumn,$sTable,$checkbox= false,$condition='',$encriptData='') {
    /* 
    * Paging
    */
    $sLimit = "";

    if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
    {
      $sLimit = "LIMIT ".$_GET['iDisplayStart'].", ".$_GET['iDisplayLength'];
    }
    
    /*
     * Ordering
     */
    if ( isset( $_GET['iSortCol_0'] ) )
    {
      $sOrder = "ORDER BY  ";
      for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
      {
        if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
        {
          $sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
            ".$_GET['sSortDir_'.$i].", ";
        }
      }
      
      $sOrder = substr_replace( $sOrder, "", -2 );
      if ( $sOrder == "ORDER BY" )
      {
        $sOrder = "";
      }
    }

    $sWhere = "";
    if ( $_GET['sSearch'] != "" )
    {
      $sWhere = "WHERE (";
      for ( $i=0 ; $i<count($aColumns) ; $i++ )
      {
        $sWhere .= $aColumns[$i]." LIKE '%".$_GET['sSearch']."%' COLLATE utf8mb4_general_ci OR ";
      }
      $sWhere = substr_replace( $sWhere, "", -3 );
      $sWhere .= ')';
    }

    /* Individual column filtering */
    for ( $i=0 ; $i<count($aColumns) ; $i++ )
    {
      if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
      {
        if ( $sWhere == "" )
        {
          $sWhere = "WHERE ";
        }
        else
        {
          $sWhere .= " AND ";
        }
        $sWhere .= $aColumns[$i]." LIKE '%".$_GET['sSearch_'.$i]."%' ";
      }
    }

    if($condition){
      if ( $sWhere == "" )
        {
          $sWhere = "WHERE ";
        }
        else
        {
          $sWhere .= " AND ";
        }
      $sWhere .=$condition;
    }
    /*
     * SQL queries
     * Get data to display
     */
    $sQuery = " 
      SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
      FROM   $sTable
      $sWhere
      $sOrder
      $sLimit
    ";
    $rResult = $this->common->_getCustomeQuery($sQuery,1);
    $nrResult=array();
    if($encriptData && is_array($encriptData)){
      foreach($encriptData as $v){
        foreach($rResult as  $k=>$r){
          $r['enct'.$v]=encrypt_decrypt('encrypt',$r[$v]);
         $nrResult[$k]= $r;
        }
        $aColumns[]='enct'.$v;
      }
    }
    $rResult=$nrResult;
    $sQuery = "SELECT FOUND_ROWS() as totalrows";
    $rows = $this->common->_getCustomeQuery($sQuery,4);
    $iFilteredTotal = $rows->totalrows;

    /* Total data set length */
    $sQuery = "
      SELECT COUNT(".$sIndexColumn.") as countIndex
      FROM   $sTable
    ";
    //$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
    $aResultTotal = $this->common->_getCustomeQuery($sQuery,3);
    $iTotal = $aResultTotal['countIndex'];
    /*
     * Output
     */
    $output = array(
      "sEcho" => intval($_GET['sEcho']),
      "iTotalRecords" => $iTotal,
      "iTotalDisplayRecords" => $iFilteredTotal,
      "aaData" => array()
    );
    
    array_unshift($aColumns,"sno");
    if($checkbox === true){
      array_unshift($aColumns,"checkbox");
    }
    $snoStart = $_GET['iDisplayStart'];
    foreach ($rResult as $rkey => $rvalue) {
      $row = array();
      foreach ($aColumns as $ckey => $cvalue) {
        //print_r($aColumns);
        if ( $cvalue != ' ' )
        {
          /* General output */                     
          $row[] = $rvalue[ $cvalue ];
        }
      }
      if($checkbox === true){
        $row[1] = $snoStart+($rkey+1);
      }else{
        $row[0] = $snoStart+($rkey+1);              
      }
      $output['aaData'][] = $row;
    } 
    return json_encode( $output );
  }
}
