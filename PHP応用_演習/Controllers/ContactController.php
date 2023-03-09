<?php
require_once('../Models/contact.php');
class ContactController
{
    private $request; // リクエストパラメータ(GET,POST)
    private $Contact; // Contactモデル
    public $e;
    public $dbh;
    public function __construct()
    {
        // リクエストパラメータの取得
        $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;

        // モデルオブジェクトの生成
        $this->Contact = new Contact();
        // 別モデルと連携
        $this->dbh = $this->Contact->get_db_handler();
    }

    public function index()
    {
        $page = 0;
        if (isset($this->request['get']['page'])) {
            $page = $this->request['get']['page'];
        }

        $contacts = $this->Contact->findAll($page);
        $contacts_count = $this->Contact->countAll();
        $params = [
            'contacts' => $contacts,
            'pages' => $contacts_count / 20,
            'page' => $page // ページ番号
        ];
        return $params;
    }
    public function validation()
    {
        $contacts = $_SESSION;
        $e = $this->e;
         //名前バリデーション
        if(empty($contacts['name'])){
            $e[] = '氏名を入力してください';
        }
        if(mb_strlen(($contacts['name']), "UTF-8") > 11){
            $e[] = '氏名は10文字以内で入力してください'; 
        }
        //フリガナバリデーション
        if(empty($contacts['kana'])){
            $e[] = 'フリガナを入力してください'; 
        }
        if(mb_strlen(($contacts['kana']), "UTF-8") > 11){
            $e[] = 'フリガナは10文字以内で入力してください'; 
        }
        //電話番号バリデーション
        if(!empty($contacts['tel'])){
            if(!preg_match( '/^[0-9]+$/', $contacts['tel']) ) {
                $e[] = '電話番号は数字を入力してください';
            }
        }
        //メールアドレスバリデーション
        if(empty($contacts['email'])){
            $e[] = 'メールアドレスを入力してください'; 
        }
        if(!preg_match('/^[a-z0-9._+^~-]+@[a-z0-9.-]+$/i', $contacts['email'])) {
            $e[] = 'メールアドレスの形式が誤っています';
        }
        //お問い合わせ内容のバリデーション
        if(empty($contacts['body'])){
            $e[] = 'お問い合わせ内容を入力してください';
        }
        return $e;
    }
    public function create()
    {
        $contacts = $this->request['post'];
        $this->Contact->create($contacts);
    }
}
