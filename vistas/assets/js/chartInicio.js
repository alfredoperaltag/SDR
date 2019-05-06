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

            if (res.length == 0) {
                var res;
                res.push('0');
                res.push('0');
            } else if (res.length == 1) {
                if (res[0][0] == "1") {
                    res.push('0');
                }else{
                    res.unshift('0');
                }
            }

            if (res != null && res != "") {
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
                        responsive: true,
                        // title: {
                        //     display: true,
                        //     text: 'Grafica de Residencias y Tesis'
                        //   }
                    }
                });
            }
        });
    }

});

