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
  <head>
    <meta charset="utf-8">
    <title>Author</title>
  </head>
  <body style = "margin-top: 50px">
    <h1><a href="author.php">Author Management</a></h1>

    <table class="box" border="1">
      <tr>
        <td style = "text-align: center;">id</td><td style = "text-align: center;">name</td><td style = "text-align: center;">profile</td><td style = "text-align: center;">update</td><td style = "text-align: center;">delete</td>
        <?php
        $sql = "SELECT * FROM author";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)){
          $filtered = array(
            'id'=>htmlspecialchars($row['id']),
            'name'=>htmlspecialchars($row['name']),
            'profile'=>htmlspecialchars($row['profile'])
          );
          ?>
          <tr style ="text-align: center;">
            <td style = "text-align: center; "><?=$filtered['id']?></td>
            <td style = "text-align: center;"><?=$filtered['name']?></td>
            <td style = "text-align: center;" ><?=$filtered['profile']?></td>
            <td style = "text-align: center;"><a href="author.php?id=<?=$filtered['id']?>">update</a></td>
            <td style = "text-align: center;">
              <form action="process_delete_author.php" method="post" onsubmit="if(!confirm('sure?')){return false;}">
                <input type="hidden" name="id" value="<?=$filtered['id']?>">
                <input type="submit" value="delete">
              </form>
            </td>
          </tr>
          <?php
        }
        ?>
      </tr>
    </table>

    <?php
    $escaped = array(
      'name'=>'',
      'profile'=>''
    );
    $label_submit = 'Create author';
    $form_action = 'process_create_author.php';
    $form_id = '';
    if(isset($_GET['id'])){
      $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
      settype($filtered_id, 'integer');
      $sql = "SELECT * FROM author WHERE id = {$filtered_id}";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_array($result);
      $escaped['name'] = htmlspecialchars($row['name']);
      $escaped['profile'] = htmlspecialchars($row['profile']);
      $label_submit = 'Update author';
      $form_action = 'process_update_author.php';
      $form_id = '<input type="hidden" name="id" value="'.$_GET['id'].'">';
    }
    ?>
      
  </p>
    <form action="<?=$form_action?>" method="post">
      <?=$form_id?>
      <p ><input type="text" style="width:300px; height;100px;font-size:15px;-moz-appearance: none;-webkit-appearance: none;" name="name" placeholder="name" value="<?=$escaped['name']?>"></p>
      <p><textarea  style="width:300px; height;100px;font-size:15px;-moz-appearance: none;-webkit-appearance: none;" name="profile" placeholder="profile"><?=$escaped['profile']?></textarea></p>
      <p><input type="submit" style="width:300px; height;100px;font-size:15px;-moz-appearance: none;-webkit-appearance: none;" value="<?=$label_submit?>"></p>
    </form>

    <p><a href="index.php">back</a></p>
  </body>
</html>
