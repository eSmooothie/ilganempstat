// Your web app's Firebase configuration
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.1.3/firebase-app.js";
import { getDatabase, ref, set, get, child, onValue, update, remove } from "https://www.gstatic.com/firebasejs/9.1.3/firebase-database.js";
var firebaseConfig = {
  apiKey: "AIzaSyA4myV7wAp5hNpjBWT2URSB3k5i-PV-cUc",
  authDomain: "ilgempstat.firebaseapp.com",
  databaseURL: "https://ilgempstat-default-rtdb.firebaseio.com",
  projectId: "ilgempstat",
  storageBucket: "ilgempstat.appspot.com",
  messagingSenderId: "239426682732",
  appId: "1:239426682732:web:21f0f7562aaa4495c47d49",
  measurementId: "G-41V3TF1ZXQ"
};


// Initialize Firebase
const app = initializeApp(firebaseConfig);

// Get database
const db = getDatabase();

var firebaseRef = ref(db, 'IliganData/');

const ctx = document.getElementById('myChart').getContext('2d');



onValue(firebaseRef, function(snapshot) {
const data = snapshot.val();
const regular = data['Regular'];
const contractual = data['Contractual'];
const freelancer = data['Freelancer'];
const parttime = data['PartTime'];
var year = [];
var regularDataset = [];
var contractualDataset = [];
var freelancerDataset = [];
var parttimeDataset = [];

for(const i in contractual){
   contractualDataset.push(contractual[i]);
   year.push(i);
}

for(const i in regular){
   regularDataset.push(regular[i]);
}

for(const i in freelancer){
   freelancerDataset.push(freelancer[i]);
}

for(const i in parttime){
   parttimeDataset.push(parttime[i]);
}

// console.log(data);
// console.log(regularDataset);
// console.log(year);
// console.log(regulars);

// display year range
document.getElementById('year_range').innerHTML = year[0] + " - " + year[year.length - 1];

const myChart = new Chart(ctx, {
   type: 'line',
   data: {
      labels: year,
      datasets: [
      {
         label: 'Regular Employees',
         data: regularDataset,
         fill: false,
         pointStyle: 'rectRot',
         borderColor: 'rgba(255, 165, 0, 1)',
         tension: 0.1,
         pointRadius: 10,
         pointBorderColor: 'rgba(255, 165, 0, 1)',
         borderCapStyle: "circle",
         borderWidth: 1
      },
      {
         label: 'Contract Employees',
         data: contractualDataset,
         fill: false,
         pointStyle: 'triangle',
         borderColor: 'rgba(255, 0, 0, 1)',
         tension: 0.1,
         pointRadius: 10,
         pointBorderColor: 'rgba(255, 0, 0, 1)',
         borderWidth: 1
      },
      {
         label: 'Freelance Employees',
         data: freelancerDataset,
         fill: false,
         pointStyle: 'circle',
         borderColor: 'rgba(0,0,255)',
         tension: 0.1,
         pointRadius: 10,
         pointBorderColor: 'rgba(0,0,255)',
         borderWidth: 1
      },
      {
         label: 'Part-Time Employees',
         data: parttimeDataset,
         pointStyle: 'rect',
         fill: false,
         borderColor: 'rgba(0,128,0)',
         tension: 0.1,
         pointRadius: 10,
         pointBorderColor: 'rgba(0,128,0)',
         borderWidth: 1
      }
   ]
   },
   options: {
      responsive: true,
      plugins: {
         title: {
         display: true,
         text: 'Chart.js Line Chart',
         },
      },
      interaction: {
         mode: 'index',
         intersect: false
      },
      scales: {
         x: {
         display: true,
         title: {
            display: true,
            text: 'Month'
         }
         },
         yAxes: [{
         display: true,
         ticks: {
                  beginAtZero: true
         },
         labels: {
               display: true,
               usePointStyle: true,
               },
         title: {
            display: true,
            text: 'Value'
            }
         
         }]
      }
   },
});
});