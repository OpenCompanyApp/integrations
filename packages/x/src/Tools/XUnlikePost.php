<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Unlike Post
 */
class XUnlikePost extends XGeneratedTool
{
    protected const SLUG = 'x_unlike_post';

    protected const DESCRIPTION = 'Unlike Post';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the authenticated source User that is requesting to unlike the Post.',
        ],
        'tweet_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the Post that the User is requesting to unlike.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'unlikePost',
        'method' => 'DELETE',
        'path' => '/2/users/{id}/likes/{tweet_id}',
        'parameters' => [
            [
                'name' => 'id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
            [
                'name' => 'tweet_id',
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
