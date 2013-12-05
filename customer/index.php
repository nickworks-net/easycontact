<?php 
require_once dirname(__FILE__) . "/../shops.php";
?>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>お客側トップ</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/common.css" rel="stylesheet">
	<script src="../js/common.js" type="text/javascript"></script>
</head>

<body>

<h1><span class="glyphicon glyphicon-user"></span> お客側ページ</h1>

<p>
	<a href="../">ホーム</a>
	＞ お客側トップ
</p>

<h2>お店一覧</h2>

<ul>
	<?php foreach ($shops as $shop_id => $shop) {?>
	<li>
		<?php echo $shop["name"]; ?><br />
		<span class="glyphicon glyphicon-comment"></span> <a href="contact.php?sid=<?php echo $shop_id; ?>"  onclick="attachCustomerIdToHref(this);">問い合わせる</a>
	</li>
	<?php } ?>
</ul>


</body>
</html>