<?php
require_once('../database.php');

function dbConnect()
{
  try {
    $dbh = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST. ';charset=utf8', DB_USER, DB_PASSWD);
  } catch (PDOException $e) {
    echo "接続失敗：" . $e->getMessage() . "\n";
    exit();
  }
  return $dbh;
}

function getAllContact()
{
  $dbh = dbConnect();
  //sql文の準備
  $sql = 'SELECT * FROM contact';
  //sql文の実行
  $stmt = $dbh->query($sql);
  //sqlの結果を受けとる
  $result = $stmt->fetchall(PDO::FETCH_ASSOC);
  return $result;
  $dbh = null;
}

?>