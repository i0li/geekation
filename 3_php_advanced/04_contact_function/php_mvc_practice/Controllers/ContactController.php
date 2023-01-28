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

  /**
   * cotact.phpで表の値を取得するための関数
   */
  public function index() {
    $contacts_date = $this->Contact->findAll();
    return $contacts_date;
  }

  /**
   * databaseに値を追加する関数
   */
  public function insertContact(){
    $name  = $this->request['post']['name'];
    $kana  = $this->request['post']['kana'];
    $tel   = $this->request['post']['tel'];
    $email = $this->request['post']['email'];
    $body  = $this->request['post']['body'];
    if(strlen($tel) === 0){
      $tel = Null;
    }
    $this->Contact->insertContact($name, $kana, $tel, $email, $body);
  }

    /**
   *  contact_confirm.phpでformに入力するための値を取得する関数
   */
  public function edit_index($id) {
    $contact_data = $this->Contact->findById($id);
    return $contact_data;
  }

  /**
   * idを指定してdatabaseの値を変える関数
   */
  public function updateContact($id, $name, $kana, $tel, $email, $body){
    $this->Contact->updateContact($id, $name, $kana, $tel, $email, $body);
  }

  /**
   * idを指定してdatabaseの値を削除する関数
   */
  public function deleteContact($id){
    $this->Contact->deleteContact($id);
  }


  /**
   * 入力フォームのバリデーションを行う関数
   */
  public function confirm($name, $kana, $tel, $email, $body) {
    $errors = array();
    $is_valid = False;

    //氏名のバリデーションチェック
    if(mb_strlen($name) === 0){
      $errors['name'] = '氏名を入力してください';
    }
    elseif(mb_strlen($name)>10){
      $errors['name'] = '10文字以内で入力してください';
    }
    //フリガナのバリデーションチェック
    if(mb_strlen($kana) === 0){
      $errors['kana'] = 'フリガナを入力してください';
    }
    elseif(mb_strlen($kana)>10){
      $errors['kana'] = '10文字以内で入力してください';
    }
    //電話番号のバリデーションチェック
    if(preg_match('/[^0-9]+/', $tel)){
      $errors['tel'] = '数字のみで入力してください';
    }
    //メールアドレスのバリデーションチェック
    if(mb_strlen($email) === 0){
      $errors['email'] = 'メールアドレスを入力してください';
    }elseif(!preg_match('/.+@.+/', $email)){
      $errors['email'] = 'メールアドレスに「@」を挿入してください';
    }
    //お問い合わせ内容のバリデーションチェック
    if(mb_strlen($body) === 0){
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