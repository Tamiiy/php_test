<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>確認画面</title>
</head>
<body>
<?php
    $add = $_POST['add_friend'];
    echo '<form method="post" action="complete.php">';
    if ($add == null) {
        echo '<font color="red">名前が入力されていません</font><br/>';
        echo '<input type="button" value="戻る" onClick="history.back()">';
    }
    else {
        echo '<input name="add_friend" type="hidden" value='.$_POST['add_friend'].'>';
        echo $add.'さんを追加します。よろしいですか？'.'<br/>';
        echo '<input type="button" value="戻る" onClick="history.back()">';
        echo '<input type="submit" value="OK">';
    }
    echo '</form>';
?>



</body>
</html>