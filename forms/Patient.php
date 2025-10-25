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
					
                    <div class='col_a' id='SH_101_a'>
                        <div class='desc_f' >created</div>
                    </div>
                    <div class='col_b' id='SH_101_b'>
                        <input data-fg='10003'  type='text' id='FF_101' name='FF_101' value="<?php echo htmlspecialchars($form_data_a[101] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_102_a'>
                        <div class='desc_f' >oldpid</div>
                    </div>
                    <div class='col_b' id='SH_102_b'>
                        <input data-fg='10003'  type='text' id='FF_102' name='FF_102' value="<?php echo htmlspecialchars($form_data_a[102] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_97_a'>
                        <div class='desc_f' >Groesse</div>
                    </div>
                    <div class='col_b' id='SH_97_b'>
                        <input data-fg='10003'  type='text' id='FF_97' name='FF_97' value="<?php echo htmlspecialchars($form_data_a[97] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_100_a'>
                        <div class='desc_f' >E</div>
                    </div>
                    <div class='col_b' id='SH_100_b'>
                        <input data-fg='10003'  type='text' id='FF_100' name='FF_100' value="<?php echo htmlspecialchars($form_data_a[100] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_10005020_a'>
                        <div class='desc_f' ></div>
                    </div>
                    <div class='col_b' id='SH_10005020_b'>
                        <input data-fg='10003'  type='text' id='FF_10005020' name='FF_10005020' value="<?php echo htmlspecialchars($form_data_a[10005020] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_33_a'>
                        <div class='desc_f' >patient_zuletzt_informiert</div>
                    </div>
                    <div class='col_b' id='SH_33_b'>
                        <input data-fg='10003'  type='text' id='FF_33' name='FF_33' value="<?php echo htmlspecialchars($form_data_a[33] ?? ''); ?>" placeholder=''>
                    </div>
				</div>

                        <span id='FS_199920'>
			<fieldset id='FS_99921'><legend>Stammdaten</legend>
					
                    <div class='col_30'>
                        <div class='desc_f'>Patienten-Nummer</div>
                            <input required type='text' id='FF_91' name='FF_91' value="<?php echo htmlspecialchars($form_data_a[91] ?? ''); ?>" placeholder=''>
                        </div>
                    </div>
					
                    <div class='col_30'>
                        <div class='desc_f'>Zentrum/Abteilung</div>
                            <input  type='text' id='FF_10003046' name='FF_10003046' value="<?php echo htmlspecialchars($form_data_a[10003046] ?? ''); ?>" placeholder=''>
                        </div>
                    </div>
					
                    <div class='col_30'>
                        <div class='desc_f'>Dokumentationsstart</div>
                            <input  type='date' id='FF_10003045' name='FF_10003045' value="<?php echo htmlspecialchars($form_data_a[10003045] ?? ''); ?>" placeholder=''>
                        </div>
                    </div>
					<div class='col_30'><div class='desc_f'>Alter bei Einschluss</div><input required type='number' id='FF_10003020' name='FF_10003020' value="<?php echo htmlspecialchars($form_data_a[10003020] ?? ''); ?>" min='18' max='110' step='1' placeholder=''></div>
					
                    <div class='col_30'>
                        <div class='desc_f'>Geschlecht</div>
                            <select required  id='FF_96' name='FF_96'  onchange='follow_select(this)'><option value=''></option><option value='weiblich' <?php if (($form_data_a[96] ?? '') == 'weiblich') echo 'selected'; ?>>weiblich</option><option value='männlich' <?php if (($form_data_a[96] ?? '') == 'männlich') echo 'selected'; ?>>männlich</option><option value='divers' <?php if (($form_data_a[96] ?? '') == 'divers') echo 'selected'; ?>>divers</option></select>
                        </div>
                    </div>
					
                    <div class='col_30'>
                        <div class='desc_f'>Ethnische Zugehörigkeit</div>
                            <select   id='FF_202101' name='FF_202101'  onchange='follow_select(this)'><option value=''></option><option value='Europäisch/ Kaukasisch' <?php if (($form_data_a[202101] ?? '') == 'Europäisch/ Kaukasisch') echo 'selected'; ?>>Europäisch/ Kaukasisch</option><option value='Afrikanisch' <?php if (($form_data_a[202101] ?? '') == 'Afrikanisch') echo 'selected'; ?>>Afrikanisch</option><option value='Asiatisch' <?php if (($form_data_a[202101] ?? '') == 'Asiatisch') echo 'selected'; ?>>Asiatisch</option><option value='Hispanisch' <?php if (($form_data_a[202101] ?? '') == 'Hispanisch') echo 'selected'; ?>>Hispanisch</option><option value='Indigen' <?php if (($form_data_a[202101] ?? '') == 'Indigen') echo 'selected'; ?>>Indigen</option><option value='Nahost/ Nordafrikanisch' <?php if (($form_data_a[202101] ?? '') == 'Nahost/ Nordafrikanisch') echo 'selected'; ?>>Nahost/ Nordafrikanisch</option><option value='Gemischt/ Sonstige' <?php if (($form_data_a[202101] ?? '') == 'Gemischt/ Sonstige') echo 'selected'; ?>>Gemischt/ Sonstige</option></select>
                        </div>
                    </div>
					
                    <div class='col_30'>
                        <div class='desc_f'>Studien-Nr. /Pseudonym</div>
                            <input required type='text' id='FF_92' name='FF_92' value="<?php echo htmlspecialchars($form_data_a[92] ?? ''); ?>" placeholder=''>
                        </div>
                    </div>
					<div class='col_60'  id='SH_99467'><div class='desc_f'><strong><font style='color:red'>Achtung: Bitte kontaktieren Sie die Study Nurse zum Erhalt der Studien-Nr.: </font></strong><button id='study_nurse' class='aref_button_light'>Kontakt anzeigen</button> <button id='study_nurse_email' class='aref_button_light'>E-Mail schreiben</button></div></div>
			</fieldset>
					<div class='col_100 infotext'  id='SH_199900'><span style='display: grid; grid-template-columns: 1fr 1fr; gap: 10px; width: 100%;'><button id='ein_button' class='aref_button_light'>Einschlusskriterien ein-/ ausblenden</button> <button id='aus_button' class='aref_button_light'>Ausschlusskriterien ein-/ ausblenden</button></span></div>
			<fieldset id='FS_199922'><legend>Einschlusskriterien</legend>
					
                    <div class='col_a' id='SH_10003101_a'>
                        <div class='desc_f' >Alter ≥ 18 Jahre</div>
                    </div>
                    <div class='col_b' id='SH_10003101_b'  style='text-align:center'>
                        <div id='cbm_10003101'>
                            <input data-rcb='10003101' required class='sim_hide' type='text' id='FF_10003101' name='FF_10003101' value="<?php echo $form_data_a[10003101] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_10003101_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_10003101_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
					
                    <div class='col_a' id='SH_10003102_a'>
                        <div class='desc_f' >Innerhalb von 4 Wochen vorliegende vollständige Koloskopie, makroskopisch und histologisch mit Nachweis einer moderat aktiven Colitis ulcerosa  (unabhängig vom Befallsmuster)</div>
                    </div>
                    <div class='col_b' id='SH_10003102_b'  style='text-align:center'>
                        <div id='cbm_10003102'>
                            <input data-rcb='10003102' required class='sim_hide' type='text' id='FF_10003102' name='FF_10003102' value="<?php echo $form_data_a[10003102] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_10003102_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_10003102_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
					
                    <div class='col_a' id='SH_10003103_a'>
                        <div class='desc_f' >MAYO-Score zwischen  ≥6 und ≤10</div>
                    </div>
                    <div class='col_b' id='SH_10003103_b'  style='text-align:center'>
                        <div id='cbm_10003103'>
                            <input data-rcb='10003103' required class='sim_hide' type='text' id='FF_10003103' name='FF_10003103' value="<?php echo $form_data_a[10003103] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_10003103_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_10003103_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
					
                    <div class='col_a' id='SH_10003104_a'>
                        <div class='desc_f' >Klinische Refraktärität gegenüber einer mindestens 4-wöchigen Therapie mit Mesalazin (> 2g/d) und/oder Kortikosteroiden (Prednison > 10mg/d, Budesonid >9mg/d</div>
                    </div>
                    <div class='col_b' id='SH_10003104_b'  style='text-align:center'>
                        <div id='cbm_10003104'>
                            <input data-rcb='10003104' required class='sim_hide' type='text' id='FF_10003104' name='FF_10003104' value="<?php echo $form_data_a[10003104] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_10003104_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_10003104_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
					
                    <div class='col_a' id='SH_10003105_a'>
                        <div class='desc_f' >Entscheidung des behandelnden Arztes zu einer Therapieeskalation mit „advanced“ Therapie</div>
                    </div>
                    <div class='col_b' id='SH_10003105_b'  style='text-align:center'>
                        <div id='cbm_10003105'>
                            <input data-rcb='10003105' required class='sim_hide' type='text' id='FF_10003105' name='FF_10003105' value="<?php echo $form_data_a[10003105] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_10003105_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_10003105_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
					
                    <div class='col_a' id='SH_10003106_a'>
                        <div class='desc_f' >Negative Stuhlkultur einschließlich C. difficile</div>
                    </div>
                    <div class='col_b' id='SH_10003106_b'  style='text-align:center'>
                        <div id='cbm_10003106'>
                            <input data-rcb='10003106' required class='sim_hide' type='text' id='FF_10003106' name='FF_10003106' value="<?php echo $form_data_a[10003106] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_10003106_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_10003106_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
					
                    <div class='col_a' id='SH_10003107_a'>
                        <div class='desc_f' >Negativer Nachweis von CMV (Histologie)</div>
                    </div>
                    <div class='col_b' id='SH_10003107_b'  style='text-align:center'>
                        <div id='cbm_10003107'>
                            <input data-rcb='10003107' required class='sim_hide' type='text' id='FF_10003107' name='FF_10003107' value="<?php echo $form_data_a[10003107] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_10003107_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_10003107_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
					
                    <div class='col_a' id='SH_10003108_a'>
                        <div class='desc_f' >Patient hat die „Informationen für Patienten“ unterschrieben und erhalten</div>
                    </div>
                    <div class='col_b' id='SH_10003108_b'  style='text-align:center'>
                        <div id='cbm_10003108'>
                            <input data-rcb='10003108' required class='sim_hide' type='text' id='FF_10003108' name='FF_10003108' value="<?php echo $form_data_a[10003108] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_10003108_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_10003108_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
			</fieldset>
			<fieldset id='FS_199923'><legend>Ausschlusskriterien</legend>
					
                    <div class='col_a' id='SH_10003201_a'>
                        <div class='desc_f' >Appendektomie in der Anamnese</div>
                    </div>
                    <div class='col_b' id='SH_10003201_b'  style='text-align:center'>
                        <div id='cbm_10003201'>
                            <input data-rcb='10003201' required class='sim_hide' type='text' id='FF_10003201' name='FF_10003201' value="<?php echo $form_data_a[10003201] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_10003201_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_10003201_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
					
                    <div class='col_a' id='SH_10003202_a'>
                        <div class='desc_f' >Morbus Crohn</div>
                    </div>
                    <div class='col_b' id='SH_10003202_b'  style='text-align:center'>
                        <div id='cbm_10003202'>
                            <input data-rcb='10003202' required class='sim_hide' type='text' id='FF_10003202' name='FF_10003202' value="<?php echo $form_data_a[10003202] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_10003202_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_10003202_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
					
                    <div class='col_a' id='SH_10003203_a'>
                        <div class='desc_f' >Immunsuppression in der Anamnese bis 4 Wochen vor Studienbeginn oder laufend (außer Glukokortikosteroide)</div>
                    </div>
                    <div class='col_b' id='SH_10003203_b'  style='text-align:center'>
                        <div id='cbm_10003203'>
                            <input data-rcb='10003203' required class='sim_hide' type='text' id='FF_10003203' name='FF_10003203' value="<?php echo $form_data_a[10003203] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_10003203_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_10003203_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
					
                    <div class='col_a' id='SH_10003204_a'>
                        <div class='desc_f' >Größere abdominelle Operationen, die eine einfache Appendektomie behindern oder ein Risiko darstellen</div>
                    </div>
                    <div class='col_b' id='SH_10003204_b'  style='text-align:center'>
                        <div id='cbm_10003204'>
                            <input data-rcb='10003204' required class='sim_hide' type='text' id='FF_10003204' name='FF_10003204' value="<?php echo $form_data_a[10003204] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_10003204_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_10003204_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
					
                    <div class='col_a' id='SH_10003205_a'>
                        <div class='desc_f' >Schwere (toxische) Colitis ulcerosa, die eine Notfallkolektomie wahrscheinlich machen</div>
                    </div>
                    <div class='col_b' id='SH_10003205_b'  style='text-align:center'>
                        <div id='cbm_10003205'>
                            <input data-rcb='10003205' required class='sim_hide' type='text' id='FF_10003205' name='FF_10003205' value="<?php echo $form_data_a[10003205] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_10003205_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_10003205_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
					
                    <div class='col_a' id='SH_10003206_a'>
                        <div class='desc_f' >Kontraindikationen für Vedolizumab (s. wiss. Informationen)</div>
                    </div>
                    <div class='col_b' id='SH_10003206_b'  style='text-align:center'>
                        <div id='cbm_10003206'>
                            <input data-rcb='10003206' required class='sim_hide' type='text' id='FF_10003206' name='FF_10003206' value="<?php echo $form_data_a[10003206] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_10003206_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_10003206_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
					
                    <div class='col_a' id='SH_10003207_a'>
                        <div class='desc_f' >Dominant-symptomatische extraintestinale Manifestationen</div>
                    </div>
                    <div class='col_b' id='SH_10003207_b'  style='text-align:center'>
                        <div id='cbm_10003207'>
                            <input data-rcb='10003207' required class='sim_hide' type='text' id='FF_10003207' name='FF_10003207' value="<?php echo $form_data_a[10003207] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_10003207_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_10003207_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
					
                    <div class='col_a' id='SH_10003208_a'>
                        <div class='desc_f' >Schwere (behandlungsbedürftige) Komorbidität an Nieren, Leber, Lunge, Herz, oder anderen Organsystemen</div>
                    </div>
                    <div class='col_b' id='SH_10003208_b'  style='text-align:center'>
                        <div id='cbm_10003208'>
                            <input data-rcb='10003208' required class='sim_hide' type='text' id='FF_10003208' name='FF_10003208' value="<?php echo $form_data_a[10003208] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_10003208_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_10003208_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
					
                    <div class='col_a' id='SH_10003209_a'>
                        <div class='desc_f' >Aktive (behandlungsbedürftige) Krebserkrankung</div>
                    </div>
                    <div class='col_b' id='SH_10003209_b'  style='text-align:center'>
                        <div id='cbm_10003209'>
                            <input data-rcb='10003209' required class='sim_hide' type='text' id='FF_10003209' name='FF_10003209' value="<?php echo $form_data_a[10003209] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_10003209_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_10003209_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
					
                    <div class='col_a' id='SH_10003210_a'>
                        <div class='desc_f' >Schwangerschaft</div>
                    </div>
                    <div class='col_b' id='SH_10003210_b'  style='text-align:center'>
                        <div id='cbm_10003210'>
                            <input data-rcb='10003210' required class='sim_hide' type='text' id='FF_10003210' name='FF_10003210' value="<?php echo $form_data_a[10003210] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_10003210_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_10003210_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
					
                    <div class='col_a' id='SH_10003211_a'>
                        <div class='desc_f' >Fehlende oder nicht verstandene Einverständnis/Patienteninformation</div>
                    </div>
                    <div class='col_b' id='SH_10003211_b'  style='text-align:center'>
                        <div id='cbm_10003211'>
                            <input data-rcb='10003211' required class='sim_hide' type='text' id='FF_10003211' name='FF_10003211' value="<?php echo $form_data_a[10003211] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_10003211_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_10003211_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
			</fieldset>
			<fieldset id='FS_99911'><legend>Therapie</legend>
					
                    <div class='col_60' id='SH_10020001_b'>
                        <div id='cbm_10020001'>
                            <input data-cb='10020001'  class='sim_hide' id='FF_10020001' name='FF_10020001' value="<?php echo $form_data_a[10020001] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_10020001' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Konservativ einschließlich Vedolizumab</span></label>
                        </div>  
                    </div>
					
                    <div class='col_30'>
                        <div class='desc_f'>Erste Verabreichung von Vedolizumab</div>
                            <input  type='date' id='FF_10003047' name='FF_10003047' value="<?php echo htmlspecialchars($form_data_a[10003047] ?? ''); ?>" placeholder=''>
                        </div>
                    </div>
					
                    <div class='col_60' id='SH_10020002_b'>
                        <div id='cbm_10020002'>
                            <input data-cb='10020002'  class='sim_hide' id='FF_10020002' name='FF_10020002' value="<?php echo $form_data_a[10020002] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_10020002' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Operativ / Appendektomie</span></label>
                        </div>  
                    </div>
					
                    <div class='col_30'>
                        <div class='desc_f'>Operationstermin</div>
                            <input  type='date' id='FF_10003048' name='FF_10003048' value="<?php echo htmlspecialchars($form_data_a[10003048] ?? ''); ?>" placeholder=''>
                        </div>
                    </div>
					<div class='col_100 infotext'  id='SH_'><center><u>Hinweis:</u> Die Therapie der letzten Woche bleibt, wenn gewünscht, unverändert bestehen</center></div>
			</fieldset>
			<fieldset id='FS_99912'><legend>Demographie</legend>
					
                    <div class='col_a' id='SH_102600_a'>
                        <div class='desc_f' >Größe (in cm):</div>
                    </div>
                    <div class='col_b' id='SH_102600_b'>
                        <input data-fg='10003' required type='text' id='FF_102600' name='FF_102600' value="<?php echo htmlspecialchars($form_data_a[102600] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_102700_a'>
                        <div class='desc_f' >Gewicht (in kg):</div>
                    </div>
                    <div class='col_b' id='SH_102700_b'>
                        <input data-fg='10003' required type='text' id='FF_102700' name='FF_102700' value="<?php echo htmlspecialchars($form_data_a[102700] ?? ''); ?>" placeholder=''>
                    </div>
					
                    <div class='col_a' id='SH_102705_a'>
                        <div class='desc_f' style='padding-left:10px;'>➥ BMI</div>
                    </div>
                    <div class='col_b' id='SH_102705_b'  style='display: flex; flex-wrap: nowrap;white-space: nowrap;'>
                        <input data-fg='10003'  type='text' id='FF_102705' name='FF_102705' value="<?php echo htmlspecialchars($form_data_a[102705] ?? ''); ?>" placeholder='Automatikfeld'><span id='span_102705'></span>
                    </div>
					
                    <div class='col_a' id='SH_102800_a'>
                        <div class='desc_f' >Raucher:</div>
                    </div>
                    <div class='col_b' id='SH_102800_b'  style='text-align:center'>
                        <div id='cbm_102800'>
                            <input data-rcb='102800' required class='sim_hide' type='text' id='FF_102800' name='FF_102800' value="<?php echo $form_data_a[102800] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_102800_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_102800_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
					
                    <div class='col_a' id='SH_102805_a'>
                        <div class='desc_f' >Ex-Raucher:</div>
                    </div>
                    <div class='col_b' id='SH_102805_b'  style='text-align:center'>
                        <div id='cbm_102805'>
                            <input data-rcb='102805' required class='sim_hide' type='text' id='FF_102805' name='FF_102805' value="<?php echo $form_data_a[102805] ?? ''; ?>"  onchange='follow_select(this)'>
                            <label class='custom-checkbox-wrapper'><span id='CB_102805_Ja' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Ja</span></label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <label class='custom-checkbox-wrapper'><span id='CB_102805_Nein' class='custom-checkbox'></span> <span class='custom-checkbox-label'>Nein</span></label>
                        </div>
                    </div>
			<div class='col_100' ><div id='B_102805_Ja' class='block' style='display:none'>
				<div class='row'>
					
                    <div class='col_a' id='SH_102801_a'>
                        <div class='desc_f' style='padding-left:10px;'>➥ Seit wann sind Sie Nichtraucher?</div>
                    </div>
                    <div class='col_b' style='display: flex; flex-wrap: nowrap; white-space: nowrap;justify-content: flex-end;' id='SH_102801_b'>
                        <select id='FF_102801_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_102801_month_select' class='hidden' style='max-width:62px;'><option value=''>Monat wählen</option></select>
                        <select required id='FF_102801_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='hidden' placeholder='wählen' style='min-width:80px';' required size='9' class='control_input' id='FF_102801' name='FF_102801' value="<?php echo htmlspecialchars($form_data_a[102801] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_102801','1960','this_year',true,false,'Y(M)','de');</script>
				</div>
			</div></div><!--block-->
					
                    <div class='col_a' id='SH_20100_a'>
                        <div class='desc_f' >Aktuelle Lebenssituation:</div>
                    </div>
                    <div class='col_b' id='SH_20100_b'>
                        <select required id='FF_20100' name='FF_20100'  onchange='follow_select(this)'><option value=''></option><option value='Berentung' <?php if (($form_data_a[20100] ?? '') == 'Berentung') echo 'selected'; ?>>Berentung</option><option value='Schüler/ Student/ Ausbildung/ FSJ/FÖJ' <?php if (($form_data_a[20100] ?? '') == 'Schüler/ Student/ Ausbildung/ FSJ/FÖJ') echo 'selected'; ?>>Schüler/ Student/ Ausbildung/ FSJ/FÖJ</option><option value='Hausfrau/-mann/ Mutterschutz/ Elternzeit' <?php if (($form_data_a[20100] ?? '') == 'Hausfrau/-mann/ Mutterschutz/ Elternzeit') echo 'selected'; ?>>Hausfrau/-mann/ Mutterschutz/ Elternzeit</option><option value='in bezahlter Arbeit (Vollzeit)' <?php if (($form_data_a[20100] ?? '') == 'in bezahlter Arbeit (Vollzeit)') echo 'selected'; ?>>in bezahlter Arbeit (Vollzeit)</option><option value='in bezahlter Arbeit (Teilzeit)' <?php if (($form_data_a[20100] ?? '') == 'in bezahlter Arbeit (Teilzeit)') echo 'selected'; ?>>in bezahlter Arbeit (Teilzeit)</option><option value='erwerbslos' <?php if (($form_data_a[20100] ?? '') == 'erwerbslos') echo 'selected'; ?>>erwerbslos</option><option value='Frührente' <?php if (($form_data_a[20100] ?? '') == 'Frührente') echo 'selected'; ?>>Frührente</option><option value='keine Angabe' <?php if (($form_data_a[20100] ?? '') == 'keine Angabe') echo 'selected'; ?>>keine Angabe</option>
                        </select>
                    </div>
					
                    <div class='col_a' id='SH_102200_a'>
                        <div class='desc_f' >Datum der Erstdiagnose</div>
                    </div>
                    <div class='col_b' style='display: flex; flex-wrap: nowrap; white-space: nowrap;justify-content: flex-end;' id='SH_102200_b'>
                        <select id='FF_102200_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_102200_month_select' class='hidden' style='max-width:62px;'><option value=''>Monat wählen</option></select>
                        <select required id='FF_102200_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='hidden' placeholder='wählen' style='min-width:80px';' required size='9' class='control_input' id='FF_102200' name='FF_102200' value="<?php echo htmlspecialchars($form_data_a[102200] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_102200','1960','this_year',true,false,'Y(M)','de');</script>
					
                    <div class='col_a' id='SH_102300_a'>
                        <div class='desc_f' >Erste Symptome Ihrer Erkrankung?</div>
                    </div>
                    <div class='col_b' style='display: flex; flex-wrap: nowrap; white-space: nowrap;justify-content: flex-end;' id='SH_102300_b'>
                        <select id='FF_102300_day_select' class='hidden' style='max-width:45px;'><option value=''>Tag wählen</option></select>
                        <select id='FF_102300_month_select' class='hidden' style='max-width:62px;'><option value=''>Monat wählen</option></select>
                        <select required id='FF_102300_year_select' style='max-width:60px;'><option value=''>Jahr wählen</option></select>
                        <input type='hidden' placeholder='wählen' style='min-width:80px';' required size='9' class='control_input' id='FF_102300' name='FF_102300' value="<?php echo htmlspecialchars($form_data_a[102300] ?? ''); ?>">
                    </div>
                    <script>multi_date('FF_102300','1960','this_year',true,false,'Y(M)','de');</script>
			</fieldset>

                        </span>
			<fieldset id='FS_99922'><legend></legend>
					<div class='col_100' id='idonly_10003050'></div>
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