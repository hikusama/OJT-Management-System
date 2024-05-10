









$(document).ready(function () {







    // $('#add_course_package').click(function (e) { 
    $('.outlosdEnr').show();

    refreshNotDeployed();

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
            url: "../viewTraineeSection/enrollActionReq/notDeployed.php",
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
        let catchid = $(this).attr('id');
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
 

    let notdplyElement = document.getElementById('notDply');
    let dplyElement = document.getElementById('dply');

    let isdpClicked = true;
    $('#notDply').click(function (e) {
        e.preventDefault();
        if (isdpClicked == false) {
            notdplyElement.style.background = "linear-gradient(271deg, black, rgba(255, 187, 0, 0.678)";
            dplyElement.style.background = "transparent";
            refreshNotDeployed();
            isdpClicked = true;
        }else{
            dplyElement.style.background = "linear-gradient(271deg, black, red)";
            notdplyElement.style.background = "transparent";
        }
    });
    $('#dply').click(function (e) { 
        e.preventDefault();
        if (isdpClicked == true) {
            refreshDeployed();
            isdpClicked = false;
            dplyElement.style.background = "linear-gradient(271deg, black, red)";
            notdplyElement.style.background = "transparent";
        }else{
            notdplyElement.style.background = "linear-gradient(271deg, black, rgba(255, 187, 0, 0.678)";
            dplyElement.style.background = "transparent";
        }
        
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


function refreshNotDeployed() {
    $('.outlosdEnr').show();
    $.ajax({
        method: "GET",
        url: "../viewTraineeSection/enrollActionReq/notDeployed.php",
        success: function (response) {
            $('#searchResults').html(response);
        },
        complete: function () {
            $('.outlosdEnr').hide();

        }
    });
}

function refreshDeployed() {
    $('.outlosdEnr').show();
    $.ajax({
        method: "GET",
        url: "../viewTraineeSection/enrollActionReq/deployed.php",
        success: function (response) {
            $('#searchResults').html(response);
        },
        complete: function () {
            $('.outlosdEnr').hide();

        }
    });
}


 