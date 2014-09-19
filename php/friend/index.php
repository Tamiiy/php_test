<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>都道府県INDEX</title>
</head>
<body>
<h1>都道府県INDEX</h1>
<p>
<?php
    $dsn = 'mysql:dbname=CampTest;host=localhost'; //Data Source Name
    $user = 'root';
    $password = 'camp2014';
    $dbh = new PDO ($dsn, $user, $password); //Data Base Hundle
    $dbh->query('SET NAMES utf8');

    $sql = 'SELECT * FROM `area_table` ORDER BY `area_table`.`id` ASC';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    //データの集合を結果セットという.surveyの全てのデータが結果セットになっている

    echo '<ul>';
    while(1){
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        // $sql = 'SELECT COUNT(*) FROM friend_table WHERE area_table_id = \''.$rec['id'].'\'';
        $sql = 'SELECT COUNT(*) as `count` FROM friend_table WHERE area_table_id = \''.$rec['id'].'\'';

        // echo $sql.'<br/>';

        $stmt2 = $dbh->prepare($sql);
        $stmt2->execute();

        $count = $stmt2->fetch(PDO::FETCH_ASSOC);
        // echo $count['COUNT(*)'];

         //fetchは、データをひとつひとつとってくる、というDB用語
         if($rec == false) { //データがなくなると、自動的にfalseを返す
            break;
         }
         echo '<li><a href="friend.php?id='.$rec['id'].'">'.$rec['name'].'</a> ('.$count['count'].')</li>';
    }
    echo '</ul>';
    $dbh = null;
?>
</p>

</body>
</html>