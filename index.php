<?php
  if(isset($_POST["submit"])){
    function check_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
     }
     /*
     * MAIL RECIEVER INFORMATIONS
     */
     $to = "lord.zukoh@gmail.com";
     $subject = "your designed contact form";
    //recieve inputed data in variable
    $name    = check_input($_POST["name"]);
    $email   = check_input($_POST["email"]);
    $phone   = check_input($_POST["phone"]);
    $message = check_input($_POST["message"]);
    /*
    * VALIDATE INPUTED DATA
    */
    if(!$name){
      $nameErr = "Please enter a your name";
    }
    if(!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)){
      $emailErr = "Please enter a your Email";
    }
    if(!$message){
      $messageErr = "Please enter a valid message";
    }
    $body  = "Sender Name: $name";
    $body .= "Sender email: $email";
    $body .= "Sender Phone: $phone";
    $body .= "Message: $message";

    if(!$nameErr && !$emailErr && !$messageErr){
      if(mail($to, $subject, $body)){
        $results = "<div class='alert alert-success'>Thank you for your message we'll be in touch soon</div>";
      }else{
        $results = "<div class='alert alert-danger'>Your Message didn't sent. Please Try again.</div>";
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact-Us</title>
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="row">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
          <div class="col-md-6 col-md-offset-3">
            <h1 class="text-center page-header">Contact Us</h1>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <input class="form-control" type="text" placeholder="Your Name *" name="name" required value="<?php echo $name; ?>" />
              <?php echo "<p class='text-danger'>$nameErr</p>"; ?>
            </div>
            <div class="form-group">
              <input class="form-control" type="text" placeholder="Your Email *" name="email" required value="<?php echo $email; ?>" />
              <?php echo "<p class='text-danger'>$emailErr</p>"; ?>
            </div>
            <div class="form-group">
              <input class="form-control" type="text" placeholder="Your Phone" name="phone" value="<?php echo $phone; ?>" />
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <textarea class="form-control" placeholder="Your Message *" name="message" required ><?php echo $message; ?></textarea>
              <?php echo "<p class='text-danger'>$messageErr</p>"; ?>
            </div>
          </div>
          <div class="col-sm-2 col-sm-offset-5">
            <div class="form-group">
              <input type="submit" class="btn btn-primary submitBtn" value="Send Message" name="submit" />
            </div>
          </div>
          <div class="col-sm-4 col-sm-offset-4">
            <?php echo $results; ?>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
