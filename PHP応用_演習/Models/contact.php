<?php
require_once('../Models/Db.php');

class Contact extends Db {
    public function __construct($dbh = null) {
        parent::__construct($dbh);
    }
 
    /**
     * playersテーブルからすべてデータを取得（20件ごと）
     */
    public function findAll(){
        $sql = 'SELECT name, kana, tel, email, body FROM contacts';
        // $sql .= ' LIMIT 20 OFFSET '.(20 * $page);
        $sth = $this->dbh->query($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * playersテーブルから全データ数を取得
     *
     * @return Int $count 全選手の件数
     */
    public function countAll():Int {
        $sql = 'SELECT count(*) as count FROM players';
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $count = $sth->fetchColumn();
        return $count;
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
}
