<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST['mail']) && isset($_POST['Wachtwoord']))
        {
            $var = fgetobject('gebruikers', 'mail', strtolower($_POST['mail']));

            $selected = $var->fetch(PDO::FETCH_ASSOC);

            if(password_verify($_POST['Wachtwoord'], $selected['wachtwoord']) && $selected['mail'] == strtolower($_POST['mail']))
            {
                $_SESSION["ingelogd"] = true;
                $_SESSION["gebruikersID"] = $selected["gebruikersID"];
                $_SESSION["rechten_ID"] = $selected["rechten_ID"];

                $_SESSION["alert"]["backgroundcolor"] = "green";
                $_SESSION["alert"]["color"] = "white";
                $_SESSION["alert"]["message"] = "Succesvol ingelogd";
                header('Location: index.php?');
                die();
            }
            else
            {
                $_SESSION["alert"]["backgroundcolor"] = "red";
                $_SESSION["alert"]["color"] = "white";
                $_SESSION["alert"]["message"] = "oeps, u heeft niet de goede combinatie voor eem mail en wachtwoord";
                header('Location: index.php?path=guest&page=login');
                die();
            }
        }
        else
        {
            $_SESSION["alert"]["backgroundcolor"] = "red";
            $_SESSION["alert"]["color"] = "white";
            $_SESSION["alert"]["message"] = "Een van de velden is niet goed ingevuld.";
            header('Location: index.php?path=guest&page=login');
            die();
        }
    }
?>
<style>
.gradient-custom {
/* fallback for old browsers */
background: #6a11cb;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

height: 100%;
} 
</style>
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
              <p class="text-white-50 mb-5">Please enter your login and password!</p>

              <div class="form-outline form-white mb-4">
                <input type="email" id="typeEmailX" class="form-control form-control-lg" />
                <label class="form-label" for="typeEmailX">Email</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" id="typePasswordX" class="form-control form-control-lg" />
                <label class="form-label" for="typePasswordX">Password</label>
              </div>

              <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>

              <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

              <div class="d-flex justify-content-center text-center mt-4 pt-1">
                <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
              </div>

            </div>

            <div>
              <p class="mb-0">Don't have an account? <a href="#!" class="text-white-50 fw-bold">Sign Up</a>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>