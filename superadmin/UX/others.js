







$(document).ready(function () {



    refreshDisplayProg();


    $('#searchCourse').submit(function (e) {
        e.preventDefault();
        let query = $('#searchInput').val();
        let searchQuery = "%" + query + "%";
        $('.outlosd').show();
        $.ajax({
            method: "GET",
            url: "../otherSection/programActionReq/search.php",
            data: { searchQuery: searchQuery }, // Changed 'query' to 'searchQuery'
            success: function (response) {
                $('#programCatalogContent').html(response);
            },
            complete: function () {
                $('.outlosd').hide();
            }
        });
    });



    // -------------------CHECKING -------------------

    $('#submitDept').on('change', '#deptacrn, #dpt, #image', function (a) {
        a.preventDefault();


        formData = new FormData();
        let dpt = $('#dpt').val();
        let dacrn = $('#deptacrn').val();

        formData.append('image', $('#image')[0].files[0]);
        formData.append('dpt', dpt);
        formData.append('dacrn', dacrn);

        $.ajax({
            url: '../otherSection/adding/addDeptCheck.php',
            data: formData,
            method: 'post',
            contentType: false,
            processData: false,
            success: function (response) {
                $('#deptErrorResponse').html(response);
                response = response.trim();

                if (response === 'Dept Section Ready') {
                    isBopen = true;
                    isDeptReadyToSubmit = true;
                }
            },
            complete: function () {

            }
        });

    });


    $('.formsact2 input').click(function () {
        $('.suggestDpt').hide();
    });



    $('#deptBel').click(function () {
        $('.suggestDpt').show();

    });
    let isCourseReady = false;
    let isCourseReadyToSubmit = false;
    let isDeptReadyToSubmit = false;

    let deptId;

    $('#submitCourse').on('change', '#crsacrn, #course', function (a) {
        a.preventDefault();

        if (isCourseReady == true) {
            formData = new FormData();

            console.log(deptId);
            let course = $('#course').val();
            let cacrn = $('#crsacrn').val();

            formData.append('dept_id', deptId);
            formData.append('course', course);
            formData.append('cacrn', cacrn);


            $.ajax({
                url: '../otherSection/adding/addCourseCheck.php',
                data: formData,
                method: 'post',
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#courseErrorResponse').html(response);
                    response = response.trim();
                    console.log(isCourseReadyToSubmit);
                    if (response === 'Course Section Ready') {
                        isBopen = true;
                        isCourseReadyToSubmit = true;
                        console.log(isCourseReadyToSubmit);
                    }
                },
                complete: function () {

                }
            });

        }
    });



    $('#submitCourse').submit(function (e) {
        e.preventDefault();

        if (isCourseReadyToSubmit == true) {
            formData = new FormData();
            let course = $('#course').val();
            let cacrn = $('#crsacrn').val();

            formData.append('dept_id', deptId);
            formData.append('course', course);
            formData.append('cacrn', cacrn);
            $.ajax({
                url: '../otherSection/adding/addCourse.php',
                data: formData,
                method: 'post',
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#courseErrorResponse').html(response);
                    response = response.trim();

                    if (response === 'success') {
                        refreshDisplayProg();
                        isBopen = true;
                        $('#courseErrorResponse').html('');
                        $('.responseMssg').show();
                        $('.responseMssg').html('New Courses Added Successfully');
                        $("#overlayform2").show();
                        $("#overlayform").hide();
                        $('#submitCourse input').val('');
                        $('#cont-addCourse').hide();
                    }
                },
                complete: function () {

                }
            });
            isCourseReadyToSubmit = false;
        }



    });




    $('#submitDept').submit(function (e) {
        e.preventDefault();

        if (isDeptReadyToSubmit == true) {
            formData = new FormData();

            let dpt = $('#dpt').val();
            let dacrn = $('#deptacrn').val();

            formData.append('image', $('#image')[0].files[0]);
            formData.append('dpt', dpt);
            formData.append('dacrn', dacrn);

            $.ajax({
                url: '../otherSection/adding/addDept.php',
                data: formData,
                method: 'post',
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#deptErrorResponse').html(response);
                    response = response.trim();

                    if (response === 'success') {
                        isBopen = true;
                        refreshDisplayProg();
                        $('#deptErrorResponse').html('');
                        $('.responseMssg').show();
                        $('.responseMssg').html('New Department Added Successfully');
                        $("#overlayform2").show();
                        $("#overlayform").hide();
                        $('#submitDept input').val('');
                        $('#cont-addCourse').hide();
                        handleimg();
                    }
                },
                complete: function () {

                }

            });
            isDeptReadyToSubmit = false;
        }

    });





    // let isBopen = false;
    // $('#courseAddForm').submit(function (e) {
    //     e.preventDefault();
    //     $('.outlosd2').show();
    //     formData = new FormData();

    //     let course = $('#course').val();
    //     course = course.toLowerCase();
    //     course = course.split(" ");
    //     course = course.map(course => course.charAt(0).toUpperCase() + course.slice(1));
    //     course = course.join(" ");

    //     let dpt = $('#dpt').val();
    //     dpt = dpt.toLowerCase();
    //     dpt = dpt.split(" ");
    //     dpt = dpt.map(dpt => dpt.charAt(0).toUpperCase() + dpt.slice(1));
    //     dpt = dpt.join(" ");

    //     let cacrn = $('#crsacrn').val();
    //     cacrn = cacrn.toUpperCase();

    //     let dacrn = $('#deptacrn').val();
    //     dacrn = dacrn.toUpperCase();
    //     console.log(course);


    //     formData.append('image', $('#image')[0].files[0]);
    //     formData.append('dpt', dpt);
    //     formData.append('course', course);
    //     formData.append('cacrn', cacrn);
    //     formData.append('dacrn', dacrn);

    //     $.ajax({
    //         url: '../otherSection/addCourse.php',
    //         data: formData,
    //         method: 'post',
    //         contentType: false,
    //         processData: false,
    //         success: function (response) {
    //             $('#courseErrorResponse').html(response);
    //             response = response.trim();
    //             
    //             if (response === 'success') {
    //                 isBopen = true;
    //                 $('.responseMssg').show();
    //                 $("#overlayform2").show();
    //                 $("#overlayform").hide();
    //                 console.log(' kkkkkkk');
    //                 $('#courseErrorResponse').html('');
    //                 $('#courseAddForm input').val('');
    //                 handleimg();
    //                 $('#cont-addCourse').hide();
    //                 refreshDisplayProg();

    //             }
    //         },
    //         complete: function () {
    //             $('.outlosd2').hide();

    //         }
    //     });


    // });





    $('#addCourseBtn').click(function (e) {
        e.preventDefault();
        $('#cont-addCourse').show();
        $('#overlayform').show();

    });

    $('#overlayform2').click(function (e) {
        e.preventDefault();
        if (isBopen == true) {
            $('.responseMssg').hide();
            $(this).hide();
            $('#cont-addCourse').show();
            $('#overlayform').show();
            isBopen = false;
        }
    });

    $('.responseMssg').click(function (e) {
        e.preventDefault();
        $(this).hide();
        $("#overlayform2").hide();
        $('#cont-addCourse').show();
        $('#overlayform').show();


    });
    $('#overlayform').click(function (e) {
        e.preventDefault();
        $(this).hide();
        $('#cont-addCourse').hide();
    });



    $('#submitCourse').on('input', '#deptBel', function () {

        console.log('asfasfk');
        let query = $(this).val();
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

    $('.suggestDpt').on('click', 'p', function (e) {
        e.preventDefault();
        $(".suggestDpt").hide();
        $('#deptBel').val($(this).text());
        deptId = $(this).attr('id');
        $('#deptBel').addClass(deptId);
        deptId = deptId.substring(2);
        deptId = parseInt(deptId);
        if (isCourseReady == false) {

            formData = new FormData();

            let course = $('#course').val();
            let cacrn = $('#crsacrn').val();

            formData.append('dept_id', deptId);
            formData.append('course', course);
            formData.append('cacrn', cacrn);

            $.ajax({
                url: '../otherSection/adding/addCourseCheck.php',
                data: formData,
                method: 'post',
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#courseErrorResponse').html(response);
                    response = response.trim();

                    if (response === 'Course Section Ready') {
                        isBopen = true;
                    }
                },
                complete: function () {

                }
            });
            isCourseReady = true;


        }


        // formData = new FormData();
        // formData.append('dept_id',deptId);


        // $.ajax({
        //     method: 'POST',
        //     url: '../otherSection/adding/addCourseCheck.php',
        //     data: formData,
        //     contentType: false,
        //     processData: false,
        //     success: function (response) {
        //         $("#courseErrorResponse").html(response);
        //     },
        //     complete: function () {

        //     }
        // });
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




















    // ----------------------------logout--------------------------




    let isLoginClicked = false;
    $('#logoutClick').click(function (e) {
        e.preventDefault();
        if (isLoginClicked == false) {
            isBopen = false;
            $('.responseMssg').hide();
            $("#overlayform").hide();
            $('#cont-addCourse').hide();
            $('.loggingoutVer').show();
            $('#overlayform2').show();
            $('.loggingoutVer h2').hide();
            isLoginClicked = true;
            if (handleDeviceWidth()) {
                checkbox.checked = false;
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





    $('.responseMssg').hide();
});










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
        document.body.classList.add('newAll');
        localStorage.setItem('checkboxState', 'checked');
    } else {
        document.body.classList.remove('newAll');
        localStorage.setItem('checkboxState', 'unchecked');
    }
}





function handleimg() {
    const profileImage6 = $('#profileImage');
    const input6 = $('#image')[0];

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



function searchRefresh() {
    let query = '', searchQuery = "%" + query + "%";
    $('.outlosd').show();

    $.ajax({
        url: '../otherSection/programActionreq/search.php',
        method: 'GET',
        data: { query: searchQuery },
        success: function (response) {
            $("#searchResults").html(response);
        }, complete: function () {
            $('.outlosd').hide();
        }
    });
}



function refreshDisplayProg() {
    let query = '', searchQuery = "%" + query + "%";
    $('.outlosd').show();
    $.ajax({
        method: "get",
        url: "../otherSection/programActionReq/search.php",
        data: { searchQuery: searchQuery }, 
        success: function (response) {
            $('#programCatalogContent').html(response);
        }, complete: function () {
            $('.outlosd').hide();
        }
    });
}