<script>
    function show_patient_data(tab_a, this_inner_win_height, fieldset_height) {
        patient_fieldset.style.display = ""; // oder "flex", je nach Layout
        main_form_submit_button.style.display = '';
        main_tab.style.position = "absolute";
        // main_tab.style.top = 0;
        // set_tab_and_iframe_heigth(base_url, tab_a['tab1']['url_params'], tab_a['tab1']['iframe'], (this_inner_win_height - 150), fieldset_height)
    }

    function hide_patient_data(tab_a, this_inner_win_height, fieldset_height) {
        patient_fieldset.style.display = "none";
        main_form_submit_button.style.display = 'none';
        main_tab.style.position = "absolute";
        // main_tab.style.top = -30;
        // set_tab_and_iframe_heigth(base_url, tab_a['tab1']['url_params'], tab_a['tab1']['iframe'], (this_inner_win_height), fieldset_height)
    }

    function format_today(date = new Date()) {
        const tag = date.getDate().toString().padStart(2, '0');
        const monat = (date.getMonth() + 1).toString().padStart(2, '0');
        const jahr = date.getFullYear();
        return `${jahr}-${monat}-${tag}`;
    }

    const pid = <?php echo json_encode($fcid) ?>;
    const therapy = <?php echo json_encode($therapy) ?>;
    
    let param_a = {};
    // 'sqlstr'     => "F_{$_SESSION['param']['pid']} = '{$fcid}'",         
    param_a = <?php
                echo json_encode([
                    'pid'        => $fcid,
                    'praxis_pid' => $form_data_a[$_SESSION['param']['praxis_pid']] ?? "",
                    'ext_fcid'   => $form_data_a[$_SESSION['param']['ext_fcid']] ?? "",
                    'geschlecht' => $form_data_a[$_SESSION['param']['geschlecht']] ?? "",
                    'therapy'    => $form_data_a[$_SESSION['param']['therapy']] ?? ""
                ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                ?>;
    const param_str = JSON.stringify(param_a);

    // Stammdaten Logik
    const start_date_field = document.getElementById('FF_10003045');
    if (start_date_field) start_date_field.value = format_today();

    const center = document.getElementById('FF_10003046');
    if (center) center.value = <?php echo json_encode($_SESSION['center'] ?? "") ?>;

    const age = document.getElementById('FF_10003020');
    const check_age_18 = document.getElementById('FF_10003101');
    if (age) {
        age.addEventListener('change', () => {
            if (age && check_age_18) {
                if (parseInt(age.value) >= 18) {
                    document.getElementById('CB_10003101_Ja').style.backgroundColor = 'dimgray';
                    document.getElementById('CB_10003101_Nein').style.backgroundColor = '';
                    check_age_18.value = 'Ja';
                } else {
                    document.getElementById('CB_10003101_Ja').style.backgroundColor = '';
                    document.getElementById('CB_10003101_Nein').style.backgroundColor = 'dimgray';
                }
            }
        });
    }

    // Einschluss und Ausschluss
    const ein_aus_buttons = document.getElementById('SH_199900');

    // Einschluss
    const einschluss = document.getElementById('FS_199922');
    const fieldIds_ein = ['10003101', '10003102', '10003103', '10003104', '10003105', '10003106', '10003107', '10003108'];

    function check_some_checkboxes(some_fields, fieldset) {
        const allValid = some_fields.every(id => {
            const f = document.getElementById('FF_' + id);
            return f && f.value && f.value !== "Nein";
        });
        fieldset.style.display = allValid ? 'none' : '';
        ein_aus_buttons.style.display = '';
    }

    fieldIds_ein.forEach(id => {
        const cbJa = document.getElementById('CB_' + id + '_Ja');
        const cbNein = document.getElementById('CB_' + id + '_Nein');
        const hiddenField = document.getElementById('FF_' + id);

        if (cbJa && hiddenField) {
            cbJa.addEventListener('click', () => {
                hiddenField.value = "Ja"; // Beispielwert für "Ja"
                check_some_checkboxes(fieldIds_ein, einschluss);
            });
        }
        if (cbNein && hiddenField) {
            cbNein.addEventListener('click', () => {
                hiddenField.value = "Nein"; // Beispielwert für "Nein"
                check_some_checkboxes(fieldIds_ein, einschluss);
            });
        }
    });
    check_some_checkboxes(fieldIds_ein, einschluss);

    // Ausschluss
    const ausschluss = document.getElementById('FS_199923');
    const fieldIds_aus = ['10003201', '10003202', '10003203', '10003204', '10003205', '10003206', '10003207', '10003208', '10003209', '10003210', '10003211'];

    function check_some_checkboxes_invers(some_fields, fieldset) {
        const allValid = some_fields.every(id => {
            const f = document.getElementById('FF_' + id);
            return f && f.value && f.value !== "Ja";
        });
        fieldset.style.display = allValid ? 'none' : '';
        ein_aus_buttons.style.display = '';
    }

    fieldIds_aus.forEach(id => {
        const cbJa = document.getElementById('CB_' + id + '_Ja');
        const cbNein = document.getElementById('CB_' + id + '_Nein');
        const hiddenField = document.getElementById('FF_' + id);

        if (cbJa && hiddenField) {
            cbJa.addEventListener('click', () => {
                hiddenField.value = "Ja"; // Beispielwert für "Ja"
                check_some_checkboxes_invers(fieldIds_aus, ausschluss);
            });
        }
        if (cbNein && hiddenField) {
            cbNein.addEventListener('click', () => {
                hiddenField.value = "Nein"; // Beispielwert für "Nein"
                check_some_checkboxes_invers(fieldIds_aus, ausschluss);
            });
        }
    });
    check_some_checkboxes_invers(fieldIds_aus, ausschluss);

    if (einschluss.style.display == 'none' || ausschluss.style.display == 'none') ein_aus_buttons.style.display = '';
    else ein_aus_buttons.style.display = 'none';

    const ein_button = document.getElementById('ein_button');
    const aus_button = document.getElementById('aus_button');

    function show_fieldset(fs_id) {
        const fs = document.getElementById(fs_id);
        fs.style.display = fs.style.display === 'none' ? '' : 'none';
    }

    ein_button.addEventListener('click', function(event) {
        event.preventDefault();
        show_fieldset('FS_199922');
    });
    aus_button.addEventListener('click', function(event) {
        event.preventDefault();
        show_fieldset('FS_199923')
    });


    function checkbox_and_date(f_chekbox, f_date) {
        if (f_chekbox.value == 1) {
            f_date.required = true;
        } else {
            f_date.required = false;
            f_date.style.backgroundColor = ''
        }
        eL_check_required_fields();
    }

    function one_must_check(field_a) {
        one_is_checked = 0;
        field_a.forEach((element, index) => {
            if (element.value) one_is_checked = 1;
        });
        field_a.forEach((element, index) => {
            if (!one_is_checked) check_if_empty(element);
            else {
                cb = document.getElementById(element.id.replace("FF_", "cbm_"));
                if (cb) cb.style.backgroundColor = '';
                error_a[element.id] = 0;
            }
        });

    }

    konservativ = document.getElementById('FF_10020001');
    konservativ_date = document.getElementById('FF_10003047');
    if (konservativ) {
        konservativ.addEventListener('change', () => {
            checkbox_and_date(konservativ, konservativ_date);
            one_must_check([konservativ, operativ]);
        });
    }
    checkbox_and_date(konservativ, konservativ_date);

    operativ = document.getElementById('FF_10020002');
    operativ_date = document.getElementById('FF_10003048');
    if (operativ) {
        operativ.addEventListener('change', () => {
            checkbox_and_date(operativ, operativ_date);
            one_must_check([konservativ, operativ]);
        });
    }
    checkbox_and_date(operativ, operativ_date);
    one_must_check([konservativ, operativ]);

    const bmi = document.getElementById('FF_102705');
    const groesse = document.getElementById('FF_102600');
    const gewicht = document.getElementById('FF_102700');

    function set_bmi(bmi, gr, gw) {
        if (gr && gw && gr > 0) {
            const bmi_val = gw / (gr / 100 * gr / 100);
            bmi.value = Math.round(bmi_val);
            console.log(bmi_val);
        } else return '';
    }

    if (bmi) bmi.readOnly = true;
    if (groesse && gewicht) {
        groesse.addEventListener('input', () => {
            if (groesse.value && gewicht.value) set_bmi(bmi, groesse.value, gewicht.value);
        });
        gewicht.addEventListener('input', () => {
            if (groesse.value && gewicht.value) set_bmi(bmi, groesse.value, gewicht.value);
        });
    }


    study_nurse = document.getElementById('study_nurse');
    if (study_nurse) {
        study_nurse.addEventListener('click', () => {
            alert('Frau Fisnike Verlaku\nE-Mail: Fisnike.Verlaku@evkk.de\nMobil: 0176 201 360 91');
        });
    }
    study_nurse_email = document.getElementById('study_nurse_email');
    if (study_nurse_email) {
        study_nurse_email.addEventListener('click', () => {
            window.location.href = 'mailto:Fisnike.Verlaku@evkk.de?subject=Pseudonym-Anforderung: Appendektomie bei therapierefraktärer Colitis ulcerosa';
        });
    }
    
    fetchDataAndUpdateForm(pid, 10003, 95, therapy);

        // console.log( param_a);











        /********************************/
        /***  Win-Box-Measurement     ***/
        /********************************/
        const parentWinbox = window.top.findParentWinboxDiv(window);
    if (parentWinbox) num = parentWinbox.id.split('-')[1];

    // let this_inner_win_height = document.body.clientHeight;
    let this_inner_win_height = parentWinbox.offsetHeight;
    const observer = new ResizeObserver(entries => {
        for (let entry of entries) {
            this_inner_win_height = parseFloat(parentWinbox.style.height); // entry.contentRect.height;
            // console.log("Neue Body-Höhe:", this_inner_win_height);
        }
    });
    observer.observe(document.body); // Body beobachten

    // fieldset switch
    const patient_fieldset = document.getElementById('FS_199920');

    const main_form_submit_button = document.getElementById('main_form_submit_button');
    const main_tab = document.getElementById('main_tab');

    let fieldset_height = 0;
    if (patient_fieldset) {
        const style = window.getComputedStyle(patient_fieldset);
        if (style.display !== "none") {
            fieldset_height = patient_fieldset.offsetHeight + 10;
        }
        // const legend = patient_fieldset.querySelector("legend");
        // if (legend) {
        //     legend.remove(); // entfernt das Legend-Element
        // }
    }
    const tab_fieldset = document.getElementById('FS_99922');
    if (tab_fieldset) {
        // Legend innerhalb des Fieldsets auswählen
        const legend = tab_fieldset.querySelector("legend");
        if (legend) {
            legend.remove(); // entfernt das Legend-Element
        }
    }

    // Frame position
    const sourceDiv = document.getElementById('patient_tabs');
    const targetDiv = document.getElementById('idonly_10003050');
    targetDiv.innerHTML = sourceDiv.innerHTML;
    sourceDiv.remove();

    /*****************************************/
    /***  Tab-Definition und Steuerung     ***/
    /*****************************************/

    const tab_a = {}
    const base_url = "<?php echo MIQ_PATH ?>modules/listing_form_native/listing_prepare.php";
    var url_params = new URLSearchParams({
        fg: "10005",
        limit: 1000,
        form: "Visite",
        work_mode: "E-D8",
        num: num,
        form_name: 'Visite',
        fid_str: '10005021,10005020,100',
        query_global_str: JSON.stringify([
            ["90", "", pid]
        ]),
        param_str: btoa(encodeURIComponent(param_str))
    });
    tab_a['tab1'] = {};
    tab_a['tab1']['iframe'] = '_visite';
    tab_a['tab1']['url_params'] = url_params.toString();

    url_params.delete("work_mode");

    url_params.set('fg', '10010');
    url_params.set('form', 'Patientenfragebogen');
    url_params.set('form_name', 'Patientenfragebogen');
    url_params.set('fid_str', '110200,110500,110600,110700,111000,111100,110511');
    // url_params_labor = url_params.toString();
    tab_a['tab5'] = {};
    tab_a['tab5']['iframe'] = '_labor';
    tab_a['tab5']['url_params'] = url_params.toString();

    url_params.set('fid_str', '102300,102200,102600,102700,102705,102800,102815,108500');
    // url_params_befragung = url_params.toString();
    tab_a['tab3'] = {};
    tab_a['tab3']['iframe'] = '_patientenbefragung';
    tab_a['tab3']['url_params'] = url_params.toString();

    url_params.set('fid_str', '102000,103700,110905,104800,115700,115800,116000');
    // url_params_untersuchung = url_params.toString();
    tab_a['tab4'] = {};
    tab_a['tab4']['iframe'] = '_untersuchung';
    tab_a['tab4']['url_params'] = url_params.toString();

    url_params.set('fid_str', '109001,109002,109003,109004,109005,109007,109008');
    // url_params_scores = url_params.toString();
    tab_a['tab2'] = {};
    tab_a['tab2']['iframe'] = '_scores';
    tab_a['tab2']['url_params'] = url_params.toString();

    url_params.set('fg', '10020');
    url_params.set('form', 'Medikation');
    url_params.set('form_name', 'Medikation');
    url_params.set('fid_str', '10020021,10020020,10020040,10020080,10020050,10020060,10020070');
    // url_params_medikation = url_params.toString();
    tab_a['tab6'] = {};
    tab_a['tab6']['iframe'] = '_medikation';
    tab_a['tab6']['url_params'] = url_params.toString();

    url_params.set('fg', '10050');
    url_params.set('form', 'Nebenwirkung');
    url_params.set('form_name', 'Nebenwirkung');
    url_params.set('fid_str', '10050020,10050040,10050050,10050070,10050075,10050080,10050090,10050100,10050110,10050120,10050130,10050140,10050150,10050160,10050170');
    // url_params_nebenw = url_params.toString();
    tab_a['tab7'] = {};
    tab_a['tab7']['iframe'] = '_nebenwirkung';
    tab_a['tab7']['url_params'] = url_params.toString();


    // Tab-Steuerung
    const tabButtons = document.querySelectorAll('.tab-button');

    function set_tab_and_iframe_heigth(base_url, url_params, iframe2set, window_height, p_fieldset) {
        // console.log(this_inner_win_height, height2set, fieldset_height);
        patient_window_height_plus_header = p_fieldset.offsetHeight + 150;
        tab_height = window_height - patient_window_height_plus_header;
        tab_fieldset.style.height = tab_height;
        document.getElementById(iframe2set).src = `${base_url}?${url_params}`;
        document.getElementById(iframe2set).style.height = tab_height;
        // console.log(window_height, patient_window_height_plus_header,tab_height);
    }

    tabButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const selectedTab = event.target.dataset.tab;
            tabButtons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            set_tab_and_iframe_heigth(base_url, tab_a[selectedTab]['url_params'], tab_a[selectedTab]['iframe'], this_inner_win_height, patient_fieldset)
            // Optional: Logik zum Anzeigen des richtigen Tab-Inhalts
            // const tabContent = document.querySelector(`#tab-content-${selectedTab}`);
            // if (tabContent) {
            //   // Verstecke alle Tab-Inhalte und zeige nur den gewünschten an.
            // }
        });
    });

    const buttons = document.querySelectorAll('.tab-button');
    const contents = document.querySelectorAll('.tab-content');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            buttons.forEach(b => b.classList.remove('active'));
            contents.forEach(c => c.classList.remove('active'));
            button.classList.add('active');
            const tabId = button.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });

    const edit_patient_button = document.getElementById('edit_patient_button');
    if (patient_fieldset && edit_patient_button) {
        edit_patient_button.addEventListener("click", () => {
            // Aktuelles Display prüfen
            const style = window.getComputedStyle(patient_fieldset);
            if (style.display === "none")
                show_patient_data(tab_a, this_inner_win_height, fieldset_height);
            else
                hide_patient_data(tab_a, this_inner_win_height, fieldset_height);
        });
    }


    /********************************/
    /***  Win-Box-Managament      ***/
    /********************************/

    // Optimize Postions
    const menue_height = window.top.document.getElementById('main_menue').offsetHeight;
    const main_win_height = window.top.innerHeight - menue_height;
    const main_win_width = window.top.innerWidth;
    const width_100 = main_win_width;

    const set_height = main_win_height * 3.3 / 5;

    var data_complete = <?php echo json_encode($data_complete ?? 0) ?>; // only for design, real use at end
    const form_name = <?php echo json_encode($form_name) ?>;
    if (form_name) {
        const thisbox_id = window.top.window_boxes[form_name]['wid'];
        if (thisbox_id) {
            const thisbox = window.top.document.getElementById(thisbox_id);
            const this_width = width_100 * 2 / 5;
            if (data_complete) thisbox.winbox.resize(this_width, set_height).move(0, menue_height);
            thisbox.winbox.setIcon(window.top.miq_root_path + 'img/person.svg');
            // thisbox.winbox.setBackground("#e27828ff");
        }
    }

    const list_name = 'Patienten-Liste';
    if (list_name) {
        const list_box_id = window.top.window_boxes[list_name]['wid'];
        if (list_box_id) {
            const list_box = window.top.document.getElementById(list_box_id);
            this_width = width_100 * 2 / 5;
            this_height = main_win_height - set_height;
            list_box.winbox.resize(this_width, this_height).move(0, main_win_height + menue_height - this_height);
            list_box.winbox.setIcon(window.top.miq_root_path + 'img/person-list.svg');
            // thisbox.winbox.setBackground("#e27828ff");
        }
    }

    // work_frame_height = parent.document.body.scrollHeight - 510;
    // work_frame.style.height = work_frame_height + 'px';

    // Close Visite Windows if patient change
    const visite_winbox_id = window.top.window_boxes['Visite']['wid'];
    if (visite_winbox_id) winbox_visite = parent.document.getElementById(visite_winbox_id).winbox.close(true);

    /****************************/
    /***  Some design-fixings ***/
    /****************************/

    document.querySelectorAll('.col_a').forEach(el => {
        el.style.borderBottom = "1px solid #ccc";
        el.style.paddingTop = "5px";
    });
    document.querySelectorAll('.col_b').forEach(el => {
        el.style.borderBottom = "1px solid #ccc";
        el.style.paddingTop = "5px";
    });
    // document.getElementById('SH_10003047_b').style.paddingLeft = "15px";
    // document.getElementById('SH_10003048_b').style.paddingLeft = "15px";


    /****************************/
    /***  Global functions  s ***/
    /****************************/


    setTimeout(() => { // ausrichten der Fenster abwarten
        set_tab_and_iframe_heigth(base_url, tab_a['tab1']['url_params'], tab_a['tab1']['iframe'], this_inner_win_height, patient_fieldset)
    }, 100);

    eL_check_numbers();
    eL_check_required_fields();

    errors = error_a_sum(error_a);
    if (errors) set_message(errors);
    if (<?php echo json_encode($_POST['FF_10'] ?? 0) ?>) set_message(errors);

    /*************************************/
    /***  Needed after global listener ***/
    /*************************************/

    // pseudonym_field am Ende wegen reuqired listener
    const pseudonym_field = document.getElementById('FF_92');
    if (pseudonym_field) {
        pseudonym_field.addEventListener('change', () => {
            if (pseudonym_field.value.trim() === '') {
                pseudonym_field.style.backgroundColor = 'red';
                document.getElementById('SH_99467').style.display = '';
            } else {
                document.getElementById('SH_99467').style.display = 'None';
            }
        });
    }
    if (pseudonym_field.value.trim() == '') {
        pseudonym_field.style.backgroundColor = 'red';
    }

    // Show and hide patient data - ready fpr visits
    let background_field_save = 0;
    data_complete = <?php echo json_encode($data_complete ?? 0) ?>;
    if (data_complete) {
        hide_patient_data(tab_a, this_inner_win_height, fieldset_height);
    } else {
        const tabs = document.getElementById('FS_99922') ?? null;
        if (tabs) tabs.style.display = 'None';
    }
</script>


<!-- ❓📊📁📋⚙️➕🖥️ 🖨️📧📬✉️-->