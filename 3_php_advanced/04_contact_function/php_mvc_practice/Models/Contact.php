<?php
require_once(ROOT_PATH .'Models/Db.php');

class Contact extends Db {

  public function __construct($dbh = null) {
    parent::__construct($dbh);
  }

  /**
   *  contactsテーブルテーブルからすべてのデータを取得
   */
  public function findAll(){
    $sql  = 'SELECT ';
    $sql .= ' contacts.id, ';
    $sql .= ' contacts.name, ';
    $sql .= ' contacts.kana, ';
    $sql .= ' contacts.tel, ';
    $sql .= ' contacts.email, ';
    $sql .= ' contacts.body ';
    $sql .= 'FROM ';
    $sql .= ' contacts ;';
    $sth = $this->dbh->prepare($sql);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);

    return $result;
  }

  /**
   *  contactsテーブルからidを指定して検索
   */
  public function findById($id){
    $sql  = 'SELECT ';
    $sql .= ' contacts.id, ';
    $sql .= ' contacts.name, ';
    $sql .= ' contacts.kana, ';
    $sql .= ' contacts.tel, ';
    $sql .= ' contacts.email, ';
    $sql .= ' contacts.body ';
    $sql .= 'FROM ' ;
    $sql .= ' contacts ';
    $sql .= 'WHERE ';
    $sql .= ' contacts.id = :id ;';
    $sth = $this->dbh->prepare($sql);
    $sth->execute(array(
      ':id' => $id
    ));
    $result = $sth->fetch(PDO::FETCH_ASSOC);

    return $result;
  }

  /**
   *  contactsテーブルからidを指定して値を更新
   */
  public function updateContact($id, $name, $kana, $tel, $email, $body){
    try {
      $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->dbh->beginTransaction();

      $sql  = 'UPDATE ';
      $sql .= ' contacts ';
      $sql .= 'SET ';
      $sql .= ' contacts.name = :name, ';
      $sql .= ' contacts.kana = :kana, ';
      $sql .= ' contacts.tel = :tel, ';
      $sql .= ' contacts.email = :email, ';
      $sql .= ' contacts.body = :body ';
      $sql .= 'WHERE ';
      $sql .= ' contacts.id = :id ;';

      $sth = $this->dbh->prepare($sql);
      $sth->execute(array(
        ':id'    => $id   ,
        ':name'  => $name ,
        ':kana'  => $kana ,
        ':tel'   => $tel  ,
        ':email' => $email,
        ':body'  => $body 
      ));

      $this->dbh->commit();
    }catch (Exception $e){
      $this->dbh->rollBack();
      echo "登録失敗: " . $e->getMessage() . "\n";
      exit();
    }
  }

  /**
   *  contactsテーブルからidを指定して値を削除
   */
  public function deleteContact($id){
    try {
      $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->dbh->beginTransaction();

      //DELETE FROM tbl_name [WHERE where_condition]
      $sql  = 'DELETE FROM';
      $sql .= ' contacts ';
      $sql .= 'WHERE ';
      $sql .= ' contacts.id = :id ;';

      $sth = $this->dbh->prepare($sql);
      $sth->execute(array(
        ':id' => $id 
      ));

      $this->dbh->commit();
    }catch (Exception $e){
      $this->dbh->rollBack();
      echo "登録失敗: " . $e->getMessage() . "\n";
      exit();
    }
  }

  /**
   * contactsテーブルの登録
   */
  public function insertContact($name, $kana, $tel, $email, $body){
    try {
      $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->dbh->beginTransaction();

      $sql  = 'INSERT INTO ';
      $sql .= ' contacts (name, kana, tel, email, body) ';
      $sql .= 'VALUES ';
      $sql .= ' (:name, :kana, :tel, :email, :body)';

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
}