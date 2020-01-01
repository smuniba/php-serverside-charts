<?php 
set_time_limit(0);
ini_set('memory_limit', '-1');
date_default_timezone_set('ETC/GMT');
/* pChart library inclusions */
require_once("bootstrap.php");
require_once("includes.php");
use pChart\pColor;
use pChart\pDraw;
use pChart\pCharts;
/* Current Over Time */
$myPicture = new pDraw(1000,600);
$sam = 'SELECT `currentPhaseR`,`currentPhaseB`,`currentPhaseY`,`timestamp`,`datetime` FROM `readings` where `timestamp` between 1573870010 AND 1576476650 group by YEAR(`datetime`), MONTH(`datetime`), DAY(`datetime`), HOUR(`datetime`)';
foreach ($PDO->query($sam) as $row) {
    $energy = $row['currentPhaseR'];
    $myPicture->myData->addPoints(array($energy),"currentPhaseR");
    $voltage = $row['currentPhaseB'];
    $myPicture->myData->addPoints(array($voltage),"currentPhaseB");
    $current = $row['currentPhaseY'];
    $myPicture->myData->addPoints(array($current),"currentPhaseY"); 
    $date = $row['timestamp'];
    $new = date('d.M',$date);
    $myPicture->myData->addPoints(array($new),"timestamp");
  }
 $myPicture->myData->setAxisProperties(0, ["Name" => "currentPhaseR"]);
 $myPicture->myData->setSerieDescription("currentPhaseR","Current Red"); 
 $myPicture->myData->setSerieProperties("currentPhaseR", ["Weight" => 2]);
 $myPicture->myData->setPalette("currentPhaseR",new pColor(255,0,0,100));

 $myPicture->myData->setAxisProperties(0, ["Name" => "currentPhaseB"]);
 $myPicture->myData->setSerieDescription("currentPhaseB","Current Blue"); 
 $myPicture->myData->setSerieProperties("currentPhaseB", ["Weight" => 2]);
 $myPicture->myData->setPalette("currentPhaseB",new pColor(0,0,255,100));

 $myPicture->myData->setAxisProperties(0, ["Name" => "currentPhaseY"]);
 $myPicture->myData->setSerieDescription("currentPhaseY","Current Yellow"); 
 $myPicture->myData->setSerieProperties("currentPhaseY", ["Weight" => 2]);
 $myPicture->myData->setPalette("currentPhaseY",new pColor(255,255,0,100));
 
 $myPicture->myData->setAxisProperties(0, ["Name" => "timestamp"]);
 $myPicture->myData->setAbscissa("timestamp");

/* Turn off Anti-aliasing */
$myPicture->setAntialias(FALSE);

/* Draw a background */
$myPicture->drawFilledRectangle(0,0,1000,600,["Color"=>new pColor(90), "Dash"=>TRUE, "DashColor"=>new pColor(120)]);

/* Overlay with a gradient */ 
$Settings = ["StartColor"=>new pColor(255,255,255,255), "EndColor"=>new pColor(255,255,255,255)];
$myPicture->drawGradientArea(0,0,1000,600,DIRECTION_VERTICAL,$Settings);
$myPicture->drawGradientArea(0,0,1000,600,DIRECTION_HORIZONTAL,$Settings);

/* Add a border to the picture */
$myPicture->drawRectangle(0,0,1000,600,["Color"=>new pColor(0)]);

/* Write the chart title */ 
$myPicture->setFontProperties(["FontName"=>"fonts/Cairo-Regular.ttf","FontSize"=>11]);
$myPicture->drawText(350,35,"Current Over Time",["FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE]);

/* Set the default font */
$myPicture->setFontProperties(["FontSize"=>7]);

/* Define the chart area */
$myPicture->setGraphArea(60,200,1000,580);

/* Draw the scale */
$myPicture->drawScale([
    "XMargin"=>10,
    "YMargin"=>10,
    "Floating"=>TRUE,
    "GridColor"=>new pColor(255),
    "RemoveSkippedAxis"=>TRUE,
    "DrawSubTicks"=>FALSE,
    "Mode"=>SCALE_MODE_START0,
    "LabelingMethod"=>LABELING_DIFFERENT,
    "Factors" => array(1,2)
]);

/* Turn on Anti-aliasing */
//$myPicture->setAntialias(TRUE);

/* Draw the line chart */
$myPicture->setShadow(TRUE,["X"=>1,"Y"=>1,"Color"=>new pColor(255,255,255,255)]);
(new pCharts($myPicture))->drawLineChart();

/* Write a label over the chart */ 
//$myPicture->writeLabel(["Energy Value (KWh)"],[720]);

/* Write the chart legend */
$myPicture->drawLegend(580,20,["Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL]);

/* Render the picture (choose the best way) */
$myPicture->render("current.png");

/* Voltage Over Time */
$myPicture = new pDraw(1000,600);
$sam = 'SELECT `voltagePhaseR`,`voltagePhaseB`,`voltagePhaseY`,`timestamp`,`datetime` FROM `readings` where `timestamp` between 1573870010 AND 1576476650 group by YEAR(`datetime`), MONTH(`datetime`), DAY(`datetime`), HOUR(`datetime`)';
foreach ($PDO->query($sam) as $row) {
    $energy = $row['voltagePhaseR'];
    $myPicture->myData->addPoints(array($energy),"voltagePhaseR");
    $voltage = $row['voltagePhaseB'];
    $myPicture->myData->addPoints(array($voltage),"voltagePhaseB");
    $current = $row['voltagePhaseY'];
    $myPicture->myData->addPoints(array($current),"voltagePhaseY");
    $date = $row['timestamp'];
    $new = date('d.M',$date);
    $myPicture->myData->addPoints(array($new),"timestamp"); 
  }
 
 $myPicture->myData->setAxisProperties(0, ["Name" => "voltagePhaseR"]);
 $myPicture->myData->setSerieDescription("voltagePhaseR","VoltsR"); 
 $myPicture->myData->setSerieProperties("voltagePhaseR", ["Weight" => 2]);
 $myPicture->myData->setPalette("voltagePhaseR",new pColor(255,0,0,100));

 $myPicture->myData->setAxisProperties(0, ["Name" => "voltagePhaseB"]);
 $myPicture->myData->setSerieDescription("voltagePhaseB","VoltsB"); 
 $myPicture->myData->setSerieProperties("voltagePhaseB", ["Weight" => 2]);
 $myPicture->myData->setPalette("voltagePhaseB",new pColor(0,0,255,100));
 
 $myPicture->myData->setAxisProperties(0, ["Name" => "voltagePhaseY"]);
 $myPicture->myData->setSerieDescription("voltagePhaseY","VoltsY"); 
 $myPicture->myData->setSerieProperties("voltagePhaseY", ["Weight" => 2]);
 $myPicture->myData->setPalette("voltagePhaseY",new pColor(255,255,0,100));

 $myPicture->myData->setAxisProperties(0, ["Name" => "timestamp"]);
 $myPicture->myData->setAbscissa("timestamp");

/* Turn off Anti-aliasing */
$myPicture->setAntialias(FALSE);

/* Draw a background */
$myPicture->drawFilledRectangle(0,0,1000,600,["Color"=>new pColor(90), "Dash"=>TRUE, "DashColor"=>new pColor(120)]);

/* Overlay with a gradient */ 
$Settings = ["StartColor"=>new pColor(255,255,255,255), "EndColor"=>new pColor(255,255,255,255)];
$myPicture->drawGradientArea(0,0,1000,600,DIRECTION_VERTICAL,$Settings);
$myPicture->drawGradientArea(0,0,1000,600,DIRECTION_HORIZONTAL,$Settings);

/* Add a border to the picture */
$myPicture->drawRectangle(0,0,1000,600,["Color"=>new pColor(0)]);

/* Write the chart title */ 
$myPicture->setFontProperties(["FontName"=>"fonts/Cairo-Regular.ttf","FontSize"=>11]);
$myPicture->drawText(350,35,"Voltage Over Time",["FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE]);

/* Set the default font */
$myPicture->setFontProperties(["FontSize"=>7]);

/* Define the chart area */
$myPicture->setGraphArea(60,200,1000,580);

/* Draw the scale */
$myPicture->drawScale([
    "XMargin"=>10,
    "YMargin"=>10,
    "Floating"=>TRUE,
    "GridColor"=>new pColor(255),
    "RemoveSkippedAxis"=>TRUE,
    "DrawSubTicks"=>FALSE,
    "Mode"=>SCALE_MODE_START0,
    "LabelingMethod"=>LABELING_DIFFERENT,
    "Factors" => array(1,2)
]);

/* Turn on Anti-aliasing */
//$myPicture->setAntialias(TRUE);

/* Draw the line chart */
$myPicture->setShadow(TRUE,["X"=>1,"Y"=>1,"Color"=>new pColor(255,255,255,255)]);
(new pCharts($myPicture))->drawLineChart();

/* Write a label over the chart */ 
//$myPicture->writeLabel(["Energy Value (KWh)"],[720]);

/* Write the chart legend */
$myPicture->drawLegend(580,20,["Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL]);

/* Render the picture (choose the best way) */
$myPicture->render("voltage.png");

/* Power Over Time */
$myPicture = new pDraw(1000,600);
$sam = 'SELECT `apparentPowerPhaseR`,`apparentPowerPhaseB`,`apparentPowerPhaseY`,`realPowerPhaseR`,`realPowerPhaseB`,`realPowerPhaseY`,`reactivePowerPhaseR`,`reactivePowerPhaseB`,`reactivePowerPhaseY`,`timestamp`,`datetime` FROM `readings` where `timestamp` between 1573870010 AND 1576476650 group by YEAR(`datetime`), MONTH(`datetime`), DAY(`datetime`), HOUR(`datetime`)';
foreach ($PDO->query($sam) as $row) {
    $energy = $row['apparentPowerPhaseR'];
    $myPicture->myData->addPoints(array($energy),"apparentPowerPhaseR");
    $voltage = $row['apparentPowerPhaseB'];
    $myPicture->myData->addPoints(array($voltage),"apparentPowerPhaseB");
    $current = $row['apparentPowerPhaseY'];
    $myPicture->myData->addPoints(array($current),"apparentPowerPhaseY");
    $energy1 = $row['realPowerPhaseR'];
    $myPicture->myData->addPoints(array($energy1),"realPowerPhaseR");
    $voltage1 = $row['realPowerPhaseB'];
    $myPicture->myData->addPoints(array($voltage1),"realPowerPhaseB");
    $current1 = $row['realPowerPhaseY'];
    $myPicture->myData->addPoints(array($current1),"realPowerPhaseY");
    $energy2 = $row['reactivePowerPhaseR'];
    $myPicture->myData->addPoints(array($energy2),"reactivePowerPhaseR");
    $voltage2 = $row['reactivePowerPhaseB'];
    $myPicture->myData->addPoints(array($voltage2),"reactivePowerPhaseB");
    $current2 = $row['reactivePowerPhaseY'];
    $myPicture->myData->addPoints(array($current2),"reactivePowerPhaseY");
    $date = $row['timestamp'];
    $new = date('d.M',$date);
    $myPicture->myData->addPoints(array($new),"timestamp"); 
  }
 
 $myPicture->myData->setAxisProperties(0, ["Name" => "apparentPowerPhaseR"]);
 $myPicture->myData->setSerieDescription("apparentPowerPhaseR","apparentPowerR"); 
 $myPicture->myData->setSerieProperties("apparentPowerPhaseR", ["Weight" => 2]);
 $myPicture->myData->setPalette("apparentPowerPhaseR",new pColor(255,0,0,100));

 $myPicture->myData->setAxisProperties(0, ["Name" => "apparentPowerPhaseB"]);
 $myPicture->myData->setSerieDescription("apparentPowerPhaseB","apparentPowerB"); 
 $myPicture->myData->setSerieProperties("apparentPowerPhaseB", ["Weight" => 2]);
 $myPicture->myData->setPalette("apparentPowerPhaseB",new pColor(0,0,255,100));
 
 $myPicture->myData->setAxisProperties(0, ["Name" => "apparentPowerPhaseY"]);
 $myPicture->myData->setSerieDescription("apparentPowerPhaseY","apparentPowerY"); 
 $myPicture->myData->setSerieProperties("apparentPowerPhaseY", ["Weight" => 2]);
 $myPicture->myData->setPalette("apparentPowerPhaseY",new pColor(255,255,0,100));

 $myPicture->myData->setAxisProperties(0, ["Name" => "realPowerPhaseR"]);
 $myPicture->myData->setSerieDescription("realPowerPhaseR","realPowerR"); 
 $myPicture->myData->setSerieProperties("realPowerPhaseR", ["Weight" => 2]);

 $myPicture->myData->setAxisProperties(0, ["Name" => "realPowerPhaseB"]);
 $myPicture->myData->setSerieDescription("realPowerPhaseB","realPowerB"); 
 $myPicture->myData->setSerieProperties("realPowerPhaseB", ["Weight" => 2]);
 
 $myPicture->myData->setAxisProperties(0, ["Name" => "realPowerPhaseY"]);
 $myPicture->myData->setSerieDescription("realPowerPhaseY","realPowerY"); 
 $myPicture->myData->setSerieProperties("realPowerPhaseY", ["Weight" => 2]);

 $myPicture->myData->setAxisProperties(0, ["Name" => "reactivePowerPhaseR"]);
 $myPicture->myData->setSerieDescription("reactivePowerPhaseR","reactivePowerR"); 
 $myPicture->myData->setSerieProperties("reactivePowerPhaseR", ["Weight" => 2]);

 $myPicture->myData->setAxisProperties(0, ["Name" => "reactivePowerPhaseB"]);
 $myPicture->myData->setSerieDescription("reactivePowerPhaseB","reactivePowerB"); 
 $myPicture->myData->setSerieProperties("reactivePowerPhaseB", ["Weight" => 2]);
 
 $myPicture->myData->setAxisProperties(0, ["Name" => "reactivePowerPhaseY"]);
 $myPicture->myData->setSerieDescription("reactivePowerPhaseY","reactivePowerY"); 
 $myPicture->myData->setSerieProperties("reactivePowerPhaseY", ["Weight" => 2]);

 $myPicture->myData->setAxisProperties(0, ["Name" => "timestamp"]);
 $myPicture->myData->setAbscissa("timestamp");

/* Turn off Anti-aliasing */
$myPicture->setAntialias(FALSE);

/* Draw a background */
$myPicture->drawFilledRectangle(0,0,1000,600,["Color"=>new pColor(90), "Dash"=>TRUE, "DashColor"=>new pColor(120)]);

/* Overlay with a gradient */ 
$Settings = ["StartColor"=>new pColor(255,255,255,255), "EndColor"=>new pColor(255,255,255,255)];
$myPicture->drawGradientArea(0,0,1000,600,DIRECTION_VERTICAL,$Settings);
$myPicture->drawGradientArea(0,0,1000,600,DIRECTION_HORIZONTAL,$Settings);

/* Add a border to the picture */
$myPicture->drawRectangle(0,0,1000,600,["Color"=>new pColor(0)]);

/* Write the chart title */ 
$myPicture->setFontProperties(["FontName"=>"fonts/Cairo-Regular.ttf","FontSize"=>11]);
$myPicture->drawText(350,35,"Power Over Time",["FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE]);

/* Set the default font */
$myPicture->setFontProperties(["FontSize"=>7]);

/* Define the chart area */
$myPicture->setGraphArea(60,200,1000,580);

/* Draw the scale */
$myPicture->drawScale([
    "XMargin"=>10,
    "YMargin"=>10,
    "Floating"=>TRUE,
    "GridColor"=>new pColor(255),
    "RemoveSkippedAxis"=>TRUE,
    "DrawSubTicks"=>FALSE,
    "Mode"=>SCALE_MODE_START0,
    "LabelingMethod"=>LABELING_DIFFERENT,
    "Factors" => array(1,2)
]);

/* Turn on Anti-aliasing */
//$myPicture->setAntialias(TRUE);

/* Draw the line chart */
$myPicture->setShadow(TRUE,["X"=>1,"Y"=>1,"Color"=>new pColor(255,255,255,255)]);
(new pCharts($myPicture))->drawLineChart();

/* Write a label over the chart */ 
//$myPicture->writeLabel(["Energy Value (KWh)"],[720]);

/* Write the chart legend */
$myPicture->drawLegend(580,20,["Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL]);

/* Render the picture (choose the best way) */
$myPicture->render("power.png");
/* Power factor Over Time */
$myPicture = new pDraw(1000,600);
$sam = 'SELECT `powerFactorPhaseR`,`powerFactorPhaseB`,`powerFactorPhaseY`,`timestamp`,`datetime` FROM `readings` where `timestamp` between 1573870010 AND 1576476650 group by YEAR(`datetime`), MONTH(`datetime`), DAY(`datetime`), HOUR(`datetime`)';
foreach ($PDO->query($sam) as $row) {
    $energy = $row['powerFactorPhaseR'];
    $myPicture->myData->addPoints(array($energy),"powerFactorPhaseR");
    $voltage = $row['powerFactorPhaseB'];
    $myPicture->myData->addPoints(array($voltage),"powerFactorPhaseB");
    $current = $row['powerFactorPhaseY'];
    $myPicture->myData->addPoints(array($current),"powerFactorPhaseY");
    $date = $row['timestamp'];
    $new = date('d.M',$date);
    $myPicture->myData->addPoints(array($new),"timestamp");
    //$myPicture->myData->addPoints(array($date),"datetime"); 
  }
 $myPicture->myData->setAxisProperties(0, ["Name" => "powerFactorPhaseR"]);
 $myPicture->myData->setSerieDescription("powerFactorPhaseR","Powerfactor R"); 
 $myPicture->myData->setSerieProperties("powerFactorPhaseR", ["Weight" => 2]);
 $myPicture->myData->setPalette("powerFactorPhaseR",new pColor(255,0,0,100));

 $myPicture->myData->setAxisProperties(0, ["Name" => "powerFactorPhaseB"]);
 $myPicture->myData->setSerieDescription("powerFactorPhaseB","Powerfactor B"); 
 $myPicture->myData->setSerieProperties("powerFactorPhaseB", ["Weight" => 2]);
 $myPicture->myData->setPalette("powerFactorPhaseB",new pColor(0,0,255,100));

 $myPicture->myData->setAxisProperties(0, ["Name" => "powerFactorPhaseY"]);
 $myPicture->myData->setSerieDescription("powerFactorPhaseY","Powerfactor Y"); 
 $myPicture->myData->setSerieProperties("powerFactorPhaseY", ["Weight" => 2]);
 $myPicture->myData->setPalette("powerFactorPhaseY",new pColor(255,255,0,100));

 $myPicture->myData->setAxisProperties(0, ["Name" => "timestamp"]);
 $myPicture->myData->setAbscissa("timestamp");
/* Turn off Anti-aliasing */
$myPicture->setAntialias(FALSE);

/* Draw a background */
$myPicture->drawFilledRectangle(0,0,1000,600,["Color"=>new pColor(50), "Dash"=>TRUE, "DashColor"=>new pColor(120)]);

/* Overlay with a gradient */ 
$Settings = ["StartColor"=>new pColor(255,255,255,255), "EndColor"=>new pColor(255,255,255,255)];
$myPicture->drawGradientArea(0,0,1000,600,DIRECTION_VERTICAL,$Settings);
$myPicture->drawGradientArea(0,0,1000,600,DIRECTION_HORIZONTAL,$Settings);

/* Add a border to the picture */
$myPicture->drawRectangle(0,0,1000,600,["Color"=>new pColor(0)]);

/* Write the chart title */ 
$myPicture->setFontProperties(["FontName"=>"fonts/Cairo-Regular.ttf","FontSize"=>11]);
$myPicture->drawText(350,35,"Power Factor Over Time",["FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE]);

/* Set the default font */
$myPicture->setFontProperties(["FontSize"=>7]);

/* Define the chart area */
$myPicture->setGraphArea(60,40,1000,580);

/* Draw the scale */
$myPicture->drawScale([
    "XMargin"=>10,
    "YMargin"=>10,
    "Floating"=>TRUE,
    "GridColor"=>new pColor(255),
    "RemoveSkippedAxis"=>TRUE,
    "DrawSubTicks"=>FALSE,
    "Mode"=>SCALE_MODE_START0,
    "LabelingMethod"=>LABELING_DIFFERENT,
    "Factors" => array(1,2)
]);

/* Turn on Anti-aliasing */
//$myPicture->setAntialias(TRUE);

/* Draw the line chart */
$myPicture->setShadow(TRUE,["X"=>1,"Y"=>1,"Color"=>new pColor(255,255,255,255)]);
(new pCharts($myPicture))->drawLineChart();

/* Write a label over the chart */ 
//$myPicture->writeLabel(["Energy Value (KWh)"],[720]);

/* Write the chart legend */
$myPicture->drawLegend(580,20,["Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL]);

/* Render the picture (choose the best way) */
$myPicture->render("powerfactor.png");

/* Energy Value Over Time */
$myPicture = new pDraw(1000,600);
$sam = 'SELECT `energyValue`,`timestamp`,`datetime` FROM `readings` where `timestamp` between 1573870010 AND 1576476650 group by YEAR(`datetime`), MONTH(`datetime`), DAY(`datetime`), HOUR(`datetime`)';
foreach ($PDO->query($sam) as $row) {
    $energy = $row['energyValue']/1000000;
    $myPicture->myData->addPoints(array($energy),"energyValue");
    $date = $row['timestamp'];
    $new = date('d.M',$date);
    $myPicture->myData->addPoints(array($new),"timestamp");
  }
 $myPicture->myData->setAxisProperties(0, ["Name" => "energyValue", "Display" => AXIS_FORMAT_CUSTOM, "Unit" => "k"]);
 $myPicture->myData->setSerieDescription("energyValue","KWh"); 
 $myPicture->myData->setSerieProperties("energyValue", ["Weight" => 2]);

$myPicture->myData->setAxisProperties(0, ["Name" => "timestamp"]);
 $myPicture->myData->setAbscissa("timestamp");

/* Turn off Anti-aliasing */
$myPicture->setAntialias(FALSE);

/* Draw a background */
$myPicture->drawFilledRectangle(0,0,1000,600,["Color"=>new pColor(90), "Dash"=>TRUE, "DashColor"=>new pColor(120)]);

/* Overlay with a gradient */ 
$Settings = ["StartColor"=>new pColor(255,255,255,255), "EndColor"=>new pColor(255,255,255,255)];
$myPicture->drawGradientArea(0,0,1000,600,DIRECTION_VERTICAL,$Settings);
$myPicture->drawGradientArea(0,0,1000,600,DIRECTION_HORIZONTAL,$Settings);

/* Add a border to the picture */
$myPicture->drawRectangle(0,0,1000,600,["Color"=>new pColor(0)]);

/* Write the chart title */ 
$myPicture->setFontProperties(["FontName"=>"fonts/Cairo-Regular.ttf","FontSize"=>11]);
$myPicture->drawText(350,35,"Energy Over Time",["FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE]);

/* Set the default font */
$myPicture->setFontProperties(["FontSize"=>7]);

/* Define the chart area */
$myPicture->setGraphArea(60,100,1000,580);

/* Draw the scale */
$myPicture->drawScale([
    "XMargin"=>10,
    "YMargin"=>10,
    "Floating"=>TRUE,
    "GridColor"=>new pColor(255),
    "RemoveSkippedAxis"=>TRUE,
    "DrawSubTicks"=>FALSE,
    "Mode"=>SCALE_MODE_START0,
    "LabelingMethod"=>LABELING_DIFFERENT,
    "Factors" => array(1,2)
]);

/* Turn on Anti-aliasing */
//$myPicture->setAntialias(TRUE);

/* Draw the line chart */
$myPicture->setShadow(TRUE,["X"=>1,"Y"=>1,"Color"=>new pColor(255,255,255,255)]);
(new pCharts($myPicture))->drawLineChart();

/* Write a label over the chart */ 
//$myPicture->writeLabel(["Energy Value (KWh)"],[720]);

/* Write the chart legend */
$myPicture->drawLegend(580,20,["Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL]);

/* Render the picture (choose the best way) */
$myPicture->render("energyValue.png");
?>