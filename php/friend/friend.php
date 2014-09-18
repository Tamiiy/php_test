<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
    $dsn = 'mysql:dbname=CampTest;host=localhost'; //Data Source Name
    $user = 'root';
    $password = 'camp2014';
    $dbh = new PDO ($dsn, $user, $password); //Data Base Hundle
    $dbh->query('SET NAMES utf8');

    //地域名をとってくる
    $sql = 'SELECT * FROM `area_table` WHERE id = \''.$_GET['id'].'\'';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $area = $stmt->fetch(PDO::FETCH_ASSOC);

    echo '<title>'.$area['name'].'</title>';
?>
</head>
<body>
<?php
    echo '<h1>'.$area['name'].'フレンド</h1>';

    //友達のデータをとってくる
    $sql = 'SELECT * FROM `friend_table` WHERE area_table_id = \''.$_GET['id'].'\'';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    echo '<ul>';
    while(1){
         $rec = $stmt->fetch(PDO::FETCH_ASSOC);
         //fetchは、データをひとつひとつとってくる、というDB用語
         if($rec == false) { //データがなくなると、自動的にfalseを返す
            break;
         }
         echo '<li>'.$rec['name'].' | '.$rec['gender'].' | '.$rec['age'].'</li>';
    }
    echo '</ul>';

    $dbh = null;
?>
<form method="POST" action="add.php">
    <input name="add_name" type="text" placeholder="名前を入力してください"><br/>
    男<input name="add_gender" type="radio" value="男">
    女<input name="add_gender" type="radio" value="女"><br/>
    年齢<input name="add_age" type="select"><br/>
    <input type="submit" value="追加">
</form>


</body>
</html>