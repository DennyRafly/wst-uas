<?php

    // Call file in line
    include 'Database.php';

    // Create object / instance
    $db = new Database();
    $con=$db->Connect();

    $id= "";
    $from_nis = $_POST['from'];
    $to_nis = $_POST['nis'];
    $datetime = Date('Y-m-d h:i:s');
    $message=$_POST['message'];
    // Process GET query
    $aa=mysqli_query($con,"insert into message values
        ('".$id."','".$from_nis."','".$to_nis."','".$message."','".$datetime."')
        ");

    // Process encription data
    $dataGet=json_encode($aa);

    // // Process description data
    // $mhs=json_decode($dataGet);
    echo $dataGet;
    // // View with looping use index array
    // for ($i = 0; $i < $no; $i++) {
    //     echo $mhs[$i]->nama; 
    //     echo"<br>";
    //   }


?>