


let loadingScreen = $(".outlosd");


// $('.addedsuc2').hide();
// $('.addedsuc').hide();
let suprevId, userId, fn, query = '';
let fnameec, lnameec, mnameec, positionec, departmentec, roomec, gnec;

let searchQuery = "%" + query + "%";





$(document).ready(function () {
    let isDefault = true;
    // let isCoordinatorsFuncReady = false;














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




    const xValues = ["Students", "Trainee", "Coordinator", "Admin"];
    const yValues = [521, 320, 53, 230];
    const barColors = [
        "rgb(0, 191, 224)",
        "rgb(151, 35, 0)",
        "rgb(0, 187, 140)",
        "rgb(104, 0, 165)"
    ];
    const studval = 520;
    const coorval = 320;
    const trval = 53;
    const admins = 230;
    console.log(studval);
    console.log(coorval);
    console.log(trval);
    console.log(admins);

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



    // $("#overview").show();

    // $('.lardgeSide').on('change', checkbox ,function (e) {
    //     e.preventDefault();
    //     handleCheckboxChange();
    // });


    // function select(sl) {
    //     return document.querySelector(sl);
    // }


    countTo(studval, "studnum", 400000);
    countTo(coorval, "coor", 400000);
    countTo(trval, "trainees", 400000);
    countTo(admins, "ad", 400000);


    const currentDate = new Date();

    const year = currentDate.getFullYear();
    const month = currentDate.toLocaleString('en-US', { month: 'long' });
    const day = currentDate.getDate();
    const weekday = currentDate.toLocaleString('en-US', { weekday: 'long' });

    $('#year').html(year);
    $('#month').html(month);
    $('#day').html(day);
    $('#weekday').html(weekday);




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




function countTo(target, elementId, duration) {
    const element = document.getElementById(elementId);
    const increment = target / (duration / 1000);
    let current = 0;

    const intervalId = setInterval(() => {
        current += increment;
        if (current >= target) {
            clearInterval(intervalId);
            current = target;
        }
        element.innerHTML = Math.round(current);
    }, 1);
    console.log(element);
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





