<?php 

spl_autoload_register('myAutoloader');

function myAutoloader($className)
{
    $path = 'pChart2/';
    include $path.$className.'.php';
}

use pChart\pColor;
use pChart\pDraw;
use pChart\pCharts;

//***************** FIRST CHART ****************************

/* Create the pChart object */
$myPicture = new pDraw(700,230);

/* Populate the pData object */
$myPicture->myData->addPoints([-4,VOID,VOID,12,8,3],"Probe 1");
$myPicture->myData->addPoints([3,12,15,8,5,-5],"Probe 2");
$myPicture->myData->addPoints([2,7,5,18,19,22],"Probe 3");
$myPicture->myData->setSerieProperties("Probe 2", ["Ticks" => 4]);
$myPicture->myData->setSerieProperties("Probe 3", ["Weight" => 2]);
$myPicture->myData->setAxisName(0,"Temperatures");
$myPicture->myData->addPoints(["Jan","Feb","Mar","Apr","May","Jun"],"Labels");
$myPicture->myData->setSerieDescription("Labels","Months");
$myPicture->myData->setAbscissa("Labels");

/* Turn off Anti-aliasing */
$myPicture->setAntialias(FALSE);

/* Add a border to the picture */
$myPicture->drawRectangle(0,0,699,229,["Color"=>new pColor(0)]);

/* Write the chart title */ 
$myPicture->setFontProperties(["FontName"=>"pChart2/fonts/Cairo-Regular.ttf","FontSize"=>11]);
$myPicture->drawText(150,35,"Average temperature",["FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE]);

/* Set the default font */
$myPicture->setFontProperties(["FontSize"=>7]);

/* Define the chart area */
$myPicture->setGraphArea(60,40,650,200);

/* Draw the scale */
$myPicture->drawScale(["XMargin"=>10,"YMargin"=>10,"Floating"=>TRUE,"GridColor"=>new pColor(200),"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE]);

/* Turn on Anti-aliasing */
$myPicture->setAntialias(TRUE);

/* Draw the line chart */
(new pCharts($myPicture))->drawLineChart();

/* Write the chart legend */
$myPicture->drawLegend(540,20,["Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL]);

/* Render the picture (choose the best way) */
$myPicture->render("chartimages/test4.png");


//***************** SECOND CHART ****************************

/* Create the pChart object */
$myPicture2 = new pDraw(700,230);

/* Populate the pData object */
$myPicture2->myData->addPoints([-4,VOID,VOID,12,8,3],"Probe 1");
$myPicture2->myData->addPoints([3,12,15,8,5,-5],"Probe 2");
//$myPicture->myData->addPoints([2,7,5,18,19,22],"Probe 3");
$myPicture2->myData->setSerieProperties("Probe 2", ["Ticks" => 4]);
//$myPicture->myData->setSerieProperties("Probe 3", ["Weight" => 2]);
$myPicture2->myData->setAxisName(0,"Temperatures");
$myPicture2->myData->addPoints(["Jan","Feb","Mar","Apr","May","Jun"],"Labels");
$myPicture2->myData->setSerieDescription("Labels","Months");
$myPicture2->myData->setAbscissa("Labels");

/* Turn off Anti-aliasing */
$myPicture2->setAntialias(FALSE);

/* Add a border to the picture */
$myPicture2->drawRectangle(0,0,699,229,["Color"=>new pColor(0)]);

/* Write the chart title */ 
$myPicture2->setFontProperties(["FontName"=>"pChart2/fonts/Cairo-Regular.ttf","FontSize"=>11]);
$myPicture2->drawText(150,35,"Average temperature",["FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE]);

/* Set the default font */
$myPicture2->setFontProperties(["FontSize"=>7]);

/* Define the chart area */
$myPicture2->setGraphArea(60,40,650,200);

/* Draw the scale */
$myPicture2->drawScale(["XMargin"=>10,"YMargin"=>10,"Floating"=>TRUE,"GridColor"=>new pColor(200),"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE]);

/* Turn on Anti-aliasing */
$myPicture2->setAntialias(TRUE);

/* Draw the line chart */
(new pCharts($myPicture2))->drawLineChart();

/* Write the chart legend */
$myPicture2->drawLegend(540,20,["Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL]);

/* Render the picture (choose the best way) */
$myPicture2->render("chartimages/PIC2.png");
?>