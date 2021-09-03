<?php

/** @var \Kahlan\Cli\CommandLine $cmd */
$cmd = $this->commandLine();
$cmd->option('spec', 'default', '_tests/php/spec');
$cmd->option('grep', 'default', '*Test.php');

require_once 'kahlan-bootstrap.php';
