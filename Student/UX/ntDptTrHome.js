




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






 



    let isTimeInClicked = false;
    $('.attendanceButton').on('click', '#timein', function (e) {
        e.preventDefault();
        if (isTimeInClicked == false) {
            document.getElementById('timein').style.opacity = '50%';
            document.getElementById('timeout').style.opacity = '1'; isTimeInClicked = true;
            isTimeInClicked = true;
        }
    });





    $('.attendanceButton').on('click', '#timeout', function (e) {
        e.preventDefault();
        if (isTimeInClicked == true) {
            document.getElementById('timeout').style.opacity = '50%';
            document.getElementById('timein').style.opacity = '1';
            isTimeInClicked = false;
        }
    });


    let isSupVShowClicked = false;
    $('#findSupV').click(function (e) {
        e.preventDefault();

        if (isSupVShowClicked === false) {
            $('.loadli').show();
            $('.outer-applyToSupV').show();
            $.ajax({
                type: "POST",
                url: "../homeSection/notDeployedActionReq/getSupervisor.php",
                success: function (response) {
                    $('.loadli').show();
                    $('#supervisors').html(response);
                }, complete: function () {
                    $('.loadli').hide();

                }
            });
            isSupVShowClicked = true;
        }

    });

    $('#searchBySpec').submit(function (e) {
        e.preventDefault();
        formdata = new FormData();
        formdata.append('searchSupV', $('#searchSupV').val());

        $('.loadli').show();
        $('.outer-applyToSupV').show();
        $.ajax({
            type: "POST",
            data: formdata,
            contentType: false,
            processData: false,
            url: "../homeSection/notDeployedActionReq/getSupervisor.php",
            success: function (response) {
                $('.loadli').show();
                $('#supervisors').html(response);
            }, complete: function () {
                $('.loadli').hide();

            }
        });

    });

    $('#supervisors').on('click', '#reqToSupV', function (a) {
        a.preventDefault();
        let catchid = $(this).closest("li").find(".ovCrs .act3").attr('id');
        let valueBeforeN = catchid.substring(3);
        let responseRecieve ;
        supVId = parseInt(valueBeforeN);
        console.log(supVId);

        formdata = new FormData();
        formdata.append('sup_Id', supVId);
        
        $.ajax({
            type: "POST",
            data: formdata,
            contentType: false,
            processData: false,
            url: "../homeSection/notDeployedActionReq/reqtoSupV.php",
            success: function (response) {
                $('.loadli').show();
                $('#supervisors').html(response);
                responseRecieve = response.trim();
            }, complete: function () {
                $('.loadli').hide();
                if (responseRecieve == 'Please refresh your page you are now a NOT-TRAINEE' || responseRecieve == 'Please refresh your page you are now a TRAINEE') {

                }else{
                    refreshSupFind();
                }
            }
        });

    });

    $('#supervisors').on('click', '.act3', function (a) {
        a.preventDefault();
        let catchid = $(this).attr('id');
        let valueBeforeN = catchid.substring(3);
        supVId = parseInt(valueBeforeN);
        console.log(supVId);

        $('.outlosdviewinfo').show();
        $('.out-viewSupV').show();
        $('#overlayform2').show();
        formdata = new FormData();
        formdata.append('sup_Id', supVId);
        $.ajax({
            type: "POST",
            data: formdata,
            contentType: false,
            processData: false,
            url: "../homeSection/notDeployedActionReq/viewSupVinfo.php",
            success: function (response) {
                $('.out-viewSupV').html(response);
                $('.outlosdviewinfo').show();

            }, complete: function () {

                setTimeout(() => {
                    $('.outlosdviewinfo').hide();
                }, 1000);

            }
        });

    });


    $('#back2').click(function (e) {
        e.preventDefault();
        if (isSupVShowClicked === true) {

            $('.outer-applyToSupV').hide();
            isSupVShowClicked = false;
        }
    });

    function refreshSupFind() {
        $('.loadli').show();
        $('.outer-applyToSupV').show();
        $.ajax({
            type: "POST",
            url: "../homeSection/notDeployedActionReq/getSupervisor.php",
            success: function (response) {
                $('.loadli').show();
                $('#supervisors').html(response);
            }, complete: function () {
                $('.loadli').hide();

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




    let isLoginClicked = false;
    let canhide = true;
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
            canhide = false;
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





    $('#overlayform2').click(function (e) {
        e.preventDefault();

        if (canhide == true) {
            $(this).hide();
            $('.out-viewSupV').hide();
        }
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




