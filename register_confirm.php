<?php
session_start();//値を保持
$errors = [];

// 入力値の取得
$last_name = $_POST['last_name'] ?? '';
$first_name = $_POST['first_name'] ?? '';
$gender = $_POST['gender'] ?? '';
$prefecture = $_POST['prefecture'] ?? '';
$address_detail = $_POST['address_detail'] ?? '';
$password = $_POST['password'] ?? '';
$password_confirm = $_POST['password_confirm'] ?? '';
$email = $_POST['email'] ?? '';



//入力チェック
// 姓名チェック
if ($last_name === '') {
    $errors['last_name'] = '姓は必須項目です。';
} elseif (mb_strlen($last_name) > 20) {
    $errors['last_name'] = '姓は20文字以内で入力してください。';
}

if ($first_name === '') {
    $errors['first_name'] = '名は必須項目です。';
} elseif (mb_strlen($first_name) > 20) {
    $errors['first_name'] = '名は20文字以内で入力してください。';
}

// 性別チェック
if (!in_array($gender, ['男性', '女性'], true)) {
    $errors['gender'] = '性別は男性または女性を選択してください。';
}

//都道府県チェック
// 有効な都道府県の一覧
$valid_prefectures = [
    "北海道", "青森県", "岩手県", "宮城県", "秋田県", "山形県", "福島県",
    "茨城県", "栃木県", "群馬県", "埼玉県", "千葉県", "東京都", "神奈川県",
    "新潟県", "富山県", "石川県", "福井県", "山梨県", "長野県",
    "岐阜県", "静岡県", "愛知県", "三重県",
    "滋賀県", "京都府", "大阪府", "兵庫県", "奈良県", "和歌山県",
    "鳥取県", "島根県", "岡山県", "広島県", "山口県",
    "徳島県", "香川県", "愛媛県", "高知県",
    "福岡県", "佐賀県", "長崎県", "熊本県", "大分県", "宮崎県", "鹿児島県", "沖縄県"
];
// 都道府県の入力チェック
if ($prefecture === '') {
    $errors['prefecture'] = '都道府県は必須項目です。';
} elseif (!in_array($prefecture, $valid_prefectures, true)) {
    $errors['prefecture'] = '都道府県の選択が不正です。';
}

//それ以降の住所チェック
if (mb_strlen($address_detail) > 100) {
    $errors['address_detail'] = '住所は100文字以内で入力してください。';
}

//パスワードの入力チェック
// パスワードが未入力
if ($password === '') {
    $errors['password'] = 'パスワードは必須項目です。';
} elseif (!preg_match('/^[a-zA-Z0-9]+$/', $password)) {
    $errors['password'] = 'パスワードは半角英数字のみで入力してください。';
} elseif (strlen($password) < 8 || strlen($password) > 20) {
    $errors['password'] = 'パスワードは8〜20文字で入力してください。';
}

//パスワード確認の入力チェック
if ($password_confirm === '') {
    $errors['password_confirm'] = 'パスワード確認は必須項目です。';
} elseif (!preg_match('/^[a-zA-Z0-9]+$/', $password)) {
    $errors['password'] = 'パスワードは半角英数字のみで入力してください。';
} elseif (strlen($password) < 8 || strlen($password) > 20) {
    $errors['password'] = 'パスワードは8〜20文字で入力してください。';
} elseif ($password !== $password_confirm) {
    $errors['password_confirm'] = 'パスワードが一致しません。';
}

//メールアドレスの入力チェック
if ($email === '') {
    $errors['email'] = 'メールアドレスは必須項目です。';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = '正しいメールアドレスの形式で入力してください。';
} elseif (mb_strlen($email) > 200) {
    $errors['email'] = 'メールアドレスは200文字以内で入力してください。';
}







//エラーがあった時
if (!empty($errors)) {
    // 値とエラーをセッションに入れて保持
    $_SESSION['errors'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header('Location: member_regist.php'); // フォームへ戻る
    exit;
}



$data = [];
$fields = ['last_name','first_name','gender','prefecture','address_detail','email','password'];
foreach($fields as $f) {
    $data[$f] = isset($_POST[$f]) ? htmlspecialchars($_POST[$f], ENT_QUOTES, 'UTF-8') : '';
}
?>



<!-- 会員情報確認画面 -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>会員情報確認画面</title>
    <link rel="stylesheet" href="/my-php/regist_system/css/style.css">
</head>
<body>

    <div class="confirm-container">
        <h1 class="center">会員情報確認画面</h1>
        <form action="register_process.php" method="post">
            <!-- 氏名 -->
            <div class="info-row">
                <label>氏名</label>
                <div><?= $data['last_name'] ?> <?= $data['first_name'] ?></div>
            </div>

            <!-- 性別 -->
            <div class="info-row">
                <label>性別</label>
                <div><?= $data['gender'] ?></div>
            </div>

            <!-- 住所 -->
            <div class="info-row">
                <label>住所</label>
                <div><?= $data['prefecture'] ?> <?= $data['address_detail'] ?></div>
            </div>

            <!-- パスワード -->
            <div class="info-row">
                <label>パスワード</label>
                <div>セキュリティのため非表示</div>
            </div>

            <!-- メールアドレス -->
            <div class="info-row">
                <label>メールアドレス</label>
                <div><?= $data['email'] ?></div>
            </div>

            <!-- 隠しフィールドに全データを引き継ぎ -->
            <?php foreach($data as $key => $val): ?>
                <input type="hidden" name="<?= $key ?>" value="<?= $val ?>">
            <?php endforeach; ?>
            <!-- 登録完了ボタン -->
            <div class="button-area">
                <button type="submit" class="button-confirm">登録完了</button>
            </div>
        </form>

        <!-- 前に戻るボタン -->
        <form action="member_regist.php" method="post" class="button-area">
            <?php foreach($data as $key => $val): ?>
                <input type="hidden" name="<?= $key ?>" value="<?= $val ?>">
            <?php endforeach; ?>
            <button type="submit" class="button-back">前に戻る</button>
        </form>
    </div>
</body>
</html>
