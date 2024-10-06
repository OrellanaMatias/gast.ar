<head>
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>

<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<link

  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css"
  rel="stylesheet"
  
/>
  <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />
<link href="/assets/libs/frontend/MDB-UI-KIT-Pro-Essential-1.0.0/css/mdb.min.css" type="text/css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"
></script>
</head>
<section >
  <div class="container h-100">
      <br>
      <br>

          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Registrarse</p>

                <form class="mx-1 mx-md-4" action="" method="post">
                
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                    <input type="text" class="form-control" name="name" id="inputEmail4" required>
                      <label class="form-label" for="form3Example1c">Tu nombre</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" name="email" id="form3Example3c" class="form-control" required/>
                      <label class="form-label" for="form3Example3c">Tu correo electrónico</label>
                    </div>
                    
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-phone fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" name="phone" id="inputPassword4" class="form-control" required/>
                      <label class="form-label" for="form3Example3c">Tu telefono</label>
                    </div>
                    
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                   
                    <input type="password" class="form-control" name ="password" id="inputPassword4" required>
                      <label class="form-label" for="form3Example4c">Contraseña</label>
                      <i class="bx bx-hide show-hide"></i>

                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                 
                    <input type="password" class="form-control" name ="confirm_password" id="inputPassword" required>
                      <label class="form-label" for="form3Example4cd">Confirmar contraseña</label>
                      <i class="bx bx-hide show-hide"></i>
                    </div>
                   

                  </div>
<style>
.show-hide {
  position: absolute;
  right: 13px;
  top: 50%;
  transform: translateY(-50%);
  font-size: 18px;
  color: #919191;
  cursor: pointer;
  padding: 3px;
}

.mx-md-4 {
    margin-right: 1.5rem!important;
    margin-left: 1.5rem!important;
    margin-top: -1.5rem;
}


  </style>
                  <div class="form-check d-flex justify-content-center mb-3">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" required/>
                    <label class="form-check-label" for="form2Example3">
                      Acepto los <a href="#!">terminos y condiciones</a>
                    </label>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit"  name="submit" value="Signup" class="btn btn-primary btn-lg">Crear cuenta</button>
                  </div>
          <style>
            .divider:after,
.divider:before {
content: "";
flex: 1;
height: 1px;
background: #eee;
}
body {
  overflow-y: hidden;
  overflow-x: hidden;
}

element.style {
    background-color: #eee;
}
            </style>
                <p class="text-center text-muted ">Ya tienes una cuenta? <a href="index.php"
                    class="fw-bold text-body link-danger"><u>Inicia sesión</u></a></p>
                    
                </form>
                
              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="images/draw1.webp"
                  class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>


</section>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.form-outline').forEach((formOutline) => {
      new mdb.Input(formOutline).init();
    });
  });
const eyeIcons = document.querySelectorAll(".show-hide");

eyeIcons.forEach((eyeIcon) => {
  eyeIcon.addEventListener("click", () => {
    const pInput = eyeIcon.parentElement.querySelector("input"); 
    if (pInput.type === "password") {
      eyeIcon.classList.replace("bx-hide", "bx-show");
      return (pInput.type = "text");
    }
    eyeIcon.classList.replace("bx-show", "bx-hide");
    pInput.type = "password";
  });
});
</script>






<?php

include_once 'database.php';
if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    
    if(empty($name) || empty($email) || empty($password) || empty($confirm_password)){
        echo '<script type ="text/JavaScript">';  
        echo 'alert("Se requieren todos los campos")';
        echo '</script>'; 
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo '<script type ="text/JavaScript">';  
        echo 'alert("Correo electrónico no válido")';
        echo '</script>'; 
    }elseif(strlen($phone) < 10){
        echo '<script type ="text/JavaScript">';  
        echo 'alert("Numero de telefono no válido")';
        echo '</script>'; 

    }elseif($password != $confirm_password){
      echo '<script type ="text/JavaScript">';  
      echo 'alert("Las contraseñas no coinciden")';
      echo '</script>';  
    }elseif(strlen($password) < 8){
      echo '<script type ="text/JavaScript">';  
      echo 'alert("Las contraseñas deben tener mas de 8 caracteres")';
      echo '</script>'; 
        
    }else{
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        $verification_code = md5(rand());
        
        $stmt = $db->prepare("INSERT INTO users (name, email, phone, password, verification_code, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssss", $name, $email,$phone, $password, $verification_code);
        $stmt->execute();
        
        $to = $email;
        $subject = "Verificacion de registro";
        $message = "Clickea el link para verificar tu correo: http://example.com/verify.php?code=$verification_code";
        $headers = "From: no-reply@example.com";
        mail($to, $subject, $message, $headers);
        echo '<script type ="text/JavaScript">';  
      echo 'alert("Registrado exitosamente!")';

      echo '</script>'; 
    }
}

?>

