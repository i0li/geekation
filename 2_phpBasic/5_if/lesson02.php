﻿<?php
// 80点以上なら「優」
// 60点以上なら「良」
// 40点以上なら「可」
// それ以下なら「不可」

// という形で区別し、下記のフォーマットで出力するプログラムを作ってください。
// ○○点は「○」です。

$score = 100; //いくつかのケースで動作確認を行ってください。
$rank = null;

if($score >= 80){
  $rank = '優';
}elseif($score >= 60){
  $rank = '良';
}elseif($score >= 40){
  $rank = '可';
}else{
  $rank = '不可';
}

echo $score.'点は「'.$rank.'」です。';
?>