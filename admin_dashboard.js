




const appointmentCanvas =
    document.getElementById("appointmentChart");


new Chart(
    appointmentCanvas,
    {
        type:"line",

        data:
        {
            labels:
            [
                "Mon",
                "Tue",
                "Wed",
                "Thu",
                "Fri",
                "Sat",
                "Sun"
            ],

            datasets:
            [
                {
                    label: "Appointments",

                    data:
                    [
                        250,
                        254,
                        278,
                        202,
                        354,
                        288,
                        248
                    ],

                    borderColor: "#635bff",

                    backgroundColor:
                        "rgba(99, 91, 255, 0.12)",

                    fill: true,

                    tension: 0.4,

                    borderWidth: 2,

                    pointRadius: 3
                }
            ]
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
                        display: false
                    }
                },

                y:
                {
                    beginAtZero: true,

                    grid:
                    {
                        color: "#f0f1f6"
                    }
                }
            }
        }
    }
);


const departmentCanvas =
    document.getElementById("departmentChart");


new Chart(
    departmentCanvas,
    {
        type: "doughnut",

        data:
        {
            labels:
            [
                "Cardiology",
                "Orthopedics",
                "Neurology",
                "Pediatrics",
                "Others"
            ],

            datasets:
            [
                {
                    data:
                    [
                        30,
                        25,
                        20,
                        15,
                        10
                    ],

                    backgroundColor:
                    [
                        "#635bff",
                        "#24a7d8",
                        "#24a77b",
                        "#f3a425",
                        "#ec5fa6"
                    ],

                    borderWidth: 0
                }
            ]
        },

        options:
        {
            responsive: true,

            maintainAspectRatio: false,

            cutout: "70%",

            plugins:
            {
                legend:
                {
                    position: "right",

                    labels:
                    {
                        boxWidth: 10,

                        usePointStyle: true,

                        font:
                        {
                            size: 11
                        }
                    }
                }
            }
        }
    }
);



