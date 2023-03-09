<?php
$referer = $_SERVER['HTTP_REFERER'];
$url = 'contact.php';
if(!strstr($referer,$url)){
  header('Location:index.php');
  exit;
}
require_once('../Controllers/ContactController.php');
session_start();
// エスケープ処理
$_SESSION['name']  = htmlspecialchars($_POST['name'], ENT_QUOTES, "UTF-8");
$_SESSION['kana']  = htmlspecialchars($_POST['kana'], ENT_QUOTES, "UTF-8");
$_SESSION['tel']   = htmlspecialchars($_POST['tel'], ENT_QUOTES, "UTF-8");
$_SESSION['email'] = htmlspecialchars($_POST['email'], ENT_QUOTES, "UTF-8");
$_SESSION['body']  = htmlspecialchars($_POST['body'], ENT_QUOTES, "UTF-8");
// バリデーション実行
$e = new ContactController();
$e = $e->validation();
if(!empty($e)){
  header('Location:../Views/contact.php');
}
?>

<!DOCTYPE html>
<html>
<?php include("htmlHead.php") ?>
<body>
    <div class="main">
    <?php include("header.php") ?>
    <div class="contacts">
        <div class="contacts-main">
        <h1>確認画面</h1>
            <form action='complete.php' method="post">
                <label>氏名</label><br>
                  <p><?php echo $_SESSION['name']?></p>
                  <input type="hidden" name="name" value="<?php echo $_SESSION['name']?>"/>
                <label>フリガナ</label><br>
                  <p><?php echo $_SESSION['kana']?></p>
                  <input type="hidden" name="kana" value="<?php echo $_SESSION['kana']?>"/>
                <label>電話番号</label><br>
                  <p><?php echo $_SESSION['tel']?></p>
                  <input type="hidden" name="tel" value="<?php echo $_SESSION['tel']?>"/>
                <label>メールアドレス</label><br>
                  <p><?php echo $_SESSION['email']?></p>
                  <input type="hidden" name="email" value="<?php echo $_SESSION['email']?>"/>
                <label>お問い合わせ内容</label><br>
                  <p><?php echo nl2br($_SESSION['body'])?></p>
                  <input type="hidden" name="body" value="<?php echo $_SESSION['body']?>"/><br>
                <input type="button" onclick="location.href='contact.php'" value="キャンセル">
                <input type="submit" name ="datapost" value="送信する"/>
            </form>
        </div>
    </div>
    <?php include("footer.php") ?>
</body>

</html>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/js/swiper.min.js"></script>


