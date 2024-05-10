


let loadingScreen = $(".outlosd");


// $('.addedsuc2').hide();
// $('.addedsuc').hide();
let adminId, userId, fn, query = '';
let fnameec, lnameec, mnameec, positionec, departmentec, roomec, gnec;

let searchQuery = "%" + query + "%";





$(document).ready(function () {
    searchRefresh();

    // -----------------------logout---------------------
    let isLoginClicked = false;
    $('#logoutClick').click(function (e) {
        e.preventDefault();
        if (isLoginClicked == false) {
            $('.loggingoutVer').show();
            $('#overlayform2').show();
            $('.loggingoutVer h2').hide();
            isLoginClicked = true;
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
            url: '../adminSection/adminActionreq/search.php',
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

    let checkAdd;
    $('#changep2, #fnamec, #lnamec, #mnamec, #emailc, #positionc, #departmentc, #roomc, #gn, #usernamec, #passwordc, #confirm_passwordc').on('change', function () {
        formData = new FormData();

        // Append file input
        formData.append('image', $('#changep2')[0].files[0]);

        // Append other form data
        formData.append('fname', $('#fnamec').val());
        formData.append('lname', $('#lnamec').val());
        formData.append('email', $('#emailc').val());
        formData.append('position', $('#positionc').val());
        formData.append('department', $('#departmentc').val());

        formData.append('username', $('#usernamec').val());
        formData.append('userpassword', $('#passwordc').val());
        formData.append('confirm_password', $('#confirm_passwordc').val());
        // console.log("lib");
        $.ajax({
            url: '../adminSection/mvcAddadmin/addAdmin.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#errorDisplay').html(response);
                checkAdd = response;
            },
            complete: function () {

            }
        });

        console.log("corabut");
        fnout = $('#fnamec').val();
        lnout = $('#lnamec').val();

    });

    // let fnout,lnout;
    let addRes;
    $('#admins').on("click", ".coradbut label", function (e) {
        e.preventDefault();
        if (checkAdd === 'All Set') {
            $('.outlosdadd').show();
            console.log('enteredfff');
            fnout = $('#fnamec').val();
            lnout = $('#lnamec').val();
            formData.append('fname', fnout);
            formData.append('lname', lnout);
            formData.append('iseror', 'gdtg');
            formData.append('position', $('#positionc').val());
            formData.append('department', $('#departmentc').val());
            
            formData.append('email', $('#emailc').val());
            formData.append('username', $('#usernamec').val());
            formData.append('userpassword', $('#passwordc').val());
            formData.append('confirm_password', $('#confirm_passwordc').val());


            $.ajax({
                url: '../adminSection/mvcAddadmin/addAdmin.php',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#errorDisplay').html('');
                    $('#errorDisplay').html(response);
                    addRes = response;

                },
                complete: function () {
                    $('.outlosdadd').hide();
                    if (addRes == 'success') {
                        console.log('adadad');
                        $("#cont-addadmin").hide();
                        $("#cont-removeform").hide();
                        $("#cont-confirmforedit").hide();
                        $("#cont-editform").hide();
                        $("#cont-viewinform").hide();
                        $("#overlayform2").show();
                        $(".addedsuc").show();
                        $(".addedsuc .name h1").html("Coordinator");
                        $(".addedsuc .name h3").html("added successfully");
                        let setC = document.querySelector(".addedsuc .name h1");
                        setC.style.color = "#23e155ad";
                        fulln = fnout + ' ' + lnout;
                        forresponseinact(fulln, 1, emptfile);
                    }
                }
            });



        }


    });
    // $('#delG').click(function (e) {
    //     e.preventDefault();

    // });


    let removeResponse;
    $('#rmformreq').submit(function (event) {
        event.preventDefault();
        let formData = new FormData();
        $(".outlosdrm").show();
        formData.append('password', $('#pwdd').val());
        formData.append('adminId', adminId);
        formData.append('userId', userId);
        document.getElementById('delG').style.transform = 'translateX(13rem)';





        isreadyrem = true;
        document.getElementById('delG').style.transform = 'translateX(0)';
        $.ajax({
            url: '../adminSection/adminActionreq/delete.php',
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
                    $("#cont-addadmin").hide();
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
            url: '../adminSection/adminActionreq/updateVerification.php',
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
                        url: '../adminSection/adminActionreq/primarydisplay.php',
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
    let isImageSecondSectionChanged;
    $('#cont-editform').on('change', '#changep3,#fnamee, #lnamee, #mnamee, #positione, #departmente, #roome, #gne', function () {
        formData = new FormData();
        formData.append('image', $('#changep3')[0].files[0]);

        if ($(this).is('#changep3')) {
            isImageSecondSectionChanged = true;
        } 
        if (isImageSecondSectionChanged == true) {
            formData.append('changed', 'changed');
        }

        // omenta kita pasada Akel ya saka kita del ya pitchi konakel botton di may lidia 
        formData.append('fnameec', fnameec);
        formData.append('lnameec', lnameec);
        formData.append('positionec', positionec);
        formData.append('departmentec', departmentec);

        formData.append('fname', $('#fnamee').val());
        formData.append('lname', $('#lnamee').val());
        formData.append('position', $('#positione').val());
        formData.append('department', $('#departmente').val());


        $.ajax({
            url: '../adminSection/adminUpdatePattern/secondaryInfoCheck.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#secondaryErrorDisplay').html(response);
            }
        });

        fnout = $('#fnamec').val();
        lnout = $('#lnamec').val();

    });




    let pasid, reloadFrButton, secondaryRs;
    $('#secondarysec').submit(function (event) {
        event.preventDefault();

        formData = new FormData();

        // Append file input
        formData.append('image', $('#changep3')[0].files[0]);

        // Append other form data

        if (isImageSecondSectionChanged == true) {
            formData.append('changed', 'changed');
        }


        formData.append('key', idToBePass);
        formData.append('fnameec', fnameec);
        formData.append('lnameec', lnameec);
        formData.append('mnameec', mnameec);
        formData.append('positionec', positionec);
        formData.append('departmentec', departmentec);
        formData.append('roomec', roomec);
        formData.append('gnec', gnec);

        formData.append('fname', $('#fnamee').val());
        formData.append('lname', $('#lnamee').val());
        formData.append('mname', $('#mnamee').val());
        formData.append('position', $('#positione').val());
        formData.append('department', $('#departmente').val());
        formData.append('room', $('#roome').val());
        formData.append('gender', $('#gne').val());

        $.ajax({
            url: '../adminSection/adminUpdatePattern/submitPersonalInfoUpdate.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {

                $('#secondaryErrorDisplay').html(response);
                secondaryRs = response;
            },
            complete: function () {
                loadingScreen.hide();
                if (secondaryRs == 'success') {
                    isImageSecondSectionChanged = false;
                    $("#overlayform2").show();
                    $('.addedsuc2').show();
                    $('.addedsuc2 h1').html('Personal Information');
                    $('.addedsuc2 h3').html('updated succesfully');
                    $('#secondaryErrorDisplay').html("");
                } else {
                    $('#cont-editform').show();

                }
            }
        });



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
        $('#cont-editform').hide();

    });







    /*
    
    ------------------------------------PRIMARY SECTION------------------------------------------------------------
    
    */

    $('#cont-editform').on('change', '#usernamee, #passworde, #confirm_passworde', function () {
        formData = new FormData();



        formData.append('firstusername', un);
        formData.append('username', $('#usernamee').val());
        formData.append('userpassword', $('#passworde').val());
        formData.append('confirm_password', $('#confirm_passworde').val());


        $.ajax({
            url: '../adminSection/adminUpdatePattern/primaryInfoCheck.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#primaryErrorDisplay').html(response);
            }
        });


    });


    let prResponse;
    $('#primarysec').submit(function (event) {
        event.preventDefault();
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
            url: '../adminSection/adminUpdatePattern/submitLoginInfoUpdate.php',
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
                    $('.addedsuc2').show();
                    $('.addedsuc2 h1').html('username');
                    $('.addedsuc2 h3').html('updated succesfully');
                    $('#primaryErrorDisplay').html("");
                    loadingScreen.hide();
                } else if (prResponse == 'password updated succesfully') {
                    $("#overlayform2").show();
                    $('.addedsuc2').show();
                    $('.addedsuc2 h1').html('password');
                    $('.addedsuc2 h3').html('updated succesfully');
                    $('#primaryErrorDisplay').html("");
                    loadingScreen.hide();

                } else if (prResponse == 'login credentials updated succesfully') {
                    $("#overlayform2").show();
                    $('.addedsuc2').show();
                    $('.addedsuc2 h1').html('login credentials');
                    $('.addedsuc2 h3').html('updated succesfully');
                    $('#primaryErrorDisplay').html("");

                    loadingScreen.hide();
                } else {
                    $('#cont-editform').show();
                    loadingScreen.hide();
                }

            }
        });


    });




    let i = 0;
    let un;
    $("#cont-editform").on("click", ".tabinedit button", function (e) {
        e.preventDefault();

        let point = $(this).attr('id');
        // console.log(point);
        // console.log(i);
        // adminId = 91;
        // userId = 135;
        console.log(adminId);
        console.log(userId);

        if (point == 'button2') {



            if (i == 0) {


                $("#cont-editform .loadingSc").show();
                formData = new FormData();
                formData.append('adminId', adminId);
                $(".primaryaskedit").html('');
                // let imgSrc = $(this).closest(".secondaryaskedit-inner").find(".chpic img").attr('src');
                document.getElementById('button1').style.backgroundColor = "transparent";
                document.getElementById('button2').style.backgroundColor = "rgb(193, 77, 0)";
                i = 1;

                // formData.append('image', $('#changep3')[0].files[0]);
                // formData.append('username', $('#usernamee').val());
                // formData.append('userpassword', $('#passworde').val());
                // formData.append('confirm_password', $('#confirm_passworde').val());
                $.ajax({
                    url: '../adminSection/adminActionreq/secondarydisplay.php',
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

                        fnameec = $('#fnamee').val();
                        lnameec = $('#lnamee').val();
                        mnameec = $('#mnamee').val();
                        positionec = $('#positione').val();
                        departmentec = $('#departmente').val();
                        roomec = $('#roome').val();
                        gnec = $('#gne').val();
                        setTimeout(function () {
                            $("#cont-editform .loadingSc").hide();
                            secondary.style.visibility = "visible";

                        }, 1000);
                        handleimg(4);
                    }
                });

            } else {
                i = 1;
            }
        } else if (point == 'button1') {
            if (i == 1) {
                $("#cont-editform .loadingSc").show();

                formData = new FormData();



                console.log('2timesbutton1');
                document.getElementById('button2').style.backgroundColor = "transparent";
                document.getElementById('button1').style.backgroundColor = "rgb(193, 77, 0)";
                $(".secondaryaskedit-inner").html('');

                formData.append('userId', userId);

                $.ajax({
                    url: '../adminSection/adminActionreq/primarydisplay.php',
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
                i = 0;

            } else {
                i = 0;
            }
        }
    });








    $("#admins").on("click", "#men", function (e) {
        e.preventDefault();
        // // console.log("hikusama");
        // if (emptfile) {
        //     // console.log("ept Readed");
        // } else {
        //     // console.log("not Readed");
        // }
        const hasClass = $(this).closest("li").find(".grupi").hasClass("grupiNew");

        $("#admins .grupi").removeClass("grupiNew");

        $(this).closest("li").find(".grupi").addClass("grupiNew");

        if (hasClass) {
            $(this).closest("li").find(".grupi").removeClass("grupiNew");
        }
    });


    $("#admins #searchResults").on("click", ".showact .act1", function (e) {
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
        adminId = parseInt(valueBeforeN);
        userId = parseInt(valueAfterN);
        console.log(adminId);
        console.log(userId);

    });

    let filepicfordel;
    $("#admins").on("click", ".showact .act2", function (e) {
        e.preventDefault();
        catchid = $(this).attr('id');

        nIndex = catchid.indexOf('n');
        valueBeforeN = catchid.substring(3, nIndex);

        valueAfterN = catchid.slice(nIndex + 1);
        adminId = parseInt(valueBeforeN);
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




    $("#admins").on("click", ".showact .act3", function (e) {
        e.preventDefault();
        let formData = new FormData();
        let imgSrc = $(this).closest("li").find(".pfront img").attr('src');
        let catchid = $(this).closest("li").find(".showact .act2").attr('id');
        let nIndex = catchid.indexOf('n');
        let valueBeforeN = catchid.substring(3, nIndex);
        
        let adminId = parseInt(valueBeforeN);
        console.log(" before N:" + valueBeforeN);
        console.log(adminId);
        formData.append('imgdp', imgSrc);
        formData.append('spid', adminId);

        $.ajax({
            url: '../adminSection/adminActionreq/viewinfo.php',
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



    $("#admins .btad").on("click", "#addadminaccount", function (e) {
        e.preventDefault();
        $("#back").show();
        $("#overlayform").show();
        $("#cont-removeform").hide();
        $("#cont-confirmforedit").hide();
        $("#cont-editform").hide();
        $("#cont-viewinform").hide();
        $("#cont-addadmin").show();

    });

    $("#admins").on("click", "#overlayform", function (e) {
        $(this).hide();
        $("#cont-addadmin").hide();
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
    $("#admins").on("click", "#back", function (e) {
        e.preventDefault();

        $("#cont-addadmin").hide();
        $("#overlayform").hide();
        $("#cont-editform").hide();
        $("#conftopass").val('');
        $("#reqeditresponse").html('');
        if (isEditReqGranted === true) {
            searchRefresh();
            isEditReqGranted = false;
        }


    });

    $(".addedsuc").on("click", "#done", function (e) {
        e.preventDefault();
        loadingScreen.show();

        $('#fnamec').val("");
        $('#lnamec').val("");
        $('#mnamec').val("");
        $('#emailc').val("");
        $('#positionc').val("");
        $('#departmentc').val("");
        $('#roomc').val("");
        $('#gn').val("");
        $('#usernamec').val("");
        $('#passwordc').val("");
        $('#confirm_passwordc').val("");
        $('#errorDisplay').html("");
        $("#overlayform").hide();
        $("#overlayform2").hide();
        $(".addedsuc").hide();
        $("#cont-addadmin").hide();
        $("#profdisplay2").attr("src", "../../images/mali.png");
        $('#changep2').val('');
        $("#cont-removeform input").val("");
        $("#cont-removeform #responsetodel").val("");
        $("#responsetodel").html("");
        $("#cont-removeform").hide();
        $('#pwdd').val('');
        searchRefresh();


    });


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
                url: '../adminSection/adminActionreq/primarydisplay.php',
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

            console.log('jimomowarayyyyyyy');
            console.log(i);

            $("#cont-editform .loadingSc").show();
            formData = new FormData();
            formData.append('adminId', adminId);
            $(".primaryaskedit").html('');
            $.ajax({
                url: '../adminSection/adminActionreq/secondarydisplay.php',
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

                    fnameec = $('#fnamee').val();
                    lnameec = $('#lnamee').val();
                    mnameec = $('#mnamee').val();
                    positionec = $('#positione').val();
                    departmentec = $('#departmente').val();
                    roomec = $('#roome').val();
                    gnec = $('#gne').val();
                    setTimeout(function () {
                        $("#cont-editform .loadingSc").hide();
                        secondary.style.visibility = "visible";

                    }, 1000);
                    handleimg(4);
                }
            });


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
    let query = '', searchQuery = "%" + query + "%";
    $('.outlosd').show();

    $.ajax({

        url: '../adminSection/adminActionreq/search.php',
        method: 'GET',
        data: { query: searchQuery },
        success: function (response) {
            $("#searchResults").html(response);
        }, complete: function () {
            $('.outlosd').hide();
        }
    });
}




