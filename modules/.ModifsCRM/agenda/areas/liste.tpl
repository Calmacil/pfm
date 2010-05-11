<?php

$agendas = $this->vars('agenda');
if ($agendas != null) {
	echo "<table>
		<tr>
			<th>
				Id
			</th>
			<th>
				DateDebut
			</th>
			<th>
				DateFin
			</th>
			<th>
				Repetition
			</th>
			<th>
				Lieu
			</th>
			<th>
				Sujet
			</th>
			<th>
				D&eacute;but
			</th>
			<th>
				Fin
			</th>
			<th>
				Commentaires
			</th>
		</tr>";
	while($agenda = mysqli_fetch_object($agendas)) {
		echo	"<tr><td>".$agenda->id."</td><td>".$agenda->datedebut."</td><td>".$agenda->datefin."</td>";
		echo	"<td>".$agenda->repetition."</td><td>".$agenda->lieu."</td><td>".$agenda->sujet."</td>";
		echo	"<td>".$agenda->heuredebut."</td><td>".$agenda->heurefin."</td>";
		echo	"<td>".$agenda->commentaires."</td></tr>";
	}
	echo "</table>";
}
else	echo "<h3>Agenda vide</h3>";

?>
