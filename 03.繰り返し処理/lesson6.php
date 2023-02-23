<?php
// 以下配列の中身をfor文を使用して表示してください。
// 表が縦横に伸びてもある程度対応できるように柔軟な作りを目指してください。
// 表示はHTMLの<table>タグを使用すること

/**
 * 表示イメージ
 *  _________________________
 *  |_____|_c1|_c2|_c3|横合計|
 *  |___r1|_10|__5|_20|___35|
 *  |___r2|__7|__8|_12|___27|
 *  |___r3|_25|__9|130|__164|
 *  |縦合計|_42|_22|162|__226|
 *  ‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾
 */

$arr = [
    'r1' => ['c1' => 10, 'c2' => 5, 'c3' => 20],
    'r2' => ['c1' => 7, 'c2' => 8, 'c3' => 12],
    'r3' => ['c1' => 25, 'c2' => 9, 'c3' => 130]
];
$columnSum = [];
foreach($arr['r1'] as $c => $num){
  $columnSum = array_merge($columnSum,array($c => array_sum(array_column($arr,$c)))); 
}
$allSum = 0;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>テーブル表示</title>
<style>
table {
    border:1px solid #000;
    border-collapse: collapse;
}
th, td {
    border:1px solid #000;
}
</style>
</head>
<body>
  <table border="1">
    <tr>
      <th> </th>
      <?php foreach($arr['r1'] as $c => $num){ ?>
        <th><?= $c?></th>
      <?php } ?>
      <th>横合計</th>
    </tr>
    <?php foreach($arr as $r => $column){ ?>
      <?php $cSum = 0 ?>
      <tr>
        <td><?= $r ?></td>
        <?php foreach($column as $c => $num){ ?>
          <td><?= $num ?></td>
          <?php $cSum += $num ?>
        <?php } ?>
        <td><?= $cSum?></td>
        <?php $allSum += $cSum ?>
      </tr>
    <?php } ?>
    <tr>
      <td>縦合計</td>
      <?php foreach($columnSum as $c => $num){ ?>
        <td><?= $num ?></td>
      <?php } ?>
      <td><?= $allSum ?></td>
    </tr>
  </table>
</body>
</html>