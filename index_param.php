<?php
$_SESSION['PLOB_FORM'] = 2;             // essential

$_SESSION['param']['pid'] = 90;         // essential
$_SESSION['param']['visite'] = 93;      // essential
$_SESSION['param']['praxis_pid'] = 91;  // comfort/ bei CEDUR semi essential (auch anders lösbar durch dnamische Abfrage der Werte, wenn gebraucht)
$_SESSION['param']['ext_fcid'] = 92;    // comfort/ semi essential
$_SESSION['param']['visite_week'] = 94; // comfort/ bei CEDUR semi essential
$_SESSION['param']['therapy'] = 95;   // comfort/ bei CEDUR semi essential
$_SESSION['param']['geschlecht'] = 96;  // comfort/ bei CEDUR semi essential
$_SESSION['param']['groesse'] = 97;     // comfort/ bei CEDUR semi essential

$_SESSION['table_edit'] = 0;


// Special navigations
if (isset($_SESSION['rl']['plobonly']))
    header("Location: " . MIQ_PATH . "modules/miq_plob");
elseif (isset($_SESSION['temp_params_a'])) { // only qr-direct-access
    $_SESSION['m_uid']      = $_SESSION['temp_params_a']['pid'];
    $_SESSION['uid']        = $_SESSION['temp_params_a']['pid'];
    $_SESSION['user_name']  = $_SESSION['temp_params_a']['ext_fcid'];
    $_SESSION['user_group'] = $_SESSION['temp_params_a']['user_group'];

    // TODO optional: Extract from param_a 
    $_SESSION['overwrite_navigation'] = 1;
    $_SESSION['rl']['user']     = "";
    $_SESSION['rl']['doc_only'] = 10010;
    $_SESSION['temp_fg'] = $_SESSION['rl']['doc_only'];
    $_SESSION['temp_fcid'] = $_SESSION['temp_params_a']['visite'];
    header("Location: forms/Patientenfragebogen.php?a_log=1");
} elseif (isset($_SESSION['rl']['user'])) {
    if ($_SESSION['password_expired']) header("Location: " . MIQ_PATH . "modules/change_userdata/change_userdata.php");
    else header("Location: forms/Patienten_Startseite.php");
}

$labor_haemoglobin_set = $_SESSION['labor_haemoglobin'] ?? 0;
if (!$labor_haemoglobin_set) {
    $inst_data_a = [];
    $inst_data_a = get_query_data($db, 'forms_10000', $query_add = "fid=10000010 AND fcont='" . $_SESSION['user_group'] . "'"); // 
    if (count($inst_data_a) > 0) {
        $fcid_inst = $inst_data_a[0]['fcid'] ?? 0;
        if ($fcid_inst) {
            $inst_data_a = [];
            $inst_data_a = get_query_data($db, 'forms_10000', $query_add = "fcid=" . $fcid_inst . " AND fid=10000021");
            $labor_haemoglobin = $inst_data_a[0]['fcont'] ?? "";
            if ($labor_haemoglobin) $_SESSION['labor_haemoglobin'] = $labor_haemoglobin;
        }
    }
}
