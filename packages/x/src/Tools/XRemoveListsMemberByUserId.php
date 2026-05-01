<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Remove List member
 */
class XRemoveListsMemberByUserId extends XGeneratedTool
{
    protected const SLUG = 'x_remove_lists_member_by_user_id';

    protected const DESCRIPTION = 'Remove List member';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the List to remove a member.',
        ],
        'user_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of User that will be removed from the List.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'removeListsMemberByUserId',
        'method' => 'DELETE',
        'path' => '/2/lists/{id}/members/{user_id}',
        'parameters' => [
            [
                'name' => 'id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
            [
                'name' => 'user_id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
        ],
        'has_body' => false,
        'body_mode' => 'json',
        'auth_modes' => [
            'oauth2_pkce',
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'list.write',
            'tweet.read',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Lists',
        ],
    ];
}
