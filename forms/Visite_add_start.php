<?php

function get_visits($db, $pid)
{
    $query = "SELECT fcid FROM forms_10005 WHERE fid=90 AND fcont='" . $pid . "' ORDER BY fcid;";
    // echo $query;
    $stmt = $db->prepare($query);
    $stmt->execute();
    $res_a = $stmt->fetchAll(PDO::FETCH_COLUMN);
    return $res_a;
}

function get_weeks($db, $fcid_str)
{
    $query = "SELECT fcont FROM forms_10005 WHERE fid=10005021 AND fcid IN(". $fcid_str.")";
    // echo $query;
    $stmt = $db->prepare($query);
    $stmt->execute();
    $res_a = $stmt->fetchAll(PDO::FETCH_COLUMN);
    return $res_a;
}

$pid = $form_data_a[$_SESSION['param']['pid']] ?? "";
if (!$pid) $pid = $param_a['pid'];

$week_a = [];
if ($pid){
    $visit_a = get_visits($db, $pid); 
    if (count($visit_a) > 0) $visite_week_a = get_weeks($db, implode(',',$visit_a)); 
}


// params from patient
if ($param_a){
    // new data
    // add here what you need for new data
} else {
    // exisiting data (if patient data was changed)
    $param_name_a = array_flip($_SESSION['param']);
    $param_fid_str = implode(',', $_SESSION['param']);
    $param_a['pid'] = $pid;
    $temp_pat_a = get_query_data($db, 'forms_10003', 'fcid='.$pid.' AND fid IN (' . $param_fid_str . ')');
    foreach ($temp_pat_a as $index => $field_a) $param_a[$param_name_a[$field_a['fid']]] = $field_a['fcont'];
}
// echo "<pre>"; echo print_r($param_a); echo "</pre>";
$form_data_a[$_SESSION['param']['pid']] = $param_a['pid'];
$form_data_a[$_SESSION['param']['praxis_pid']] = $param_a['praxis_pid'];
$form_data_a[$_SESSION['param']['ext_fcid']] = $param_a['ext_fcid'];
$form_data_a[$_SESSION['param']['geschlecht']] = $param_a['geschlecht'];
$form_data_a[$_SESSION['param']['therapy']] = $param_a['therapy']; 

// fieldset var
$praxis_id = $form_data_a[$_SESSION['param']['praxis_pid']] ?? "";
$ext_fcid   = $form_data_a[$_SESSION['param']['ext_fcid']] ?? "";
$sex = $form_data_a[$_SESSION['param']['geschlecht']] ?? ""; 
$praxis_id = "&nbsp;&nbsp;&nbsp; <img height='16px' src='../images/patient.svg'> Pat.Nr.: ".$praxis_id;
$praxis_id = $praxis_id ." (".$ext_fcid."), ".$sex;

// header
$new_header = $form_data_a[$_SESSION['param']['praxis_pid']] ?? "";
if ($new_header) $header_info = "Patient: ".$form_data_a[$_SESSION['param']['praxis_pid']];
if (DEBUG) $header_info .= " (UID:".$form_data_a[$_SESSION['param']['pid']].", V:".$fcid.")";
 
//$form_data_a[$_SESSION['param']['therapy']]
//echo "<br><br><br><pre>"; echo print_r($form_data_a); echo "</pre>";

