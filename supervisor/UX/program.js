











$(document).ready(function () {




    document.querySelector(".progHead > *").style.background = "transparent";

let currState;

$('#allReq').click(function (e) { 
    e.preventDefault();
    if (currState != 'allreq') {
        getUi('allReq','repReq','apprvReq','rejReq',);

        currState = 'allreq';
    }
});


 
$('#repReq').click(function (e) { 
    e.preventDefault();
    if (currState != 'repReq') {
        getUi('repReq','allReq','apprvReq','rejReq',);
     
        


        currState = 'repReq';

    }
    
});




$('#apprvReq').click(function (e) { 
    e.preventDefault();

    if (currState != 'apprvReq') {
        getUi('apprvReq','repReq','allReq','rejReq',);
     
        

        currState = 'apprvReq';

    }
});




$('#rejReq').click(function (e) { 
    e.preventDefault();
    if (currState != 'rejReq') {
        getUi('rejReq','repReq','apprvReq','allReq',);
        

        currState = 'rejReq';

    }
});




function getUi(idTostyle,mt1,mt2,mt3) {
    document.getElementById(idTostyle).style.background = "rgba(179, 179, 179, 0.377)";
    document.getElementById(mt1).style.background = "transparent";
    document.getElementById(mt2).style.background = "transparent";
    document.getElementById(mt3).style.background = "transparent";


}


function getAllTaskReq() {
    $.ajax({
        type: "POST",
        url: '../programSection/programActionReq/getAllTask.php',
        success: function (response) {
            $('.program-cont').html(response);
        }
    });
}


function getReportedTaskReq() {
    $.ajax({
        type: "POST",
        url: '../programSection/programActionReq/getReportedTaskReq.php',
        success: function (response) {
            $('.program-cont').html(response);
        }
    });
}



function getApprovedTaskReq() {
    $.ajax({
        type: "POST",
        url: '../programSection/programActionReq/getApprovedTaskReq.php',
        success: function (response) {
            $('.program-cont').html(response);
        }
    });
}




function getRejectedTaskReq() {
    $.ajax({
        type: "POST",
        url: '../programSection/programActionReq/getRejectedTaskReq.php',
        success: function (response) {
            $('.program-cont').html(response);
        }
    });
}





























    
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


    $('#showRq').click(function (e) {
        e.preventDefault();
        $('#cont-confirmforedit').show();
        $('#overlayform').show();

    });

    $('#overlayform').click(function (e) {
        e.preventDefault();
        $(this).hide();
        $('#cont-confirmforedit').hide();
        $('#cont-editform').hide();


    });

    $("#overlayform").click(function (e) {
        e.preventDefault();
        $(this).hide();
        $("#cont-removeform").hide();
        $('#cont-viewinform').hide();
    });


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

    $('.responseMssg-out').click(function (e) {
        e.preventDefault();
        $(this).hide();
        $('#overlayform2').hide();
        $('#overlayform1').hide();
    });
    $("#overlayform2").click(function (e) {
        e.preventDefault();
        if (isLoginClicked == false) {
            $(this).hide();
            $('#cont-editform').hide();
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

function handleDeviceWidth() {
    const deviceWidth = window.innerWidth;
    if (deviceWidth <= 665) {
        return true;
    } else {
        return false;
    }
}