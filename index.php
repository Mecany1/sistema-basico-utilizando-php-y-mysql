<?php
	$server = 'localhost';
	$user = 'timelineuser1';
	$pass = 'ftnD3nTwj9xh87YH';
	$database = 'timeline';

	$conn = new mysqli($server, $user, $pass, $database);

	if($conn->connect_error) {
		die('Connection Error: '.$conn->connect_error);
	}

	if($_POST) {
		if(isset($_POST['message']) && $_POST['message']) {
			$sql = 'INSERT INTO messages (message) VALUES("'.$_POST['message'].'")';
			if($conn->query($sql)) {
				echo 'The message has been saved.';
			} else {
				die('An error occured: '.$conn->error);
			}
		}
	}

	$sql = 'SELECT * FROM messages ORDER BY id DESC';
	if($result = $conn->query($sql)) {
		$timeline_array = array();
		while($row = $result->fetch_assoc()) {
			$timeline_array[] = $row;
		}
	} else {
		die('An error occured: '.$conn->error);
	}
?>

<form method="post">
	Mensaje: <input type="text" name="message" value="">
	<input type="submit" value="Send">
</form>

<?php
	if(is_array($timeline_array) && count($timeline_array)>0) {
		foreach($timeline_array as $message_info) {
			echo $message_info['message'].'<br>';
		}
	}
?>