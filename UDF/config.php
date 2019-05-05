<?php

class Userfunction{
	private $DBHOST='localhost';
	private $DBUSER='root';
	private $DBPASS='';
	private $DBNAME='sqldatabase';
	public $con;
    
    public function __construct(){
		$this->con = mysqli_connect($this->DBHOST, $this->DBUSER, $this->DBPASS, $this->DBNAME);
		if(!$this->con){
			return false;
		}
    }
    
    public function showall($tblname, $field, $order="DESC"){

        $select = "SELECT * FROM $tblname ORDER BY $field $order";
        $select_fire = mysqli_query($this->con, $select);
        if(mysqli_num_rows($select_fire) > 0){
            $fetch_all = mysqli_fetch_all($select_fire, MYSQLI_ASSOC);
            if($fetch_all){
                return $fetch_all;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }

    }

    public function change_status($tblname, $field, $new_val, $od_field, $str_val){

        $new_str = "";
        $str_val_array = explode(',', $str_val);
        foreach($str_val_array as $data){
            $new_str = $new_str."'".$data."', ";
        }
        $new_str = rtrim($new_str,', ');

        $update = "UPDATE $tblname SET $field = $new_val WHERE $od_field IN ($new_str)";
        $update_fire = mysqli_query($this->con, $update);
        if($update_fire){
            return $update_fire;
        }
        else{
            return false;
        }

    }



}


?>