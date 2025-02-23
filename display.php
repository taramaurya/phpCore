

<?php


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://localhost/tara/testimonial/api.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);
// print_r($response);
$data = json_decode($response, true);


curl_close($curl);

$star[1] = ' ' ;
$star[2] = '⭐';
$star[3]  = '⭐ ';
$star[4]  = '⭐ ⭐';
$star[5]  = '⭐ ⭐ ';
$star[6]  = '⭐ ⭐ ⭐';
$star[7]  = '⭐ ⭐ ⭐  ';
$star[8] = '⭐ ⭐ ⭐ ⭐';
$star[9] = '⭐ ⭐ ⭐ ⭐  ';
$star[10] = '⭐ ⭐ ⭐ ⭐ ⭐';


?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
</head>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"/>
<body>
<div class="container">
        <h3  class="text-center" >Testimonial Details</h3>
<table class="table  table-striped table-hover table-bordered">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email ID</th>
      <th scope="col">Comments</th>
      <th scope="col">Rating</th>
      <th scope="col">Photo</th>
      <th scope="col">Action</th>
      <!-- <th scope="col">review</th> -->
    </tr>
  </thead>
  <tbody id="tbody">
  <?php  foreach ($data as $user) { ?>
  <tr data-id="<?php echo $user['id']; ?>">
       <td><?php echo $user['fname'];  ?></td>
       <td><?php echo $user['lname'];  ?></td>
       <td><?php echo $user['email_id'];  ?></td>
       <td><?php echo $user['comments'];  ?></td>
       <td><?php echo $star[$user['star_ratings']];  ?></td>
       <td> <img src="http://localhost/tara/testimonial/uploads/<?php echo $user['user_photo'];  ?>" alt="user" width="40px" height="40px" > </td>
       <td><button type="button" class="btn btn-danger delete-btn">Delete</button></td>
       <!-- <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button></td> -->
   </tr>
   <?php } ?>
  </tbody>
</table>
   
</div>
</body>


</html>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Delete button click event
        $('.delete-btn').on('click', function() {
            var row = $(this).closest('tr');
            var testimonialId = row.data('id');
            console.log(testimonialId);
            
            
            if (confirm("Are you sure you want to delete this testimonial?")) {
                // Send AJAX request to delete the testimonial
                $.ajax({
                    url: 'http://localhost/tara/testimonial/api.php?id='+testimonialId,
                    type: 'DELETE',
                    data: { id: testimonialId },
                    success: function(response) {
                        Swal.close();
                        Swal.fire("Record Deleted Successfully");
                       
                        setTimeout(function () {
                        location.href = "http://localhost/tara/testimonial/display.php";
                        }, 4000);
                    },
                    error: function () {
                        Swal.close();
                        Swal.fire("Something went wrong. Please try again.");
                
                }
                });
            }
        });
    });
</script>