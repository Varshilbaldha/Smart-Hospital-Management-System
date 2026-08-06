// ==========================
// Revenue Line Chart
// ==========================

const revenueChart = document.getElementById("revenueChart");
new Chart(revenueChart,{

    type:"line",

    data:{

        labels:["Jan","Feb","Mar","Apr","May","Jun"],

        datasets:[{

            label:"Revenue",

            data:[2,4,4,7,6,10],

            borderColor:"#28bf37",

            backgroundColor:"rgba(160, 239, 180, 0.17)",

            borderWidth:2,

            fill:true,

            tension:0.4,

            pointRadius: 3

        }]

    },

    options:
        {
            responsive: true,

            maintainAspectRatio: false,

            plugins:
            {
                legend:
                {
                    display: false
                }
            },

            scales:
            {
                x:
                {
                    grid:
                    {
                        color: "#f0f1f6ab"
                    }
                },

                y:
                {
                    beginAtZero: true,

                    grid:
                    {
                        color: "#f0f1f6ab"
                    }
                }
            }
        }

});



// ==========================
// Department Doughnut Chart
// ==========================

const departmentChart = document.getElementById("departmentChart");

new Chart(
    departmentChart,{

    type:"doughnut",

    data:
    {

        labels:["Cardiology","Neurology","Orthopedics","Pediatrics"],

        datasets:[{

            data:[35,25,20,20],

            backgroundColor:["#f56fee","#78c8e5","#63f325","#6ce1ba"],

            borderWidth: 1

        }]

    },

    options:{

    responsivee:true,

    maintainAspectRatio:false,

    cutout:"70%",

    plugins:
    {
        legend:
        {
            position:"right",

            labels:
            {
                boxWidth: 12,

                usePointStyle:false,

                font:
                {
                    size: 12
                }
            }
        }
    }

}

});



// ==========================
// Appointment Bar Chart
// ==========================

const appointmentChart = document.getElementById("appointmentChart");

new Chart(appointmentChart, {

    type: "bar",

    data: {

        labels: ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"],

        datasets: [{

            data: [250,250,280,200,350,290,250],

            backgroundColor: "#635BFF",

            borderRadius: 8,

            borderSkipped: false,

            barThickness: 32

        }]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        plugins: {

            legend: {

                display: false

            }

        },

        scales: {

            x: {

                grid: {

                    display: false

                }

            },

            y: {

                beginAtZero: true,

                ticks: {

                    stepSize: 50

                },

                grid: {

                    color: "#eef2f7"

                }

            }

        }

    }

});