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
</body>
</html>