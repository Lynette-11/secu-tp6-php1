<?php
// Tableau associatif de tableaux associatifs (slide 64)
$serveurs = array(
  'api-01'   => array('cpu' => 45, 'ram' => 60, 'status' => "1"),
  'api-02'   => array('cpu' => 92, 'ram' => 78, 'status' => "1"),
  'db-prod'  => array('cpu' => 70, 'ram' => 95, 'status' => "1"),
  'web-01'   => array('cpu' => 30, 'ram' => 40, 'status' => "1"),
  'web-02'   => array('cpu' => 55, 'ram' => 65, 'status' => "0"),
  'cache-01' => array('cpu' => 88, 'ram' => 92, 'status' => "1"),
);

// Fonction avec paramètres et retour (slide 71)
function calculeScore($cpu, $ram)
{
  return 100 - ($cpu + $ram) / 2;
}

// Opérateurs logiques || et comparaison (slide 66)
function estCritique($cpu, $ram)
{
  return $cpu > 85 || $ram > 90;
}

$totalOnline = 0;
$sommeScores = 0;
$scoreMoyen = 0;
$meilleurNom = "";
$meilleurScore = -1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <table id="table1" border="1">
    <tr>
      <th>Server</th>
      <th>CPU%</th>
      <th>RAM%</th>
      <th>Status</th>
      <th>Score</th>
      <th>Etat</th>
    </tr>
    <?php
    // foreach clé => valeur (slide 69)
    foreach ($serveurs as $nom => $infos) {
      // Accès aux éléments d'un tableau associatif (slide 64) 
      $cpu = $infos['cpu'];
      $ram = $infos['ram'];
      $online = ($infos['status'] == "1");
      $score = calculeScore($cpu, $ram);

      // Conditions if / elseif / else (slide 67)
      if (estCritique($cpu, $ram)) {
        $etat = "CRITIQUE";
      } elseif ($score >= 50) {
        $etat = "OK";
      } else {
        $etat = "ATTENTION";
      }

      if (!$online) {
        $couleur = "rgb(200,200,200)";
      } elseif ($etat == "CRITIQUE") {
        $couleur = "rgb(255,180,180)";
      } elseif ($score >= 50) {
        $couleur = "rgb(180,255,180)";
      } else {
        $couleur = "rgb(255,220,150)";
      }
      $texteStatus = $online ? "online" : "offline";
      if ($online) {
        $totalOnline++;
      }
      $sommeScores += $score;
      if ($score > $meilleurScore) {
        $meilleurScore = $score;
        $meilleurNom = $nom;
      }

      $style = "style='background-color:$couleur'";
      echo "<tr class='row' $style>";
      echo "<td class='serveur' $style>$nom</td>";
      echo "<td class='cpu' $style>$cpu</td>";
      echo "<td class='ram' $style>$ram</td>";
      echo "<td class='status' $style>$texteStatus</td>";
      echo "<td class='score' $style>$score</td>";
      echo "<td class='etat' $style>$etat</td>";
      echo "</tr>";
    }

    //fonction native sur les tableaux (slide 65)
    $scoreMoyen = $sommeScores / count($serveurs);
    ?>
  </table>

  <h3>Résumé</h3>
  <p>Serveurs online: <span id="total_online_servers"><?php echo $totalOnline; ?></span></p>
  <p>Score moyen: <span id="moy_scores"><?php echo $scoreMoyen; ?></span></p>
  <p>Meilleur serveur: <span id="best_serv"><?php echo $meilleurNom . " (" . $meilleurScore . ")"; ?></span></p>
</body>

</html>