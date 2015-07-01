<?php

/**
* 問い合わせを保存.
*/
require_once dirname(__FILE__) . "/Database.php";

/* POSTパラメータ取得. */
$customer_id = htmlspecialchars($_POST["cid"]);
$shop_id = htmlspecialchars($_POST["sid"]);
$customer_name = htmlspecialchars( ( in_array("name", $_POST) ? $_POST["name"] : "" ) );
$body = htmlspecialchars($_POST["body"]);
$is_shop = (int) htmlspecialchars($_POST["is_shop"]);

/* 保存 */
$db = new Database();

// Message Threadがなければ追加.
$sql = 'SELECT * FROM message_thread WHERE customer_id = ? AND shop_id = ?';
$stmt = $db->execute($sql, array($customer_id, $shop_id));
$message_thread = $stmt->fetch();
if(!$message_thread){
	$sql = 'INSERT message_thread(customer_id, shop_id, customer_name) VALUES (?,?,?)';
	$stmt = $db->execute($sql, array($customer_id, $shop_id, $customer_name));
	$sql = 'SELECT * FROM message_thread WHERE customer_id = ? AND shop_id = ?';
	$stmt = $db->execute($sql, array($customer_id, $shop_id));
	$message_thread = $stmt->fetch();
}

// Message を追加.
$sql = 'INSERT message(thread_id, body, is_shop, create_dt) VALUES (?,?,?, NOW())';
$stmt = $db->execute($sql, array($message_thread['id'], $body, $is_shop));

?>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>送信しました</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">
	<link href="./css/common.css" rel="stylesheet">
	<script src="./js/common.js" type="text/javascript"></script>
</head>
<body>


<h2>送信しました</h2>
<?php if ($is_shop) { ?>
	<p><a href="./shop/contact.php?sid=<?php echo $shop_id; ?>&cid=<?php echo $customer_id; ?>">戻る</a></p>
<?php }else{ ?>
	<p><a href="./customer/contact.php?sid=<?php echo $shop_id; ?>&cid=<?php echo $customer_id; ?>">戻る</a></p>
<?php } ?>



</body>
</html>