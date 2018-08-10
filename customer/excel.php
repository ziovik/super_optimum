<?php
session_start();
include("inc/db.php");


$output = '<meta http-equiv=Content-Type content="text/html; charset=utf-8">';
$i = 0;

if (isset($_SESSION['login'])) {
	$login = $_SESSION['login'];

$get_info = "select
                          cc.name as name,
                          cc.id as customer_id
                    from 
                       credentials c
                       join customer cc on cc.credentials_id = c.id
                    where  c.login = '$login' ";

                    $run_name = mysqli_query($con, $get_info);

                    $row = mysqli_fetch_array($run_name);

                    $customer_id = $row['customer_id'];

if (isset($_POST['export_excel'])) {
	$sql = "select 
                 pt.quantity as quantity,
                 cm.name as company_name,
                 p.name as product_name,
                 c.status as status,
                 cc.name as customer_name


	         from 
	              cart c 
                  join product_item pt on pt.cart_id = c.id
                  join product p on p.id = pt.product_id
                  join distributor d on d.id = p.distributor_id
                  join company cm on cm.id = d.company_id
                  join customer cc on cc.id = c.customer_id
	         where c.customer_id= '$customer_id' ";

	$result = mysqli_query($con, $sql);
	if (!$result) {
             printf("Error: %s\n", mysqli_error($con));
            exit();
           }/// helps to check error


	$i++;
    

	if (mysqli_num_rows($result) > 0) {
		$output .='
		       <h2 style = "text-align: center">Your orders</h2>
              <table class="table" bordered = "2">
                   <tr>
                     <th style="width : 500px;">Product Name</th>
  		             <th style="width : 100px;">Quantity</th>
  		             <th style="width : 200px;">Distributor</th>
  		             <th style="width : 100px;">Status</th>
                   </tr>
              
		';


		while ($row = mysqli_fetch_array($result)) {

			$qty = $row['quantity'];
			$product_name = $row['product_name'];
			$customer_name = $row['customer_name'];
			$dist_name = $row['company_name'];
			$status = $row['status'];
           

           	

			$output .= '


                        <tr>

                           <td style="width : 500px; text-align:center;">'.$row['product_name'].'</td>
                           <td style="width : 50px; text-align:center;"">'.$row["quantity"].'</td>
                           <td style="width : 200px; text-align:center;"">'.$row['company_name'].'</td>
                           <td style="width : 100px; text-align:center;"">'.$row["status"].'</td>

                        </tr>
			';
		} 
     }
   }

		$output .= '</table>';

		header("Content-Type: text/cvs; charset=utf-8");
		header("Content-Disposition: attachment; filename=download.cvs");
		echo $output;
	}



?>