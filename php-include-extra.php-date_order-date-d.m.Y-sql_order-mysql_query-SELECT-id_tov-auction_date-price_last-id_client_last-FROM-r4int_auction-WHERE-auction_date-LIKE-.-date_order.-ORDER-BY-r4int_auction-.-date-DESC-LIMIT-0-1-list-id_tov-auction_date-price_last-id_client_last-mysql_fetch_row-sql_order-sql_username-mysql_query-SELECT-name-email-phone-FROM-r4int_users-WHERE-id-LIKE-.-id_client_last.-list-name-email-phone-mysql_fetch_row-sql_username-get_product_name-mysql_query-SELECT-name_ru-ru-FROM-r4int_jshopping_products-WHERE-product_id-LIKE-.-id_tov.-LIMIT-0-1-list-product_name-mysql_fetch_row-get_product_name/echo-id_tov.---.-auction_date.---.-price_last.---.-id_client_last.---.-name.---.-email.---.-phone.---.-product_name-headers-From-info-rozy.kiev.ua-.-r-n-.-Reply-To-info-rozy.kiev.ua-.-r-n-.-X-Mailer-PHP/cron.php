<?php
include "extra.php";


$date_order=date("d.m.Y"); 

$sql_order=mysql_query("SELECT `id_tov`, `auction_date`, `price_last`, `id_client_last` FROM `r4int_auction` WHERE `auction_date` LIKE '".$date_order."' ORDER BY `r4int_auction`.`date` DESC LIMIT 0 , 1");
list ($id_tov, $auction_date, $price_last, $id_client_last) = mysql_fetch_row($sql_order);

$sql_username=mysql_query("SELECT `name` , `email` , `phone` FROM `r4int_users` WHERE `id` LIKE '".$id_client_last."'");

list ($name, $email, $phone) = mysql_fetch_row($sql_username);

$get_product_name=mysql_query("

SELECT `name_ru-ru`
FROM `r4int_jshopping_products`
WHERE `product_id` LIKE '".$id_tov."'
LIMIT 0 , 1

");

list ($product_name) = mysql_fetch_row($get_product_name);


//echo $id_tov."-".$auction_date."-".$price_last."-".$id_client_last."-".$name."-".$email."-".$phone."-".$product_name;


$headers = 'From: Розы Киева <info@rozy.kiev.ua>' . "\r\n" .
    'Reply-To: info@rozy.kiev.ua' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
$email2="soldflowers@gmail.com";



	
mail("".$email."", "Поздравляем с победой!", "

Поздравляем, Вы победили в нашем ежедневном(".$date_order.") интернет-аукционе, в ближайшее время, с Вами свяжутся. Спасибо за участие!

\n".$product_name." за ".number_format($price_last, 0, ',', ' ')." грн ", $headers);

mail("".$email2."", "Победитель аукциона", "Дата: ".$date_order."  \nИмя: ".$name." \nТелефон: ".$phone." \nЦена: ".number_format($price_last, 0, ',', ' ')." грн ", $headers);
$today=date("d.m.Y");



$finish=mysql_query("UPDATE `pit_viva`.`r4int_auction` SET `finished` = '1', `activ` = '0' WHERE `r4int_auction`.`finished` IS NULL AND `r4int_auction`.`finish_date` = '".date("d.m.Y")."';");


$select=mysql_query("SELECT `auction_date` FROM `pit_viva`.`r4int_auction` WHERE `auction_date` LIKE '".date("d.m.Y")."' AND `finished` IS NULL");
list($date)=mysql_fetch_row($select);
echo "--".$date;
if(!isset($date) || $date=0)

{$get=mysql_query("SELECT `id_tov`, `price_start` FROM `pit_viva`.`r4int_auction` WHERE `auction_date` LIKE'".date("d.m.Y")."'");
list($id, $price)=mysql_fetch_row($get);
$insert=mysql_query("INSERT INTO `pit_viva`.`r4int_auction` 
(`id_tov`, `auction_date`, `finish_date`, `activ`, `price_start`, `price_last`) VALUES ('".$id."', '".date("d.m.Y")."','".date("d.m.Y", strtotime("tomorrow"))."', '1', '".$price."', '".$price."');");
echo "goood";
}
else {

	$finish=mysql_query("UPDATE `pit_viva`.`r4int_auction` SET `activ` = '1' 
	WHERE `r4int_auction`.`finish_date` = '".date("d.m.Y", strtotime("tomorrow"))."' AND `r4int_auction`.`auction_date` = '".date("d.m.Y")."';");

	echo"112121";}




?>
