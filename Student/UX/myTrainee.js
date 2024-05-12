









$(document).ready(function () {



    $('.outlosdEnr').show();
    getMyTrainee();



    // $('#add_course_package').click(function (e) { 


    $.ajax({
        type: "post",
        url: "../pannelparts/getForProf.php",
        contentType: false,
        processData: false,
        success: function (response) {
            $('.profsideCont').html(response);
        },
        complete: function () {

        }
    });



    // -----------------------SEARCH TRAINEE----------------
    $('#searchTrainee').submit(function (e) {
        e.preventDefault();
        let query = $('#searchTr').val();
        let searchQuery = "%" + query + "%";
        $('.outlosdEnr').show();
        $.ajax({
            method: "GET",
            url: "../myTraineeSection/myTraineeActionReq/getMyTrainee.php",
            data: { query: searchQuery },
            success: function (response) {
                $('#searchResults').html(response);
            },
            complete: function () {
                $('.outlosdEnr').hide();
                $('.outlosdEnr').hide();

            }
        });
    });













    $('#overlayform2').click(function (e) {
        e.preventDefault();
        $('#cont-confirmforedit').hide();
        $('#overlayform2').hide();
        $('.responseMssg-out').hide();
        $('#cont-confirmforedit').hide();

    });





    $("#mytr").on("click", "#men", function (e) {
        e.preventDefault();
        const hasClass = $(this).closest("li").find(".grupi").hasClass("grupiNew");

        $("#mytr .grupi").removeClass("grupiNew");

        $(this).closest("li").find(".grupi").addClass("grupiNew");

        if (hasClass) {
            $(this).closest("li").find(".grupi").removeClass("grupiNew");
        }
    });




    $("#mytr").on("click", ".showact .act3", function (e) {
        e.preventDefault();
        let formData = new FormData();
        let imgSrc = $(this).closest("li").find(".pfront img").attr('src');
        let catchid = $(this).attr('id');
        let valueBeforeN = catchid.substring(3);

        let studentsId = parseInt(valueBeforeN);
        console.log(" before N:" + valueBeforeN);
        console.log(studentsId);
        formData.append('imgdp', imgSrc);
        formData.append('spid', studentsId);

        $.ajax({
            url: "../myTraineeSection/myTraineeActionReq/viewinfoMytr.php",
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



    let studentsId;
    let nameStud;

    $("#mytr").on("click", ".showact .act2", function (e) {

        $('#cont-confirmforedit').show();
        $('#overlayform').show();

        let catchid = $(this).closest("li").find(".showact .act3").attr('id');
        let valueBeforeN = catchid.substring(3);
        studentsId = parseInt(valueBeforeN);
        nameStud = $(this).closest("li").find(".profCred h3").html();

    });


    $('.responseMssg-out').click(function (e) {
        e.preventDefault();
        $(this).hide();
        $('#overlayform2').hide();
        $('#cont-confirmforedit').hide();
        $('.responseMssg-out').hide();

    });
    $("#overlayform").click(function (e) {
        e.preventDefault();
        $(this).hide();
        $('#cont-confirmforedit').hide();
        $('#cont-viewinform').hide();
        $('.responseMssg-out').hide();

    });




    // -----------------------Verification------------------

    $('#editformreq').submit(function (event) {
        event.preventDefault();
        let formData = new FormData();
        $('.outlosdrmqrm').show();
        formData.append('conftopass', $('#conftopass').val());
        formData.append('studId', studentsId);
        $.ajax({
            url: '../myTraineeSection/myTraineeActionReq/updateVerification.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#reqeditresponse').html(response);
                editReqGrantedRespone = response;
            },
            complete: function () {
                console.log(editReqGrantedRespone);
                if (editReqGrantedRespone === "You Are Verified") {
                    $('#cont-confirmforedit').hide();
                    $('#overlayform').hide();
                    $('#overlayform2').show();
                    $('#cont-confirmforedit').hide();
                    $('.responseMssg-out').show();
                    $('.responseMssg-out h3').html(`Student named '${nameStud}' Dropped Successfully!`);
                    getMyTrainee();
                }
                $('.outlosdrmqrm').hide();

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




function getMyTrainee() {
    $.ajax({
        method: "GET",
        url: "../myTraineeSection/myTraineeActionReq/getMyTrainee.php",
        success: function (response) {
            $('#searchResults').html(response);
        },
        complete: function () {
            $('.outlosdEnr').hide();

        }
    });
}