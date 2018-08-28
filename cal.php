<?php

//DB connection

//generate unique alpha numeric code


//Unique generated code will be inserted in DB.

//"INSERT INTO orders_tbl (id, reference, ) VALUES ('".$refrence."));

    
function setTractionDetails()
{
    $refrence = substr(MD5(time()),$len=22);

    if (empty($_POST["amt"])) {
        $error["amt"] = "Please Input Amount.";
        $amount = "" ;
    } else {
        $amount = $_POST['amt'];
    }
    if ($amount <= 2000) {
        $charges = (0.015 * $amount);
    } else {
        $charges = (0.015 * $amount) + 100;
    }
    if ($charges > 2000) {

        $charges = 2000 ;
    }

    $total = $amount + $charges;
    
    echo json_encode(['amount'=>$amount, 'total'=>$total, 'charges'=>$charges, 'ref'=>$refrence]);

    $con=mysqli_connect("localhost","B_VAS","Admin","vas_db");

    mysqli_query($con,"INSERT INTO `orders_tbl` (`id`, `charges`, `reference`, `amount`, `total`, `payment_status`, `payment_date`) VALUES ('','".$charges."', '".$refrence."','".$amount."', '".$total."', 'Pending', CURRENT_TIMESTAMP)") WHERE id ='';



}

setTractionDetails();



//var_dump($_POST);

// echo "<p style='color:red;Amount:'>".$amount."</p>";

// echo "<br>";
// echo "<p style='color:red;Charges:'>".$charges."</p>";

// echo "<br>";
// echo "<p style='color:red;:'>Total".$total."</p>";

// echo "<br>";

//  showDetails ()

// $costumerDetails = array($amount, $charges, $total);

// 		for($x = 0; $x < 3; $x++) {
//     $data = $costumerDetails[$0];
//     echo json_encode($data) ;
// 		 echo "<br>";
// }
