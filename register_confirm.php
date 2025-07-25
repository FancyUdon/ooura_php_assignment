<?php
// POST 受け取り＆エスケープ
$data = [];
$fields = [
    'last_name','first_name','gender','prefecture','address_detail','email','password'
];
foreach($fields as $f) {
    if(isset($_POST[$f])) {
        $data[$f] = htmlspecialchars($_POST[$f], ENT_QUOTES, 'UTF-8');
    } else {
        $data[$f] = '';
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>会員情報確認画面</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .center { text-align: center; margin: 20px 0; }
        .info-row { display: flex; justify-content: space-between; margin: 8px 0; }
        .info-row label { width: 120px; }
    </style>
</head>
<body>
    <h1 class="center">会員情報確認画面</h1>

    <form action="register_process.php" method="post">
        <!-- 氏名 -->
        <div class="info-row">
            <label>氏名</label>
            <div>
                <?= $data['last_name'] ?>　<?= $data['first_name'] ?>
            </div>
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

        <!-- 確定ボタン -->
        <div class="center">
            <button type="submit">登録完了</button>
        </div>
    </form>

    <!-- 前に戻る -->
    <div class="center">
        <form action="member_regist.php" method="post">
            <?php foreach($data as $key => $val): ?>
                <input type="hidden" name="<?= $key ?>" value="<?= $val ?>">
            <?php endforeach; ?>
            <button type="submit">前に戻る</button>
        </form>
    </div>
</body>
</html>
