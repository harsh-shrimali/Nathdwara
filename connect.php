

// //DATABASE CONNECTION
// $conn=  mysqli_connect('localhost','root','','test');
// if($conn->connect_error){
//     echo "$conn->connect_error";
//     die("Connection Failed : ". $conn->connect_error);
// }
// else {
//     if(isset($_POST['submit'])){

//         $firstName = $_POST['firstName'];
//         $lastName = $_POST['lastName']; 
//         $mobileno = $_POST['mobileno'];
//         $gender = $_POST['gender'];
//         $email = $_POST['email'];
//         $address= $_POST['address'];
//         $feedback=$_POST['feedback'];
//         }
//     $stmt = $conn->prepare("insert into feedback(firstName, lastName, mobileno, gender, email, address, feedback) values(?, ?, ?, ?, ?, ?,?)");
//     $stmt->bind_param("ssissss", $firstName, $lastName, $mobileno, $gender, $email, $address, $feedback);
//     $execval = $stmt->execute();
//     echo $execval;
//     echo "Feedback Recorded...";
//     echo "Thank you For the feedback    ";
//     $stmt->close();
//     $conn->close();
// }







<?php


$firstName = $_POST['firstName'];
$lastName = $_POST['lastName']; 
$mobileno = $_POST['mobileno'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$address= $_POST['address'];
$feedback=$_POST['feedback'];



if (!empty($firstName) || !empty($lastName) || !empty($mobileno) || !empty($gender) || !empty($email) || !empty($address) || !empty($feedback)) {
 $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "youtube";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From feedback Where email = ? Limit 1";
     $INSERT = "INSERT Into feedback (firstName, lastName, mobileno, gender, email, address, feedback) values(?, ?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $stmt->store_result();
     $stmt->fetch();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssissss", $firstName, $lastName, $mobileno, $gender, $email, $address, $feedback);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>




