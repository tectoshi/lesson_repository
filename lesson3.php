<?php
// 連想配列のkey
// name, age, genderに
// 山田,  20,  女性
// という値を格納し、

// 山田
// 20歳・女性

// という形で出力してください。

$profiles = [
  'name' => '山田',
  'age' => 20,
  'gender' => '女性'
];

echo $profiles['name'];
echo PHP_EOL;
echo $profiles['age']."歳・".$profiles['gender'];