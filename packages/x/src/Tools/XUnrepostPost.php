<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Unrepost Post
 */
class XUnrepostPost extends XGeneratedTool
{
    protected const SLUG = 'x_unrepost_post';

    protected const DESCRIPTION = 'Unrepost Post';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the authenticated source User that is requesting to repost the Post.',
        ],
        'source_tweet_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the Post that the User is requesting to unretweet.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'unrepostPost',
        'method' => 'DELETE',
        'path' => '/2/users/{id}/retweets/{source_tweet_id}',
        'parameters' => [
            [
                'name' => 'id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
            [
                'name' => 'source_tweet_id',
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
            'tweet.read',
            'tweet.write',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Users',
            'Tweets',
        ],
    ];
}
