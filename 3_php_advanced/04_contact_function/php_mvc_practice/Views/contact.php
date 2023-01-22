<?php
require_once(ROOT_PATH .'Controllers/ContactController.php');
$contact = new ContactController();
$errors = $contact->confirm();
$is_exist_post = isset($_POST);
function get_value($param, $name){
    $value = '';
    if(isset($param[$name])){
        $value = $param[$name];
    };
    return $value;
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
                    <div class="margin-top-bottom_level1">
                        <label for="name">氏名</label>
                        <br/>
                        <input class="form-control <?php echo get_value($errors,'name'); ?>" type="text" name="name" value="<?php echo get_value($_POST, 'name') ?>">
                        <?php 
                        if(isset($errors['name'])){
                        ?>
                        <h6 class='error-text'>
                        <?php
                            echo $errors['name'];
                        }
                        ?>
                        </h6>
                    </div>
                    <div class="margin-top-bottom_level1">
                        <label for="kana">フリガナ</label>
                        <br/>
                        <input class="form-control <?php echo get_value($errors,'kana'); ?>" type="text" name="kana" value="<?php echo get_value($_POST, 'kana') ?>">
                        <?php 
                        if(isset($errors['kana'])){
                        ?>
                        <h6 class='error-text'>
                        <?php
                            echo $errors['kana'];
                        }
                        ?>
                        </h6>
                    </div>
                    <div class="margin-top-bottom_level1">
                        <label for="tel">電話番号</label>
                        <br/>
                        <input class="form-control <?php echo get_value($errors,'tel'); ?>" type="text" name="tel" value="<?php echo get_value($_POST, 'tel') ?>">
                        <?php 
                        if(isset($errors['tel'])){
                        ?>
                        <h6 class='error-text'>
                        <?php
                            echo $errors['tel'];
                        }
                        ?>
                        </h6>
                    </div>
                    <div class="margin-top-bottom_level1">
                        <label for="email">メールアドレス</label>
                        <br/>
                        <input class="form-control <?php echo get_value($errors,'email'); ?>" type="text" name="email" value="<?php echo get_value($_POST, 'email') ?>">
                        <?php 
                        if(isset($errors['email'])){
                        ?>
                        <h6 class='error-text'>
                        <?php
                            echo $errors['email'];
                        }
                        ?>
                        </h6>
                    </div>
                    <div class="margin-top-bottom_level1">
                        <label for="body">お問い合わせ内容</label>
                        <br/>
                        <textarea class="form-control <?php echo get_value($errors,'body'); ?>" type="text" name="body"><?php echo get_value($_POST, 'body') ?></textarea>
                        <?php 
                        if(isset($errors['body'])){
                        ?>
                        <h6 class='error-text'>
                        <?php
                            echo $errors['body'];
                        }
                        ?>
                        </h6>
                    </div>
                    <div class="center margin-top-bottom_level2">
                        <button class="btn btn-outline-black" type="submit">送信</button>
                    </div>
                </form>
            </div>
            <?php 
            echo Null;
            include("footer.php") ?>
        </div>
    </div>
</body>

</html>