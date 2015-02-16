

<?php include "js.php"; ?>




<?php
    defined('_JEXEC') or die('Restricted access');
    // Подключение файла helper.php
    require_once dirname(__FILE__).'/helper.php';
    // берем параметры из файла конфигурации
    $user_count = $params->get('usercount');
    // берем items из файла helper
    $items = ModMymodulHelper::getItems($user_count);
    // Эти параметры вводятся в административной панели в управлении модулем
    // И отвечает за показ количества пользователей
    $name_count = $params->get('name_count');
    // включение шаблона для отображения
    require(JModuleHelper::getLayoutPath('mod_name'));
	
function auction()

{

	
echo '<table class=auction>';


 $today = date(".Y");
 
 $month=date("n");
 if ($month<=9){$month=".0".$month;}
 
$day = date("j");
if ($day<=9){$day="0".$day;}
$date1= '"'.$day.$month.$today.'"';

$db = &JFactory::getDbo();
        $db->setQuery('SELECT `id_tov`
FROM `r4int_auction`
WHERE `auction_date` = '.$date1.'');
$replyAGprov = $db->query();
$rowsAGprov = $db->getNumRows();
if ($rowsAGprov ==0){echo "<center><tr><td><h1>Аукцион</h1></td></tr><tr><td>На техническом перерыве</td></tr></center></table>";}
else {

        $result = $db->loadResult();




/*
$result=mysql_query("SELECT `id_tov` FROM `r4int_auction`");

while(list($id_tov)= mysql_fetch_row($result))*/

$db = &JFactory::getDbo();
        $db->setQuery('SELECT `name_ru-RU`
FROM `r4int_jshopping_products`
WHERE `product_id` ='.$result.' ');
        $product_title = $db->loadResult();

echo "<tr style=\"height: 82px;\"><td colspan=2  style=\"font-size:16px; vertical-align:bottom\"><a href=/skidki/auktsion>".$product_title."</a></td></tr>";

/*
$result=mysql_query("SELECT `temp1` , `id_modul` , `date` FROM `temp` ORDER BY `date` DESC LIMIT 1 ");
while(list($temp, $id_modul, $date)= mysql_fetch_row($result))
echo "Модуль № ".$id_modul." <br>Температура: <div class=\"block1\">".$temp."</div> <br>Обновлено <div class=\"block2\">".$date;

r4int_users


*/




$db = &JFactory::getDbo();
        $db->setQuery('SELECT `product_thumb_image`
FROM `r4int_jshopping_products`
WHERE `product_id` ='.$result.' ');
        $img = $db->loadResult();

echo "<tr><td colspan=2><a  href=/skidki/auktsion><img  style=\"max-width:100% !important; width:250px; height:auto;\" src=/components/com_jshopping/files/img_products/".$img." ></img></a></center></td></tr>";


/*
$p="";
 $today = date(".n.Y"); 
$day = date("j")+1;
$date=$day. $today;*/

$time = time();
$fin=date("Y-m-d")." 20:00";
$timeFINISH = strtotime($fin);
$timeDIFF = $timeFINISH - $time;


echo "

<tr><td colspan=2><b>до конца аукциона осталось:</b></td></tr>
<script src=\"/1.7.2_jquery.min.js\"></script>



<script type=\"text/javascript\">

   
       timer = function()
    {
        
		var time_to = document.getElementById('timer');
        time_to.innerHTML--;
        if(time_to.innerHTML >= 0)
        {
            var dsec = time_to.innerHTML % 60;
            var dmin = ((time_to.innerHTML - dsec) % 3600)/60;
                var dhour = ((time_to.innerHTML - dsec - dmin*60)/3600) % 24;
            var dday = (time_to.innerHTML - dsec - dmin*60 - dhour*3600)/86400;
            if(dday % 10 === 1 && dday !== 11)
                dday = dday + \" день, \";
            else if(dday % 10 === 2 && dday !== 12)
                dday = dday + \" дня, \";
            else if(dday % 10 === 3 && dday !== 13)
                    dday = dday + \" дня, \";
            else if(dday % 10 === 4 && dday !== 14)
                dday = dday + \" дня, \";
            else
                dday = dday + \" дней, \";
                if(dhour < 10)
                dhour = \"0\" + dhour;
            if(dmin < 10)
                dmin = \"0\" + dmin;
            if(dsec < 10)
                dsec = \"0\" + dsec;
            document.getElementById(\"time\").innerHTML = \"<br>00\" + \":\" + dhour + \":\" + dmin + \":\" + dsec;
        }
        else
        {
            document.getElementById(\"text\").innerHTML = \"Отсчет закончен :)\";
            document.getElementById(\"time\").innerHTML = \"\";
        }
        setTimeout(timer, 1000);
    }
   
         $(document).ready(function(){
         timer();
        });
    </script>

<tr style=\"height:30px\"><td colspan=2 cellpadding=\"7\">
<div id=\"timer\" style=\"display:none\">".$timeDIFF."</div><!--Время в секундах до финальной точки-->
    
	<div id=\"time\" style=\"font-size:30px; vertical-align:bottom; margin-top:-3px\"></div>
    <div id=\"text\"></div>
    <div id=\"time_to\"></div></td></tr>



";





/*
$db = &JFactory::getDbo();
        $db->setQuery('SELECT `product_price`
FROM `r4int_jshopping_products`
WHERE `product_id` ='.$result.' ');
        $product_price = $db->loadResult();
*/


/*
echo"
<tr><td style=\"background-color:#C31D1D\" height=60px><font color=#fff>Аукционная цена:".($product_price*$product_price)/$product_price."</td></tr>";

*/
$db = &JFactory::getDbo();
        $db->setQuery('SELECT `price_last`
FROM `r4int_auction`
WHERE `auction_date` ='.$date1.' ');
        $last_price = $db->loadResult();


echo "<tr height=64px ><td  style=\"background-color:#C31D1D\" width=50%><br><font color=\"#fff\">аукционная цена:<div name=price style=\"margin-bottom: 7px; margin-top: -7px; font-size:22px; font-color:#fff; font-family: Oswald;\"> <br>";
echo $last_price;

echo " грн.</font></div></td>";
$user = &JFactory::getUser();
$id = $user->id;
echo "<input type=hidden name=date1 value=".$date1.">
<input type=hidden name=user value=".$id.">
<input type=hidden name=last_price value=".$last_price.">";


$user =& JFactory::getUser();
        if ($user->guest) {echo "<tr>
<td colspan=2><br>для принятия участия, <a href=/registration-form>зарегистрируйтесь</a> <br>или войдите</td></tr></table>";}
else {


$llast_price=$last_price+1;
echo"

<td style=\"background-color:#c0c0c0\"><input type=text   name=bit value=".$llast_price." style=\"width:30px!important; height:15px !important; margin-bottom: 3px; margin-top: 3px;\">


<button class=\"button_popup\" onclick=\"loadPopup('a')\" style=\"margin-bottom: 3px; margin-left:0px!important; font-size:11px\" title=\"Минимальная ставка ";

echo $llast_price." грн.";

echo"\" 
 >сделать ставку</button></td></tr>




</table>

";
}
}
}

$time_on="00:15:00";
if (date("H:i:s") > $time_on)
{auction();}

else {echo "<br><br><br><center><h1>Аукцион</h1><br><br>На техническом перерыве<b></center>";}


?>






