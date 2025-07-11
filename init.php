<?php
require_once 'core/Config.class.php';
require_once 'core/App.class.php';

use core\App;
use core\Config;

$_PARAMS = array(); #global array for parameters from clean URL
$conf = new Config();

# ---- Basic URL options - rather constant
$conf->clean_urls = true;           # turn on pretty urls
$conf->action_param = 'action';     # action parameter name (not needed for clean_urls)
$conf->action_script = '/ctrl.php'; # front controller with location

include 'config.php'; //set user configuration

# ---- Helpful values generated automatically
$conf->root_path = dirname(__FILE__);
$conf->server_url = $conf->protocol.'://'.$conf->server_name;
$conf->app_url = $conf->server_url.$conf->app_root;

if ($conf->clean_urls) {
    $conf->action_root = $conf->app_root."/";
}else{
 $conf->action_root = $conf->app_root.'/index.php?'.$conf->action_param.'=';
}

$conf->action_url = $conf->server_url.$conf->action_root;

App::createAndInitialize($conf);

