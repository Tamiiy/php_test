<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>追加完了</title>
</head>
<?php
    $dsn = 'mysql:dbname=CampTest;host=localhost'; //Data Source Name
    $user = 'root';
    $password = 'camp2014';
    $dbh = new PDO ($dsn, $user, $password); //Data Base Hundle
    $dbh->query('SET NAMES utf8');

    $add = $_POST['add_friend'];
?>

<p>追加完了しました！</p>

<?php
    echo ''.$add.'さんを追加しました！';

    $sql = 'INSERT INTO `CampTest`.`friend_table` (`nickname`, `email`, `goiken`) VALUES ("'.$nickname.'","'.$email.'","'.$goiken.'");';
    // $sql = 'INSERT INTO survey(nickname,email,goiken)VALUES("'.$nickname.'","'.$email.'","'.$goiken'")';
    // echo $sql;
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;
?>
</html>