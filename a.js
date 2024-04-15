
$(document).ready(function () {
    $(document).on("click", "#contentry .top a", function (e) {
        e.preventDefault();


        var page = $(this).attr("href").substr(1);
        console.log(page);
        if (page == "register") {
            $("#signup").show();
            $("#logn").hide();
        } else if (page == "logn") {
            $("#signup").hide();
            $("#logn").show();
        }
    });

    $("#contentry").on("click", "#xplore", function (e) {
        e.preventDefault();

        $(this).hide();
        $(".entry").show();
        $(".overlaylogn").show();
        console.log(" hello");
    });

    $("#contentry").on("click", ".overlaylogn", function (e) {
        e.preventDefault();
        $(this).hide();
        $(".entry").hide();
        $("#xplore").show();
        console.log(" hello");
    });





    $("#contentry").on("click", ".nxbk i", function (e) {
        e.preventDefault();

        var iconId = $(this).attr("id");
        console.log(iconId);

        switch (iconId) {
            case "backToFirst":
                $('#first').show();
                $('#second').hide();
                $('#last').hide();
                break;
            case "nextToSecond":
                $('#first').hide();
                $('#second').show();
                $('#last').hide();
                break;
            case "backToSecond":
                $('#first').hide();
                $('#second').show();
                $('#last').hide();
                break;
            case "nextToLast":
                $('#first').hide();
                $('#second').hide();
                $('#last').show();
                break;

            default:

                break;
        }

    });

});



function handleImgLogin() {
    const profileImage = $('#profileImage');
    const input = $('#image')[0];

    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        console.log("file1");

        reader.onload = function () {
            profileImage.attr('src', reader.result);
        };

        reader.readAsDataURL(file);
    } else {
        console.log("invalid");
        profileImage.attr('src', 'images/def.png');

    }
}