




// $('.addedsuc2').hide();
// $('.addedsuc').hide();



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
    refreshFrontPic();







// script.js

let startTime;
let elapsedTime = 0;
let timerInterval;

function timeToString(time) {
    let diffInHrs = time / 3600000;
    let hh = Math.floor(diffInHrs);

    let diffInMin = (diffInHrs - hh) * 60;
    let mm = Math.floor(diffInMin);

    let diffInSec = (diffInMin - mm) * 60;
    let ss = Math.floor(diffInSec);

    let formattedHH = hh.toString().padStart(2, "0");
    let formattedMM = mm.toString().padStart(2, "0");
    let formattedSS = ss.toString().padStart(2, "0");

    return `${formattedHH}:${formattedMM}:${formattedSS}`;
}
print('00:00:00');

function print(txt) {
    $('.timestamp').html(txt);
}




    let isTimeInClicked = false;
    $('.attendanceButton').on('click', '#timein', function (e) {
        e.preventDefault();
        if (isTimeInClicked == false) {
            document.getElementById('timein').style.opacity = '50%';
            document.getElementById('timeout').style.opacity = '1'; isTimeInClicked = true;
            isTimeInClicked = true;
            startTime = Date.now() - elapsedTime;
            timerInterval = setInterval(function() {
                elapsedTime = Date.now() - startTime;
                print(timeToString(elapsedTime));
            }, 1000);

            // $.ajax({
            //     type: "POST",
            //     contentType: "application/json; charset=utf-8",
            //     dataType: "dataType",
            //     url: "url",
            //     data: "data",
            //     success: function (response) {
                    
            //     }
            // });
        }


    });


    $('.attendanceButton').on('click', '#timeout', function (e) {
        e.preventDefault();
        if (isTimeInClicked == true) {
            document.getElementById('timeout').style.opacity = '50%';
            document.getElementById('timein').style.opacity = '1';
            isTimeInClicked = false;
            clearInterval(timerInterval);
            print('00:00:00');
            elapsedTime = 0;
        }




    });


    $('#req').click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "../homeSection/homeActionReq/reqForTrainee.php",
            success: function (response) {
                $('.yrnot').html(response);
            }
        });
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




    let isLoginClicked = false;

    $('#logoutClick').click(function (e) {
        e.preventDefault();
        if (isLoginClicked == false) {

            const checkbox = document.getElementById('sideCheck');

            $('.loggingoutVer').show();
            $('#overlayform2').show();
            $('#overlayform').hide();
            $('.loggingoutVer h2').hide();
            isLoginClicked = true;
            $('#cont-addstudents').hide();
            $('#cont-viewinform').hide();
            $('#cont-confirmforedit').hide();
            $('#cont-editform').hide();
            $('#cont-removeform').hide();
            $('#addedsuc2').hide();
            $('#addedsuc').hide();
            $('.responseMssg-out').hide();
            $('#cont-addCourse').hide();
            $('#asdads').hide();
            if (handleDeviceWidth()) {
                checkbox.checked = false;
                handleCheckboxChange();
            } else {
                checkbox.checked = true;
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




function refreshFrontPic() {
    $.ajax({
        type: "post",
        url: "../homeSection/deployedActionReq/checkAttendance.php",
        contentType: false,
        processData: false,
        success: function (response) {
            $('.fDp').html(response);
            $('.outlosdrmqrm').show();
        },
        complete: function () {
            setTimeout(() => {
                $('.outlosdrmqrm').hide();
            }, 1000);
        }
    });
}