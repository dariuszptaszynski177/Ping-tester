<?php
include "conn.php";
?>

<?php
$host = $_REQUEST['host'];

$delete_host = "DELETE FROM hosts WHERE name='$host'";
$conn->exec($delete_host);

$delete_host_results = "DELETE FROM hosts_results WHERE name='$host'";
$conn->exec($delete_host_results);

header("Location: index.php");
?>