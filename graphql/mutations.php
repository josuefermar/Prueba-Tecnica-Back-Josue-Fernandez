<?php

use GraphQL\Type\Definition\ObjectType;

require('mutations/userMutations.php');
require('mutations/ticketMutations.php');

$mutations = array();
$mutations += $userMutations;
$mutations += $ticketMutations;

$rootMutation = new ObjectType([
    'name' => 'Mutation',
    'fields' => $mutations
]);