<?php

class dashboard_model extends model{
    function __construct() {
        parent::__construct();
        
    }
    
    public function test_data_insert($text)
    {
        $query = "INSERT INTO TEST_DATA (TEXT1) VALUES (:text)";
        $prep = $this->db->prepare($query);
        $prep->execute(array(":text"=>$text));
    }
    
    public function &test_data_get()
    {
        $query = "SELECT * FROM TEST_DATA";
        $result_arry = array();
        $sth = $this->db->query($query, PDO::FETCH_ASSOC);
        $sth->execute();
        $result = $sth->fetchall();        
        return $result;
    }
    
    public function test_data_truncate()
    {
        $query = "TRUNCATE TABLE TEST_DATA";
        $this->db->query($query);
    }
    
    public function test_data_delete($id)
    {
        $query = "delete from TEST_DATA where idTEST_DATA = :id";
        $prep = $this->db->prepare($query);
        $prep->execute(array(":id"=>$id));
    }
    
}
    
?>
