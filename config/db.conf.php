<?

namespace global_db;

//This is the configuration file for the database.
//Please edit the values here when installing on a new server

function db_conn()
{
    $config_json = file_get_contents(DocRoot . "config/" . "dyn.config.json");
    $config_object = json_decode($config_json);
    $db_conf = $config_object->db_conf;

    $conn = new \mysqli($db_conf->host, $db_conf->user, $db_conf->password, $db_conf->database_name);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

//TODO: Create a different inclusion file for database functions
function get_result_as_assoc_array($result)
{
    if(!mysqli_num_rows($result))
        return 0;

    $returnArray = array();

    while($row = mysqli_fetch_assoc($result))
    {
        $row_arr = array();
        foreach ($row as $key => $value)
            $row_arr[$key] = $value;
        array_push($returnArray, $row_arr);
    }

    return $returnArray;
}
?>