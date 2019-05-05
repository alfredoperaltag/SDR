
if ($('#seolinechart8').length) {
    var ctx = document.getElementById("seolinechart8").getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'doughnut',
        // The data for our dataset
        data: {
            labels: ["Residencias", "Tesis"],
            datasets: [{
                backgroundColor: [
                    "#5cb85c",
                    "#d9534f",
                ],
                borderColor: '#fff',
                data: [1,1],
            }]
        },
        // Configuration options go here
        options: {
            legend: {
                display: true
            },
            animation: {
                easing: "easeInOutBack"
            }
        }
    });
}