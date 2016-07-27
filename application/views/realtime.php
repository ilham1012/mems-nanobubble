<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Nano Bubble</title>
  <!--<link rel="stylesheet" href="<?php echo site_url('asset/css/foundation.css') ?>">
  <link rel="stylesheet" href="<?php echo site_url('asset/css/app.css') ?>">
  <script src="<?php echo site_url('asset/js/angular.js') ?>"></script>-->


  <!-- Angular Material style sheet -->
  <link rel="stylesheet" href="<?php echo site_url('bower_components/angular-material/angular-material.min.css') ?>">

  <!-- Angular Material requires Angular.js Libraries -->
  <script src="<?php echo site_url('bower_components/angular/angular.min.js') ?>"></script>
  <script src="<?php echo site_url('bower_components/angular-animate/angular-animate.min.js') ?>"></script>
  <script src="<?php echo site_url('bower_components/angular-aria/angular-aria.min.js') ?>"></script>
  <script src="<?php echo site_url('bower_components/angular-messages/angular-messages.min.js') ?>"></script>

  <!-- Angular Material Library -->
  <script src="<?php echo site_url('bower_components/angular-material/angular-material.min.js') ?>"></script>

  <script src="<?php echo site_url('asset/js/vendor/jquery.js') ?>"></script>
  <script src="<?php echo site_url('asset/js/highstock.js') ?>"></script>
  <script src="<?php echo site_url('asset/js/highcharts-ng.js') ?>"></script>

  <!-- Application Bootstrap -->
  <script src="<?php echo site_url('asset/js/realtime.js') ?>"></script>

</head>
<body ng-app="memsnanoApp" layout="column">

<md-toolbar>
  <h5>MEMS-NanoBubble</h5>
</md-toolbar>

<div id="container">
  <section ng-controller="RealtimeCtrl">
    <md-list layout="row"  md-theme="dark-grey">
      <md-list-item layout="column">
        <h3>DO (ppm)</h3>
        <div>{{parse.sensors.DO.data[parse.sensors.DO.data.length - 1]}}</div>
      </md-list-item>
      <md-list-item layout="column">
        <h3>PH</h3>
        <div>{{parse.sensors.PH.data[parse.sensors.PH.data.length - 1]}}</div>
      </md-list-item>
      <md-list-item layout="column">
        <h3>Temp (</h3>
        <div>{{parse.sensors.Temperature.data[parse.sensors.Temperature.data.length - 1]}}</div>
      </md-list-item>
    </md-list>
  </section>

</div>

<div layout="row" ng-controller="DashboardCtrl" flex>
  <md-sidenav md-component-id="left" md-is-locked-open="true" layout="column" flex='25'>
    <md-datepicker ng-model="myDate" md-placeholder="Enter date" md-open-on-focus></md-datepicker>
    
    <md-list>
      <md-list-item ng-repeat="record in records" ng-click="displayChart($index)" class="clickable" ng-class="{ 'active': $index == selectedIndex }">
        {{ records[$index].recording_time }}
      </md-list-item>
    </md-list>
  </md-sidenav>

  <md-content id="content" flex='75'>

    <md-content>
      <div class="main-chart" style="margin-right:20px">
        <highchart id="chart1" config="chartConfig1"></highchart>
        <highchart id="chart2" config="chartConfig2"></highchart>
        <highchart id="chart3" config="chartConfig3"></highchart>
      </div>
    </md-content>
  </md-content>
</div>






</body> 
</html>