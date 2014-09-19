<?php
    // open関数
    function sqlOpen($_dbname,$_user,$_password){
        $dsn = 'mysql:dbname='.$_dbname.';host=localhost'; //Data Source Name
        $dbh = new PDO ($dsn, $_user, $_password); //Data Base Hundle
        return $dbh;
    }

    $dbh = sqlOpen('CampTest','root','camp2014');

    // $dsn = 'mysql:dbname=CampTest;host=localhost'; //Data Source Name
    // $user = 'root';
    // $password = 'camp2014';
    // $dbh = new PDO ($dsn, $user, $password); //Data Base Hundle

    //select文代入をまとめてみた
    function sqlSelect($select){
        global $dbh;
        $dbh->query('SET NAMES utf8');
        $sql = '\''.$select.'\'';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        // $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        return $stmt;
    }

    $stmt = sqlSelect('SELECT * FROM `area_table`');
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $rec['name'];
    // $friends_gender = sqlSelect('SELECT gender, count(area_table_id) FROM `friend_table` WHERE area_table_id =\''.$_GET['id'].'\' group by gender');

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php
    // echo '<title>'.$area.'</title>';
?>
</head>
<body>
<?php
    // echo $area;
    // echo '<h1>'.$area['name'].'フレンド</h1>';

    // //配列の初期設定
    // $friends = array();

    // echo '<ul>';
    // while($friends_gender){
    //      echo '<li>'.$friends_gender['name'].' | '.$friends_gender['gender'].' | '.$friends_gender['age'].'</li>';
    // }
    // echo '</ul>';

    // $dbh = null;
?>
<!-- <form method="POST" action="add.php">
    <input name="add_name" type="text" placeholder="名前を入力してください"><br/>
    男<input name="add_gender" type="radio" value="男">
    女<input name="add_gender" type="radio" value="女"><br/>
    年齢<input name="add_age" type="select"><br/>
    <input type="submit" value="追加">
</form> -->


</body>
</html>