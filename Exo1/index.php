<?php
// Tableau associatif : clé = nom, valeur = moyenne (slide 64)
$etudiantsNote = array("JOHN" => 9, "BOB" => 15.5, "RAYANE" => 7, "ROSIE" => 13);

// Déclaration d'une fonction avec paramètre et retour (slide 71)
 function estAdmissible($note){
// Opérateur de comparaison >= (slide 66)
 return ($note>=10);
 }

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
        <tr><th>Etudiant</th><th>Note</th></tr>

  <?php
  // Boucle foreach sur clé => valeur (slide 69)
foreach($etudiantsNote as $nom => $note){
   // Condition if / else (slide 67)
if(estAdmissible($note)){
  $couleur = "rgb(136,248,136)"; 
}
else {
  $couleur = "rgb(251,173,173)";
}
echo "<tr class='row'>";
echo "<td class='etud'>" . $nom . "</td>";
echo "<td class='note'style='background-color:$couleur'>" . $note . "</td>";
echo "</tr>";
}
  ?>
</table>
</body>
</html>