<?php
error_reporting(E_ERROR | E_PARSE);
include 'db.php';

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$endpoint = $_SERVER['PATH_INFO'];
$input = json_decode(file_get_contents('php://input'), true);


switch ($method) {
    case 'GET':
        
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $result = $conn->query("SELECT * FROM testimonial_details WHERE is_deleted = 0 and id=$id");
            $data = $result->fetch_assoc();
            echo json_encode($data);
        } else {
            $result = $conn->query("SELECT * FROM testimonial_details WHERE is_deleted = 0");
            $users = [];
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
            echo json_encode($users);
        }
        break;

    case 'POST':
        if ($endpoint === '/review') {

            $userId = $input['userId'];
            $review = $input['review'];
            
            $conn->query("INSERT INTO user_review (userId, review) VALUES ('$userId', '$review')");
            echo json_encode(["message" => "Review added successfully"]);
            break;
           

        }else{
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $email_id = $_POST['email_id'];
            $comments = $_POST['comments'];
            $star_ratings = $_POST['star_ratings'];
    
            $allowed = array( 'png', 'jpg','jpeg');
    
            if(!empty($_FILES['photo'])){
                $photoname = $_FILES['photo']['name'];
                $ext = pathinfo($photoname, PATHINFO_EXTENSION);
                if(!in_array($ext, $allowed)) {
                    echo 'Only png and jpg format Allow';
    
                }else{
                    $uploaddir = 'uploads/';
                    $filename=rand().".png";
                    $uploadfile = $uploaddir . $filename;
        
                    if(move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
                        $photo = $filename;
                    }
                    $conn->query("INSERT INTO testimonial_details (fname, lname, email_id,comments, star_ratings, user_photo) VALUES ('$fname', '$lname', '$email_id','$comments','$star_ratings','$photo' )");
                    echo json_encode(["message" => "User added successfully"]);
                }
           
            }
        }
       
    break;


    case 'DELETE':
        $id = $_GET['id'];

        $conn->query("UPDATE testimonial_details SET is_deleted = 1 WHERE id=$id");
        echo json_encode(["message" => "User deleted successfully"]);
        break;

    default:
        echo json_encode(["message" => "Invalid request method"]);
        break;
}

$conn->close();

?>
