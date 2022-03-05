<DOCTYPE html>
<html>
<head>
<title>Wyniki</title>
</head>
<body> 

<?php
include "conn.php";
?>

<?php
include "header.php";
?>

<?php
    $host = $_REQUEST['host'];
   // echo $host;
    echo "<h1>Wyniki ping testów dla strony https://$host</h1>";
    $dane = "SELECT * FROM hosts_results WHERE name='$host'";

   

    foreach ($conn->query($dane) as $row)
    {
       $productname[]  = $row['name']." [".$row['packages']."]";
       
        $min[] = $row['min_result'];
        $max[] = $row['max_result'];
        $avg[] = $row['avg_result'];
        
    }

    
    ?>
    
    
    <div style="width:60%;hieght:20%;text-align:center">
                <h2 class="page-header" >Wykres dla najmniejszego czasu odpowiedzi</h2>
                
                <canvas  id="chartjs_bar_min"></canvas> 
            </div> 
                    
                    
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script type="text/javascript">
          var ctx1 = document.getElementById("chartjs_bar_min").getContext('2d');
                    var myChart = new Chart(ctx1, {
                        type: 'bar',
                        data: {
                            labels:<?php echo json_encode($productname); ?>,
                            datasets: [{
                                backgroundColor:"#5969ff",
                                // backgroundColor: [
                                //    "#5969ff",
                                //     "#ff407b",
                                //     "#25d5f2",
                                //     "#ffc750",
                                //     "#2ec551",
                                //     "#7040fa",
                                //     "#ff004e"
                                // ],
                                data:<?php echo json_encode($min); ?>,
                            }]
                        },
                        options: {
                               legend: {
                            display: false,
                            position: 'bottom',
     
                            labels: {
                                fontColor: '#71748d',
                                fontFamily: 'Circular Std Book',
                                fontSize: 14,
                            }
    
                            
                        },
                        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                    },
              scaleLabel: {
                display: true,
                labelString: 'Czas odpowiedzi [ms]'
              }
            }],
    
            xAxes: [{
              scaleLabel: {
                display: true,
                labelString: 'Nazwa domeny [Ilość pakietów]'
              }
            }]
          },
                        
     
                    }
                    });
        </script>




<div style="width:60%;hieght:20%;text-align:center">
                <h2 class="page-header" >Wykres dla największego czasu odpowiedzi</h2>
                
                <canvas  id="chartjs_bar_max"></canvas> 
            </div> 
                    
                    
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script type="text/javascript">
          var ctx2 = document.getElementById("chartjs_bar_max").getContext('2d');
                    var myChart = new Chart(ctx2, {
                        type: 'bar',
                        data: {
                            labels:<?php echo json_encode($productname); ?>,
                            datasets: [{
                                backgroundColor:"#5969ff",
                                // backgroundColor: [
                                //    "#5969ff",
                                //     "#ff407b",
                                //     "#25d5f2",
                                //     "#ffc750",
                                //     "#2ec551",
                                //     "#7040fa",
                                //     "#ff004e"
                                // ],
                                data:<?php echo json_encode($max); ?>,
                            }]
                        },
                        options: {
                               legend: {
                            display: false,
                            position: 'bottom',
     
                            labels: {
                                fontColor: '#71748d',
                                fontFamily: 'Circular Std Book',
                                fontSize: 14,
                            }
    
                            
                        },
                        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                    },
              scaleLabel: {
                display: true,
                labelString: 'Czas odpowiedzi [ms]'
              }
            }],
    
            xAxes: [{
              scaleLabel: {
                display: true,
                labelString: 'Nazwa domeny [Ilość pakietów]'
              }
            }]
          },
                        
     
                    }
                    });
        </script>






<div style="width:60%;hieght:20%;text-align:center">
                <h2 class="page-header" >Wykres dla średniego czasu odpowiedzi</h2>
                
                <canvas  id="chartjs_bar_avg"></canvas> 
            </div> 
                    
                    
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script type="text/javascript">
          var ctx3 = document.getElementById("chartjs_bar_avg").getContext('2d');
                    var myChart = new Chart(ctx3, {
                        type: 'bar',
                        data: {
                            labels:<?php echo json_encode($productname); ?>,
                            datasets: [{
                                backgroundColor:"#5969ff",
                                // backgroundColor: [
                                //    "#5969ff",
                                //     "#ff407b",
                                //     "#25d5f2",
                                //     "#ffc750",
                                //     "#2ec551",
                                //     "#7040fa",
                                //     "#ff004e"
                                // ],
                                data:<?php echo json_encode($avg); ?>,
                            }]
                        },
                        options: {
                               legend: {
                            display: false,
                            position: 'bottom',
     
                            labels: {
                                fontColor: '#71748d',
                                fontFamily: 'Circular Std Book',
                                fontSize: 14,
                            }
    
                            
                        },
                        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                    },
              scaleLabel: {
                display: true,
                labelString: 'Czas odpowiedzi [ms]'
                
              }
            }],
    
            xAxes: [{
              scaleLabel: {
                display: true,
                labelString: 'Nazwa domeny [Ilość pakietów]'
              }
            }]
          },
                        
     
                    }
                    });
        </script>




<?php
include "footer.php";
?>

</body>
</html>