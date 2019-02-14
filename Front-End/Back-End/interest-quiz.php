<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Interest Quiz</title>

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
      <a class="nav-link" href="sign-in.html">Sign In</a>
    </nav>

    <main role="main" class="container text-center">
      <div class="jumbotron d-flex flex-column justify-content-center">
        <form id="quizForm" action="/phptutorial/your-clubs.php" method ="POST">
          <div class="quiz-tab">
            <h1 class="mb-3">I am interested in ___________</h1>
            <input id="answer01" type="checkbox" name="q1" value = "y"/>
            <label class="quiz-labels" for="answer01">writing, art, drama</label>
            <input id="answer02" type="checkbox" name="q2"value = "y"/>
            <label class="quiz-labels" for="answer02">athletics and being active</label>
            <input id="answer03" type="checkbox" name="q3" value = "y"/>
            <label class="quiz-labels" for="answer03">science and engineering</label>
            <input id="answer04" type="checkbox" name="q4" value = "y"/>
            <label class="quiz-labels" for="answer04">foreign languages</label>
          </div>
          <div class="quiz-tab">
            <h1 class="mb-3">Would you rather ?</h1>
            <input id="answer11" type="checkbox" name="q5"value = "y"/>
            <label class="quiz-labels" for="answer11">engage in creative activities</label>
            <input id="answer12" type="checkbox" name="q6"value = "y"/>
            <label class="quiz-labels" for="answer12">be active in a group setting</label>
            <input id="answer13" type="checkbox" name="q7"value = "y"/>
            <label class="quiz-labels" for="answer13">play games</label>
            <input id="answer14" type="checkbox" name="q8"value = "y"/>
            <label class="quiz-labels" for="answer14">write and create publications for the community</label>
          </div>
          <div class="quiz-tab">
            <h1 class="mb-3">Would you rather ?</h1>
            <input id="answer21" type="checkbox" name="q9"value = "y"/>
            <label class="quiz-labels" for="answer21">Learn mathematics or coding</label>
            <input id="answer22" type="checkbox" name="q10"value = "y"/>
            <label class="quiz-labels" for="answer22">Look to explore future career interests</label>
            <input id="answer23" type="checkbox" name="q11"value = "y"/>
            <label class="quiz-labels" for="answer23">Learn more about contemporary issues and other cultures</label>
            <input id="answer24" type="checkbox" name="q12"value = "y"/>
            <label class="quiz-labels" for="answer24">Participate in community service projects</label>
          </div>
          <div class="quiz-tab">
            <h1 class="mb-3">Would you rather ?</h1>
            <input id="answer31" type="checkbox" name="q13"value = "y"/>
            <label class="quiz-labels" for="answer31">Interact with languages beyond the classroom</label>
            <input id="answer32" type="checkbox" name="14"value = "y"/>
            <label class="quiz-labels" for="answer32">Paint, sculpt, take photos, or draw</label>
            <input id="answer33" type="checkbox" name="q15"value = "y"/>
            <label class="quiz-labels" for="answer33">Be more socially aware</label>
            <input id="answer34" type="checkbox" name="q16"value = "y"/>
            <label class="quiz-labels" for="answer34">Pursue my career interests</label>
          </div>
          <div style="overflow:auto;">
            <div>
              <button class="btn-primary quiz-button" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
              <button class="btn-primary quiz-button" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
            </div>
          </div>
          <!-- Circles which indicates the steps of the form: -->
          <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
          </div>
        </form>
      </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="/docs/4.2/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="/docs/4.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>
    <script>
    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
      // This function will display the specified tab of the form...
      var x = document.getElementsByClassName("quiz-tab");
      x[n].style.display = "block";
      //... and fix the Previous/Next buttons:
      if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
      } else {
        document.getElementById("prevBtn").style.display = "inline";
      }
      if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
      } else {
        document.getElementById("nextBtn").innerHTML = "Next";
      }
      //... and run a function that will display the correct step indicator:
      fixStepIndicator(n)
    }

    function nextPrev(n) {
      // This function will figure out which tab to display
      var x = document.getElementsByClassName("quiz-tab");
      // Exit the function if any field in the current tab is invalid:
      if (n == 1 && !validateForm()) return false;
      // Hide the current tab:
      x[currentTab].style.display = "none";
      // Increase or decrease the current tab by 1:
      currentTab = currentTab + n;
      // if you have reached the end of the form...
      if (currentTab >= x.length) {
        // ... the form gets submitted:
        document.getElementById("quizForm").submit();
        return false;
      }
      // Otherwise, display the correct tab:
      showTab(currentTab);
    }

    function validateForm() {
      // This function deals with validation of the form fields
      var x, y, i, valid = true;
      x = document.getElementsByClassName("quiz-tab");
      y = x[currentTab].getElementsByTagName("input");
      // A loop that checks every input field in the current tab:
      for (i = 0; i < y.length; i++) {
        // If a field is empty...
        if (y[i].value == "") {
          // add an "invalid" class to the field:
          y[i].className += " invalid";
          // and set the current valid status to false
          valid = false;
        }
      }
      // If the valid status is true, mark the step as finished and valid:
      if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
      }
      return valid; // return the valid status
    }

    function fixStepIndicator(n) {
      // This function removes the "active" class of all steps...
      var i, x = document.getElementsByClassName("step");
      for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
      }
      //... and adds the "active" class on the current step:
      x[n].className += " active";
    }
    </script>

<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "0000";
$dbName = "clubapp";

$conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);
//Check connnection
      if($conn-> connect_error)
      {
            die("Connection failed:". $conn-> connect_error);

      }
?>

  </body>
</html>
