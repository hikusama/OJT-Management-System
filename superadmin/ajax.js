$(document).ready(function () {

    var loadingScreen = $(".outlosd");





    var suprevId, userId, fn, query = '';
    var searchQuery = "%" + query + "%";

    $.ajax({
        url: 'search.php',
        method: 'GET',
        data: { query: searchQuery },
        success: function (response) {
            $("#searchResults").html(response);
        },

    });

    $("#searchForm").submit(function (event) {
        event.preventDefault();

        loadingScreen.show();
        var query = $("#searchInput").val();

        var searchQuery = "%" + query + "%";

        $.ajax({
            url: 'search.php',
            method: 'GET',
            data: { query: searchQuery },
            success: function (response) {
                $("#searchResults").html(response);
            },
            complete: function () {
                loadingScreen.hide();
            }
        });
    });

    var ap;
    $('#changep2, #fnamec, #lnamec, #mnamec, #emailc, #positionc, #departmentc, #roomc, #gn, #usernamec, #passwordc, #confirm_passwordc').on('change', function () {
        formData = new FormData();

        // Append file input
        formData.append('image', $('#changep2')[0].files[0]);

        // Append other form data
        formData.append('fname', $('#fnamec').val());
        formData.append('lname', $('#lnamec').val());
        formData.append('mname', $('#mnamec').val());
        formData.append('email', $('#emailc').val());
        formData.append('position', $('#positionc').val());
        formData.append('department', $('#departmentc').val());
        formData.append('room', $('#roomc').val());
        formData.append('gender', $('#gn').val());

        formData.append('username', $('#usernamec').val());
        formData.append('userpassword', $('#passwordc').val());
        formData.append('confirm_password', $('#confirm_passwordc').val());
        // console.log("lib");


        $.ajax({
            url: 'mvcAddcoor/addcoor.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#errorDisplay').html(response);

            }
        });

        console.log("corabut");
        fnout = $('#fnamec').val();
        lnout = $('#lnamec').val();

    });


    // var fnout,lnout;

    $('#coordinators').on("click", ".coradbut label", function (e) {
        e.preventDefault();
        if ($('#errorDisplay .setd').html() === 'All Set') {
            loadingScreen.show();
            console.log('enteredfff');
            fnout = $('#fnamec').val();
            mdnout = $('#mnamec').val();
            lnout = $('#lnamec').val();
            formData.append('fname', fnout);
            formData.append('lname', lnout);
            formData.append('iseror', 'gdtg');
            formData.append('mname', $('#mnamec').val());
            formData.append('email', $('#emailc').val());
            formData.append('position', $('#positionc').val());
            formData.append('department', $('#departmentc').val());
            formData.append('room', $('#roomc').val());
            formData.append('gender', $('#gn').val());

            formData.append('username', $('#usernamec').val());
            formData.append('userpassword', $('#passwordc').val());
            formData.append('confirm_password', $('#confirm_passwordc').val());


            $.ajax({
                url: 'mvcAddcoor/addcoor.php',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#errorDisplay').html(response);


                },
                complete: function () {
                    loadingScreen.hide();
                    if ($('#errorDisplay .formsuc').html() == 'success') {
                        console.log('adadad');
                        $("#cont-addcoor").hide();
                        $("#cont-removeform").hide();
                        $("#cont-confirmforedit").hide();
                        $("#cont-viewinform").hide();
                        $("#overlayform2").show();
                        $(".addedsuc .name h1").html("added successfully");
                        let setC = document.querySelector(".addedsuc .name h1");
                        setC.style.color = "rgb(0, 184, 77)";
                        addedSound.currentTime = 0;
                        addedSound.play();
                        fulln = fnout + ' ' + mdnout + ' ' + lnout;
                        $(".addedsuc").show();
                        forresponseinact(fulln, 1, emptfile);
                    }
                }
            });



        }


    });



    $('#rmformreq').submit(function (event) {
        event.preventDefault();
        var formData = new FormData();
        loadingScreen.show();
        formData.append('password', $('#pwdd').val());
        formData.append('suprevId', suprevId);
        formData.append('userId', userId);

        $.ajax({
            url: 'actionreq/delete.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#responsetodel').html(response);
            },
            complete: function () {

                if ($('#responsetodel .successresp').html() == 'success') {

                    $("#overlayform2").show();
                    $(".addedsuc").show();
                    $("#cont-addcoor").hide();
                    $("#cont-removeform").hide();
                    $("#cont-confirmforedit").hide();
                    $("#cont-viewinform").hide();
                    $(".addedsuc .name h1").html("deleted successfully");
                    let setC = document.querySelector(".addedsuc .name h1");
                    setC.style.color = "red";
                    $("#blinkround").hide();
                    addedSound.currentTime = 0;
                    addedSound.play();

                    forresponseinact(fn, 2, filepicfordel);
                }
                loadingScreen.hide();
            }

        });

    });


    // Unfinished
    // Unfinished
    // Unfinished
    // Unfinished
    // Unfinished
    // Unfinished
    // Unfinished
    // Unfinished
    // Unfinished
    $('#editformreq').submit(function (event) {
        event.preventDefault();
        var formData = new FormData();
        loadingScreen.show();
        formData.append('conftopass', $('#conftopass').val());

        $.ajax({
            url: 'actionreq/update.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {

                $('#reqeditresponse').html(response);

            },
            complete: function () {

                loadingScreen.hide();
            }

        });

    });


    $('#cont-editform').on('change', '#changep3, #fnamee, #lnamee, #mnamee, #positione, #departmente, #roome, #gne', function () {
        formData = new FormData();
        console.log("corabut");

        // Append file input
        formData.append('image', $('#changep3')[0].files[0]);

        // Append other form data
        formData.append('fname', $('#fnamee').val());
        formData.append('lname', $('#lnamee').val());
        formData.append('mname', $('#mnamee').val());
        formData.append('position', $('#positione').val());
        formData.append('department', $('#departmente').val());
        formData.append('room', $('#roome').val());
        formData.append('gender', $('#gne').val());

        // formData.append('username', $('#usernamee').val());
        // formData.append('userpassword', $('#passworde').val());
        // formData.append('confirm_password', $('#confirm_passworde').val());
        // console.log("lib");


        $.ajax({
            url: 'updatePattern/checkBeforeupdate.php',
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


    $('#usernamee, #passworde, #confirm_passworde').on('change', function () {
        formData = new FormData();

        // Append file input
        // formData.append('image', $('#changep3')[0].files[0]);

        // Append other form data
        // formData.append('fname', $('#fnamee').val());
        // formData.append('lname', $('#lnamee').val());
        // formData.append('mname', $('#mnamee').val());
        // formData.append('email', $('#emaile').val());
        // formData.append('position', $('#positione').val());
        // formData.append('department', $('#departmente').val());
        // formData.append('room', $('#roome').val());
        // formData.append('gender', $('#gne').val());

        formData.append('username', $('#usernamee').val());
        formData.append('userpassword', $('#passworde').val());
        formData.append('confirm_password', $('#confirm_passworde').val());
        console.log("lib");


        $.ajax({
            url: 'updatePattern/primaryupdate.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $('#secondaryErrorDisplay').html(response);

            }
        });

        console.log("corabut");
        fnout = $('#fnamec').val();
        lnout = $('#lnamec').val();

    });


    let pasid;
    $('#secondarysec').submit(function (event) {
        event.preventDefault();
        formData = new FormData();
        console.log("corabutaaaaaaaaaaaaa");
        console.log(idToBePass);

        // Append file input
        formData.append('image', $('#changep3')[0].files[0]);

        // Append other form data
        formData.append('key',idToBePass);
        formData.append('fname', $('#fnamee').val());
        formData.append('fname', $('#fnamee').val());
        formData.append('lname', $('#lnamee').val());
        formData.append('mname', $('#mnamee').val());
        formData.append('position', $('#positione').val());
        formData.append('department', $('#departmente').val());
        formData.append('room', $('#roome').val());
        formData.append('gender', $('#gne').val());

        $.ajax({
            url: 'updatePattern/submitUpdate.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {

                $('#secondaryErrorDisplay').html(response);

            },
            complete: function () {

                loadingScreen.hide();
            }

        });


    });
    
    

    $("#cont-editform").on("click", ".coradbut button", function (e) {
        pasid = $('.coradbut button').attr('id');
        pasid = pasid.substring(2);
        idToBePass = parseInt(pasid);
        
    });
    
    let i = 0;

    $("#cont-editform").on("click", ".tabinedit button", function (e) {
        e.preventDefault();
        $(".loadingSc").show();

        
        let point = $(this).attr('id');
        // console.log(point);
        // console.log(i);
        supervId = 91;
        userId = 135;
        if (point == 'button2') {
            if (i == 0) {
                formData = new FormData();
                $(".primaryaskedit").html('');
                // var imgSrc = $(this).closest(".secondaryaskedit-inner").find(".chpic img").attr('src');
                document.getElementById('button1').style.backgroundColor = "transparent";
                document.getElementById('button2').style.backgroundColor = "rgb(193, 77, 0)";
                i += 1;
                formData.append('supervId', supervId);

                // formData.append('image', $('#changep3')[0].files[0]);
                // formData.append('username', $('#usernamee').val());
                // formData.append('userpassword', $('#passworde').val());
                // formData.append('confirm_password', $('#confirm_passworde').val());

                $.ajax({
                    url: 'actionreq/secondaryupdate.php',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log('jimomo');
                        $('.secondaryaskedit-inner').html(response);

                    },
                    complete: function () {
                        setTimeout(function () {


                            $(".loadingSc").hide();
                        }, 1000);
                        handleimg(4);


                    }

                });
                // console.log('2timesbutton2');
            } else {
                i = 1;

            }

        } else if (point == 'button1') {

            if (i = 1) {

                formData = new FormData();


                console.log('2timesbutton1');
                document.getElementById('button2').style.backgroundColor = "transparent";
                document.getElementById('button1').style.backgroundColor = "rgb(193, 77, 0)";
                $(".secondaryaskedit-inner").html('');
                i = 0;

                formData.append('userId', userId);


                // formData.append('fname', $('#fnamee').val());
                // formData.append('lname', $('#lnamee').val());
                // formData.append('mname', $('#mnamee').val());
                // formData.append('email', $('#emaile').val());
                // formData.append('position', $('#positione').val());
                // formData.append('department', $('#departmente').val());
                // formData.append('room', $('#roome').val());
                // formData.append('gender', $('#gne').val());
                // console.log('1times');
                // console.log('2times');
                $.ajax({
                    url: 'actionreq/primaryupdate.php',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(userId);

                        $('.primaryaskedit').html(response);

                    },
                    complete: function () {
                        setTimeout(function () {
                            $(".loadingSc").hide();

                        }, 2000);


                    }



                });

            } else {

                i = 0;
            }

        }

    });


    // $('#coordinators').on("click", "#rmformreq button", function (e) {
    //     e.preventDefault();

    //     if ($('#sakses').val()) {
    //         var formData = new FormData();
    //         // Append form data for the button click event
    //         formData.append('sakses', $('#sakses').val());
    //         formData.append('password', $('#pwdd').val());
    //         formData.append('suprevId', suprevId);
    //         formData.append('userId', userId);

    //         $.ajax({
    //             url: 'deletecoor/delete.php',
    //             method: 'POST',
    //             data: formData,
    //             contentType: false, // Set to false when using FormData
    //             processData: false, // Set to false when using FormData
    //             success: function (response) {
    //                 $('#responsetodel').html(response);
    //             }

    //         });

    //         // console.log("lib2222");

    //         // if ($('#responsetodel').html() === '') {

    //         // }
    //         $(".addedsuc").show();
    //         addedSound.currentTime = 0;
    //         addedSound.play();
    //         $('#responsetodel').html(' ');
    //         $('.distributed').html(' ');
    //         $('#pwdd').val(' ');
    //         pastilsows = "../images/stampdel.png";
    //         forresponseinact(pastilsows, fn, 2, filepicfordel);
    //     }


    // });






    $("#coordinators").on("click", "#men", function (e) {
        e.preventDefault();
        // // console.log("hikusama");
        // if (emptfile) {
        //     // console.log("ept Readed");
        // } else {
        //     // console.log("not Readed");

        // }


        const hasClass = $(this).closest("li").find(".grupi").hasClass("grupiNew");

        $("#coordinators .grupi").removeClass("grupiNew");

        $(this).closest("li").find(".grupi").addClass("grupiNew");

        if (hasClass) {
            $(this).closest("li").find(".grupi").removeClass("grupiNew");
        }
    });

    $("#coordinators #searchResults").on("click", ".showact .act1", function (e) {
        e.preventDefault();
        $("#overlayform").show();
        $("#cont-confirmforedit").show();
        $("#cont-removeform").hide();
        $("#cont-viewinform").hide();
        catchid = $(this).attr('id');
        nIndex = catchid.indexOf('n');
        valueBeforeN = catchid.substring(3, nIndex);

        valueAfterN = catchid.slice(nIndex + 1);
        suprevId = parseInt(valueBeforeN);
        userId = parseInt(valueAfterN);

    });

    let filepicfordel;
    $("#coordinators").on("click", ".showact .act2", function (e) {
        e.preventDefault();
        catchid = $(this).attr('id');

        nIndex = catchid.indexOf('n');
        valueBeforeN = catchid.substring(3, nIndex);

        valueAfterN = catchid.slice(nIndex + 1);
        suprevId = parseInt(valueBeforeN);
        userId = parseInt(valueAfterN);

        // console.log(" before N:" + valueBeforeN);
        // console.log(" after N:" + valueAfterN);

        fn = $(this).parent().attr('id').replace(/_/g, " ");
        filepicfordel = $(this).closest("li").find(".pfront img").attr('src');

        // console.log(filepicfordel);
        // if (fileInput) {

        //     var reader = new FileReader();
        //     reader.onload = function(event) {
        //         var fileData = event.target.result;
        // console.log("File data:", fileData);
        //         // Now you have the file data, you can use it as needed
        //     };
        //     reader.readAsDataURL(fileInput);
        // }



        // var idusr = ;
        $("#overlayform").show();
        $("#cont-removeform").show();
        $("#cont-confirmforedit").hide();
        $("#cont-viewinform").hide();
    });




    $("#coordinators").on("click", ".showact .act3", function (e) {
        e.preventDefault();
        var formData = new FormData();
        var imgSrc = $(this).closest("li").find(".pfront img").attr('src');
        var catchid = $(this).closest("li").find(".showact .act2").attr('id');
        var nIndex = catchid.indexOf('n');
        var valueBeforeN = catchid.substring(3, nIndex);
        loadingScreen.show();
        // console.log(" before N:" + valueBeforeN);
        var suprevId = parseInt(valueBeforeN);
        // console.log(suprevId);

        formData.append('imgdp', imgSrc);
        formData.append('spid', suprevId);

        $.ajax({
            url: 'actionreq/viewinfo.php',
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
                loadingScreen.hide();
                if ($("#cont-viewinform")) {

                    var prp = $("#vinfo");

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


    $("#coordinators").on("click", "#overlayform", function (e) {
        $(this).hide();
        $("#cont-removeform").hide();
        $("#cont-confirmforedit").hide();
        $("#cont-viewinform").hide();
    });

    $("#coordinators .btad").on("click", "#addcooraccount", function (e) {
        e.preventDefault();
        $("#back").show();
        $("#overlayform").show();
        $("#cont-removeform").hide();
        $("#cont-confirmforedit").hide();
        $("#cont-viewinform").hide();
        $("#cont-addcoor").show();

    });

    $("#coordinators").on("click", "#overlayform", function (e) {
        $(this).hide();
        $("#cont-addcoor").hide();
        $("#cont-removeform").hide();
        $("#cont-confirmforedit").hide();
        $("#cont-viewinform").hide();
        $(".addedsuc").hide();

    });
    $("#coordinators").on("click", "#back", function (e) {
        e.preventDefault();
        $("#cont-addcoor").hide();
        $("#overlayform").hide();


    });
    // $("#errorDisplay").on("click", "#addNewcoor", function (e) {
    //     e.preventDefault();

    //     $("#addedSound")[0].play();
    console.log("entered");
    // });


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
        $("#cont-addcoor").hide();
        $("#profdisplay2").attr("src", "../images/mali.png");
        $('#changep2').val('');
        $("#cont-removeform input").val("");
        $("#cont-removeform #responsetodel").val("");
        $("#cont-removeform .successresp").html("");
        $("#cont-removeform").hide();
        $('#pwdd').val('');
        addedSound.pause();
        addedSound.currentTime = 0;
        var query = '';

        var searchQuery = "%" + query + "%";

        $.ajax({
            url: 'search.php',
            method: 'GET',
            data: { query: searchQuery },
            success: function (response) {
                $("#searchResults").html(response);
            },
            complete: function () {
                loadingScreen.hide();
            }
        });


    });


});









function select(sl) {
    return document.querySelector(sl);
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
            profileImage2.attr('src', '../images/mali.png');

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
            profileImage.attr('src', '../images/mali.png');

        }
    } else if (a === 3) {
        const file = input3.files[0];

        if (file) {
            const reader = new FileReader();
            // console.log("file1");

            reader.onload = function () {
                profileImage3.attr('src', reader.result);
            };

            reader.readAsDataURL(file);
        } else {
            // console.log("invalid");
            profileImage3.attr('src', '../images/mali.png');

        }

    } else if (a == 4) {
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
    nm = $('.name h2');
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




