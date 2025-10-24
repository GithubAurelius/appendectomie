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

        // // Anamnese
        // field_in_group_validation('102800', ['Ja'], ['103000', '103100', '103200', '103300', '103400'], 'one'); // smoker
        // if (visite_week) field_in_group_validation('102800', ['Nein'], ['102805'], 'all'); // ex-smoker
        // field_in_group_validation('102805', ['Ja'], ['102806'], 'all'); // smoker
        // field_in_group_validation('102805', ['Ja'], ['102806'], 'all'); // smoker
        // field_in_group_validation('106000', ['Angestellt tätig', 'Selbständig tätig'], ['106500', '106600'], 'all'); // occupation
        // // occupation-add because of conflicting listeners
        // const job = document.getElementById('FF_106000');
        // const off_work = document.getElementById('FF_106200');
        // const off_work_marker = document.getElementById('cbm_106200');
        // if (job) job.addEventListener('change', (event) => {
        //     if (job.value !== 'Angestellt tätig') error_a['FF_106200'] = 0;
        //     else check_off_work();
        // });
        // if (off_work) off_work.addEventListener('change', (event) => {
        //     check_off_work();
        // });
        // check_off_work();
        // // retiredment
        // field_in_group_validation('106000', ['Berentet aufgrund CED'], ['106400'], 'all'); // retired 1
        // field_in_group_validation('106000', ['Berentet aufgrund anderer Erkrankungen'], ['106100'], 'all'); // retired 2
        // field_in_group_validation('106200', ['Ja'], ['106300'], 'all'); // off work due to illness 
        // // Schwangerschaft
        // // if (visite_week) 
        // field_in_group_validation('108500', ['Nein'], ['109100'], 'all'); // pregnacy no 
        // field_in_group_validation('109100', ['Ja'], ['109200', '109300'], 'all'); // num of pregnacy
        // field_in_group_validation('109300', ['Ja'], ['109400', '110100', '109700', '109500', '109700', '109600', '109800', '109900', '110000'], 'all'); // pregnacy complication 
        // field_in_group_validation('108500', ['Ja'], ['108600', '108700', '108800', '108900'], 'all'); // pregnacy yes
        // field_in_group_validation('108900', ['Ja'], ['109000'], 'all'); // former pregnacy
        // // family disposition
        // // if (visite_week) 
        // field_in_group_validation('105000', ['Ja'], ['105100', '105200', '105400', '105500', '105600', '105700', '105800', '105900'], 'one', 'Ja'); // familiary dispsition
        // // if (visite_week) 
        // field_in_group_validation('105200', ['Ja'], ['105300'], 'one'); // twins
        // // misc
        // field_in_group_validation('102400', ['Ja'], ['102500'], 'all'); // hospital
        // // if (visite_week) 
        // field_in_group_validation('111200', ['Ja'], ['111301', '115500'], 'one'); // misc medical conditions
        // // if (visite_week) 
        // field_in_group_validation('115500', ['Ja'], ['115501'], 'one'); // medical conditions
        // // date comparison first symptoms to diagnosis
        // // if (visite_week) 
        // compare_dates('FF_102300', 'FF_102200', '<=');

        // // diagnoses only medics
        // if (!user_is_patient) {
        //     field_in_group_validation('95', ['Morbus Crohn'], ['101902', '101904', '101906', '101908', '101910'], 'one'); // localization
        //     field_in_group_validation('104800', ['Ja'], ['104900', '104910'], 'one'); // stenosis
        //     field_in_group_validation('104200', ['Ja'], ['104300', '104400'], 'one'); // fistels
        // }

        // // op's in the past
        // const art = {};
        // let ids = [107200, 107500, 107800, 108100, 108400];
        // ids.forEach((id, index) => {
        //     let element = document.getElementById('FF_' + id);
        //     if (element) {
        //         art[index + 1] = element;
        //         element.addEventListener('change', op);
        //     }
        // });
        // const year = {};
        // const date_year = {};
        // const date_month = {};
        // ids = [107100, 107400, 107700, 108000, 108300];
        // ids.forEach((id, index) => {
        //     let element = document.getElementById('FF_' + id);
        //     if (element) {
        //         year[index + 1] = element;
        //         element.addEventListener('change', op);
        //     }
        //     element = document.getElementById('FF_' + id + '_year_select');
        //     if (element) {
        //         date_year[index + 1] = element;
        //         element.addEventListener('change', op);
        //     }
        //     element = document.getElementById('FF_' + id + '_month_select');
        //     if (element) {
        //         date_month[index + 1] = element;
        //         element.addEventListener('change', op);
        //     }
        // });
        // op_field.addEventListener('change', () => {
        //     op(ids);
        // });
        // op(ids);

    }

    var error_premed = 0;
    let param_a = {};



    try {

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

        // medication frames

        // if (!param_a || typeof param_a['visite_week'] === 'undefined') {
        //     console.warn('⚠ param_a.visite_week nicht definiert.');
        // }


        // const work_frame_medikation = document.getElementById('medikation');
        // if (work_frame_medikation) {
        //     work_frame_medikation.style.height = '80px';
        //     const query_str = '?medtype=M&param_str=' + btoa(encodeURIComponent(param_str));
        //     work_frame_medikation.src = '<?php echo $_SESSION['WEBROOT'] . $_SESSION['PROJECT_PATH'] . 'forms/' ?>Medikation_patient_version_vormedikation.php' + query_str;
        // } else {
        //     console.warn('⚠ medikation-Frame nicht gefunden.');
        // }

        // // medication frames dynamic height
        // window.addEventListener('message', function(event) {
        //     try {
        //         if (event.data && event.data.type === 'setHeight' && event.data.frameId) {
        //             const iframe = document.getElementById(event.data.frameId);
        //             if (iframe) {
        //                 const newHeight = Math.min(parseInt(event.data.height, 10) || 0, 1000);
        //                 iframe.style.height = newHeight + 'px';
        //             } else {
        //                 console.warn(`⚠ Frame mit ID "${event.data.frameId}" nicht gefunden.`);
        //             }
        //         }
        //     } catch (msgErr) {
        //         console.error('❌ Fehler beim Verarbeiten der Message:', msgErr);
        //     }
        // });

    } catch (err) {
        console.error('❌ Fehler im Medication-Frame-Code:', err);
    }


    // basic vars 
    // const status = <?php echo json_encode($status) ?>;
    // const pre_visite = <?php echo json_encode($pre_visite ?? "") ?>;
    // const pre_data_json_str = <?php echo json_encode($pre_data_json ?? "") ?>;
    // const user_is_patient = <?php echo json_encode($user_is_patient); ?>;
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

    // const helper = document.getElementById('helper');
    // const groesse = document.getElementById('FF_102600');
    // const gewicht = document.getElementById('FF_102700');
    // const bmi = document.getElementById('FF_102705');
    // const bmi_info = document.getElementById('span_102705')
    // const op_field = document.getElementById('FF_106900');

    // const mayo_score = document.getElementById('FF_109001');
    // const mayo_p_score = document.getElementById('FF_109002');
    // const ses_score = document.getElementById('FF_109003');
    // const cdai_score = document.getElementById('FF_109004');
    // const sidbq_score = document.getElementById('FF_109005');
    // const promis_score = document.getElementById('FF_109006');
    // const facit_score = document.getElementById('FF_109007');
    // const hbi_score = document.getElementById('FF_109008');
    // const bwl_score = document.getElementById('FF_119000');

    // const sliderContainer = document.querySelector('.slider-container');
    // sliderContainer.style.width = '90%'; 

    document.addEventListener('DOMContentLoaded', (event) => {

        // console.log('Init DOMContentLoaded');
        // console.log("STATUS:" + status);
        // if (status === 'FIRST_INIT' || status === 'FOLLOWUP_INIT') {
        //     fetchDataAndUpdateForm(fcid, 10010, 10, <?php echo json_encode($_SESSION['m_uid'] ?? "") ?>);
        //     fetchDataAndUpdateForm(fcid, 10010, 20, <?php echo json_encode($_SESSION['user_group'] ?? "") ?>);
        //     fetchDataAndUpdateForm(fcid, 10010, 90, pid);
        //     fetchDataAndUpdateForm(fcid, 10010, 91, param_a['praxis_pid']);
        //     fetchDataAndUpdateForm(fcid, 10010, 92, param_a['ext_fcid']);
        //     fetchDataAndUpdateForm(fcid, 10010, 93, visite);
        //     fetchDataAndUpdateForm(fcid, 10010, 94, visite_week);
        //     fetchDataAndUpdateForm(fcid, 10010, 95, diagnosis_val);
        //     fetchDataAndUpdateForm(fcid, 10010, 96, gender_val);
        //     fetchDataAndUpdateForm(fcid, 10010, 10005020, param_a['visite_datum']);
        //     // console.log("Patient initialisiert!");
        //     if (status === 'FOLLOWUP_INIT') {
        //         const pre_data_json = JSON.parse(pre_data_json_str);
        //         for (let key in pre_data_json) {
        //             if (pre_data_json.hasOwnProperty(key)) {
        //                 // console.log(`Schlüssel: ${key}, Wert: ${pre_data_json[key]}`);
        //                 fetchDataAndUpdateForm(fcid, 10010, key, pre_data_json[key]);
        //             }
        //         }
        //     }
        // }




        // Helper-Funktionen

        try {



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


            // Message Listener
            window.addEventListener('message', (event) => {
                if (event.data?.type === 'error_premed_ready' || event.data?.type === 'error_med_ready') {
                    try {
                        error_a = {
                            ...error_a,
                            ...JSON.parse(event.data.value)
                        };
                        // safeCall(c_info);
                        try {
                            // c_info();
                            fetchDataAndUpdateForm(fcid, 10010, 100, JSON.stringify(c_info()));
                        } catch (err) {
                            console.error(`❌ Fehler in Funktionsaufruf errorwriting patientenfragebogen`, err);
                        }
                    } catch (err) {
                        console.error('Fehler beim Verarbeiten von error_*_ready:', err);
                    }
                }
            });



            // Page Info
            const i_am = window.location.pathname;
            const i_am_a = i_am.split('/');
            // console.log('--- ' + i_am_a[i_am_a.length - 1] + ' --<E');



        } catch (mainErr) {
            console.warn('❌ Hauptfehler im DOMContentLoaded:', mainErr);
        }
    });
</script>