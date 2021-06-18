<?php 
  require "util.php";

  // ----------------------------------------------------
  //                  ToDo 更新
  // ----------------------------------------------------
  if (isset($_GET['id']) && $_GET['val']){
    
    try {
      
      $id = $_GET['id'];
      $val = $_GET['val'];  // 0:UNDONE 1:DONE 9:DELETE

      $pdo = openDB();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      if ($val == '1') {
        // やること復帰
        $sql = "UPDATE T_TODO
                  SET DONE_DATE = NULL,
                      UPDATE_DATE = getdate()
                WHERE ID = {$id}";
      } else if ($val == '2') {
        // やること終了
        $sql = "UPDATE T_TODO
                  SET DONE_DATE = getdate(),
                      UPDATE_DATE = getdate()
                WHERE ID = {$id}";
      } else if ($val == '9'){
        // 削除
        $sql = "UPDATE T_TODO
                  SET DELETE_FLG = 1,
                      UPDATE_DATE = getdate()
                WHERE ID = {$id}";
      } else {
        print('該当なし');
      }
      

      //print($sql);
      $pdo->exec($sql);
      
    } catch (Exception $e) {
      $pdo = null;
      header("Content-Type: text/plain; charset=UTF-8", true, 500);
      exit($e->getMessage());
    }
  }
  header("Location:helloworld.php");
?>

