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

    //追加後のみの処理
    if(isset($_GET['return'])){
        echo '<p><font color="red">１人追加しました！</font></p>';
    }

    //性別の人数を出力
    $sql = 'SELECT gender, count(id) as count FROM `friend_table` WHERE area_table_id =\''.$_GET['id'].'\' group by gender';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    while(1){
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        //fetchは、データをひとつひとつとってくる、というDB用語
        if($rec == false) { //データがなくなると、自動的にfalseを返す
            break;
        }
        echo $rec['gender'].'：'.$rec['count'].'人　';
    }


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
<!-- <form method="POST" action="add.php"> -->
<?php

//GETなら・・・
echo '<form method="POST" action="add.php?id='.$_GET['id'].'">';

//POSTなら・・・(あとあと面倒なのでコメントアウト)
    // echo '<input type="hidden" name="id" value="'.$_GET['id'].'">';
?>
    <input type="submit" value="追加ページへ">
    <a href="index.php">一覧へ</a>
</form>


</body>
</html>