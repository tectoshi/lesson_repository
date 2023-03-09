document.addEventListener('DOMContentLoaded', () => {
    //.validationForm を指定した最初の form 要素を取得
    const validationForm = document.querySelector('.validationForm');
    //.validationForm を指定した form 要素が存在すれば
    if(validationForm) {
      //エラーを表示する span 要素に付与するクラス名（エラー用のクラス）
      const errorClassName = 'error';
      
      //name クラスを指定された要素の集まり  
      const nameElems = document.querySelectorAll('.name');
      //kana クラスを指定された要素の集まり  
      const kanaElems = document.querySelectorAll('.kana');
      //email クラスを指定された要素の集まり
      const emailElems =  document.querySelectorAll('.email');
      //tel クラスを指定された要素の集まり
      const telElems =  document.querySelectorAll('.tel');
      //tel クラスを指定された要素の集まり
      const bodyElems =  document.querySelectorAll('.body');
      
      //エラーメッセージを表示する span 要素を生成して親要素に追加する関数
      //elem ：対象の要素
      //errorMessage ：表示するエラーメッセージ
      const createError = (elem, errorMessage) => {
        //span 要素を生成
        const errorSpan = document.createElement('span');
        //エラー用のクラスを追加（設定）
        errorSpan.classList.add(errorClassName);
        //aria-live 属性を設定
        errorSpan.setAttribute('aria-live', 'polite');
        //引数に指定されたエラーメッセージを設定
        errorSpan.textContent = errorMessage;
        //elem の親要素の子要素として追加
        elem.parentNode.appendChild(errorSpan);
      }
   
      //form 要素の submit イベントを使った送信時の処理
      validationForm.addEventListener('submit', (e) => {
        //エラーを表示する要素を全て取得して削除（初期化）
        const errorElems = validationForm.querySelectorAll('.' + errorClassName);
        errorElems.forEach( (elem) => {
          elem.remove(); 
        });
        
        //.name を指定した要素を検証
        nameElems.forEach( (elem) => {
          //値（value プロパティ）の前後の空白文字を削除
          const elemValue = elem.value.trim(); 
          //値が空の場合はエラーを表示してフォームの送信を中止
          if(elemValue.length === 0) {
            createError(elem, '氏名の入力は必須です');
            e.preventDefault();
          }else if(elemValue.length > 11 ){
            createError(elem, '氏名は10文字以内でご入力ください');
            e.preventDefault();
          }
        });
        //.kana を指定した要素を検証
        kanaElems.forEach( (elem) => {
          //値（value プロパティ）の前後の空白文字を削除
          const elemValue = elem.value.trim(); 
          //値が空の場合はエラーを表示してフォームの送信を中止
          if(elemValue.length === 0) {
            createError(elem, 'フリガナの入力は必須です');
            e.preventDefault();
          }else if(elemValue.length > 11 ){
            createError(elem, 'フリガナは10文字以内でご入力ください');
            e.preventDefault();
          }
        });
        
        //.email を指定した要素を検証
        emailElems.forEach( (elem) => {
          //Email の検証に使用する正規表現パターン
          const elemValue = elem.value.trim(); 
          const pattern = /^[a-z0-9._+^~-]+@[a-z0-9.-]+$/i;
          //値が空でなければ
          if(elemValue.length === 0) {
            createError(elem, 'emailの入力は必須です');
            e.preventDefault();
          }else if(!pattern.test(elem.value)) {
            //test() メソッドで値を判定し、マッチしなければエラーを表示してフォームの送信を中止
              createError(elem, 'Email アドレスの形式が正しくありません。');
              e.preventDefault();
            }
          }
        );
        
        //.tel を指定した要素を検証
        telElems.forEach( (elem) => {
          //電話番号の検証に使用する正規表現パターン
          const pattern = /^[0-9]+$/;
          //値が空でなければ
          if(elem.value !=='') {
            //test() メソッドで値を判定し、マッチしなければエラーを表示してフォームの送信を中止
            if(!pattern.test(elem.value)) {
              createError(elem, '電話番号の形式が正しくありません。');
              e.preventDefault();
            }
          }
        });

        //.body を指定した要素を検証
        bodyElems.forEach( (elem) => {
            //値（value プロパティ）の前後の空白文字を削除
            const elemValue = elem.value.trim(); 
            //値が空の場合はエラーを表示してフォームの送信を中止
            if(elemValue.length === 0) {
                createError(elem, 'お問い合わせ内容の入力は必須です');
                e.preventDefault();
            }
        });

        //エラーの最初の要素を取得
        const errorElem =  validationForm.querySelector('.' + errorClassName);
        //エラーがあればエラーの最初の要素の位置へスクロール
        if(errorElem) {
          const errorElemOffsetTop = errorElem.offsetTop;
          window.scrollTo({
            top: errorElemOffsetTop - 40,  //40px 上に位置を調整
            //スムーススクロール
            behavior: 'smooth'
          });
        }
      }); 
    }
  });