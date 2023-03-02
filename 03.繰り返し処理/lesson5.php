<?php
// 以下をfor文を使用して表示してください。
// ヒント: forの中でforを３回使用

// ********1
// *******121
// ******12321
// *****1234321
// ****123454321
// ***12345654321
// **1234567654321
// *123456787654321
// 12345678987654321

for($i = 0; $i < 9; $i++){
  for($j = $i; $j < 8; $j++){
    echo "*";
  }
  for($leftNum = 0, $k = 0; $k < $i; $k++){
    if($k == 0){
      $leftNum = 1;
    }else{
    $leftNum = $leftNum * 10 + ($k + 1);
    }
  }
  if($i != 0){
    echo "{$leftNum}";
  }
  for($rightNum = 0, $l = 0; $l <= $i; $l++){
    if($l == 0){
      $rightNum = 1;
    }else{
    $rightNum = $rightNum + ($l + 1) * 10 ** $l;
    }
  }
  echo "{$rightNum}\n";
};