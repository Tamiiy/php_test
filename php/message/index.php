<?php
//////////////////////sqlOpen-Start//////////////////////
    //データベースに接続①：mySQL以外にも対応
    // $dsn = 'mysql:dbname=MessageBoard;host=localhost'; //Data Source Name
    // $user = 'root';
    // $password = 'camp2014';
    // $dbh = new PDO ($dsn, $user, $password); //Data Base Hundle
    // $dbh->query('SET NAMES utf8');

    //データベースに接続②：mysql専用
    $link = mysql_connect('localhost','root','camp2014');
    if(!$link){
        die('データベースに接続できません：'.mysql_error());
    }
    mysql_select_db('MessageBoard',$link);
    mysql_set_charset('utf8');
    // date_default_timezone_set('Asia/Tokyo');
//////////////////////sqlOpen-End//////////////////////

//////////////////////Format-Start//////////////////////
    $errors = array(); //これは右辺を上書き(初期化)
    //$errors[] = ~　これは右辺を追加
//////////////////////Format-End//////////////////////

//////////////////////AfterPOSTSend-Start//////////////////////
    if($_SERVER['REQUEST_METHOD'] === 'POST') { //'==='は'=='より厳密(文字列と数字など型も含め判別)

        //nameCheck
        $name = null;
        if(!isset($_POST['name']) || !strlen($_POST['name'])){
            $errors['name'] = '名前を入力してください';
        }else if (strlen($_POST['name']) > 20) {
            $errors['name'] = '名前は20文字以内で入力してください';
        }else {
            $name = $_POST['name'];
        }

        //messageCheck
        $message = null;
        if(!isset($_POST['message']) || !strlen($_POST['message'])){
            $errors['message'] = 'メッセージを入力してください';
        }else if (strlen($_POST['message']) > 200) {
            $errors['message'] = 'メッセージは200文字以内で入力してください';
        }else {
            $message = $_POST['message'];
        }

        //SaveDB
        if(count($errors) === 0){
            $sql = 'INSERT INTO `message_table` (`name`,`message`,`created_at`) VALUES (
                \''.mysql_real_escape_string($name).'\',
                \''.mysql_real_escape_string($message).'\',
                \''.date('Y-m-d H:i:s').'\')';
            mysql_query($sql,$link);

        }
        //Guard Resend
        header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        //$_SERVER['HTTP_HOST'] == 192.168.0.38
        //$_SERVER['REQUEST_URI'] == /message/index.php
    }
//////////////////////AfterPOSTSend-End//////////////////////
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ひとこと掲示板</title>
<style type="text/css">
<!--
.sub {
    font-size:10px;
    color: #aaa;
}
-->
</style>
<script type="text/javascript"><!--
function CountDownLength( idn, str, mnum ) {
   document.getElementById(idn).innerHTML = "あと" + (mnum - str.length) + "文字";
}
// --></script>
</head>
<body>
<h1>ひとこと掲示板</h1>
<?php
//////////////////////ErrorOutput-START//////////////////////
if(count($errors)){
    echo '<ul>';
    foreach($errors as $error){
        echo '<li><font color="red">';
        echo htmlspecialchars($error,ENT_QUOTES,'UTF-8');
        echo '</font></li>';
    }
    echo '</ul>';
}
//////////////////////ErrorOutput-END//////////////////////
?>

<form method="POST" action="index.php">
    名前：<span id="cdlength1" class="sub">あと20文字</span><br/><input type="text" name="name" onkeyup="CountDownLength('cdlength1' , value , 20);"><br/>
    <br/>
    ひとこと：<span id="cdlength2" class="sub">あと200文字</span><br/><textarea name="message" style="width:300px; height:100px;" maxlength="200" onkeyup="CountDownLength('cdlength2' , value , 200);"></textarea><br/>
    <br/>
    <input type="submit" value="送信">
</form>

<?php
//////////////////////MessageBoard-Start//////////////////////
    //MessageOut-Start
    $select = 'SELECT * FROM `message_table` ORDER BY id';
    $sql = mysql_query($select,$link);
    $result = mysql_fetch_assoc($sql);

    while($result){
        $list[] = $result;
        $result = mysql_fetch_assoc($sql);
    } //$list[]にoutすべきデータが入りました

    echo '<ul>';
    foreach ($list as $value) {
         echo '<li>'.$value['name'].'：'.$value['message'].'：'.$value['time'].'：'.$value['created_at'].'</li>';
    }
    echo '</ul>';
    //MessageOut-End
//////////////////////MessageBoard-END//////////////////////

//////////////////////sqlClose-START//////////////////////
    mysql_free_result($result);
    mysql_close($link);
//////////////////////sqlClose-END//////////////////////
?>

</body>
</html>