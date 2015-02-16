<META HTTP-EQUIV="Refresh" CONTENT="3; URL=http://rozy.kiev.ua/administrator/index.php?option=com_helloworld">
<?php
	include "extra.php";





if ($_POST['date1']==null)             
      
{echo "-1-";}
else
{

$last_price=0;
echo $user=$_POST['user'];
echo "-".$bit=$_POST['bit'];

$sql=mysql_query("SELECT `price_last` FROM `r4int_auction` WHERE `auction_date` LIKE '".$_POST['date1']."' " );
list ($last_price) = mysql_fetch_row($sql);


if ($_POST['bit'] < $last_price+1) {header("Location: http://viva.kiev.ua");}
else {
echo "-".$date=$_POST['date1'];

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

mail("".$email."", "Ставка перебита", "Пользователь ".$name." сделал ставку - ".$bit." грн. в аукционе в котором Вы принимаете участие за ".$date."\nНе упустите свой шанс!", "From: webmaster@".$SERVER_NAME."", "-fwebmaster@".$SERVER_NAME."");


//mysqloff();

header("Location: http://viva.kiev.ua/#auction");
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


if ($_POST['name']==null)
{
die;

} 

$sql="INSERT INTO `pit_viva`.`r4int_auction` (`id`, `id_tov`, `auction_date`, `price_start`, `price_last`, `id_client_last`, `date`) 

VALUES (NULL, '$_POST[name]', '$_POST[date]', '$_POST[price_start]', '$_POST[price_start]', '$_POST[user]', CURRENT_TIMESTAMP)";

 

if (!mysql_query($sql,$con))

  {
echo $_POST['date']."-".$_POST['name']."-".$_POST['price_start'];
  die('Error-2-: ' . mysql_error());

  }

echo "Запись успешно добавлена";

 
//mysqloff();

?>
