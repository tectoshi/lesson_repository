<?php
//ダイレクトアクセス禁止
$referer = $_SERVER['HTTP_REFERER'];
$url = 'confirmation.php';
if(!strstr($referer,$url)){
  header('Location:index.php');
  exit;
}
require_once('../Controllers/ContactController.php');
// テーブルへの保存実行
$dbSave = new ContactController();
$dbSave->create();
// セッション初期化
session_start();
$_SESSION = [];
?>

<!DOCTYPE html>
<html>
<?php include("htmlHead.php") ?>
<body>
    <div class="main">
    <?php include("header.php") ?>
    <div class="contacts">
        <div class="contacts-main">
            <h1>完了画面</h1>
            <p>お問い合わせ内容を送信しました。</p>
            <p>ありがとうございました。</p><br>
            <input type="button" onclick="location.href='index.php'" value="トップへ">        </div>
    </div>
    <?php include("footer.php") ?>
</body>

</html>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/js/swiper.min.js"></script>


