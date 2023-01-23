<?php
require_once(ROOT_PATH .'Models/Contact.php');

class ContactController {
  private $request;
  private $Contact;

  public function __construct() {
    //リクエストパラメータの取得
    $this->request['get'] = $_GET;
    $this->request['post'] = $_POST;

    //モデルオブジェクトの生成
    $this->Contact = new Contact();
    //別モデルとの連携
    $dbh = $this->Contact->get_db_handler();
  }

  public function confirm() {
    $errors = array();
    $is_valid = False;
    $name = $this->request['post']['name'];
    $kana = $this->request['post']['kana'];
    $tel = $this->request['post']['tel'];
    $email = $this->request['post']['email'];
    $body = $this->request['post']['body'];

    //氏名のバリデーションチェック
    if(strlen($name) === 0){
      $errors['name'] = '氏名を入力してください';
    }
    elseif(strlen($name)>10){
      $errors['name'] = '10文字以内で入力してください';
      return;
    }
    //フリガナのバリデーションチェック
    if(strlen($kana) === 0){
      $errors['kana'] = 'フリガナを入力してください';
    }
    elseif(strlen($kana)>10){
      $errors['kana'] = '10文字以内で入力してください';
    }
    //電話番号のバリデーションチェック
    if(preg_match('/[^0-9]+/', $tel)){
        $errors['tel'] = '数字のみで入力してください';
    }
    //メールアドレスのバリデーションチェック
    if(strlen($email) === 0){
      $errors['email'] = 'メールアドレスを入力してください';
    }elseif(!preg_match('/.+@.+/', $email)){
      $errors['email'] = 'メールアドレスに「@」を挿入してください';
    }
    //お問い合わせ内容のバリデーションチェック
    if(strlen($body) === 0){
      $errors['body'] = 'お問い合わせ内容を入力してください';
    }

    //バリデーションをクリアした場合、確認画面へ遷移
    if(count($errors) === 0){
      $is_valid = True;
    }

    $params = [
      'errors' => $errors,
      'is_valid' => $is_valid
    ];
    return $params;
  }
}
?>