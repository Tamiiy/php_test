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

    $sql = 'SELECT * FROM `area_table` WHERE id = \''.$_GET['id'].'\'';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $area = $stmt->fetch(PDO::FETCH_ASSOC);

    echo '<title>'.$area['name'].'フレンド追加</title>';
?>
</head>
<body>

<?php
    echo '<h1>'.$area['name'].'フレンド追加</h1>';
?>

<form method="POST" action="add.php?id=<?php echo $_GET['id']; ?>">
    名前：<input name="add_name" type="text" placeholder="名前を入力してください"><br/>
    男：<input name="add_gender" type="radio" value="男">　
    女：<input name="add_gender" type="radio" value="女"><br/>
    年齢：<input name="add_age" type="text">歳<br/>
    <?php
        // echo '年齢：<select name="add_age" type="select">歳<br/>'
        // for ($i=0; $i<100; $i++){
        //     echo '<option value="'.$i.'"></option>';
        // }
        // echo '年齢：</select>'
    ?>
    <input type="hidden" name="area_table_id" value="<?php echo $_GET['id'] ?>">
    <input type="submit" value="追加">
</form>

<?php
    if(isset($_POST['add_name'])){
        $name = $_POST['add_name'];
        $gender = $_POST['add_gender'];
        $age = $_POST['add_age'];
        $area_id = $_GET['id'];

        $sql = 'INSERT INTO `CampTest`.`friend_table` (`name`, `gender`, `age`, area_table_id) VALUES ("'.$name.'","'.$gender.'","'.$age.'","'.$area_id.'");';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        echo '追加されました！<br/>';
        echo $name.$gender.$age.$area_id.'<br/>';
        echo '<a href="friend.php?id='.$area_id.'">'.$area['name'].'に戻る</a>';

        $dbh = null;

        header('Location:friend.php?id='.$area_id.'&return=1');

        exit();
    }
    $dbh = null;
?>

</body>
</html>