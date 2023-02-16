<?php

use App\Models\Ticket;
use App\Models\User;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

$rootQuery = new ObjectType([
    'name' => 'Query',
    'fields' => [
        'user' => [
            'type' => $userType,
            'args' => [
                'id' => Type::nonNull(Type::int())
            ],
            'resolve' => function ($root, $args) {
                return User::find($args['id'])->toArray();
            }
        ],
        'users' => [
            'type' => Type::listOf($userType),
            'args' => [
                'pagination' => Type::int(),
                'page' => Type::int(),
            ],
            'resolve' => function ($root, $args) {
                $users =  User::all()->toArray();

                if (isset($args['pagination'])) {
                    $chunksUsers = array_chunk($users, $args['pagination']);
                    $page = isset($args['page']) ? $args['page'] : 1;
                    $users = $chunksUsers[$page - 1];
                }

                return $users;
            }
        ],
        'ticket' => [
            'type' => $ticketType,
            'args' => [
                'id' => Type::nonNull(Type::int())
            ],
            'resolve' => function ($root, $args) {
                return Ticket::find($args['id'])->toArray();
            }
        ],
        'tickets' => [
            'type' => Type::listOf($ticketType),
            'args' => [
                'pagination' => Type::int(),
                'page' => Type::int(),
                'user_id' => Type::int(),
                'status' => Type::string(),
            ],
            'resolve' => function ($root, $args) {
                $tickets =  Ticket::get();

                if (isset($args['user_id'])) {
                    $tickets->where('user_id', '=', $args['user_id']);
                }
                if (isset($args['status'])) {
                    $tickets->where('status', '=', $args['status']);
                }
                $tickets->toArray();

                if (isset($args['pagination'])) {
                    $chunksTickets = array_chunk($tickets, $args['pagination']);
                    $page = isset($args['page']) ? $args['page'] : 1;
                    $tickets = $chunksTickets[$page - 1];
                }

                return $tickets;
            }
        ],
    ]
]);
