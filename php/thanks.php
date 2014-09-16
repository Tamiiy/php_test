<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>PHP基礎</title>
</head>
<?php
    $dsn = 'mysql:dbname=phpkiso;host=localhost'; //Data Source Name
    $user = 'root';
    $password = 'camp2014';
    $dbh = new PDO ($dsn, $user, $password); //Data Base Hundle
    $dbh->query('SET NAMES utf8');

    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $goiken = $_POST['goiken'];

    echo $nickname.'様、';
?>
<p>ご意見ありがとうございました！</p>

<?php
    echo '頂いたご意見『'.$goiken.'』<br/>';
    echo $email.'にメールを送りましたので、ご確認ください。';

    $sql = 'INSERT INTO `phpkiso`.`survey` (`nickname`, `email`, `goiken`) VALUES ("'.$nickname.'","'.$email.'","'.$goiken.'");';
    // $sql = 'INSERT INTO survey(nickname,email,goiken)VALUES("'.$nickname.'","'.$email.'","'.$goiken'")';
    echo $sql;
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;
?>
</html>