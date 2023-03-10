<?php
require_once('../Controllers/ContactController.php');
session_start();
//バリデーション実行
if(!empty($_SESSION)){
    $e = new ContactController();
    $e = $e->validate();
}
//お問い合わせページ更新時初期化
$referer = $_SERVER['HTTP_REFERER'];
$url = 'contact.php';
if(strstr($referer,$url) || strstr($referer,'edit.php') || strstr($referer,'update.php')){
  $_SESSION = [];
}

//dbから一覧データ取得
$contactAll = new Contact();
$contacts = $contactAll->findAll();
?>

<!DOCTYPE html>
<html>
<?php include("htmlHead.php") ?>
<body>
    <div class="main">
    <?php include("header.php") ?>
    <div class="contacts">
        <div class="contacts-main">
            <h1>入力画面</h1>
            <!-- エラーメッセージの表示 -->
            <?php if(!empty($e)): ?>
                <?php foreach($e as $value): ?>
                    <p><?php echo '・'.$value;?></p>
                <?php endforeach;?>
            <?php endif;?>
            <form action='confirmation.php' class="validationForm" method="post"><br>
                <label>氏名</label><br>
                <input type="text" name="name" class="name" data-maxlength="10" id="name" value="<?php if( !empty($_SESSION['name']) ){ echo $_SESSION['name']; } ?>"/><br>
                <label>フリガナ</label><br>
                <input type="text" name="kana" class="kana" data-maxlength="10" id="kana" value="<?php if( !empty($_SESSION['kana']) ){ echo $_SESSION['kana']; } ?>"/><br>
                <label>電話番号</label><br>
                <input type="text" name="tel" class="tel" value="<?php if( !empty($_SESSION['tel']) ){ echo $_SESSION['tel']; } ?>"/><br>
                <label>メールアドレス</label><br>
                <input type="text" name="email" class="email" id="email" value="<?php if( !empty($_SESSION['email']) ){ echo $_SESSION['email']; } ?>"/><br>
                <label>お問い合わせ内容</label><br>
                <textarea name="body" rows="5" cols="50" class="body" id="inquiry"><?php if( !empty($_SESSION['body']) ){ echo $_SESSION['body']; } ?></textarea><br>
                <input type="submit" name = "datapost" value="送信"/><br>
            </form>
        </div>
    </div>
    <div class="main">
        <div class="contacts-data">
            <table>
                <tr>
                    <th>氏名</th><th>フリガナ</th><th>電話番号</th><th>メールアドレス</th><th>お問い合わせ内容</th><th></th><th></th>
                </tr>
                <?php foreach($contacts as $contact): ?>
                    <tr>
                        <td><?= htmlspecialchars($contact['name']) ?></td>   
                        <td><?= htmlspecialchars($contact['kana']) ?></td>   
                        <td><?= htmlspecialchars($contact['tel']) ?></td>   
                        <td><?= htmlspecialchars($contact['email']) ?></td>   
                        <td><?= nl2br(htmlspecialchars(($contact['body']))) ?></td>   
                        <td><input type="button" onclick="location.href='edit.php?id=<?= htmlspecialchars($contact['id']) ?>'" value="編集"></td>   
                        <td><input type="button" onclick="deleteClick(<?php echo htmlspecialchars($contact['id'])?>);"value="削除" id="deletebtn"></td>
                    </tr>
                <?php endforeach; ?>
            </table>
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


