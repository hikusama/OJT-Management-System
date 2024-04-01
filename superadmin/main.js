const checkbox = document.getElementById('sideCheck');

function handleCheckboxChange() {
    if (this.checked) {
        console.log('hello');
        document.body.classList.add('newAll');
        localStorage.setItem('checkboxState', 'checked');
    } else {
        document.body.classList.remove('newAll');
        localStorage.setItem('checkboxState', 'unchecked');
    }
}

checkbox.addEventListener('change', handleCheckboxChange);

document.addEventListener('DOMContentLoaded', function () {
    const storedCheckboxState = localStorage.getItem('checkboxState');
    if (storedCheckboxState === 'checked') {
        checkbox.checked = true;
        document.body.classList.add('newAll');
    } else if (storedCheckboxState === 'unchecked') {
        checkbox.checked = false;
        document.body.classList.remove('newAll');
    }
$("#overview").show();

});








const studval = 520;
const coorval = 320;
const trval = 53;
const admins = 230;
console.log(studval);
console.log(coorval);
console.log(trval);
console.log(admins);

const xValues = ["Students", "Trainee", "Coordinator", "Admin"];
const yValues = [521, 320, 53, 230];
const barColors = [
    "rgb(0, 191, 224)",
    "rgb(151, 35, 0)",
    "rgb(0, 187, 140)",
    "rgb(104, 0, 165)"
];

new Chart("myChart", {
    type: "pie",
    data: {
        labels: xValues,
        datasets: [{
            backgroundColor: barColors,
            data: yValues
        }]
    },
    options: {
        title: {
            display: true,
            text: "Users"
        }
    }
});

function countTo(target, elementId, duration) {
    const element = document.getElementById(elementId);
    const increment = target / (duration / 1000); // Increment value per millisecond
    let current = 0;

    const intervalId = setInterval(() => {
        current += increment;
        if (current >= target) {
            clearInterval(intervalId);
            current = target; // Ensure exact target value is displayed
        }
        element.textContent = Math.round(current); // Update text content
    }, 1); // Run every millisecond
}

// Start counting animation for each element

countTo(studval, "studnum", 400000);
countTo(coorval, "coor", 400000);
countTo(trval, "trainees", 400000);
countTo(admins, "ad", 400000);


$(document).ready(function () {


    $(document).on("click", "#tabs label", function (e) {
        e.preventDefault(); // Prevent default link behavior

        $("#tabs label").removeClass("on");
        $(this).addClass("on");

        var page = $(this).find("a").attr("href").substr(1);
        console.log(page);
        // switch (page) {
        //     case "overview":
        //         $("#coordinators").hide();
        //         $("#admins").hide();
        //         $("#students").hide();
        //         $("#enroll").hide();
        //         $("#mails").hide();
        //         $("#settings").hide();
        //         // $("#overview").hide();
        //     break;
        //     case "coordinators":
        //         // $("#coordinators").hide();
        //         $("#admins").hide();
        //         $("#students").hide();
        //         $("#enroll").hide();
        //         $("#mails").hide();
        //         $("#settings").hide();
        //         $("#overview").hide();
        //     break;
        //     case "admins":
        //         $("#coordinators").hide();
        //         // $("#admins").hide();
        //         $("#students").hide();
        //         $("#enroll").hide();
        //         $("#mails").hide();
        //         $("#settings").hide();
        //         $("#overview").hide();
        //     break;
        //     case "students":
        //         $("#coordinators").hide();
        //         $("#admins").hide();
        //         // $("#students").hide();
        //         $("#enroll").hide();
        //         $("#mails").hide();
        //         $("#settings").hide();
        //         $("#overview").hide();
        //     break;
        //     case "enroll":
        //         $("#coordinators").hide();
        //         $("#admins").hide();
        //         $("#students").hide();
        //         // $("#enroll").hide();
        //         $("#mails").hide();
        //         $("#settings").hide();
        //         $("#overview").hide();
        //     break;
        //     case "mails":
        //         $("#coordinators").hide();
        //         $("#admins").hide();
        //         $("#students").hide();
        //         $("#enroll").hide();
        //         // $("#mails").hide();
        //         $("#settings").hide();
        //         $("#overview").hide();
        //     break;
        //     case "setting":
        //         $("#coordinators").hide();
        //         $("#admins").hide();
        //         $("#students").hide();
        //         $("#enroll").hide();
        //         $("#mails").hide();
        //         // $("#settings").hide();
        //         $("#overview").hide();
        //     break;

        //     default:
        //         $("#content").hide();
        //     break;
        // }
        $("#content > *").hide();


        $("#" + page).show();
        checkbox.checked = false;
        handleCheckboxChange();
        if (page == "overview") {
            countTo(studval, "studnum", 400000);
            countTo(coorval, "coor", 400000);
            countTo(trval, "trainees", 400000);
            countTo(admins, "ad", 400000);
        }
    });

    $("#coordinators ul").on("click", "#men", function (e) {
        e.preventDefault();
        console.log("hikusama");

        const hasClass = $(this).closest("li").find(".grupi").hasClass("grupiNew");

        $("#coordinators ul .grupi").removeClass("grupiNew");

        $(this).closest("li").find(".grupi").addClass("grupiNew");

        if (hasClass) {
            $(this).closest("li").find(".grupi").removeClass("grupiNew");
        }
    });

    $("#coordinators ul").on("click", ".showact .act1", function (e) {
        e.preventDefault();
        $("#overlayform").show();
        $("#cont-editform").show();
        $("#cont-removeform").hide();
        $("#cont-viewinform").hide();
    });
    $("#coordinators ul").on("click", ".showact .act2", function (e) {
        e.preventDefault();
        $("#overlayform").show();
        $("#cont-removeform").show();
        $("#cont-editform").hide();
        $("#cont-viewinform").hide();
    });
    $("#coordinators ul").on("click", ".showact .act3", function (e) {
        e.preventDefault();
        $("#overlayform").show();
        $("#cont-removeform").hide();
        $("#cont-editform").hide();
        $("#cont-viewinform").show();
    });

    $("#coordinators ul").on("click", "#overlayform", function (e) {
        $(this).hide();
        $("#cont-removeform").hide();
        $("#cont-editform").hide();
        $("#cont-viewinform").hide();
    });

});


const currentDate = new Date();

const year = currentDate.getFullYear();
const month = currentDate.toLocaleString('en-US', { month: 'long' });
const day = currentDate.getDate();
const weekday = currentDate.toLocaleString('en-US', { weekday: 'long' });

select('#year').textContent = year;
select('#month').textContent = month;
select('#day').textContent = day;
select('#weekday').textContent = weekday;







function handleimg() {
    const profileImage = $('#profdisplay');
    const input = $('#changep');
    const file = input.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function () {
            profileImage.src = reader.result;
        };

        reader.readAsDataURL(file);
    } else {
        redpack.style.borderColor = 'white';
        profileImage.src = 'images/def.png';
    }
}
function select(sl) {
    return document.querySelector(sl);
}