<?php
//print_r($_GET);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bottique";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die('Could not connect: ' . $conn->mysql_error());
}
$path_parts = pathinfo($_FILES["file_upload"]["name"]);
$extension = $path_parts['extension'];

$uploaddir = 'candidate_images/';

$picture_name = $_FILES['file_upload']['name'];
$picture_name = str_replace(" ","-",$picture_name);
$picture_name = str_replace(".","-",$picture_name);
$picture_name = $picture_name.".".$extension;


   if(move_uploaded_file($_FILES['file_upload']['tmp_name'], $uploaddir .basename($picture_name))){
    $sql = "UPDATE `category` "
         . " SET `image` = '".$uploaddir.$picture_name."' "
         . " WHERE `categoryid` = '".$_REQUEST['categoryid']."';";
    //$conn->query($sql);
    $conn->query($sql);
   // exit;
}
 $sql = "UPDATE `category` "
         . " SET `categoryid` = '".$_POST['categoryid']."', "
         . " `catrgoryname` = '".$_POST['catrgoryname']."' "
         . " WHERE `category`.`categoryid` = '".$_REQUEST['categoryid']."';";
         
            
if ($conn->query($sql) === TRUE) {
     header("Location:buttique_catagory_list.php");
	exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>