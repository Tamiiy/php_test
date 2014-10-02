<?php
//////////////////////sqlOpen-Start//////////////////////
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

        //checkFunction
        function Check($name, $contents, &$errors, $error_name, $count){
            $rec = null;
            if(!isset($contents) || !strlen($contents)){
                $errors[$error_name] = '<div class="alert alert-danger" role="alert">'.$name.'を入力してください'.'</div>';
            }else if (strlen($contents) > $count) {
                $errors[$error_name] = '<div class="alert alert-warning" role="alert">'.$name.'は'.$count.'文字以内で入力してください'.'</div>';
            }else {
                $rec = $contents;
                return $rec;
            }
        }

        $name = Check('名前', $_POST['name'], $errors, 'name', 20);
        $message = Check('メッセージ', $_POST['message'], $errors, 'message', 200);

        //nameCheck
        // $name = null;
        // if(!isset($_POST['name']) || !strlen($_POST['name'])){
        //     $errors['name'] = '名前を入力してください';
        // }else if (strlen($_POST['name']) > 20) {
        //     $errors['name'] = '名前は20文字以内で入力してください';
        // }else {
        //     $name = $_POST['name'];
        // }

        //messageCheck
        // $message = null;
        // if(!isset($_POST['message']) || !strlen($_POST['message'])){
        //     $errors['message'] = 'メッセージを入力してください';
        // }else if (strlen($_POST['message']) > 200) {
        //     $errors['message'] = 'メッセージは200文字以内で入力してください';
        // }else {
        //     $message = $_POST['message'];
        // }

        //SaveDB
        // var_dump($errors);
        if(count($errors) === 0){
            $sql = 'INSERT INTO `message_table` (`name`,`message`,`created_at`) VALUES (
                \''.mysql_real_escape_string($name).'\',
                \''.mysql_real_escape_string($message).'\',
                \''.date('Y-m-d H:i:s').'\')';
            mysql_query($sql,$link);
        }

        //Guard Resend
        // header('Location: http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        //$_SERVER['HTTP_HOST'] == 192.168.0.38
        //$_SERVER['REQUEST_URI'] == /message/index.php
    }
//////////////////////AfterPOSTSend-End//////////////////////

//////////////////////AfterPOSTSend-End//////////////////////
    //MessageOut-Start
    $select = 'SELECT * FROM `message_table` ORDER BY id DESC';
    $result = mysql_query($select,$link);

    if($result !== false && mysql_num_rows($result)){ //0件だった場合にrowsが必要
        $list = array();
        while ($post = mysql_fetch_assoc($result)) {
            $list[] = '<tr>'
            .'<td>'.htmlspecialchars($post['name'],ENT_QUOTES,'UTF-8').'</td>'
            .'<td>'.htmlspecialchars($post['message'],ENT_QUOTES,'UTF-8').'</td>'
            .'<td>'.htmlspecialchars($post['created_at'],ENT_QUOTES,'UTF-8').'</td></tr>';
        }
    }
//////////////////////AfterPOSTSend-End//////////////////////

//////////////////////sqlClose-START//////////////////////
    mysql_free_result($result);
    mysql_close($link);
//////////////////////sqlClose-END//////////////////////
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ひとこと掲示板</title>
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
  <body class="container">
    <ul class="nav nav-tabs" role="tablist">
      <li><a href="/">GOIKEN</a></li>
      <li><a href="/friend/">FRIEND</a></li>
      <li class="active"><a href="/message/">BBS</a></li>
    </ul>

    <h1 style="margin-bottom:20px;">ひとこと掲示板</h1>

<?php
//////////////////////ErrorOutput-START//////////////////////
// var_dump($errors);
if(count($errors) !== 0){
    foreach($errors as $error){
        echo $error;
    }
}else if($_SERVER['REQUEST_METHOD'] === 'POST'){
    echo '<div class="alert alert-success" role="alert">入力されました！</div>';
}
//////////////////////ErrorOutput-END//////////////////////
?>

<form method="POST" action="index.php" class="col-md-6">
    <span id="cdlength1" class="sub">あと20文字</span><br/><input class="form-control" type="text" name="name" placeholder="Enter Name" onkeyup="CountDownLength('cdlength1' , value , 20);"><br/>
    <span id="cdlength2" class="sub">あと200文字</span><br/><textarea class="form-control" name="message" style="width:300px; height:100px;" placeholder="Enter massage" onkeyup="CountDownLength('cdlength2' , value , 200);"></textarea><br/>
    <input type="submit" class="btn btn-primary" value="送信">
</form>

<div class="col-md-6">
<?php
//////////////////////MessageBoard-Start//////////////////////
    if($list !== null){
        echo '<table class="table table-striped"><thead><tr><th>Name</th><th>Message</th><th>Time</th></tr></thead>';
        foreach ($list as $value) {
             echo $value;
        }
        echo '</table>';
    }
//////////////////////MessageBoard-END//////////////////////
?>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>