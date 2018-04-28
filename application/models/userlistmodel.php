<?php

class Userlistmodel extends CI_Model {

     function __construct()  
      {  
         // Call the Model constructor  
         parent::__construct();  
      }   
  function insert_data($data, $tablename) {
        if ($this->db->insert($tablename, $data)) {
            return true;
        } else {
            return false;
        }
    }
     // select data using colum id
    function select_database_id($tablename, $columnname, $columnid, $data = '*') {
        $this->db->select($data);
        $this->db->where($columnname, $columnid);
        $query = $this->db->get($tablename);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    //we will use the select function  
    public function select() {
        //data is retrive from this query
        $query = $this->db->get('user');
        return $query;
        
    }
    public function select_user_by_id($id) {
        //data is retrive from this query
        $this->db->where('user_id',$id);
        $query = $this->db->get('user');
        return $query;
        
    }
    
    public function edit($id){
        $query=$this->db->get('user',$id);
        return $query;
    }
    public function insert_user($data){
       $res = $this->db->insert("user", $data);
       if ($res)
       {
           return true;
       }
       else
       {
           return false;
       }
    }
   
    function update_data($data, $tablename, $columnname, $columnid) {
        $this->db->where($columnname, $columnid);
        if ($this->db->update($tablename, $data)) {
            return true;
        } else {
            return false;
        }
    }
}

?>  