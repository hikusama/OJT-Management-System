
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



// counting function 
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
        element.textContent = Math.round(current);
    }, 1); 
}

// Start counting animation per user
countTo(studval, "studnum", 400000);
countTo(coorval, "coor", 400000);
countTo(trval, "trainees", 400000);
countTo(admins, "ad", 400000);








// date and time obviously
const currentDate = new Date();

const year = currentDate.getFullYear();
const month = currentDate.toLocaleString('en-US', { month: 'long' });
const day = currentDate.getDate();
const weekday = currentDate.toLocaleString('en-US', { weekday: 'long' });

select('#year').textContent = year;
select('#month').textContent = month;
select('#day').textContent = day;
select('#weekday').textContent = weekday;






// uploading profile 2section

// function handleimg(a) {
//     const profileImage = $('#profdisplay');
//     const input = $('#changep')[0];
//     const profileImage2 = $('#profdisplay2');
//     const input2 = $('#changep2')[0];

//     if (a === 2) {
//         const file2 = input2.files[0];
//         if (file2) {
//             const reader2 = new FileReader();
//             console.log("file2");

//             reader2.onload = function () {
//                 profileImage2.attr('src', reader2.result);
//             };

//             reader2.readAsDataURL(file2);
//         } else {
//             console.log("invalid");
//             profileImage.attr('src', 'images/def.png');

//         }
//     } else if (a === 1) {
//         const file = input.files[0];
//         if (file) {
//             const reader = new FileReader();
//             console.log("file1");

//             reader.onload = function () {
//                 profileImage.attr('src', reader.result);
//             };

//             reader.readAsDataURL(file);
//         } else {
//             console.log("invalid");
//             profileImage.attr('src', 'images/def.png');

//         }
//     }








// }


// for the check box nav
function handleDeviceWidth() {
    const deviceWidth = window.innerWidth;
    if (deviceWidth <= 665) {
        return true;
    } else {
        return false;
    }
}

handleDeviceWidth();

window.addEventListener('resize', handleDeviceWidth);

function select(sl) {
    return document.querySelector(sl);
}