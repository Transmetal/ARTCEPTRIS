<?php
include "config.php";
$id = $_GET['movie_id'];
$query = "DELETE FROM tblmovie WHERE movie_id =$id";
$result = mysqli_query($conn, $query);
if($result) {
    header("Location: viewmovie.php?msg=Record has been deleted.");
} else {
    echo "Deletion Failed...".mysqli_error($conn);
}
?>