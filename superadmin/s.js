






const studnum =$('#studnum').textContent;
const coor =$('#coor').textContent;
const trainees =$('#trainees').textContent;
const admins =$('#ad').textContent;

const studval = parseInt(studnum);
const coorval = parseInt(coor);
const trval = parseInt(trainees);
const adminval = parseInt(admins);
console.log(studval);
console.log(coorval);
console.log(trval);
console.log(admins);

const xValues = ["Students", "Trainee", "Coordinator", "Admin"];
const yValues = [studnum, coorval, trval, adminval];
const barColors = [
  "rgb(0, 174, 255)",
  "rgb(151, 35, 0)",
  "rgb(2, 165, 2)",
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


const currentDate = new Date();

const year = currentDate.getFullYear();
const month = currentDate.toLocaleString('en-US', { month: 'long' });
const day = currentDate.getDate();
const weekday = currentDate.toLocaleString('en-US', { weekday: 'long' });

$('#year').textContent =  year;
$('#month').textContent =  month;
$('#day').textContent =  day;
$('#weekday').textContent =  weekday;







function $(s) {
  return document.querySelector(s);

}
