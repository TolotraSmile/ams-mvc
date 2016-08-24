<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 16/08/2016 10:24
 * Copyright etech consulting 2016
 */

$now = new DateTime();
$mois = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
$date = ucwords(strftime("%d " . $mois[(int)date("m", time()) - 1] . " %Y", time()));
var_dump($date);