var app=angular.module('memsnanoApp',['ngMaterial', 'highcharts-ng']);

app.controller('RealtimeCtrl',function($scope,$http,$interval){
  load_data();

  $interval(function(){
    load_data();
  },10000);

  function load_data(){
    $http.get('api/parse_realtime_file/').success(function(data){
      $scope.parse=data;
    });
  };
});


app.controller('DashboardCtrl', function ($scope, $http) {
  $scope.selectedRecordIndex = 0;
  $scope.myDate = new Date();

  $scope.$watch('myDate', function() {
    load_records();
  });

  load_records();

  function load_records(){
    $http.get('api/records/?date='
        + formatDate($scope.myDate))
        .success(function(data){
      $scope.records = data;
    }).error(function(data){
      $scope.records = data;
    });
  }

  $scope.deleteRecord = function(record){
    $url = 'api/records/' + record.recording_id;
    console.log('Delete ' + $url);
    $http.delete($url);
    $scope.records.splice($scope.records.indexOf(record), 1);
  }

  $scope.displayChart = function(record){
    $scope.selectedIndex = record;


    $http.get('api/parse_file/?filename=' + $scope.records[record].file_name).success(function(fdata){
      var chartData = [];
      // $scope.ecg = fdata;
      console.log('display chart ' + $scope.records[record].file_name + ': ' + fdata.length);

      $scope.chartConfig1.series.splice(0, 1);
      $scope.chartConfig1.series.push({
        data: fdata.sensors.DO.data,
        type: 'line',
        marker: {
          enabled: false
        },
        states: {
          hover: {
            lineWidth: '1px'
          }
        }
      });

      $scope.chartConfig2.series.splice(0, 1);
      $scope.chartConfig2.series.push({
        data: fdata.sensors.PH.data,
        type: 'line',
        marker: {
          enabled: false
        },
        states: {
          hover: {
            lineWidth: '1px'
          }
        }
      });

      $scope.chartConfig3.series.splice(0, 1);
      $scope.chartConfig3.series.push({
        data: fdata.sensors.Temperature.data,
        type: 'line',
        marker: {
          enabled: false
        },
        states: {
          hover: {
            lineWidth: '1px'
          }
        }
      });

      $scope.ecg = fdata;
      console.log('chart data: ' + $scope.ecg);


    }).error(function(fdata){
      $scope.ecg = fdata;
    });
  }

  $scope.chartConfig1 = {
    options: {
        colors: [ '#e74c3c' //'#e74c3c', '#9b59b6'

        ],
        chart: {
            zoomType: 'x',
            backgroundColor: null
        },
        rangeSelector: {
            enabled: false
        },
        navigator: {
            enabled: true
        },
        tooltip: {
          enabled: false
        },
        xAxis: {
          lineColor: '#ccc',
          labels: {
            style: {
              color: '#ccc'
            }
          }
        },
        yAxis: {
          gridLineColor: '#ddd',
          labels: {
            style: {
              color: '#ccc'
            }
          },
          title: {
            style: {
              color: '#ccc'
            }
          }
        }
    },
    

    tooltip: {
      enabled: false
    },

    series: [],
    title: {
        text: 'DO'
    },
    pointInterval: 0.01,
    useHighStocks: false
  }

  $scope.chartConfig2 = {
    options: {
        colors: [ '#e74c3c' //'#e74c3c', '#9b59b6'

        ],
        chart: {
            zoomType: 'x',
            backgroundColor: null
        },
        rangeSelector: {
            enabled: false
        },
        navigator: {
            enabled: true
        },
        tooltip: {
          enabled: false
        },
        xAxis: {
          lineColor: '#ccc',
          labels: {
            style: {
              color: '#ccc'
            }
          }
        },
        yAxis: {
          gridLineColor: '#ddd',
          labels: {
            style: {
              color: '#ccc'
            }
          },
          title: {
            style: {
              color: '#ccc'
            }
          }
        }
    },
    

    tooltip: {
      enabled: false
    },

    series: [],
    title: {
        text: 'PH'
    },
    pointInterval: 0.01,
    useHighStocks: false
  }

  $scope.chartConfig3 = {
    options: {
        colors: [ '#e74c3c' //'#e74c3c', '#9b59b6'

        ],
        chart: {
            zoomType: 'x',
            backgroundColor: null
        },
        rangeSelector: {
            enabled: false
        },
        navigator: {
            enabled: true
        },
        tooltip: {
          enabled: false
        },
        xAxis: {
          lineColor: '#ccc',
          labels: {
            style: {
              color: '#ccc'
            }
          }
        },
        yAxis: {
          gridLineColor: '#ddd',
          labels: {
            style: {
              color: '#ccc'
            }
          },
          title: {
            style: {
              color: '#ccc'
            }
          }
        }
    },
    

    tooltip: {
      enabled: false
    },

    series: [],
    title: {
        text: 'Temperature'
    },
    pointInterval: 0.01,
    useHighStocks: false
  }

});



function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
  }