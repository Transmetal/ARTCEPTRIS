<?php
include "config.php";

if(isset($_POST['query'])) {
    $search_query = $_POST['query'];

    $query = "SELECT * FROM tblmovie 
    WHERE movie_name LIKE '%$search_query%' OR movie_id LIKE '%$search_query%' 
    OR movie_date LIKE '%$search_query%' OR movie_time LIKE '%$search_query%' 
    OR movie_artist LIKE '%$search_query%' OR movie_desc LIKE '%$search_query%' 
    OR movie_genre LIKE '%$search_query%' OR movie_venue LIKE '%$search_query%' 
    OR ub_price LIKE '%$search_query%' OR mb_price LIKE '%$search_query%' 
    OR vip_price LIKE '%$search_query%' OR lb_price LIKE '%$search_query%' 
    OR movie_contact LIKE '%$search_query%'";
    $result = mysqli_query($conn, $query);


    $data = array();

    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Invalid request']);
}

mysqli_close($conn);
?>