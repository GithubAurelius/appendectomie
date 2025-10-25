<?php

if (!empty($prepare_page)) {
    $data_def_a['desc_a']['F_10'] = 'Owner';
    $data_def_a['desc_a']['F_20'] = 'Group';
    $data_def_a['desc_a']['F_90'] = 'PID';
    $data_def_a['desc_a']['F_93'] = 'VID';
    $data_def_a['desc_a']['F_94'] = 'BASE';
    $data_def_a['desc_a']['F_96'] = 'Geschlecht';
    $data_def_a['desc_a']['F_fcid'] = 'FCID';

    $data_def_a['desc_a']['F_10005021'] = 'Woche';
    $data_def_a['desc_a']['F_10005020'] = 'Datum';
    $data_def_a['desc_a']['F_92'] = 'Studien-Nr. ';
    $data_def_a['desc_a']['F_95'] = 'Therapie';

} else {
    foreach ($table_a as $fcid => $data_a) {
        if (isset($data_a[100])){
            $error_a = json_decode($data_a[100], true) ?? [];
            if (count($error_a)>0) $temp_str = 'P ('.count($error_a).')'; 
            if (count($error_a) == 0  || (count($error_a)==1 && isset($error_a['FF_0'])) ) $temp_str = '✓ (OK)';
            $table_a[$fcid][100] = $temp_str;
        }
        else {
            $table_a[$fcid][100] = '-';
        }
    }
    
}
    // let err_str = "";
    // const labor_keys = ['FF_110200'];
    // let hasKey = labor_keys.some(key => {
    //     return error_a.hasOwnProperty(key);
    // });
    // if (hasKey) err_str = 'L'

    // const medic_keys = 
    // hasKey = medic_keys.some(key => {
    //     return error_a.hasOwnProperty(key);
    // });
    // if (hasKey) err_str = err_str + 'M'


    // const nw_keys = ['FF_110905'];
    // hasKey = nw_keys.some(key => {
    //     return error_a.hasOwnProperty(key);
    // });
    // if (hasKey) err_str = err_str + 'N'

