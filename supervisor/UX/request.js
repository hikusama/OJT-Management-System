







$(document).ready(function () {

    $('.outlosdEnr').show();
    setTimeout(() => {
        $('.outlosdEnr').hide();

    }, 2000);


    getTrReq();
    getRecords();
    countMyTr();








    $("#request").on("click", "#view", function (e) {
        e.preventDefault();
        let formData = new FormData();
        let imgSrc = $(this).closest("li").find(".profCred img").attr('src');
        let catchid = $(this).closest("li").find(".profCred").attr('id');
        let valueBeforeN = catchid.substring(3);
        $("#cont-viewinform").show();
        $('#overlayform').show();
        let studentsId = parseInt(valueBeforeN);
        // console.log(" before N:" + valueBeforeN);
        // console.log(studentsId);
        formData.append('imgdp', imgSrc);
        formData.append('spid', studentsId);

        $.ajax({
            url: '../requestSection/requestActionreq/viewinfo.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $("#cont-viewinform").html(response);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                console.error("Status: " + status);
                console.error("Error: " + error);
            },
            complete: function () {
                $('.outlosdviewinfo').show();

                setTimeout(() => {
                    $('.outlosdviewinfo').hide();

                }, 2000);
                if ($("#cont-viewinform")) {

                    let prp = $("#vinfo");

                    if (imgSrc) {
                        prp.attr('src', imgSrc);
                    }
                    $("#overlayform").show();
                    $("#cont-removeform").hide();
                    $("#cont-confirmforedit").hide();
                    $("#cont-viewinform").show();
                }
            }
        });

    });






    // --------------------event Request---------
    let reqId, studentsIdReq,isReqAdmit,nameStud;
    
    $("#request").on("click", "#admit", function (e) {
        e.preventDefault();
        isReqAdmit = true;
        let catchid = $(this).closest("li").find(".profCred").attr('id');
        nameStud = $(this).closest("li").find(".profCred h3").html();
        let valueBeforeN = catchid.substring(3);
        studentsIdReq = parseInt(valueBeforeN);
        nIndex = catchid.indexOf('n');
        valueAfterN = catchid.slice(nIndex + 1);
        reqId = parseInt(valueAfterN);
        $('#cont-confirmforedit').show();
        $('#overlayform').show();


    });

    $("#request").on("click", "#reject", function (e) {
        e.preventDefault();
        isReqAdmit = false;
        let catchid = $(this).closest("li").find(".profCred").attr('id');
        nameStud = $(this).closest("li").find(".profCred h3").html();
        let valueBeforeN = catchid.substring(3);
        studentsIdReq = parseInt(valueBeforeN);
        nIndex = catchid.indexOf('n');
        valueAfterN = catchid.slice(nIndex + 1);
        reqId = parseInt(valueAfterN);
        $('#cont-confirmforedit').show();
        $('#overlayform').show();
    });

    $('#editformreq').submit(function (event) {
        event.preventDefault();
        let formData = new FormData();

        $('.outlosdrmqrm').show();

        if (isReqAdmit == true) {
            formData.append('reqFrom', 'Admit');
        }else {
            formData.append('reqFrom', 'Reject');
        }
        formData.append('reqId', reqId);
        formData.append('conftopass', $('#conftopass').val());
        formData.append('studId', studentsIdReq);
        formData.append('studId', studentsIdReq);

        $.ajax({
            url: '../requestSection/requestActionreq/verification.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#reqeditresponse').html(response);
                editReqGrantedRespone = response.trim();
            },
            complete: function () {
                console.log(editReqGrantedRespone);
                if (editReqGrantedRespone === "You Are Verified") {
                    $('#cont-confirmforedit').hide();
                    $('#overlayform').hide();
                    $('#overlayform2').show();
                    $('#cont-confirmforedit').hide();
                    $('.responseMssg-out').show();
                    if (isReqAdmit == true) {
                        document.querySelector('.responseMssg-out h3').style.color = "white";
                        $('.responseMssg-out h3').html(`Trainee named '${nameStud}' Admitted Successfully!`);
                    }else {
                        document.querySelector('.responseMssg-out h3').style.color = "red";
                        $('.responseMssg-out h3').html(`Trainee named '${nameStud}' Rejected Successfully!`);
                    }
                    getTrReq();
                    getRecords();
                    countMyTr();
                }
                $('.outlosdrmqrm').hide();

            }
        });

    });



    $('.dashEme').on('click', '#fetch', function (e) {
        e.preventDefault();
        getTrReq();
        
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


function getTrReq() {
    $('.outlosdEnr').show();
    $.ajax({
        method: "GET",
        url: "../requestSection/getTraineeRequest.php",
        success: function (response) {
            $('.contReq').html(response);
        },
        complete: function () {
            $('.outlosdEnr').hide();

        }
    });

}

function countMyTr() {
    $.ajax({
        type: 'post',
        url: "../requestSection/requestActionreq/getTrCount.php",
        success: function (response) {
            $('.dasheme-inner').html(response);
        }
    });
}
function getRecords() {
    $.ajax({
        type: 'post',
        url: "../requestSection/requestActionreq/getRecordReq.php",
        success: function (response) {
            $('.records').html(response);
        }
    });
}