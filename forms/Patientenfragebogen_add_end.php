<script src="<?php echo $_SESSION['WEBROOT'] . $_SESSION['PROJECT_PATH'] ?>forms/Patientenfragebogen.js?RAND=<?php echo random_bytes(5); ?>"></script>
<script>
    // console.log('S--------------')

    activate_multi_selects();

    // some design-fixings
    // document.querySelectorAll('.col_a').forEach(el => {
    //     el.style.borderBottom = "1px solid #ccc";
    //     el.style.paddingTop = "5px";
    // });

    // document.getElementById('B_106900_Ja, 3 Mal').style.paddingLeft = "30px";

    const OP_1 = document.getElementById('B_106900_Ja, 1 Mal Ja, 2 Mal Ja, 3 Mal');
    if (OP_1) {
        OP_1.style.float = 'right';
    }
    const OP_2 = document.getElementById('B_106900_Ja, 2 Mal Ja, 3 Mal');
    if (OP_2) {
        OP_2.style.float = 'right';
    }
    const OP_3 = document.getElementById('B_106900_Ja, 3 Mal');
    if (OP_3) {
        OP_3.style.float = 'right';
    }
    const SAE_textarea = document.getElementById('FF_200380');
    if (SAE_textarea) {
        SAE_textarea.style.height = '50px';
        SAE_textarea.style.marginLeft = "30px";
        SAE_textarea.style.width = SAE_textarea.offsetWidth - 30;
    }

    
    field_in_group_validation('20115', ['Ja'], ['20560'], 'one'); // Klinische Vorstellung
    
    field_in_group_validation('200270', ['Ja'], ['200271', '200272', '200273'], 'one'); // Chronisch (Prednison/Prednisolon)
    field_in_group_validation('200470', ['Ja'], ['200471', '200472'], 'one'); // Chronisch (Budesonid)
    field_in_group_validation('200670', ['Ja'], ['200671', '200672'], 'one'); // Mesalazin - Chronisch (Budesonid)
    field_in_group_validation('111200', ['Ja'], ['111301', '20500', '20520'], 'one'); // Begleiterkrankungen
    field_in_group_validation('203650', ['Ja'], ['203653', '200360', '200370', '200380'], 'all'); // SAE
    field_in_group_validation('207652', ['Ja'], ['207653'], 'one'); // SAE
    field_in_group_validation('201081', ['Ja'], ['201083'], 'one'); // Arzneimittelunverträglichkeiten

    field_in_group_validation('20650', ['Ja'], ['20660', '20670', '20680', '20690'], 'one');

    // Plausibilisation
    function extra_plaus(user_is_patient, visite_week) {

        function op(ids) {
            const op_field = document.getElementById('FF_106900');
            const num = op_field.value.split(' ')[0];
            const y = {};
            const m = {};
            for (let i = 1; i <= num; i++) {
                if (year) {
                    y[i] = document.getElementById(year[i].id + '_year_select');
                    m[i] = document.getElementById(year[i].id + '_month_select');
                    if (year[i].value == '') {
                        year[i].style.backgroundColor = '#fdd6d6';
                        if (y[i]) y[i].style.backgroundColor = '#fdd6d6';
                        if (m[i]) m[i].style.backgroundColor = '#fdd6d6';
                        error_a[year[i].id] = 1;
                    } else {
                        year[i].style.backgroundColor = '';
                        if (y[i]) y[i].style.backgroundColor = '';
                        if (m[i]) m[i].style.backgroundColor = '';
                        error_a[year[i].id] = 0;
                    }
                }
            }
            if (!user_is_patient) {
                for (let i = 1; i <= num; i++) {
                    if (year[i]) {
                        if (year[i].value != '') {
                            if (art[i]) {
                                if (art[i].value === '') {
                                    art[i].style.backgroundColor = '#fdd6d6';
                                    error_a[art[i].id] = 1;
                                } else {
                                    art[i].style.backgroundColor = '';
                                    error_a[art[i].id] = 0;
                                }
                            }
                        } else {
                            art[i].style.backgroundColor = '';
                            error_a[art[i].id] = 0;
                        }
                    }
                }
            }
            errors = error_a_sum(error_a);
            if (errors) set_message(errors);
        }

        function check_off_work() {
            if (job && off_work) {
                if (job.value === 'Angestellt tätig' && off_work.value == '') {
                    off_work_marker.style.backgroundColor = '#fdd6d6';
                    error_a['FF_106200'] = 1;
                } else {
                    off_work_marker.style.backgroundColor = '';
                    error_a['FF_106200'] = 0;
                }
            }
        }


    }

    var error_premed = 0;
    let param_a = {};


    param_a['sqlstr'] = <?php echo json_encode("F_{$_SESSION['param']['pid']} = '{$form_data_a[$_SESSION['param']['pid']]}'"); ?>;
    param_a['pid'] = <?php echo json_encode($form_data_a[$_SESSION['param']['pid']] ?? ""); ?>;
    param_a['praxis_pid'] = <?php echo json_encode($form_data_a[$_SESSION['param']['praxis_pid']] ?? ""); ?>;
    param_a['ext_fcid'] = <?php echo json_encode($form_data_a[$_SESSION['param']['ext_fcid']] ?? ""); ?>;
    param_a['geschlecht'] = <?php echo json_encode($form_data_a[$_SESSION['param']['geschlecht']] ?? ""); ?>;
    param_a['therapy'] = <?php echo json_encode($form_data_a[$_SESSION['param']['therapy']] ?? ""); ?>;
    param_a['visite_week'] = <?php echo json_encode($form_data_a[$_SESSION['param']['visite_week']] ?? ""); ?>;
    param_a['visite'] = <?php echo json_encode($form_data_a[$_SESSION['param']['visite']] ?? ""); ?>;
    param_a['visite_datum'] = <?php echo json_encode($form_data_a[10005020] ?? ""); ?>;
    const param_str = JSON.stringify(param_a);




    // basic vars 
    // const status = <?php echo json_encode($status) ?>;
    // const pre_visite = <?php echo json_encode($pre_visite ?? "") ?>;
    // const pre_data_json_str = <?php echo json_encode($pre_data_json ?? "") ?>;

    const postetd = <?php echo json_encode($posted) ?>;
    const pid = <?php echo json_encode($form_data_a[$_SESSION['param']['pid']]); ?>;
    const fcid = <?php echo json_encode($fcid); ?>;
    const visite = <?php echo json_encode($form_data_a[$_SESSION['param']['visite']]) ?>;
    const visite_week = <?php echo json_encode($form_data_a[$_SESSION['param']['visite_week']] ?? "") ?>;
    const gender_val = param_a['geschlecht'];
    // var groesse_val = <?php echo json_encode($groesse) ?>;

    const warning_new_event = document.getElementById('SH_9845672');

    // StandardwerteLabor setzten
    const crp = document.getElementById('FF_20580');
    if (!crp.value) crp.value = 'mg/l';
    const calprotectin = document.getElementById('FF_20600');
    if (!calprotectin.value) calprotectin.value = 'μg/g';
    const haemoglobin = document.getElementById('FF_20620');
    if (!haemoglobin.value) haemoglobin.value = 'g/dl';


    if (visite_week != 'Woche 0' && visite_week != 'Woche 24') {
        // MAYO
        const endoskopie_0 = document.getElementById('SH_20118_a')
        const endoskopie_1 = document.getElementById('SH_20118_b')
        endoskopie_0.style.display = 'none';
        endoskopie_1.style.display = 'none';

        // Medikamentenanamnese
        document.getElementById('SH_20627_a').style.display = 'none'; // Standlabor (Basiswerte) wurde durchgeführt?
        document.getElementById('SH_20627_b').style.display = 'none';
        document.getElementById('SH_20561_a').style.display = 'none'; // Bakterielle Untersuchung Stuhl  
        document.getElementById('SH_20561_b').style.display = 'none';

        document.getElementById('FS_444102').style.display = 'none'; // Extraintestinale Manifestation
        document.getElementById('FS_444103').style.display = 'none'; // Ultraschall
        document.getElementById('FS_444104').style.display = 'none'; // Histologie
        document.getElementById('FS_444105').style.display = 'none'; // Short Health Scale (SHS)
        document.getElementById('FS_444106').style.display = 'none'; // Montreal Klassifikation
        document.getElementById('FS_444100').getElementsByTagName('legend')[0].innerHTML = 'Partieller MAYO-Score';
    }
    if (visite_week == 'Woche 24') {
        document.getElementById('FS_444106').style.display = 'none'; // Montreal Klassifikation
        document.getElementById('SH_20561_a').style.display = 'none'; // Bakterielle Untersuchung Stuhl  
        document.getElementById('SH_20561_b').style.display = 'none';
    }

    if (visite_week != 'Woche 0') {
        const outerDiv = document.getElementById('SH_111200_a');
        if (outerDiv) {
            const innerDiv = outerDiv.querySelector('.desc_f');
            if (innerDiv) {
                const text = "Gibt es seit der letzten Visite <strong>NEUE</strong> Begleiterkrankungen?";
                const replacementHtml = "" + text + "";
                innerDiv.innerHTML = replacementHtml;


            } else {
                console.error("Inneres Element mit Klasse 'desc_f' nicht gefunden.");
            }
        } else {
            console.error("Äußeres Element mit ID 'SH_111200_a' nicht gefunden.");
        }
    } else warning_new_event.style.display = 'none';







    // Helper-Funktionen





    // Checks
    safeCall(eL_check_numbers);
    safeCall(eL_check_required_fields);

    // if (!user_is_patient) error_a.FF_0 ??= -1;

    background_field_save = 1;
    // Background Save
    try {
        if (background_field_save) safeCall(background_field_action);
        // console.log('BGS:' + (background_field_save ? 'activated' : 'off'));
    } catch (error) {
        // console.log('background_field_save (INIT):', error);
    }



    if (postetd) fetchDataAndUpdateForm(fcid, 10010, 100, JSON.stringify(c_info()));

    // Page Info
    const i_am = window.location.pathname;
    const i_am_a = i_am.split('/');
    // console.log('--- ' + i_am_a[i_am_a.length - 1] + ' --<E');
</script>

