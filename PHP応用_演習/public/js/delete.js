function deleteClick(id){
  const check = confirm('本当に削除しますか？');
  console.log(check);
  if( check ) {
    // OKなら移動
    window.location.href = "delete.php?id="+ id;
  }
  else {
    e.preventDefault();
  }
}