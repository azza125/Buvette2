<?php include("connect.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Buvette</title>
	<style>
	   table{
		   width:100%;
		   border : 1px solid black;	   }
		th,td{
             border : 1px solid black;
		}   
	</style>
</head>
<body>
<div class="row">
   <div class="cols-9">
     <img src="img/logo.jpg" style="widh:50px;height:70px;">
      <div style="margin-left:50px ; margin-top:-100px">
	   <h1>EUROBuvettes</h1>
       <a href="#" >Le site de gestion des buvetttes de l'EURO 2016!!</a>
	  </div> 
    </div> 
</div> 
<div class="row" style="text-align:center; background-color: #00008B; ">
	<div class="cols-2">
		<a href="acceuil.php" style="color: white;">Nouveautes</a>
	
	
		<a href="Statistiques.php" style="color: white;">Statistiques</a>
	
	
		<a href="recherchemembres.php" style="color: white;">Recherche membres</a>
	
		<a href="affectations.php" style="color: white;">affectation</a>
	
		<a href="prive.php" style="color: white;">Administrateurs</a>
	</div>
</div>
<div class="row" style="background-color: grey; height: 600px;">
<?php 
         $requete="SELECT m.idM,m.date,m.scoreA,m.scoreB, 
		 a.pays AS paysA ,
		 a.drapeau AS drapeauA, 
		 b.pays AS paysB,b.drapeau AS drapeauB ,
		 count(*) AS b_ouverte,m.idM
		 FROM `match` m,`Equipe` a, `Equipe` b , `est_ouverte` o
		 WHERE a.idE=m.eqA AND b.idE=m.eqB AND m.idM=o.idM
		 GROUP BY m.idM" ;
        $result=mysqli_query( $idConnexion,$requete);
                                                      
 ?>
<table>
  <tbody>
    <th>Date du match</th>
    <th>Equipe A</th>
    <th>Equipe B</th>
    <th>Score</th>
    <th>buvette ouvertes</th>
    <th>nombre de volantaires</th>
</tbody>
<?php
while($row=mysqli_fetch_array($result)){
 $requete1="SELECT  COUNT(*) as nb_present 
		 FROM `match` m,`est_present` p 
		 WHERE m.idM=p.idM
		 AND m.idM=".$row['idM'];
		 $result1=mysqli_query( $idConnexion,$requete1);
		 $nbv=mysqli_fetch_array($result1);
 echo"<tr> 
 <td>" .$row["date"]."</td>
 <td><img src=\"".$row['drapeauA']."\" alt=\"".$row['paysA']."\" height=\"50px\"> </td>
 <td><img src=\"".$row['drapeauB']."\" alt=\"".$row['paysB']."\" height=\"50px\"> </td>
 <td>".$row['scoreA']."-".$row['scoreB']."</td>
 <td>".$row['b_ouverte']."</td>
 <td>".$nbv['nb_present']."</td>
 </tr>";
}
?>
</div>
</table>		
<footer style="height: 20px; background-color: #00008B; color: white;">
	xdmx
</footer>
</body>
</html>