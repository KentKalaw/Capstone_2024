<?php

function getPrograms($conn, $limit = 3) {
    $query = "SELECT * FROM programs ORDER BY created_at DESC LIMIT $limit";
    $result = mysqli_query($conn, $query);
    return $result;
  }

  $programs = getPrograms($conn);

  ?>