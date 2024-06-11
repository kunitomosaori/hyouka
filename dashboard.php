<?php
// エラー表示
ini_set("display_errors", 1);
error_reporting(E_ALL);

//0. SESSION開始！！
session_start();

//１．関数群の読み込み
include("funcs.php");

//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();

//２．データ登録SQL作成
$pdo = db_conn();
$sql = "SELECT * FROM gs_an_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$values = "";
if ($status == false) {
  sql_error($stmt);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json = json_encode($values, JSON_UNESCAPED_UNICODE);

?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ダッシュボード</title>
  <!-- <link rel="stylesheet" href="css/range.css">
  <link href="css/bootstrap.min.css" rel="stylesheet"> -->
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    div {
      padding: 10px;
      font-size: 16px;
    }

    .content-wrapper {
      margin-left: 25%;
      /* 左側メニューの幅に合わせて調整 */
      padding: 10px;
    }
  </style>
</head>

<body id="main">

  <?php include('html/sidemenu.html'); ?>
  <div class="content-wrapper">

    <!-- Main[Start] -->
    <div>
    <div class="container jumbotron bg-sky-50 p-6 rounded-lg text-center flex justify-center">
    <div class="flex space-x-6">
      <?php if ($_SESSION["kanri_flg"] == "1") { ?>
        <a href="index.php" class="hover:text-orange-600 bg-white p-4 rounded-lg shadow-md flex flex-col items-center">
          <img src="./img/hand.png" alt="人事評価シート登録">
          <span>人事評価シート登録</span>
        </a>
        <a href="select.php" class="hover:text-orange-600 bg-white p-4 rounded-lg shadow-md flex flex-col items-center">
          <img src="./img/document.png" alt="人事評価シート一覧">
          <span>人事評価シート一覧</span>
        </a>
        <a href="user.php" class="hover:text-orange-600 bg-white p-4 rounded-lg shadow-md flex flex-col items-center">
          <img src="./img/human.png" alt="ユーザー登録">
          <span>ユーザー登録</span>
        </a>
      <?php } else { ?>
        <a href="index.php" class="hover:text-orange-600 bg-white p-4 rounded-lg shadow-md flex flex-col items-center">
          <img src="./img/hand.png" alt="人事評価シート登録">
          <span>人事評価シート登録</span>
        </a>
        <a href="select.php" class="hover:text-orange-600 bg-white p-4 rounded-lg shadow-md flex flex-col items-center">
          <img src="./img/document.png" alt="人事評価シート一覧">
          <span>人事評価シート一覧</span>
        </a>
      <?php } ?>
    </div>
    </div>
  </div>
  <!-- Main[End] -->


  <script>
    const a = '<?php echo $json; ?>';
    console.log(JSON.parse(a));
  </script>
</body>

</html>