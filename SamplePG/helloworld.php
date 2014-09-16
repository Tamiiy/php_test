<?php

    $person[0] = array(
        'name' => 'Yukiko',
        'place' => 'Japan',
        'age' => 23,
        'visit_count' => 0
    );
    $person[1] = array(
        'name' => 'Eriko',
        'place' => 'Cebu',
        'age' => 18,
        'visit_count' => 1
    );
    $person[2] = array(
        'name' => 'Miri',
        'place' => 'England',
        'age' => 25,
        'visit_count' => 2
    );
    $person[3] = array(
        'name' => 'David',
        'place' => 'Austraria',
        'age' => 29,
        'visit_count' => 99
    );

    $count = 0;

    while ($person[$count] !== null) {

        $hello = 'hello,'.$person[$count]['place'].'!';
        $name = 'My name is '.$person[$count]['name'].'!';
        $number = $person[$count]['visit_count'] += 1; //$number = $number + 1
        $age = 'I\'m '.$person[$count]['age'].' years old.';

        echo $hello."\n";
        echo $name."\n";
        echo $number." 回目訪問\n";
        echo $age."\n";

        //制御文(if文)-通貨
        // if ($person[$count]['place'] == 'Cebu') {
        //     $money = 'ペソ';
        // } else if ($person[$count]['place'] == 'Japan') {
        //     $money = '円';
        // } else if ($person[$count]['place'] == 'England') {
        //     $money = 'ポンド';
        // } else {
        //     $money = '？';
        // }
        // echo '通貨は'.$money.'です。'."\n";

        //制御文(if文)-年齢へのコメント
        // if ($person[$count]['age'] <= 19) {
        //     $comment = 'you are still young!! enjoy!!';
        // } else if ( $person[$count]['age'] >= 20 && $person[$count]['age'] <= 25 ) {
        //     $comment = 'you are IkeIke!! enjoy!!';
        // } else if ( $person[$count]['age'] >= 26 ) {
        //     $comment = 'you are Super person!! enjoy!!';
        // } else {
        //     $comment = '？';
        // }
        // echo $comment."\n";

        //switch文-通貨
        switch ($person[$count]['place']) {
            case 'Cebu':
                $money = 'ペソ';
                break;
            case 'Japan':
                $money = '円';
                break;
            case 'England':
                $money = 'ポンド';
                break;           
            default:
                $money = '？';
                break;
        }
        echo '通貨は'.$money.'です。(switch文の出力だよ)'."\n";


        //switch文-年齢
        switch ($person[$count]['age']) {
            case '20':
            case '21':
            case '22':
            case '23':
            case '24':
            case '25':
                $comment = 'you are IkeIke!! enjoy!!';
                break;
            default:
                if ($person[$count]['age'] <= 19) {
                    $comment = 'you are still young!! enjoy!!';
                } else if ( $person[$count]['age'] >= 26 ) {
                    $comment = 'you are Super person!! enjoy!!';
                }
                break;
        }
        echo $comment."\n";

        //switch 訪問回数
        switch ($person[$count]['visit_count']) {
            case 1:
                echo 'はじめてなんですね'."\n";
                break;
            case 2:
                echo '再訪問ありがとうございます！'."\n";
                break;
            case 3:
                echo '何度もきてくれて嬉しいです'."\n";
                break;
            case 100:
                echo '100回目！キリ番ゲットー'."\n";
                break;
            default:
                break;
        }

        echo "+++++++++++++++++\n";

        $count++;
    }



    // $hello = 'hello,'.$person[1]['place'].'!';
    // $name = 'My name is '.$person[1]['name'].'!';

    // echo $hello."\n";
    // echo $name."\n";
    // echo $number."回目訪問 \n";
    // echo $age."\n";



    // $count = 0;

    // while ($count < 10){
    //     echo $count;
    //     echo $hello;
    //     echo $name."\n";
    //     $count++;
    // }
?>