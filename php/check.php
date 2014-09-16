<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>PHP基礎</title>
</head>
<body>
<?php
    $user = array(
        'ニックネーム' => htmlspecialchars($_POST['nickname']),
        'email' => htmlspecialchars($_POST['email']),
        'ご意見' => htmlspecialchars($_POST['goiken'])
    );

    $flag = 0;

    foreach ($user as $key => $value){
        if ($value == null) {
            echo '<font color="red">入力されていない項目があります</font><br/>';
            $flag = 1;
            break;
        }
    }

    foreach ($user as $key => $value){
        if ($value == null) {
            echo $key.'が入力されていません'.'<br/>';
        }else if($key == 'ニックネーム'){
            echo 'ようこそ！'.$value.'さん'.'<br/>';
        }else {
            echo $key.'：'.$value.'<br/>';
        }
    }
?>

<form method="post" action="thanks.php">
    <?php
    //POSTを使って渡す方法
        echo '<input name="nickname" type="hidden" value='.$_POST['nickname'].'>';
        echo '<input name="email" type="hidden" value="'.$_POST['email'].'">';
        echo '<input name="goiken" type="hidden" value='.$_POST['goiken'].'>';
        echo '<input type="button" value="戻る" onClick="history.back()">';
        if ($flag) {
            //OKは出力しない
        }
        else {
            echo '<input type="submit" value="OK">';
        }
    ?>
</form>

</body>
</html>