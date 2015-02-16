<script src="/media/k2/assets/js/jquery-1.8.2.min.js" type="text/javascript"></script>
<script type="text/javascript">

function activ(id)

{




$.ajax({
                        type: "POST",
                        url: "/php.php",
                        data: { action: 'activ', id: id},
                        cache: false,
                        success: function(responce){$('.activ').prop( "checked", false );  $('div[name='+id+']').html(responce); }
                });




}
</script>


<?php
/**
 * @package	AcyMailing for Joomla!
 * @version	4.1.0
 * @author	acyba.com
 * @copyright	(C) 2009-2013 ACYBA S.A.R.L. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?>

<?php

if ($_GET['tab']==1) {winners();}
elseif ($_GET['tab']==3) {akcii();}
else {insert();}
function insert()
{

$today = date(".m.Y"); 
$day = date("d")-1;
if ($day <=9 ) {$day = "0".$day;}

$bday = date("d")-2;
if ($bday <=9 ) {$bday = "0".$bday;}

$adate=$day.$today;
$bdate=$bday.$today;
$tdate=date("d.m.Y");

echo "<form name=form action=/administrator/components/com_helloworld/action.php method=post>
<script src=/administrator/components/com_helloworld/cal.js type=text/javascript></script>

<div style=\"position:relative; float:left\">
Посмотреть победителей 
<a href=/administrator/index.php?option=com_helloworld&tab=1&date=".$tdate."> ".$tdate."</a> ||

<a href=/administrator/index.php?option=com_helloworld&tab=1&date=".$adate."> ".$adate."</a> ||
<a href=/administrator/index.php?option=com_helloworld&tab=1&date=".$bdate."> ".$bdate."</a>

<table border=1>

<tr>


<td>Название</td>

<td>Стартовая цена</td>



<td>Дата</td>




</tr>
";
echo "<tr><td><select name=name>";

$db = &JFactory::getDbo();
        $query = 'SELECT `product_id` FROM `r4int_jshopping_products` ';
        $db->setQuery($query);
		
	
$query_pag_data = $db->loadAssocList();

foreach($query_pag_data as $row) 
{
echo "<option value=".$row[product_id].">";

        $query = 'SELECT `name_ru-ru` FROM `r4int_jshopping_products` WHERE `product_id` LIKE '.$row[product_id].' ';
        $db->setQuery($query);
$sql = $db->loadResult();



echo $sql."</option>";

}

$user =& JFactory::getUser();
if ($user==null){$user=01;}
echo"
</select></td>


<input type=hidden name=user value=".$user.">
<td><input type=text name=price_start></td>
<td><input type=text name=date onclick=\"javascript:openCalendar('params', 'form', 'date', date)\"></td>
";



echo"
</tr><tr><td><input type=\"submit\" /></td></tr>
</table>
</form>

<a href=http://www.rozy.kiev.ua/administrator/index.php?option=com_helloworld&tab=3>Акции</a>
</div>";




echo "
<div style=\"position:relative; float:right\">

<table  border=1>
<tr>

<td>№</td>

<td>Название</td>

<td>Стартовая цена</td>

<td>Финальная цена</td>

<td>Дата</td>

<td>Победитель</td>


</tr><tr>

";


$db = &JFactory::getDbo();
        $query = 'SELECT * FROM `r4int_auction`  ORDER BY `r4int_auction`.`date` DESC
LIMIT 0 , 30';
        $db->setQuery($query);
$query_pag_data = $db->loadAssocList();
$rowsAGprov = $db->getNumRows();

foreach($query_pag_data as $row) {
echo "<tr><td> ".$row[id]." </td>";


        $query = 'SELECT `name_ru-ru` FROM `r4int_jshopping_products` WHERE `product_id` LIKE '.$row[id_tov].' ';
        $db->setQuery($query);
$sql = $db->loadResult();

echo"
<td>".$sql."</td>
<td>".$row[price_start]."</td>
<td>".$row[price_last]."</td>
<td>".$row[auction_date]."</td>

<td>".$row[id_client_last]."</td></tr>";
	}



echo "</table></div>";
}
function winners()
{
$auction_date=$_GET['date'];

echo "
<div style=\"position:relative; float:left\">
<a href=/administrator/index.php?option=com_helloworld>Планировщик</a>
<table border=1>

<tr>

<td>Пользователь</td>
<td>Ставка</td>
<td>Дата</td></tr>";
$q="SELECT * FROM `r4int_auction_users` WHERE `auction_date` = \"".$auction_date."\"  ORDER BY `r4int_auction_users`.`date` DESC LIMIT 0 , 30";
$db = &JFactory::getDbo();
        $query =$q;
        $db->setQuery($query);
$query_pag_data = $db->loadAssocList();
$rowsAGprov = $db->getNumRows();
foreach($query_pag_data as $row) {
echo "<tr>";


        $query = 'SELECT `name` FROM `r4int_users` WHERE `id` = '.$row[id_user].' ';
        $db->setQuery($query);
$sql = $db->loadResult();

echo"
<td><a href=/administrator/index.php?option=com_users&task=user.edit&id=".$row[id_user]." >".$sql."</a></td>
<td>".$row[bit]."</td>
<td>".$row[date]."</td>
</tr>";
	
	}
echo "</table>




</div>";







}
function akcii()

{

echo '



<form name="upload" method="post" enctype="multipart/form-data">
<div >Название: <input type="text" name="title" /></div>

<div>Основной текст: <textarea name="main_text"></textarea></div>
<div>Выбрать файл: <input type="file" name="file_upload" /></div>
<div><input type="submit" value="загрузить" /></div>
</form>';
/*
INSERT INTO `pit_viva`.`r4int_akcii` (`id`, `date_start`, `date_finish`, `title`, `main_text`, `img`) 

VALUES (NULL, '2015-02-06', '2015-02-28', 'акция "сладкий подарок"', 

'При покупке любого сердца из 101 розы, Вы получаете в подарок набор капкейков "with love", 

букет можно выбрать на нашем сайте или заказать исходя из Ваших пожеланий. Очень актуально на 14 февраля.', 

'akciya.png');
*/

echo $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
 echo $main_text = filter_input(INPUT_POST, 'main_text', FILTER_SANITIZE_STRING);



$file = JRequest::getVar('file_upload', null, 'files', 'array');
 
//Import filesystem libraries. Perhaps not necessary, but does not hurt
jimport('joomla.filesystem.file');
 
//Clean up filename to get rid of strange characters like spaces etc
echo $filename = JFile::makeSafe($file['name']);
 
//Set up the source and destination of the file
$src = $file['tmp_name'];
$dest = "/home/pit/rozy.kiev.ua/www/images/". $filename;
 
//First check if the file has the right extension, we need jpg only
if ( strtolower(JFile::getExt($filename) ) == 'png') {
   if ( JFile::upload($src, $dest) ) { echo "ok";

   $insert_q = "INSERT INTO `pit_viva`.`r4int_akcii` (`id`, `title`, `main_text`, `img`) 

VALUES (NULL,  \"".$title."\", \"".$main_text."\", \"".$filename."\")";

$db = &JFactory::getDbo();
        $db->setQuery($insert_q);
$db->query(); 
		echo $insert_q;
   
      //Redirect to a page of your choice
   } else {
   echo "error";
      //Redirect and throw an error message
   }
} else {

if ($filename!=null){echo "Не правильный формат рисунка!!!";}
   //Redirect and notify user file is not right extension
}





echo "<br>";


$db = &JFactory::getDbo();
        $query = 'SELECT `id`, `activated`, `title`, `main_text`, `img` FROM `r4int_akcii`';
        $db->setQuery($query);
$query_pag_data = $db->loadAssocList();
$rowsAGprov = $db->getNumRows();

echo "
<div style=\"position:relative; float:right\">

<table  border=1>
<tr>

<td>№</td>

<td>Активирован</td>

<td>Название</td>

<td>Основной текст</td>

<td>Банер</td>

</tr><tr>

";
foreach($query_pag_data as $row) {
echo "<tr><td> ".$row[id]." </td>

<td ><div  name=".$row[id]." id=".$row[id].">";
if ($row[activated] == 1){
echo "<input class=\"activ\" type=\"checkbox\" checked=\"checked\" onclick=activ(".$row[id]."); />
</div></td>";}


else {echo "<input class=\"activ\" type=\"checkbox\" onclick=activ(".$row[id]."); />
</div></td>";}


echo"
<td>".$row[title]."</td>
<td>".$row[main_text]."</td>
<td style=width:30%><img src=/images/".$row[img]." style=\"width:100%\"></td>
</tr>";
	}



echo "</table></div>";




}

?>




