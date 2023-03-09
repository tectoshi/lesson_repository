<?php
require_once('../Models/Db.php');

class Contact extends Db {
    public function __construct($dbh = null) {
        parent::__construct($dbh);
    }
 
    /**
     * playersテーブルからすべてデータを取得（20件ごと）
     */
    public function findAll($page = 0):Array {
        $sql = 'SELECT';
        $sql .= ' players.id,';
        $sql .= ' players.uniform_num,';
        $sql .= ' players.position,';
        $sql .= ' players.name as player_name,';
        $sql .= ' players.club,';
        $sql .= ' players.birth,';
        $sql .= ' players.height,';
        $sql .= ' players.weight,';
        $sql .= ' countries.name as country_name';
        $sql .= ' FROM players';
        $sql .= ' JOIN countries ON players.country_id = countries.id';
        $sql .= ' WHERE players.del_flg = 0';
        $sql .= ' LIMIT 20 OFFSET '.(20 * $page);
        $sth = $this->dbh->prepare($sql);
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
