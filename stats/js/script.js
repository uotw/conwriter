var daydata = [];
var daydates = [];
var monthsdata = [];
var monthsdates = [];
var yearsdates = [];
var yearsdata = [];
var weeksdates = [];
var weeksdata = [];
var chart, chart2, chart3, chart4;
var colors = [
	          "#0F5D82",
          "#0D445F",
          "#B6BABF",
          "#87A8B7",
          "#8E9298",
          "#83BDCF",
          "#DCD9DA"
];
//var daydates=[];
var citycolorindex = getUrlParameter('c');
if (!citycolorindex) {
    citycolor = colors;
} else {
    citycolor = colors[citycolorindex];
}
var bgColor = colors;
var dates;
var city = getUrlParameter('city');
if (city) {
    $('#alldata').show();
    $('#citymsg').hide();
}

function getUrlParameter(name) {
    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
    var results = regex.exec(location.search);
    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};
$.ajax({
    type: "GET",
    url: "https://www.conwriter.com/stats/datesjson.php?city=" + city,
    //data: { get_param: 'value' },
    dataType: "json",
    cache: false,
    success: function(data) {
        daydata = data.days.map(function(e) {
            return e.visits;
        });
        daydates = data.days.map(function(e) {
            return e.date;
        });
        monthsdata = data.months.map(function(e) {
            return e.visits;
        });
        monthsdates = data.months.map(function(e) {
            return e.date;
        });
        yearsdata = data.years.map(function(e) {
            return e.visits;
        });
        yearsdates = data.years.map(function(e) {
            return e.date;
        });
        weeksdata = data.weeks.map(function(e) {
            return e.visits;
        });
        weeksdates = data.weeks.map(function(e) {
            return e.date;
        });
        removecurrent();
        //visitschart(daydata,daydates, "CONs by Day", 0.4);
        //$("#day").click();
	 //$("button").removeClass("active");
    	 //chart.destroy();
    	 //visitschart(monthsdates, monthsdata, "CONs by Month", 0.4);
	visitschart(weeksdates, weeksdata, "CONs by Week", 0.4);
	
    }
});
$.ajax({
    type: "GET",
    url: "https://www.conwriter.com/stats/citiesjson.php?city=" + city,
    //data: { get_param: 'value' },
    dataType: "json",
    cache: false,
    success: function(data) {
        var citiesdata = data.map(function(e) {
            return e.city;
        });
        var countdata = data.map(function(e) {
            return e.count;
        });
        //removecurrent();
        citiesschart(citiesdata, countdata, "City Usage");
    }
});
$.ajax({
    type: "GET",
    url: "https://www.conwriter.com/stats/transportjson.php?city=" + city,
    //data: { get_param: 'value' },
    dataType: "json",
    cache: false,
    success: function(data) {
        var transdata = data.map(function(e) {
            return e.transport;
        });
        var countdata = data.map(function(e) {
            return e.count;
        });
        //removecurrent();
        transportchart(transdata, countdata, "Transport Method");
    },
    error: function(xhr, status, error) {
        var err = JSON.parse(xhr.responseText);
        alert(err.message);
    }
});
$.ajax({
    type: "GET",
    url: "https://www.conwriter.com/stats/destinationjson.php?city=" + city,
    //data: { get_param: 'value' },
    dataType: "json",
    cache: false,
    success: function(data) {
        var destdata = data.map(function(e) {
            return e.destination;
        });
        var countdata = data.map(function(e) {
            return e.count;
        });
        //removecurrent();
        destinationchart(destdata, countdata, "Destination");
    },
    error: function(xhr, status, error) {
        var err = JSON.parse(xhr.responseText);
        alert(err.message);
    }
});

function citiesschart(cities, counts, title) {
    const ctx = document.getElementById("pieChartCanvas").getContext("2d");
    const data = {
        // Labels should be Date objects
        labels: cities,
        datasets: [{
            fill: false,
            label: title,
            data: counts,
            backgroundColor: citycolor
        }]
    };
    const options = {
        type: "doughnut",
        data: data,
        responsive: true,
        onHover: function(evt) {
            var item = myLineChart.getElementAtEvent(evt);
            if (item.length) {
                console.log("onHover", item, evt.type);
                console.log(">data", item[0]._index, data.datasets[0].data[item[0]._index]);
            }
            //$("#pieChartCanvas").css("cursor", el[0] ? "pointer" : "default");
        }
    };
    chart2 = new Chart(ctx, options);
}

function transportchart(trans, counts, title) {
    const ctx = document.getElementById("transChartCanvas").getContext("2d");
    const data = {
        // Labels should be Date objects
        labels: trans,
        datasets: [{
            fill: false,
            label: title,
            data: counts,
            backgroundColor: bgColor
        }]
    };
    const options = {
        type: "doughnut",
        data: data,
        responsive: true,
        options: {
            elements: {
                point: {
                    radius: 0
                }
            },
            responsive: true,
        }
    };
    chart3 = new Chart(ctx, options);
}

function destinationchart(dest, counts, title) {
    const ctx = document.getElementById("destChartCanvas").getContext("2d");
    const data = {
        // Labels should be Date objects
        labels: dest,
        datasets: [{
            fill: false,
            label: title,
            data: counts,
            backgroundColor: bgColor
        }]
    };
    const options = {
        type: "doughnut",
        data: data,
        responsive: true
    };
    chart3 = new Chart(ctx, options);
}

function visitschart(thelabels, thedata, title, smooth) {
    const ctx = document.getElementById("chartCanvas").getContext("2d");
    //ctx.clearRect(0, 0, canvas.width, canvas.height);
    const data = {
        // Labels should be Date objects
        labels: thelabels,
        datasets: [{
            fill: false,
            label: title,
            data: thedata,
            borderColor: colors[0],
            backgroundColor: colors[0],
            lineTension: smooth,
	    borderWidth: 1
        }]
    };
    const options = {
        type: "line",
        data: data,
        responsive: true,
        options: {
            elements: {
                point: {
                    radius: 0
                }
            },
            fill: false,
            responsive: true,
            scales: {
                xAxes: [{
                    type: 'time',
                    time: {
                        displayFormats: {
                            'millisecond': 'MMM DD',
                            'second': 'MMM DD',
                            'minute': 'MMM DD',
                            'hour': 'MMM DD',
                            'day': 'MMM \'YY',
                            'week': 'MMM \'YY',
                            'month': 'MMM \'YY',
                            'quarter': 'MMM \'YY',
                            'year': 'YYYY',
                        }
                    },
                    display: true,
                    scaleLabel: {
                        display: true
                        //labelString: "Date"
                    },
                    ticks: {
                        autoSkip: true,
                        maxTicksLimit: 20
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: "CONs written"
                    }
                }]
            }
        }
    };
    chart = new Chart(ctx, options);
}

$("#month").click(function() {
    $("button").removeClass("active");
    $(this).addClass("active");
    chart.destroy();
    visitschart(monthsdates, monthsdata, "CONs by Month", 0.4);
});

$("#day").click(function() {
    $("button").removeClass("active");
    $(this).addClass("active");
    if (chart) {
        chart.destroy();
    }
    visitschart(daydates, daydata, "CONs by Day", 0);
});
$("#year").click(function() {
    $("button").removeClass("active");
    $(this).addClass("active");
    chart.destroy();
    visitschart(yearsdates, yearsdata, "CONs by Year", 0.2);
});

$("#week").click(function() {
    $("button").removeClass("active");
    $(this).addClass("active");
    chart.destroy();
    visitschart(weeksdates, weeksdata, "CONs by Week", 0.1);
});

function removecurrent() { //REMOVES THE FIRST ITEM FROM DATA, INCOMPLETE 
    daydates.pop();
    monthsdata.pop();
    monthsdates.pop();
    yearsdates.pop();
    yearsdata.pop();
    weeksdates.pop();
    weeksdata.pop();
}

$("#pieChartCanvas").click(
    function(evt) {
        if (city) {
            return;
        }
        var activePoints = chart2.getElementAtEvent(evt);
        if (activePoints[0]) {
            var chartData = activePoints[0]['_chart'].config.data;
            var idx = activePoints[0]['_index'];

            var label = chartData.labels[idx];
            var value = chartData.datasets[0].data[idx];
            var color = chartData.datasets[0].backgroundColor[idx];
            var colorindex = colors.indexOf(color);
            location.href = "https://www.conwriter.com/stats/?city=" + label + "&c=" + colorindex;
        }
    });
