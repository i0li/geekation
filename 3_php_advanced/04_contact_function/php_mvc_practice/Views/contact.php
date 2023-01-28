<?php
require_once(ROOT_PATH .'Controllers/ContactController.php');

$forms = [
    'name' => '氏名', 
    'kana' => 'フリガナ',
    'tel' => '電話番号',
    'email' => 'メールアドレス'
];
$contact = new ContactController();

if(isset($_POST['delete_contact_id'])){
    $contact->deleteContact($_POST['delete_contact_id']);
    $_POST = array();
};

$contacts_data = $contact->index();

if(count($_POST) != 0){
    $name   = $_POST['name'];
    $kana   = $_POST['kana'];
    $tel    = $_POST['tel'];
    $email  = $_POST['email'];
    $body   = $_POST['body'];
    $result = $contact->confirm($name, $kana, $tel, $email, $body);
    //バリデーションをクリアした時に確認画面に遷移（確認画面から戻ってきた時はリダイレクトしない）
    if($result['is_valid'] && !(isset($_POST['back_btn']))){
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
    <link rel="stylesheet" type="text/css" href="../css/table.css">
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
                <h2 class="index_level2 center margin-top-bottom_level2">入力画面</h2>
                <form name='contact_form' class='form_center' action='contact_confirm.php' method='post' onsubmit='return validation()'>
                    <?php foreach($forms as $key => $value): ?>
                    <div class="margin-top-bottom_level1">
                        <label for=<?php echo $key?>><?php echo $value?></label>
                        <br/>
                        <input 
                            class="form-control <?php if(isset($result['errors'][$key])){echo 'red-border';} ?>" 
                            type="text" 
                            name=<?php echo $key?> 
                            value="<?php if(isset($_POST[$key])){echo htmlspecialchars($_POST[$key], ENT_QUOTES, "UTF-8");} ?>"
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
                        ><?php if(isset($_POST['body'])){echo htmlspecialchars($_POST['body'] , ENT_QUOTES, "UTF-8");} ?></textarea>
                        <h6 class="error-text body">
                        <?php 
                        if(isset($result['errors']['body'])){
                            echo $result['errors']['body'] ;
                        }
                        ?>
                        </h6>
                    </div>
                    <div class="center margin-top-bottom_level2">
                        <button class="btn btn-outline-black" type='submit'>送信</button>
                        <input name="key" type="hidden" value="" />
                    </div>
                </form>
            </div>

            <div class="table-area">
                <table class='contacts_table'>
                    <tr>
                        <th class='contacts_table_label'>氏名</th>
                        <th class='contacts_table_label'>フリガナ</th>
                        <th class='contacts_table_label'>電話番号</th>
                        <th class='contacts_table_label'>メールアドレス</th>
                        <th class='contacts_table_label'>お問い合わせ内容</th>
                        <th class='contacts_table_label'></th>
                        <th class='contacts_table_label'></th>
                    </tr>
                    <?php if(count($contacts_data) === 0): ?>
                        <td colspan="5" class='contacts_table_data center'>送信されたお問い合わせはありません</td>
                    <?php else: ?>
                    <?php   foreach($contacts_data as $contact_data): ?>
                    <tr>
                        <td class='contacts_table_data'><?=htmlspecialchars($contact_data['name'], ENT_QUOTES, "UTF-8") ?></td>
                        <td class='contacts_table_data'><?=htmlspecialchars($contact_data['kana'], ENT_QUOTES, "UTF-8") ?></td>
                        <td class='contacts_table_data'><?=htmlspecialchars($contact_data['tel'], ENT_QUOTES, "UTF-8") ?></td>
                        <td class='contacts_table_data'><?=htmlspecialchars($contact_data['email'], ENT_QUOTES, "UTF-8") ?></td>
                        <td class='contacts_table_data'><?=nl2br(htmlspecialchars($contact_data['body'], ENT_QUOTES, "UTF-8")) ?></td>
                        <td class='contacts_table_data'>
                            <form name='update_form' class="form_center" action="contact_edit.php" method="post">
                                <button class="btn btn-outline-black" name='update_contact_id' type="submit" value=<?=$contact_data['id'] ?>>編集</button>
                            </form>
                        </td>
                        <td class='contacts_table_data'>
                            <form name='delete_form' class="form_center" action="contact.php" method="post" onsubmit='return delete_confirm()'>
                                <button class="btn btn-outline-black" name='delete_contact_id' type="submit" value=<?=$contact_data['id'] ?>>削除</button>
                            </form>
                        </td>
                    </tr>
                    <?php   endforeach; ?>
                    <?php endif; ?>
                </table>
            </div>
            <?php include("footer.php") ?>
        </div>
    </div>
</body>

</html>