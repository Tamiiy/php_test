<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>PHP基礎</title>
</head>
<body>
<?php
    $user = array(
        'ニックネーム' => $_POST['nickname'],
        'email' => $_POST['email'],
        'ご意見' => $_POST['goiken']
    );

    // $nickname = $_POST['nickname'];
    // $email = $_POST['email'];
    // $goiken = $_POST['goiken'];

    foreach ($user as $key => $value){
        if ($value == null) {
            echo '<font color="red">入力されていない項目があります</font>';
            echo '<input type="button" value="戻る" onClick="history.back()">'.'<br/>';
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

    // if ($nickname == null) {
    //     $error[0] = "ニックネーム";
    // }
    // else if($email == null){
    //     $error[1] = "email";
    // }
    // else if($goiken == null){
    //     $error[3] = "key"
    // }
    // else
        // echo '<color="red">ニックネームが入力されていません'."\n";
        // echo '<input type="button" value="戻る" onClick="history.back()">';
    // }
    //     echo "ようこそ、";
    //     echo $nickname."様。"; //スーパーグローバル変数.実は連想配列
    // }

    // if ($nickname == null) {
    //     echo "ニックネームが入力されていません\n";
    //     echo '<input type="button" value="戻る" onClick="history.back()">';
    // }
    // else {
    //     echo $_POST['nickname']."様。"; //スーパーグローバル変数.実は連想配列
    // }


?>
</body>
</html>