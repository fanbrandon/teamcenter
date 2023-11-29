<div class="comment">
    <h4><?php echo $data['name']; ?></h4>
    <p><?php echo $data['date']; ?></p>
    <p><?php echo htmlspecialchars($data['comment']); ?></p>
    <?php $reply_id = $data['id']; ?>
    <button class="reply" onclick="reply(<?php echo $reply_id; ?>, '<?php echo $data['name']; ?>')">Reply</button>
    <?php
    unset($datas);
    $datas = mysqli_query($con, "SELECT * FROM questions WHERE reply_id = $reply_id");
    if (mysqli_num_rows($datas) > 0) {
        foreach ($datas as $data) {
            require 'reply.php';
        }
    }
    ?>
</div>
<style>
.comment {
  margin-bottom: 20px; /* Adjust as needed for spacing between comments */
  padding: 10px; /* Add padding for better appearance */
  border: 2px solid gray; /* Add a border for separation */
  border-radius: 5px; /* Add rounded corners */
  ;
  width: 860px;
  padding-left: 15px;
}

.comment h4 {
  color: #C5B682; /* Change the color of the name */
  font-size: 18px; /* Adjust the font size of the name */
  margin-bottom: 5px; /* Add spacing between name and date */
}

.comment p {
  color: white; /* Change the color of the date and comment text */
  font-size: 14px; /* Adjust the font size of the date and comment text */
  margin-bottom: 10px; /* Add spacing between paragraphs */
}

.comment button.reply {
  background-color: #01796F; /* Set the background color of the reply button */
  color: white; /* Set the text color of the reply button */
  padding: 8px 12px; /* Adjust padding for better appearance */
  border: none; /* Remove button border */
  border-radius: 3px; /* Add rounded corners to the button */
  cursor: pointer; /* Add a pointer cursor on hover */
}

.comment button.reply:hover {
  background-color: white; /* Change background color on hover */
  color:black;
}



</style>