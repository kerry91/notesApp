<?php
require_once('includes/db.php');
require_once('includes/functions.php');

if($_SERVER['REQUEST_METHOD'] ==  'POST'){
  $title = $_POST['title'];
  $content = $_POST['content'];
  $important = $_POST['important'];
  $id = $_POST['id'];

  $sql = "UPDATE notes 
  SET title='$title', content='$content', important='$important' 
  WHERE id='$id'";

if(sqlsrv_query($conn, $sql)) {
  echo "New record edited successfully";
}
}

if(!isset($_GET['id'])){
  header("Location: index.php");
}


$id = $_GET['id'];
$sql = "SELECT * FROM notes WHERE id='$id'";
$result = sqlsrv_query($conn, $sql);
$note = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
sqlsrv_free_stmt( $result);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Notes App</title>
    <link rel="stylesheet" href="styles/style.css" />
  </head>
  <header>Notes App</header>

  <div class="titleDiv">
    <div class="backLink"><a class="nav-link" href="index.php"> Home</a></div>
    <div class="head">New Note</div>
  </div>
  <form action="edit.php" method="post">
    <input type="hidden" name="id" value="<?php echo $note['id'];?>"/>
    <span class="label">Title</span>
    <input type="text" name="title" value="<?php echo $note['title'];?>"/>

    <span class="label">Content</span>
    <textarea name="content"> <?php echo $note['content'];?></textarea>

    <div class="chkgroup">
      <span class="label-in">Important</span>
      <input type="hidden" name="important" value="0" />
      <input type="checkbox" name="important" value="1"  
      <?php if($note['important'])
      {
        echo "checked";
        }?>
        />
    </div>

    <input type="submit" />
  </form>
</html>

<?php require_once('includes/footer.php'); ?>
