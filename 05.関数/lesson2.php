<?php
// 以下をそれぞれ表示してください。（すべて改行を行って出力すること)
// 現在時刻を自動的に取得するPHPの関数があるので調べて実装してみて下さい。
// 実行するとその都度現在の日本の日時に合わせて出力されるされるようになればOKです。
// 日時がおかしい場合、PHPのタイムゾーン設定を確認して下さい。

// ・現在日時（xxxx年xx月xx日（x曜日））
// ・現在日時から３日後（yyyy年mm月dd日 H時i分s秒）
// ・現在日時から１２時間前（yyyy年mm月dd日 H時i分s秒）
// ・2020年元旦から現在までの経過日数 (ddd日)
$week = array("日", "月", "火", "水", "木", "金", "土");
$dow = $week[date("w")];

echo "・現在日時"."(".date("Y年m月d日") ."(". $dow. "曜日".")".")"."\n";
echo "・現在日時から３日後". "(" .date("Y年m月d日 H時i分s秒",strtotime("+3 day")).")"."\n";
echo "・現在日時から１２時間前". "(" .date("Y年m月d日 H時i分s秒",strtotime("-12 hour")).")"."\n";

$today = new DateTime("now");
$day = new DateTime("2020-01-01");
$diff = $day -> diff($today);
echo $diff -> format('・2020年元旦から現在までの経過日数(%d日)');