<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Like Post
 */
class XLikePost extends XGeneratedTool
{
    protected const SLUG = 'x_like_post';

    protected const DESCRIPTION = 'Like Post';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the authenticated source User that is requesting to like the Post.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
            'properties' => [
                'tweet_id' => [
                    'type' => 'string',
                    'description' => 'Unique identifier of this Tweet. This is returned as a string in order to avoid complications with languages and tools that cannot handle large integers.',
                    'required' => true,
                ],
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'likePost',
        'method' => 'POST',
        'path' => '/2/users/{id}/likes',
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
            'like.write',
            'tweet.read',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Users',
            'Tweets',
        ],
    ];
}
