<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get Timeline
 */
class XGetUsersTimeline extends XGeneratedTool
{
    protected const SLUG = 'x_get_users_timeline';

    protected const DESCRIPTION = 'Get Timeline';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the authenticated source User to list Reverse Chronological Timeline Posts of.',
        ],
        'since_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The minimum Post ID to be included in the result set. This parameter takes precedence over start_time if both are specified.',
        ],
        'until_id' => [
            'type' => 'string',
            'required' => false,
            'description' => 'The maximum Post ID to be included in the result set. This parameter takes precedence over end_time if both are specified.',
        ],
        'max_results' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The maximum number of results.',
        ],
        'pagination_token' => [
            'type' => 'string',
            'required' => false,
            'description' => 'This parameter is used to get the next \'page\' of results.',
        ],
        'exclude' => [
            'type' => 'array',
            'required' => false,
            'description' => 'The set of entities to exclude (e.g. \'replies\' or \'retweets\').',
            'items' => [
                'type' => 'string',
            ],
        ],
        'start_time' => [
            'type' => 'string',
            'required' => false,
            'description' => 'YYYY-MM-DDTHH:mm:ssZ. The earliest UTC timestamp from which the Posts will be provided. The since_id parameter takes precedence if it is also specified.',
        ],
        'end_time' => [
            'type' => 'string',
            'required' => false,
            'description' => 'YYYY-MM-DDTHH:mm:ssZ. The latest UTC timestamp to which the Posts will be provided. The until_id parameter takes precedence if it is also specified.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'getUsersTimeline',
        'method' => 'GET',
        'path' => '/2/users/{id}/timelines/reverse_chronological',
        'parameters' => [
            [
                'name' => 'id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
            [
                'name' => 'since_id',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'until_id',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'max_results',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'pagination_token',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'exclude',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => false,
            ],
            [
                'name' => 'start_time',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'end_time',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
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
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Users',
            'Tweets',
        ],
    ];
}
