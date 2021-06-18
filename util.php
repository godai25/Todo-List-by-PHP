<?php 
  // ----------------------------------------------------
  //                  DB 接続 関数
  // ----------------------------------------------------
  function openDB(){
    
    $serverName = "*.*.*.*";
    $uid = "[user_name]";
    $pwd = "[password]";
    $dbname = "[database_name]";
    $dsn = "sqlsrv:server=".$serverName.";database=".$dbname;
    
    try {
      
      $pdo = new PDO($dsn, $uid, $pwd);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      return $pdo;      
    } catch (Exception $e) {
      $pdo = null;
      header("Content-Type: text/plain; charset=UTF-8", true, 500);
      exit($e->getMessage());
    }
  }
?>

