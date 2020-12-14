<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name=”robots” content=”noindex,nofollow”>
	<title>登録</title>
<style>
*,
*:before,
*:after {
	box-sizing: border-box;
}
html,
body {
	width: 100%;
	min-height: 100vh;
}
body {
	display: flex;
	align-content: center;
	justify-content: center;
	margin: 0;
	padding: 0;
	background-color: #fdfdfd;
}
input[type="text"],
input[type="email"],
button {
	appearance: none;
	font-size: 16px;
	background: #fff;
	border-radius: 0;
	border: 1px solid #aaa;
	box-shadow: none;
	transition: 235ms ease;
}
input[type="text"],
input[type="email"] {
	display: block;
	width: 100%;
	height: 40px;
	padding: 5px 10px;
	color: #454545;
	outline: 0;
}
input[type="text"]:focus,
input[type="email"]:focus {
	border-color: #3284d2;
}
button {
	cursor: pointer;
	padding: 6px 15px;
	font-size: 14px;
	color: #fff;
	background: #3284d2;
	border: 1px solid #2254a2;
}
button:hover {
	background: #5294e2;
}
form {
	display: flex;
	align-items: center;
	justify-content: center;
	/* min-height: 100vh; */
	height: auto;
	padding: 15px;
}
form > div {
	position: relative;
	max-width: 400px;
	width: 100%;
	margin: 100px auto;
}
.logo {
	position: absolute;
	bottom: 100%;
	width: 100%;
	margin-top: 0;
	margin-bottom: 15px;
	text-align: center;
}
.register-box {
	width: 100%;
	padding: 20px;
	background-color: #fff;
	border: 1px solid #d9d9d9;
	box-shadow: 0 15px 15px -12px rgba(0, 0, 0, .1);
}
label {
	pointer-events: none;
	user-select: none;
	display: block;
	margin-bottom: 3px;
	font-size: 14px;
	color: #666;
}
h2 {
	margin: 0 0 20px;
	font-size: 20px;
	color: #383838;
}
p {
	margin-top: 0;
	font-size: 14px;
	color: #555;
}
.field {
	position: relative;
	margin-bottom: 1em;
}
.errors {
	margin-bottom: 1em;
	font-size: 14px;
	color: #e00;
}
ul {
	margin: 0;
	padding: 0;
	list-style: none;
}
small {
	font-size: 80%;
	color: #888;
}
.logo svg {
	width: 220px;
}
.logo svg path {
	fill: #003A53;
}
</style>
</head>
<body>
	<form action="" method="post">
		<input type="hidden" name="user_role" value="<?= $get_user_role; ?>">
		<div>
			<h1 class="logo"><?= Asset::svg('common/logo.svg'); ?></h1>
			<?php if (isset($errors) and ! empty($errors)) : ?>
			<div class="errors">
				<ul>
				<?php foreach ($errors->errors as $v) : ?>
					<li><?= $v[0]; ?></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<?php endif ?>
			<div class="register-box">
				<h2>アカウント登録</h2>
				<div class="field">
					<label for="user_login">ユーザー名</label>
					<input type="text" id="user_login" name="user_login" value="<?= esc_attr($get_user_login) ?>" autocomplete="off" >
					<p><small>登録するユーザー名を決めてください。（半角英数字のみ）</small></p>
				</div>
				<div class="field">
					<label for="user_email">メールアドレス</label>
					<input type="email" id="user_email" name="user_email" value="<?= esc_attr($get_user_email) ?>" autocomplete="off" >
					<p><small>登録確認のメールが送信されます。</small></p>
				</div>
				<div style="text-align:right;">
					<button type="submit">登　録</button>
				</div>
			</div>
		</div>
	</form>
</body>
</html>