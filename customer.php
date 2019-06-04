<?php
$conn = mysqli_connect(
  'localhost',
  'root',
  'hgucsee13',
  'opentutorials');

?>
<style>  
.box{
  width:500px;
    background-color:rgb(230,230,230);  
    top:20%;
    left:50%;
    align: center;
}
</style>

<!doctype html>
<html>
  <head style = "margin-top:50 px">
    <meta charset="utf-8">
    <title>Customer Page</title>
  </head>
  <body style = "margin-top: 50px">
    <h1><a href="customer.php">Customer Page</a></h1>
    <h2>Welcome, customer!</h2>
    <h4>List of sales books</h4>
    <table border="1" class="box">
      <tr>
        <td style = "text-align: center;">book</td><td style = "text-align: center;">desc.</td><td style = "text-align: center;">author<td style = "text-align: center;">profile</td>
        <?php
        $sql = "SELECT title, description, name, profile FROM topic JOIN author ON topic.author_id = author.id";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)){
          $filtered = array(
            'title'=>htmlspecialchars($row[0]),
            'description'=>htmlspecialchars($row[1]),
            'name'=>htmlspecialchars($row[2]),
            'profile'=>htmlspecialchars($row[3])
          );
          ?>
          <tr>
            <td><?=$filtered['title']?></td>
            <td><?=$filtered['description']?></td>
            <td><?=$filtered['name']?></td>
            <td><?=$filtered['profile']?></td>
          </tr>
          <?php
        }
        ?>
      </tr>
    </table>
    <p><a href="index.php">back</a></p>
  </body>
</html>
