<?php
$_SESSION['center'] = "DEMO-Zentrum";

function check_if_valexists($db, $fg, $fid, $val)
{
    if ($val) $val == trim(chop($val));
    $query = "SELECT fcid FROM forms_" . $fg . " WHERE fid=" . $fid . " AND fcont='" . $val . "' AND usergroup=" . $_SESSION['user_group'];
    // echo $query;
    $stmt = $db->prepare($query);
    $stmt->execute();
    $res_a = $stmt->fetchAll(PDO::FETCH_COLUMN);
    // echo "<pre>"; echo print_r($res_a); echo "</pre>";
    return count($res_a);
}

function generateCodeLLLNNNN($fcid, $key10)
{
    if (strlen($fcid) !== 12) {
        throw new Exception("fcid muss genau 12 Zeichen (ymdHis) lang sein.");
    }
    if (strlen($key10) !== 10) {
        throw new Exception("key muss genau 10 Zeichen lang sein.");
    }
    // Erzeuge schlüsselabhängigen Hash (HMAC-SHA1)
    $hash = hash_hmac('sha1', $fcid, $key10);
    // Buchstaben-Teil (LLL) → 26^3 = 17576 Möglichkeiten
    $lettersInt = hexdec(substr($hash, 0, 4)) % 17576;
    $letters =
        chr(65 + intdiv($lettersInt, 676) % 26) .
        chr(65 + intdiv($lettersInt, 26) % 26) .
        chr(65 + $lettersInt % 26);
    // Zahlen-Teil (NNNN) → 0000 bis 9999
    $numbersInt = hexdec(substr($hash, 4, 4)) % 10000;
    $numbers = str_pad($numbersInt, 4, '0', STR_PAD_LEFT);
    return $letters . '-' . $numbers;
}

function get_user_data($db, $master_uid)
{
    $stmt = $db->prepare("SELECT master_uid,login_name,login_pass,email  FROM user_miq WHERE master_uid = :master_uid");
    $stmt->bindParam(':master_uid', $master_uid);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

$user_data_a = get_user_data($db, $fcid);

$therapy = "";
$temp_a = get_query_data($db, 'forms_10003', 'fcid=' . $fcid . ' AND fid=95');
if ($temp_a) $therapy = $temp_a[0]['fcont'];

if ($_POST) {

    $praxis_nr = $form_data_a[$_SESSION['param']['praxis_pid']] ?? "";
    $check_fg = 10003;
    $check_fid = 91;
    if ($praxis_nr) {
        $patient_exists = check_if_valexists($db,  $check_fg, $check_fid, $form_data_a[$_SESSION['param']['praxis_pid']]);
        if ($patient_exists  > 1) {
            echo "<script>alert('Achtung!\\n\\nDer Patient mit der Nummer " . $praxis_nr . " exisitiert bereits. Das Feld >> Praxis-Nummer << wurde gelöscht!\\n\\nSie können den leeren Patientendatensatz mit einem anderen NEUEN Patienten überschreiben oder löschen.')</script>";
            $form_data_a[$_SESSION['param']['praxis_pid']] = "";
            $query = "DELETE FROM forms_" . $fg . " WHERE fcid=" . $fcid . " AND fid=" . $check_fid . " AND fcont='" . $praxis_nr . "' AND usergroup=" . $_SESSION['user_group'];
            $stmt = $db->prepare($query);
            $stmt->execute();
        }
    }
    $therapy_a = [];

    if ($_POST['FF_10020001'] ?? "") $therapy_a[] = "Konservativ";
    if ($_POST['FF_10020002'] ?? "") $therapy_a[] = "Operation";
    $therapy  = implode("/", $therapy_a);
   
}



$email = "";
$ext_fcid_code = "";
$ext_fcid_code_key = "A1X2CED3Z5"; // TODO GENERATE FROM PRAXIS-CODE 
$pid = $_REQUEST['pid'] ?? 0;

// only if dataset is new (fcid=-1 in form_start)
if (!empty($fcid_ts)) {
    //$ext_fcid = substr($fcid_ts, 2);
    // $ext_fcid_code = generateCodeLLLNNNN($ext_fcid, $ext_fcid_code_key);
    // if ($ext_fcid_code) $form_data_a[$_SESSION['param']['ext_fcid']] = $ext_fcid_code;
}



$new_header = $form_data_a[$_SESSION['param']['praxis_pid']] ?? "";
if ($new_header) # $header_info = "Patient: " . $form_data_a[$_SESSION['param']['praxis_pid']];
    $header_info = "<button class='save-button-style' title='Patientendaten einblenden' id='edit_patient_button'>👤Einblenden</button>"
        . " " . ($form_data_a[$_SESSION['param']['praxis_pid']] ?? "") . ": "
        . "<font style='font-weight:normal'> (" . ($form_data_a[$_SESSION['param']['ext_fcid']] ?? "") . ")"
        . " " . ($form_data_a[$_SESSION['param']['geschlecht']] ?? "") . ","
        . " " . ($form_data_a[10003020] ?? "") . ","
        . " " . $therapy . "</font>";


// for interaction with user_mngt - repect DSSGVO
// if ($user_data_a) {
//     $email = $user_data_a['email'] ?? "";
//     if ($email) $form_data_a[10003040] = $email;
// }

$ppid = $form_data_a[$_SESSION['param']['praxis_pid']] ?? "";
$pgender = $form_data_a[$_SESSION['param']['geschlecht']] ?? "";
$ext_fcid = $form_data_a[$_SESSION['param']['ext_fcid']] ?? "";
$age = $form_data_a[10003020] ?? "";
$weight = $form_data_a[102700] ?? "";
$size = $form_data_a[102600] ?? "";
$konservativ = $form_data_a[10020001] ?? "";
$konservativ_date = $form_data_a[10003047] ?? "";
$operation = $form_data_a[10020002] ?? "";
$operation_date = $form_data_a[10003048] ?? "";



$all_ein_ja = 0;
$fieldIds_ein_a = explode(',','10003101,10003102,10003103,10003104,10003105,10003106,10003107,10003108');
$counter = 0;
foreach ($fieldIds_ein_a as $key => $val) 
    if (($form_data_a[$val] ?? '') == 'Ja') $counter++;
if ($counter == count($fieldIds_ein_a)) $all_ein_ja = 1;

$all_ein_aus = 0;
$fieldIds_aus_a = explode(',','10003201,10003202,10003203,10003204,10003205,10003206,10003207,10003208,10003209,10003210,10003211');
$counter = 0;
foreach ($fieldIds_aus_a as $key => $val) 
   if (($form_data_a[$val] ?? '') == 'Nein') $counter++;
if ($counter == count($fieldIds_aus_a)) $all_ein_aus = 1;

$visite_button = "";
$data_complete = 0;
if (($konservativ || $operation) && $ppid && $pgender && $age && $weight && $size && $ext_fcid && $all_ein_ja && $all_ein_aus) {
    $visite_button = "<button style='min-width:24px;max-width:24px;padding:2px' title ='Neue Visite anlegen' type='button' onclick=\"window.top.forward_form('form', 'fcid', '-1', 'Visite', " . $num . ", param_a)\";><img src='" . MIQ_PATH . "/img/new_add.svg' width='16px'></button>";
    $data_complete = 1;
    if ($operation && !$operation_date) $data_complete = 0;
    if ($konservativ && !$konservativ_date) $data_complete = 0;
}


?>

<!-- tabs & dashboard-->
<style>
    /* tabs */
    .tabs {
        width: 100%;
        margin: auto;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .tab-buttons {

        display: flex;
        border-bottom: 1px solid #e0e0e0;
        background-color: #f4f4f4;
        border-radius: 6px 6px 0 0;
        overflow-x: auto;
        /* Falls es zu viele Tabs gibt */
        overflow-y: hidden;
        box-shadow: inset 0 -1px 0 #ddd;
        width: 100%;
        box-sizing: border-box;
    }

    .tab-button {
        flex: 1 1 0;
        /* Flex-grow: 1, Flex-shrink: 1, Basis: 0 */
        padding: 0.2rem;
        background-color: rgb(251, 251, 251);
        border: none;
        border-right: 2px solid #e0e0e0;
        cursor: pointer;
        font-size: 12px;
        color: #555;
        transition: background 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
        outline: none;
        border-radius: 0;
        box-sizing: border-box;

        min-width: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .tab-button:last-child {
        border-right: none;
    }

    .tab-button:hover {
        background-color: rgb(242, 242, 242);
        color: #222;
    }

    .tab-button.active {
        background-color: #fff7f7;
        font-weight: 600;
        color: #000;
        box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.06), inset 0 2px 0 #fff;
        position: relative;
        z-index: 1;
    }

    .tab-content {
        display: none;
        padding: 0;
        width: 99%;
    }

    .tab-content.active {
        display: block;
    }
</style>

<!-- tabs -->
<div id='patient_tabs' class="tabs">
    <div class="tab-buttons">
        <button type="button" class="tab-button active" data-tab="tab1" id='visite_tab'>Visite</button> <?php echo $visite_button ?>
        <button type="button" class="tab-button" data-tab="tab2">Scores</button>
        <button type="button" class="tab-button" data-tab="tab3">Befragung</button>
        <button type="button" class="tab-button" data-tab="tab4">Untersuchung</button>
        <button type="button" class="tab-button" data-tab="tab5">Labor</button>
        <button type="button" class="tab-button" data-tab="tab6">Medikation</button>
        <button type="button" class="tab-button" data-tab="tab7">Nebenwirkungen</button>

    </div>
    <div class="tab-content active" id="tab1">
        <iframe id='_visite' style='width:100%; border:none; padding:0; margin:0;'></iframe>
    </div>
    <div class="tab-content" id="tab2">
        <iframe id='_scores' style='width:100%; border:none; padding:0; margin:0;'></iframe>
    </div>
    <div class="tab-content" id="tab3">
        <iframe id='_patientenbefragung' style='width:100%; border:none; padding:0; margin:0;'></iframe>
    </div>
    <div class="tab-content" id="tab4">
        <iframe id='_untersuchung' style='width:100%; border:none; padding:0; margin:0;'></iframe>
    </div>
    <div class="tab-content" id="tab5">
        <iframe id='_labor' style='width:100%; border:none; padding:0; margin:0;'></iframe>
    </div>
    <div class="tab-content" id="tab6">
        <iframe id='_medikation' style='width:100%; border:none; padding:0; margin:0;'></iframe>
    </div>
    <div class="tab-content" id="tab7">
        <iframe id='_nebenwirkung' style='width:100%; border:none; padding:0; margin:0;'></iframe>
    </div>

</div>