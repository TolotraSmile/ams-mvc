<?php
/**
 * Created by Tolotra Raharison
 * GitHub : tolotrasmile.github.io
 * At : 29/07/2016 10:24
 * Copyright etech consulting 2016
 */

use App\Helpers\Debugger;
use App\Helpers\FormHelper;

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'vendor/autoload.php';

//echo FormHelper::input('submit', ['value' => 'Submiter :D']);
$mode = new \App\Model\CircularisationModel();
Debugger::dd($mode->exists(4781));
