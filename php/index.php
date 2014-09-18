<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>PHP基礎</title>

<script type="text/javascript"> 
<!-- 
// function check(){
//     var flag = 0;
//     // 設定開始（必須にする項目を設定してください）
//     if(document.test.nickname.value == ""){
//         flag = 1;
//     }else if(document.test.email.value == ""){
//         flag = 1;
//     }else if(document.test.goiken.value == ""){
//         flag = 1;
//     }
//     // 設定終了
//     if(flag){
//         window.alert('必須項目に未入力がありました'); // 入力漏れがあれば警告ダイアログを表示
//         return false; // 送信を中止
//     }else{
//         return true; // 送信を実行
//     }
// }
// -->
</script>

</head>
<body>
<form name="test" method="post" action="check.php" onSubmit="return check()">
    <p>ニックネームを入力してください<br/>
    <input name="nickname" type="text" style="width:100px" maxlength="20">
    </p>
    <p>e-mailを入力してください<br/>
    <input name="email" type="email" style="width:200px" maxlength="20">
    </p>
    <p>ご意見を入力してください<br/>

    <script type="text/javascript"><!--
    function CountDownLength( idn, str, mnum ) {
       document.getElementById(idn).innerHTML = "あと" + (mnum - str.length) + "文字";
    }
    // --></script>

    <p id="cdlength1">あと100文字</p>
    <textarea name="goiken" type="textarea" style="width:300px; height:100px;" maxlength="500" onkeyup="CountDownLength( 'cdlength1' , value , 100 );"></textarea>
    </p>
    <br/>
    <input type="submit" value="送信">
</form>

<p>
<?php
    $dsn = 'mysql:dbname=phpkiso;host=localhost'; //Data Source Name
    $user = 'root';
    $password = 'camp2014';
    $dbh = new PDO ($dsn, $user, $password); //Data Base Hundle
    $dbh->query('SET NAMES utf8');

    $sql = 'select * from survey';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    //データの集合を結果セットという.surveyの全てのデータが結果セットになっている

    while(1){
         $rec = $stmt->fetch(PDO::FETCH_ASSOC);
         //fetchは、データをひとつひとつとってくる、というDB用語
         if($rec == false) { //データがなくなると、自動的にfalseを返す
            break;
         }
         echo $rec['code'].' | ';
         echo $rec['nickname'].' | ';
         echo $rec['email'].' | ';
         echo $rec['goiken'];
         echo '<br/>';
    }
?>

<form method="post" action="index.php">
    <input type="text" name="search" placeholder="Email検索">
    <input type="submit" value="検索">
</form>

<?php
    //$search = $_POST['search']; エラーが出ちゃうので廃止
    // echo $search.'<br/>';
    // $sql = 'SELECT * FROM survey WHERE email like \'%'.$search.'%\'';
    // echo $sql.'<br/>';
    // $stmt = $dbh->prepare($sql);
    // $stmt->execute();
    //データの集合を結果セットという.surveyの全てのデータが結果セットになっている


    //先生の回答
    if(!isset($_POST['search'])){ //!isset:値がfalseだったら
        $sql .= ';'; //sqlの末尾に';'を連結
        //$sql = $sql.';'; と同じ
        echo '＊検索結果がここに表示されます';
    }else {
        $sql .= ' WHERE email like \'%'.$_POST['search'].'%\';';
        // echo $sql.'<br/>';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        echo '＊検索結果<br/>';
        while(1){
             $rec = $stmt->fetch(PDO::FETCH_ASSOC);
             //fetchは、データをひとつひとつとってくる、というDB用語
             if($rec == false) { //データがなくなると、自動的にfalseを返す
                break;
             }
             echo $rec['code'].' | ';
             echo $rec['nickname'].' | ';
             echo $rec['email'].' | ';
             echo $rec['goiken'];
             echo '<br/>';
        }
    }
    $dbh = null;
?>
</p>

</body>
</html>