<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Hide reply
 */
class XHidePostsReply extends XGeneratedTool
{
    protected const SLUG = 'x_hide_posts_reply';

    protected const DESCRIPTION = 'Hide reply';

    protected const PARAMETERS = [
        'tweet_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the reply that you want to hide or unhide.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'hidePostsReply',
        'method' => 'PUT',
        'path' => '/2/tweets/{tweet_id}/hidden',
        'parameters' => [
            [
                'name' => 'tweet_id',
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
            'tweet.moderate.write',
            'tweet.read',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Tweets',
        ],
    ];
}
