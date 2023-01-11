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

//横合計追加
$arrHorizontalSum = [];
foreach($arr as $keyR => $valueR){
    $horizontalSum = 0;
    foreach($arr[$keyR] as $keyC => $valueC){
        $horizontalSum += $valueC;
    }
    $arr[$keyR] += ['横合計' => $horizontalSum];
};

//縦合計
$arrVirticalSum = [];
foreach($arr['r1'] as $keyR => $valueR){
    $virticalSum = 0;
    foreach($arr as $keyC => $valueC){
        $virticalSum += $valueC[$keyR];
    };
    $arrVirticalSum += [$keyR => $virticalSum];
}
$arr += ['縦合計' => $arrVirticalSum];

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
    text-align: right;
}
</style>
</head>
<body>
    <!-- ここにテーブル表示 -->
    <table>
        <tr>
            <td></td>
            <?php 
            foreach($arr['r1'] as $key => $value){
                echo '<td>'.$key.'</td>';
            };
            ?>
        </tr>
        <?php
        foreach($arr as $keyR => $valueR){
            echo '<tr>'; 
            echo '<td>'.$keyR.'</td>';
            foreach($valueR as $keyC => $valueC){
                echo '<td>'.$valueC.'</td>';
            }
            echo '</tr>';
        };
        ?>
    </table>
</body>
</html>