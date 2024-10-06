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
          <a href="home.php" >
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
          <a href="report.php" class="active">
          <i class="bx bx-file"></i>
            <span class="links_name">Reportes UwU</span>
          </a>
        </li>
       <li>
       <a href="user_profile.php">
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
        <span class="dashboard">Gastar</span>
      </div>
      <div class="search-box">
        <input input type="text" id="search-input" class="form-control form-control-sm mx-2" placeholder="Buscar...">
        <i class='bx bx-search' ></i>
</div>
<script>
$(document).ready(function() {
    var originalTableHtml = $('table tbody').html();
    
    
    $('#search-input').on('keyup', function() {
        var value = $(this).val().toLowerCase(); 
        var found = false;
        
        if (value) { 
            $('table tbody tr').filter(function() { 
                var matches = $(this).text().toLowerCase().indexOf(value) > -1;
                $(this).toggle(matches);
                if(matches) found = true;
            });
        } else { 
            $('table tbody').html(originalTableHtml);
            found = true;
        }
        
        if(!found) {
            $('table tbody').html('<tr><td colspan="7" style="text-align:center;">Sin datos que mostrar</td></tr>');
        }
    });
});

</script>

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
  <li><a href="user_profile.php"><i class="fas fa-user-circle"></i>Mi perfil</a></li>
    
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

<script>
function printReport() {
  
  $('#filter-form').off('submit');
  
  
  var url = document.URL;
  var printableContent = $('#printable').clone();
  var urlElement = printableContent.find('.url');
  if (urlElement.length) {
    urlElement.remove();
  }

  
  var tableHeader = '<table style="border-collapse: collapse; border-spacing: 0; width: 100%;">' +
                    '<thead>' +
                    '<tr style="border: 1px solid black;">' +
                    '<th style="border: 1px solid black;">S.NO</th>' +
                    '<th style="border: 1px solid black;">Fecha</th>' +
                    '<th style="border: 1px solid black;">Categoria</th>' +
                    '<th style="border: 1px solid black;">Descripcion</th>' +
                    '<th style="border: 1px solid black;">Fecha de registro</th>' +
                    '<th style="border: 1px solid black;">Monto</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';
  
var tableFooter = '<tr>' +
                    '<td colspan="5" style="text-align:center; border: 1px solid black;">Monto total &copy; 2024</td>' +
                    '<td style="border: 1px solid black;">6000</td>' +
                    '</tr>' +
                    '</tbody>' +
                    '</table>';

  
  printableContent.find('.expense-table').prepend(tableHeader).append(tableFooter);
  


var currentDate = new Date().toISOString().slice(0,10);


var nw = window.open('', '_blank', 'width=900,height=600');
nw.document.write('<html><head><title>Pending Report - ' + currentDate + '</title></head><body>');
  nw.document.write('<style>table {border-collapse: collapse; border-spacing: 0;} td, th {border: 1px solid black; padding: 5px;}</style>');
  nw.document.write(printableContent.html());
  nw.document.write('</body></html>');
  nw.document.close();
  nw.focus();
  setTimeout(function() {
    nw.print();
    setTimeout(function() {
      nw.close();
      end_loader();
    }, 500);
  }, 500);
}

</script>
<?php
session_start();

$fdate = $_GET['startDate'];
$tdate = $_GET['endDate'];
$rtype = $_GET['reportType'];

?>
<div class="home-content">
  <div class="overview-boxes">
    <div class="col-md-12">
      <br>
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-md-6">
              <h4 class="card-title">Reporte prestamos pendientes</h4>
            </div>
            <div class="col-md-6 text-right">
              <button class="btn btn-primary" onclick="printReport()">Imprimir</button>
            </div>
          </div>
        </div>
        <div class="card-body" id="printable">
          <h5 align="center" style="color:blue">Pendiente <?php echo ucfirst($rtype); ?> Reporte de <span style="color:red"><?php echo $fdate ?></span> to <span style="color:red"><?php echo $tdate ?></span></h5>
          <hr />
          <?php
          $userid=$_SESSION['detsuid'];
          $ret=mysqli_query($db,"SELECT name,date_of_lending,status,description,SUM(amount) as totaldaily FROM `lending`  where (date_of_lending BETWEEN '$fdate' and '$tdate') && (UserId='$userid') && (status = 'pending') group by date_of_lending");
          if(mysqli_num_rows($ret) > 0) {
          ?>
          <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
              <tr>
                <th>S.NO</th>
                <th>Nombre</th>
                <th>Fecha del prestamo</th>
                <th>Estado</th>
                <th>Descripcion</th>
                <th><?php echo ucfirst($rtype); ?> Monto</th>
               

              </tr>
            </thead>
            <tbody>
              <?php
              $cnt=1;
              $totalsexp=0;
              while ($row=mysqli_fetch_array($ret)) {
              ?>
              <tr>
                <td><?php echo $cnt;?></td>
                <td><?php  echo $row['name'];?></td>
                <td><?php  echo $row['date_of_lending'];?></td>
                <td><?php  if ($row["status"] == "received") {
                 echo '</i> <span class="badge bg-success text-white">Recibido</span>';
                } else {
                 echo '<span class="badge bg-warning text-white">Pendiente</span>';
                        }?>
                </td>                
                <td><?php  echo $row['description'];?></td>
                <td><?php  echo $ttlsl=$row['totaldaily'];?></td>
              </tr>
              <?php
              $totalsexp+=$ttlsl; 
              $cnt=$cnt+1;
              }?>
             <tr>
            <th colspan="5" style="text-align:center">Monto total</th>
            <td><b><?php echo number_format($totalsexp, 2); ?></b></td>
            </tr>

            </tbody>
          </table>
          <?php
          } else {
            echo "<p style='text-align:center'><b>Sin datos que mostrar</p>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>



    </section>

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
<?php } ?>