


let loadingScreen = $(".outlosd");


// $('.addedsuc2').hide();
// $('.addedsuc').hide();
let suprevId, userId, fn, query = '';
let fnameec, lnameec, mnameec, positionec, departmentec, roomec, gnec;

let searchQuery = "%" + query + "%";





$(document).ready(function () {

    // countTo(studval, "studnum", 400000);
    // countTo(coorval, "coor", 400000);
    // countTo(trval, "trainees", 400000);
    // countTo(admins, "ad", 400000);












    const checkbox = document.getElementById('sideCheck');
    if (handleDeviceWidth()) {
        checkbox.checked = false;
        handleCheckboxChange();
    }





    const storedCheckboxState = localStorage.getItem('checkboxState');
    if (storedCheckboxState === 'checked') {
        checkbox.checked = true;
        document.body.classList.add('newAll');
    } else if (storedCheckboxState === 'unchecked') {
        checkbox.checked = false;
        document.body.classList.remove('newAll');
    }







    // $("#overview").show();

    // $('.lardgeSide').on('change', checkbox ,function (e) {
    //     e.preventDefault();
    //     handleCheckboxChange();
    // });


    // function select(sl) {
    //     return document.querySelector(sl);
    // }





    const currentDate = new Date();

    const year = currentDate.getFullYear();
    const month = currentDate.toLocaleString('en-US', { month: 'long' });
    const day = currentDate.getDate();
    const weekday = currentDate.toLocaleString('en-US', { weekday: 'long' });

    $('#year').html(year);
    $('#month').html(month);
    $('#day').html(day);
    $('#weekday').html(weekday);

    let activeRequests = 0, firstRun = 5;
    let studval, coorval, trval, admins;

    const yValues = [studval, coorval, trval, admins];
    const xValues = ["Students", "Trainee", "Coordinator", "Admin"];
    const barColors = [
        "rgb(0, 191, 224)",
        "rgb(151, 35, 0)",
        "rgb(0, 187, 140)",
        "rgb(104, 0, 165)"
    ];



    const myChart = new Chart("myChart", {
        type: "pie",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            title: {
                display: true,
                text: "Users"
            }
        }
    });

    /*
        -----------------------count users beybi-------------------
    */

    function fetchDataAndUpdate(url, targetElementId) {
        $.ajax({
            url: url,
            type: 'GET',
            beforeSend: function () {
                activeRequests++;
            },
            success: function (response) {
                $('#' + targetElementId).html(response);

                switch (targetElementId) {
                    case 'studnum':
                        studval = response;
                        break;
                    case 'coor':
                        coorval = response;
                        break;
                    case 'trainees':
                        trval = response;
                        break;
                    case 'ad':
                        admins = response;
                        break;
                    default:
                        break;
                }
            },
            // if (firstRun > 1) {
            //     countTo(response, targetElementId, 200000);
            // } else {

            complete: function () {
                activeRequests--;
            }
        });
    }

    function updateChart(newData) {
        myChart.data.datasets[0].data = newData;
        myChart.update();
    }


    function userCount() {
        if (activeRequests === 0) {

            setInterval(function () {
                fetchDataAndUpdate('../overviewSection/alluser/studentCount.php', 'studnum');
                fetchDataAndUpdate('../overviewSection/alluser/coordinatorCount.php', 'coor');
                fetchDataAndUpdate('../overviewSection/alluser/traineeCount.php', 'trainees');
                fetchDataAndUpdate('../overviewSection/alluser/adminCount.php', 'ad');
                if ((studval, coorval, trval, admins) != undefined) {
                    console.log('good');
                    updateChart([studval, trval, coorval, admins])
                }
            }, 1000);

        }
    }







    userCount();










    $('.headStatus button').click(function (e) {
        e.preventDefault();
        statusButtonCliked = $(this).attr('id');
        if (statusButtonCliked == 'fStudent') {
            getStatus('../overviewSection/status/getStudentsStatus.php','students');
        }


    });







    function getStatus(url, table) {
        formData = new FormData();
        formData.append('table',table)
        $.ajax({
            url: url,
            type: 'post',
            data:formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('.status-content').html(response);
            },
            complete: function () {

            }
        });
    }






});









// ----------------------------gawang kamay mang inasal--------------------------




function handleDeviceWidth() {
    const deviceWidth = window.innerWidth;
    if (deviceWidth <= 665) {
        return true;
    } else {
        return false;
    }
}




function countTo(target, elementId, duration) {
    const element = document.getElementById(elementId);
    const increment = target / (duration / 1000);
    let current = 0;

    const intervalId = setInterval(() => {
        current += increment;
        if (current >= target) {
            clearInterval(intervalId);
            current = target;
        }
        element.innerHTML = Math.round(current);
    }, 1);
}


function handleCheckboxChange() {
    const checkbox = document.getElementById('sideCheck');

    if (checkbox.checked) {
        console.log('hello');
        document.body.classList.add('newAll');
        localStorage.setItem('checkboxState', 'checked');
    } else {
        document.body.classList.remove('newAll');
        localStorage.setItem('checkboxState', 'unchecked');
    }

}





