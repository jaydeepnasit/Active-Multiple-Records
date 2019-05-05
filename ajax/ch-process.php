<?php

include_once '../UDF/config.php';
$data_config = new Userfunction;

$json_data = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if(isset($_POST['data_string']) && !empty($_POST['data_string'])){

        $data_string = $_POST['data_string'];
        try{
            $update_status = $data_config->change_status('userdata', 'u_status', '1', 'id', $data_string);
            if($update_status){
                $json_data['status'] = 104;
                $json_data['msg'] = "Data SuccessFully Updated (Active)";
            }
            else{
                throw new Exception("Data Not Updated");
            }
        }
        catch(Exception $e){
            $json_data['status'] = 103;
            $json_data['msg'] = $e->getMessage();
        }
    }
    else if(isset($_POST['de_data_string']) && !empty($_POST['de_data_string'])){

        $data_string2 = $_POST['de_data_string'];
        try{
            $de_update_status = $data_config->change_status('userdata', 'u_status', '0', 'id', $data_string2);
            if($de_update_status){
                $json_data['status'] = 106;
                $json_data['msg'] = "Data SuccessFully Updated (Deactive)";
            }
            else{
                throw new Exception("Data Not Updated");
            }
        }
        catch(Exception $e){
            $json_data['status'] = 105;
            $json_data['msg'] = $e->getMessage();
        }   
             
    }
    else{
        $json_data['status'] = 102;
        $json_data['msg'] = "Invalid Data Values";
    }

}
else{
    $json_data['status'] = 101;
    $json_data['msg'] = "Invalid Request Method";
}


echo json_encode($json_data);

?>