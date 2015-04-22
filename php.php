<?php
include_once "extra.php";
switch ($_GET['act']){

case "buy":
$id_tov=$_GET['id'];
$user_name=$_GET['name'];
$user_phone=$_GET['phone'];

$date=date("D.d.m.Y.G.i.s");

$conv = conv_date($date);

$email2="sergpavlov89@gmail.com";
$email3="kondrashov.artem@gmail.com";
$email="soldflowers@gmail.com";
$get_product_name=mysql_query("

SELECT `name_ru-ru`, `product_price`
FROM `r4int_jshopping_products`
WHERE `product_id` LIKE '".$id_tov."'
LIMIT 0 , 1

");


list ($product_name, $product_price) = mysql_fetch_row($get_product_name);


$headers = 'From: Розы Киева <info@rozy.kiev.ua>' . "\r\n" .
    'Reply-To: info@rozy.kiev.ua' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();


mail("".$email."", "".$product_name."", "С мобильного приложения\nДата: ".$conv."  \nИмя: ".$user_name." \nТелефон: ".$user_phone." \nЦена: ".number_format($product_price, 0, ',', ' ')." грн ", $headers);

mail("".$email3."", "".$product_name."", "С мобильного приложения\nДата: ".$conv."  \nИмя: ".$user_name." \nТелефон: ".$user_phone." \nЦена: ".number_format($product_price, 0, ',', ' ')." грн ", $headers);

mail("".$email2."", "".$product_name."", "С мобильного приложения\nДата: ".$conv."  \nИмя: ".$_POST['user_name']." \nТелефон: ".$phone." \nЦена: ".number_format($product_price, 0, ',', ' ')." грн ", $headers);

break;

 case "call_back":
$user_name=$_GET['name'];
$user_phone=$_GET['phone'];
$req_time=$_GET['time'];



$date=date("D.d.m.Y.G.i.s");

$conv = conv_date($date);

$headers = 'From: Розы Киева <info@rozy.kiev.ua>' . "\r\n" .
    'Reply-To: info@rozy.kiev.ua' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
$email3="kondrashov.artem@gmail.com";
$email2="sergpavlov89@gmail.com";
$email="soldflowers@gmail.com";

mail("".$email."", "Запрос звонка с мобильного приложения", "Дата: ".$conv."  \nИмя:".$user_name." \nТелефон: ".$phone." \nЖелаемое время: ".$req_time.". ", $headers);
mail("".$email3."", "Запрос звонка с мобильного приложения", "Дата: ".$conv."  \nИмя:".$user_name." \nТелефон: ".$phone." \nЖелаемое время: ".$req_time.". ", $headers);
mail("".$email2."", "Запрос звонка с мобильного приложения", "Дата: ".$conv."  \nИмя:".$user_name." \nТелефон: ".$user_phone." \nЖелаемое время: ".$req_time.". ", $headers);
break;
}




switch ($_POST['action']){


case  "open_art":

$id=$_POST['id'];

$open_art=mysql_query("SELECT `title`, `main_text`, `img` FROM `r4int_akcii` WHERE `id` LIKE '$id'");

list ($title, $main_text, $img) = mysql_fetch_row($open_art);

echo'
<div style="font-family: lobster; color: #000;">
<div style="text-align: center; font-size: 30px; margin-bottom: 20px;"><span style="color: #09bf47;">'.$title.'</span></div>
<div><img style="width: 635px; height: 145px;" src="/images/'.$img.'" alt="akciya" /></div>
<div style="text-align: justify;"><span style="font-size: 14pt; font-family: \'times new roman\', times;">'.$main_text.'</span></div>
</div>';

break;



case  "activ":

$id=$_POST['id'];

$drop_activ=mysql_query("UPDATE `r4int_akcii` SET `activated` = '0'");
$set_activ=mysql_query("UPDATE `r4int_akcii` SET `activated` = '1' WHERE `id` LIKE '$id'");

echo "<input class=\"activ\" type=\"checkbox\" checked=\"checked\" onclick=activ(".$id."); />";
break;



case "phone_go":




$phone=$_POST['phone'];
$name=$_POST['name'];
$req_time=$_POST['date_zap'];

$date=date("D.d.m.Y.G.i.s");

$conv = conv_date($date);

$headers = 'From: Розы Киева <info@rozy.kiev.ua>' . "\r\n" .
    'Reply-To: info@rozy.kiev.ua' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
$email2="sergpavlov89@gmail.com";
$email="soldflowers@gmail.com";


mail("".$email."", "Запрос звонка", "Дата: ".$conv."  \nИмя:".$name." \nТелефон: ".$phone." \nЖелаемое время: ".$req_time.". ", $headers);

echo "<div style=\"margin:10px 10px 10px 10px\">Спасибо за заявку, в ближайшее время с Вами свяжется менеджер</div>

";

break;


case "phone_zap":

$user_name=$_POST['user_name'];
$phone=$_POST['phone'];

echo "


<div>

<span style=\"font-weight: bold; font-size: 16px; text-transform: uppercase;\">заказать звонок</span><br>
<div><span id=\"err_name\" style=\"color:#000\">*</span><span>Ваше имя</span>
<input type=text onmouseout=\"phone()\" name=name_zap value=".$user_name."></div>
<div><span id=err_phone style=\"color:#000\">*</span><span>Ваш телефон</span>
<input type=text onmouseout=\"phone()\" name=phone_zap value=".$phone."></div>
<div><span>желаемое время звонка</span>
<input type=text name=\"date_zap\" id=\"date_zap\"   onclick=\"document.getElementById('date_zap').value=''\" onblur=\"bluri();\"   value=\"сейчас\" ></div>
<div id=\"eror\" style=\"text-align:center; font-size:10px; color:#f00;\"></div>
<button id=btn disabled class=\"button_popup\" onclick=\"phone_go()\">заказать звонок</button>

</div>



";
break;


case "left":

$product_id=$_POST['product_id'];
$order=$_POST['order'];
$path=$_POST['path'];
if ($path == null){$path="/components/com_jshopping/files/img_products"; }
$get_num_image=mysql_query("

SELECT `image_full` FROM `r4int_jshopping_products_images`
WHERE `product_id` LIKE '".$product_id."'");
$rows=mysql_num_rows($get_num_image);

if($order<=1){$order=$rows;}






else {$order=$order-1;}

$get_full_image=mysql_query("

SELECT `image_full` , `ordering`
FROM `r4int_jshopping_products_images`
WHERE `product_id` LIKE '".$product_id."'
AND `ordering` LIKE '".$order."'

");


list ($image_full, $order) = mysql_fetch_row($get_full_image);

echo "<img id=slider_img src=\"".$path."/".$image_full."\">

<div class=\"left_side\" onclick=left(".$order.")><div class=arrow_left onclick=left(".$order.")></div></div>

<div class=\"right_side\" onclick=right(".$order.")><div class=arrow_right onclick=right(".$order.")></div></div>

<input type=hidden name=\"order\" value=".$order.">";


break;


case "right":

$product_id=$_POST['product_id'];
$order=$_POST['order'];
$path=$_POST['path'];

if ($path == null){$path="/components/com_jshopping/files/img_products"; }

$get_num_image=mysql_query("

SELECT `image_full` FROM `r4int_jshopping_products_images`
WHERE `product_id` LIKE '".$product_id."'");
$rows=mysql_num_rows($get_num_image);

if ($order==$rows)

{$order=1;}

else 

{$order=$order+1;}

$get_full_image=mysql_query("

SELECT `image_full` , `ordering`
FROM `r4int_jshopping_products_images`
WHERE `product_id` LIKE '".$product_id."'
AND `ordering` LIKE '".$order."'

");


list ($image_full, $order) = mysql_fetch_row($get_full_image);

echo "<img id=slider_img src=\"".$path."/".$image_full."\">

<div class=\"left_side\" onclick=left(".$order.")><div class=arrow_left onclick=left(".$order.")></div></div>

<div class=\"right_side\" onclick=right(".$order.")><div class=arrow_right onclick=right(".$order.")></div></div>
<input type=hidden name=\"order\" value=".$order.">
<input type=hidden name=\"rows\" value=".$rows.">";


break;


case "little_slider":
		$image_id=$_POST['image_id'];
$product_id=$_POST['product_id'];
$path=$_POST['path'];
$image_full=$_POST['image_full'];
if ($path == null){$path="/components/com_jshopping/files/img_products"; }

$get_full_image=mysql_query("

SELECT `image_full` 
FROM `r4int_jshopping_products_images`
WHERE `image_id` LIKE '".$image_id."'

");


list ($image_full) = mysql_fetch_row($get_full_image);



echo $path."/".$image_full;



break;



                
		case "slider":		

		$image_id=$_POST['image_id'];
$product_id=$_POST['product_id'];
$path=$_POST['path'];
$image_full=$_POST['image_full'];

if ($path == null){$path="/components/com_jshopping/files/img_products"; }

$get_full_image=mysql_query("

SELECT `image_full`, `ordering`
FROM `r4int_jshopping_products_images`
WHERE `image_id` LIKE '".$image_id."'

");


list ($image_full, $order) = mysql_fetch_row($get_full_image);

		
echo "
<div>
<div id=error></div>
<input type=hidden value=".$product_id." name=product_id>

<div id=\"slider_div\" style=\"background-image:url(''); width: 500px; height: 500px; margin-bottom:5px\" >

<img id=slider_img src=\"".$path."/".$image_full."\">

<div class=\"left_side\" onclick=left(".$order.")><div class=arrow_left onclick=left(".$order.")></div></div>

<div class=\"right_side\" onclick=right(".$order.")><div class=arrow_right onclick=right(".$order.")></div></div>
<!--<div style=\"position:absolute; margin-top:50%\"><</div>
<div style=\"position:absolute; margin-top:50%; right:0px\">></div>--></div>


";



$get_thumb_image=mysql_query("SELECT `image_thumb`, `image_full`
FROM `r4int_jshopping_products_images`
WHERE `product_id` LIKE '".$product_id."'");

$rows=mysql_num_rows($get_thumb_image);

if ($rows==0)
{echo "--";}

$i=0;

$width=$rows*80;
$margin=250-($width/2)+2.5;
echo "<div name=obertka style=\"width:".$width."px; margin: 0px auto;\" id=".$margin."><center>";
while(list($image_thumb, $image_full) = mysql_fetch_row($get_thumb_image))
          {
          $i++;
           echo "
		   <div style=\"float:left; text-align:center;\">
<img title=".$i." onclick=\"document.getElementById('slider_img').src = '".$path."/".$image_full."'\" 
style=\"margin: 5px 5px 5px 5px; width:70px\" src=\"".$path."/".$image_thumb."\">
</img>
</div>
";
           
		  }


echo"</center></div>



</div>";
				
		break;		
				
				
        case "cart_ok":


$product_id=$_POST['product_id'];

$phone=$_POST['phone'];



$date=date("D.d.m.Y.G.i.s");

$conv = conv_date($date);

$email="sergpavlov89@gmail.com";
$email2="soldflowers@gmail.com";
$get_product_name=mysql_query("

SELECT `name_ru-ru`, `product_price`
FROM `r4int_jshopping_products`
WHERE `product_id` LIKE '".$_POST['product_id']."'
LIMIT 0 , 1

");


list ($product_name, $product_price) = mysql_fetch_row($get_product_name);


$headers = 'From: Розы Киева <info@rozy.kiev.ua>' . "\r\n" .
    'Reply-To: info@rozy.kiev.ua' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();




mail("".$email."", "".$product_name."", "Дата: ".$conv."  \nИмя: ".$_POST['user_name']." \nТелефон: ".$phone." \nЦена: ".number_format($product_price, 0, ',', ' ')." грн ", $headers);

mail("".$email2."", "".$product_name."", "Дата: ".$conv."  \nИмя: ".$_POST['user_name']." \nТелефон: ".$phone." \nЦена: ".number_format($product_price, 0, ',', ' ')." грн ", $headers);



echo "<div style=\"margin:20px 0px 20px 45px\">Спасибо за заказ, в ближайшее</div>
      <div style=\"margin:20px 0px 20px 40px\">время с Вами свяжется менеджер</div>

";
/*
mail("".$email."", "Новый заказ", "Пользователь ".$_POST['user_name']." с номером телефона ".$phone." сделал заказ - ".$product_name." \nДата: ".$date."");
$result = mysql_query("INSERT INTO `pit_viva`.`r4int_auction_users` 

(`id_user`, `bit`, `auction_date`) 

VALUES ('$user', '$bit', '$date');");
*/

break;


case "load_popup":

if ($_POST['product_id'] == "a")
{
echo "<div style=\"margin-top: 10px;\"><span style=\"margin-left:25px\">МНЕ ИЗВЕСТНЫ ПРАВИЛА АУКЦИОНА</span></div>
<div style=\"margin: 15px 0px 10px 1px\">
<button class=\"button_popup\" onclick=\"window.open('/skidki/auktsion')\">Читать Правила</button>
<button class=\"button_popup\" onclick=\"bit()\">Ставку подтверждаю</button></div>";
}


else {
$get_product_name=mysql_query("

SELECT `name_ru-ru`, `product_price`
FROM `r4int_jshopping_products`
WHERE `product_id` LIKE '".$_POST['product_id']."'
LIMIT 0 , 1

");


list ($product_name, $product_price) = mysql_fetch_row($get_product_name);




echo"
<div id=pop_card>
<center><h1>ПОДТВЕРДИТЕ ВАШ ЗАКАЗ - ".$product_name." </h1>

 <b>ценa: ".number_format($product_price, 0, ',', ' ')." грн.</b></center> 
<input type=hidden name=\"product_name\" value=\"".$product_name."\">";




$get_user_data=mysql_query("SELECT `name`, `phone` FROM `r4int_users` WHERE `id` = '".$_POST['userid']."'");
list ($user_name, $user_phone) = mysql_fetch_row($get_user_data);
echo"
<div style=\"margin-top: 20px;\" align=\"center\" ><lable>*Ваше имя:</lable><br>
<input style=\"margin-top:10px\" type=text name=\"name_zap\" value=".$user_name."></div>


<div align=\"center\" 

><label>*Ваш телефон: </lable><br>
<input type=text onmouseout=\"phone()\" name=\"phone_zap\" value=\"".$user_phone."\" title=\"Формат телефона: 09312345678\"></div>
<div id=\"eror\" style=\"text-align:center; font-size:10px; color:#f00;\"></div>
<div style=\"position: relative;
bottom: 2%;
margin-left: 119px; margin-bottom:10px; margin-top:10px\">
<button id=\"btn\" disabled style=\"margin-left:-6px!important; \" class=\"button_popup\" onclick=\"cart_ok(".$_POST['product_id'].")\">заказать</button><div>

</div>
";

}
break;


case "bit":


if ($_POST['date1']==null)             
      
{echo "-1-";}
else
{

$last_price=0;
$user=$_POST['user_id'];
$bit=$_POST['bit'];

$sql=mysql_query("SELECT `price_last` FROM `r4int_auction` WHERE `auction_date` LIKE '".$_POST['date1']."' " );
list ($last_price) = mysql_fetch_row($sql);


if ($_POST['bit'] < $last_price+1) {header("Location: http://viva.kiev.ua");}
else {
$date=$_POST['date1'];

$sql_user=mysql_query("SELECT `id_user`
FROM `r4int_auction_users`
WHERE `auction_date` = '".$date."'
ORDER BY `r4int_auction_users`.`date` DESC
LIMIT 0 , 1");


list ($user_id) = mysql_fetch_row($sql_user);


$sql1 = "UPDATE `pit_viva`.`r4int_auction` SET `price_last` ='$bit', `id_client_last` = '$user'  WHERE `r4int_auction`.`auction_date` LIKE '$date'"; 
$sql2 = "INSERT INTO `pit_viva`.`r4int_auction_users` (`id_user`, `bit`, `auction_date`) VALUES ('$user', '$bit', '$date');";


$result = mysql_query($sql1);
$result2 = mysql_query($sql2);

$sql_user=mysql_query("SELECT `name` FROM `r4int_users` WHERE `id` = '".$user."'");


list ($name) = mysql_fetch_row($sql_user);






$sql_user=mysql_query("SELECT `email` FROM `r4int_users` WHERE `id` = '".$user_id."'");


list ($email) = mysql_fetch_row($sql_user);

$headers = 'From: Розы Киева <info@rozy.kiev.ua>' . "\r\n" .
    'Reply-To: info@rozy.kiev.ua' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();


mail("".$email."", "Ставка перебита", "Пользователь ".$name." сделал ставку - ".$bit." грн. в аукционе в котором Вы принимаете участие за ".$date."\nНе упустите свой шанс!", $headers);

mail("soldflowers@gmail.com", "Ставка перебита", "Пользователь ".$name." сделал ставку - ".$bit." грн. в аукционе в котором Вы принимаете участие за ".$date."", $headers);



echo "<div style=\"margin: 20px 80px 15px 75px\">Ваша ставка принята</div>";

//mysqloff();


/*
$sql="UPDATE `r4int_auction` SET `price_last` ='$bit', `id_client_last` ='$user' WHERE `auction_date` LIKE '$date'";


$sql="SELECT `price_last` FROM `r4int_auction` WHERE `auction_date` LIKE '$date' " ;

 $result = mysql_query($sql);



   
while(list($data['price_last']) = mysql_fetch_array($result))
          {
           
           echo $data['price_last'];
           
		  }



if (!mysql_query($sql1,$con))

  {

  die('Error: ' . mysql_error());

  }

echo "Запись успешно добавлена2";

 

mysql_close($con)*/

}

}



//mysqlon();








}


?>
