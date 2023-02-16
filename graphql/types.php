<?php

use App\Models\Ticket;
use App\Models\User;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

$userType = new ObjectType([
    'name' => 'User',
    'description' => 'Este es el tipo de dato usuario',
    'fields' => function () use (&$ticketType) {
        return [
            'id' => Type::int(),
            'name' => Type::string(),
            'email' => Type::string(),
            'tickets' => [
                'type' => Type::listOf($ticketType),
                'resolve' => function ($root, $args) {
                    $userId = $root['id'];
                    $user = User::where('id', $userId)->with(['tickets'])->first();
                    return $user->tickets->toArray();
                }
            ]
        ];
    }
]);

$ticketType = new ObjectType([
    'name' => 'Ticket',
    'description' => 'Este es el tipo de dato Ticket',
    'fields' => [
        'id' => Type::int(),
        'user_id' => Type::int(),
        'status' => Type::string(),
        'user' => [
            'type' => $userType,
            'resolve' => function ($root, $args) {
                $ticketId = $root['id'];
                $ticket = Ticket::where('id', $ticketId)->with(['user'])->first();
                return $ticket->user->toArray();
            }
        ]
    ]
]);
