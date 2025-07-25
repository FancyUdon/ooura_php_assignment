<?php
// 入力チェック
if ($_SERVER["REQUEST_METHOD"] === "POST") {
$last_name   = isset($_POST['last_name']) ? $_POST['last_name'] : '';
$first_name  = isset($_POST['first_name']) ? $_POST['first_name'] : '';
$gender      = isset($_POST['gender']) ? $_POST['gender'] : '';
$prefecture  = isset($_POST['prefecture']) ? $_POST['prefecture'] : '';
$address_detail = isset($_POST['address_detail']) ? $_POST['address_detail'] : '';
$email       = isset($_POST['email']) ? $_POST['email'] : '';
$password    = isset($_POST['password']) ? $_POST['password'] : '';

    echo "<h1>登録が完了しました</h1>";
} else {
    echo "不正なアクセスです。";
}
?>
