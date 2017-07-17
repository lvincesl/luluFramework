<?php

require ('Luluframework/Client/View/Table.php');
require ('Luluframework/Client/View/Table/Row.php');

use Luluframework\Client\View\Table;

$table = new Table();
$table->set_header(array('un', 'deux', 'trois', 'quatre', 'cinq'));
$table->add_row(15, array(45,46,44,41,35));

echo $table->getSourceCOde();