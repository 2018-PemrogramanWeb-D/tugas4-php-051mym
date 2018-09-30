<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" href="fix.css">
<title>|| Tugas 4 ||</title>
</head>
<body>  

<?php
  session_start();
  $_SESSION['pass'] = 'enter-GUEADMIN!!!';

  $nameErr = $emailErr = $genderErr = $passErr = "";
  $name = $email = $gender = $pass = "";
  $alrt= $Err= "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
      $nameErr = "Nama GAN NAMA!!!";
      $Err= "1";
    } else {
      $name = test_input($_POST["name"]);
      if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
        $nameErr = "Cuma bisa Alfabet dan space gan";
        $Err= "1";
      }
    }
    
    if (empty($_POST["email"])) {
      $emailErr = "Email GAN EMAIL!!!";
      $Err= "1";
    } else {
      $email = test_input($_POST["email"]);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Yang bener gan emailnya";
        $Err= "1";
      }
    }

    if (empty($_POST["gender"])) {
      $genderErr = "Hmmm perlu waktu ngecek dulu???";
      $Err= "1";
    } else {
      $gender = test_input($_POST["gender"]);
    }

    if (empty($_POST["pass"])) {
      $passErr = "Password GAN PASSWORD!!!";
    } else {
          $pass = test_input($_POST["pass"]);
          if($pass != $_SESSION['pass'] ){
              $passErr = "PASSWORD SALAH!!!";
          } else if($Err != "1"){
              date_default_timezone_set('Asia/Jakarta');
              $Hour = date('G');
              if ( $Hour >= 4 && $Hour <= 11 ) {
              $alrt="Selamat Pagi <br> $name";
              } else if ( $Hour >= 12 &&  $Hour <= 17 ) {
                $alrt="Good Afternoon <br> $name";
              } else if ( $Hour >= 18 || $Hour <= 3 ) {
                  $alrt="Good Evening <br> $name";
              }
          }
    }

  }

  function test_input($data) {  
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>

<div class="header">
  <h2>LOGIN Account MYM Corp</h2>
</div>
<div>
  <div>
    <div class="notebox">
      <strong class="note">NOTE :</strong>
      <ol>
        <li> Password = enter-GUEADMIN!!! </li>
        <li> <span class="error">*</span> = <b>Harus diisi</b></li>
      </ol>
    </div>
      <div class="form0">
      Name<br><br>
      E-mail<br><br>
      Password<br><br>
      Gender<br>
      </div>
      <div class="form">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          : <input type="text" name="name" value="<?php echo $name;?>">
          <span class="error">* <?php echo $nameErr;?></span>
          <br><br>
          : <input type="text" name="email" value="<?php echo $email;?>">
          <span class="error">* <?php echo $emailErr;?></span>
          <br><br>
          : <input type="password" name="pass" value="<?php echo $pass;?>">
          <span class="error">* <?php echo $passErr;?></span>
          <br><br>
          :
          <input class="default" type="radio" name="gender" <?php if (isset($gender) && $gender=="perempuan") echo "checked";?> value="perempuan">Perempuan
          <input class="default" type="radio" name="gender" <?php if (isset($gender) && $gender=="laki") echo "checked";?> value="laki">Laki - laki
          <span class="error">* <?php echo $genderErr;?></span>
          <br><br>
          <div class="sbutton">
            <input id="sub" type="submit" name="submit" value="Submit">
          </div>
        </form>
      </div>
    </div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br>
<footer>
    <?php echo $alrt;?>
</footer>

</body>
</html>