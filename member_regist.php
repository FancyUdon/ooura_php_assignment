<?php
session_start();

$form_data = $_SESSION['form_data'] ?? [];
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['form_data'], $_SESSION['errors']); // 使い終わったら消す
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>会員登録フォーム</title>
    <link rel="stylesheet" href="/my-php/regist_system/css/style.css?v=1.2">
 <!-- <style>
        .error {
            color: red;
            font-weight: bold;
            background-color: yellow;
            padding: 4px;
            border: 1px solid red;
        }
    </style> -->
</head>

<body>

    <?php
    // 都道府県はひとまとめにして繰り返しで出力
        $prefectures = [
            "北海道", "青森県", "岩手県", "宮城県", "秋田県", "山形県", "福島県",
            "茨城県", "栃木県", "群馬県", "埼玉県", "千葉県", "東京都", "神奈川県",
            "新潟県", "富山県", "石川県", "福井県", "山梨県", "長野県",
            "岐阜県", "静岡県", "愛知県", "三重県",
            "滋賀県", "京都府", "大阪府", "兵庫県", "奈良県", "和歌山県",
            "鳥取県", "島根県", "岡山県", "広島県", "山口県",
            "徳島県", "香川県", "愛媛県", "高知県",
            "福岡県", "佐賀県", "長崎県", "熊本県", "大分県", "宮崎県", "鹿児島県", "沖縄県"
        ];
    ?>


    <div class="form-container">
        <h1>会員情報登録フォーム</h1>
        <form action="register_confirm.php" method="post">

                <!--名前入力欄-->
                <div class="form-row">
                    <label>氏名</label>
                    <div class="form-name">
                        <div class="form-name-field">
                            <span>姓</span>
                            <input type="text" name="last_name" 
                                value="<?= htmlspecialchars($form_data['last_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                            <?php if (!empty($errors['last_name'])): ?>
                                <p class="error"><?= $errors['last_name'] ?></p>
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-name-field">
                            <span>名</span>
                            <input type="text" name="first_name" 
                                value="<?= htmlspecialchars($form_data['first_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                            <?php if (!empty($errors['first_name'])): ?>
                                <p class="error"><?= $errors['first_name'] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- 性別入力欄 -->
                <div class="form-row">
                    <label>性別</label>
                    <div class="form-gender">
                        <label><input type="radio" name="gender" value="男性"
                            <?= (isset($form_data['gender']) && $form_data['gender'] === '男性') ? 'checked' : '' ?> >男性</label>
                        <label><input type="radio" name="gender" value="女性"
                            <?= (isset($form_data['gender']) && $form_data['gender'] === '女性') ? 'checked' : '' ?> >女性</label>
                    </div>
                </div>
                <?php if (!empty($errors['gender'])): ?>
                    <p class="error"><?= $errors['gender'] ?></p>
                <?php endif; ?>

                <!--住所入力欄-->
                <div class="form-row-column">
                    <label>住所</label>
                    <div class="address-group">
                        <!-- 都道府県のセレクトボックス -->
                        <div class="address-field-inline">
                            <label for="prefecture">都道府県</label>
                            <select name="prefecture">
                                <option value="">選択してください</option>
                                <?php foreach ($prefectures as $pref): ?>
                                    <option value="<?= htmlspecialchars($pref, ENT_QUOTES, 'UTF-8') ?>"
                                        <?= (isset($form_data['prefecture']) && $form_data['prefecture'] === $pref) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($pref, ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (!empty($errors['prefecture'])): ?>
                                <p class="error"><?= $errors['prefecture'] ?></p>
                            <?php endif; ?>
                        </div>
                        <!-- それ以降の住所のテキストボックス -->
                        <div class="address-field-below">
                            <label for="address_detail">それ以降の住所</label>
                            <input type="text" name="address_detail" 
                                value="<?= htmlspecialchars($form_data['address_detail'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                            <?php if (!empty($errors['address_detail'])): ?>
                                <p class="error"><?= $errors['address_detail'] ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            <!-- パスワード入力欄 -->
            <div class="form-row">
            <label for="password">パスワード</label>
            <input type="password" name="password">
            <?php if (!empty($errors['password'])): ?>
                <p class="error"><?= $errors['password'] ?></p>
            <?php endif; ?>
            </div>

            <!-- パスワード確認入力欄 -->
            <div class="form-row">
                <label for="password">パスワード(確認) </label>
            <input type="password" name="password_confirm">
            <?php if (!empty($errors['password_confirm'])): ?>
                <p class="error"><?= $errors['password_confirm'] ?></p>
            <?php endif; ?>
            </div>

            <!-- メールアドレス入力欄 -->
            <div class="form-row">
                <label for="email">メールアドレス </label>
                <input type="email" name="email" 
                    value="<?= htmlspecialchars($form_data['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                <?php if (!empty($errors['email'])): ?>
                    <p class="error"><?= $errors['email'] ?></p>
                <?php endif; ?>
            </div>

            <!-- 確認画面へ進むボタン -->
            <div style="text-align:center; margin-top:20px;">
            <button type="submit" class="button-confirm">確認画面へ</button>
        </form>
    </div>
</body>
</html>
