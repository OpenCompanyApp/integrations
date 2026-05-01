<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Stream sampled Posts
 */
class XStreamPostsSample extends XGeneratedTool
{
    protected const SLUG = 'x_stream_posts_sample';

    protected const DESCRIPTION = 'Stream sampled Posts';

    protected const PARAMETERS = [
        'backfill_minutes' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The number of minutes of backfill requested.',
        ],
        'tweet.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of Tweet fields to display.',
            'items' => [
                'type' => 'string',
            ],
        ],
        'expansions' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of fields to expand.',
            'items' => [
                'type' => 'string',
            ],
        ],
        'media.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of Media fields to display.',
            'items' => [
                'type' => 'string',
            ],
        ],
        'poll.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of Poll fields to display.',
            'items' => [
                'type' => 'string',
            ],
        ],
        'user.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of User fields to display.',
            'items' => [
                'type' => 'string',
            ],
        ],
        'place.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of Place fields to display.',
            'items' => [
                'type' => 'string',
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'streamPostsSample',
        'method' => 'GET',
        'path' => '/2/tweets/sample/stream',
        'parameters' => [
            [
                'name' => 'backfill_minutes',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'tweet.fields',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => false,
            ],
            [
                'name' => 'expansions',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => false,
            ],
            [
                'name' => 'media.fields',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => false,
            ],
            [
                'name' => 'poll.fields',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => false,
            ],
            [
                'name' => 'user.fields',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => false,
            ],
            [
                'name' => 'place.fields',
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
        ],
        'required_scopes' => [
        ],
        'runtime_mode' => 'stream',
        'tags' => [
            'Stream',
            'Tweets',
        ],
    ];
}
