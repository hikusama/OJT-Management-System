









$(document).ready(function () {







    // $('#add_course_package').click(function (e) { 
    $('.outlosdEnr').show();

    refreshDisplayTrainee();

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



    // -----------------------SEARCH TRAINEE----------------
    $('#searchTrainee').submit(function (e) {
        e.preventDefault();
        let query = $('#searchTr').val();
        let searchQuery = "%" + query + "%";
        $('.outlosdEnr').show();

        $.ajax({
            method: "GET",
            url: "../enrollSection/enrollActionReq/searchTrainee.php",
            data: { search: searchQuery },
            success: function (response) {
                $('#searchResults').html(response);
            },
            complete: function () {
                $('.outlosdEnr').hide();
                $('.outlosdEnr').hide();

            }
        });
    });


    // ---------------------------SEARCH STUDENT NOT TRAINEE----------------------------
    $('#searchBySpec').submit(function (e) {
        e.preventDefault();
        let query = $('#searchStud').val();
        let searchQuery = "%" + query + "%";
        $('.loadli').show();
        $.ajax({
            method: "POST",
            url: "../enrollSection/enrollActionReq/notTrainee.php",
            data: { search: searchQuery },
            success: function (response) {
                $('#studContent').html(response);
            },
            complete: function () {
                $('.loadli').hide();
            }
        });
    });

    // ---------------------------SEARCH COURSE AS NOT TRAINEE----------------------------
    $('#searchGroup').submit(function (e) {
        e.preventDefault();
        let query = $('#searchCrs').val();
        let searchQuery = "%" + query + "%";
        $('.loadli').show();
        $.ajax({
            method: "POST",
            url: "../enrollSection/enrollActionReq/enrollSecGetCourse.php",
            data: { search: searchQuery },
            success: function (response) {
                $('#studContent').html(response);
            },
            complete: function () {
                $('.loadli').hide();
            }
        });

    });


    // ---------------------------SWITCH TO ENROLL ONLY ONE BY ONE ----------------------------

    $('#onebone').click(function (e) {
        e.preventDefault();
        $('.srSpec').show();
        $('.srGrp').hide();
        // $(".typeOfSearch form").attr('id', 'searchBySpec');
        if ($(this).hasClass('newenrollbutton')) {

        } else {
            $('#bygroup').removeClass('newenrollbutton');
            $(this).addClass('newenrollbutton');
        }
        if (clickCountReq == 2) {
            $('.loadli').show();
            clickCountReq = 3;

            $.ajax({
                type: "post",
                url: "../enrollSection/enrollActionReq/notTrainee.php",
                success: function (response) {
                    $('#studContent').html(response);
                    $('.loadli').show();

                }, complete: function () {
                    setTimeout(() => {
                        $('.loadli').hide();
                    }, 3000);
                }
            });
        }
    });



    // ---------------------------SWITCH TO ENROLL BY COURSE ----------------------------

    $('#bygroup').click(function (e) {
        // $(".typeOfSearch form").attr('id', 'searchGroup');
        $('.srSpec').hide();
        $('.srGrp').show();
        e.preventDefault();
        if ($(this).hasClass('newenrollbutton')) {

        } else {
            $('#onebone').removeClass('newenrollbutton');
            $(this).addClass('newenrollbutton');

        }
        if (clickCountReq == 3) {
            clickCountReq = 2;
            $('.loadli').show();

            $.ajax({
                type: "POST",
                url: "../enrollSection/enrollActionReq/enrollSecGetCourse.php",
                success: function (response) {

                    $('#studContent').html(response);
                    $('.loadli').show();
                },
                complete: function () {
                    setTimeout(() => {
                        $('.loadli').hide();
                    }, 3000);
                }
            });
        }
    });




    // ---------------------------SHOW SIDE BAR ----------------------------

    let clickCountReq = 1;
    let rightSidepane = document.getElementById('rightSidepane');
    $('#enrollStudent').click(function (e) {
        e.preventDefault();
        isGroupSearch = false;
        rightSidepane.style.transform = "translateX(0)"
        if (clickCountReq == 1) {
            $('.loadli').show();
            clickCountReq = 3;
            $.ajax({
                type: "post",
                url: "../enrollSection/enrollActionReq/notTrainee.php",
                success: function (response) {
                    $('#studContent').html(response);
                    $('.loadli').show();

                }, complete: function () {
                    setTimeout(() => {
                        $('.loadli').hide();
                    }, 3000);
                }
            });
        }

    });




    let course_id, stud_id, isGroup = false;
    let courseAdded, studentAdded;
    $("#studContent").on("click", ".ovCrs #add_course_package", function (e) {
        e.preventDefault();
        isGroup = true;
        let catchid = $(this).closest("section").find(".infoEnrl h4").attr('id');
        courseAdded = $(this).closest("section").find(".infoEnrl h4").html();
        catchid = catchid.substring(2);
        course_id = parseInt(catchid);
        $('#cont-confirmforedit').show();
        $('#overlayform2').show();
    });

    $("#studContent").on("click", ".ovCrs #add_course_ByOne", function (e) {
        e.preventDefault();
        isGroup = false;
        let catchid = $(this).closest("li").find(".infoNotEnroll h5").attr('id');
        studentAdded = $(this).closest("li").find(".infoNotEnroll h5").html();
        catchid = catchid.substring(2);
        stud_id = parseInt(catchid);
        $('#cont-confirmforedit').show();
        $('#overlayform2').show();
    });





    $('#overlayform2').click(function (e) {
        e.preventDefault();
        $('#cont-confirmforedit').hide();
        $('#overlayform2').hide();
        $('.responseMssg-out').hide();
    });



    $('#editformreq').submit(function (event) {
        event.preventDefault();
        let formData = new FormData();
        $('.outlosdrmqrm').show();

        formData.append('conftopass', $('#conftopass').val());
        if (isGroup == true) {
            formData.append('course_id', course_id);
        } else {
            formData.append('stud_id', stud_id);
        }

        $.ajax({
            url: '../enrollSection/enrollActionReq/updateVerification.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#reqeditresponse').html(response);
                editReqGrantedRespone = response;
            }, complete: function () {
                $('.outlosdrmqrm').hide();

                if (editReqGrantedRespone == 'You Are Verified') {
                    $('#conftopass').val('');
                    $('#reqeditresponse').html('');
                    $('#cont-confirmforedit').hide();
                    $('.responseMssg-out').show();
                    if (isGroup == true) {
                        $('.responseMssg-out h3').html(courseAdded + ' Enrolled Successfully');

                    } else {
                        $('.responseMssg-out h3').html(' Student named "' + studentAdded + '" Enrolled Successfully');
                    }
                    refreshDisplayTrainee();

                }
            }
        });
    });


    $("#students").on("click", "#men", function (e) {
        e.preventDefault();
        const hasClass = $(this).closest("li").find(".grupi").hasClass("grupiNew");

        $("#students .grupi").removeClass("grupiNew");

        $(this).closest("li").find(".grupi").addClass("grupiNew");

        if (hasClass) {
            $(this).closest("li").find(".grupi").removeClass("grupiNew");
        }
    });




    $("#students").on("click", ".showact .act3", function (e) {
        e.preventDefault();
        let formData = new FormData();
        let imgSrc = $(this).closest("li").find(".pfront img").attr('src');
        let catchid = $(this).closest("li").find(".showact .act2").attr('id');
        let nIndex = catchid.indexOf('n');
        let valueBeforeN = catchid.substring(3, nIndex);

        let studentsId = parseInt(valueBeforeN);
        console.log(" before N:" + valueBeforeN);
        console.log(studentsId);
        formData.append('imgdp', imgSrc);
        formData.append('spid', studentsId);

        $.ajax({
            url: '../studentSection/studentActionreq/viewinfo.php',
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

    let userId;
    let studentsId;

    // show delete form
    $("#students").on("click", ".showact .act2", function (e) {
        e.preventDefault();
        catchid = $(this).attr('id');
        nIndex = catchid.indexOf('n');
        valueBeforeN = catchid.substring(3, nIndex);
        valueAfterN = catchid.slice(nIndex + 1);
        studentsId = parseInt(valueBeforeN);
        userId = parseInt(valueAfterN);
        $("#overlayform").show();
        $("#cont-removeform").show();
        $("#cont-viewinform").hide();
    });


    // Deleting traineee 
    $('#rmformreq').submit(function (event) {
        event.preventDefault();
        let formData = new FormData();
        $(".outlosdrm").show();
        formData.append('password', $('#pwdd').val());
        formData.append('studentsId', studentsId);
        isreadyrem = true;
        $.ajax({
            url: '../enrollSection/enrollActionReq/delete.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#responsetodel').html(response);
                removeResponse = response;
            },
            complete: function () {

                if (removeResponse == 'success') {
        $("#overlayform").hide();
                    $("#cont-removeform input").val('');
                    $("#cont-removeform").hide();
                    $("#overlayform2").show();
                    $('.responseMssg-out').show();
                    $('.responseMssg-out h3').html('Trainee deleted successfully!');
                    refreshDisplayTrainee();

                }
                setTimeout(() => {
                    document.getElementById('delG').style.transform = 'translateX(0)';
                    $(".outlosdrm").hide();
                }, 2000);
            }

        });
    });










    $('.responseMssg-out').click(function (e) {
        e.preventDefault();
        $(this).hide();
        $('#overlayform2').hide();
        $('#overlayform1').hide();
    });
    $("#overlayform").click(function (e) {
        e.preventDefault();
        $(this).hide();
        $("#cont-removeform").hide();
        $('#cont-viewinform').hide();
    });


    $('#back2').click(function (e) {
        e.preventDefault();
        rightSidepane.style.transform = "translateX(20rem) "
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


function refreshDisplayTrainee() {
    $('.outlosdEnr').show();
    $.ajax({
        method: "GET",
        url: "../enrollSection/enrollActionReq/searchTrainee.php",
        success: function (response) {
            $('#searchResults').html(response);
        },
        complete: function () {
            $('.outlosdEnr').hide();

        }
    });
}