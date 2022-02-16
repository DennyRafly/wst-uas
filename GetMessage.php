<?php

    // Call file in line
    include 'Database.php';

    // Create object / instance
    $db = new Database();
    $con=$db->Connect();

    $nis=$_GET['nis'];
    $from=$_GET['from'];
    // Process GET query
    $rows=mysqli_query($con,"select * from message inner JOIN mahasiswa ON mahasiswa.nis=message.from_nis where message.from_nis = ".$from." and message.to_nis = ".$nis."  or message.from_nis = ".$nis." and message.to_nis = ".$from." order by message.id desc");
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