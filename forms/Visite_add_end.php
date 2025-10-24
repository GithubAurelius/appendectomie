<script>
    function printIframe(fcid) {
        const iframe = document.getElementById(fcid + "_visite_work");
        if (iframe) {
            iframe.contentWindow.focus();
            iframe.contentWindow.print();
        } else {
            alert("Iframe nicht gefunden!");
        }
    }

    function show_hide_elem(id, state) {
        const elem = document.getElementById(id);
        if (state) elem.style.display = '';
        else elem.style.display = 'none';
    }

    // params
    let param_a = {};
    param_a['pid'] = "<?php echo $form_data_a[$_SESSION['param']['pid']] ?? "" ?>"; // pid could be cid
    param_a['praxis_pid'] = "<?php echo $form_data_a[$_SESSION['param']['praxis_pid']] ?? "" ?>";
    param_a['ext_fcid'] = "<?php echo $form_data_a[$_SESSION['param']['ext_fcid']] ?? "" ?>";
    param_a['geschlecht'] = "<?php echo $form_data_a[$_SESSION['param']['geschlecht']] ?? "" ?>";
    param_a['therapy'] = "<?php echo $form_data_a[$_SESSION['param']['therapy']] ?? "" ?>";
    param_a['visite_week'] = "<?php echo $form_data_a[$_SESSION['param']['visite_week']] ?? "" ?>";
    param_a['visite'] = "<?php echo $fcid ?? "" ?>";
    param_a['visite_datum'] = "<?php echo $form_data_a[10005020] ?? "" ?>";
    const param_str = JSON.stringify(param_a);

    const posted = <?php echo json_encode(!empty($_POST)); ?>;
    const fcid = <?php echo json_encode($fcid ?? "") ?>;
    const winbox_iframe = getOwnIframeElement();
    const work_frame = document.getElementById(fcid + '_visite_work');
    const form_name = <?php echo json_encode($form_name) ?>;
    const visite_date = document.getElementById('FF_10005020');
    const visite_week = document.getElementById('FF_10005021');
    const submit_button = document.getElementById('main_form_submit_button');
    const dashboard = document.getElementById('dashboard_visite');
    const tdSidebar = document.getElementById('<?php echo $fg ?>_td_sidebar');

    const visite_week_a = <?php echo json_encode($visite_week_a); ?>;
    const currentValue = visite_week.value;
    for (let i = visite_week.options.length - 1; i >= 0; i--) {
        const optionText = visite_week.options[i].text;
        const optionValue = visite_week.options[i].value;
        // Nur entfernen, wenn es NICHT die aktuell ausgewählte Option ist
        if (visite_week_a.includes(optionText) && optionValue !== currentValue) {
            visite_week.remove(i);
        }
    }

    const visite_span = document.getElementById('SP_10005021');
    visite_span.style.fontSize = '16px';
    visite_span.style.marginTop = "2px";
    const date_span = document.getElementById('SP_10005020');
    date_span.style.fontSize = '16px';
    date_span.style.marginTop = "2px";




    const print_button = document.getElementById('print_button');
    if (print_button) print_button.style.display = 'none';

    if (dashboard && tdSidebar) {
        tdSidebar.appendChild(dashboard);
    }

    var background_field_save = 1;
    if (visite_date.value && visite_week.value) {
        hide_header();
        document.getElementById('main_tab').style.marginTop = '0px';
        background_field_save = 1;
        submit_button.style.display = 'none';
        visite_date.readOnly = true;
        visite_week.disabled = true;
    }

    if (visite_date) {
        visite_date.addEventListener('change', (event) => {
            if (visite_date.value) fetchDataAndUpdateForm(param_a['pid'], 10003, 10005020, event.target.value);
            if (submit_button) submit_button.style.display = 'block';
        });
    }
    // if (last_visit) fetchDataAndUpdateForm(param_a['pid'], 10003, 10005020, visite_date.value);

    if (form_name) {
        const thisbox_id = window.top.window_boxes[<?php echo json_encode($form_name) ?>]['wid'];
        if (thisbox_id) {
            // console.log('thisID:' + thisbox_id);
            const menue_height = window.top.document.getElementById('main_menue').offsetHeight;
            const main_win_height = window.top.innerHeight - menue_height;
            const thisbox = window.top.document.getElementById(thisbox_id);
            const main_win_width = window.top.innerWidth;
            const width_100 = main_win_width;
            const this_width = width_100 * 3 / 5;
            thisbox.winbox.resize(this_width, main_win_height).move(width_100 - this_width, menue_height);
            thisbox.winbox.setIcon(window.top.miq_root_path + 'img/med_monitor.svg');
            // thisbox.winbox.setBackground("#e27828ff");
            work_frame.style.height = (main_win_height - 160) + 'px';
        }
    }

    const menue_height = window.top.document.getElementById('main_menue').offsetHeight;
    const main_win_height = window.top.innerHeight - menue_height;
    work_frame.style.height = (main_win_height - 160) + 'px';

    if (visite_date.value && visite_week.value) work_frame.src = "<?php echo $_SESSION["WEBROOT"] . $_SESSION["PROJECT_PATH"] ?>forms/Patientenfragebogen.php?fg=10010&fcid=" + param_a['visite'] + "&param_str=" + btoa(encodeURIComponent(param_str));
    // document.addEventListener('DOMContentLoaded', (event) => {

    //     try {
    //         if (background_field_save) background_field_action();
    //         // console.log('BGS:' + (background_field_save ? 'activated' : 'off'));
    //     } catch (error) {
    //         // console.log('background_field_save (INIT):', error);
    //     }



    //     function reloadVisiteIframe() {
    //         setTimeout(() => {
    //             try {
    //                 const patient_window = window.top.window_boxes['Patient']['wid'];
    //                 if (patient_window) {
    //                     const patient_window_doc = window.top.document.getElementById(patient_window);
    //                     // if (!patient_window_doc) throw 'DIV mit Patient-Window nicht gefunden';

    //                     const firstIframe = patient_window_doc.querySelector('iframe');
    //                     // if (!firstIframe?.contentWindow) throw 'Erster Iframe nicht gefunden oder kein Zugriff möglich';

    //                     const visiteIframe = firstIframe.contentWindow.document.getElementById('_visite');
    //                     // if (!visiteIframe) throw 'Innerer Iframe "_visite" nicht gefunden';

    //                     visiteIframe.src = visiteIframe.src; // reload
    //                     // console.log('Der innere Iframe "_visite" wurde erfolgreich neu geladen.');
    //                 }
    //             } catch (err) {
    //                 console.error('Fehler beim Neuladen:', err);
    //             }
    //         }, 1000);
    //     }

    //     // Initial einmal aufrufen
    //     reloadVisiteIframe();

    //     // Bei Änderung des Datums erneut aufrufen
    //     visite_date.addEventListener('change', () => {
    //         reloadVisiteIframe();
    //         // window.top.visite_tab.click();
    //     });



    //     if (fcid < 2025081900000000) visite_date.readOnly = true;

    //     eL_check_numbers();
    //     eL_check_required_fields();


    //     // work_frame.style.height = (main_win_height - 160) + 'px';
    // });
</script>