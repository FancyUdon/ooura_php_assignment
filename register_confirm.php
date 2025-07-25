<?php
$data = [];
$fields = ['last_name','first_name','gender','prefecture','address_detail','email','password'];
foreach($fields as $f) {
    $data[$f] = isset($_POST[$f]) ? htmlspecialchars($_POST[$f], ENT_QUOTES, 'UTF-8') : '';
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="UTF-8">
    <title>会員情報確認画面</title>
    <link rel="stylesheet" href="css/style.css">
    </head>
    <body>

    <div class="confirm-container">
    <h1 class="center">会員情報確認画面</h1>
    <form action="register_process.php" method="post">
            <!-- 氏名 -->
            <div class="info-row">
                <label>氏名</label>
                <div><?= $data['last_name'] ?>　<?= $data['first_name'] ?></div>
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
