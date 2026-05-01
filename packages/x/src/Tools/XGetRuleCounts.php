<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Get stream rule counts
 */
class XGetRuleCounts extends XGeneratedTool
{
    protected const SLUG = 'x_get_rule_counts';

    protected const DESCRIPTION = 'Get stream rule counts';

    protected const PARAMETERS = [
    ];

    protected const OPERATION = [
        'id' => 'getRuleCounts',
        'method' => 'GET',
        'path' => '/2/tweets/search/stream/rules/counts',
        'parameters' => [
        ],
        'has_body' => false,
        'body_mode' => 'json',
        'auth_modes' => [
            'bearer_token',
        ],
        'required_scopes' => [
        ],
        'runtime_mode' => 'request_response',
        'tags' => [
            'Stream',
            'Tweets',
        ],
    ];
}
