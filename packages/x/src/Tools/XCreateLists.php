<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Create List
 */
class XCreateLists extends XGeneratedTool
{
    protected const SLUG = 'x_create_lists';

    protected const DESCRIPTION = 'Create List';

    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'createLists',
        'method' => 'POST',
        'path' => '/2/lists',
        'parameters' => [
        ],
        'has_body' => true,
        'body_mode' => 'json',
        'auth_modes' => [
            'oauth2_pkce',
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'list.read',
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
