<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>会員登録フォーム</title>
<link rel="stylesheet" href="/my-php/regist_system/css/style.css">
</head>
<body>

    <?php
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

                <div class="form-row">
                    <label>氏名</label>
                    <div class="form-name">
                        <span>姓</span>
                        <input type="text" name="last_name" value="<?= isset($_POST['last_name']) ? 
                        htmlspecialchars($_POST['last_name'], ENT_QUOTES, 'UTF-8') : '' ?>" required>
                        
                        <span>名</span>
                        <input type="text" name="first_name" value="<?= isset($_POST['first_name']) ? 
                        htmlspecialchars($_POST['first_name'], ENT_QUOTES, 'UTF-8') : '' ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <label>性別</label>
                    <div class="form-gender">
                        <input type="radio" name="gender" value="男性" 
                            <?= (isset($_POST['gender']) && $_POST['gender'] === '男性') ? 'checked' : '' ?> required>男性
                        <input type="radio" name="gender" value="女性" 
                            <?= (isset($_POST['gender']) && $_POST['gender'] === '女性') ? 'checked' : '' ?>>女性
                    </div>
                </div>

            <div class="form-row-column">
                <label>住所</label>
                <div class="address-group">
                    <div class="address-field-inline">
                        <label for="prefecture">都道府県</label>
                        <select name="prefecture" id="prefecture" required>
                            <option value="">選択してください</option>
                            <?php foreach ($prefectures as $pref): ?>
                                <option value="<?= htmlspecialchars($pref, ENT_QUOTES, 'UTF-8') ?>"
                                    <?= (isset($_POST['prefecture']) && $_POST['prefecture'] === $pref) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($pref, ENT_QUOTES, 'UTF-8') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="address-field-below">
                        <label for="address_detail">それ以降の住所</label>
                        <input type="text" name="address_detail" value="<?= isset($_POST['address_detail']) ? 
                            htmlspecialchars($_POST['address_detail'], ENT_QUOTES, 'UTF-8') : '' ?>" required>
                    </div>
                </div>
            </div>

            <div class="form-row">
            <label for="password">パスワード</label>
            <input type="password" id="password" name="password" required>
            </div>

            <div class="form-row">
                <label for="password">パスワード(確認) </label>
                <input type="password" name="password_confirm" required>
            </div>

            <div class="form-row">
                <label for="email">メールアドレス </label>
                <input type="email" name="email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : '' ?>" required>
            </div>


            <div style="text-align:center; margin-top:20px;">
            <button type="submit" class="button-confirm">確認画面へ</button>
        </form>
    </div>
</body>
</html>
