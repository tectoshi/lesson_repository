<?php
require_once('../Controllers/ContactController.php');
session_start();
//バリデーション実行
if(!empty($_SESSION)){
    $e = new ContactController();
    $e = $e->validate();
}
//詳細情報取得
  $id = $_GET['id'];
  if(empty($id)){
    header('Location:index.php');
  }
  $contacts = new Contact;
  $contact = $contacts->findOne($id);
?>

<!DOCTYPE html>
<html>
<?php include("htmlHead.php") ?>
<body>
    <div class="main">
    <?php include("header.php") ?>
    <div class="contacts">
        <div class="contacts-main">
            <h1>編集画面</h1>
            <!-- エラーメッセージの表示 -->
            <?php if(!empty($e)): ?>
                <?php foreach($e as $value): ?>
                    <p><?php echo '・'.$value;?></p>
                <?php endforeach;?>
            <?php endif;?>
            <form action='update.php' class="validationForm" method="post"><br>
                <input type="hidden" name="id" value="<?php echo $id ?>"/>
                <label>氏名</label><br>
                <input type="text" name="name" class="name" data-maxlength="10" id="name" value="<?php echo $contact['name'] ?>"/><br>
                <label>フリガナ</label><br>
                <input type="text" name="kana" class="kana" data-maxlength="10" id="kana" value="<?php echo $contact['kana'] ?>"/><br>
                <label>電話番号</label><br>
                <input type="text" name="tel" class="tel" value="<?php echo $contact['tel'] ?>"/><br>
                <label>メールアドレス</label><br>
                <input type="text" name="email" class="email" id="email" value="<?php echo $contact['email'] ?>"/><br>
                <label>お問い合わせ内容</label><br>
                <textarea name="body" rows="5" cols="50" class="body" id="inquiry"><?php echo $contact['body'] ?></textarea><br>
                <input type="submit" name = "datapost" value="送信"/><br>
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
