<?php
include "conn.php";
?>




<html>
    <head>
        <meta charset="utf-8">
        <title>Hosty</title>
    </head>
    <body>
        <h1>Lista hostów</h1>

        <form method="post">
            <input type="url" name="host" placeholder="Nazwa hosta"> 
            <input type="submit" name="submit" value="Dodaj nowego hosta">
        </form>

        <?php
            if(isset($_POST['submit']))
            {
                $host_temp = $_POST['host'];
                $host_explode = explode("/", $host_temp);
                $host = $host_explode[2];

                $check_unique = "SELECT * FROM hosts WHERE name='$host'";

                $counter=0;
                foreach($conn->query($check_unique) as $check)
                {
                    $counter++;
                }

                

                if($counter==0)
                {
                $sql = "INSERT INTO hosts (name) VALUES ('$host')";
                $stmt= $conn->prepare($sql);
                $stmt->execute([$host]);
                }
                else
                {
                    echo "Host już istnieje. Nie możesz drugi raz tego samego hosta";
                }
            }
        ?>

        <table>
            <tr>
                <th>Id</th>
                <th>Host</th>
                <th>Wyniki</th>
                <th>Wykonaj test</th>
                <th>Usuń hosta</th>
            </tr>

            <?php
                $dane = "SELECT * FROM hosts";
                $id_zero=1;
                foreach($conn->query($dane) as $row)
                {
                echo "<tr>";
                    echo "<td>".$id_zero."</td>";
                    echo "<td>https://".$row['name']."</td>";
                    $host=$row['name'];
                    echo "<td><a href='wyniki.php?host=$host'>Wyniki</a></td>";
                    echo "<td><a href='test.php?host=$host'>Test pingu</a></td>";
                    echo "<td><a href='usun.php?host=$host'>Usuń hosta</a></td>";
                echo "</tr>";
                $id_zero++;
                }
            ?>
        </table>


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