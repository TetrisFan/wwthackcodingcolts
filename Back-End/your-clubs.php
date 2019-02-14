  <?php include('filterclubquiz.php')?>


<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Your Clubs</title>

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
    <a class="navbar-brand" href="#">Logo</a>
  </nav>

  <main role="main" class="container text-center">
    <div class="jumbotron d-flex flex-column justify-content-around text-center">
      <!--<img src="#" class="img-fluid" alt="Illustration">-->
      <h1>Your Clubs</h1>
      <p>If you're already part of an extracurricular, subscribe to your clubs on this list.</p>
      <p>If you're not, then you can skip this step.</p>
      <div>
        <a class="btn btn-primary" href="#" role="button">skip</a>
      </div>

      <hr class="my-4">

      <form class="form-signin">
      <input type="text" class="form-control" placeholder="search">
      </form>
      <form class="d-flex flex-column align-items-center">
        <div class="row mx-0 d-flex flex-row justify-content-center">
               <?php 
               $list = $_SESSION['clubnames'];
               for ($counter = 0; $counter<count($list); $counter++)
                 { ?>
            
          <div class="col-sm-12 col-md-6 col-lg mb-2">
            <div class="d-flex flex-row justify-content-center">
              <img class="club-profile-pic" src="images/gray.png" />
              <div class="subscribe-club-name"> <?php echo $list[$counter]; ?></div>
              <button type="button" class="btn btn-secondary" onclick="subscribeFunction()">
                <div id="subButton">subscribe</div>
              </button>
            </div>
          </div>
          
          <?php
                  }
          ?>   
        </div>
        <a class="btn btn-primary btn-text mt-5 mb-3" role="button" href="#">submit</a>
      </form>
  </main>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="/docs/4.2/assets/js/vendor/jquery-slim.min.js"><\/script>')
  </script>
  <script src="/docs/4.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>
  <script>
  </script>


</body>

</html>