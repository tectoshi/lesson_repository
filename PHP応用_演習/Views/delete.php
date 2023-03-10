<?php
require_once('../Controllers/ContactController.php');
//詳細情報取得
$id = $_GET['id'];
if(empty($id)){
  header('Location:index.php');
}
$contacts = new ContactController;
$contact = $contacts->delete($id);
header('Location:contact.php');

?>