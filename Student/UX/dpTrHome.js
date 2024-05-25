




// $('.addedsuc2').hide();
// $('.addedsuc').hide();


function getCurrentTimeInTimezone(timezone) {
    const now = new Date();
    const options = {
        timeZone: timezone,
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
    };
    return new Intl.DateTimeFormat('en-US', options).format(now);
}

$(document).ready(function () {

    getCurrentTimeInTimezone('Asia/Manila');

    const now = new Date();

    const hours = now.getHours();
    // const minutes = now.getMinutes();
    const lunch = 12;
    // const mornIn = 8;
    const aftIn = 13;
    const dismiss = 17;




    // if (!(hours >= lunch && hours < aftIn)) {

        setInterval(() => {

            if (hours >= lunch && hours < aftIn || hours >= dismiss) {
                time_out_dayEnd();

            }


        }, 1500);

    // }


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
    getAttendance()






    // script.js




    let isTimeInClicked = false;
    $('.refreshSomething').on('click', '#timein', function (e) {
        e.preventDefault();
        if (isTimeInClicked == false) {
            document.getElementById('timein').style.opacity = '50%';
            document.getElementById('timein').style.cursor = 'not-allowed';
            isTimeInClicked = true;
            time_in();

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
            $('.refreshSomething').html(response);
            $('.outlosdrmqrm').show();
        },
        complete: function () {
            setTimeout(() => {
                $('.outlosdrmqrm').hide();
            }, 1000);
        }
    });
}
function getAttendance() {
    $.ajax({
        type: "post",
        url: "../homeSection/getAttendance.php",
        contentType: false,
        processData: false,
        success: function (response) {
            $('.table-out').html(response);
        }
    });
}

function time_in() {
    $.ajax({
        type: "post",
        url: "../homeSection/deployedActionReq/time_in.php",
        contentType: false,
        processData: false,
        success: function (response) {
            getAttendance();
            refreshFrontPic();
        }
    });
}



function time_out_lunch() {
    $.ajax({
        type: "post",
        url: "../homeSection/deployedActionReq/time_out.php",
        contentType: false,
        processData: false,
        success: function (response) {
            getAttendance();
            refreshFrontPic();
        }
    });
}


function time_out_dayEnd() {
    $.ajax({
        type: "post",
        url: "../homeSection/deployedActionReq/time_out.php",
        contentType: false,
        processData: false,
        success: function (response) {
            response = response.trim();
            if (response) {
                refreshFrontPic();
                getAttendance();
            }
        }
    });
}
