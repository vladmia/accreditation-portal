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
    <div class="container"><p class="print feedback cert"><i class="fa fa-print"></i><code> print/save</code></p></div>

    <div class="report__container cert flex-jc-aic">
        <div class="corner one flex-jc-aic">
            <div class="tiny"></div>
        </div>
        <div class="corner two flex-jc-aic">
             <div class="tiny"></div>
        </div>
        <div class="corner three flex-jc-aic">
             <div class="tiny"></div>
        </div>
        <div class="corner four flex-jc-aic">
             <div class="tiny"></div>
        </div>

        <!-- <div class="water__mark one"></div> -->
        <div class="water__mark two"></div>
        <div class="water__mark three"></div>
        <div class="cert__data flex-col">
        <p class="reg"><span>Reg. No: </span><code></code></p>
        <div class="certifying__body flex">
            <div class="kefri__logo"></div>
            <p class="name">KENYA FORESTRY RESEARCH INSTITUTE</p>
        </div>
        <div class="cert__title"><p class="title">Nursery Certification</p></div>

        <div class="date"></div>
        <div class="awardee__details flex-col">
            <p class="title">
            This certificate is awarded to:
            </p>
            <p class="nursery__owner">
                
            </p>
            <p class="additionals">
                For meeting quality nursery certification standards on their nursery, 
            </p>
            <p class="nursery__name"></p>
        </div>
        <div class="signed__by flex-col">
            <p class="signature"></p>
            <p class="director__info flex">
               <code> Director,<br>
                KEFRI</code>
            </p>
        </div>
        </div>

        <div class="honoraries flex-col">
            <div class="badge"></div>
            <div class="rating flex-jc-aic"></div>
            <div class="verified"><code>KEFRI has confirmed the identity of this individual and their tree nursery.</code></div>
        </div>

    </div>
</body>
<script src="../../../js/script.js"></script>
<script>
    
    const printBtn = document.querySelector('p.print'),
          owner = document.querySelector('p.nursery__owner'),
          dateAwarded = document.querySelector('.date'),
          nursName = document.querySelector('p.nursery__name'),
          badgeClass = document.querySelector('.honoraries .badge'),
          reg = document.querySelector('p.reg code'),
          rating = document.querySelector('div.rating');
    let datePicked = null,
        ownerPicked = null,
        nurseNamePicked = null,
        classPicked = null,
        regPicked = null;

        if (window.parent.document.querySelector('.app__table tr.data.selected')) {
            let faIcons = "";
            datePicked = window.parent.document.querySelector('.app__table tr.data.selected td.column6').textContent,
            ownerPicked = window.parent.document.querySelector('.app__table tr.data.selected td.column7').textContent,
            nursNamePicked = window.parent.document.querySelector('.app__table tr.data.selected td.column2').textContent,
            classPicked = window.parent.document.querySelector('.app__table tr.data.selected td.column5').textContent,
            regPicked = window.parent.document.querySelector('.app__table tr.data.selected td.column1').textContent,
            ratingPicked = window.parent.document.querySelector('.app__table tr.data.selected td.column4').textContent.split("-")[0];
            // owner = window.parent.document.querySelector('.app__table tr.data.selected td.column6').textContent;

            if (classPicked == '1') {
                badgeClass.classList.add('class-1')
            } else if (classPicked == '2') {
                badgeClass.classList.add('class-2')
            } else if (classPicked == '3') {
                badgeClass.classList.add('class-3')
            } else {
                null;
            }

            for (let i = 0; i < parseInt(ratingPicked); i++) {
                faIcons += "<i class=\"fa fa-star active\"></i>";
            }

            rating.innerHTML = faIcons;

            owner.textContent = ownerPicked;
            dateAwarded.textContent = datePicked;
            nursName.textContent = nursNamePicked;
            reg.textContent = regPicked;
        }
    

    printBtn.addEventListener('click', () => {
        // document.querySelector('.app__header').style.top = '0';
        window.print();
    });
   


</script>
</html>
