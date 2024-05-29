

$(document).ready(function () {

    // setTimeout(() => {
    $("#fullload").hide();
    // }, 5000);


    // --------------finding mimong and mimang----------------
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

    $('.icon-input-container').on('input', '#DPT', function () {

        let query = $(this).val().trim();
        let searchQuery = "%" + query + "%";

        $.ajax({
            url: '../OJT-Management-System/login_Signup/signup/getDept.php',
            method: 'GET',
            data: { searchQuery: searchQuery },
            success: function (response) {
                $(".suggestDpt").html(response);
            },
            complete: function () {

            }
        });
    });



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
            url: '../OJT-MANAGEMENT-SYSTEM/login_Signup/signup/secondSectionCheck.php',
            data: formData,
            method: 'post',
            contentType: false,
            processData: false,
            success: function (response) {
                $('#signupResponse2ndsection').html(response);
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


        $('.suggestDpt').hide();
        $('#DPT').val($(this).text());

        formData = new FormData();
        let query = $('#DPT').val();
        formData.append('searchQuery', query);
        $.ajax({
            url: '../OJT-MANAGEMENT-SYSTEM/login_Signup/signup/getCourse.php',
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $(".suggestCrs").html(response);
            }
        });

        if (isWho == true) {

            formData = new FormData();
            formData.append('gender', $('#GN').val());
            formData.append('contact', $('#CNT').val());
            formData.append('address', $('#address').val());
            formData.append('course', $('#CRS').val());
            formData.append('department', $('#DPT').val());


            $.ajax({
                url: '../OJT-MANAGEMENT-SYSTEM/login_Signup/signup/secondSectionCheck.php',
                data: formData,
                method: 'post',
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#signupResponse2ndsection').html(response);
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
            isWho = false;
        }


    });




















    $(document).on("click", "#contentry .top a", function (e) {
        e.preventDefault();


        var page = $(this).attr("href").substr(1);
        // console.log(page);
        if (page == "register") {
            // changeURL('/dashboard');
            $("title").html("Register");
            $("#signup").show();
            $("#logn").hide();
        } else if (page == "logn") {
            $("title").html("Login");
            $("#signup").hide();
            $("#logn").show();
        }
    });

    $("#contentry").on("click", "#xplore", function (e) {
        e.preventDefault();

        $(this).hide();
        $(".entry").show();
        $(".overlaylogn").show();
        // console.log(" hello");
    });

    $("#contentry").on("click", ".overlaylogn", function (e) {
        e.preventDefault();
        $(this).hide();
        $(".entry").hide();
        $("#xplore").show();
        // console.log(" hello");
    });

    /*
    
    --------------------------login-------------------------------
    
    */

    let isLogInRequesting = false;
    $("#loginRequest").submit(function (e) {
        e.preventDefault();
        if (isLogInRequesting == false) {

            $('.outlosd').show();
            let rs;
            formData = new FormData();

            formData.append('username', $('#Logusername').val());
            formData.append('password', $('#Logpassword').val());

            // console.log($('#Logusername').val());
            // console.log($('#Logpassword').val());
            $.ajax({
                url: '../OJT-MANAGEMENT-SYSTEM/login_Signup/login/login.php',
                data: formData,
                method: 'post',
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#loginErrors').html("<p style='color:green;'>" + response + "</p>");
                    rs = response;
                },
                complete: function () {
                    $('.outlosd').hide();
                    if (rs == "You are verified!!") {
                        isLogInRequesting = true;

                        setTimeout(function () {
                            $('#loginErrors').html("<p style='color:rgb(2, 136, 189);'>Redirecting...</p> ");
                        }, 3000);
                        setTimeout(function () {
                            window.location.href = "../OJT-MANAGEMENT-SYSTEM/superadmin/pannelparts/overview.php";
                        }, 5000);
                    }


                }
            });
        }


    });





    /*
    
    --------------------------Signup-------------------------------
    
    */

    // $('change', '#YL', function () {

    // });



    /*
        ----------------------Fist Section Signup----------------------------
    */
    $('#signup').on('change', '#YL', function (e) {
        e.preventDefault();

        if ($('#YL').val()) {
            document.getElementById('YL').style.color = 'rgb(255, 255, 255)';
        } else {

            document.getElementById('YL').style.color = 'rgb(128, 128, 128)';
        }

    });
    $('#signup').on('change', '#GN', function (e) {
        e.preventDefault();

        if ($('#GN').val()) {
            document.getElementById('GN').style.color = 'rgb(255, 255, 255)';
        } else {
            document.getElementById('GN').style.color = 'rgb(128, 128, 128)';
        }

    });



    let isFirstReady;
    $('#signup').on('change', '#SN, #FN, #LN, #MN, #YL', function (e) {
        e.preventDefault();
        formData = new FormData();
        formData.append('student_id', $('#SN').val());
        formData.append('firstname', $('#FN').val());
        formData.append('lastname', $('#LN').val());
        formData.append('middlename', $('#MN').val());
        formData.append('year_level', $('#YL').val());


        $.ajax({
            url: '../OJT-MANAGEMENT-SYSTEM/login_Signup/signup/firstSectionCheck.php',
            data: formData,
            method: 'post',
            contentType: false,
            processData: false,
            success: function (response) {
                $('#signupResponse1stsection').html(response);
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
    ----------------------Second Section Signup----------------------------
    */

    let isSecondReady;
    $('#signup').on('change', '#GN, #CNT, #address, #CRS, #DPT', function () {
        formData = new FormData();
        formData.append('gender', $('#GN').val());
        formData.append('contact', $('#CNT').val());
        formData.append('address', $('#address').val());
        formData.append('course', $('#CRS').val());
        formData.append('department', $('#DPT').val());


        if (isWho == false) {

            $.ajax({
                url: '../OJT-MANAGEMENT-SYSTEM/login_Signup/signup/secondSectionCheck.php',
                data: formData,
                method: 'post',
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#signupResponse2ndsection').html(response);
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

                },
                complete: function () {

                }
            });
        }

    });






    /*
        ----------------------Last Section Signup----------------------------
    */

    let isLastReady;
    $('#signup').on('change', '#UN, #EM, #PW, #CONFPW, #image', function (e) {
        e.preventDefault();
        formData = new FormData();

        formData.append('image', $('#image')[0].files[0]);
        formData.append('email', $('#EM').val());
        formData.append('username', $('#UN').val());
        formData.append('password', $('#PW').val());
        formData.append('conf_pw', $('#CONFPW').val());

        $.ajax({
            url: '../OJT-MANAGEMENT-SYSTEM/login_Signup/signup/lastSectionCheck.php',
            data: formData,
            method: 'post',
            contentType: false,
            processData: false,
            success: function (response) {
                $('#signupResponselastsection').html(response);
                if (response == 'All Set') {
                    isLastReady = true;

                } else {

                    isLastReady = false;
                }
            }
        });


    });



    let getsubmitres;
    $('#signupForm').submit(function (a) {
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
        // console.log('JEASDFD');
        // console.log($('#SN').val());
        if (isFirstReady && isSecondReady && isLastReady) {
            // console.log('aaaaaa');
            $('.outlosdsign').show();

            $.ajax({
                url: '../OJT-MANAGEMENT-SYSTEM/login_Signup/signup/signup.php',
                data: formData,
                method: 'post',
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#signupResponselastsection').html(response);
                    getsubmitres = response;



                },
                complete: function () {
                    if (getsubmitres == 'Account Created Successfully') {
                        $('#signupForm input').val('');
                        $('#signupForm textarea').val('');
                        $('#signupForm select').val('');
                        $('#signupResponse1stsection').html('');
                        $('#signupResponse2ndsection').html('');
                        $('.outlosdsign').hide();
                        $('#nextToSecond').removeClass('newFirst');
                        $('#nextToLast').removeClass('newSecond');
                        document.getElementById('YL').style.color = 'rgb(128, 128, 128)';
                        document.getElementById('GN').style.color = 'rgb(128, 128, 128)';
                        isFirstReady = false;
                        isSecondReady = false;
                        isLastReady = false;

                        setTimeout(() => {
                            $('.redirect').show();
                            $('#signupResponselastsection').html('');

                        }, 1000);


                    }
                }
            });
        }


    });







    /*
        ----------------------Next Button Clicked----------------------------
    */
    $("#contentry").on("click", ".nxbk button", function (e) {
        e.preventDefault();

        var iconId = $(this).attr("id");
        // console.log(iconId);

        if (iconId == "nextToSecond" && isFirstReady == true) {
            // console.log('1st done');
            $('#first').hide();
            $('#second').show();
            $('#last').hide();
        }
        if (iconId == "nextToLast" && isSecondReady == true) {
            // console.log('2nd done');
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

    $('#Createanother').click(function (e) {
        e.preventDefault();
        $('#second').hide();
        $('#last').hide();
        $('#first').show();
        $('.redirect').hide();


    });
    $('#Gotologin').click(function (e) {
        e.preventDefault();
        $('#second').hide();
        $('#first').show();
        $('#last').hide();
        $('#signup').hide();
        $('#logn').show();
        $('.redirect').hide();

    });

});





function setFirstSectionData(sid, fn, ln, mn, yl) {

}

// function changeURL(url) {
//     history.pushState({}, '', url);
//   }

function handleImgLogin() {
    const profileImage = $('#profileImage');
    const input = $('#image')[0];

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
        profileImage.attr('src', 'images/def.png');

    }
}




