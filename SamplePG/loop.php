<?php

// $peso_day = array (
//     '2014/09/01' => 200,
//     '2014/09/02' => 359,
//     '2014/09/03' => 100,
//     '2014/09/04' => 40,
//     '2014/09/05' => 67
// );

// $wether_day = array (
//     '2014/09/01' => 'Sunny',
//     '2014/09/02' => 'Rainy',
//     '2014/09/03' => 'Sunny sometimes rainy',
//     '2014/09/04' => 'Cloudy',
//     '2014/09/05' => 'Typhoon'
// );

// $temp_day = array (
//     '2014/09/01' => '0',
//     '2014/09/02' => '25',
//     '2014/09/03' => '32',
//     '2014/09/04' => '15',
//     '2014/09/05' => '6'
// );

// //まとめた
// $day = array (
//     '2014/09/01' => array('weather' => 'Sunny', 'temp' => '0'),
//     '2014/09/02' => array('weather' => 'Rainy', 'temp' => '25'),
//     '2014/09/03' => array('weather' => 'Sunny sometimes rainy', 'temp' => '0'),
//     '2014/09/04' => array('weather' => 'Cloudy', 'temp' => '15'),
//     '2014/09/05' => array('weather' => 'Typhoon', 'temp' => '6')
// );

//宿題-イベントカレンダー
$event = array(
    'SINULOG' => array(
        'month' => 1,
        'date' => 'Third Sunday',
        'place' => 'Cebu',
        'detail' => '幼きイエス・キリスト像を祝う「シヌログ」といわれるセブ島最大のお祭り'
    ),
    'Flower Festival' => array(
        'month' => 2,
        'date' => 'Fourth Week',
        'place' => 'Baguio City',
        'detail' => '花の生産で有名な、バギオで行われるお祭り'
    ),
    'Iloilo Regatta' => array(
        'month' => 3,
        'date' => 'Second Sunday',
        'place' => 'Iloilo',
        'detail' => 'パナイ島イロイロで開催される、レガッタのレース'
    ),
    'Magellan\'s '  => array(
        'month' => 4,
        'date' => '24',
        'place' => 'Cebu',
        'detail' => 'マゼラン上陸記念'
    ),
    'Cebu Mango Festival' => array(
        'month' => 5,
        'date' => '9',
        'place' => 'Cebu',
        'detail' => 'マンゴーの収穫を祝い開催'
    ),
    'Lechon Parade' => array(
        'month' => 6,
        'date' => '24',
        'place' => 'Balayan',
        'detail' => 'レチョン(子豚の丸焼き)を主役にパレードを行う'
    ),
    'Bocaue River Festival' => array(
        'month' => 7,
        'date' => 'First Sunday',
        'place' => 'Bracan',
        'detail' => 'ボカウエ川で行われるお祭り'
    ),
    'Cry of Balintawak' => array(
        'month' => 8,
        'date' => '26',
        'place' => '不明',
        'detail' => '1896年8月26日にスペイン植民地支配に対する抵抗を開始したことを祝い開催'
    ),
    'Ang Sinulog' => array(
        'month' => 9,
        'date' => '29',
        'place' => '不明',
        'detail' => 'イリガンの守護神サン・ミゲルを祝う'
    ),
    'Masskara'  => array(
        'month' => 10,
        'date' => '14-21',
        'place' => 'Bacolod',
        'detail' => '「微笑みの都市」と呼ばれるネグロス島最大の都市バコロドで行われる。笑顔のマスクがこのフィエスタ最大の特徴。'
    ),
    'Gigantes'  => array(
        'month' => 11,
        'date' => '23',
        'place' => 'リサール州アンゴノ',
        'detail' => '巨人のはりぼてを使ったお祭り'
    ),
    'Lantan Parade'  => array(
        'month' => 12,
        'date' => '24',
        'place' => 'バンバンガ州サンフェルナンドが有名',
        'detail' => 'クリスマス・イブに行われるランタンパレード'
    )
);


echo '▼イベントの月を入力してください(数字のみ/0でALL)'."\n";
$input = fgets(STDIN,4096);

foreach ($event as $key => $value) {
    if ($input <= 12 && $input > 0) {
        if ($input == $value['month']){
            echo '名前：'.$key."\n";
            echo '開催日：'.$value['month'].'月 / '.$value['date']."\n";
            echo '開催地：'.$value['place']."\n";
            echo '詳細：'.$value['detail']."\n";
            echo '+++++++++++++++++++++++++'."\n";
            break;
        }
    }
    else if ($input == 0) {
        echo '名前：'.$key."\n";
        echo '開催日：'.$value['month'].'月 / '.$value['date']."\n";
        echo '開催地：'.$value['place']."\n";
        echo '詳細：'.$value['detail']."\n";
        echo '+++++++++++++++++++++++++'."\n";
    }
    else {
        echo '入力値が間違っています。(いずれかを入力：0,1,2,3,4,5,6,7,8,9,10,11,12)'."\n";
        break;
    }
}


// for ($i=0; $i < 5; $i++) { 
//     // if($i < 5) {
//     //     echo 'Hi!'.$i."\n";
//     // } else {
//     //     echo 'hello'.$i."\n";
//     // }
//     echo 'タクシー代'.$peso_day[$i].'ペソ'."\n";    
// }

// foreach ($peso_day as $key => $value){
//     echo $key.' のタクシー代は ';
//     echo $value.'ペソ'."\n";
// }

// //天気
// foreach ($wether_day as $key => $value){
//     echo $key.' の天気は ';
//     echo $value.'　でした。'."\n";
// }

// //気温
// foreach ($temp_day as $key => $value){
//     echo "\n";
//     echo $key.' の気温は ';
//     echo $value.'度　でした。'."\n";
//     if ($value <= 6){
//         echo 'めっちゃ寒いじゃないですか!'."\n";
//     }
//     else if ($value >= 7 && $value <= 20) {
//         echo '快適ですね。うらやましい'."\n";
//     }
//     else if ($value >= 21 && $value <=30) {
//         echo 'そろそろアイスが欲しくなるかも'."\n";
//     }
//     else {
//         echo 'あぢー'."\n";
//     }
// }


// $number = array (
//     'Life1' => 100,
//     'Life2' => 200,
//     'Life3' => 300
// );
// foreach ($number as $key => $number_each){
//     echo $key."\n";
//     echo $number_each."\n";
// }
//私のwhile文はforeach文の方がスマートかー


$a = 0;

// while(1) {
//     $a =+ 1;
//     if ($a > 10){
//         break;
//     }
// }

// while($a < 10) {
//     $a += 1;
//     echo 'while no = '.$a."\n";
// }


?>