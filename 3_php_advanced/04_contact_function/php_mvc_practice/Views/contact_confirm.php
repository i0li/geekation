<?php
require_once(ROOT_PATH .'Controllers/ContactController.php');

if(isset($_POST['submit'])){
    $contact = new ContactController();
    $contact->insertContact();
    header('Location: contact_complete.php', true, 307);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Casteria</title>
    <link rel="stylesheet" type="text/css" href="../css/base.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css" />
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <script defer src="../js/index.js"></script>
</head>
<body>
    <div class="main">
        <div class="container-fruid" >
            <?php include("header.php") ?>
            <div class="form-area">
                <h2 class="index_level2 center margin-top-bottom_level2">確認画面</h2>
                <form class="form_center" action="contact_confirm.php" method="post">
                    <div class="margin-top-bottom_level1">
                        <label for="name">氏名</label><br/>
                        <input class="form-control" type="text" name="name" value="<?php echo $_POST["name"]?>" readonly>
                    </div>
                    <div class="margin-top-bottom_level1">
                        <label for="kana">フリガナ</label><br/>
                        <input class="form-control" type="text" name="kana" value="<?php echo $_POST["kana"]?>" readonly>
                    </div>
                    <div class="margin-top-bottom_level1">
                        <label for="tel">電話番号</label><br/>
                        <input class="form-control" type="text" name="tel" value="<?php echo $_POST["tel"]?>" readonly>
                    </div>
                    <div class="margin-top-bottom_level1">
                        <label for="email">メールアドレス</label><br/>
                        <input class="form-control" type="text" name="email" value="<?php echo $_POST["email"]?>" readonly>
                    </div>
                    <div class="margin-top-bottom_level1">
                        <label for="body">お問い合わせ内容</label><br/>
                        <textarea class="form-control" name="body" readonly><?php echo $_POST["body"]?></textarea>
                    </div>
                    <table class="button-table margin-top-bottom_level2">
                        <tr>
                            <td><button class="btn btn-outline-black" name="back_btn" type="submit" formaction="contact.php" formmethod="post">キャンセル</button></td>
                            <td><button class="btn btn-outline-black" name='submit' type="submit">送信</button></td>
                        </tr>
                    </table>
                </form>
            </div>
            <?php include("footer.php") ?>
        </div>
    </div>
</body>

</html>