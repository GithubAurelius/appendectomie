<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$ini_path = $_SESSION['INI-PATH'] ?? "";
if ($ini_path && isset($_SESSION['m_uid'])) require_once $ini_path;
else {
    echo file_get_contents('logout.php');
    // echo "<h2><b>Sie wurden abgemeldet!</b><h3>Scannen Sie Ihren Code erneut ein ...<br><br>oder melden Sie sich bitte über die <a href='../'>Startseite<a> an, wenn Sie über Zugangsdaten verfügen!</h3>";
    exit;
}


require_once MIQ_ROOT . "/modules/form_base/form_start.php";
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datenerfassung</title>
    <?php
    $file_add_start = str_replace(".php", "_add_start.php", "./" . basename(__FILE__));
    if (file_exists($file_add_start)) include_once($file_add_start);
    ?>
    <link rel="stylesheet" href="<?php echo MIQ_PATH ?>/css/form_base.css?RAND=<?php echo random_bytes(5); ?>">
    <script src="<?php echo MIQ_PATH ?>/modules/form_base/forms.js?RAND=<?php echo random_bytes(5); ?>"></script>
</head>

<body>

    <!--<button type="button" onClick="window.parent.forward_form('fcid', <?php echo $fcid ?>,'Test1')" >Beispiel weiterführendes Formular</button>-->
    <!--<button type="button" onClick="window.location.href='<?php echo $_SERVER['PHP_SELF'] ?>?fg=<?php echo $fg ?>&fcid=' + getCid()" >NEU</button>-->

    <div id='header'>
        <div class="header-row">
            <div class="header-left">
                <?php $a_log = $_REQUEST['a_log'] ?? $_POST['a_log'] ?? ''; ?>
                <?php if ($a_log == 1) { ?>
                    <button id='logoff_form' onclick="document.location.href ='<?php echo $_SESSION['WEBROOT'] . $_SESSION['PROJECT_PATH'] . 'login.php' ?>'">Abmelden</button>
                <?php } ?>
                <strong><?php echo $header_info ?></strong>&nbsp;
            </div>
            <div class="header-right" id="submit_span">
                <button id='main_form_submit_button' onclick='document.main_form.submit()'>💾Speichern</button>
                <button type='button' id='main_form_submit_new_button' style='display:none'>💾Speichern und ➕Neu</button>
            </div>
        </div>
    </div>
    <div id='sub_header'>
        <label id="status" class="hintlabel"></label>
    </div>

    <table id='main_tab'>
        <tr>
            <td width='99%' valign='top'>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" id='main_form' name='main_form'
                    enctype="multipart/form-data">
                    <div>
                        <input type="hidden" id="FF_10" name="FF_10" value="<?php echo $_SESSION['m_uid'] ?>">
                        <input type="hidden" id="FF_20" name="FF_20" value="<?php echo $_SESSION['user_group'] ?>">
                        <input type="hidden" id="fcid" name="fcid" value="<?php echo $fcid ?>">
                        <input type="hidden" id="fg" name="fg" value="<?php echo $fg ?>">
                        <input type="hidden" id="a_log" name="a_log" value="<?php echo $a_log ?>">
                        <input type="hidden" id="opener_num" name="opener_num" value="<?php echo $opener_num ?>">
                        <input type="hidden" id="helper" name="helper">
                        <input type="hidden" id="errors" name="errors">
                        <input type="hidden" id="param_str" name="param_str">
                    </div>
                    <creator>
				<div class='row' style='height:0;visibility: collapse;'>
					
                    <div class='col_a' id='SH_90_a'>
                        <div class='desc_f' >pid</div>
                    </div>
                    <div class='col_b' id='SH_90_b'>
                        <input data-fg='10010'  type='text' id='FF_90' name='FF_90' value="<?php echo htmlspecialchars($form_data_a[90] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_91_a'>
                        <div class='desc_f' >Praxis-ID</div>
                    </div>
                    <div class='col_b' id='SH_91_b'>
                        <input data-fg='10010'  type='text' id='FF_91' name='FF_91' value="<?php echo htmlspecialchars($form_data_a[91] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_92_a'>
                        <div class='desc_f' >Cedur-Nr.</div>
                    </div>
                    <div class='col_b' id='SH_92_b'>
                        <input data-fg='10010'  type='text' id='FF_92' name='FF_92' value="<?php echo htmlspecialchars($form_data_a[92] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_93_a'>
                        <div class='desc_f' >VID</div>
                    </div>
                    <div class='col_b' id='SH_93_b'>
                        <input data-fg='10010'  type='text' id='FF_93' name='FF_93' value="<?php echo htmlspecialchars($form_data_a[93] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_94_a'>
                        <div class='desc_f' >Baseline</div>
                    </div>
                    <div class='col_b' id='SH_94_b'>
                        <input data-fg='10010'  type='text' id='FF_94' name='FF_94' value="<?php echo htmlspecialchars($form_data_a[94] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_95_a'>
                        <div class='desc_f' >Diagnose</div>
                    </div>
                    <div class='col_b' id='SH_95_b'>
                        <input data-fg='10010'  type='text' id='FF_95' name='FF_95' value="<?php echo htmlspecialchars($form_data_a[95] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_96_a'>
                        <div class='desc_f' >geschlecht</div>
                    </div>
                    <div class='col_b' id='SH_96_b'>
                        <input data-fg='10010'  type='text' id='FF_96' name='FF_96' value="<?php echo htmlspecialchars($form_data_a[96] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_100_a'>
                        <div class='desc_f' >Error</div>
                    </div>
                    <div class='col_b' id='SH_100_b'>
                        <input data-fg='10010'  type='text' id='FF_100' name='FF_100' value="<?php echo htmlspecialchars($form_data_a[100] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_10005020_a'>
                        <div class='desc_f' >Visite</div>
                    </div>
                    <div class='col_b' id='SH_10005020_b'>
                        <input data-fg='10010'  type='text' id='FF_10005020' name='FF_10005020' value="<?php echo htmlspecialchars($form_data_a[10005020] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_10005021_a'>
                        <div class='desc_f' >Woche</div>
                    </div>
                    <div class='col_b' id='SH_10005021_b'>
                        <input data-fg='10010'  type='text' id='FF_10005021' name='FF_10005021' value="<?php echo htmlspecialchars($form_data_a[10005021] ?? ''); ?>" placeholder=''>
                    </div>
				</div>
			<fieldset id='FS_'><legend>Untersuchung</legend>
					
                    <div class='col_a' id='SH_20115_a'>
                        <div class='desc_f' ><strong>Klinische Vorstellung durchgeführt?</strong>:</div>
                    </div>
                    <div class='col_b' id='SH_20115_b'  style='text-align:center'>
                        <div id='cbm_20115'>
                            <input data-rcb='20115' required class='sim_hide' type='text' id='FF_20115' name='FF_20115' value="<?php echo $form_data_a[20115] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_20115_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_20115_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
					
                    <div class='col_a' id='SH_20560_a'>
                        <div class='desc_f' >Selbstwahrnehmung des Patienten zum Allgemeinszustand:</div>
                    </div>
                    <div class='col_b' id='SH_20560_b'>
                        <select required id='FF_20560' name='FF_20560'  onchange='follow_select(this)'><option value=''></option><option value='verschlechtert' <?php if (($form_data_a[20560] ?? '') == 'verschlechtert') echo 'selected'; ?>>verschlechtert</option><option value='gleichbleibend' <?php if (($form_data_a[20560] ?? '') == 'gleichbleibend') echo 'selected'; ?>>gleichbleibend</option><option value='gebessert' <?php if (($form_data_a[20560] ?? '') == 'gebessert') echo 'selected'; ?>>gebessert</option>
                        </select>
                    </div>
			</fieldset>
			<fieldset id='FS_'><legend>Labor</legend>
					
                    <div class='col_a'  id='SH_20570_a'>
                        <div class='desc_f' >CRP</div>
                    </div>
                    <div class='col_b' style='display: flex; flex-wrap: nowrap;white-space: nowrap;' id='SH_20570_b'>
                        <input required type='number' id='FF_20570' name='FF_20570' value="<?php echo htmlspecialchars($form_data_a[20570] ?? ''); ?>" min='0' max='100' step='0.1' placeholder=''><select id='FF_20580' name='FF_20580'  onchange='follow_select(this)'><option value=''></option><option value='mg/l' <?php if (($form_data_a[20580] ?? '') == 'mg/l') echo 'selected'; ?>>mg/l</option><option value='mg/dl' <?php if (($form_data_a[20580] ?? '') == 'mg/dl') echo 'selected'; ?>>mg/dl</option></select></div>
					
                    <div class='col_a'  id='SH_20590_a'>
                        <div class='desc_f' >Calprotectin</div>
                    </div>
                    <div class='col_b' style='display: flex; flex-wrap: nowrap;white-space: nowrap;' id='SH_20590_b'>
                        <input required type='number' id='FF_20590' name='FF_20590' value="<?php echo htmlspecialchars($form_data_a[20590] ?? ''); ?>" min='0' max='300' step='1' placeholder=''><select id='FF_20600' name='FF_20600'  onchange='follow_select(this)'><option value=''></option><option value='μg/g' <?php if (($form_data_a[20600] ?? '') == 'μg/g') echo 'selected'; ?>>μg/g</option><option value='mg/kg' <?php if (($form_data_a[20600] ?? '') == 'mg/kg') echo 'selected'; ?>>mg/kg</option></select></div>
					
                    <div class='col_a'  id='SH_20610_a'>
                        <div class='desc_f' >Hämoglobin</div>
                    </div>
                    <div class='col_b' style='display: flex; flex-wrap: nowrap;white-space: nowrap;' id='SH_20610_b'>
                        <input required type='number' id='FF_20610' name='FF_20610' value="<?php echo htmlspecialchars($form_data_a[20610] ?? ''); ?>" min='0' max='30' step='0.1' placeholder=''><select id='FF_20620' name='FF_20620'  onchange='follow_select(this)'><option value=''></option><option value='g/dl' <?php if (($form_data_a[20620] ?? '') == 'g/dl') echo 'selected'; ?>>g/dl</option><option value='g/l' <?php if (($form_data_a[20620] ?? '') == 'g/l') echo 'selected'; ?>>g/l</option><option value='mmol/l' <?php if (($form_data_a[20620] ?? '') == 'mmol/l') echo 'selected'; ?>>mmol/l</option></select></div>
					
                    <div class='col_a' id='SH_20627_a'>
                        <div class='desc_f' >Standlabor (Basiswerte) wurde durchgeführt?</div>
                    </div>
                    <div class='col_b' id='SH_20627_b'  style='text-align:center'>
                        <div id='cbm_20627'>
                            <input data-rcb='20627' required class='sim_hide' type='text' id='FF_20627' name='FF_20627' value="<?php echo $form_data_a[20627] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_20627_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_20627_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
					
                    <div class='col_a' id='SH_20561_a'>
                        <div class='desc_f' >Bakterielle Untersuchung Stuhl durchgeführt und keine Patogene</div>
                    </div>
                    <div class='col_b' id='SH_20561_b'  style='text-align:center'>
                        <div id='cbm_20561'>
                            <input data-rcb='20561' required class='sim_hide' type='text' id='FF_20561' name='FF_20561' value="<?php echo $form_data_a[20561] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_20561_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_20561_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
			</fieldset>
			<fieldset id='FS_'><legend>Medikamentenanamnese</legend>
					
                    <div class='col_a' id='SH_200071_a'>
                        <div class='desc_f' >Glukokortikoide  Prednison/Prednisolon/Budesonid?</div>
                    </div>
                    <div class='col_b' id='SH_200071_b'  style='text-align:center'>
                        <div id='cbm_200071'>
                            <input data-rcb='200071' required class='sim_hide' type='text' id='FF_200071' name='FF_200071' value="<?php echo $form_data_a[200071] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_200071_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_200071_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
			<div class='col_100' ><div id='B_200071_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a' id='SH_200270_a'>
                        <div class='desc_f' style='padding-left:10px;'>➥ Chronisch (Prednison/Prednisolon)</div>
                    </div>
                    <div class='col_b' id='SH_200270_b'  style='text-align:center'>
                        <div id='cbm_200270'>
                            <input data-rcb='200270'  class='sim_hide' type='text' id='FF_200270' name='FF_200270' value="<?php echo $form_data_a[200270] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_200270_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_200270_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
			<div class='col_100' ><div id='B_200270_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a' id='SH_200271_a'>
                        <div class='desc_f' style='padding-left:30px;'> ≥ 20mg ≥ 3 Monate</div>
                    </div>
                    <div class='col_b' id='SH_200271_b'>
                        <select  id='FF_200271' name='FF_200271'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[200271] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[200271] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option><option value='Unbekannt' <?php if (($form_data_a[200271] ?? '') == 'Unbekannt') echo 'selected'; ?>>Unbekannt</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_200372_a'>
                        <div class='desc_f' style='padding-left:30px;'> ≥ 10 mg ≥ 3 Monate</div>
                    </div>
                    <div class='col_b' id='SH_200372_b'>
                        <select  id='FF_200372' name='FF_200372'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[200372] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[200372] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option><option value='Unbekannt' <?php if (($form_data_a[200372] ?? '') == 'Unbekannt') echo 'selected'; ?>>Unbekannt</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_200373_a'>
                        <div class='desc_f' style='padding-left:30px;'> ≥ 5 mg ≥ 3 Monate </div>
                    </div>
                    <div class='col_b' id='SH_200373_b'>
                        <select  id='FF_200373' name='FF_200373'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[200373] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[200373] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option><option value='Unbekannt' <?php if (($form_data_a[200373] ?? '') == 'Unbekannt') echo 'selected'; ?>>Unbekannt</option>
                        </select>
                    </div>
				</div>
			</div></div><!--block-->
				</div>
				<div class='row'>
					
                    <div class='col_a' id='SH_200470_a'>
                        <div class='desc_f' style='padding-left:10px;'>➥ Chronisch (Budesonid)</div>
                    </div>
                    <div class='col_b' id='SH_200470_b'  style='text-align:center'>
                        <div id='cbm_200470'>
                            <input data-rcb='200470'  class='sim_hide' type='text' id='FF_200470' name='FF_200470' value="<?php echo $form_data_a[200470] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_200470_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_200470_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
			<div class='col_100' ><div id='B_200470_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a' id='SH_200471_a'>
                        <div class='desc_f' style='padding-left:30px;'> oral ≥ 6 mg ≥ 3 Monate</div>
                    </div>
                    <div class='col_b' id='SH_200471_b'>
                        <select  id='FF_200471' name='FF_200471'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[200471] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[200471] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option><option value='Unbekannt' <?php if (($form_data_a[200471] ?? '') == 'Unbekannt') echo 'selected'; ?>>Unbekannt</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_200572_a'>
                        <div class='desc_f' style='padding-left:30px;'> rektal ≥ 2 mg ≥ 3 Monate</div>
                    </div>
                    <div class='col_b' id='SH_200572_b'>
                        <select  id='FF_200572' name='FF_200572'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[200572] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[200572] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option><option value='Unbekannt' <?php if (($form_data_a[200572] ?? '') == 'Unbekannt') echo 'selected'; ?>>Unbekannt</option>
                        </select>
                    </div>
				</div>
			</div></div><!--block-->
				</div>
				<div class='row'>
					
                    <div class='col_a' id='SH_200670_a'>
                        <div class='desc_f' style='padding-left:10px;'>➥ Mesalazin - Chronisch (Budesonid)</div>
                    </div>
                    <div class='col_b' id='SH_200670_b'  style='text-align:center'>
                        <div id='cbm_200670'>
                            <input data-rcb='200670'  class='sim_hide' type='text' id='FF_200670' name='FF_200670' value="<?php echo $form_data_a[200670] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_200670_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_200670_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
			<div class='col_100' ><div id='B_200670_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a' id='SH_200671_a'>
                        <div class='desc_f' style='padding-left:30px;'> oral ≥ 2g ≥ 3 Monate</div>
                    </div>
                    <div class='col_b' id='SH_200671_b'>
                        <select  id='FF_200671' name='FF_200671'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[200671] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[200671] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option><option value='Unbekannt' <?php if (($form_data_a[200671] ?? '') == 'Unbekannt') echo 'selected'; ?>>Unbekannt</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_200772_a'>
                        <div class='desc_f' style='padding-left:30px;'>  ≥ 1g ≥ 3 Monate</div>
                    </div>
                    <div class='col_b' id='SH_200772_b'>
                        <select  id='FF_200772' name='FF_200772'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[200772] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[200772] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option><option value='Unbekannt' <?php if (($form_data_a[200772] ?? '') == 'Unbekannt') echo 'selected'; ?>>Unbekannt</option>
                        </select>
                    </div>
				</div>
			</div></div><!--block-->
				</div>
			</div></div><!--block-->
					
                    <div class='col_a' id='SH_201081_a'>
                        <div class='desc_f' >Arzneimittelunverträglichkeiten??</div>
                    </div>
                    <div class='col_b' id='SH_201081_b'>
                        <select required id='FF_201081' name='FF_201081'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[201081] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[201081] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option><option value='Unbekannt' <?php if (($form_data_a[201081] ?? '') == 'Unbekannt') echo 'selected'; ?>>Unbekannt</option>
                        </select>
                    </div>
			<div class='col_100' ><div id='B_201081_Ja' class='block' style='display:none'>
					
                    <div class='col_a' id='SH_201083_a'>
                        <div class='desc_f' style='padding-left:10px;'>➥ Welche:</div>
                    </div>
                    <div class='col_b' id='SH_201083_b'>
                        <input data-fg='10010' required type='text' id='FF_201083' name='FF_201083' value="<?php echo htmlspecialchars($form_data_a[201083] ?? ''); ?>" placeholder='Medikationsangabe'>
                    </div>
			</div></div><!--block-->
			</fieldset>
			<fieldset id='FS_'><legend>Begleiterkrankungen</legend>
					
                    <div class='col_a' id='SH_111200_a'>
                        <div class='desc_f' >Gibt es aktuelle Begleiterkrankungen?</div>
                    </div>
                    <div class='col_b' id='SH_111200_b'  style='text-align:center'>
                        <div id='cbm_111200'>
                            <input data-rcb='111200'  class='sim_hide' type='text' id='FF_111200' name='FF_111200' value="<?php echo $form_data_a[111200] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_111200_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_111200_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
			<div class='col_100' ><div id='B_111200_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a' id='SH_111301_a'>
                        <div class='desc_f' style='padding-left:10px;'>➥ Bitte wählen Sie die Erkrankungen</div>
                    </div>
                    <div class='col_b' id='SH_111301_a'>
                        <select id='mts_111301' name='mts_111301'><option value=''></option><option value='Asthma bronchiale' <?php if (($form_data_a[111301] ?? '') == 'Asthma bronchiale') echo 'selected'; ?>>Asthma bronchiale</option><option value='chronische Lebererkrankung' <?php if (($form_data_a[111301] ?? '') == 'chronische Lebererkrankung') echo 'selected'; ?>>chronische Lebererkrankung</option><option value='chronische Lungenerkrankung' <?php if (($form_data_a[111301] ?? '') == 'chronische Lungenerkrankung') echo 'selected'; ?>>chronische Lungenerkrankung</option><option value='Diabetes mellitus' <?php if (($form_data_a[111301] ?? '') == 'Diabetes mellitus') echo 'selected'; ?>>Diabetes mellitus</option><option value='Entzündungen der Nase und des Rachens (Nasopharyngitis)' <?php if (($form_data_a[111301] ?? '') == 'Entzündungen der Nase und des Rachens (Nasopharyngitis)') echo 'selected'; ?>>Entzündungen der Nase und des Rachens (Nasopharyngitis)</option><option value='Hypertonie' <?php if (($form_data_a[111301] ?? '') == 'Hypertonie') echo 'selected'; ?>>Hypertonie</option><option value='KHK' <?php if (($form_data_a[111301] ?? '') == 'KHK') echo 'selected'; ?>>KHK</option><option value='Lungenentzündung (Pneumonie)' <?php if (($form_data_a[111301] ?? '') == 'Lungenentzündung (Pneumonie)') echo 'selected'; ?>>Lungenentzündung (Pneumonie)</option><option value='Multiple Sklerose' <?php if (($form_data_a[111301] ?? '') == 'Multiple Sklerose') echo 'selected'; ?>>Multiple Sklerose</option><option value='Psoriasis' <?php if (($form_data_a[111301] ?? '') == 'Psoriasis') echo 'selected'; ?>>Psoriasis</option><option value='psychische Erkrankung' <?php if (($form_data_a[111301] ?? '') == 'psychische Erkrankung') echo 'selected'; ?>>psychische Erkrankung</option><option value='rheumatische Erkrankung' <?php if (($form_data_a[111301] ?? '') == 'rheumatische Erkrankung') echo 'selected'; ?>>rheumatische Erkrankung</option><option value='Schilddrüsenerkrankung' <?php if (($form_data_a[111301] ?? '') == 'Schilddrüsenerkrankung') echo 'selected'; ?>>Schilddrüsenerkrankung</option><option value='Z.n. Venenthrombose' <?php if (($form_data_a[111301] ?? '') == 'Z.n. Venenthrombose') echo 'selected'; ?>>Z.n. Venenthrombose</option></select>
                        <input type='hidden' id='FF_111301' name='FF_111301' value="<?php echo htmlspecialchars($form_data_a[111301] ?? ''); ?>"><ul id='chosen_111301' class='cosen_select'></ul>
                        
                    </div>
                    
					
                    <div class='col_a' id='SH_20500_a'>
                        <div class='desc_f' style='padding-left:30px;'> andere Infektion(en), falls nicht in der Liste:</div>
                    </div>
                    <div class='col_b' id='SH_20500_b'>
                        <textarea id='FF_20500' name='FF_20500' rows='3'><?php echo htmlspecialchars($form_data_a[20500] ?? ''); ?></textarea>
                    </div>
					
                    <div class='col_a' id='SH_20520_a'>
                        <div class='desc_f' style='padding-left:30px;'> andere Erkrankung(en), falls nicht in der Liste:</div>
                    </div>
                    <div class='col_b' id='SH_20520_b'>
                        <textarea id='FF_20520' name='FF_20520' rows='3'><?php echo htmlspecialchars($form_data_a[20520] ?? ''); ?></textarea>
                    </div>
				</div>
			</div></div><!--block-->
					<div class='col_100 infotext'  id='SH_9845672'><font style='color:red;font-weight:bold'><center>Wichtig! Wenn Sie eine neue Begleiterkrankung dokumentiert haben, muss eine SAE/AE Meldung durchgeführt werden!</center></font></div>
			</fieldset>
			<fieldset id='FS_444103'><legend>Ultraschall</legend>
					
                    <div class='col_a ' id='SH_201540_a'>
                        <div class='desc_f' >Maximaler Aussendurchmesser</div>
                    </div>
                    <div class='col_b ' id='SH_201540_b'>
                        <input required type='number' id='FF_201540' name='FF_201540' value="<?php echo htmlspecialchars($form_data_a[201540] ?? ''); ?>" min='0' max='1000' step='1' placeholder='in mm'>
                    </div>
					
                    <div class='col_a ' id='SH_201550_a'>
                        <div class='desc_f' >Wanddicke</div>
                    </div>
                    <div class='col_b ' id='SH_201550_b'>
                        <input required type='number' id='FF_201550' name='FF_201550' value="<?php echo htmlspecialchars($form_data_a[201550] ?? ''); ?>" min='0' max='1000' step='1' placeholder='in mm'>
                    </div>
					<div class='col_100 infotext'  id='SH_'><center><b>Hinweis</b>: Entsprechend den Angaben im Flow Chart. Kopie des Originalbefundes in die Dokumentation inkl. der gewünschten Fotos</center></div>
			</fieldset>
			<fieldset id='FS_444104'><legend>Histologie</legend>
					
                    <div class='col_a' id='SH_201976_a'>
                        <div class='desc_f' >Beurteilung Appendix</div>
                    </div>
                    <div class='col_b' id='SH_201976_b'>
                        <select required id='FF_201976' name='FF_201976'  onchange='follow_select(this)'><option value=''></option><option value='Grad I (keine Entzündung)' <?php if (($form_data_a[201976] ?? '') == 'Grad I (keine Entzündung)') echo 'selected'; ?>>Grad I (keine Entzündung)</option><option value='Grad II (moderate Entzündung)' <?php if (($form_data_a[201976] ?? '') == 'Grad II (moderate Entzündung)') echo 'selected'; ?>>Grad II (moderate Entzündung)</option><option value='Grad III (schwere Entzündung/ Komplikationen)' <?php if (($form_data_a[201976] ?? '') == 'Grad III (schwere Entzündung/ Komplikationen)') echo 'selected'; ?>>Grad III (schwere Entzündung/ Komplikationen)</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_201977_a'>
                        <div class='desc_f' >Histologie aus dem Sigma - Beurteilung nach dem Nancy-Index (siehe Histologiebefund)</div>
                    </div>
                    <div class='col_b' id='SH_201977_b'>
                        <select required id='FF_201977' name='FF_201977'  onchange='follow_select(this)'><option value=''></option><option value='1' <?php if (($form_data_a[201977] ?? '') == '1') echo 'selected'; ?>>1</option><option value='2' <?php if (($form_data_a[201977] ?? '') == '2') echo 'selected'; ?>>2</option><option value='3' <?php if (($form_data_a[201977] ?? '') == '3') echo 'selected'; ?>>3</option><option value='4' <?php if (($form_data_a[201977] ?? '') == '4') echo 'selected'; ?>>4</option>
                        </select>
                    </div>
					<div class='col_100 infotext'  id='SH_'><center><b>Hinweis</b>: Kopie des Originalbefundes in die Dokumentation</center></div>
			</fieldset>
			<fieldset id='FS_444100'><legend>MAYO-Score</legend>
					
                    <div class='col_a' id='SH_20116_a'>
                        <div class='desc_f' >Stuhfrequenz pro Tag</div>
                    </div>
                    <div class='col_b' id='SH_20116_b'>
                        <select required id='FF_20116' name='FF_20116'  onchange='follow_select(this)'><option value=''></option><option value='normal' <?php if (($form_data_a[20116] ?? '') == 'normal') echo 'selected'; ?>>normal</option><option value='1-2 Stühle' <?php if (($form_data_a[20116] ?? '') == '1-2 Stühle') echo 'selected'; ?>>1-2 Stühle</option><option value='3-4 Stühle' <?php if (($form_data_a[20116] ?? '') == '3-4 Stühle') echo 'selected'; ?>>3-4 Stühle</option><option value='>5 Stühle' <?php if (($form_data_a[20116] ?? '') == '>5 Stühle') echo 'selected'; ?>>>5 Stühle</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_20117_a'>
                        <div class='desc_f' >Rektaler Blutabgang</div>
                    </div>
                    <div class='col_b' id='SH_20117_b'>
                        <select required id='FF_20117' name='FF_20117'  onchange='follow_select(this)'><option value=''></option><option value='kein Blut' <?php if (($form_data_a[20117] ?? '') == 'kein Blut') echo 'selected'; ?>>kein Blut</option><option value='Blutstreifen bei weniger als 50% der Stühle' <?php if (($form_data_a[20117] ?? '') == 'Blutstreifen bei weniger als 50% der Stühle') echo 'selected'; ?>>Blutstreifen bei weniger als 50% der Stühle</option><option value='Deutliche Blutbeimengung meistens' <?php if (($form_data_a[20117] ?? '') == 'Deutliche Blutbeimengung meistens') echo 'selected'; ?>>Deutliche Blutbeimengung meistens</option><option value='Auch Blut ohne Stuhl' <?php if (($form_data_a[20117] ?? '') == 'Auch Blut ohne Stuhl') echo 'selected'; ?>>Auch Blut ohne Stuhl</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_20118_a'>
                        <div class='desc_f' >Endoskopischer Befund</div>
                    </div>
                    <div class='col_b' id='SH_20118_b'>
                        <select required id='FF_20118' name='FF_20118'  onchange='follow_select(this)'><option value=''></option><option value='normaler Befund oder inaktive Erkrankung' <?php if (($form_data_a[20118] ?? '') == 'normaler Befund oder inaktive Erkrankung') echo 'selected'; ?>>normaler Befund oder inaktive Erkrankung</option><option value='milde Colitis (Erythem, leicht spröde Schleimhaut)' <?php if (($form_data_a[20118] ?? '') == 'milde Colitis (Erythem, leicht spröde Schleimhaut)') echo 'selected'; ?>>milde Colitis (Erythem, leicht spröde Schleimhaut)</option><option value='moderate Colitis (deutliches Erythem, Erosionen, Gefässmuster verschwunden)' <?php if (($form_data_a[20118] ?? '') == 'moderate Colitis (deutliches Erythem, Erosionen, Gefässmuster verschwunden)') echo 'selected'; ?>>moderate Colitis (deutliches Erythem, Erosionen, Gefässmuster verschwunden)</option><option value='schwere Colitis (Ulzerationen, spontane Blutungen)' <?php if (($form_data_a[20118] ?? '') == 'schwere Colitis (Ulzerationen, spontane Blutungen)') echo 'selected'; ?>>schwere Colitis (Ulzerationen, spontane Blutungen)</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_20119_a'>
                        <div class='desc_f' >Globale Beurteilung des Arztes</div>
                    </div>
                    <div class='col_b' id='SH_20119_b'>
                        <select required id='FF_20119' name='FF_20119'  onchange='follow_select(this)'><option value=''></option><option value='normal' <?php if (($form_data_a[20119] ?? '') == 'normal') echo 'selected'; ?>>normal</option><option value='milde Erkrankung' <?php if (($form_data_a[20119] ?? '') == 'milde Erkrankung') echo 'selected'; ?>>milde Erkrankung</option><option value='moderate Erkrankung' <?php if (($form_data_a[20119] ?? '') == 'moderate Erkrankung') echo 'selected'; ?>>moderate Erkrankung</option><option value='schwere Erkrankung' <?php if (($form_data_a[20119] ?? '') == 'schwere Erkrankung') echo 'selected'; ?>>schwere Erkrankung</option>
                        </select>
                    </div>
			</fieldset>
			<fieldset id='FS_444106'><legend>Montreal Klassifikation</legend>
					
                    <div class='col_a' id='SH_20540_a'>
                        <div class='desc_f' >Ausbreitung</div>
                    </div>
                    <div class='col_b' id='SH_20540_b'>
                        <select required id='FF_20540' name='FF_20540'  onchange='follow_select(this)'><option value=''></option><option value='E1 - Ulcerative Proktitis (Befall nur auf das Rektum beschränkt)' <?php if (($form_data_a[20540] ?? '') == 'E1 - Ulcerative Proktitis (Befall nur auf das Rektum beschränkt)') echo 'selected'; ?>>E1 - Ulcerative Proktitis (Befall nur auf das Rektum beschränkt)</option><option value='E2 - Linksseitige Colitis (Befall beschränkt auf den Enddarm bis zum Milzbogen)' <?php if (($form_data_a[20540] ?? '') == 'E2 - Linksseitige Colitis (Befall beschränkt auf den Enddarm bis zum Milzbogen)') echo 'selected'; ?>>E2 - Linksseitige Colitis (Befall beschränkt auf den Enddarm bis zum Milzbogen)</option><option value='E3 - Pankolitis (Beteiligung über den Milzbogen hinaus)' <?php if (($form_data_a[20540] ?? '') == 'E3 - Pankolitis (Beteiligung über den Milzbogen hinaus)') echo 'selected'; ?>>E3 - Pankolitis (Beteiligung über den Milzbogen hinaus)</option>
                        </select>
                    </div>
			</fieldset>
			<fieldset id='FS_444102'><legend>Extraintestinale Manifestation</legend>
					
                    <div class='col_a' id='SH_20650_a'>
                        <div class='desc_f' >Besteht eine extraintestinale Manifestation?</div>
                    </div>
                    <div class='col_b' id='SH_20650_b'>
                        <select required id='FF_20650' name='FF_20650'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[20650] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[20650] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option><option value='Unbekannt' <?php if (($form_data_a[20650] ?? '') == 'Unbekannt') echo 'selected'; ?>>Unbekannt</option>
                        </select>
                    </div>
			<div class='col_100' ><div id='B_20650_Ja' class='block' style='display:none'>
					
                    <div class='col_100' id='SH_20660_b' style='padding-left:40%' >
                        <div id='cbm_20660'>
                            <input data-cb='20660'  class='sim_hide' id='FF_20660' name='FF_20660' value="<?php echo $form_data_a[20660] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_20660' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Gelenkbeteiligung (Arthralgie/Arthritis)</span></label>
                        </div>  
                    </div>
					
                    <div class='col_100' id='SH_20670_b' style='padding-left:40%' >
                        <div id='cbm_20670'>
                            <input data-cb='20670'  class='sim_hide' id='FF_20670' name='FF_20670' value="<?php echo $form_data_a[20670] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_20670' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Augenbeteiligung (Iritis/Uveitis)</span></label>
                        </div>  
                    </div>
					
                    <div class='col_100' id='SH_20680_b' style='padding-left:40%' >
                        <div id='cbm_20680'>
                            <input data-cb='20680'  class='sim_hide' id='FF_20680' name='FF_20680' value="<?php echo $form_data_a[20680] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_20680' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Erythema nodosum</span></label>
                        </div>  
                    </div>
					
                    <div class='col_100' id='SH_20690_b' style='padding-left:40%' >
                        <div id='cbm_20690'>
                            <input data-cb='20690'  class='sim_hide' id='FF_20690' name='FF_20690' value="<?php echo $form_data_a[20690] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_20690' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Pyoderma gangraenosum</span></label>
                        </div>  
                    </div>
			</div></div><!--block-->
			</fieldset>
			<fieldset id='FS_444105'><legend>Short Health Scale (SHS) - Befinden der letzten 7 Tage</legend>
					
                    <div class='col_a' id='SH_116700_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>1.</td><td>Hatten Sie Beschwerden aufgrund Ihrer Darmerkrankung?</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_116700_b'>
                        <input data-fg='10010' required type='text' id='FF_116700' name='FF_116700' value="<?php echo htmlspecialchars($form_data_a[116700] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_116800_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>2.</td><td>Hat sich Ihre Darmerkrankung auf Ihre Fähigkeit ausgewirkt, alles zu schaffen, was Sie im Leben tun mussten oder tun wollten?</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_116800_b'>
                        <input data-fg='10010' required type='text' id='FF_116800' name='FF_116800' value="<?php echo htmlspecialchars($form_data_a[116800] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_116900_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>3.</td><td>Haben Sie sich wegern Ihrer Darmerkrankung Sorgen gemacht? </td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_116900_b'>
                        <input data-fg='10010' required type='text' id='FF_116900' name='FF_116900' value="<?php echo htmlspecialchars($form_data_a[116900] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_117000_a'>
                        <div class='desc_f' ><table class='td_num'><tr><td>4.</td><td>Wie war Ihr allgemeines Wohlbefinden?</td></tr></table></div>
                    </div>
                    <div class='col_b' id='SH_117000_b'>
                        <input data-fg='10010' required type='text' id='FF_117000' name='FF_117000' value="<?php echo htmlspecialchars($form_data_a[117000] ?? ''); ?>" placeholder=''>
                    </div>
			</fieldset>
			<fieldset id='FS_444101'><legend>Anamnestische Angaben</legend>
					
                    <div class='col_a' id='SH_106900_a'>
                        <div class='desc_f' >Wurden Sie wegen Ihrer Erkrankung stationär behandelt</div>
                    </div>
                    <div class='col_b' id='SH_106900_b'>
                        <select required id='FF_106900' name='FF_106900'  onchange='follow_select(this)'><option value=''></option><option value='Nein' <?php if (($form_data_a[106900] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option><option value='Ja, 1 Mal' <?php if (($form_data_a[106900] ?? '') == 'Ja, 1 Mal') echo 'selected'; ?>>Ja, 1 Mal</option><option value='Ja, 2 Mal' <?php if (($form_data_a[106900] ?? '') == 'Ja, 2 Mal') echo 'selected'; ?>>Ja, 2 Mal</option><option value='Ja, 3 Mal' <?php if (($form_data_a[106900] ?? '') == 'Ja, 3 Mal') echo 'selected'; ?>>Ja, 3 Mal</option>
                        </select>
                    </div>
			<div class='col_100' ><div id='B_106900_Ja, 1 Mal Ja, 2 Mal Ja, 3 Mal' class='block' style='display:none'>
				<div class='row'>
					<div class='col_100 infotext' style='text-align:right'>➥ <b>1. Behandlung -------------</b></div>
					<div class='col_b' ><div class='desc_f'></div></div>
					
                    <div class='col_30'>
                        <div style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                            <select id='FF_107100_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                            <select id='FF_107100_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                            <select  id='FF_107100_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                            <input type='text' placeholder='wählen' style='min-width:80px';'  size='12' class='control_input' id='FF_107100' name='FF_107100' value="<?php echo htmlspecialchars($form_data_a[107100] ?? ''); ?>">
                        </div>
                    </div>
                    <script>multi_date('FF_107100','1950','this_year',true,false,'Y(M)','de');</script>
					
                    <div class='col_30'>
                        <div class='desc_f'></div>
                            <select   id='FF_107200' name='FF_107200'  onchange='follow_select(this)'><option value=''>Grund</option><option value='Proctocolectomie (Entfernung des gesamten Dickdarms)' <?php if (($form_data_a[107200] ?? '') == 'Proctocolectomie (Entfernung des gesamten Dickdarms)') echo 'selected'; ?>>Proctocolectomie (Entfernung des gesamten Dickdarms)</option><option value='Partielle Colectomie (Entfernung eines Teils des Dickdarms)' <?php if (($form_data_a[107200] ?? '') == 'Partielle Colectomie (Entfernung eines Teils des Dickdarms)') echo 'selected'; ?>>Partielle Colectomie (Entfernung eines Teils des Dickdarms)</option><option value='Appentektomie (Entfernung des Blinddarms)' <?php if (($form_data_a[107200] ?? '') == 'Appentektomie (Entfernung des Blinddarms)') echo 'selected'; ?>>Appentektomie (Entfernung des Blinddarms)</option><option value='Ständiger Anus präter (künstlicher Darmausgang)' <?php if (($form_data_a[107200] ?? '') == 'Ständiger Anus präter (künstlicher Darmausgang)') echo 'selected'; ?>>Ständiger Anus präter (künstlicher Darmausgang)</option></select>
                        </div>
                    </div>
				</div>
			</div></div><!--block-->
			<div class='col_100' ><div id='B_106900_Ja, 2 Mal Ja, 3 Mal' class='block' style='display:none'>
				<div class='row'>
					<div class='col_100 infotext' style='text-align:right'>➥ <b>2. Behandlung -------------</b></div>
					<div class='col_b' ><div class='desc_f'></div></div>
					
                    <div class='col_30'>
                        <div style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                            <select id='FF_107400_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                            <select id='FF_107400_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                            <select  id='FF_107400_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                            <input type='text' placeholder='wählen' style='min-width:80px';'  size='12' class='control_input' id='FF_107400' name='FF_107400' value="<?php echo htmlspecialchars($form_data_a[107400] ?? ''); ?>">
                        </div>
                    </div>
                    <script>multi_date('FF_107400','1950','this_year',true,false,'Y(M)','de');</script>
					
                    <div class='col_30'>
                        <div class='desc_f'></div>
                            <select   id='FF_107500' name='FF_107500'  onchange='follow_select(this)'><option value=''>Grund</option><option value='Proctocolectomie (Entfernung des gesamten Dickdarms)' <?php if (($form_data_a[107500] ?? '') == 'Proctocolectomie (Entfernung des gesamten Dickdarms)') echo 'selected'; ?>>Proctocolectomie (Entfernung des gesamten Dickdarms)</option><option value='Partielle Colectomie (Entfernung eines Teils des Dickdarms)' <?php if (($form_data_a[107500] ?? '') == 'Partielle Colectomie (Entfernung eines Teils des Dickdarms)') echo 'selected'; ?>>Partielle Colectomie (Entfernung eines Teils des Dickdarms)</option><option value='Appentektomie (Entfernung des Blinddarms)' <?php if (($form_data_a[107500] ?? '') == 'Appentektomie (Entfernung des Blinddarms)') echo 'selected'; ?>>Appentektomie (Entfernung des Blinddarms)</option><option value='Ständiger Anus präter (künstlicher Darmausgang)' <?php if (($form_data_a[107500] ?? '') == 'Ständiger Anus präter (künstlicher Darmausgang)') echo 'selected'; ?>>Ständiger Anus präter (künstlicher Darmausgang)</option></select>
                        </div>
                    </div>
				</div>
			</div></div><!--block-->
			<div class='col_100' ><div id='B_106900_Ja, 3 Mal' class='block' style='display:none'>
				<div class='row'>
					<div class='col_100 infotext' style='text-align:right'>➥ <b>3. Behandlung -------------</b></div>
					<div class='col_b' ><div class='desc_f'></div></div>
					
                    <div class='col_30'>
                        <div style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                            <select id='FF_107700_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                            <select id='FF_107700_month_select' class='hidden' style='max-width:45px;'><option value=''>Monat wählen</option></select>
                            <select  id='FF_107700_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                            <input type='text' placeholder='wählen' style='min-width:80px';'  size='12' class='control_input' id='FF_107700' name='FF_107700' value="<?php echo htmlspecialchars($form_data_a[107700] ?? ''); ?>">
                        </div>
                    </div>
                    <script>multi_date('FF_107700','1950','this_year',true,false,'Y(M)','de');</script>
					
                    <div class='col_30'>
                        <div class='desc_f'></div>
                            <select   id='FF_107800' name='FF_107800'  onchange='follow_select(this)'><option value=''>Grund</option><option value='Proctocolectomie (Entfernung des gesamten Dickdarms)' <?php if (($form_data_a[107800] ?? '') == 'Proctocolectomie (Entfernung des gesamten Dickdarms)') echo 'selected'; ?>>Proctocolectomie (Entfernung des gesamten Dickdarms)</option><option value='Partielle Colectomie (Entfernung eines Teils des Dickdarms)' <?php if (($form_data_a[107800] ?? '') == 'Partielle Colectomie (Entfernung eines Teils des Dickdarms)') echo 'selected'; ?>>Partielle Colectomie (Entfernung eines Teils des Dickdarms)</option><option value='Appentektomie (Entfernung des Blinddarms)' <?php if (($form_data_a[107800] ?? '') == 'Appentektomie (Entfernung des Blinddarms)') echo 'selected'; ?>>Appentektomie (Entfernung des Blinddarms)</option><option value='Ständiger Anus präter (künstlicher Darmausgang)' <?php if (($form_data_a[107800] ?? '') == 'Ständiger Anus präter (künstlicher Darmausgang)') echo 'selected'; ?>>Ständiger Anus präter (künstlicher Darmausgang)</option></select>
                        </div>
                    </div>
				</div>
			</div></div><!--block-->
			</div></div><!--block-->
					
                    <div class='col_a ' id='SH_20210_a'>
                        <div class='desc_f' >Wie viele Tage (ungefähr) waren Sie aufgrund der CU arbeitsunfähig im letzten Jahr?</div>
                    </div>
                    <div class='col_b ' id='SH_20210_b'>
                        <input required type='number' id='FF_20210' name='FF_20210' value="<?php echo htmlspecialchars($form_data_a[20210] ?? ''); ?>" min='0' max='100' step='1' placeholder='Tage'>
                    </div>
					
                    <div class='col_a ' id='SH_20211_a'>
                        <div class='desc_f' >Wie viele Tage waren Sie im Krankenhaus stationär aufgenommen im letzten Jahr?</div>
                    </div>
                    <div class='col_b ' id='SH_20211_b'>
                        <input required type='number' id='FF_20211' name='FF_20211' value="<?php echo htmlspecialchars($form_data_a[20211] ?? ''); ?>" min='0' max='100' step='1' placeholder=''>
                    </div>
			</fieldset>
			<fieldset id='FS_'><legend>Adverse Events / Komplikatonen</legend>
					
                    <div class='col_a' id='SH_203650_a'>
                        <div class='desc_f' >Liegen AE/SAE/ Komplikatonen vor?</div>
                    </div>
                    <div class='col_b' id='SH_203650_b'  style='text-align:center'>
                        <div id='cbm_203650'>
                            <input data-rcb='203650'  class='sim_hide' type='text' id='FF_203650' name='FF_203650' value="<?php echo $form_data_a[203650] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_203650_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_203650_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
			<div class='col_100' ><div id='B_203650_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a' id='SH_203653_a'>
                        <div class='desc_f' style='padding-left:10px;'>➥ Wurde die SAE fristgemäß gemeldet?</div>
                    </div>
                    <div class='col_b' id='SH_203653_b'  style='text-align:center'>
                        <div id='cbm_203653'>
                            <input data-rcb='203653'  class='sim_hide' type='text' id='FF_203653' name='FF_203653' value="<?php echo $form_data_a[203653] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_203653_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_203653_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
					
                    <div class='col_a' id='SH_200360_a'>
                        <div class='desc_f' style='padding-left:30px;'> Wann ist das Ereignis aufgetreten?</div>
                    </div>
                    <div class='col_b' id='SH_200360_b'>
                        <input data-fg='10010'  type='date' id='FF_200360' name='FF_200360' value="<?php echo htmlspecialchars($form_data_a[200360] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_200370_a'>
                        <div class='desc_f' style='padding-left:30px;'> Steht das Ereignis in Verbindung mit der Studientherapie</div>
                    </div>
                    <div class='col_b' id='SH_200370_b'>
                        <select  id='FF_200370' name='FF_200370'  onchange='follow_select(this)'><option value=''></option><option value='Ja' <?php if (($form_data_a[200370] ?? '') == 'Ja') echo 'selected'; ?>>Ja</option><option value='Nein' <?php if (($form_data_a[200370] ?? '') == 'Nein') echo 'selected'; ?>>Nein</option><option value='Unbekannt' <?php if (($form_data_a[200370] ?? '') == 'Unbekannt') echo 'selected'; ?>>Unbekannt</option>
                        </select>
                    </div>
				</div>
					
                    <div class='col_a' id='SH_200380_a'>
                        <div class='desc_f' style='padding-left:30px;'> Darstellung des Ereignisses:</div>
                    </div>
                    <div class='col_b' id='SH_200380_b'>
                        <textarea id='FF_200380' name='FF_200380' rows='5'><?php echo htmlspecialchars($form_data_a[200380] ?? ''); ?></textarea>
                    </div>
			</div></div><!--block-->
			</fieldset>
			<fieldset id='FS_'><legend>Vorzeitiger Abbruch</legend>
					
                    <div class='col_a' id='SH_207652_a'>
                        <div class='desc_f' >Es erfolgte ein vorzeitiger Abbruch?</div>
                    </div>
                    <div class='col_b' id='SH_207652_b'  style='text-align:center'>
                        <div id='cbm_207652'>
                            <input data-rcb='207652'  class='sim_hide' type='text' id='FF_207652' name='FF_207652' value="<?php echo $form_data_a[207652] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_207652_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_207652_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
			<div class='col_100' ><div id='B_207652_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a' id='SH_207653_a'>
                        <div class='desc_f' >Abbruchdatum</div>
                    </div>
                    <div class='col_b' id='SH_207653_b'>
                        <input data-fg='10010' required type='date' id='FF_207653' name='FF_207653' value="<?php echo htmlspecialchars($form_data_a[207653] ?? ''); ?>" placeholder=''>
                    </div>
				</div>
			</div></div><!--block-->
			</fieldset></creator>
                </form>
            </td>
            <td id='<?php echo $fg ?>_td_sidebar' valign='top'></td>
        </tr>
    </table>
    <?php
    require_once MIQ_ROOT . "/modules/form_base/form_end.php";
    $file_add_end = str_replace(".php", "_add_end.php", "./" . basename(__FILE__));
    if (file_exists($file_add_end)) include_once($file_add_end);
    ?>
    <script>
        // eL_check_numbers();
        // let winbox_id = parent.window.thisbox_elem.id;
        if (window.opener);
        else try {
            parent.document.getElementById('<?php echo $opener_num ?>_reload').click()
        } catch (e) {};
        get_field_ids('<?php echo MIQ_PATH ?>/modules/form_base/');
        // eL_uploads();
        // eL_upload_info_button();
        // eL_input_change();
        // eL_radio_uncheck();
        // eL_form_submit();
    </script>



    <div id='lock-layer' class='lock-layer-hidden'></div>
</body>

</html>