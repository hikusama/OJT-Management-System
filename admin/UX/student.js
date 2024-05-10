


let loadingScreen = $(".outlosd");


// $('.addedsuc2').hide();
// $('.addedsuc').hide();
let studentsId, userId, fn, query = '';
let fnameec, lnameec, mnameec, positionec, departmentec, roomec, gnec, student_idec, courseec, contactec, genderec, addressec, YL;

let searchQuery = "%" + query + "%";





$(document).ready(function () {
    $('.outlosd').show();

    searchRefresh();

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


    // -----------------------logout---------------------
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




    // ------------------------Student suggesting Department------------------------
    let isWho = true;
    $('.suggestCrs').on('click', 'p', function (e) {
        $('#CRS').val($(this).text());
        $('.suggestCrs').hide();

        formData = new FormData();
        formData.append('gender', $('#GN').val());
        formData.append('contact', $('#CNT').val());
        formData.append('address', $('#address').val());
        formData.append('course', $('#CRS').val());
        formData.append('department', $('#DPT').val());


        $.ajax({
            url: '../../login_Signup/signup/secondSectionCheck.php',
            data: formData,
            method: 'post',
            contentType: false,
            processData: false,
            success: function (response) {
                $('#studentsResponse2ndsection').html(response);
                if (response == 'Ready to next') {
                    isSecondReady = true;
                    $('#nextToLast').addClass('newSecond');


                } else {
                    if ($('#nextToLast').hasClass('newSecond')) {
                        $('#nextToLast').removeClass('newSecond');
                    }
                    isSecondReady = false;

                }
            }
        });

    });
    $('.suggestDpt').on('click', 'p', function (e) {
        e.preventDefault();


        if (isWho == true) {

            formData = new FormData();
            formData.append('gender', $('#GN').val());
            formData.append('contact', $('#CNT').val());
            formData.append('address', $('#address').val());
            formData.append('course', $('#CRS').val());
            formData.append('department', $('#DPT').val());


            $.ajax({
                url: '../../login_Signup/signup/secondSectionCheck.php',
                data: formData,
                method: 'post',
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#studentsResponse2ndsection').html(response);
                    if (response == 'Ready to next') {
                        isSecondReady = true;
                        $('#nextToLast').addClass('newSecond');


                    } else {
                        if ($('#nextToLast').hasClass('newSecond')) {
                            $('#nextToLast').removeClass('newSecond');
                        }
                        isSecondReady = false;

                    }
                }
            });
            isWho = false;
        }

        $('.suggestDpt').hide();
        $('#DPT').val($(this).text());

        formData = new FormData();
        let query = $('#DPT').val();
        formData.append('searchQuery', query);
        $.ajax({
            url: '../../login_Signup/signup/getCourse.php',
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $(".suggestCrs").html(response);
            }
        });

    });


    $('.icon-input-container').on('input', '#DPT', function () {

        let query = $(this).val().trim();
        let searchQuery = "%" + query + "%";

        $.ajax({
            url: '../../login_Signup/signup/getDept.php',
            method: 'GET',
            data: { searchQuery: searchQuery },
            success: function (response) {
                $(".suggestDpt").html(response);
            },
            complete: function () {

            }
        });
    });




    // $('#DPT').blur(function () {
    //     setTimeout(function () {
    //         $('.suggestDpt').hide();
    //     }, 150);
    // });
    $('#DPT').click(function () {
        $('.suggestDpt').show();

    });
    $('#CRS').click(function () {
        $('.suggestCrs').show();

    });


    $('#second').on('click', 'input, textarea, select', function (e) {
        e.preventDefault();

        if (!$(this).is('#DPT')) {
            isWho = false;
            lastGet = $('#DPT').val();
            $('.suggestDpt').hide();
        } else {
            isWho = true;
        }
        if (!$(this).is('#CRS')) {
            $('.suggestCrs').hide();

        } else {
            isWho = true;
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




    $("#searchForm").submit(function (event) {
        event.preventDefault();

        console.log(' searched');
        $('.outlosd').show();
        let query = $("#searchInput").val();

        let searchQuery = "%" + query + "%";

        $.ajax({
            url: '../studentSection/studentActionreq/search.php',
            method: 'GET',
            data: { query: searchQuery },
            success: function (response) {
                $("#searchResults").html(response);
            },
            complete: function () {
                $('.outlosd').hide();
            }
        });
    });

    // let checkAdd;
    // $('#changep2, #fnamec, #lnamec, #mnamec, #emailc, #positionc, #departmentc, #roomc, #gn, #usernamec, #passwordc, #confirm_passwordc').on('change', function () {
    //     formData = new FormData();

    //     // Append file input
    //     formData.append('image', $('#changep2')[0].files[0]);

    //     // Append other form data
    //     formData.append('fname', $('#fnamec').val());
    //     formData.append('lname', $('#lnamec').val());
    //     formData.append('email', $('#emailc').val());
    //     formData.append('position', $('#positionc').val());
    //     formData.append('department', $('#departmentc').val());

    //     formData.append('username', $('#usernamec').val());
    //     formData.append('userpassword', $('#passwordc').val());
    //     formData.append('confirm_password', $('#confirm_passwordc').val());
    //     // console.log("lib");
    //     $.ajax({
    //         url: '../studentsSection/mvcAddstudents/addstudents.php',
    //         method: 'POST',
    //         data: formData,
    //         contentType: false,
    //         processData: false,
    //         success: function (response) {
    //             $('#errorDisplay').html(response);
    //             checkAdd = response;
    //         },
    //         complete: function () {

    //         }
    //     });

    //     console.log("corabut");
    //     fnout = $('#fnamec').val();
    //     lnout = $('#lnamec').val();

    // });






























    // $('#delG').click(function (e) {
    //     e.preventDefault();

    // });





    /*
    ----------------------first Section students add----------------------------
    */



    let isFirstReady;
    $('#cont-addstudents').on('change', '#SN, #FN, #LN, #MN, #YL', function (e) {
        e.preventDefault();
        formData = new FormData();
        formData.append('student_id', $('#SN').val());
        formData.append('firstname', $('#FN').val());
        formData.append('lastname', $('#LN').val());
        formData.append('middlename', $('#MN').val());
        formData.append('year_level', $('#YL').val());


        $.ajax({
            url: '../../login_Signup/signup/firstSectionCheck.php',
            data: formData,
            method: 'post',
            contentType: false,
            processData: false,
            success: function (response) {
                $('#studentsResponse1stsection').html(response);
                if (response == 'Ready to next') {
                    isFirstReady = true;
                    $('#nextToSecond').addClass('newFirst');

                } else {
                    if ($('#nextToSecond').hasClass('newFirst')) {
                        $('#nextToSecond').removeClass('newFirst');


                    }
                    isFirstReady = false;
                }
            },
            complete: function () {

            }
        });

    });



    /*
    ----------------------Second Section students add----------------------------
    */

    let isSecondReady;
    $('#students').on('change', '#GN, #CNT, #address, #CRS, #DPT', function () {
        formData = new FormData();
        formData.append('gender', $('#GN').val());
        formData.append('contact', $('#CNT').val());
        formData.append('address', $('#address').val());
        formData.append('course', $('#CRS').val());
        formData.append('department', $('#DPT').val());


        if (isWho == false) {

            $.ajax({
                url: '../../login_Signup/signup/secondSectionCheck.php',
                data: formData,
                method: 'post',
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#studentsResponse2ndsection').html(response);
                    if (response == 'Ready to next') {
                        isSecondReady = true;
                        $('#nextToLast').addClass('newSecond');

                    } else {
                        if ($('#nextToLast').hasClass('newSecond')) {
                            $('#nextToLast').removeClass('newSecond');

                        }
                        isSecondReady = false;
                        $('#CRS').val('');

                    }

                }
            });
        }


    });





    let btn2 = false;

    /*
        ----------------------Last Section students add----------------------------
    */

    let isLastReady;
    $('#students').on('change', '#UN, #EM, #PW, #CONFPW, #image', function (e) {
        e.preventDefault();
        formData = new FormData();

        formData.append('image', $('#image')[0].files[0]);
        formData.append('email', $('#EM').val());
        formData.append('username', $('#UN').val());
        formData.append('password', $('#PW').val());
        formData.append('conf_pw', $('#CONFPW').val());

        $.ajax({
            url: '../../login_Signup/signup/lastSectionCheck.php',
            data: formData,
            method: 'post',
            contentType: false,
            processData: false,
            success: function (response) {
                if (response == 'All Set') {
                    isLastReady = true;

                    $('#studentsResponselastsection').html('');

                } else {
                    $('#studentsResponselastsection').html(response);

                    isLastReady = false;
                }
                if (isFirstReady && isSecondReady && isLastReady && response == 'All Set') {
                    document.getElementById('studentAddbutton').classList.add('newStudentAddbutton');
                } else {
                    document.getElementById('studentAddbutton').classList.remove('newStudentAddbutton');

                }
            }
        });


    });

    $('.outlosdsign').hide();

    let canhide = false;
    let getsubmitres;
    $('#studentsForm').submit(function (a) {
        a.preventDefault();
        formData = new FormData();
        formData.append('image', $('#image')[0].files[0]);
        formData.append('student_id', $('#SN').val());
        formData.append('firstname', $('#FN').val());
        formData.append('lastname', $('#LN').val());
        formData.append('middlename', $('#MN').val());
        formData.append('year_level', $('#YL').val());
        formData.append('gender', $('#GN').val());
        formData.append('email', $('#EM').val());
        formData.append('contact', $('#CNT').val());
        formData.append('address', $('#address').val());
        formData.append('course', $('#CRS').val());
        formData.append('department', $('#DPT').val());
        formData.append('username', $('#UN').val());
        formData.append('userpassword', $('#PW').val());
        formData.append('confirm_password', $('#CONFPW').val());
        console.log('JEASDFD');
        console.log($('#SN').val());
        if (isFirstReady && isSecondReady && isLastReady) {
            console.log('aaaaaa');
            $('.outlosdsign').show();

            $.ajax({
                url: '../../login_Signup/signup/signup.php',
                data: formData,
                method: 'post',
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#studentsResponselastsection').html(response);
                    getsubmitres = response;



                },
                complete: function () {
                    if (getsubmitres == 'Account Created Successfully') {
                        $('#studentsForm input').val('');
                        $('#studentsForm textarea').val('');
                        $('#studentsForm select').val('');
                        $('#studentsResponse1stsection').html('');
                        $('#studentsResponse2ndsection').html('');
                        $('.outlosdsign').hide();
                        $('.responseMssg-out').show();
                        $('#cont-addstudents #first').show();
                        $('#cont-addstudents #second').hide();
                        $('#cont-addstudents #last').hide();
                        $('#cont-addstudents').hide();
                        $('#overlayform2').show();
                        $('#nextToSecond').removeClass('newFirst');
                        canhide = true;
                        $('#nextToLast').removeClass('newSecond');
                        document.getElementById('YL').style.color = 'rgb(128, 128, 128)';
                        document.getElementById('GN').style.color = 'rgb(128, 128, 128)';
                        isFirstReady = false;
                        isSecondReady = false;
                        isLastReady = false;
                        $('#studentsResponselastsection').html('');



                    }
                }
            });
        }


    });


    /*
        ----------------------Next Button Clicked----------------------------
    */
    $("#students").on("click", ".nxbk button", function (e) {
        e.preventDefault();

        var iconId = $(this).attr("id");
        console.log(iconId);

        if (iconId == "nextToSecond" && isFirstReady == true) {
            console.log('1st done');
            $('#first').hide();
            $('#second').show();
            $('#last').hide();
        }
        if (iconId == "nextToLast" && isSecondReady == true) {
            console.log('2nd done');
            $('#first').hide();
            $('#second').hide();
            $('#last').show();
        }
        switch (iconId) {
            case "backToFirst":
                $('#first').show();
                $('#second').hide();
                $('#last').hide();
                break;
            case "backToSecond":
                $('#first').hide();
                $('#second').show();
                $('#last').hide();
                break;
            default:

                break;
        }

    });























    let removeResponse;
    $('#rmformreq').submit(function (event) {
        event.preventDefault();
        let formData = new FormData();
        $(".outlosdrm").show();
        formData.append('password', $('#pwdd').val());
        formData.append('studentsId', studentsId);
        formData.append('userId', userId);
        document.getElementById('delG').style.transform = 'translateX(13rem)';
        console.log(userId);
        console.log(studentsId);




        isreadyrem = true;
        document.getElementById('delG').style.transform = 'translateX(0)';
        $.ajax({
            url: '../studentSection/studentActionreq/delete.php',
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
                    $("#overlayform2").show();
                    $(".addedsuc").show();
                    $("#cont-addstudents").hide();
                    $("#cont-removeform").hide();
                    $("#cont-confirmforedit").hide();
                    $("#cont-editform").hide();
                    $("#cont-viewinform").hide();
                    $(".addedsuc .name h3").html("deleted successfully");
                    let setC = document.querySelector(".addedsuc .name h3");
                    setC.style.color = "red";
                    $("#blinkround").hide();

                    forresponseinact(fn, 2, filepicfordel);
                }
                setTimeout(() => {
                    document.getElementById('delG').style.transform = 'translateX(0)';
                    $(".outlosdrm").hide();
                }, 2000);

            }

        });




    });



    let primary = document.querySelector('.primaryaskedit');
    let secondary = document.querySelector('.secondaryaskedit-inner');

    let isEditReqGranted, editReqGrantedRespone;
    $('#editformreq').submit(function (event) {
        event.preventDefault();
        let formData = new FormData();
        $('.outlosdrmqrm').show();
        formData.append('conftopass', $('#conftopass').val());
        formData.append('userId', userId);

        $.ajax({
            url: '../studentSection/studentActionreq/updateVerification.php',
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
                    isEditReqGranted = true;
                    $('#cont-confirmforedit').hide();
                    $('#cont-editform').show();
                    $("#cont-editform .loadingSc").show();

                    formData = new FormData();

                    console.log('2timesbutton1');
                    document.getElementById('button2').style.backgroundColor = "transparent";
                    document.getElementById('button1').style.backgroundColor = "rgb(193, 77, 0)";
                    $(".secondaryaskedit-inner").html('');
                    formData.append('userId', userId);
                    $.ajax({
                        url: '../studentSection/studentActionreq/primarydisplay.php',
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            $('.primaryaskedit').html(response);
                            primary.style.visibility = "hidden";
                            un = $('#usernamee').val();
                            console.log(un);
                        },
                        complete: function () {
                            setTimeout(function () {
                                $("#cont-editform .loadingSc").hide();
                                primary.style.visibility = "visible";


                            }, 2000);
                            i = 0;

                        }
                    });
                } else {
                    isEditReqGranted = false;
                }
                $('.outlosdrmqrm').hide();

            }
        });

    });










    /*
    
        ------------------------------------SECONDARY SECTION------------------------------------------------------------
    
    */
    let isImageSecondSectionChanged, isSecondEditSecModified = false;
    $('#cont-editform').on('change', '#changep3,#fnamee, #lnamee, #student_idc, #departmentc, #mnamec,#coursec, #yearlevel, #contactc, #genderc, #addressc', function () {
        formData = new FormData();
        formData.append('image', $('#changep3')[0].files[0]);

        if ($(this).is('#changep3')) {
            isImageSecondSectionChanged = true;
        }
        if (isImageSecondSectionChanged == true) {
            formData.append('changed', 'changed');
        }

        // omenta kita pasada Akel ya saka kita del ya pitchi konakel botton di may lidia 
        formData.append('student_idcc', student_idec);
        formData.append('fnameec', fnameec);
        formData.append('lnameec', lnameec);
        formData.append('mnamec', mnameec);
        formData.append('YLc', YL);
        formData.append('gendercc', genderec);
        formData.append('contactcc', contactec);
        formData.append('addresscc', addressec);
        formData.append('departmentecc', departmentec);
        formData.append('coursecc', courseec);


        formData.append('student_idc', $('#student_idc').val());
        formData.append('fname', $('#fnamee').val());
        formData.append('lname', $('#lnamee').val());
        formData.append('mnamecc', $('#mnamec').val());
        formData.append('YL', $('#yearlevel').val());
        formData.append('contactc', $('#contactc').val());
        formData.append('genderc', $('#genderc').val());
        formData.append('addressc', $('#addressc').val());
        formData.append('departmentec', $('#departmentc').val());
        formData.append('coursec', $('#coursec').val());
        let tr = $('#student_idc').val();
        console.log(tr);
        $.ajax({
            url: '../studentSection/studentUpdatePattern/secondaryInfoCheck.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response === 'Make changes for update') {
                    $('#secondaryErrorDisplay').html("<h4 style='color:rgb(2, 136, 189);'>" + response + "</h4>");
                    isSecondEditSecModified = false;
                } else {
                    isSecondEditSecModified = true;
                    $('#secondaryErrorDisplay').html(response);

                }
            }
        });



    });




    let pasid, reloadFrButton, secondaryRs;
    $('#secondarysec').submit(function (event) {
        event.preventDefault();

        formData = new FormData();

        // Append file input


        if (isSecondEditSecModified == true) {
            loadingScreen.show();

            formData.append('image', $('#changep3')[0].files[0]);

            if (isImageSecondSectionChanged == true) {
                formData.append('changed', 'changed');
            }
            formData.append('key', idToBePass);

            formData.append('student_idcc', student_idec);
            formData.append('fnameec', fnameec);
            formData.append('lnameec', lnameec);
            formData.append('mnamec', mnameec);
            formData.append('YLc', YL);
            formData.append('gendercc', genderec);
            formData.append('contactcc', contactec);
            formData.append('addresscc', addressec);
            formData.append('departmentecc', departmentec);
            formData.append('coursecc', courseec);

            formData.append('student_idc', $('#student_idc').val());
            formData.append('fname', $('#fnamee').val());
            formData.append('lname', $('#lnamee').val());
            formData.append('mnamecc', $('#mnamec').val());
            formData.append('YL', $('#yearlevel').val());
            formData.append('contactc', $('#contactc').val());
            formData.append('genderc', $('#genderc').val());
            formData.append('addressc', $('#addressc').val());
            formData.append('departmentec', $('#departmentc').val());
            formData.append('coursec', $('#coursec').val());


            $.ajax({
                url: '../studentSection/studentUpdatePattern/submitPersonalInfoUpdate.php',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    // $('#secondaryErrorDisplay').html(response);
                    secondaryRs = response;
                },
                complete: function () {
                    loadingScreen.hide();
                    if (secondaryRs == 'success') {
                        $('#cont-editform').hide();

                        isSecondEditSecModified = false;
                        isImageSecondSectionChanged = false;
                        $("#overlayform2").show();
                        canhide2 = true;
                        $('.responseMssg-out').show();
                        $('.responseMssg-out h3').html('Personal Info Updated Successfully');
                        $("#overlayform").hide();
                        btn2 = true;
                    } else {
                        $('#cont-editform').show();

                    }
                }
            });
        }




    });

    $('.responseMssg-out').click(function (e) {
        e.preventDefault();
        $(this).hide();
        if (btn2 == true && canhide != true) {
            $("#overlayform").show();
            $('#cont-editform').show();
            button2Refresh();
        } else if(btn2 == false && canhide != true){
            
            button1Refresh();
            $("#overlayform").show();
            $('#cont-editform').show();
        }
        if (canhide == true) {
            $("#cont-addstudents").hide();
            $('#overlayform').hide();
            
        }
        $('#overlayform2').hide();
        $('#overlayform1').hide();
    });

    /*
    
        ------------------------------GETTING ID OF CLICKED BUTTON WHICH IS "Login Credentials" AND "Personal Information"-------------------------------------------------------
    
    */


    $("#cont-editform").on("click", ".coradbut2 button", function (e) {
        pasid = $(this).attr('id');
        reloadFrButton = $(this).attr('class');
        pasid = pasid.substring(2);
        idToBePass = parseInt(pasid);
        console.log(reloadFrButton);


    });



    $('#students').on('change', '#YL', function (e) {
        e.preventDefault();

        if ($('#YL').val()) {
            document.getElementById('YL').style.color = 'rgb(255, 255, 255)';
        } else {
            document.getElementById('YL').style.color = 'rgb(128, 128, 128)';
        }

    });
    $('#students').on('change', '#GN', function (e) {
        e.preventDefault();

        if ($('#GN').val()) {
            document.getElementById('GN').style.color = 'rgb(255, 255, 255)';
        } else {
            document.getElementById('GN').style.color = 'rgb(128, 128, 128)';
        }

    });

    $('#students').on('change', '#CRS', function (e) {
        e.preventDefault();

        if ($('#CRS').val()) {
            document.getElementById('CRS').style.color = 'rgb(255, 255, 255)';
        } else {
            document.getElementById('CRS').style.color = 'rgb(128, 128, 128)';
        }

    });







    /*
    
        ------------------------------------PRIMARY SECTION------------------------------------------------------------
    
    */

    let canhide2 = false, isFirstSecModified = false;
    $('#cont-editform').on('change', '#usernamee, #passworde, #confirm_passworde', function () {
        formData = new FormData();



        formData.append('firstusername', un);
        formData.append('username', $('#usernamee').val());
        formData.append('userpassword', $('#passworde').val());
        formData.append('confirm_password', $('#confirm_passworde').val());


        $.ajax({
            url: '../studentSection/studentUpdatePattern/primaryInfoCheck.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response === 'Make changes for update') {
                    $('#primaryErrorDisplay').html("<h4 style='color:rgb(2, 136, 189);'>Make changes for update</h4>");
                    isFirstSecModified = false;
                } else {
                    isFirstSecModified = true;
                    $('#primaryErrorDisplay').html(response);
                }
            }
        });


    });


    let prResponse;
    $('#primarysec').submit(function (event) {
        event.preventDefault();
        if (isFirstSecModified == true) {

            loadingScreen.show();
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
                url: '../studentSection/studentUpdatePattern/submitLoginInfoUpdate.php',
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
                        canhide2 = true;
                        $('.responseMssg-out').show();
                        $('.responseMssg-out h3').html('Username Updated Successfully');
                        $('#primaryErrorDisplay').html("");
                        loadingScreen.hide();
                        isFirstSecModified = false;
                        $("#overlayform").hide();
                        $('#cont-editform').hide();
                        btn2 = false;


                    } else if (prResponse == 'password updated succesfully') {
                        $("#overlayform2").show();
                        canhide2 = true;
                        $('.responseMssg-out').show();
                        $('.responseMssg-out h3').html('Password Updated Successfully');
                        $('#primaryErrorDisplay').html("");
                        loadingScreen.hide();
                        isFirstSecModified = false;
                        $('#cont-editform').hide();
                        $("#overlayform").hide();
                        btn2 = false;

                    } else if (prResponse == 'login credentials updated succesfully') {
                        $("#overlayform2").show();
                        canhide2 = true;
                        $('.responseMssg-out').show();
                        $('.responseMssg-out h3').html('Login Info Updated Successfully');
                        $('#primaryErrorDisplay').html("");
                        $('#cont-editform').hide();
                        loadingScreen.hide();
                        $("#overlayform").hide();
                        btn2 = false;

                        isFirstSecModified = false;
                    } else {
                        canhide2 = false;
                        loadingScreen.hide();
                        $('#cont-editform').show();
                    }


                }

            });
        }


    });




    let i = 0;
    let un;
    let isButtonPositionReady = false;
    $("#cont-editform").on("click", ".tabinedit button", function (e) {
        e.preventDefault();
        let point = $(this).attr('id');
        console.log(isButtonPositionReady);

        if (point == 'button2') {
            if (isButtonPositionReady == false) {

                button2Refresh();

                // $("#cont-editform .loadingSc").show();
                // formData = new FormData();
                // formData.append('studentsId', studentsId);
                // $(".primaryaskedit").html('');
                // // let imgSrc = $(this).closest(".secondaryaskedit-inner").find(".chpic img").attr('src');
                // document.getElementById('button1').style.backgroundColor = "transparent";
                // document.getElementById('button2').style.backgroundColor = "rgb(193, 77, 0)";
                // i = 1;

                // // formData.append('image', $('#changep3')[0].files[0]);
                // // formData.append('username', $('#usernamee').val());
                // // formData.append('userpassword', $('#passworde').val());
                // // formData.append('confirm_password', $('#confirm_passworde').val());
                // $.ajax({
                //     url: '../studentSection/studentActionreq/secondarydisplay.php',
                //     method: 'POST',
                //     data: formData,
                //     contentType: false,
                //     processData: false,
                //     success: function (response) {
                //         console.log('jimomo');
                //         $('.secondaryaskedit-inner').html(response);
                //         secondary.style.visibility = "hidden";

                //     },
                //     complete: function () {


                //         student_idec = $('#student_idc').val();
                //         fnameec = $('#fnamee').val();
                //         lnameec = $('#lnamee').val();
                //         mnameec = $('#mnamec').val();
                //         YL = $('#yearlevel').val();
                //         genderec = $('#genderc').val();
                //         contactec = $('#contactc').val();
                //         addressec = $('#addressc').val();
                //         departmentec = $('#departmentc').val();
                //         courseec = $('#coursec').val();


                //         setTimeout(function () {
                //             $("#cont-editform .loadingSc").hide();
                //             secondary.style.visibility = "visible";
                //             isButtonPositionReady = true;
                //         }, 1000);
                //         handleimg(4);
                //     }
                // });

            }
        } else if (point == 'button1') {

            if (isButtonPositionReady == true) {



                button1Refresh();


                // $("#cont-editform .loadingSc").show();
                // formData = new FormData();
                // document.getElementById('button2').style.backgroundColor = "transparent";
                // document.getElementById('button1').style.backgroundColor = "rgb(193, 77, 0)";
                // $(".secondaryaskedit-inner").html('');

                // formData.append('userId', userId);

                // $.ajax({
                //     url: '../studentSection/studentActionreq/primarydisplay.php',
                //     method: 'POST',
                //     data: formData,
                //     contentType: false,
                //     processData: false,
                //     success: function (response) {
                //         $('.primaryaskedit').html(response);
                //         primary.style.visibility = "hidden";
                //         un = $('#usernamee').val();
                //     },
                //     complete: function () {
                //         setTimeout(function () {
                //             $("#cont-editform .loadingSc").hide();
                //             primary.style.visibility = "visible";
                //             isButtonPositionReady = false;

                //         }, 2000);


                //     }
                // });

            }
        }
    });








    $("#students").on("click", "#men", function (e) {
        e.preventDefault();
        // // console.log("hikusama");
        // if (emptfile) {
        //     // console.log("ept Readed");
        // } else {
        //     // console.log("not Readed");
        // }
        const hasClass = $(this).closest("li").find(".grupi").hasClass("grupiNew");

        $("#students .grupi").removeClass("grupiNew");

        $(this).closest("li").find(".grupi").addClass("grupiNew");

        if (hasClass) {
            $(this).closest("li").find(".grupi").removeClass("grupiNew");
        }
    });


    $("#students #searchResults").on("click", ".showact .act1", function (e) {
        e.preventDefault();
        $("#overlayform").show();
        $("#cont-confirmforedit").show();
        $("#cont-removeform").hide();
        $("#cont-viewinform").hide();
        // catchid = $(this).attr('id');
        catchid = $(this).closest(".showact").find(".act2").attr('id');
        nIndex = catchid.indexOf('n');
        valueBeforeN = catchid.substring(3, nIndex);

        valueAfterN = catchid.slice(nIndex + 1);
        studentsId = parseInt(valueBeforeN);
        userId = parseInt(valueAfterN);
        // console.log(studentsId);
        // console.log(userId);

    });

    let filepicfordel;
    $("#students").on("click", ".showact .act2", function (e) {
        e.preventDefault();
        catchid = $(this).attr('id');

        nIndex = catchid.indexOf('n');
        valueBeforeN = catchid.substring(3, nIndex);

        valueAfterN = catchid.slice(nIndex + 1);
        studentsId = parseInt(valueBeforeN);
        userId = parseInt(valueAfterN);

        // console.log(" before N:" + valueBeforeN);
        // console.log(" after N:" + valueAfterN);
        fn = $(this).parent().attr('id').replace(/_/g, " ");
        filepicfordel = $(this).closest("li").find(".pfront img").attr('src');

        // console.log(filepicfordel);
        // if (fileInput) {
        //     let reader = new FileReader();
        //     reader.onload = function(event) {
        //         let fileData = event.target.result;
        // console.log("File data:", fileData);
        //         // Now you have the file data, you can use it as needed
        //     };
        //     reader.readAsDataURL(fileInput);
        // }
        // let idusr = ;
        $("#overlayform").show();
        $("#cont-removeform").show();
        $("#cont-confirmforedit").hide();
        $("#cont-editform").hide();
        $("#cont-viewinform").hide();
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



    $("#students .btad").on("click", "#addstudentsaccount", function (e) {
        e.preventDefault();
        $("#back").show();
        $("#overlayform").show();
        $("#cont-removeform").hide();
        $("#cont-confirmforedit").hide();
        $("#cont-editform").hide();
        $("#cont-viewinform").hide();
        $("#cont-addstudents").show();

    });

    $("#students").on("click", "#overlayform", function (e) {
        $(this).hide();
        $("#cont-addstudents").hide();
        $("#cont-removeform").hide();
        $("#cont-confirmforedit").hide();
        $("#cont-editform").hide();
        $("#cont-viewinform").hide();
        $(".addedsuc").hide();
        $("#reqeditresponse").html('');
        $("#conftopass").val('');
        if (isEditReqGranted === true) {
            searchRefresh();
            isEditReqGranted = false;
        }

    });
    $("#students").on("click", "#back", function (e) {
        e.preventDefault();

        $("#cont-addstudents").hide();
        $("#overlayform").hide();
        $("#cont-editform").hide();
        $("#conftopass").val('');
        $("#reqeditresponse").html('');
        if (isEditReqGranted === true) {
            searchRefresh();
            isEditReqGranted = false;
        }


    });

    // $(".addedsuc").on("click", "#done", function (e) {
    //     e.preventDefault();
    //     loadingScreen.show();

    //     $('#fnamec').val("");
    //     $('#lnamec').val("");
    //     $('#mnamec').val("");
    //     $('#emailc').val("");
    //     $('#positionc').val("");
    //     $('#departmentc').val("");
    //     $('#roomc').val("");
    //     $('#gn').val("");
    //     $('#usernamec').val("");
    //     $('#passwordc').val("");
    //     $('#confirm_passwordc').val("");
    //     $('#errorDisplay').html("");
    //     $("#overlayform").hide();
    //     $("#overlayform2").hide();
    //     $(".addedsuc").hide();
    //     $("#cont-addstudents").hide();
    //     $("#profdisplay2").attr("src", "../../images/mali.png");
    //     $('#changep2').val('');
    //     $("#cont-removeform input").val("");
    //     $("#cont-removeform #responsetodel").val("");
    //     $("#responsetodel").html("");
    //     $("#cont-removeform").hide();
    //     $('#pwdd').val('');
    //     searchRefresh();


    // });
    $('#overlayform2').click(function (e) {
        e.preventDefault();
        $('.responseMssg-out').hide();
        if (canhide == true) {
            $(this).hide();

            canhide = false;
            searchRefresh();
            $("#overlayform").show();

        }
        if (canhide2 == true) {
            $(this).hide();
            if (btn2 == true) {
                button2Refresh();
            } else {
                button1Refresh();

            }
            canhide2 = false;
            searchRefresh();
            $("#overlayform").show();
            $('#cont-editform').show();
            if (isButtonPositionReady = false) {
                isButtonPositionReady = true;
                button2Refresh();
                console.log('button2Refresh');
            } else if (isButtonPositionReady == true) {
                isButtonPositionReady = false;

                button1Refresh();
                console.log('button1Refresh');
            }
        }
    });

    $('.p0').click(function (e) {
        e.preventDefault();
        $(this).hide();
        searchRefresh();
        $('#overlayform2').hide();
        if (canhide2 == true) {
            if (isButtonPositionReady = false) {
                button2Refresh();
                isButtonPositionReady = true;
            } else if (isButtonPositionReady == true) {
                button1Refresh();
                isButtonPositionReady = false;
            }
            $('#cont-editform').show();
        }
        $("#overlayform").show();


    });

    function button1Refresh() {
        $("#cont-editform .loadingSc").show();
        formData = new FormData();
        document.getElementById('button2').style.backgroundColor = "transparent";
        document.getElementById('button1').style.backgroundColor = "rgb(193, 77, 0)";
        $(".secondaryaskedit-inner").html('');

        formData.append('userId', userId);

        $.ajax({
            url: '../studentSection/studentActionreq/primarydisplay.php',
            method: 'POST',
            data: formData,
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
                    isButtonPositionReady = false;

                }, 2000);


            }
        });

    }

    function button2Refresh() {

        $("#cont-editform .loadingSc").show();
        formData = new FormData();
        formData.append('studentsId', studentsId);
        $(".primaryaskedit").html('');
        // let imgSrc = $(this).closest(".secondaryaskedit-inner").find(".chpic img").attr('src');
        document.getElementById('button1').style.backgroundColor = "transparent";
        document.getElementById('button2').style.backgroundColor = "rgb(193, 77, 0)";

        // formData.append('image', $('#changep3')[0].files[0]);
        // formData.append('username', $('#usernamee').val());
        // formData.append('userpassword', $('#passworde').val());
        // formData.append('confirm_password', $('#confirm_passworde').val());
        $.ajax({
            url: '../studentSection/studentActionreq/secondarydisplay.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log('jimomo');
                $('.secondaryaskedit-inner').html(response);
                secondary.style.visibility = "hidden";

            },
            complete: function () {


                student_idec = $('#student_idc').val();
                fnameec = $('#fnamee').val();
                lnameec = $('#lnamee').val();
                mnameec = $('#mnamec').val();
                YL = $('#yearlevel').val();
                genderec = $('#genderc').val();
                contactec = $('#contactc').val();
                addressec = $('#addressc').val();
                departmentec = $('#departmentc').val();
                courseec = $('#coursec').val();


                setTimeout(function () {
                    $("#cont-editform .loadingSc").hide();
                    secondary.style.visibility = "visible";
                    isButtonPositionReady = true;
                }, 1000);
                handleimg(4);
            }
        });
    }



    $(".addedsuc2").on("click", "#done2", function (e) {
        $('#cont-editform').show();
        $("#overlayform2").hide();
        // $("#conftopass").val('');
        $("#confirm_passworde").val('');
        $("#passworde").val('');
        $(".addedsuc2").hide();
        $("#reqeditresponse").html('');

        if (reloadFrButton == "prdp") {
            $("#cont-editform .loadingSc").show();
            console.log('firstguy');
            console.log(reloadFrButton);

            formData = new FormData();

            console.log('2timesbutton1');
            document.getElementById('button2').style.backgroundColor = "transparent";
            document.getElementById('button1').style.backgroundColor = "rgb(193, 77, 0)";
            $(".secondaryaskedit-inner").html('');

            formData.append('userId', userId);

            $.ajax({
                url: '../studentSection/studentActionreq/primarydisplay.php',
                method: 'POST',
                data: formData,
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

        } else if (reloadFrButton == "scFrButton") {

            if (isSecondEditSecModified == true) {

                $("#cont-editform .loadingSc").show();
                formData = new FormData();
                $(".primaryaskedit").html('');
                i = 1;

                $.ajax({
                    url: '../studentSection/studentActionreq/secondarydisplay.php',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log('jimomo');
                        $('.secondaryaskedit-inner').html(response);
                        secondary.style.visibility = "hidden";

                    },
                    complete: function () {


                        student_idec = $('#student_idc').val();
                        fnameec = $('#fnamee').val();
                        lnameec = $('#lnamee').val();
                        mnameec = $('#mnamec').val();
                        YL = $('#yearlevel').val();
                        genderec = $('#genderc').val();
                        contactec = $('#contactc').val();
                        addressec = $('#addressc').val();
                        departmentec = $('#departmentc').val();
                        courseec = $('#coursec').val();


                        setTimeout(function () {
                            $("#cont-editform .loadingSc").hide();
                            secondary.style.visibility = "visible";

                        }, 1000);
                        handleimg(4);
                    }
                });
            }



        }
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
        console.log('adsoakdhello1');
        document.body.classList.remove('newAll');
        localStorage.setItem('checkboxState', 'unchecked');
    }
}





let emptfile;
function handleimg(a) {
    const profileImage = $('#profdisplay');
    const input = $('#changep')[0];
    const profileImage2 = $('#profdisplay2');
    const input2 = $('#changep2')[0];
    const profileImage3 = $('#profdisplay3');
    const input3 = $('#changep3')[0];
    const profileImage6 = $('#profileImage');
    const input6 = $('#image')[0];

    if (a === 2) {
        const file2 = input2.files[0];
        if (file2) {
            const reader2 = new FileReader();
            // console.log("file2");
            emptfile = input2;

            reader2.onload = function () {
                profileImage2.attr('src', reader2.result);
            };

            reader2.readAsDataURL(file2);
        } else {
            // console.log("invalid");
            profileImage2.attr('src', '../../images/mali.png');

        }
    } else if (a === 1) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            // console.log("file1");

            reader.onload = function () {
                profileImage.attr('src', reader.result);
            };

            reader.readAsDataURL(file);
        } else {
            // console.log("invalid");
            profileImage.attr('src', '../../images/mali.png');

        }
    } else if (a === 3) {

        const file = input3.files[0];

        if (file) {
            const reader = new FileReader();
            // console.log("file1");
            // isImageSecondSectionChanged = true;
            // console.log('ahsdjdh: '+ isImageSecondSectionChanged);

            reader.onload = function () {
                profileImage3.attr('src', reader.result);
            };

            reader.readAsDataURL(file);
        } else {
            // console.log("invalid");
            profileImage3.attr('src', '../../images/mali.png');

        }

    } else if (a === 4) {
        const input3 = document.getElementById('changep3');
        console.log("iam on 4");
        function loadIntoInput(imgSrc) {
            fetch(imgSrc)
                .then(response => response.blob())
                .then(blob => {
                    const file = new File([blob], "image.png", { type: "image/png" });
                    const fileList = new DataTransfer();
                    fileList.items.add(file);
                    input3.files = fileList.files;

                });
        }

        if (profileImage3.attr('src')) {
            loadIntoInput(profileImage3.attr('src'));
        }
    } else if (a == 6) {

        const file = input6.files[0];
        if (file) {
            const reader = new FileReader();
            console.log("file1");

            reader.onload = function () {
                profileImage6.attr('src', reader.result);
            };

            reader.readAsDataURL(file);
        } else {
            console.log("invalid");
            profileImage6.attr('src', '../../images/mali.png');

        }
    }

}



function forresponseinact(fulln, nmbr, mfile) {
    const profileImage = $('#displayaddanim');
    nm = $('.addedsuc .name h1');
    nm.html(fulln);

    if (nmbr == 1) {
        const fileempt = mfile.files[0];

        if (fileempt) {
            const readmt = new FileReader();
            // console.log("fileempt");

            readmt.onload = function () {
                profileImage.attr('src', readmt.result);
            };
            readmt.readAsDataURL(fileempt);

        } else {
            // console.log("invalid");
            profileImage.attr('src', '../images/declined.png');

        }
    } else if (nmbr == 2) {
        if (mfile) {

            profileImage.attr('src', mfile);

        }
    }
}




function searchRefresh() {
    $.ajax({
        url: '../studentSection/studentActionreq/search.php',
        method: 'GET',
        success: function (response) {
            $("#searchResults").html(response);
        }, complete: function () {
            $('.outlosd').hide();
        }
    });
}




