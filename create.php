<?php
$conn = mysqli_connect(
  'localhost',
  'root',
  'hgucsee13',
  'opentutorials');

$sql = "SELECT * FROM topic";
$result = mysqli_query($conn, $sql);
$list = '';
while($row = mysqli_fetch_array($result)) {
  $escaped_title = htmlspecialchars($row['title']);
  $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$escaped_title}</a></li>";
}

$sql = "SELECT * FROM author";
$result = mysqli_query($conn, $sql);
$select_form = '<select name="author_id">';
while($row = mysqli_fetch_array($result)){
  $select_form .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
}
$select_form .= '</select>';
?>
<!doctype html>
<html >
  <head style="margin-top:50px">
    <meta charset="utf-8">
    <title>Add a book</title>
  </head>

  <body style = "margin-top: 50px">
    <h1><a href="create.php">Add a book</a></h1>
    <h5>To update or remove, click the title.</h5>
    <ol>
      <?=$list?>
    </ol>
    <form action="process_create.php" method="POST">
      <p><input type="text" style="width:300px; height;100px;font-size:15px;-moz-appearance: none;-webkit-appearance: none;" name="title" placeholder="title"></p>
      <p><textarea name="description"  style="width:300px; height;100px;font-size:15px;-moz-appearance: none;-webkit-appearance: none;" placeholder="description"></textarea></p>
      <?=$select_form?>
      <p><input type="submit" style="width:200px; height;100px;font-size:15px;-moz-appearance: none;-webkit-appearance: none;margin-left:55px" ></p>
    </form>
    <a href="index.php">Back</a>
  </body>
</html>
