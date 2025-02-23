<!DOCTYPE html>
<html>
  <head>
    <title>Testimonial Data Form</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"/>
    <script src=" https://use.fontawesome.com/7ad89d9866.js"></script>

   
</head>
<style>


@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);


/* Ratings widget */
.rate {
    display: inline-block;
    border: 0;
}
/* Hide radio */
.rate > input {
    display: none;
}
/* Order correctly by floating highest to the right */
.rate > label {
    float: right;
}
/* The star of the show */
.rate > label:before {
    display: inline-block;
    font-size: 3.1rem;
    padding: .3rem .2rem;
    margin: 0;
    cursor: pointer;
    font-family: FontAwesome;
    content: "\f005 "; /* full star */
}
/* Zero stars rating */
.rate > label:last-child:before {
    content: "\f006 "; /* empty star outline */
}
/* Half star trick */
.rate .half:before {
    content: "\f089 "; /* half star no outline */
    position: absolute;
    padding-right: 0;
}
/* Click + hover color */
input:checked ~ label, /* color current and previous stars on checked */
label:hover, label:hover ~ label { color: #73B100;  } /* color previous stars on hover */

/* Hover highlights */
input:checked + label:hover, input:checked ~ label:hover, /* highlight current and previous stars */
input:checked ~ label:hover ~ label, /* highlight previous selected stars for new rating */
label:hover ~ input:checked ~ label /* highlight previous selected stars */ { color: #A6E72D;  } 


</style>
  <body>
    <div class="col-sm-6 col-sm-offset-3">
      <h1  class="text-center" >Testimonial Form</h1>

      <form enctype="multipart/form-data">
        <div id="name-group" class="form-group">
          <label for="name">Name</label>
          <input
            type="text"
            class="form-control"
            id="name"
            name="fname"
            placeholder="Name"
          />
          <span id="nameerror" class="error-msg text-danger"></span>
        </div>

        <div id="lname-group" class="form-group">
          <label for="name">Last Name</label>
          <input
            type="text"
            class="form-control"
            id="lname"
            name="lname"
            placeholder="Last Name"
          />
          <span id="lnameerror" class="error-msg text-danger"></span>
        </div>

        <div id="email-group" class="form-group">
          <label for="email">Email</label>
          <input
            type="text"
            class="form-control"
            id="email"
            name="email_id"
            placeholder="email@example.com"
          />
          <span id="emailerror" class="error-msg text-danger"></span>
        </div>

        <div id="comments-group" class="form-group">
          <label for="comments">Comments</label>
          <textarea id="commentstext"  class="form-control" name="comments" rows="4" cols="50" ></textarea>
          <span id="commentserror" class="error-msg text-danger"></span>
        </div>

        
        <div id="rating-group" class="form-group">
            <label for="rat">Rating</label>
            <div class="rating">
              <fieldset class="rate">
              <input type="radio" id="rating10" name="star_ratings" value="10" /><label for="rating10" title="5 stars"></label>
              <input type="radio" id="rating9" name="star_ratings" value="9" /><label class="half" for="rating9" title="4 1/2 stars"></label>
              <input type="radio" id="rating8" name="star_ratings" value="8" /><label for="rating8" title="4 stars"></label>
              <input type="radio" id="rating7" name="star_ratings" value="7" /><label class="half" for="rating7" title="3 1/2 stars"></label>
              <input type="radio" id="rating6" name="star_ratings" value="6" /><label for="rating6" title="3 stars"></label>
              <input type="radio" id="rating5" name="star_ratings" value="5" /><label class="half" for="rating5" title="2 1/2 stars"></label>
              <input type="radio" id="rating4" name="star_ratings" value="4" /><label for="rating4" title="2 stars"></label>
              <input type="radio" id="rating3" name="star_ratings" value="3" /><label class="half" for="rating3" title="1 1/2 stars"></label>
              <input type="radio" id="rating2" name="star_ratings" value="2" /><label for="rating2" title="1 star"></label>
              <input type="radio" id="rating1" name="star_ratings" value="1" /><label class="half" for="rating1" title="1/2 star"></label>
          </fieldset>
    
           
            <br/>
            <div><span id="ratingerror" class="error-msg text-danger"></span></div>
           
     </div>


        <div id="superhero-group" class="form-group">
          <label for="superheroAlias">Photo Upload</label>
          <input
            type="file"
            class="form-control"
            id="userphoto"
            name="photo"
            accept="image/png, image/jpeg"
          />
          <span id="photoerror" class="error-msg text-danger"></span>
        </div>
        <button class="btn btn-success" role="button" id="testimonial"><span class="text" >Submit</button>
      </form>
    </div>
  </body>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
  
    $(document).ready(function () {
    $("#testimonial").click(function (e) {
        e.preventDefault();
        $(".error-msg").text("");

        var fname = $("#name").val().trim();
        var lname = $("#lname").val().trim();
        var email = $("#email").val().trim();
        var comments = $("#commentstext").val().trim();
        var photo = $("#userphoto")[0].files.length;
        var star_ratings = $("input[name='star_ratings']:checked").val();
        console.log(star_ratings);

        var isValid = true;

        if (fname === "") {
            $("#nameerror").text("Please enter your name.");
            isValid = false;
        }

        if (lname === "") {
            $("#lnameerror").text("Please enter your Last name.");
            isValid = false;
        }

        if (email === "") {
            $("#emailerror").text("Please enter your email.");
            isValid = false;
        } else if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/.test(email)) {
            $("#emailerror").text("Invalid email format.");
            isValid = false;
        }
    
        if (comments === "") {
            $("#commentserror").text("Please comment something");
            isValid = false;
        }

        if ((star_ratings === "") || (star_ratings == undefined )) {
            $("#ratingerror").text("Please rate");
            isValid = false;
        }

        if (photo === 0) {
            $("#photoerror").text("Upload your Photo (PNG or JPG).");
            isValid = false;
        }

        if (!isValid) return;
       
            Swal.fire({
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                background: 'transparent', // Removes white patch
                didOpen: () => {
                    Swal.showLoading();
                }
            });
       

      //  var form_data = new FormData($("#testimonial"));
      var form_data = new FormData($("form")[0]);

        $.ajax({
            url: "http://localhost/tara/testimonial/api.php",
            method: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                Swal.close();
                Swal.fire("Thank you, Form Submit Successfully");
                 console.log(response);
              
                setTimeout(function () {
                    location.href = "http://localhost/tara/testimonial/display.php";
                }, 4000);
            },
            error: function () {
                Swal.close();
                Swal.fire("Something went wrong. Please try again.");
               
            }
        });
    });
});
  </script>
</html>