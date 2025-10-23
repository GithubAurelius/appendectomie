<?php
// session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// require_once $_SESSION['INI-PATH'];

function del_chain($db, $query_str ){
    $fcid = explode('=', $query_str)[1];
    if ($fcid) $fcid = trim($fcid);
    $del_is_patient = 0; 
    $del_is_visite = 0; 
    if (substr_count($query_str, '10003')) $del_is_patient = 1; 
    if (substr_count($query_str, '10005')) $del_is_visite = 1; 
    
    $del_active = 1; 

    $del_queries = "";
    if ($del_is_patient || $del_is_visite){
        
        $query_str;
        $del_queries .= $query_str."\n";
        // echo "<br>".$query_str_visite."<br>".$query_str_questionary;
        $stmt = $db->prepare($query_str);
        if ($del_active) $stmt->execute();

        if ($del_is_visite){
            $query_str_visite = $query_str;
            $query_str_questionary = str_replace('10005', '10010', $query_str);
            $del_queries .= $query_str_questionary."\n";
            // echo "<br>".$query_str_visite."<br>".$query_str_questionary;
            $stmt = $db->prepare($query_str_questionary);
            if ($del_active) $stmt->execute();
        }

        if ($del_is_patient){
            $visite_fcid_str = "";
            $visite_a = get_query_data($db, 'forms_10005', "fid=90 AND fcont='".$fcid."'");
            if (count($visite_a)>0) {
                foreach ($visite_a as $num => $field_a) { 
                    $visite_fid_a[] = $field_a['fcid']; 
                }
                $visite_fcid_str = implode(',',$visite_fid_a);
                if ($visite_fcid_str) $query_str_visite = "DELETE FROM forms_10005 WHERE fcid IN (".$visite_fcid_str.")";
                $del_queries .= $query_str_visite."\n";
                // echo "<br>visite and questionary:".$visite_fcid_str;
                $stmt = $db->prepare($query_str_visite);
                if ($del_active) $stmt->execute();

                $query_str_questionary = str_replace('10005', '10010', $query_str_visite);
                $del_queries .= $query_str_questionary."\n";
                // echo "<br>".$query_str_visite."<br>".$query_str_questionary;
                $stmt = $db->prepare($query_str_questionary);
                if ($del_active) $stmt->execute();
            }
            
            
            
            
           
        }
        echo str_replace("\n","<br>", $del_queries);
    
    } else {
        $del_queries .= $query_str;
        $stmt = $db->prepare($query_str);
        if ($del_active) $stmt->execute();
    }
    $del_queries = "USER: ".$_SESSION['m_uid']."\n".$del_queries;
    file_put_contents(PLOG.'DEL_'.$fcid.'at_'.date('Ymdhis').'.txt',  $del_queries); 
}

// del_chain($db, "DELETE FROM forms_10003 WHERE fcid=2025091413564637");

// get_query_data($db, $table, $query_add = '')
