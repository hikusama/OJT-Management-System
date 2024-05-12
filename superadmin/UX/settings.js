









$(document).ready(function () {

    $('.outlosdEnr').show();
    setTimeout(() => {
        $('.outlosdEnr').hide();

    }, 2000);


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



















    let primary = document.querySelector('.primaryaskedit');


    let un;
    $('#editformreq').submit(function (event) {
        event.preventDefault();
        let formData = new FormData();
        $('.outlosdrmqrm').show();

        formData.append('conftopass', $('#conftopass').val());


        $.ajax({
            url: '../settingsSection/updateVerification.php',
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
                    $('.loadingSc').show();
                    $('#cont-editform').show();
                    $.ajax({
                        url: '../settingsSection/primarydisplay.php',
                        method: 'POST',
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            $('.primaryaskedit').html(response);
                            primary.style.visibility = "hidden";
                            un = $('#usernamee').val();
                        },
                        complete: function () {

                            setTimeout(function () {
                                $("#cont-editform .loadingSc").hide();
                                primary.style.visibility = "visible";

                            }, 2000);


                        }
                    });
                }
            }
        });
    });





    $('#cont-editform').on('change', '#usernamee, #passworde, #confirm_passworde', function () {
        formData = new FormData();
        formData.append('firstusername', un);
        formData.append('username', $('#usernamee').val());
        formData.append('userpassword', $('#passworde').val());
        formData.append('confirm_password', $('#confirm_passworde').val());


        $.ajax({
            url: '../settingsSection/primaryInfoCheck.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#primaryErrorDisplay').html(response);
            }
        });


    });

    $('#primarysec').submit(function (event) {
        event.preventDefault();
        $('.outlosdrmqrm').hide();
        formData = new FormData();
        pasid = $('#cont-editform .prdp').attr('id');
        pasid = pasid.substring(2);
        let idToBePass = parseInt(pasid);
        formData.append('idToBePass', idToBePass);
        formData.append('firstusername', un);
        formData.append('username', $('#usernamee').val());
        formData.append('userpassword', $('#passworde').val());
        formData.append('confirm_password', $('#confirm_passworde').val());
        $.ajax({
            url: '../settingsSection/submitLoginInfoUpdate.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#primaryErrorDisplay').html(response);
                prResponse = response;
            },
            complete: function () {
                if (prResponse == 'username updated succesfully') {
                    $("#overlayform2").show();
                    $('#cont-editform').hide();
                    $('#primaryErrorDisplay').html("");
                    $('.responseMssg-out').show();
                    $('.responseMssg-out h3').html('Username updated succesfully');
                    $('#overlayform').hide();

                    $('.outlosdrmqrm').hide();
                } else if (prResponse == 'password updated succesfully') {
                    $('#primaryErrorDisplay').html("");
                    $('#cont-editform').hide();
                    $('.outlosdrmqrm').hide();
                    $('.responseMssg-out').show();
                    $('#overlayform').hide();
                    $('.responseMssg-out h3').html('Password updated succesfully');

                } else if (prResponse == 'login credentials updated succesfully') {
                    $("#overlayform2").show();
                    $('#primaryErrorDisplay').html("");
                    $('#cont-editform').hide();
                    $('#overlayform').hide();
                    $('.responseMssg-out').show();
                    $('.responseMssg-out h3').html('All login credentials updated succesfully');

                    $('.outlosdrmqrm').hide();
                } else {
                    $('#cont-editform').show();
                    $('.outlosdrmqrm').hide();
                }

            }
        });


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