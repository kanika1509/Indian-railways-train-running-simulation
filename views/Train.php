 <?php

 if(isset($_POST["minutes"])){
$data["minutes"] = $_POST["minutes"];
        echo json_encode($data);
    }
?>
