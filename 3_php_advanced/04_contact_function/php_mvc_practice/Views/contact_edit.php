<?php
require_once(ROOT_PATH .'Controllers/ContactController.php');

//戻るボタンを押した時は無条件に入力画面に戻る
if(isset($_POST['back_btn'])){
  header('Location: contact.php');
  exit();
}

$forms = [
    'name' => '氏名', 
    'kana' => 'フリガナ',
    'tel' => '電話番号',
    'email' => 'メールアドレス'
];
$contact = new ContactController();

//更新ボタンを押した際はバリデーションを行い、クリアしたらデータベースに登録して入力画面に戻る
if(isset($_POST['edit'])){
  $id     = $_POST['update_contact_id'];
  $name   = $_POST['name'];
  $kana   = $_POST['kana'];
  $tel    = $_POST['tel'];
  $email  = $_POST['email'];
  $body   = $_POST['body'];
  $result = $contact->confirm($name, $kana, $tel, $email, $body);
  if($result['is_valid']){
    $contact->updateContact($id, $name, $kana, $tel, $email, $body);
    header('Location: contact.php');
  }
//更新画面に初めてきたときはidよりお問い合わせ内容を検索しフォームに表示
}else{
  $contact_data = $contact->edit_index($_POST['update_contact_id']);
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
    <script defer src="../js/contact.js"></script>
</head>
<body>
    <div class="main">
        <div class="container-fruid" >
            <?php include("header.php") ?>
            <div class="form-area">
                <h2 class="index_level2 center margin-top-bottom_level2">更新画面</h2>
                <form name='contact_form' class='form_center' action='contact_edit.php' method='post' onsubmit='return validation()'>
                    <?php foreach($forms as $key => $value): ?>
                    <div class="margin-top-bottom_level1">
                        <label for=<?php echo $key?>><?php echo $value?></label>
                        <br/>
                        <input 
                            class="form-control <?php if(isset($result['errors'][$key])){echo 'red-border';} ?>" 
                            type="text" 
                            name=<?php echo $key?> 
                            value="<?=htmlspecialchars($contact_data[$key]) ?>"
                        >
                        <h6 class="error-text <?php echo $key ?>">
                        <?php 
                        if(isset($result['errors'][$key])){
                            echo $result['errors'][$key];
                        }
                        ?>
                        </h6>
                    </div>
                    <?php endforeach; ?>
                    <div class="margin-top-bottom_level1">
                        <label for="body">お問い合わせ内容</label>
                        <br/>
                        <textarea class="form-control <?php if(isset($result['errors']['body'])){echo 'red-border';} ?>" type="text" name="body"
                        ><?=htmlspecialchars($contact_data['body']) ?></textarea>
                        <h6 class="error-text body">
                        <?php 
                        if(isset($result['errors']['body'])){
                            echo $result['errors']['body'] ;
                        }
                        ?>
                        </h6>
                    </div>
                    <input name="update_contact_id" type="hidden" value="<?=$contact_data['id'] ?>" />
                    <table class="button-table margin-top-bottom_level2">
                        <tr>
                            <td><button class="btn btn-outline-black" name="back_btn" type="submit" formmethod="post" onclick="contact_form.key.value='back'">キャンセル</button></td>
                            <td><button class="btn btn-outline-black" name='edit' type="submit" onclick="contact_form.key.value='submit'">更新</button></td>
                            <input name="key" type="hidden" value="" />
                        </tr>
                    </table>
                </form>
            </div>
            <?php include("footer.php") ?>
        </div>
    </div>
</body>

</html>