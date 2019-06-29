<?php

namespace clay_plugins;

function get_all_plugins()
{
    $db_conn = \global_db\db_conn();
    $query = $db_conn->query("SELECT * FROM litico_plugins");
    return \global_db\get_result_as_assoc_array($query);
}

function init_plugin_global_arrays()
{
    $GLOBALS['PLUGIN_VARS'] = array();

    $all_plugins = get_all_plugins();

    foreach ($all_plugins as $row)
    {
        $identifier = strtoupper($row['plugin_string_identifier']);
        $GLOBALS['PLUGIN_VARS'][$identifier] = array();
    }
}

init_plugin_global_arrays();