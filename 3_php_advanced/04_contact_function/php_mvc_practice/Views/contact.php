<?php
require_once(ROOT_PATH .'Controllers/ContactController.php');

$forms = [
    'name' => '氏名', 
    'kana' => 'フリガナ',
    'tel' => '電話番号',
    'email' => 'メールアドレス'
];
$contact = new ContactController();
if(count($_POST) != 0){
    $params = $contact->confirm();
    //バリデーションをクリアした時に確認画面に遷移（確認画面から戻ってきた時はリダイレクトしない）
    if($params['is_valid'] && !(isset($_POST['back_btn']))){
        header('Location: contact_confirm.php', true, 307);
    }
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
                <h2 class="index_level2 center margin-top-bottom_level2">入力画面</h2>
                <form class="form_center" action='contact.php' method="post">
                    <?php
                    foreach($forms as $key => $value){
                    ?>
                    <div class="margin-top-bottom_level1">
                        <label for=<?php echo $key?>><?php echo $value?></label>
                        <br/>
                        <input 
                            class="form-control <?php if(isset($params['errors'][$key])){echo 'red-border';} ?>" 
                            type="text" 
                            name=<?php echo $key?> 
                            value="<?php if(isset($_POST[$key])){echo $_POST[$key];} ?>"
                        >
                        <?php 
                        if(isset($params['errors'][$key])){
                            echo '<h6 class="error-text">'.$params['errors'][$key].'</h6>';
                        }
                        ?>
                    </div>
                    <?php
                    } 
                    ?>
                    <div class="margin-top-bottom_level1">
                        <label for="body">お問い合わせ内容</label>
                        <br/>
                        <textarea class="form-control <?php if(isset($params['errors']['body'])){echo 'red-border';} ?>" type="text" name="body"
                        ><?php if(isset($_POST['body'])){echo $_POST['body'];} ?></textarea>
                        <?php 
                        if(isset($params['errors']['body'])){
                            echo '<h6 class="error-text">'.$params['errors']['body'].'</h6>';
                        }
                        ?>
                    </div>
                    <div class="center margin-top-bottom_level2">
                        <button class="btn btn-outline-black" type="submit">送信</button>
                    </div>
                </form>
            </div>
            <?php include("footer.php") ?>
        </div>
    </div>
</body>

</html>