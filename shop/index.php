<?php 
require_once "../shops.php";
?>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>お店側トップ</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/common.css" rel="stylesheet">
	<script src="../js/common.js" type="text/javascript"></script>
</head>

<body>

<h1><span class="glyphicon glyphicon-cutlery"></span> お店側ページ</h1>

<p>
	<a href="../">ホーム</a>
	＞ お店側トップ
</p>

<h2>お店一覧</h2>
<ul>
	<?php foreach ($shops as $shop_id => $shop) {?>
	<li>
		<?php echo $shop["name"]; ?><br />
		<a href="contact_list.php?sid=<?php echo $shop_id; ?>">お問い合わせ一覧</a>
	</li>
	<?php } ?>
</ul>

</body>
</html>