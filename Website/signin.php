<?php include('server.php') ?>

<!doctype html>

<html lang="en">



<head>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Sign In</title>



  <!-- Bootstrap core CSS -->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



  <!-- Custom styles for this template -->

  <link rel="stylesheet" href="styles.css">

</head>



<body>

  <nav class="navbar mb-4">

    <a class="navbar-brand" href="#"> <img class="logo" src="images/connect-me-logo2.png"> </a>

  </nav>



  <div class="container">

    <div class="jumbotron d-flex flex-column justify-content-center text-center">

      <h1>Sign In</h1>

      <!-- <p>I'm a...</p>

      <form> 

        <label class="mr-3"><input type="radio" class="mr-1" name="user_type" value="student" checked/>Student</label>

        <label><input type="radio" class="mr-1" name="user_type" value="teacher"/>Teacher</label>

      </form> -->



      <div id="student" style="display: none"> <!-- student sign in form -->

       <form class = "form-signin" method="post" action="signin.php">

          <?php include('errors.php'); ?>

        <form class="form-signin">

          <input type="text" class="form-control" name="studentid" placeholder="Student ID">

          <input type="password" class="form-control" name="password" placeholder="Password">

          <button type="submit" class="btn btn-primary" role="button" name="login_student">Login</button>

        </form>

      </div>

    <!-- <div id="teacher" style="display: none"> 

        <form method="post" action="signin.php">

        <form class="form-signin">

          <input type="text" class="form-control" name="email" placeholder="Email">

          <input type="password" class="form-control" name="password" placeholder="Password">

          <button type="submit" class="btn btn-primary" role="button" name="login_teacher">Login</button>

        </form> --> 

      </div>

    </div> <!-- jumbotron -->

  </div> <!-- container -->

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

  <script>

    window.jQuery || document.write('<script src="/docs/4.2/assets/js/vendor/jquery-slim.min.js"><\/script>')

  </script>

   <script src="/docs/4.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>

  <script type="text/javascript">

    $(document).ready(function() {

      $("#student").show();

      $("#teacher").hide();



      $("input[name='user_type']:radio").click(function() {

        $("#student").toggle($(this).val() == "student");

        $("#teacher").toggle($(this).val() == "teacher");

      });

    }); 

  </script>

</body>



</html>