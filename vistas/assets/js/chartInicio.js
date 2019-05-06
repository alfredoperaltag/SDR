$(document).ready(function () {
    // var esVisible = $("#divResidenciasInit").is(":visible");
    var esVisible = $("#GrafoRT").is(":visible");
    if (esVisible) {
        $.ajax({
            url: "ajax/inicio.ajax.php",
            method: "POST",
            data: { GraficaR: 1, GraficaT: 2 },
            dataType: "json"
        }).done(function (res) {
            //  console.table(res);
            //  console.log(res);
            //  console.log('R: ',res[0]['total']);
            //  console.log('T: ',res[1]['total']);
            if (res != null && res != "") {
                // console.table('paso');
                data = {
                    datasets: [{
                        backgroundColor: ["#5cb85c", "#d9534f"],
                        data: [res[0][1], res[1][1]]
                    }],
                    labels: [
                        'Residencias',
                        'Tesis'
                    ]
                };

                var graphTarget = $("#GrafoRT");
                var myDoughnutChart = new Chart(graphTarget, {
                    type: 'doughnut',
                    data: data,
                    options: {
                        responsive: true
                    }
                });
            }
        });
    }

});

