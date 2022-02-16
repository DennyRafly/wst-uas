<?php

    // Call file in line
    include 'Database.php';

    // Create object / instance
    $db = new Database();
    $con=$db->Connect();

   
    


    // Process GET query
    $rows=mysqli_query($con,"select * from mahasiswa");
    $data=array();
    $no=0;
    foreach($rows as $row)
    {
        $data[]=$row;
        $no=$no+1;
    }

    // Process encription data
    $dataGet=json_encode($data);

    // // Process description data
    // $mhs=json_decode($dataGet);
    echo $dataGet;
    // // View with looping use index array
    // for ($i = 0; $i < $no; $i++) {
    //     echo $mhs[$i]->nama; 
    //     echo"<br>";
    //   }


?>