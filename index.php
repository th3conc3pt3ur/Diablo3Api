<?php
require_once "d3Lib.class.php";
$me = new ApiDiablo3();
$characters = $me->getCharacterListe();
$timePlayed = $me->getTimePlayed();
$tabPlayedSaison = $me->getTimePlayedSaison();

?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Foundation | Welcome</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/jquery.jqplot.min.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>
        <div class="row">
    <div class="large-3 columns">
      <h1><img src="http://placehold.it/400x100&text=Logo"/></h1>
    </div>
    <div class="large-9 columns">
      <ul class="right button-group">
      <li><a href="#" class="button">Link 1</a></li>
      <li><a href="#" class="button">Link 2</a></li>
      <li><a href="#" class="button">Link 3</a></li>
      <li><a href="#" class="button">Link 4</a></li>
      </ul>
     </div>
   </div>
  <div class="row">
    <div class="large-12 columns">
    <div id="slider">
      <img src="http://placehold.it/1000x400&text=[ img 1 ]"/>
    </div>
    
    <hr/>
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
      <div style="float:right;" id="legend"></div>
      <canvas id="timePlayed" width="400" height="300"></canvas>
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns">
        <div class="accordion" id="accordion2">
            <?php
            $cpt = 0;
            foreach ($characters as $characters) 
            {
              $cpt++;?>
              
              <div class="accordion-group">
              <div class="accordion-heading">
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?php echo $cpt;?>">
                <img style="border-radius:5px;" src="img/portraits/<?php echo $characters->class;?>-<?php echo $characters->gender;?>.jpg">
                <span class="<?php if ($characters->hardcore) { echo 'hardcore';}?>"><?php echo $characters->name;?></span>
                <span class="level"><?php echo $characters->level;?> <?php echo $characters->paragonLevel;?></span>
                <!-- <span style="float:right;"><a href="{{ path('api_optimisation',{'heroes_id': characters.id}) }}">Optimisation</a></span> -->
              </a>
              </div>
              <div id="collapse<?php echo $cpt;?>" class="accordion-body collapse">
                <div class="accordion-inner">
                    Skills
                   <!--  <ul style="list-style:none;margin:0px;">
                      {% for skill in characters_details[characters.id] %}
                        <li><table><tr><td rowspan=2><img src="http://media.blizzard.com/d3/icons/skills/42/{{ skill.icon }}.png"></td><td>{{ skill.name }}</td></tr><tr><td><small style="color:grey;">{{ characters_rune_tab[characters.id][loop.index0].name }}</small></td></tr></table></li>
                      {% endfor %}
                    </ul>
                    Items
                    <ul style="list-style:none;margin:0px;">
                       {% for key,value in character_item[characters.id] %}
                          <li>{{ key }} : <a href="http://eu.battle.net/d3/fr/{{ value.tooltipParams }}" onClick="return false;">{{ value.name }}</a></li>
                       {% endfor %}
                    </ul> -->
                </div>
              </div>
            </div>
            <?php
            } 
            ?>
            
        </div>
    </div>
  
  </div>
    
 
<div class="row">
    <div class="large-12 columns">
    
      <div class="panel">
        <h4>Get in touch!</h4>
            
        <div class="row">
          <div class="large-9 columns">
            <p>We'd love to hear from you, you attractive person you.</p>
          </div>
          <div class="large-3 columns">
            <a href="#" class="radius button right">Contact Us</a>
          </div>
        </div>
      </div>
      
    </div>
  </div>

  <footer class="row">
    <div class="large-12 columns">
      <hr/>
      <div class="row">
        <div class="large-6 columns">
          <p>© Copyright no one at all. Go to town.</p>
        </div>
        <div class="large-6 columns">
          <ul class="inline-list right">
            <li><a href="#">Link 1</a></li>
            <li><a href="#">Link 2</a></li>
            <li><a href="#">Link 3</a></li>
            <li><a href="#">Link 4</a></li>
          </ul>
        </div>
      </div>
    </div> 
  </footer>
    <script>
      var radarChartData = {
      labels: ["Barbarian","Crusader","Demon Hunter","Monk","Witch Doctor","Wizard"],
      datasets: [
      {
        label: "Normal",
        fillColor: "rgba(151,187,205,0.2)",
        strokeColor: "rgba(151,187,205,1)",
        pointColor: "rgba(151,187,205,1)",
        pointStrokeColor: "#fff",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(151,187,205,1)",
        data: [<?php echo $timePlayed["barbarian"];?>,<?php echo $timePlayed["crusader"];?>,<?php echo $timePlayed["demon-hunter"];?>,<?php echo $timePlayed["monk"];?>,<?php echo $timePlayed["witch-doctor"];?>,<?php echo $timePlayed["wizard"];?>]
      },
      <?php 
      $i = 0;
      foreach ($tabPlayedSaison as $key => $value) {

      ?>    
      {
        label: "Saison <?php echo $key;?>",
        fillColor: "<?php echo $tabColor[$i];?>0.2)",
        strokeColor: "<?php echo $tabColor[$i];?>1)",
        pointColor: "<?php echo $tabColor[$i];?>1)",
        pointStrokeColor: "#ff0000",
        pointHighlightFill: "#ff0000",
        pointHighlightStroke: "1",
        data: [<?php echo $value["barbarian"];?>,<?php echo $value["crusader"];?>,<?php echo $value["demon-hunter"];?>,<?php echo $value["monk"];?>,<?php echo $value["witch-doctor"];?>,<?php echo $value["wizard"];?>]
      },
      <?php
      $i++;
      }
      ?>
      ]
      };
      window.onload = function(){
      window.myRadar = new Chart(document.getElementById("timePlayed").getContext("2d")).Radar(radarChartData);
      $('#legend').html(myRadar.generateLegend());
      }</script>
      <script src="js/vendor/jquery.js"></script>
      <script src="js/vendor/chart.js"></script>
   </body>
</html>
<?php ?>
