

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link
      rel="icon"
      type="image/png"
      sizes="32x32"
      href="../../images/favicon.svg"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="print.css" media="print">
    <title>OTNA reports</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            position: relative;
            height: 100vh;
            font-family: 'Poppins', sans-serif, serif;
            font-size: 11px;

        }
        form {
            margin-top: 20px;
        }
        form button {
            padding: 5px 10px;
            background: green;
            border-radius: 5px;
            border: none;
            margin-left: 20px;
            color: #fff;
            cursor: pointer;
        }
        form button:hover {
            background: brown;
            color: #ddd;
        }

        h2 {
            margin-top: 20px;
            color: rgba(39, 14, 14, 0.8);
        }
        table {
            padding: 20px;
           border-spacing: 0 5px;
           min-width: 70%;


        }

        table tr {
            padding: 10px 0;
            height: 30px;

        }


        table tr:nth-child(even) {
            background: rgba(102, 95, 95, 0.282);
        }

        table th {
            width: auto;
            padding: 5px 2px;
            position: relative;
            color: #333;
            text-align: center;
            font-weight: 600;
            /* width: 200px; */


        }

        table th:after {
            content: '';
            width: 60%;
            position: absolute;
            border-bottom: 2px solid #888;
            bottom: 0;

            left: 20%;
            /* margin: 0px auto; */
        }


        table td {
            text-align: left;
            padding: 0px 20px;
        }

        span.count {
            background: #333;
            color: white;
            padding: 3px 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-right: 50px;
            margin-top: 50px;
            border-radius: 5px;
            /* position: absolute; */


        }
        span.count span {
            font-size: 1.5rem;
            color: #fff;
            font-weight: 400;
            margin-left: 10px;
            top: 50%;
            /* padding: 4px;
            border-radius: 50%;
            border:none;
            background: #fff;
            color: green; */
        }

        .mobileShowMe {
            display: none;
        }
        div.container {
            position: relative;
            width: 80%;
        }

        div.container .print {
            position: absolute;
            right: -20px;
            top: 20%;
            width: 50px;
            height: 50px;
            border: none;
            box-shadow: 0px 0px 6px rgba(20, 20, 20, 0.5);
            border-radius: 50%;

            /* padding: 5px 15px; */
            /* background: green;
            outline: none;
            border: none;
            border-radius: 5px;
            color: #ddd; */
            background-image: url('../../images/printer.png');
            background-size: cover;
            cursor: pointer;
        }

        div.container .print:hover {
            box-shadow: 0px 0px 8px rgba(188,93,44,1);
            transition: .4s ease-out;
        }

        div.countContain {
            width: 100%;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            position: absolute;
            bottom: 0;
        }

    </style>
</head>
<body>

<div class="container">
<form action="reportsTemp.php" method="post">
    <label for="reportSelect">Select Report to Print</label>
    <select name="report" id="reportSelect" required>
        <option value="" selected hidden disabled>--</option>
        <option value="certified">Certified nurseries</option>
        <option value="rejected">Rejected applications</option>
        <option value="inspected">Inspected applications</option>
        <option value="assigned">Assigned applications</option>
        <option value="unassigned">Unassigned applications</option>
        <option value="all">All applications</option>
        <option value="inspectors">Inspectors list</option>
        <option value="owners">Nursery owners</option>
    </select>
    <button type="submit" name="select">Preview</button>

</form>
    <button onclick="window.print()" class="print"></button>
</div>



<?php
include '../../config/connection.php'; // connection

if (isset($_POST['select'])) {
    $selection = mysqli_real_escape_string($conn, $_POST['report']);
    $header = "";
    $sql = "";
    if ($selection == 'certified') {
        $sql = "SELECT * FROM nursery NATURAL JOIN nursery_details NATURAL JOIN applications NATURAL JOIN evaluator_assignment NATURAL JOIN inspection WHERE applications.status = 'certified' ORDER BY applications.application_id DESC
          ";
        $header = 'Certified Applications';
        echo '<h2>' . $header . '</h2>';
        include 'showReportTableInspected.php';
    } elseif ($selection == 'rejected') {
        $sql = "SELECT * FROM nursery NATURAL JOIN nursery_details NATURAL JOIN applications NATURAL JOIN evaluator_assignment NATURAL JOIN inspection WHERE applications.status = 'rejected' ORDER BY applications.application_id DESC
          ";
        $header = 'Rejected Applications';
        echo '<h2>' . $header . '</h2>';
        include 'showReportTableInspected.php';
    } elseif ($selection == 'inspected') {
        $sql = "SELECT * FROM nursery NATURAL JOIN nursery_details NATURAL JOIN applications NATURAL JOIN evaluator_assignment NATURAL JOIN inspection WHERE evaluator_assignment.inspected = '1'";
        $header = 'Inspected Applications';
        echo '<h2>' . $header . '</h2>';
        include 'showReportTableInspected.php';
    } elseif ($selection == 'assigned') {
        $sql = "SELECT * FROM nursery NATURAL JOIN nursery_details NATURAL JOIN applications WHERE applications.assigned = '1' ORDER BY applications.application_id DESC";
        $header = 'Assigned Applications';
        echo '<h2>' . $header . '</h2>';
        include 'showReportTableAll.php';

    } elseif ($selection == 'unassigned') {
        $sql = "SELECT * FROM nursery NATURAL JOIN nursery_details NATURAL JOIN applications WHERE applications.assigned = '0' ORDER BY applications.application_id DESC";
        $header = 'Unassigned Applications';
        echo '<h2>' . $header . '</h2>';
        include 'showReportTableAll.php';
    } elseif ($selection == 'all') {
        $sql = "SELECT * FROM nursery NATURAL JOIN nursery_details NATURAL JOIN applications WHERE applications.application_id = nursery_details.nursery_id";
        $header = 'All Applications';
        echo '<h2>' . $header . '</h2>';
        include 'showReportTableAll.php';
    } elseif ($selection == 'inspectors') {
        $sql = "SELECT * FROM evaluators";
        $header = 'Inspectors List';
        echo '<h2>' . $header . '</h2>';
        include 'showTableTemplateInspectors.php';
    } elseif ($selection == 'owners') {
        $sql = "SELECT * FROM users";
        $header = 'Nursery Owners';
        echo '<h2>' . $header . '</h2>';
        include 'showTableTemplateOwners.php';
    }

}

?>



</body>
<script>
    let date = document.querySelectorAll('.date'),
        score = document.querySelectorAll('.score'),
        header= document.querySelector('h2'),
        myTableWidth = document.querySelector('table').offsetWidth,
        countContain = document.querySelector('.countContain');
    date.forEach(date => {
        date.innerText = date.innerText.split(' ')[0];
    });

    if (header.innerText == 'Inspectors List' || header.innerText == 'Nursery Owners') {
        let m = document.querySelector('.count span');
        m.innerText -= 1;
    }

    countContain.style.width = myTableWidth + 'px';

</script>
</html>
