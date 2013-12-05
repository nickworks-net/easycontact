<?php 
require_once dirname(__FILE__) . "/../Database.php";
require_once dirname(__FILE__) . "/../shops.php";

$shop_id = (int) htmlspecialchars($_GET["sid"]);
$shop = $shops[$shop_id];

/* データ取得. */
$db = new Database();

// Message Thread.
$sql = 'SELECT * FROM message_thread WHERE shop_id = ?';
$stmt = $db->execute($sql, array($shop_id));
$message_threads = array();
foreach ($stmt as $i => $message_thread) {
	$message_threads[$i] = $message_thread;
}

?>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>お問い合わせ一覧</title>
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
	＞ お問い合わせ一覧
</p>

<p><span class="glyphicon glyphicon-lock"></span>『<?php echo $shop['name']; ?>』専用ページ</p>

<h2>お問い合わせ一覧</h2>

<?php if( $message_thread ) { ?>
	<ul>
		<?php foreach ($message_threads as $message_thread) {?>
		<li>
			<a href="contact.php?sid=<?php echo $shop_id; ?>&cid=<?php echo $message_thread['customer_id']; ?>"><?php echo htmlspecialchars($message_thread['customer_name']); ?>さんからの問い合わせ</a>
		</li>
		<?php } ?>
	</ul>
<?php } else { ?>
	<p>お問い合わせがありません</p>
<?php } ?>

</body>
</html>