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

?>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title><?php echo $shops[$shop_id]['name']; ?>への問い合わせ</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/common.css" rel="stylesheet">
	<script src="../js/common.js" type="text/javascript"></script>
</head>
<body>

<h1><span class="glyphicon glyphicon-user"></span> お客側ページ</h1>

<p>
	<a href="../">ホーム</a>
	＞ <a href="./">お客側トップ</a>
	＞ <?php echo $shops[$shop_id]['name']; ?>への問い合わせ
</p>

<?php if( $message_thread ){?>
<p><span class="glyphicon glyphicon-lock"></span>『<?php echo htmlspecialchars($message_thread['customer_name']); ?>』さん専用ページ</p>
<?php } ?>

<h2><?php echo $shops[$shop_id]['name']; ?>への問い合わせ</h2>

<?php if( $message_thread ){?>

	<h3><span class="glyphicon glyphicon-comment"></span> トーク</h3>

	<div class="talk">
		<?php foreach ($messages as $message) {?>
			<div class="talk-<?php if( $message['is_shop'] ) { echo "you"; }else{ echo "me"; }; ?>">
				<p class="date"><span class="glyphicon glyphicon-time"></span><?php echo date('m/d h:m', strtotime($message['create_dt'])); ?></p>
				<div class="message">
					<p><?php echo htmlspecialchars($message['body']); ?></p>
				</div>
			</div>
		<?php } ?>
	</div>

<?php } else { ?>

	<h3><span class="glyphicon glyphicon-comment"></span> トーク</h3>
	<p>やりとりがありません</p>

<?php } ?>

	<h3><span class="glyphicon glyphicon-pencil"></span> お問い合わせ</h3>
	<div>
		<form method="post" action="../send_message.php">
			<input type="hidden" name="sid" value="<?php echo $shop_id; ?>" />
			<input type="hidden" name="cid" value="<?php echo $customer_id; ?>" />
			<input type="hidden" name="is_shop" value="0" />
			<?php if( !$message_thread ){?>
				<p>ハンドルネーム</p>
				<p><input type="text" name="name" required /></p>
			<?php } ?>
			<p>内容</p>
			<p><textarea name="body" required></textarea></p>
			<p><input type="submit" class="btn btn-default" value="送信" /></p>
		</form>
	</div>


</body>
</html>
