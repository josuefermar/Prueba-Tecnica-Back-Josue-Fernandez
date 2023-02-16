<?php

use App\Models\User;
use GraphQL\Type\Definition\Type;

$userMutations = [
    'addUser' => [
        'type' => $userType,
        'args' => [
            'name' => Type::nonNull(Type::string()),
            'email' => Type::nonNull(Type::string()),
        ],
        'resolve' => function ($root, $args) {
            $user = new User([
                'name' => $args['name'],
                'email' => $args['email'],
            ]);
            $user->save();
            return $user->toArray();
        },
        'description' => 'Metodo para creacion de usuarios'
    ],
    'modifyUser' => [
        'type' => $userType,
        'args' => [
            'id' => Type::nonNull(Type::int()),
            'name' => Type::string(),
            'email' => Type::string(),
        ],
        'resolve' => function ($root, $args) {
            $user = User::find($args['id']);

            $user->name = isset($args['name']) ? $args['name'] : $user->name;
            $user->email = isset($args['email']) ? $args['email'] : $user->email;

            $user->save();
            return $user->toArray();
        },
        'description' => 'Metodo para modificacion de usuarios'
    ],
    'deleteUser' => [
        'type' => $userType,
        'args' => [
            'id' => Type::nonNull(Type::int())
        ],
        'resolve' => function ($root, $args) {
            $user = User::find($args['id']);
            $user->delete();
            return $user->toArray();
        },
        'description' => 'Metodo para eliminacion de usuarios'
    ]
];
