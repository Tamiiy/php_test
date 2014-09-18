<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>PHP基礎</title>

</head>
<body>

<?php
    $dsn = 'mysql:dbname=phpkiso;host=localhost'; //Data Source Name
    $user = 'root';
    $password = 'camp2014';
    $dbh = new PDO ($dsn, $user, $password); //Data Base Hundle
    $dbh->query('SET NAMES utf8');

    $search = $_POST['search'];
    // echo $search.'<br/>';
    $sql = 'SELECT * FROM survey WHERE email like \'%'.$search.'%\'';
    // echo $sql.'<br/>';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    //データの集合を結果セットという.surveyの全てのデータが結果セットになっている

    echo '＊検索結果<br/>';
    while(1){
         $rec = $stmt->fetch(PDO::FETCH_ASSOC);
         //fetchは、データをひとつひとつとってくる、というDB用語
         if($rec == false) { //データがなくなると、自動的にfalseを返す
            break;
         }
         echo $rec['code'].' | ';
         echo $rec['nickname'].' | ';
         echo $rec['email'].' | ';
         echo $rec['goiken'];
         echo '<br/>';

         $dbh = null;
    }

    $dbh = null;
?>

</body>
</html>