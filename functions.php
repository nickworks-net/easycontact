<?php

function getMessageData($customer_id, $shop_id){
	/*
	* メッセージデータ取得.
	*/
	$db = new Database();

	// Message Thread.
	$sql = 'SELECT * FROM message_thread WHERE customer_id = ? AND shop_id = ?';
	$stmt = $db->execute($sql, array($customer_id, $shop_id));
	$message_thread = $stmt->fetch();

	// Message.
	$messages = array();
	if( !is_null($message_thread) ){
		$sql = 'SELECT * FROM message WHERE thread_id = ?';
		$stmt = $db->execute($sql, array($message_thread['id']));
		foreach ($stmt as $i => $message) {
			$messages[$i] = $message;
		}
	}
	return array(
		"message_thread" => $message_thread,
		"messages" => $messages,
	);
}

