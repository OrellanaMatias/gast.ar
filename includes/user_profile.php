
<?php
session_start();
error_reporting(0);
include('database.php');
if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
  } else{
?>
  
  <!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="css/style.css">
    
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">



     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   </head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='bx bx-album'></i>
      <span class="logo_name">Gastar</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="home.php">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="add-expenses.php">
            <i class='bx bx-box' ></i>
            <span class="links_name">Gastos</span>
          </a>
        </li>
        <li>
          <a href="manage-expenses.php">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Ver gastos</span>
          </a>
        </li>
        
        <li>
          <a href="lending.php">
          <i class='bx bx-money'></i>
            <span class="links_name">Prestamos</span>
          </a>
        </li>
        <li>
        <a href="manage-lending.php" >
        <i class='bx bx-coin-stack'></i>
            <span class="links_name">Ver prestamos</span>
          </a>
        </li>
        <li>
          <a href="analytics.php">
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">Estadisticas</span>
          </a>
        </li>
        <li>
          <a href="report.php">
          <i class="bx bx-file"></i>
            <span class="links_name">Reportes UwU</span>
          </a>
        </li>
       <li>
          <a href="#"  class="active">
            <i class='bx bx-cog' ></i>
            <span class="links_name">Ajustes</span>
          </a>
        </li>
        <li class="log_out">
          <a href="logout.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Cerrar sesión</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Ajustes</span>
      </div>



      <?php
$uid=$_SESSION['detsuid'];
$ret=mysqli_query($db,"select name  from users where id='$uid'");
$row=mysqli_fetch_array($ret);
$name=$row['name'];

?>

      <div class="profile-details">
  <img src="images/maex.png" alt="">
  <span class="admin_name"><?php echo $name; ?></span>
  <i class='bx bx-chevron-down' id='profile-options-toggle'></i>
  <ul class="profile-options" id='profile-options'>
    <li><a href="#"><i class="fas fa-user-circle"></i>Mi perfil</a></li>
    
    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i>Cerrar sesión</a></li>
  </ul>
</div>


<script>
  const toggleButton = document.getElementById('profile-options-toggle');
  const profileOptions = document.getElementById('profile-options');
  
  toggleButton.addEventListener('click', () => {
    profileOptions.classList.toggle('show');
  });
</script>


    </nav>
    
   
	<?php
$userid = $_SESSION['detsuid'];

$sql = "SELECT * FROM users WHERE id = $userid";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    
    $first_name = $row['name'];
    $email = $row['email'];
	$phone = $row['phone'];
}
?>

<br>
<br>
<br>
<br>
<br>

	<div class="container mx-auto">
					<div class="bg-white shadow rounded-lg d-block d-sm-flex">
					<div class="profile-tab-nav border-right">
  <div class="p-4">
	<center>
    <label for="profile-image-input">
      <div class="img-circle text-center mb-3">
        <img id="profile-image-preview" src="images/maex.png" alt="Image" class="shadow">
        <div class="overlay">
		<i class="fas fa-camera fa-lg text" style="color: white;"></i>
        </div>
      </div>
    </label>
	</center>
    <input type="file" id="profile-image-input" style="display: none;">
    <h4 class="text-center"><?php echo $name; ?></h4>
  </div>
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
							<i class="fa fa-home text-center mr-1"></i> 
							Cuenta
						</a>
						<a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
							<i class="fa fa-key text-center mr-1"></i> 
							Contraseña
						</a>
					</div>
				</div>
				<div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
					<div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
						<h3 class="mb-4">Ajustes de la cuenta</h3>
						<form method="POST" action="update_user.php">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Nombre</label>
								  	<input type="text" class="form-control" name = "name"  value="<?php echo $first_name; ?> "required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
								  	<label>Correo electrónico</label>
								  	<input type="text" class="form-control" name = "email" value="<?php echo $email; ?>"required>
								</div>
							</div>
						

							<div class="col-md-6">
								<div class="form-group">
								  	<label>Fecha de registro</label>
									  <input type="date" class="form-control" value="<?php echo date('Y-m-d', strtotime($row['created_at'])); ?>" readonly>
								</div>
							</div>

							<div class="col-md-6">
						<div class="form-group">
							<label>Numero de telefono</label>
							<input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>" required>
						</div>
					</div>

						
						
						</div>
						<div>
						<button type="submit" class="btn btn-primary" name="update_user">Actualizar</button>
       				    <button type="button" class="btn btn-light" onclick="location.href='user_profile.php'">Cancelar</button>
						</div>
					</div>
					</form>

					<?php
$old_password = "";
$new_password = "";
$confirm_password = "";
$errors = array();

if (isset($_POST['submit'])) {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($old_password)) {
        $errors[] = "Ingresa tu contraseña actual";
    }

    if (empty($new_password)) {
        $errors[] = "Ingresa una nueva contraseña";
    } elseif (strlen($new_password) < 8) {
        $errors[] = "Tu nueva contraseña debe tener como minimo 8 caracteres";
    }

    if (empty($confirm_password)) {
        $errors[] = "Confirma tu nueva contraseña";
    } elseif ($new_password != $confirm_password) {
        $errors[] = "Tus nuevas contraseñas no coinciden";
    }

    $userid = $_SESSION['detsuid'];
    $query = "SELECT password FROM users WHERE id = $userid";
    $result = mysqli_query($db, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if (!password_verify($old_password, $row['password'])) {
            $errors[] = "Tu contraseña actual es incorrecta, si la olvidaste, contacta a soporte: meorellanaramirez@itel.edu.ar";
        }
    } else {
        echo "Hubo un error en el fetching xd " . mysqli_error($db);
    }

    if (empty($errors)) {
        $password_hashed = password_hash($new_password, PASSWORD_DEFAULT);

        $update_query = "UPDATE users SET password = '$password_hashed' WHERE id=$userid";

        $result = mysqli_query($db, $update_query);

        if ($result) {
            $message = "Contraseña actualizada exitosamente";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo " <script type='text/javascript'>window.location.href = 'user_profile.php';</script>";
            exit();
        } else {
            echo "Error actualizando informacion del usuario " . mysqli_error($db);
        }
    }
}

?>

<div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
    <h3 class="mb-4">Ajustes de la contraseña</h3>
    <form method="post">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Contraseña actual</label>
                    <input type="password" class="form-control" name="old_password" value="<?php echo htmlspecialchars($old_password); ?>" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nueva contraseña</label>
                    <input type="password" class="form-control" name="new_password" value="<?php echo htmlspecialchars($new_password); ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Confirme la nueva contraseña</label>
                    <input type="password" class="form-control" name="confirm_password" value="<?php echo htmlspecialchars($confirm_password); ?>" required>
                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-primary" type="submit" name="submit">Actualizar</button>
            <button class="btn btn-light" type="reset">Cancelar</button>
        </div>
    </form>
</div>

		</div>
		<style> 
		@import url("https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap");
		body {
			background: #f9f9f9;
			font-family: "Roboto", sans-serif;
		}
		.container {
	max-width: 1200px;
	margin: 0 auto;
	padding: 20px;
}

		.shadow {
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
		}

		.profile-tab-nav {
			min-width: 250px;
		}

		.tab-content {
			flex: 1;
		}

		.form-group {
			margin-bottom: 1.5rem;
		}

		.nav-pills a.nav-link {
			padding: 15px 20px;
			border-bottom: 1px solid #ddd;
			border-radius: 0;
			color: #333;
		}

		.nav-pills a.nav-link i {
			width: 20px;
		}
		.mb-4, .my-4 {
    margin-bottom: 3.5rem!important;
}
		.img-circle img {
			height: 100px;
			width: 100px;
			border-radius: 100%;
			border: 5px solid #fff;
		}

		/* Define variables for colors */
		:root {
			--primary: #007bff;
			--success: #28a745;
			--danger: #dc3545;
			--warning: #ffc107;
		}
		.shadow {
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
		}

		.profile-tab-nav {
			min-width: 250px;
		}

		.tab-content {
			flex: 1;
		}

		.form-group {
			margin-bottom: 1.5rem;
		}

		.nav-pills a.nav-link {
			padding: 15px 20px;
			border-bottom: 1px solid #ddd;
			border-radius: 0;
			color: #333;
		}
		.nav-pills a.nav-link i {
			width: 20px;
		}

		
 .img-circle {
  position: relative;

  justify-content: center;
  align-items: center;
}



#profile-image-preview {
  height: 100px;
  width: 100px;
  border-radius: 100%;
  border: 5px solid #fff;
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  opacity: 0;
  transition: .5s ease;
  background-color: rgba(0,0,0,0.7);
  border-radius: 50%;
}

.img-circle:hover .overlay {
  opacity: 1;
}

.text {
  color: white;
  font-size: 20px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
}


		</style>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
 
 let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
sidebar.classList.toggle("active");
if(sidebar.classList.contains("active")){
sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
</script>

</body>
</html>

<?php } ?>