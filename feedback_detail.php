//feedback_detail.php

<form method="POST" action="send_message.php">
  <input type="hidden" name="feedback_id" value="<?= $feedback_id ?>">
  <textarea name="content" placeholder="Type your message..." required></textarea><br>
  <button type="submit">Send Message</button>
</form>

<?php
$feedback_id = $_GET['id'];
$result = $conn->query("SELECT * FROM messages WHERE feedback_id=$feedback_id ORDER BY timestamp");

while ($msg = $result->fetch_assoc()) {
  echo "<p><strong>{$msg['sender_role']}:</strong> {$msg['content']} <br><small>{$msg['timestamp']}</small></p>";
}
?>
