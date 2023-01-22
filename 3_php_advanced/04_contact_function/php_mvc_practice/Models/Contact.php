<?php
require_once(ROOT_PATH .'Models/Db.php');

class Contact extends Db {
  private $id;
  private $name;
  private $kana;
  private $tel;
  private $email;
  private $body;
  private $created_at;
  
  private $errors;
  

  public function __construct($dbh = null) {
    parent::__construct($dbh);
  }

  /**
   * バリデーション
   */
  public function getErrors(){
    return $this->errors;
  }
  public function is_valid(){
    $this->validate_name();
    $this->validate_kana();
    $this->validate_tel();
    $this->validate_email();
    $this->validate_body();

    if(is_null($this->errors)){
      return True;
    }
    return count($this->errors) === 0;
  }

  private function validate_name(){
    if(strlen($this->name) === 0){
      $this->errors['name'] = '氏名を入力してください';
      return;
    }
    if(strlen($this->name)>10){
      $this->errors['name'] = '10文字以内で入力してください';
      return;
    }
  }
  private function validate_kana(){
    if(strlen($this->kana) === 0){
      $this->errors['kana'] = 'フリガナを入力してください';
      return;
    }
    if(strlen($this->id)>10){
      $this->errors['kana'] = '10文字以内で入力してください';
      return;
    }
  }
  private function validate_tel(){
    if(preg_match('/[^0-9]+/', $this->tel)){
      $this->errors['tel'] = '数字のみで入力してください';
      return;
    }
  }
  private function validate_email(){
    if(strlen($this->email) === 0){
      $this->errors['email'] = 'メールアドレスを入力してください';
      return;
    }
    if(!preg_match('/.+@.+/', $this->email)){
      $this->errors['email'] = 'メールアドレスに「@」を挿入してください';
      return;
    }
  }
  private function validate_body(){
    if(strlen($this->email) === 0){
      $this->errors['body'] = 'お問い合わせ内容を入力してください';
      return;
    }
  }


  /**
   * アクセス修飾子
   */
  public function getId() : string{
    return $this->id;
  }
  public function getName() : string{
    return $this->name;
  }
  public function getKana() : string{
    return $this->kana;
  }
  public function getTel() : string{
    return $this->tel;
  }
  public function getEmail() : string{
    return $this->email;
  }
  public function getBody() : string{
    return $this->body;
  }
  public function getCreatedAt() : string{
    return $this->created_at;
  }
  public function setId(string $id){
    $this->id = $id;
  }
  public function setName(string $name){
    $this->name = $name;
  }
  public function setKana(string $kana){
    $this->kana = $kana;
  }
  public function setTel(string $tel){
    $this->tel = $tel;
  }
  public function setEmail(string $email){
    $this->email = $email;
  }
  public function setBody(string $body){
    $this->body = $body;
  }
  public function setCreatedAt(string $created_at){
    $this->created_at = $created_at;
  }

}