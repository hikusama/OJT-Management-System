











$(document).ready(function () {






    $('.program-cont').on('click', '#showReportForm', function () {
        $('.form_prog_out').show();
        $('#overlayform2').show();
        isLoginClicked = false;
    });



    $('#program').on('click', '#vrep', function (e) {
        e.preventDefault();
        $('.frame_outer').show();
        repid = $(this).attr('class')
        repid = parseInt(repid);
        viewMyRep(repid);
    });
    $('#program').on('click', '#bc', function (e) {
        e.preventDefault();
        $('.frame_outer').hide();

    });













    $('#cancelReport').click(function (e) {
        e.preventDefault();
        $('.form_prog_out').hide();
        $('#overlayform2').hide();
        isLoginClicked = false;
    });


    $('#submitFormReport').submit(function (e) {
        e.preventDefault();

        console.log('hello');
        formData = new FormData()
        formData.append('img', $('#img')[0].files[0]);
        formData.append('title', $('#title').val());
        formData.append('place', $('#place').val());
        formData.append('time_acquired', $('#time_acquired').val());
        formData.append('narrative', $('#narrative').val());

        $.ajax({
            type: "post",
            url: "../programSection/submitReport.php",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#submitReportResponseMsg').html(response);
                response = response.trim()
                if (response == 'success') {
                    $('#submitReportResponseMsg').html('');
                    $('.responseMssg-out').show();
                    $('.form_prog_out form input').val('');
                    $('.form_prog_out form textarea').val('');
                    $('.form_prog_out').hide();
                    isLoginClicked = false;
                    getReports("../programSection/programActionReq/getAllReportReq.php");

                }
            }
        });




    });


    let currState;
    getReports("../programSection/programActionReq/getAllReportReq.php");

    $('#allReq').click(function (e) {
        e.preventDefault();
        if (currState != 'allreq') {
            getUi('allReq', 'repReq', 'apprvReq', 'rejReq',);
            getReports("../programSection/programActionReq/getAllReportReq.php");
            currState = 'allreq';
        }
    });



    $('#apprvReq').click(function (e) {
        e.preventDefault();

        if (currState != 'apprvReq') {
            getUi('apprvReq', 'repReq', 'allReq', 'rejReq',);
            getReports("../programSection/programActionReq/getApprovedReportReq.php");



            currState = 'apprvReq';

        }
    });



    $('#repReq').click(function (e) {
        e.preventDefault();
        if (currState != 'repReq') {
            getUi('repReq', 'allReq', 'apprvReq', 'rejReq',);
            getReports("../programSection/programActionReq/getPendingReportReq.php");




            currState = 'repReq';

        }

    });







    $('#rejReq').click(function (e) {
        e.preventDefault();
        if (currState != 'rejReq') {
            getUi('rejReq', 'repReq', 'apprvReq', 'allReq',);
            getReports("../programSection/programActionReq/getRejectedReportReq.php");


            currState = 'rejReq';

        }
    });




    function getUi(idTostyle, mt1, mt2, mt3) {
        $('#' + idTostyle).addClass('on_select_rep');
        $('#' + mt1).removeClass('on_select_rep');
        $('#' + mt2).removeClass('on_select_rep');
        $('#' + mt3).removeClass('on_select_rep');
        // document.getElementById(idTostyle).classList.add;
        // document.getElementById(mt1).style.background = "transparent";
        // document.getElementById(mt2).style.background = "transparent";
        // document.getElementById(mt3).style.background = "transparent";


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
            $('.form_prog_out').hide();
            $('.responseMssg-out').hide();

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



function getReports(urlSend) {
    $('.program-inner .outlosdrmqrm').show();

    $.ajax({
        type: "post",
        url: urlSend,
        contentType: false,
        processData: false,
        success: function (response) {
            $('.program-cont').html(response);
        }, complete: function () {

            setTimeout(() => {
                $('.program-inner .outlosdrmqrm').hide();

            }, 500);
        }
    });
}

function viewMyRep(repid) {

    formData = new FormData()
    formData.append('repid', repid)
    $('.frame_outer .outlosdrmqrm').show();
    
    $.ajax({
        type: "post",
        url: '../programSection/programActionReq/view.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            $('#frame').html(response);
            $('.frame_outer .outlosdrmqrm').show();
        }, complete: function () {
            setTimeout(() => {
                $('.frame_outer .outlosdrmqrm').hide();
            }, 500);
        }
    });
}