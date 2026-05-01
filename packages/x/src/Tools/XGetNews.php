<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get news stories by ID
 */
class XGetNews extends XGeneratedTool
{
    protected const SLUG = 'x_get_news';

    protected const DESCRIPTION = 'Get news stories by ID';

    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The ID of the news story.',
        ],
        'news.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of News fields to display.',
            'items' => [
                'type' => 'string',
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'getNews',
        'method' => 'GET',
        'path' => '/2/news/{id}',
        'parameters' => [
            [
                'name' => 'id',
                'in' => 'path',
                'required' => true,
                'style' => 'simple',
                'explode' => null,
            ],
            [
                'name' => 'news.fields',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => false,
            ],
        ],
        'has_body' => false,
        'body_mode' => 'json',
        'auth_modes' => [
            'bearer_token',
            'oauth2_pkce',
            'oauth1a_user_context',
        ],
        'required_scopes' => [
            'tweet.read',
            'users.read',
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'News',
        ],
    ];
}
