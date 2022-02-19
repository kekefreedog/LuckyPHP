#!/usr/bin/php -q
<?php 

# Load Autoload
include_once __DIR__."/../../../autoload.php";

# Load space of cli.php
use LuckyPHP\Server\Cli;

# New cli
$instance = new Cli();