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