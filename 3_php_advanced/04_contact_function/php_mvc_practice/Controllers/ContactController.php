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
    $errors = Null;

    if(count($this->request['post']) === 0){
      return $errors;
    }

    $this->Contact->setName($this->request['post']['name']);
    $this->Contact->setKana($this->request['post']['kana']);
    $this->Contact->setTel($this->request['post']['tel']);
    $this->Contact->setEmail($this->request['post']['email']);
    $this->Contact->setBody($this->request['post']['body']);

    if($this->Contact->is_valid()){
      header('Location: contact_confirm.php', true, 307);
    }

    $errors = $this->Contact->getErrors();

    return $errors;
  }
}
?>