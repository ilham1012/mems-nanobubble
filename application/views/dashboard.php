<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en" data-ng-app="dashboardApp">
<head>
  <meta charset="utf-8">
  <title>Nano Bubble</title>
  <link rel="stylesheet" href="<?php echo site_url('asset/css/foundation.css') ?>">
  <link rel="stylesheet" href="<?php echo site_url('asset/css/app.css') ?>">
  <script src="<?php echo site_url('asset/js/angular.js') ?>"></script>
</head>
<body>

<div id="container">
  <section data-ng-controller="DashboardCtrl" class="wrapper bg-faded">
  
    <div class="row">
      <div class="small-2 large-3 columns">
        <button class="" ng-click="refresh()" style="margin-bottom: 20px">Refresh</button>
        
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th><th>Recording Time</th><th>File Name</th>
            </tr>
          </thead>

          <tbody>
            <tr data-ng-repeat="record in records" ng-click="displayChart($index)" class="clickable" ng-class="{ 'active': $index == selectedIndex }">
              <td>{{ records[$index].id }}</td>
              <td>{{ records[$index].recording_time }}</td>
              <td>{{ records[$index].file_name }}</td>
            </tr>                
          </tbody>              
        </table>
      </div>

      <div class="small-10 large-9 columns">
        <div class="main-chart">
          <highchart id="chart1" config="chartConfig1"></highchart>
          <highchart id="chart2" config="chartConfig2"></highchart>
          <highchart id="chart3" config="chartConfig3"></highchart>
        </div>
      </div>        
    </div>

</section>
</div>

<script src="<?php echo site_url('asset/js/vendor/jquery.js') ?>"></script>
<script src="<?php echo site_url('asset/js/vendor/what-input.js') ?>"></script>
<script src="<?php echo site_url('asset/js/vendor/foundation.min.js') ?>"></script>
<script src="<?php echo site_url('asset/js/highstock.js') ?>"></script>
<script src="<?php echo site_url('asset/js/highcharts-ng.js') ?>"></script>
<script src="<?php echo site_url('asset/js/dashboard.js') ?>"></script>
</body> 
</html>