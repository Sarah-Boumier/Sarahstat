<?php
include '../ressource/variable globale.php';
	if(!empty($_POST)) 
	{
		$total = 0;
		if ($_POST['date'] < $_POST['date2'])
		{
			$date1 = date('Y-m-d H:i:s', strtotime($_POST['date']));
			$date2 = date('Y-m-d H:i:s', strtotime($_POST['date2']));

			if ($_POST['etat'] == "Envoyés")
			{
				$id = "id"; $er = 1; $count = "COUNT(*)";
			}
			if ($_POST['etat'] == "Reçus")
			{
				$id = "id2"; $er = 0; $count = "COUNT(*)";
			}
			if ($_POST['etat'] == "Totaux")
			{
				$id = "id";  $count = "count(t1.id)";
			}
			if ($_POST['etat'] == "Envoyés" || $_POST['etat'] == "Reçus")
			{
			
				$req = mysqli_query($conn, "SELECT $id, COUNT(*) FROM datadm2 where datetimes BETWEEN '$date1' AND '$date2'  AND er = $er  GROUP BY $id ORDER BY COUNT(*) DESC");
				while ($ligne = mysqli_fetch_array($req))
				{
					$total = $total + $ligne[$count];
				}
				$req = mysqli_query($conn, "SELECT $id, COUNT(*) FROM datadm2 where datetimes BETWEEN '$date1' AND '$date2'  AND er = $er  GROUP BY $id ORDER BY COUNT(*) DESC");
			}
			else
			{
				$req = mysqli_query($conn, "SELECT t1.id, count(t1.id) FROM ( SELECT id from datadm2 where datetimes BETWEEN '$date1' AND '$date2' UNION ALL SELECT id2 from datadm2 where datetimes BETWEEN '$date1' AND '$date2') AS t1 GROUP by id ORDER by count(*) DESC");
				while ($ligne = mysqli_fetch_array($req))
				{
					$total = $total + $ligne[$count];
				}
				$req = mysqli_query($conn, "SELECT t1.id, count(t1.id) FROM ( SELECT id from datadm2 where datetimes BETWEEN '$date1' AND '$date2' UNION ALL SELECT id2 from datadm2 where datetimes BETWEEN '$date1' AND '$date2') AS t1 GROUP by id ORDER by count(*) DESC");
				$total = $total / 2;
			}
				$place = 1;
				?><br><br><?php
			if (mysqli_num_rows($req) != 0)
			{
				?>
			<table id="tableau01" class="tableau01" >
				<tr style=" background-color:#d4e3e5;">
					<th class="td01">Place</th>
					<th class="td01">Pseudo</th>
					<th class="td01">Nombre</th>
					<th class="td01">Pourcentage</th>
				</tr>				
			<?php
				while ($ligne = mysqli_fetch_array($req))
				{
				 	if ($ligne[$id] != $personal_id)
				 	{
				 		$idp = $ligne[$id];
				 		?> 
				 		<tr style=" background-color:#d4e3e5;">
				 			<td class="td01"><?php echo $place++; ?></td>
				 			<td class="td01"><?php include('id-to-name.php');?></td>
				 			<td class="td01"><a href="discussion.php?date1=<?=$date1?>&date2=<?=$date2?>&id=<?=$idp?>&string=<?=$string?>&ert=<?=$_POST['etat']?>" style="color: black;"><?php echo $ligne[$count]; ?></a></td>
				 			<td class="td01"><?php echo round(($ligne[$count]/$total * 100), 2); echo "%"; ?></td>
				 		</tr> <?php
				 	}	 	
				}
			}
			else
			{
				?><div class="error"><text class="info">Il n'y a pas de données à afficher pour cette période là ! </text></div><?php
			}
			?>
				<script type="text/javascript">
				var resizeHandler = function resizeHandler () 
				{
					var Wmax = 1284;
					var Wmin = 300;
					var Pmax = 0.95;
					var Pmin = 0.5;
					var width = window.innerWidth;
					console.log(width);
					if (width >= Wmax)
					{
   						document.getElementById("tableau01").style.width = "50%";
					}
					else if (width > Wmin && width < Wmax)
						{
							var ecart = (Wmax - (width - Wmin));
							var coef = (ecart- Wmin) / (Wmax -Wmin);
							var Ptableau = ((coef * (Pmax - Pmin)) + Pmin) * 100;
							document.getElementById("tableau01").style.width = Ptableau + "%";
							console.log(Ptableau);
						}
					else
						document.getElementById("tableau01").style.width = "95%";			
					return Ptableau;
				};
				addEventListener ('resize', resizeHandler);
				addEventListener ('load', resizeHandler);
		</script>
			<?php
		}
		else
		{
			?>
			<div class="error"><label class="info">La date de début doit être antérieure à la date de fin ! </label></div>
			</table>
			<?php
		}
	}
	?>
