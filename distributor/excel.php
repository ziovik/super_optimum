    <?php
    session_start();
    include("inc/db.php");
    
    $output = '<meta http-equiv=Content-Type content="text/html; charset=utf-8">';
    $i = 0;
    if (isset($_POST['export_excel'])) {
      if (isset($_SESSION['login'])) {

       $dist_login= $_SESSION['login'];

       $total = 0;
         $get = "select 

                     com.name as company_name,
                     so.id as order_id,
                     c.name as customer_name,
                     ct.email as customer_email,
                     ct.telephone as customer_telephone,
                     r.name as customer_region,
                     st.name as street_name,
                     ad.index_code as index_code,
                     ad.building as building,
                     ad.house as house,
                     p.name as product_name,
                     p.price as price,
                     p.manufacturer as manufacturer,
                     p.expires as expires,
                     pt.quantity as quantity,
                     ct.telephone as telephone




                  from 
                       distributor d
                       join  credentials crd on crd.id = d.credentials_id
                       join company com on com.id = d.company_id
                       join product p on p.distributor_id = d.id
                       join product_item pt on pt.product_id = p.id
                       join simple_order so on so.cart_id = pt.cart_id
                       join cart crt on crt.id = so.cart_id
                       join customer c on c.id = crt.customer_id
                       join region r on r.id = c.region_id
                       join address ad on ad.id = c.address_id
                       join contact ct on ct.id = c.contact_id
                       join street st on st.id = ad.street_id


                  where crd.login = '$dist_login' ";

                  $run = mysqli_query($con, $get);
                  

                  $rows = mysqli_fetch_array($run);
                 
     





       $output .='
        <div style="text-align:center;">

       <h2 style="text-align:center;">'.$rows['company_name'].' </h2 ><h4 >заказ № '.$rows['order_id'].'</h4>
       </div>
       <div>
       <p>От "'.$rows['customer_name'].'" </p>
       <table>
           <tr>
             <td>Контактное лицо:</td>
             <td style="padding-left:100px;"><h4 > '.$rows['customer_name'].'<br> '.$rows['customer_email'].', '.$rows['telephone'].'</h4></td>
           </tr>
       </table>
       <br>
      <table>
           <tr>
              <td>Адрес Доставки:</td>
              <td style="padding-left:100px;"><h4>'.$rows['customer_region'].'<br> ул.: '.$rows['street_name'].', дом: '.$rows['building'].', кв. : '.$rows['house'].', почтовой адресс: '.$rows['index_code'].'</h4></td>

       </tr>
       </table>

       </div>
       <br>
       
       <table class="table" style= "font-family: arial, sans-serif; border-collapse: collapse; width: 100%;">
       <tr>
          <th style="border: 1px solid #dddddd; text-align: left; padding: 8px; width:300px;">наименование</th>
          <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Производитель</th>
          <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">годен_до</th>
          <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Цена</th>
          <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">количество</th>
          <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Cумма</th>
       </tr>

       ';



            $output .= '
            
            <tr >

            <td style="border: 1px solid #dddddd; text-align: left; padding: 8px; width:300px;">'.$rows['product_name'].'</td>

            <td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">'.$rows['manufacturer'].'</td>
            <td style="width : 200px; text-align:center;"">'.$rows['expires'].'</td>
            <td style="width : 200px; text-align:center;"">'.$rows['price'].'</td>
            <td style="width : 100px; text-align:center;"">'.$rows['quantity'].'</td>
            <td style="width : 100px; text-align:center;"">'.($rows['quantity']) * ($rows['price'] ).'</td>

            </tr>
            ';
    
        $output .= '</table>';

        
        header("Content-Disposition: attachment; filename=download.cvs");

        echo $output;

      
     
      }

   } 
?>