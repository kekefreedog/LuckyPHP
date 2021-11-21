#!/usr/bin/php -q
<?php 

# Load Cli php
include file_exists("vendor/kekefreedog/luckyphp/src/Server/Cli.php") ?
    "vendor/kekefreedog/luckyphp/src/Server/Cli.php" :
        "src/Server/Cli.php";

# Load space of cli.php
use Kutilities\Server\Cli;

# New cli
$instance = new Cli();