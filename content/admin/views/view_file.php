<?php
include('../../connect.php');
$id = $_GET['id'];
$sql1 = "SELECT * FROM alumni WHERE id = '$id'";
$result1 = $conn->query($sql1);
while ($row1 = $result1->fetch_assoc()) {
    $id = $row1['id'];
    $ub_id = sprintf("%04d", $id);
    $fname = $row1['fname'];
    $lname = $row1['lname'];
    $year = $row1['year'];
    $department = $row1['department'];
    $course = $row1['course'];
    $file = $row1['file']; 
    $date = $row1['date'];
}
?>

<h2>Attachment</h2>
<hr style="width:500px">

<?php
// Extract the base64 string and file type
if (preg_match('/^data:(.*?);base64,(.*)$/', $file, $matches)) {
    $file_type = $matches[1];
    $base64_string = $matches[2];
    $file_extension = explode('/', $file_type)[1];

    // Decode the base64 string
    $decoded_file = base64_decode($base64_string);

    // Serve images directly
    if (in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo '<img src="data:' . $file_type . ';base64,' . $base64_string . '" style="width:100%; height:500px;">';
    }
    // Handle DOCX files
    elseif ($file_extension == 'vnd.openxmlformats-officedocument.wordprocessingml.document') {
        // Save the decoded DOCX file to a temporary path
        $temp_file_path = 'temp/' . uniqid() . '.docx';
        if (file_put_contents($temp_file_path, $decoded_file) !== false) {
            // Generate the URL for Google Docs Viewer
            $file_url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $temp_file_path;

            echo '<iframe src="https://docs.google.com/viewer?url=' . urlencode($file_url) . '&embedded=true" width="100%" height="500px"></iframe>';
              echo '<a href="data:' . $file_type . ';base64,' . $base64_string . '">Download the file</a>';
        } else {
            echo 'Failed to save the file.';
        }
    } else {
        echo 'Unsupported file type. <a href="data:' . $file_type . ';base64,' . $base64_string . '">Download the file</a>';
    }
} else {
    echo 'Invalid file format.';
}
?>

<style>
#facebox {
  position: fixed;
  top: 50% !important;
  left: 50% !important;
  transform: translate(-50%, -50%) !important;
  max-width: 80% !important;
  width: auto !important;
  height: auto !important;
  padding: 20px !important;
  background-color: #fff !important;
  border: 1px solid #ccc !important;
  border-radius: 5px !important;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.3) !important;
  z-index: 9999 !important;
}

#facebox .popup {
  position: relative !important;
}

#facebox .content {
  display: block !important;
  padding: 0 !important;
}

#facebox .close {
  position: absolute !important;
  top: 10px !important;
  right: 10px !important;
  width: 20px !important;
  height: 20px !important;
  font-size: 24px !important;
  font-weight: bold !important;
  color: #333 !important;
  text-decoration: none !important;
  cursor: pointer !important;
}

#facebox .close:before {
  content: "×" !important;
  display: block !important;
  text-align: center !important;
  line-height: 20px !important;
}

#facebox .close img {
  display: none !important;
}
</style>
