<!DOCTYPE html>
<html lang="en">
<head>
    <title>Print report</title>
   
    <link rel="stylesheet" href="../../../../dist/style.css">
    <link rel="stylesheet" href="../../../templates/reports/print.css" media="print">
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
    <div class="container"><p class="print">Print</p></div>
    <div class="report__title flex-jc-aic"></div>
    <div class="report__container">
       
    </div>
</body>
<script>
    const display = document.querySelector('.report__container'),
    header = window.parent.document.querySelector('.app__header');
    content = window.parent.document.querySelector('.app__content'),
    borrowedTitle = window.parent.document.querySelector('.profile_text').textContent,
    printBtn = document.querySelector('p.print'),
    title = document.querySelector('.report__title');


    //node clones from parent root doc
    headerClone = document.importNode(header, true);
    contentClone = document.importNode(content, true);
    
    title.textContent = borrowedTitle;
    
    display.appendChild(headerClone);
    display.appendChild(contentClone);
    const allRows = document.querySelectorAll('tr.data');
    allRows.forEach(row => {
        let cells = row.querySelectorAll('td');
        cells.forEach(cell => {
            if (cell.innerHTML.includes('<mark>')) {
                cell.innerHTML = cell.textContent;
            }
        });
    });

    printBtn.addEventListener('click', () => {
        // document.querySelector('.app__header').style.top = '0';
        window.print();
    });
    // display.appendChild(content);

    


    
</script>
</html>