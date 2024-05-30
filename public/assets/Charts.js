const ctx = document.getElementById('myChart');
const ctx1 = document.getElementById('myChart1');
const ctx2 = document.getElementById('myChart2');
const ctx3 = document.getElementById('myChart3');
const ctx4 = document.getElementById('myChart4');
const ctx5 = document.getElementById('myChart5');
const ctx6 = document.getElementById('myChart6');


document.addEventListener("DOMContentLoaded", function() {
    var chartDataElement = document.getElementById('myChartContainer');
    var chartData = JSON.parse(chartDataElement.getAttribute('data-chart-data'));
    var chartData = JSON.parse(chartData);
    console.log(chartData);
    chart(chartData);

});

function chart(element){
  console.log(element);
/**************************** */
/****FLOUS PAR MOIS */
/**************************** */
let flous = element["flousPmois"];
console.log(flous);
var flousPm = [];
const tableauIndexe = Object.entries(flous).map(([cle, valeur]) => ({ cle: parseInt(cle, 10), valeur: parseInt(valeur, 10) }));
let value;
for (let i = 0; i<12; i++){
  value = tableauIndexe.find(element => element.cle === i+1)?.valeur;
  if(value !== undefined){
    flousPm[i] = value;
  }else{
    flousPm[i] = 0;
  }

}
/**************************** */
/****COMMANDE PAR MOIS */
/**************************** */
let commande = element["cmdPmois"];
console.log(commande);
var cmdPm = [];
const tableauIndexe1 = Object.entries(commande).map(([cle, valeur]) => ({ cle: parseInt(cle, 10), valeur: parseInt(valeur, 10) }));
for (let i = 0; i<12; i++){
  value = tableauIndexe1.find(element => element.cle === i+1)?.valeur;
  if(value !== undefined){
    cmdPm[i] = value;
  }else{
    cmdPm[i] = 0;
  }

}
console.log(flousPm);
console.log(commande);
/********************************************* */
/********************************************* */
/* NBR CLIENT / COMMANDE / LIVREPDF / LIVRE REEL
/********************************************* */
/********************************************* */
var nbrLp = document.getElementById("lp");
var nbrLr = document.getElementById("lr");
var nbrCommande = document.getElementById("lcomm");
var nbrClient = document.getElementById("lclient");

nbrLp.innerText = element['lp'];
nbrLr.innerText = element['lr'];
nbrCommande.innerText = element['commande'];
nbrClient.innerText = element['client'];



//************************** */
//************************** */
/*var variables*/
//************************** */
//************************** */
/*****CHART 4 */
const labels5 = Object.keys(element['lpC']);
const val5 = Object.values(element['lpC']);
/*****CHART 6 */
const labels6 = Object.keys(element['lrC']);
const val6 = Object.values(element['lrC']);

//************************** */
//************************** */
/******************************************************************************************* */
/******************************************************************************************* */
/* ***                               CHART 1                                             *** */
/******************************************************************************************* */
/******************************************************************************************* */


    const labels =element['mois'];
    const data1 = {
      labels: labels,
      datasets: [{
        label: 'Flous',
        data: flousPm,
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(255, 205, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(201, 203, 207, 0.2)'
        ],
        borderColor: [
          'rgb(255, 99, 132)',
          'rgb(255, 159, 64)',
          'rgb(255, 205, 86)',
          'rgb(75, 192, 192)',
          'rgb(54, 162, 235)',
          'rgb(153, 102, 255)',
          'rgb(201, 203, 207)'
        ],
        borderWidth: 1
      }, {
        type: 'line',
        label: 'Flous',
        data: flousPm,
        fill: false,
        borderColor: 'rgb(255, 99, 132, 0.2)'
      }]
    };
    
          
    new Chart(ctx1, {
        type: 'bar',
        data: data1,
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        },
      });

/******************************************************************************************* */
/******************************************************************************************* */
/* ***                               CHART 2                                             *** */
/******************************************************************************************* */
/******************************************************************************************* */
        


const data2 = {
    labels: labels,
    datasets: [{
      label: 'Nbr Commande',
      data: cmdPm,
      backgroundColor: [
        'rgb(5, 44, 207, 0.2)',
        'rgb(153, 102, 255, 0.2)',
        'rgb(54, 162, 235, 0.2)',
        'rgb(75, 192, 192, 0.2)',
        'rgb(255, 205, 86, 0.2)',
        'rgb(255, 159, 64, 0.2)',
        'rgb(255, 99, 132, 0.2)'
      ],
      borderColor: [   
      'rgb(5, 44, 207)',
      'rgb(153, 102, 255)',
      'rgb(54, 162, 235)',
      'rgb(75, 192, 192)',
      'rgb(255, 205, 86)',
      'rgb(255, 159, 64)',
      'rgb(255, 99, 132)'],
      borderWidth: 1
    }
    , {
      type: 'line',
      label: 'Nbr Commande',
      data: cmdPm,
      fill: false,
      borderColor: 'rgb(255, 99, 132, 0.2)'
    }]
  };
    new Chart(ctx2, {
        type: 'bar',
        data: data2,
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        },
      });

/******************************************************************************************* */
/******************************************************************************************* */
/* ***                               CHART 3                                             *** */
/******************************************************************************************* */
/******************************************************************************************* */


const data3 = {
  labels: labels,
  datasets: [{
    label: 'My First Dataset',
    data: [65, 59, 80, 81, 56, 55, 40],
    fill: false,
    borderColor: 'rgb(75, 192, 192)',
    tension: 0.1
  }]
};

new Chart(ctx3, {
  type: 'line',
  data: data3,        
});


/******************************************************************************************* */
/******************************************************************************************* */
/* ***                               CHART 4                                           *** */
/******************************************************************************************* */
/******************************************************************************************* */


const data4 = {
  labels: labels,
  datasets: [{
    label: 'My First Dataset',
    data: [65, 59, 80, 81, 56, 55, 40],
    fill: false,
    borderColor: 'rgb(201, 203, 207)',
    tension: 0.1
  }]
};

  new Chart(ctx4, {
    type: 'line',
    data: data4,        
});



/******************************************************************************************* */
/******************************************************************************************* */
/* ***                               CHART 5                                            *** */
/******************************************************************************************* */
/******************************************************************************************* */


const data5 = {
    labels: labels5,
    datasets: [{
      label: 'Nbr Books',
      data: val5,
      backgroundColor: [
        'rgb(255, 99, 132)',
        'rgb(54, 162, 235)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(153, 102, 255)',
        'rgb(255, 159, 64)',
        'rgb(255, 0, 255)',
        'rgb(0, 255, 255)'
        
      ],
      hoverOffset: 4
    }]
  };
          
    new Chart(ctx5, {
        type: 'doughnut',
        data: data5,        
      });


    




    /*  const data4 = {
        labels: [
          'January',
          'February',
          'March',
          'April'
        ],
        datasets: [{
          type: 'line',
          label: 'Bar Dataset',
          data: [10, 50, 30, 40],
          borderColor: 'rgb(255, 99, 132)',
          backgroundColor: 'rgba(255, 99, 132, 0.2)'
        }, {
          type: 'line',
          label: 'Line Dataset',
          data: [5, 10, 50, 20],
          fill: false,
          borderColor: 'rgb(54, 162, 235)'
        }
        , {
          type: 'bar',
          label: 'Line Dataset',
          data: [115, 10, 50, 20],
          fill: false,
          borderColor: 'rgb(54, 162, 235)'
        }]
      };
      new Chart(ctx4, {
        type: 'scatter',
        data: data4,
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        },
      });*/



     

      
/******************************************************************************************* */
/******************************************************************************************* */
/* ***                               CHART 6                                            *** */
/******************************************************************************************* */
/******************************************************************************************* */



const data6 = {
    labels: labels6,
    datasets: [{
      label: 'Nbr Books',
      data: val6,
      backgroundColor: [
        'rgb(255, 99, 132)',
        'rgb(54, 162, 235)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(153, 102, 255)',
        'rgb(255, 159, 64)',
        'rgb(255, 0, 255)',
        'rgb(0, 255, 255)'
        
      ],
      hoverOffset: 4
    }]
  };
          
    new Chart(ctx6, {
        type: 'doughnut',
        data: data6,        
      });


    }