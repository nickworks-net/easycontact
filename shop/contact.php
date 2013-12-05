<?php

/**
* 受け取ったパラメータを元にデータを取得.
*/
require_once dirname(__FILE__) . "/../Database.php";
require_once dirname(__FILE__) . "/../functions.php";
require_once dirname(__FILE__) . "/../shops.php";

/* GETパラメータ取得. */
$customer_id = htmlspecialchars($_GET["cid"]);
$shop_id = (int) htmlspecialchars($_GET["sid"]);

/* データ取得. */
$tmp = getMessageData($customer_id, $shop_id);
$message_thread = $tmp["message_thread"];
$messages = $tmp["messages"];

$shop = $shops[$shop_id];

?>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title><?php echo htmlspecialchars($message_thread['customer_name']); ?>さんからのお問い合わせ</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/common.css" rel="stylesheet">
	<script src="../js/common.js" type="text/javascript"></script>
</head>
<body>

<h1><span class="glyphicon glyphicon-cutlery"></span> お店側ページ</h1>

<p>
	<a href="../">ホーム</a>
	＞ <a href="./">お店側トップ</a>
	＞ <a href="./contact_list.php?sid=<?php echo $shop_id; ?>">お問い合わせ一覧</a>
	＞ <?php echo htmlspecialchars($message_thread['customer_name']); ?>さんからのお問い合わせ
</p>

<p><span class="glyphicon glyphicon-lock"></span>『<?php echo $shop['name']; ?>』専用ページ</p>

<h2><?php echo htmlspecialchars($message_thread['customer_name']); ?>さんからのお問い合わせ</h2>

<h3><span class="glyphicon glyphicon-comment"></span> トーク</h3>
<div class="talk">
	<?php foreach ($messages as $message) {?>
		<div class="talk-<?php if( !$message['is_shop'] ) { echo "you"; }else{ echo "me"; }; ?>">
			<p class="date"><span class="glyphicon glyphicon-time"></span><?php echo date('m/d H:i', strtotime($message['create_dt'])); ?></p>
			<div class="message">
				<p><?php echo htmlspecialchars($message['body']); ?></p>
			</div>
		</div>
	<?php } ?>
</div>

<h3><span class="glyphicon glyphicon-pencil"></span> メッセージを送る</h3>
<div>
	<form method="post" action="../send_message.php">
		<input type="hidden" name="sid" value="<?php echo $shop_id; ?>" />
		<input type="hidden" name="cid" value="<?php echo $customer_id; ?>" />
		<input type="hidden" name="is_shop" value="1" />
		<p>内容</p>
		<p><textarea name="body" required></textarea></p>
		<p><input type="submit" class="btn btn-default" value="送信" /></p>
	</form>
</div>

</body>
</html>
