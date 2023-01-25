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
   * contactsテーブルの登録
   */
  public function insertContact($name, $kana, $tel, $email, $body){
    try {
      $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->dbh->beginTransaction();

      $sql  = 'insert into contacts (name, kana, tel, email, body) ';
      $sql .= 'values (:name, :kana, :tel, :email, :body)';
      $sth = $this->dbh->prepare($sql);
      $sth->execute(array(
        ':name'  => $name ,
        ':kana'  => $kana ,
        ':tel'   => $tel  ,
        ':email' => $email,
        ':body'  => $body 
      ));

      $this->dbh->commit();
    }catch (Exception $e) {
      $this->dbh->rollBack();
      echo "登録失敗: " . $e->getMessage() . "\n";
      exit();
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