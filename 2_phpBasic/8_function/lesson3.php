<?php
// 以下は1から引数の数字までを順番に表示するプログラムです。
// その数が3で割り切れるなら"アホ"、5で割り切れるなら"わん"、
// 両方で割り切れるなら"アホわん"
// と表示してください。
// 判定は関数に記述し、関数を呼び出して結果表示すること
// 両方で割り切れるケースは15の倍数とはせずに条件を重ねて設定してください。

// 表示例）15を引数に指定した場合
// 1
// 2
// 3 アホ
// 4
// 5 わん
// 6 アホ
// 7
// 8
// 9 アホ
// 10 わん
// 11
// 12 アホ
// 13
// 14
// 15 アホわん


function nabeatsu($i)
{
    // この関数内に処理を記述
    for($num = 1;$num <= $i; $num++){
        $outputText = $num.' ';
        if($num%3 == 0){
            $outputText = $outputText.'アホ';
        };
        if($num%5 == 0){
            $outputText = $outputText.'わん';
        };
        echo $outputText;
        echo '<br/>';
    };
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>世界のナベアツプログラム</title>
</head>
<body>
    <section>
        <!-- ここに結果表示 -->
        <?php
        nabeatsu(15);
        ?>
    </section>
</body>
</html>