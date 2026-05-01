<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Add List member
 */
class XAddListsMember extends XGeneratedTool
{
    protected const SLUG = 'x_add_lists_member';

    protected const DESCRIPTION = 'Add List member';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the List for which to add a member.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
            'properties' => [
                'user_id' => [
                    'type' => 'string',
                    'description' => 'Unique identifier of this User. This is returned as a string in order to avoid complications with languages and tools that cannot handle large integers.',
                    'required' => true,
                ],
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'addListsMember',
        'method' => 'POST',
        'path' => '/2/lists/{id}/members',
        'parameters' => [
            [
                'name' => 'id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
        ],
        'has_body' => true,
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
