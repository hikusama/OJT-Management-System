









$(document).ready(function () {



    $('#searchTypeForm').submit(function (e) {
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
    


    $('#onebone').click(function (e) {
        e.preventDefault();
        if ($(this).hasClass('newenrollbutton')) {

        } else {
            $('#bygroup').removeClass('newenrollbutton');
            $(this).addClass('newenrollbutton');
        }
    });
    $('#bygroup').click(function (e) {
        e.preventDefault();
        if ($(this).hasClass('newenrollbutton')) {

        } else {
            $('#onebone').removeClass('newenrollbutton');
            $(this).addClass('newenrollbutton');
        }

    });

    let clickCountReq = 1;
    let rightSidepane = document.getElementById('rightSidepane');
    $('#enrollStudent').click(function (e) {
        e.preventDefault(); enrollStudent
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

    $('#onebone').click(function (e) {
        e.preventDefault();
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


    $('#bygroup').click(function (e) {
        e.preventDefault();
        if (clickCountReq == 3) {
            clickCountReq = 2;
            $('.loadli').show();
            $.ajax({
                type: "POST", 
                url: "../enrollSection/enrollActionReq/getCourse.php",
                success: function (response) {
                    $('#studContent').html(response);
                },
                complete: function () {
                    setTimeout(() => {
                        $('.loadli').hide();
                    }, 3000);
                }
            });
        }
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