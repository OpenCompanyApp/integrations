<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Create or Edit Post
 */
class XCreatePosts extends XGeneratedTool
{
    protected const SLUG = 'x_create_posts';

    protected const DESCRIPTION = 'Create or Edit Post';

    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'createPosts',
        'method' => 'POST',
        'path' => '/2/tweets',
        'parameters' => [
        ],
        'has_body' => true,
        'body_mode' => 'json',
        'auth_modes' => [
            'oauth2_pkce',
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'tweet.read',
            'tweet.write',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Tweets',
        ],
    ];
}
