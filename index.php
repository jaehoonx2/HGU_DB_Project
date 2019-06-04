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

$article = array(
  'title'=>'',
  'description'=>''
);
$update_link = '';
$delete_link = '';
$author = '';
if(isset($_GET['id'])) {
  $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
  $sql = "SELECT * FROM topic LEFT JOIN author ON topic.author_id = author.id WHERE topic.id={$filtered_id}";

  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  $article['title'] = htmlspecialchars($row['title']);
  $article['description'] = htmlspecialchars($row['description']);
  $article['name'] = htmlspecialchars($row['name']);

  $update_link = '<a href="update.php?id='.$_GET['id'].'">update</a>';
  $delete_link = '
    <form action="process_delete.php" method="post">
      <input type="hidden" name="id" value="'.$_GET['id'].'">
      <input type="submit" value="delete">
    </form>
  ';
  $author = "<p>by {$article['name']}</p>";
}
?>

<style>  
.box{
  width:300px;
 
    background-color:rgb(230,230,230);  
    top:20%;
    left:50%;
    align: center;
}
</style>
 
<!doctype html>
<html>
  <head >
    <meta charset="utf-8">
    <title>CAFE SYSTEM ADMIN</title>
  </head>
  <body style = "margin-top: 50px">
   
    <h1 style="colr: darkgreen; "><a href="index.php">ADMIN PAGE</a></h1>

   <tr style="align-content: center">
   <table class="box" border="1px">
      <tr >
        <td style = "text-align: center;">title</td>
        <td style = "text-align: center;">desc.</td>
        <td style = "text-align: center;">author</td>
      </tr>
      <tr>
        <td style = "text-align: center;"><?=$article['title']?></td>
        <td style = "text-align: center;"><?=$article['description']?></td>
        <td style = "text-align: center;"><?=$author?></td>
      </tr>
    </table>


</tr>
    

    <?=$update_link?>
    <?=$delete_link?>
   
    <p>
    <input type="button"  style="width: 150px; height: 30px;font-size:15px;-moz-appearance: none;-webkit-appearance: none; " value="Authors Manage" onClick="location.href='author.php'">
</p>
<p>
    <input type="button"  style="width: 150px; height: 30px;font-size:15px;-moz-appearance: none;-webkit-appearance: none; " value="Add a book" onClick="location.href='create.php'">
</p>
    <input type="button"  style="width: 150px; height: 30px;font-size:15px;-moz-appearance: none;-webkit-appearance: none; "  value="Back to Main" onClick="location.href='main.html'">
    </p>
  </body>
</html>
