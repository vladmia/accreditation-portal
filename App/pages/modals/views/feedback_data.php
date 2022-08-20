<!DOCTYPE html>
<html lang="en">
<head>
    <title>Print report</title>
   
    <link rel="stylesheet" href="../../../../dist/style.css">
    <link rel="stylesheet" href="../../../templates/reports/print.css" media="print">
    <script src="../../../fontAwesome/all.js" crossorigin="anonymous"></script>
    
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body {
            position: relative;
        }
    </style>
</head>
<body>
    <div class="container"><p class="print feedback"><i class="fa fa-print"></i> print</p></div>
    <div class="report__title flex-col-sbaic feedback">
        <p class="main__title flex-jc-aic">Inspection Feedback</p>
        <div class="nurs__details flex-sb-aic">
            <p><label>Nursery Name: </label><span class="nurs__name"></span></p>
            <p><label>Reg. No.: </label><span class="reg_num"></span></p>
        </div>
    </div>
    <div class="report__container feedback flex-col">
    </div>
</body>
<script src="../../../js/script.js"></script>
<script>
    const printBtn = document.querySelector('p.print'),
          headerContent = window.parent.document.querySelector('span.app_id').textContent;

    printBtn.addEventListener('click', () => {
        // document.querySelector('.app__header').style.top = '0';
        window.print();
    });
    
    if(headerContent) {
        acquireFeedback(headerContent);
    }
</script>
</html>