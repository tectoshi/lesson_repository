<?php
require_once('../Models/Db.php');

class Contact extends Db {
    public function __construct($dbh = null) {
        parent::__construct($dbh);
    }
 
    /**
     * contactsテーブルからすべてのデータ取得
     */
    public function findAll(){
        $sql = 'SELECT id,name, kana, tel, email, body FROM contacts';
        // $sql .= ' LIMIT 20 OFFSET '.(20 * $page);
        $sth = $this->dbh->query($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * contactsテーブルに投稿内容の保存
     */    
    public function create($contacts)
    {
        $dbh = $this->dbh;
        $sql = 'INSERT INTO
                    contacts(name, kana, tel, email, body)
                VALUE
                            (:name, :kana, :tel, :email, :body)';
        $dbh->beginTransaction();
        try
        {
          $stmt = $dbh->prepare($sql);
          $stmt->bindValue(':name', $contacts['name'],PDO::PARAM_STR_CHAR);
          $stmt->bindValue(':kana', $contacts['kana'], PDO::PARAM_STR);
          $stmt->bindValue(':tel', $contacts['tel'], PDO::PARAM_STR);
          $stmt->bindValue(':email', $contacts['email'], PDO::PARAM_STR);
          $stmt->bindValue(':body', $contacts['body'], PDO::PARAM_STR);
          $stmt->execute();
          $dbh->commit();
        } catch(PDOException $e){
            $dbh->rollback();
            header('Location:../Views/contact.php');
        }
    }
    /**
     * contactsテーブルから詳細情報取得
     */  
    public function findOne($id)
    {
        $dbh = $this->dbh;
        $sql = 'SELECT * FROM contacts WHERE id = :id';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$result){
            exit('投稿がありません');
        }
        return $result;
    }
    /**
     * contactsテーブルに更新内容の保存
     */  
    public function update($contacts)
    {
        $dbh = $this->dbh;
        $sql = 'UPDATE contacts SET
                    name = :name, kana = :kana, tel = :tel, email = :email, body =:body
                WHERE
                    id = :id';
        $dbh->beginTransaction();
        try
        {
           $stmt = $dbh->prepare($sql);
           $stmt->bindValue(':name', $contacts['name'],PDO::PARAM_STR_CHAR);
           $stmt->bindValue(':kana', $contacts['kana'], PDO::PARAM_STR);
           $stmt->bindValue(':tel', $contacts['tel'], PDO::PARAM_STR);
           $stmt->bindValue(':email', $contacts['email'], PDO::PARAM_STR);
           $stmt->bindValue(':body', $contacts['body'], PDO::PARAM_STR);
           $stmt->bindValue(':id', $contacts['id'], PDO::PARAM_INT);
           $stmt->execute();
           $dbh->commit();
        } catch(PDOException $e){
             $dbh->rollback();
             header('Location:../Views/contact.php');
        }
    }
    /**
     * contactsテーブルから削除
     */  
    public function delete($id)
    {
        $dbh = $this->dbh;
        $sql = 'DELETE FROM contacts WHERE id = :id';
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
    }
}

