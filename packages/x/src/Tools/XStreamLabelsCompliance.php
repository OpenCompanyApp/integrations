<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Stream Post labels
 */
class XStreamLabelsCompliance extends XGeneratedTool
{
    protected const SLUG = 'x_stream_labels_compliance';

    protected const DESCRIPTION = 'Stream Post labels';

    protected const PARAMETERS = [
        'backfill_minutes' => [
            'type' => 'integer',
            'required' => false,
            'description' => 'The number of minutes of backfill requested.',
        ],
        'start_time' => [
            'type' => 'string',
            'required' => false,
            'description' => 'YYYY-MM-DDTHH:mm:ssZ. The earliest UTC timestamp from which the Post labels will be provided.',
        ],
        'end_time' => [
            'type' => 'string',
            'required' => false,
            'description' => 'YYYY-MM-DDTHH:mm:ssZ. The latest UTC timestamp from which the Post labels will be provided.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'streamLabelsCompliance',
        'method' => 'GET',
        'path' => '/2/tweets/label/stream',
        'parameters' => [
            [
                'name' => 'backfill_minutes',
                'in' => 'query',
                'required' => false,
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
            'Compliance',
        ],
    ];
}
