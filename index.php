<?php 
  require "util.php";

try {

    $pdo = openDB();
    
    $sql = "SELECT ID, ITEM_NAME, EXPIRE AS EXPIRE FROM T_TODO WHERE DONE_DATE IS NULL AND DELETE_FLG = 0";
    $result_UnDo = $pdo->query($sql)->fetchAll();
    $sql = "SELECT ID, ITEM_NAME FROM T_TODO WHERE DONE_DATE IS NOT NULL AND DELETE_FLG = 0";
    $result_Done = $pdo->query($sql)->fetchAll();

    } catch (Exception $e) {
      $pdo = null;
      header("Content-Type: text/plain; charset=UTF-8", true, 500);
      exit($e->getMessage());
    }

?>

<!-- HTMLソース部 -->
<!-- ====================================================== -->

<!docmenttype html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
  <title>Hello World.</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script src="index.js"></script>
	<script>
  //<!-- 
    $( function() {
      $( "#expire" ).datepicker({
        dateFormat: 'yy/mm/dd',
      });
    } );

    function check(){
      let expire_date = $('#expire').val();
      if ( expire_date != '' && chkDate( expire_date ) === false ) {
        window.alert('日付がおかしいです');
        return false;
      }
      if( !window.confirm('送信してよろしいですか？')){ 
        return false; 
      } 
      return true;
    }

// -->
	</script>
</head>
<body>
  <h1> To Do List </h1>
  <?php 
    if (count($result_UnDo) == 0){ 
      echo "[Nothing List]";
    } else {
        echo "<table>"."\n";
        echo "<thead><tr><th>作業内容</th><th>有効期限</th><th>[済み]</th><th>[削除]</th></thead>"."\n";
        echo "<tbody>"."\n";
      foreach ($result_UnDo as $row){
        echo "<tr>".
            "<td>".htmlspecialchars($row["ITEM_NAME"])."</td>"."\n".
            "<td>".htmlspecialchars($row["EXPIRE"])."</td>"."\n".
            "<td><a href='updateItem.php?id=".$row["ID"]."&val=2'>Done</a></td>"."\n".
            "<td><a href='updateItem.php?id=".$row["ID"]."&val=9'>Delete</a></td>"."\n".
            "</tr>"."\n";
      }
      echo "</tbody></table>";
    }
  ?>

  <h1> Done Items </h1>
  <?php 
    if (count($result_Done) == 0){ 
      echo "[Nothing Items]";
    } else {
      echo "<table>"."\n";
      echo "<thead><tr><th>作業済み内容</th><th>[戻し]</th></thead>"."\n";
      echo "<tbody>"."\n";
    foreach ($result_Done as $row){
        echo "<tr>".
            "<td>".htmlspecialchars($row["ITEM_NAME"])."</td>".
            "<td><a href='updateItem.php?id=".$row["ID"]."&val=1'>UnDone</a></td>".
            "</tr>";
      }
    }
    echo "</tbody></table>";
  ?>

  <p><h3>register todo item.</h3></p>
  <form action="addItem.php" method="post" onSubmit="return check();">
    item : <input name="item" id="item">
    expire :<input name="expire" id="expire">
    <input type="submit" name="submit">
  </form> 
</body>
</html>