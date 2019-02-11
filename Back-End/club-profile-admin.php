<?php include('server.php') ?>

<html lang="en">



<head>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Club Profile</title>



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



  <!-- <img src="#banner"/> -->

  <div class="nav-container">

    <ul class="nav nav-pills justify-content-center align-items-center" id="myTab" role="tablist">

      <li class="nav-item">

        <a class="nav-link active px-sm-5 px-lg-5" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>

      </li>

      <li class="nav-item">

        <a class="nav-link px-lg-5 px-md-5" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="false">Posts</a>

      </li>

      <li class="nav-item">

        <a class="nav-link px-lg-5 px-md-5" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">Documents</a>

      </li>

    </ul>

  </div>



  <div class="tab-content" id="myTabContent">

    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">

      <main role="main" class="container mt-5">

        <div class="jumbotron d-flex flex-column align-items-center text-center">

          <div class="w-75 d-flex flex-column align-items-center">

            <h1>Club Name</h1>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.

              Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.

              Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

            <button type="submit" class="btn btn-primary mt-3 mb-3">edit</button>

            <hr>



            <h1 class="mt-3 mb-3">Members</h1>

            <form class="form-inline w-100 m-0 mb-4">

              <input class="form-control w-100" type="search" placeholder="Search" aria-label="Search">

            </form>

            <div class="row d-flex flex-row justify-content-center">

              <div class="col-lg-3 col-md-4 col-xs-6">

                <img class="member-profile-pic" src="images/gray.png" alt="">

                <p class="mb-0">Name</p>

                <p class="club-role">Teacher</p>

              </div>

              <div class="col-lg-3 col-md-4 col-xs-6">

                <img class="member-profile-pic" src="images/gray.png" alt="">

                <p class="mb-0">Name</p>

                <p class="club-role">Officer</p>

              </div>

              <div class="col-lg-3 col-md-4 col-xs-6">

                <img class="member-profile-pic" src="images/gray.png" alt="">

                <p class="mb-0">Name</p>

                <p class="club-role">Officer</p>

              </div>

              <div class="col-lg-3 col-md-4 col-xs-6">

                <img class="member-profile-pic" src="images/gray.png" alt="">

                <p class="mb-0">Name</p>

                <p class="club-role">Officer</p>

              </div>

              <div class="col-lg-3 col-md-4 col-xs-6">

                <img class="member-profile-pic" src="images/gray.png" alt="">

                <p class="mb-0">Name</p>

              </div>

              <div class="col-lg-3 col-md-4 col-xs-6">

                <img class="member-profile-pic" src="images/gray.png" alt="">

                <p class="mb-0">Name</p>

              </div>

              <div class="col-lg-3 col-md-4 col-xs-6">

                <img class="member-profile-pic" src="images/gray.png" alt="">

                <p class="mb-0">Name</p>

              </div>

              <div class="col-lg-3 col-md-4 col-xs-6">

                <img class="member-profile-pic" src="images/gray.png" alt="">

                <p>Name</p>

              </div>

            </div>

          </div>

        </div>

      </main>

    </div>



    <div class="tab-pane fade" id="posts" role="tabpanel" aria-labelledby="posts-tab">

      <main role="main" class="container text-center mt-5 d-flex flex-column align-items-center">

        <button class="btn btn-primary btn-default" role="button" data-toggle="modal" data-target="#myModal6" style="width: 80%;">Create New Post</button>

        <div>

          <!-- Modal -->

          <div class="modal fade" id="myModal6" role="dialog">

            <div class="modal-dialog modal-dialog-centered modal-lg">

              <!-- Modal content-->

              <div class="modal-content">

                <form method="post" action="club-profile-admin.php">

                  <?php include('errors.php'); ?>

                <div class="modal-header d-flex flex-column align-items-center">

                  <button type="button" class="close" data-dismiss="modal">&times;</button>

                  <h4 class="modal-title"><input type="text" name="headline" placeholder="Title"></h4>

                </div>

                <div class="modal-body">

                  <textarea rows="6" name = "desc" cols="80">Some information about the event</textarea>

                  <div>

                    <br>

                    <?php include('errors.php'); ?>

                  <button type="submit" class="btn btn-primary" role="button" name="submit_post">Post</button>

                </div>

              </form>

              </div>

            </div>

          </div>

        </div>

      </div>



      <br>

      <br>



       <?php 

      for ($id = $row[0]; $id >= 1; $id--) {     
      
        $query = "SELECT * FROM clubapp.posts WHERE id = '$id'"; 
        $results = mysqli_query($db, $query);
        $posts=mysqli_fetch_array($results);
        
        ?>
      

        <div data-toggle="modal" data-target="#myModal1" class="headline-container">

        <div class="headline">

          <h1> <?php echo $posts[2];?> </h1>

          <p class="post-club-name">Posted by <?php echo $posts[1];?> at <?php echo $posts[4];?> </p>
      
        <div class="headline-text"> <?php echo $posts[3];?> </div>

      </div>

      <div>

        <br>

      <br>

<?php                                    
      } 

      ?>

          

      </main>

    </div>

    <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">

      <main role="main" class="container h-75 text-center mt-5">

        <div class="jumbotron d-flex flex-column justify-content-center align-items-center">

          <div class="card-deck">

            <div class="card">

              <img class="card-img-top" src="images/gray.png" alt="Card image cap">

              <div class="card-body">

                <h5 class="card-title">file</h5>

              </div>

            </div>

            <div class="card">

              <img class="card-img-top" src="images/gray.png" alt="Card image cap">

              <div class="card-body">

                <h5 class="card-title">file</h5>

              </div>

            </div>

            <div class="card">

              <img class="card-img-top" src="images/gray.png" alt="Card image cap">

              <div class="card-body">

                <h5 class="card-title">file</h5>

              </div>

            </div>

            <div class="card">

              <img class="card-img-top" src="images/gray.png" alt="Card image cap">

              <div class="card-body">

                <h5 class="card-title">file</h5>

              </div>

            </div>

          </div>

          <div class="card-deck">

            <div class="card">

              <img class="card-img-top" src="images/gray.png" alt="Card image cap">

              <div class="card-body">

                <h5 class="card-title">file</h5>

              </div>

            </div>

            <div class="card">

              <img class="card-img-top" src="images/gray.png" alt="Card image cap">

              <div class="card-body">

                <h5 class="card-title">file</h5>

              </div>

            </div>

            <div class="card">

              <img class="card-img-top" src="images/gray.png" alt="Card image cap">

              <div class="card-body">

                <h5 class="card-title">file</h5>

              </div>

            </div>

            <div class="card">

              <img class="card-img-top" src="images/gray.png" alt="Card image cap">

              <div class="card-body">

                <h5 class="card-title">file</h5>

              </div>

            </div>

          </div>

        </div>

      </main>

    </div>

  </div>



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

  <script>

    window.jQuery || document.write('<script src="/docs/4.2/assets/js/vendor/jquery-slim.min.js"><\/script>')

  </script>

  <script src="/docs/4.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>

</body>



</html>
