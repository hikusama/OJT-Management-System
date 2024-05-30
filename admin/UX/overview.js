


let loadingScreen = $(".outlosd");


// $('.addedsuc2').hide();
// $('.addedsuc').hide();
let suprevId, userId, fn, query = '';
let fnameec, lnameec, mnameec, positionec, departmentec, roomec, gnec;

let searchQuery = "%" + query + "%";





$(document).ready(function () {
    $('.loadingScprf').show();
    $.ajax({
        type: "post",
        url: "../pannelparts/getForProf.php",
        contentType: false,
        processData: false,
        success: function (response) {
            $('.profsideCont').html(response);
        },
        complete: function () {
            setTimeout(() => {
                $('.loadingScprf').hide();
            }, 1000);
        }
    });








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
    let studval, trval;

    const yValues = [studval,  trval];
    const xValues = ["Students", "Trainee"];
    const barColors = [
        "rgb(0, 191, 224)",
        "rgb(151, 35, 0)"
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
                
                    case 'trainees':
                        trval = response;
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
                fetchDataAndUpdate('../overviewSection/alluser/traineeCount.php', 'trainees');
                if ((studval,  trval) != undefined) {
                    console.log('good');
                    updateChart([studval, trval])
                }
            }, 1000);

        }
    }







    userCount();










    let statusButtonClicked = 'fStudent';
    let currentState = 'fStudent';

    getStatus('../overviewSection/status/getStudentsStatus.php', 'students');
    $('#' + statusButtonClicked).addClass('on-status-button');
    $('.loadingSc').show();

    $('.headStatus button').click(function (e) {
        $('.headStatus button').removeClass('on-status-button'); // Remove class from all buttons
        $(this).addClass('on-status-button'); // Add class to the clicked button
        e.preventDefault();
        statusButtonClicked = $(this).attr('id');
        if (currentState !== statusButtonClicked) {
            $('.loadingSc').show();
            currentState = statusButtonClicked;
            if (statusButtonClicked === 'fStudent') {
                getStatus('../overviewSection/status/getStudentsStatus.php', 'students');
            } else if (statusButtonClicked === 'fTrainees') {
                getStatus('../overviewSection/status/getTraineesStatus.php', 'trainees');
            } 
        }
    });








    function getStatus(url, table) {
        formData = new FormData();
        formData.append('table', table)
        $.ajax({
            url: url,
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('.status-content-inner').html(response);
            },
            complete: function () {
                setTimeout(() => {
                    $('.loadingSc').hide();
                }, 1800);

            }
        });
    }


    // ----------------------------logout--------------------------




    let isLoginClicked = false;
    $('#logoutClick').click(function (e) {
        e.preventDefault();
        if (isLoginClicked == false) {
            $('.loggingoutVer').show();
            $('#overlayform2').show();
            $('.loggingoutVer h2').hide();
            isLoginClicked = true;
            if (handleDeviceWidth()) {
                checkbox.checked = false;
                handleCheckboxChange();
            }
        }

    });






    $('#yes').hover(function () {
        $('.loggingoutVer').addClass('hovered');
    }, function () {
        $('.loggingoutVer').removeClass('hovered');
    });

    $('#no').hover(function () {
        $('.loggingoutVer').addClass('hovered2');
    }, function () {
        $('.loggingoutVer').removeClass('hovered2');
    });


    $('#yes').click(function (e) {
        e.preventDefault();
        $('.loggingoutVer').addClass('hovered3');
        $('.loggingoutVer .buttonSec').hide();
        $('.loggingoutVer h2').show();
        setTimeout(function () {
            window.location.href = "../pannelparts/logout.php";
        }, 5000);
    });


    $('#no').click(function (e) {
        e.preventDefault();
        $('.loggingoutVer').hide();
        $('#overlayform2').hide();
        isLoginClicked = false;
    });



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




