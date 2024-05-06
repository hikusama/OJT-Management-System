







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





    let isBopen = false;
    $('#courseAddForm').submit(function (e) {
        e.preventDefault();
        formData = new FormData();
        $('.outlosd2').show();

        let course = $('#course').val();
        course = course.toLowerCase();
        course = course.split(" ");
        course = course.map(course => course.charAt(0).toUpperCase() + course.slice(1));
        course = course.join(" ");

        let dpt = $('#dpt').val();
        dpt = dpt.toLowerCase();
        dpt = dpt.split(" ");
        dpt = dpt.map(dpt => dpt.charAt(0).toUpperCase() + dpt.slice(1));
        dpt = dpt.join(" ");

        let cacrn = $('#crsacrn').val();
        cacrn = cacrn.toUpperCase();

        let dacrn = $('#deptacrn').val();
        dacrn = dacrn.toUpperCase();
        console.log(course);


        formData.append('image', $('#image')[0].files[0]);
        formData.append('dpt', dpt);
        formData.append('course', course);
        formData.append('cacrn', cacrn);
        formData.append('dacrn', dacrn);

        $.ajax({
            url: '../otherSection/addCourse.php',
            data: formData,
            method: 'post',
            contentType: false,
            processData: false,
            success: function (response) {
                $('#courseErrorResponse').html(response);
                response = response.trim();
                console.log(response);
                if (response === 'success') {
                    isBopen = true;
                    $('.responseMssg').show();
                    $("#overlayform2").show();
                    $("#overlayform").hide();
                    console.log(' kkkkkkk');
                    $('#courseErrorResponse').html('');
                    $('#courseAddForm input').val('');
                    handleimg();
                    $('#cont-addCourse').hide();
                    refreshDisplayProg();

                }
            },
            complete: function () {
                $('.outlosd2').hide();

            }
        });


    });





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
        url: '../studentSection/studentActionreq/search.php',
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
        method: "GET",
        url: "../otherSection/programActionReq/search.php",
        data: { searchQuery: searchQuery }, // Changed 'query' to 'searchQuery'
        success: function (response) {
            $('#programCatalogContent').html(response);
        }, complete: function () {
            $('.outlosd').hide();
        }
    });
}