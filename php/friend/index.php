<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>都道府県INDEX</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">
<!--
.friend_table {
    margin: 5px 0;
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
.col-md-3 {
    padding-bottom:5px;
    padding-top:5px;
}
-->
</style>
</head>
<body class="container">
    <ul class="nav nav-tabs" role="tablist">
      <li><a href="/">GOIKEN</a></li>
      <li class="active"><a href="/friend/">FRIEND</a></li>
      <li><a href="/message/">BBS</a></li>
    </ul>
<h1>都道府県INDEX</h1>


<form method="POST" action="index.php" class="clearfix" style="margin-bottom:10px;">
<div class="col-xs-4">
    <input class="form-control" type="text" name="search" placeholder="Enter Friend Name">
</div>
    <input class="btn btn-primary" type="submit" value="検索" onClick="disp()">
</form>

<div class="clearfix" style="padding-top:10px;">
<?php

//////////////////////sqlOpen-Start//////////////////////
    $dsn = 'mysql:dbname=CampTest;host=localhost'; //Data Source Name
    $user = 'root';
    $password = 'camp2014';
    $dbh = new PDO ($dsn, $user, $password); //Data Base Hundle
    $dbh->query('SET NAMES utf8');
//////////////////////sqlOpen-End//////////////////////

//////////////////////NameSearch-Start//////////////////////
    echo '<div class="col-md-9" style="float:right;">';

    if (isset($_POST['search'])){

    // $search_list = sqlSelect('SELECT * FROM `friend_table` WHERE name LIKE \'%'.$_POST['search'].'%\'');

        $sql = 'SELECT * FROM `friend_table` WHERE name LIKE \'%'.$_POST['search'].'%\';';
        $sql_count = 'SELECT count(*) as count FROM `friend_table` WHERE name LIKE \'%'.$_POST['search'].'%\';';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        while($rec){
            $search_list[] = $rec;
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        $stmt_sql_count = $dbh->prepare($sql_count);
        $stmt_sql_count->execute();
        $count = $stmt_sql_count->fetch(PDO::FETCH_ASSOC);

        if($count['count'] == 0){
            echo '<font color="red">ヒットしませんでした</font><br/>';
        }else if($count['count'] == 1){
            header('Location:edit.php?friend_id='.$rec['id']);
        }else{
            echo '検索結果：'.$count['count'].'件<br />';
            echo '<table class="friend_table table"><tr><th>名前</th><th>性別</th><th>年齢</th><th>編集</th></tr>';
            $table = 0;
            foreach ($search_list as $search_value) {
                echo '<tr ';
                if($table % 2 == 0){echo 'style="background-color:#fff1df;"';}
                echo '><td>'.$search_value['name'].'</td><td>'.$search_value['gender'].'</td><td>'.$search_value['age'].'</td>';
                echo '<td><a href="edit.php?friend_id='.$search_value['id'].'">編集</a></td>';
                echo '</tr>';
                $table += 1;
            }
            echo '</table>';
        }
    }
//////////////////////NameSearch-End//////////////////////


//////////////////////Friend.php-Start//////////////////////
if(isset($_GET['id'])) {

    //地域名をとってくる
    $sql = 'SELECT * FROM `area_table` WHERE id = \''.$_GET['id'].'\'';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $area = $stmt->fetch(PDO::FETCH_ASSOC);

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
            echo '<span class="glyphicon glyphicon-user" style="color:red;"></span>';
            echo '：'.$rec['count'].'人　';
        }else{
            echo '<span class="glyphicon glyphicon-user" style="color:blue;"></span>';
            echo '：'.$rec['count'].'人　';
        }
    }

    //友達のデータをとってくる
    $sql = 'SELECT * FROM `friend_table` WHERE area_table_id = \''.$_GET['id'].'\'ORDER BY `friend_table`.`id` ASC';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    echo '<table class="friend_table table""><tr><th>名前</th><th>性別</th><th>年齢</th><th>編集</th></tr>';
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
    echo '<form method="POST" action="add.php?id='.$_GET['id'].'">';
    echo '<input type="submit" value="追加ページへ" class="btn btn-info"></form>';
}else {
    echo '<h4><small>ここにフレンドリストが表示されます</small></h4>';
}
    echo '</div>';
//////////////////////Friend.php-End//////////////////////


//////////////////////NameArea-Start//////////////////////
    $sql = 'SELECT * FROM `area_table` ORDER BY `area_table`.`id` ASC';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    //データの集合を結果セットという.surveyの全てのデータが結果セットになっている

    $img = 2;
    $img = sprintf("%03d", $img);
    echo '<div class="col-md-3">';
    echo '<ul class="list-group">';
    while(1){
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        // $sql = 'SELECT COUNT(*) FROM friend_table WHERE area_table_id = \''.$rec['id'].'\'';
        $sql = 'SELECT COUNT(*) as `count` FROM friend_table WHERE area_table_id = \''.$rec['id'].'\'' ;

        // echo $sql.'<br/>';

        $stmt2 = $dbh->prepare($sql);
        $stmt2->execute();

        $count = $stmt2->fetch(PDO::FETCH_ASSOC);
        // echo $count['COUNT(*)'];

         //fetchは、データをひとつひとつとってくる、というDB用語
         if($rec == false) { //データがなくなると、自動的にfalseを返す
            break;
         }
         if($count['count'] == 0){
            echo '<li class="list-group-item"><img src="http://members.just-size.net/pflag/list1.files/image'.$img.'.gif" width="20px">'.$rec['name'].'<span class="badge">'.$count['count'].'</span></li>';
         }else{
            echo '<li class="list-group-item"><a href="index.php?id='.$rec['id'].'"><img src="http://members.just-size.net/pflag/list1.files/image'.$img.'.gif" width="20px">'.$rec['name'].'</a><span class="badge">'.$count['count'].'</span></li>';
         }
         $img += 2;
         $img = sprintf("%03d", $img);
         if ($rec['id'] == 13){
             $img += 1;
             $img = sprintf("%03d", $img);
         }
    }
    echo '</ul></div>';
//////////////////////NameArea-END//////////////////////

    $dbh = null;
?>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>