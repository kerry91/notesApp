<?php
require_once('includes/db.php');

$sql = "SELECT * FROM notes";
$notes = sqlsrv_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Notes App</title>
    <link rel="stylesheet" href="styles/style.css" />
  </head>
  <body>
    <header>Notes App</header>
    <div>
      <div>
        <a class="nav-link" href="new.php">Add a new note</a>
      </div>
        <?php 
          while($note = sqlsrv_fetch_array($notes, SQLSRV_FETCH_ASSOC)){
        ?>
      <div class="note">
        <div class="titleContainer">
          <span class="nt-title">
            <?php echo $note['title']; ?>
          </span>
          <div class="nt-links">
            <a class="nt-link" href=<?php echo 'edit.php?id=' . $note['id']; ?>>edit note</a>
            <a class="nt-link" href=<?php echo 'delete.php?id=' . $note['id']; ?>>[X] delete note</a>
          </div>
        </div>

        <div class="nt-content">
          <?php if($note['important']) {
            echo "<span class='imp'>IMPORTANT</span>";
            }  ?>
          <?php echo $note['content']; ?>
        </div>
      </div>
      <?php }
      sqlsrv_free_stmt( $notes);
      ?>
    </div>
  </body>
</html>

<?php require_once('includes/footer.php'); ?>
