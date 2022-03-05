<?php
include "header.php";
?>

<?php
include "conn.php";
?>

<?php
// Function to check response time
function pingDomain($domain){
    $starttime = microtime(true);
    $file      = fsockopen ($domain, 80, $errno, $errstr, 10);
    $stoptime  = microtime(true);
    $status    = 0;
 
    if (!$file) $status = -1;  // Site is down
    else {
        fclose($file);
        $status = ($stoptime - $starttime) * 1000;
        $status = floor($status);
    }
    //echo $status."<br />";
    return $status;
}
?>

<html>
<head>
<title>Test pingu</title>
</head>
    <body>
    <?php
    $title_host = $_REQUEST['host'];
        echo "<h3>Test pingu dla https://$title_host</h3>";

    ?>
        1 paczka = 4 pakiety (4 pingi)<br />
        <form method="post">
            <input type="number" name="ile_paczek" min="1" placeholder="Dla ilu paczek chcesz wykonać ping test?" style="width: 300px;">
            <input type="submit" name="submit" value="Rozpocznij test">
        </form>

        <style>
            table, td, th 
            {
            border: 1px solid black;
            padding: 5px;
            }

            table 
            {
           
            border-collapse: collapse;
            }
        </style>
    </body>
</html>

<?php
    if(isset($_POST['submit']))
    {
        $ile_paczek = $_POST['ile_paczek'];
        $host = $_REQUEST['host'];
        
        $tab=[];
        $j=0;
        $suma=0;
        $policz;

        if(pingDomain($host)==-1)
        {
            echo "Serwer nie odpowiada";
        }
        else
        {
        for($i=0;$i<$ile_paczek;$i++)
        {
            


            $tab[$j]=pingDomain($host);
            $suma=$suma+$tab[$j];
            $j++;
            $tab[$j]=pingDomain($host);
            $suma=$suma+$tab[$j];
            $j++;
            $tab[$j]=pingDomain($host);
            $suma=$suma+$tab[$j];
            $j++;
            $tab[$j]=pingDomain($host);
            $suma=$suma+$tab[$j];
            $j++;

            $policz++;

            sleep(1);//co sekundę
        }

        $policz=$policz*4;
        $srednia=$suma/$policz;
        $min=min($tab);
        $max=max($tab);
        echo "<b>Wyniki</b><br />";
        echo "Min: ".$min."<br />";
        echo "Max: ".$max."<br />";
        echo "AVG: ".$srednia."<br />";

        $licznik=0;
        $nr_paczki=1;
        echo "<table>";
            echo "<tr>";
                echo "<th>Nr paczki</th>";
                echo "<th>Czas odpowiedzi pakietu [ms]</th>";
            echo "</tr>";
                foreach($tab as $t)
                {   
                    
                        echo "<tr>";
                        if($licznik%4==0)
                        {
                        echo "<td>$nr_paczki</td>";
                        echo "<td>$t</td>";
                        $nr_paczki++;
                        }
                        else
                        {
                            echo "<td></td>";
                            echo "<td>$t</td>";
                        }
                        
                        echo "</tr>";
                   $licznik++;
                   
                }
            
        echo "</table>";


        $dodaj = "INSERT INTO hosts_results (name, min_result, max_result, avg_result, packages) VALUES ('$host', '$min', '$max', '$srednia', '$policz')";
        $stmt= $conn->prepare($dodaj);
        $stmt->execute([$host, $min, $max, $srednia, $policz]);
            }
    }
?>

<?php

?>