<?php

session_start();

include_once '../connection.php';
include_once '../globals.php';
if (isset($_POST['app_id'])) {
    $section_opening = "";
    $section_middle = "</div><div class=\"recc__cont flex-col\">";
    $section_end = "  </div></div></div>";
    $observations = "";
    $reccommendations = "";
    
    $app_id = sanitize($_POST['app_id']);
    $reg = '';
    $name = '';
    $date_insp = '';
    $data = '';

    function setSectionOpening($subject)
    {
        return "<div class=\"feedback__section flex-col-seaic\"><p class=\"section__title flex-jc-aic\">$subject</p><div class=\"feedback__content flex-jc-aic\"><p class=\"obs__title\">Observations</p></p><div class=\"obs__cont flex-col\">";
    }

    $fetch_sql = "SELECT nursery_name, reg_num, inspection.inspection_date, feedback.subject, feedback.obs, feedback.corrective_action FROM `nursery` NATURAL JOIN applications NATURAL JOIN evaluator_assignment NATURAL JOIN inspection NATURAL JOIN feedback WHERE applications.application_id = '$app_id'";

    if ($result = $conn->query($fetch_sql)) {
        if ($result->num_rows > 0) {
            global $reg, $name, $date_insp, $section_opening, $section_middle, $section_end, $observations, $reccommendations, $data;

            $index = 0;
            $subject_temp = '';

            while ($row_2 = $result->fetch_assoc()) {

                if ($index == 0) {
                    $reg = $row_2['reg_num'];
                    $name = $row_2['nursery_name'];
                    $date_insp = explode(' ', $row_2['inspection_date'])[0];
                    $subject_temp = $row_2['subject'];
                    $section_opening = setSectionOpening($subject_temp);
                }

                $subject = $row_2['subject'];
                $obs = $row_2['obs'];
                $corr = explode('†', $row_2['corrective_action'])[0];

                if ($subject_temp !== $subject) {
                    $data .= $section_opening . $observations . $section_middle . $reccommendations . $section_end;
                    $subject_temp = $subject;
                    $observations = "";
                    $reccommendations  = "";
                    $observations .= "<p class=\"obs flex\">$obs</p>";
                    $reccommendations .= "<p class=\"recc flex\">$corr</p>";
                  
                    $section_opening = setSectionOpening($subject_temp);
                } else {
                    $observations .= "<p class=\"obs flex-jc-aic\">$obs</p>";
                    $reccommendations .= "<p class=\"recc flex\">$corr</p>";
                }

                if ($index == $result->num_rows - 1) {
                    $data .= $section_opening . $observations . $section_middle . $reccommendations . $section_end;
                }

                $index++;
            }
        }
        formResponse(true, [$reg, $name, $date_insp, $data]);
    } else {
        formResponse(false, 'failed to fetch');
    }
}
mysqli_close($conn);
