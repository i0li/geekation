<?php
// 以下をそれぞれ表示してください。（すべて改行を行って出力すること)
// 現在時刻を自動的に取得するPHPの関数があるので調べて実装してみて下さい。
// 実行するとその都度現在の日本の日時に合わせて出力されるされるようになればOKです。
// 日時がおかしい場合、PHPのタイムゾーン設定を確認して下さい。


// ・現在日時（xxxx年xx月xx日（x曜日））
$week = ['月','火','水','木','金','土','日'];
echo '・現在日時（'.date('Y').'年'.date('m').'月'.date('d').'日（'.$week[date('N')].'曜日））';
echo '<br/>';

// ・現在日時から３日後（yyyy年mm月dd日 H時i分s秒）
echo '・現在日時から３日後（'.date('Y年m月d日 H時i分s秒', strtotime('3days')).'）';
echo '<br/>';

// ・現在日時から１２時間前（yyyy年mm月dd日 H時i分s秒）
echo '・現在日時から１２時間前（'.date('Y年m月d日 H時i分s秒', strtotime('-12hour')).'）';
echo '<br/>';

// ・2020年元旦から現在までの経過日数 (ddd日)
$stdDate = new DateTime('2020-01-01');
$nowDate = new DateTime('now');
$diff = $stdDate -> diff($nowDate);
echo '・2020年元旦から現在までの経過日数 ('.$diff -> format('%a日').')';
echo '<br/>';
?>