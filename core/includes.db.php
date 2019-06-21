<?php

/*
 * This file gets all the includes from the litico_includes table from the database
 * and includes them priority wise.
 */
$conn = global_db\db_conn();
$incl_query = mysqli_query($conn, "SELECT * FROM litico_includes ORDER BY priority ASC");
while($incl = mysqli_fetch_assoc($incl_query))
{
    $includeFile = $incl['includeFile'];
    $refactored = preg_replace("{DS}", DS, $includeFile);
    include DocRoot . $refactored . ".incl.php";
}