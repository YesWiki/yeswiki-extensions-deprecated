<?php 
//Retourne le timestamp du début du mois du timestamp renseigné
function getMonthStartTS($in_timeStamp) { 
	return mktime( 0, 1, 1, date("m", $in_timeStamp), 1, date("Y", $in_timeStamp)); 					
}

//Retourne le timestamp de la fin du mois du timestamp renseigné
function getMonthEndTS($in_timeStamp) { 
	return mktime( 23,	59,	59, date("m", $in_timeStamp)+1, 1, date("Y", $in_timeStamp)); 
}

//Retourne le timestamp du début de la semaine du timestamp renseigné
function getWeekStartTS($in_timeStamp) { 
	
}

//Retourne le timestamp de la fin de la semaine mois du timestamp renseigné
function getWeekEndTS($in_timeStamp) { 
	
}

//Retourne le timestamp du début du jour du timestamp renseigné
function getDayStartTS($in_timeStamp) { 

}

//Retourne le timestamp de la fin du jour du timestamp renseigné
function getDayEndTS($in_timeStamp) { 

}

 /***************************************************************************
 * Elimine les evenement en dehors de l'intervalle précisé
 * et range ceux restant par ordre chronologique.
 */
function filterEvents($in_startTS, $in_endTS, $in_data) {
	$selectedData = array();
	//Filtre les évenements
	foreach($in_data as $event) {
		//TODO : prendre en compte les évenement sur plusieurs jours/mois/années/millénaires
		//       decouper les éléments au jour le jour.
		if (($event["DTSTART"]["unixtime"] <= $in_endTS) && ($event["DTEND"]["unixtime"] >= $in_startTS)) {
				array_push($selectedData, $event);		
		}
	}/**/
	return $selectedData;	
}

/****************************************************************************
 * Crée le squelette de donnée du calendrier (Vue mensuelle).
 */
function makeMonth($in_timestamp, $in_data)
{
	$startMonthTS = mktime( 0, 0, 0, date("m", $in_timestamp), 1, date("Y", $in_timestamp));
	$firstDay = date("w",$startMonthTS); //0 --> Dimanche...6--> Samedi
	if ($firstDay == 0) 
		$firstDay = 7;
	$firstDay--; //<-- premier jour de la semaine = Lundi

	$nb_jours = date("t", mktime( 0, 1, 1, date("m", $in_timestamp)+1, 0, date("Y", $in_timestamp)));	
	
	$month = array();
	//Les jours vide de début de mois
	for($i=0 ; $i<$firstDay ; $i++){
		$day = array("isBlank" => true, "isToday" => false, "isEvent" => false, "startDayTS" => mktime(0,0,0,0,0,0), "endDayTS" => mktime(0,0,0,0,0,0), "events" => array() );
		array_push($month, $day);
	}
	//ajouter les jours
	for($i=0 ; $i<$nb_jours ; $i++){
		$isToday = false;
		$isEvent = false;
		$startDayTS = mktime(0, 0, 0, date("m", $startMonthTS)  , date("d", $startMonthTS)+$i, date("Y", $startMonthTS));
		$endDayTS = mktime(23, 59, 59, date("m", $startMonthTS)  , date("d", $startMonthTS)+$i, date("Y", $startMonthTS));
		
		if ((time() >= $startDayTS ) && (time() <= $endDayTS ))
			$isToday = true;
		
		$events = array();
		foreach ($in_data as $event){
			if (($event["DTSTART"]["unixtime"] <= $endDayTS) && ($event["DTEND"]["unixtime"] >= $startDayTS)) {
				$event["SUMMARY"] = htmlentities(utf8_decode($event["SUMMARY"]));
				if ($event["DTEND"]["unixtime"] != $startDayTS){
					array_push($events, $event);
					$isEvent = true;
				}
			}
				
		}
		array_push($month, array("isBlank" => false, "isToday" => $isToday, "isEvent" => $isEvent, "startDayTS" => $startDayTS, "endDayTS" => $endDayTS, "events" => $events));
		
	}
	//Les jours de fin de mois.
	if (($nb_jours+$firstDay) % 7 != 0) {
		for($i=0 ; $i < 7 - (($nb_jours+$firstDay) % 7) ; $i++){
			$day = array("isBlank" => true, "isToday" => false, "isEvent" => false, "startDayTS" => mktime(0,0,0,0,0,0), "endDayTS" => mktime(0,0,0,0,0,0), "events" => array() );
			array_push($month, $day);
		}
	}
	
	return $month;
}



/****************************************************************************
 * Affichage du calendrier (vue mois)
 */

function printMonthCal($in_timeStamp, $in_data, $params) {

	if (isset($params['colora'])) $in_colora = $params['colora']; else $in_colora = 'gray';
	if (isset($params['colorb'])) $in_colorb = $params['colorb']; else $in_colorb = 'red';
	if (isset($params['url'])) $url = $params['url']; else die('ERREUR action cal : param&ecirc;tre "url" obligatoire!');

	print("<div class='calendar' style='border:1px solid ".$in_colora.";'>\n");
//	print("<div class='calendar_content'>couleur a : ".$in_colora."</div>");
//	print("<div class='calendar_content'>couleur b : ".$in_colorb."</div>");
	print("<div class='calendar_content'>\n");

	$jourencours = date("j", $in_timeStamp);
	$moisencours = date("n", $in_timeStamp);
	$anneeencours = date("Y", $in_timeStamp);
	$next_month = strtotime('+1 month',$in_timeStamp);
	$prev_month = strtotime('-1 month',$in_timeStamp);
	$url_params = "&amp;url=".urlencode($url)."&amp;colora=".urlencode($in_colora)."&amp;colorb=".urlencode($in_colorb);
	
	$lsMonth = array(1 => "Janv.",
					 2 => "F&eacute;v.",
					 3 => "Mars",
					 4 => "Avril",
					 5 => "Mai",
					 6 => "Juin",
					 7 => "Juil.",
					 8 => "Ao&ucirc;t",
					 9 => "Sept.",
					 10 => "Oct.",
					 11 => "Nov.",
					 12 => "D&eacute;c.");
	$lsMonthm = array(1 => "janv.",
					 2 => "f&eacute;v.",
					 3 => "mars",
					 4 => "avril",
					 5 => "mai",
					 6 => "juin",
					 7 => "juil.",
					 8 => "ao&ucirc;t",
					 9 => "sept.",
					 10 => "oct.",
					 11 => "nov.",
					 12 => "d&eacute;c.");
	$lsMonthlg = array(0 => "D&eacute;cembre",
					 1 => "Janvier",
					 2 => "F&eacute;vrier",
					 3 => "Mars",
					 4 => "Avril",
					 5 => "Mai",
					 6 => "Juin",
					 7 => "Juillet",
					 8 => "Ao&ucirc;t",
					 9 => "Septembre",
					 10 => "Octobre",
					 11 => "Novembre",
					 12 => "D&eacute;cembre",
					 13 => "Janvier");
	$lsMonthlgm = array(0 => "d&eacute;cembre",
					 1 => "janvier",
					 2 => "f&eacute;vrier",
					 3 => "mars",
					 4 => "avril",
					 5 => "mai",
					 6 => "juin",
					 7 => "juillet",
					 8 => "ao&ucirc;t",
					 9 => "septembre",
					 10 => "octobre",
					 11 => "novembre",
					 12 => "d&eacute;cembre",
					 13 => "janvier");

	print("<div class=\"cal_haut\" style='border-bottom:1px dotted ".$in_colora.";'>");
	print("<div class=\"select_date\">");
	print("<div class=\"fleche fgauche\"><a href=\"tools/wikical/libs/update.php?timestamp=".$prev_month.$url_params."\" class=\"cal_prev prev_month\" title=\"".$lsMonthlg[$moisencours-1]."\">&lsaquo;</a></div>");
	print("<div class=\"fleche fdroite\"><a href=\"tools/wikical/libs/update.php?timestamp=".$next_month.$url_params."\" class=\"cal_next next_month\" title=\"".$lsMonthlg[$moisencours+1]."\">&rsaquo;</a></div>\n");
	
	print("<div class=\"list\">");
	print("<div class=\"month_list\"><a>".$lsMonthlg[$moisencours]."</a></div>");
	print("<div class=\"year_list\"><a>".$anneeencours."</a></div>");
	print("</div>"); //fin list
	
	print("</div>\n");
	print("</div>");


print("<div class='caltable'>\n");
	//Liste des mois		
	print("<div class=\"select selectm\">\n");
	for ($i=1; $i<=12; $i++){
		print("\t<div><a class=\"select_item\" style='background-color:".$in_colora.";' title='Changer de mois' href=\"tools/wikical/libs/update.php?timestamp=".mktime(0, 0, 0, $i, $jourencours, $anneeencours).$url_params."\">".$lsMonth[$i]."</a></div>\n");
	}
	print("</div>\n"); //fin month_list
	//Liste des années
	print("<div class=\"select selecta\">\n");
	for($i=-4;$i<5;$i++) {
		print("\t<div><a class=\"select_item\" style='background-color:".$in_colora.";' title='Changer d'ann&eacute;e' href=\"tools/wikical/libs/update.php?timestamp=".mktime(0, 0, 0, $moisencours, $jourencours, $anneeencours+$i).$url_params.'">'.($anneeencours+$i)."</a></div>\n");	
	}
	print("</div>\n"); //fin year_list

	print("<div class='calrow tr_entete'>\n"); 
		print("<div class='calcell day_name'>Lu</div>\n");
		print("<div class='calcell day_name'>Ma</div>\n");
		print("<div class='calcell day_name'>Me</div>\n");
		print("<div class='calcell day_name'>Je</div>\n");
		print("<div class='calcell day_name'>Ve</div>\n");
		print("<div class='calcell day_name'>Sa</div>\n");
		print("<div class='calcell day_name'>Di</div>\n");
	print("</div>\n"); 

//  Début de la partie non chargée en premier
//création des tr
$ligne=0;
$nb = 7;

	foreach($in_data as $day) {

 //si 1er élement on commence une ligne 
	$start = ($ligne%$nb == 0)?"<div class='calrow ligne".($ligne/7+1)."'>":"";
 //si dernier élément on finit la ligne 
	$end = ($ligne%$nb == $nb-1)?"</div>\n":""; 
print("$start"); 
 //  tableau jour semaine
	$lsJourlg = array(0 => "Lundi",
					 1 => "Mardi",
					 2 => "Mercredi",
					 3 => "Jeudi",
					 4 => "Vendredi",
					 5 => "Samedi",
					 6 => "Dimanche");
 
	$lsJourJoli = array(0 => "1er",);
 
 //on affiche  
		//Creation du DIV
		if ($day["isToday"]) {
		if ($day["isEvent"])
			print("<div class='calcell today evday' style='color:".$in_colorb.";'>");
		else
			print("<div class='calcell today' style='color:".$in_colorb.";'>");}
		else if ($day["isEvent"])
			print("<div class='calcell evday'>");
		else
			print("<div class='calcell nonev'>");
		//Contenu du DIV
		if(!$day["isBlank"] && !$day["isEvent"]) {
			print("<div class='celmarg'>");
			print("<p class='jour'>");
			print(date("d",$day['startDayTS']));
			print("</p>");
			print("</div>");
		}
		elseif(!$day["isBlank"]) {
			print("<div class='celmarg' style='background-color:".$in_colora.";'>");
			print("<p class='jour'>");
			print(date("d",$day['startDayTS']));
			print("</p>");
			print("</div>");
		}
		//affichage des events
		if ($day["isEvent"]) {
			print ("<div class='events' style='background-color:".$in_colora.";'>");
			print ("<p class='jourlg'>");
			print ($lsJourlg[($ligne%7)]);
				if (date("j",$day['startDayTS']) == 1) {
					print(" ".$lsJourJoli[0]);
				}
				else {
					print(" ".date("j",$day['startDayTS']));
				}
			print(" ".$lsMonthlgm[$moisencours]." ".$anneeencours);
			print ("</p>");
			
			foreach($day["events"] as $event) {
				print("<p class='event_title'>".$event["SUMMARY"]."</p>");
				//TODO : Gerer toutes les infos
				//       Ajouter une boucle. 
				
				//Evenement sur plusieurs jours.
				if ( ($event["DTEND"]["unixtime"] - $event["DTSTART"]["unixtime"]) > 86400) {
					print("<p class='event_info'>");
					if (date("j", $event["DTSTART"]["unixtime"]) == 1) {
						print(" ".$lsJourJoli[0]);
					}
					else {
						print(" ".date("j", $event["DTSTART"]["unixtime"]));
					}
					print(" ".$lsMonthm[date("n", $event["DTSTART"]["unixtime"])]);
					if (date("Y", $event["DTSTART"]["unixtime"]) != date('Y') || date("Y", $event["DTSTART"]["unixtime"]) != date("Y", $event["DTEND"]["unixtime"])) {
					print(date(" Y", $event["DTSTART"]["unixtime"]));
					}
					if (date("G", $event["DTSTART"]["unixtime"]) != 0 || date("i", $event["DTEND"]["unixtime"]) != 00) {
						print(date(" (G", $event["DTSTART"]["unixtime"])."h");
						if (date("i", $event["DTSTART"]["unixtime"]) != 00) {
							print(date("i", $event["DTSTART"]["unixtime"]));
						}
						print(")");
					}
					print(" au ");
					if (date("j", $event["DTEND"]["unixtime"]) == 1) {
						print(" ".$lsJourJoli[0]);
					}
					else {
						print(" ".date("j", $event["DTEND"]["unixtime"]));
					}
					print(" ".$lsMonthm[date("n", $event["DTEND"]["unixtime"])]);
					if (date("Y", $event["DTEND"]["unixtime"]) != date('Y')) {
					print(date(" Y", $event["DTEND"]["unixtime"]));
					}
					if (date("G", $event["DTEND"]["unixtime"]) != 0 || date("i", $event["DTEND"]["unixtime"]) != 00) {
						print(date(" (G", $event["DTEND"]["unixtime"])."h");
						if (date("i", $event["DTEND"]["unixtime"]) != 00) {
							print(date("i", $event["DTEND"]["unixtime"]));
						}
						print(")");
					}
				}		
				//Evenement sur une journée.
				elseif (($event["DTEND"]["unixtime"] - $event["DTSTART"]["unixtime"]) == 86400) {
					print ("<p class='event_info'>Toute la journ&eacute;e.</p>");	
				} 
				//
				else {
					print("<p class='event_info'>");
					print(date("G", $event["DTSTART"]["unixtime"])."h");
					if (date("i", $event["DTSTART"]["unixtime"]) != 00) {
						print(date("i", $event["DTSTART"]["unixtime"]));
					}
					print(" &agrave; ");
					print(date("G", $event["DTEND"]["unixtime"])."h");
					if (date("i", $event["DTEND"]["unixtime"]) != 00) {
						print(date("i", $event["DTEND"]["unixtime"]));
					}
				}
			}
			print ("</div>\n");
		}
		print ("</div>\n");
	print("$end");
		$ligne = $ligne + 1;
	}
//  Fin de la partie non chargée en premier

	print("</div>\n"); //table
	print("</div>\n");
	print("</div>\n");
}

/////////////////////////////////////////////////////////////////////////////

function firstLoad($in_timeStamp, $params) {

	if (isset($params['colora'])) $in_colora = $params['colora']; else $in_colora = 'gray';
	if (isset($params['colorb'])) $in_colorb = $params['colorb']; else $in_colorb = 'red';
	if (isset($params['url'])) $url = $params['url']; else die('ERREUR action cal : param&ecirc;tre "url" obligatoire!');


	$jourencours = date("j", $in_timeStamp);
	$moisencours = date("n", $in_timeStamp);
	$anneeencours = date("Y", $in_timeStamp);
	$next_month = strtotime('+1 month',$in_timeStamp);
	$prev_month = strtotime('-1 month',$in_timeStamp);
	$url_params = "&amp;url=".urlencode($url)."&amp;colora=".urlencode($in_colora)."&amp;colorb=".urlencode($in_colorb);
	
	$lsMonth = array(1 => "Janv.",
					 2 => "F&eacute;v.",
					 3 => "Mars",
					 4 => "Avril",
					 5 => "Mai",
					 6 => "Juin",
					 7 => "Juil.",
					 8 => "Ao&ucirc;t",
					 9 => "Sept.",
					 10 => "Oct.",
					 11 => "Nov.",
					 12 => "D&eacute;c.");
	$lsMonthlg = array(1 => "Janvier",
					 2 => "F&eacute;vrier",
					 3 => "Mars",
					 4 => "Avril",
					 5 => "Mai",
					 6 => "Juin",
					 7 => "Juillet",
					 8 => "Ao&ucirc;t",
					 9 => "Septembre",
					 10 => "Octobre",
					 11 => "Novembre",
					 12 => "D&eacute;cembre");


	print("<div class='calendar' style='border:1px solid ".$in_colora.";'>\n");
	print("<div class='calendar_content'>\n");


	print("<div class=\"cal_entete\" style='border-bottom:1px dotted ".$in_colora.";'>");
	print("<div class=\"select_date\">");
	print("<div class=\"fleche fgauche\"><a href=\"tools/wikical/libs/update.php?timestamp=".$prev_month.$url_params."\" class=\"cal_prev prev_month\" title=\"".$lsMonthlg[$moisencours-1]."\">&lsaquo;</a></div>");
	print("<div class=\"fleche fdroite\"><a href=\"tools/wikical/libs/update.php?timestamp=".$next_month.$url_params."\" class=\"cal_next next_month\" title=\"".$lsMonthlg[$moisencours+1]."\">&rsaquo;</a></div>\n");
	print("<div class=\"list\">");
	print("<div class=\"month_list\"><a>".$lsMonthlg[$moisencours]."</a></div>");
	print("<div class=\"year_list\"><a>".$anneeencours."</a></div>");
	
	print("<div class=\"list aujourdhui\"><a href=\"tools/wikical/libs/update.php?timestamp=".time().$url_params."\" class=\"cal_now today\" title=\"Aujourd'hui\">Aujourd'hui</a></div>");
	
	print("</div>"); //fin list
	print("</div>"); //fin select_date
	print("<ul class=\"select_date\">");
	print("<li class=\"list\"><a href=\"tools/wikical/libs/update.php?timestamp=".$prev_month.$url_params."\" class=\"cal_prev prev_month\" title=\"Mois pr&eacute;c&eacute;dent\">&lt;&lt;</a></li>");
	print("<li class=\"list month_list\">".$lsMonth[$moisencours]);
	//Liste des mois		
	print("<ul class=\"select\" style='background-color: ".$in_colora.";'>\n");
	for ($i=1; $i<=12; $i++){
		print("\t<li><a class=\"select_item\" href=\"tools/wikical/libs/update.php?timestamp=".mktime(0, 0, 0, $i, $jourencours, $anneeencours).$url_params."\">".$lsMonth[$i]."</a></li>\n");
	}
	print("</ul></li>\n");
	//Liste des années
	print("<li class=\"list year_list\">".$anneeencours);
	print("<ul class=\"select\" style='background-color: ".$in_colora.";'>\n");
	for($i=-4;$i<3;$i++) {
		print("\t<li><a class=\"select_item\" href=\"tools/wikical/libs/update.php?timestamp=".mktime(0, 0, 0, $moisencours, $jourencours, $anneeencours+$i).$url_params.'">'.($anneeencours+$i)."</a></li>\n");	
	}
	print("</ul></li>\n");
	
	print("\n
		<li class=\"list\"><a href=\"tools/wikical/libs/update.php?timestamp=".$next_month.$url_params."\" class=\"cal_next next_month\" title=\"Mois suivant\">&gt;&gt;</a></li>\n");
	
	print("</ul>\n");

	print("</div>");//fin cal_haut



	
/////////////////////////////////////////////////////////////////////////
print("<div class='caltable cal_contenu'>\n"); 
	print("<div class='calrow tr_entete'>\n"); 
		print("<div class='calcell day_name'>Lu</div>\n");
		print("<div class='calcell day_name'>Ma</div>\n");
		print("<div class='calcell day_name'>Me</div>\n");
		print("<div class='calcell day_name'>Je</div>\n");
		print("<div class='calcell day_name'>Ve</div>\n");
		print("<div class='calcell day_name'>Sa</div>\n");
		print("<div class='calcell day_name'>Di</div>\n");
	print("</div>\n"); 


	print("</div>\n"); //table
	print("</div>\n");






	print("</div>\n");
}

?>
