<?php
function prep_input($data){
    $data = trim($data);
    $datad = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>