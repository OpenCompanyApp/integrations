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
