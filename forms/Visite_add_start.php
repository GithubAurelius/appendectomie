<?php

$this_fcid = $form_data_a[$_SESSION['param']['pid']] ?? "";
// if (isset($form_data_a[$_SESSION['param']['pid']])) 
//     $visit_a = get_visits($db, $form_data_a[$_SESSION['param']['pid']], $fcid);
// else 
//     $visit_a = [];

 
// Nur für Visite Anzeige im Dashbaord: Achtung einfacher Übertrag nach unten funktioniert nicht


// params
if (!isset($form_data_a[$_SESSION['param']['pid']]) || $form_data_a[$_SESSION['param']['pid']] ==''){
    $form_data_a[$_SESSION['param']['pid']] = $param_a['pid'];
    $form_data_a[$_SESSION['param']['praxis_pid']] = $param_a['praxis_pid'];
    $form_data_a[$_SESSION['param']['ext_fcid']] = $param_a['ext_fcid'];
    $form_data_a[$_SESSION['param']['geschlecht']] = $param_a['geschlecht'];
    $form_data_a[$_SESSION['param']['therapy']] = $param_a['therapy']; 
    $form_data_a[93] = json_encode($fcid ?? ""); // Nice to have - not nessecary 
}

$form_data_a[$_SESSION['param']['first_visit']] = $form_data_a[10005021] ?? "";


// echo "<pre>"; echo print_r($form_data_a); echo "</pre>"; 


// fieldset var
$praxis_id = $form_data_a[$_SESSION['param']['praxis_pid']] ?? "";
$cedur_id   = $form_data_a[$_SESSION['param']['ext_fcid']] ?? "";
$praxis_id = "&nbsp;&nbsp;&nbsp; <img height='16px' src='../images/patient.svg'> Pat.Nr.: ".$praxis_id;
$praxis_id = $praxis_id ." (".$cedur_id.")";

// header
$new_header = $form_data_a[$_SESSION['param']['praxis_pid']] ?? "";
if ($new_header) $header_info = "Patient: ".$form_data_a[$_SESSION['param']['praxis_pid']];
if (DEBUG) $header_info .= " (UID:".$form_data_a[$_SESSION['param']['pid']].", V:".$fcid.")";
 
//$form_data_a[$_SESSION['param']['therapy']]
//echo "<br><br><br><pre>"; echo print_r($form_data_a); echo "</pre>";

