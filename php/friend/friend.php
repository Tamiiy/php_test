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
<style type="text/css">
<!--
.friend_table {
    margin: 15px 0;
    border-spacing: 0;
}
.friend_table td {
    border:1px solid #ddd;
    padding: 5px;
}
.friend_table th {
    background-color: #ff8100;
    border:1px solid #ddd;
    padding: 5px;
    color: #fff;
}
-->
</style>

</head>
<body>
<?php
    echo '<h1>'.$area['name'].'フレンド</h1>';

    //追加後のみの処理
    if(isset($_GET['return'])){
        if($_GET['return'] == 1){
            echo '<p><font color="red">１人追加しました！</font></p>';
        }else if($_GET['return'] == 2){
            echo '<p><font color="red">１人変更しました！</font></p>';
        }
    }

    //性別の人数を出力
    $sql = 'SELECT gender, count(gender) as count FROM `friend_table` WHERE area_table_id =\''.$_GET['id'].'\' group by gender';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    while(1){
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        //fetchは、データをひとつひとつとってくる、というDB用語
        if($rec == false) { //データがなくなると、自動的にfalseを返す
            break;
        }
        if($rec['gender'] == '女'){
            echo '<img src="http://www.bridge-1.jp/material/image/pictogram/toilet_07.jpg" width="20px">';
            echo '：'.$rec['count'].'人';
            $flag = 1;
        }
        echo '<img src="http://www.bridge-1.jp/material/image/pictogram/toilet_06.jpg" width="20px">';
        echo '：'.$rec['count'].'人　';
    }


    //友達のデータをとってくる
    $sql = 'SELECT * FROM `friend_table` WHERE area_table_id = \''.$_GET['id'].'\'ORDER BY `friend_table`.`id` ASC';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    echo '<table class="friend_table"><tr><th>名前</th><th>性別</th><th>年齢</th><th>編集</th></tr>';
    $count = 0;
    while(1){
         $rec = $stmt->fetch(PDO::FETCH_ASSOC);
         //fetchは、データをひとつひとつとってくる、というDB用語
         if($rec == false) { //データがなくなると、自動的にfalseを返す
            break;
         }
         if($count % 2 == 0){
             echo '<tr style="background-color:#fff1df;"><td>'.$rec['name'].'</td><td>'.$rec['gender'].'</td><td>'.$rec['age'].'</td>';
             echo '<td><a href="edit.php?friend_id='.$rec['id'].'">編集</a></td>';
             echo '</tr>';
         }
         else{
             echo '<tr><td>'.$rec['name'].'</td><td>'.$rec['gender'].'</td><td>'.$rec['age'].'</td>';
             echo '<td><a href="edit.php?friend_id='.$rec['id'].'">編集</a></td>';
             echo '</tr>';
         }
         $count += 1;
    }
    echo '</table>';

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