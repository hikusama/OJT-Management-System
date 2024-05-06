









$(document).ready(function () {




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
        e.preventDefault();
        rightSidepane.style.transform = "translateX(0)"
        if (clickCountReq == 1) {
            // $('.loadli').show();
            clickCountReq = 3;

            // $.ajax({
            //     type: "post",
            //     url: "../enrollSection/enrollActionReq/notTrainee.php",
            //     success: function (response) {
            //         $('#studContent').html(response);
            //         $('.loadli').show();

            //     }, complete: function () {
            //         setTimeout(() => {
            //             $('.loadli').hide();
            //         }, 3000);
            //     }
            // });
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
            // $('.loadli').show();
            clickCountReq = 2;
            
        }
    });



    $('#back2').click(function (e) {
        e.preventDefault();
        rightSidepane.style.transform = "translateX(20rem) "
    });












});