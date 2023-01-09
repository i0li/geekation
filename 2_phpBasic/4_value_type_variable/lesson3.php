<?php
// 連想配列のkey
// name, age, genderに
// 山田,  20,  女性
// という値を格納し、
$personInfo = [
  'name' => '山田',
  'age' => '20',
  'gender' => '女性'
];

// 山田
// 20歳・女性
echo $personInfo['name'];
echo '<br/>';
echo $personInfo['age'].'歳・'.$personInfo['gender'];

// という形で出力してください。
