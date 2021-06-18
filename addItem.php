<?php 
  require "util.php";

  // ----------------------------------------------------
  //                  ToDo リスト追加
  // ----------------------------------------------------

  if (isset($_POST['submit'])){
   
    try {
      
      $pdo = openDB();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      $item = $_POST['item'];
      $expire = $_POST['expire'] == '' ? NULL : $_POST['expire'] ;

      $sql = "INSERT INTO T_TODO(
                 ITEM_NAME,
                 EXPIRE,
                 CREATE_DATE,
                 UPDATE_DATE)
                VALUES(
                  :item,
                  :expire ,
                  GETDATE(),
                  GETDATE()
                  )";
      // print($sql);
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':item',$item);
      $stmt->bindValue(':expire',$expire);
      $stmt->execute();
      
    print('ddd');
    } catch (Exception $e) {
      $pdo = null;
      header("Content-Type: text/plain; charset=UTF-8", true, 500);
      exit($e->getMessage());
    }
  }
  //header("Location:helloworld.php");
?>

