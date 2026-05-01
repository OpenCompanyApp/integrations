<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Delete Post
 */
class XDeletePosts extends XGeneratedTool
{
    protected const SLUG = 'x_delete_posts';

    protected const DESCRIPTION = 'Delete Post';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the Post to be deleted.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'deletePosts',
        'method' => 'DELETE',
        'path' => '/2/tweets/{id}',
        'parameters' => [
            [
                'name' => 'id',
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
            'Tweets',
        ],
    ];
}
