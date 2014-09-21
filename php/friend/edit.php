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

    $sql = 'SELECT * FROM `friend_table` WHERE id = \''.$_GET['friend_id'].'\'';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $friend = $stmt->fetch(PDO::FETCH_ASSOC);

    echo '<title>'.$friend['name'].' 編集</title>';
?>
</head>
<body>

<?php
    echo '<h1>'.$friend['name'].' 編集</h1>';
?>
<form method="POST" action="edit.php?friend_id=<?php echo $friend['id']; ?>">
<?php
    echo '名前：<input name="edit_name" type="text" value="'.$friend['name'].'"><br/>';
    if($friend['gender']=="男"){
        echo '男：<input name="edit_gender" type="radio" value="男" checked>　';
        echo '女：<input name="edit_gender" type="radio" value="女" ><br/>';
    }else {
        echo '男：<input name="edit_gender" type="radio" value="男" >　';
        echo '女：<input name="edit_gender" type="radio" value="女" checked><br/>';
    }
    echo '年齢：<input name="edit_age" type="text" value='.$friend['age'].'>歳<br/>';
?>
    <input type="submit" value="変更">
    <input type="button" value="戻る" onClick="history.back()">
</form>

<?php
    if(isset($_POST['edit_name'])){
        $name = $_POST['edit_name'];
        $gender = $_POST['edit_gender'];
        $age = $_POST['edit_age'];

        $sql = 'UPDATE `CampTest`.`friend_table` SET `name` = "'.$name.'", `gender` ="'.$gender.'", `age` = "'.$age.'" WHERE id = \''.$friend['id'].'\'';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        echo '変更されました！<br/>';
        echo $name.$gender.$age.'<br/>';

        $dbh = null;

        header('Location:friend.php?id='.$friend['area_table_id'].'&return=2');

        exit();
    }
    $dbh = null;
?>

</body>
</html>