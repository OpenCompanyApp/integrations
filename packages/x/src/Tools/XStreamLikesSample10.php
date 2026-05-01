<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Stream sampled Likes
 */
class XStreamLikesSample10 extends XGeneratedTool
{
    protected const SLUG = 'x_stream_likes_sample10';

    protected const DESCRIPTION = 'Stream sampled Likes';

    protected const PARAMETERS = [
        'backfill_minutes' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The number of minutes of backfill requested.',
        ],
        'partition' => [
            'type' => 'integer',
            'required' => true,
            'description' => 'The partition number.',
        ],
        'start_time' => [
            'type' => 'string',
            'required' => false,
            'description' => 'YYYY-MM-DDTHH:mm:ssZ. The earliest UTC timestamp to which the Likes will be provided.',
        ],
        'end_time' => [
            'type' => 'string',
            'required' => false,
            'description' => 'YYYY-MM-DDTHH:mm:ssZ. The latest UTC timestamp to which the Posts will be provided.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'streamLikesSample10',
        'method' => 'GET',
        'path' => '/2/likes/sample10/stream',
        'parameters' => [
            [
                'name' => 'backfill_minutes',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'partition',
                'in' => 'query',
                'required' => true,
                'style' => 'form',
                'explode' => null,
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
            'bearer_token',
        ],
        'required_scopes' => [
        ],
        'runtime_mode' => 'stream',
        'tags' => [
            'Stream',
            'Likes',
        ],
    ];
}
