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
          <a href="#" class="active">
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
        <span class="dashboard">Dashboard</span>
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
            $('table tbody').html('<tr><td colspan="7" style="text-align:center;">Sin datos por ahora</td></tr>');
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

    <div class="home-content">
      <div class="overview-boxes">
      <div class="box">
  <div class="right-side">
    <div class="box-topic">Gastos de hoy</div>

    <?php
      //Today Expense
      $userid=$_SESSION['detsuid'];
      $tdate=date('Y-m-d');
      $query=mysqli_query($db,"select sum(ExpenseCost) as todaysexpense from tblexpense where (ExpenseDate)='$tdate' && (UserId='$userid');");
      $result=mysqli_fetch_array($query);
      $sum_today_expense=$result['todaysexpense'];
    ?> 

    <div class="number"  data-percent="<?php echo $sum_today_expense;?>">
      <?php if($sum_today_expense=="") {
        echo "0";
      } else {
        echo $sum_today_expense;
      } ?>
    </div>
    <div class="indicator">
      <i class='bx bx-up-arrow-alt'></i>
      <span class="text">A partir de hoy</span>
    </div>
  </div>
  <i class='fas fa-circle-plus cart'></i>
 
</div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Gastos de ayer</div>

            <?php
            $userid=$_SESSION['detsuid'];
            $ydate=date('Y-m-d',strtotime("-1 days"));
            $query1=mysqli_query($db,"select sum(ExpenseCost)  as yesterdayexpense from tblexpense where (ExpenseDate)='$ydate' && (UserId='$userid');");
            $result1=mysqli_fetch_array($query1);
            $sum_yesterday_expense=$result1['yesterdayexpense'];
            ?> 

            <div class="number" data-percent="<?php echo $sum_yesterday_expense;?>"><?php if($sum_yesterday_expense==""){
            echo "0";
            } else {
            echo $sum_yesterday_expense;
            }?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">A partir de ayer</span>
            </div>
          </div>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-Y5Oh6F67GY6j+o6lYzZJm+ZeEj9m1ydIGe19q3JV1lk4/4gBVwuP8jwWQ2NfhzJdZtg9tyI8cFk3qTEwhG4sg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
          <i class="fas fa-wallet cart two"></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Ultimos 30 dias</div>

            <?php
            $userid=$_SESSION['detsuid'];
            $monthdate=  date("Y-m-d", strtotime("-1 month")); 
            $crrntdte=date("Y-m-d");
            $query3=mysqli_query($db,"select sum(ExpenseCost)  as monthlyexpense from tblexpense where ((ExpenseDate) between '$monthdate' and '$crrntdte') && (UserId='$userid');");
            $result3=mysqli_fetch_array($query3);
            $sum_monthly_expense=$result3['monthlyexpense'];
            ?>

            <div class="number" data-percent="<?php echo $sum_monthly_expense;?>"><?php if($sum_monthly_expense==""){
          echo "0";
          } else {
          echo $sum_monthly_expense;
          }

            ?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">A partir del ultimo mes</span>
            </div>
          </div>
          <i class='fas fa-history cart three' ></i>
        </div>        
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Gastos totales</div>

            <?php
            $userid=$_SESSION['detsuid'];
            $query5=mysqli_query($db,"select sum(ExpenseCost)  as totalexpense from tblexpense where UserId='$userid';");
            $result5=mysqli_fetch_array($query5);
            $sum_total_expense=$result5['totalexpense'];
            ?>

            <div class="number" data-percent="<?php echo $sum_total_expense;?>"><?php if($sum_total_expense==""){
            echo "0";
            } else {
            echo $sum_total_expense;
            }

              ?></div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt up'></i>
              <span class="text">A partir del ultimo año</span>
            </div>
          </div>
          <i class='fas fa-piggy-bank cart four' ></i>
        </div>
      </div>
<div class="card">
  <div class="card-header">
    <h5 class="card-title">Gastos</h5>
  </div>
  <div class="card-body">
    <canvas id="myChart"></canvas>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php
if (!$db) {
  die("Connection failed: " . mysqli_connect_error());
}

$userid = $_SESSION['detsuid'];
$query = mysqli_query($db, "SELECT ExpenseDate, SUM(ExpenseCost) as total_cost FROM tblexpense WHERE UserId='$userid' AND ExpenseDate > DATE_SUB(NOW(), INTERVAL 30 day) GROUP BY ExpenseDate");
$data = array();
$labels = array();
while ($result = mysqli_fetch_array($query)) {
  $data[] = (float) $result['total_cost'];
  $labels[] = date('Y-m-d', strtotime($result['ExpenseDate']));
}
?>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: <?php echo json_encode($labels); ?>,
    datasets: [{
      label: 'Expenses',
      data: <?php echo json_encode($data); ?>,
      backgroundColor: [
      'rgba(255, 99, 132, 0.5)', // rojo
      'rgba(54, 162, 235, 0.5)', // azul
      'rgba(255, 206, 86, 0.5)', // amarillo
      'rgba(75, 192, 192, 0.5)', // verde
      'rgba(153, 102, 255, 0.5)', // morado
      'rgba(255, 159, 64, 0.5)', // naranjita UwU
      'rgba(255, 0, 0, 0.5)',    // rojo 2
      'rgba(0, 255, 0, 0.5)'     // verde 2
    ],
    borderColor: [
      'rgba(255, 99, 132, 1)',
      'rgba(54, 162, 235, 1)',
      'rgba(255, 206, 86, 1)',
      'rgba(75, 192, 192, 1)',
      'rgba(153, 102, 255, 1)',
      'rgba(255, 159, 64, 1)',
      'rgba(255, 0, 0, 1)',
      'rgba(0, 255, 0, 1)'
    ],

      borderWidth: 1,
      hoverBackgroundColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(255, 0, 0, 1)',
        'rgba(0, 255, 0, 1)'
        ]
    }],
  },
  options: {
    scales: {
      xAxes: [{
        type: 'time',
        time: {
          unit: 'day',
          tooltipFormat: 'll'
        },
        ticks: {
          source: 'auto'
        }
      }],
      yAxes: [{
        ticks: {
          beginAtZero: true
        },
        scaleLabel: {
          display: true,
          labelString: 'Expense Cost'
        }
      }]
    },
    animation: {
      duration: 1000,
      easing: 'easeInOutQuad'
    },
    legend: {
      display: false
    },
    tooltips: {
      enabled: false
    },
    hover: {
      mode: 'nearest',
      intersect: true
    },
    responsive: true,
    maintainAspectRatio: false
  }
});

  var ctx = document.getElementById('myChart').getContext('2d');
  var chart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($labels); ?>,
      datasets: [{
        label: 'Expenses',
        data: <?php echo json_encode($data); ?>,
        backgroundColor: 'rgba(224, 82, 96, 0.5)',
        borderColor: '#e05260',
        borderWidth: 1
      }]
    },
    options: options
  });

  function updateChartData() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var new_data = JSON.parse(this.responseText);
        chart.data.datasets[0].data = new_data;
        chart.update();
      }
    };
    xmlhttp.open("GET", "get_data.php", true);
    xmlhttp.send();
  }

setInterval(updateChartData, 5000);
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<style>
canvas {
  width: 100%;
  height: auto;
}

.card {
  border: 1px solid #ddd;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  margin: 20px;
  padding: 20px;
  background-color: #fff;
  height: 500px;
}
.card1 {
  border: 1px solid #ddd;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  margin: 20px;
  padding: 20px;
  background-color: #fff;
}

.card-header {
  background-color: #f7f7f7;
  border-bottom: 1px solid #ddd;
  margin-bottom: 20px;
  padding: 10px;
}

.card-title {
  font-size: 24px;
  font-weight: bold;
  margin: 0;
}

.card-body {
  padding: 0;
}

@media (max-width: 768px) {
  .card {
    margin: 10px;
    padding: 10px;
  }

  .card-title {
    font-size: 20px;
  }
}
</style>
<div class="card1">
  <div class="card-header">
    <h5 class="card-title">Tabla de categorias</h5>
  </div>
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th>Porcentaje</th>
          <th>Categoria</th>
          <th>Monto</th>
        </tr>
      </thead>
      <tbody id="expense-table-body"></tbody>
      <tfoot>
        <tr>
          <th></th>
          <th>Total</th>
          <th>ARS <span id="total-expense"></span></th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>

<script>
fetch('pie-data.php')
  .then(response => response.json())
  .then(data => {
    const total = data.reduce((acc, curr) => acc + curr.total_expense, 0);
    const colors = ['#FF6384', '#36A2EB', '#FFCE56', '#8E44AD', '#3498DB', '#FFA07A', '#6B8E23', '#FF00FF', '#FFD700', '#00FFFF'];
    const rows = data.map((item, i) => {
      const percentage = ((item.total_expense / total) * 100).toFixed(2);
      const color = colors[i % colors.length];
      const badgeClass = 'badge badge-pill badge-primary';
      return `
        <tr>
          <td><span class="${badgeClass}" style="background-color: ${color}">${percentage}%</span></td>
          <td>${item.category}</td>
          <td>ARS ${item.total_expense.toFixed(2)}</td>
        </tr>
      `;
    }).join('');
    document.getElementById('expense-table-body').innerHTML = rows;
    document.getElementById('total-expense').innerHTML = total.toFixed(2);
  });
</script>


<style>
  .table {
    border-collapse: collapse;
    width: 100%;
    font-size: 16px;
    text-align: left;
  }

  .table th {
    background-color: #f2f2f2;
    font-weight: bold;
    padding: 10px 20px;
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
  }

  .table td {
    padding: 10px 20px;
    border-bottom: 1px solid #ddd;
  }

  .badge {
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 5px 10px;
  }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-ZfSLV7XKlgtWRkec6JzT6Kjgx6UHILee0zmHXJkQAdKbZ0YirYRLfFlIaJl7lN25wyX9N7Ib2QlyeV1qZh/3Jw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<button id="add-button" title="Añadir gasto">
  <i class="fas fa-plus"></i>
</button>

<style>
#add-button::before {
  content: "Añadir gasto";
  position: absolute;
  top: 13px;
  left: -100%;
  transform: translateX(-50%);
  background-color: rgba(0, 0, 0, 0.8);
  color: #fff;
  padding: 6px 12px;
  border-radius: 4px;
  font-size: 14px;
  opacity: 0;
  transition: opacity 0.2s ease-in-out;
}

#add-button:hover::before {
  opacity: 1;
  left: -130%;
}

#add-button {
  position: fixed;
  bottom: 24px;
  right: 24px;
  border: none;
  border-radius: 50%;
  background-color: #4285f4;
  width: 64px;
  height: 64px;
  cursor: pointer;
  display: flex;
  justify-content: center;
  align-items: center;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
  transition: all 0.2s ease-in-out;
}

#add-button:hover {
  transform: translateY(-2px);
  box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
}

#add-button:active {
  transform: translateX(50px) translateY(0px);
  box-shadow: none;
}

#add-button i {
  font-size: 24px;
  color: #fff;
  transition: all 0.2s ease-in-out;
}

#add-button:hover i {
  transform: rotate(-45deg);
}

#add-button:hover {
  background-color: #000;
}

@keyframes shake {
  0% {
    transform: translateX(0);
  }
  25% {
    transform: translateX(-5px);
  }
  50% {
    transform: translateX(5px);
  }
  75% {
    transform: translateX(-5px);
  }
  100% {
    transform: translateX(0);
  }
}

#add-button:active i {
  animation: shake 0.5s ease-in-out;
}
</style>
<script src="https://kit.fontawesome.com/your-code.js" crossorigin="anonymous"></script>
<script>
const addButton = document.getElementById('add-button');

addButton.addEventListener('click', () => {
  addButton.style.transform = 'translateX(50px)';
  setTimeout(() => {
    window.location.href = "add-expenses.php";
  }, 200);
});
</script>
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