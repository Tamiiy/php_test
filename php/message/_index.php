<?php
//////////////////////sqlOpen-Start//////////////////////
    $dsn = 'mysql:dbname=MessageBoard;host=localhost'; //Data Source Name
    $user = 'root';
    $password = 'camp2014';
    $dbh = new PDO ($dsn, $user, $password); //Data Base Hundle
    $dbh->query('SET NAMES utf8');
//////////////////////sqlOpen-End//////////////////////
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ひとこと掲示板</title>
<style type="text/css">
<!--
.sub {
    font-size:10px;
    color: #aaa;
}
-->
</style>
<script type="text/javascript"><!--
function CountDownLength( idn, str, mnum ) {
   document.getElementById(idn).innerHTML = "あと" + (mnum - str.length) + "文字";
}
// --></script>
</head>
<body>
<h1>ひとこと掲示板</h1>
<p>

<form method="POST" action="index.php">
    名前：<span id="cdlength1" class="sub">あと20文字</span><br/><input type="text" name="name" onkeyup="CountDownLength('cdlength1' , value , 20);"><br/>
    <br/>
    ひとこと：<span id="cdlength2" class="sub">あと200文字</span><br/><textarea name="message" style="width:300px; height:100px;" maxlength="200" onkeyup="CountDownLength('cdlength2' , value , 200);"></textarea><br/>
    <br/>
    <input type="submit" value="送信">
</form>

<?php
//////////////////////MessageBoard-Start//////////////////////
    //MessageOut-Start
    $select = 'SELECT * FROM `message_table` ORDER BY id';
    $stmt = $dbh->prepare($select);
    $stmt->execute();

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    while($rec){
        $list[] = $rec;
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //$list[]にoutすべきデータが入りました
    echo '<ul>';
    foreach ($list as $value) {
         echo '<li>'.$value['name'].'：'.$value['message'].'：'.$value['time'].'</li>';
    }
    echo '</ul>';
    //MessageOut-End

//////////////////////AfterWrite-Start//////////////////////
    if(isset($_POST['name'],$_POST['message'])){

        //MessageIn-Start
        $name = $_POST['name'];
        $gender = $_POST['message'];

        $insert = 'INSERT INTO `message_table`(`name`, `message`) VALUES ("'.$_POST['name'].'","'.$_POST['message'].'");';
        $stmt = $dbh->prepare($insert);
        $stmt->execute();
        //MessageIn-END
    }

    $dsn = null;
//////////////////////MessageBoard-END//////////////////////
?>
</p>


</body>
</html>