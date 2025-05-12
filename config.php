<?php
$conf->debug = true; # set true during development and use in your code (for instance check if true to send additional message)

$conf->server_name = 'localhost';
$conf->server_url = 'http://'.$conf->server_name;
$conf->app_root = '/notesapp';
$conf->action_root = $conf->app_root.'/ctrl.php?action=';

# ---- Webapp location
$conf->server_name = 'localhost';   # server address and port
$conf->protocol = 'http';           # http or https
$conf->app_root = '/notesapp/public';   # project subfolder in domain (relative to main domain)

# ---- Database config - values required by Medoo
$conf->db_type = 'mysql';
$conf->db_server = 'localhost';
$conf->db_name = 'notes';
$conf->db_user = 'root';
$conf->db_pass = '';
$conf->db_charset = 'utf8';

# ---- Database config - optional values
$conf->db_port = '3306';
#$conf->db_prefix = '';
$conf->db_option = [ PDO::ATTR_CASE => PDO::CASE_NATURAL, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ];

$conf->action_url = $conf->server_url.$conf->action_root;
$conf->app_url = $conf->server_url.$conf->app_root;
$conf->root_path = dirname(__FILE__);