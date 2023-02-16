<?php

use App\Models\Ticket;
use GraphQL\Type\Definition\Type;

$ticketMutations = [
    'createTicket' => [
        'type' => $ticketType,
        'args' => [
            'user_id' => Type::nonNull(Type::int()),
            'status' => Type::nonNull(Type::string())
        ],
        'resolve' => function ($root, $args) {
            $ticket = new Ticket([
                'user_id' => $args['user_id'],
                'status' => $args['status'],
            ]);
            $ticket->save();
            return $ticket->toArray();
        },
        'description' => 'Metodo para creacion de tickets'
    ],
    'modifyTicket' => [
        'type' => $ticketType,
        'args' => [
            'id' => Type::nonNull(Type::int()),
            'user_id' => Type::int(),
            'status' => Type::string(),
        ],
        'resolve' => function ($root, $args) {
            $ticket = Ticket::find($args['id']);

            $ticket->user_id = isset($args['user_id']) ? $args['user_id'] : $ticket->user_id;
            $ticket->status = isset($args['status']) ? $args['status'] : $ticket->status;

            $ticket->save();
            return $ticket->toArray();
        },
        'description' => 'Metodo para modificacion de tickets'
    ],
    'deleteTicket' => [
        'type' => $ticketType,
        'args' => [
            'id' => Type::nonNull(Type::int())
        ],
        'resolve' => function ($root, $args) {
            $user = Ticket::find($args['id']);
            $user->delete();
            return $user->toArray();
        },
        'description' => 'Metodo para eliminacion de tickets'
    ]
];
