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
        'rules_count.fields' => [
            'type' => 'array',
            'required' => false,
            'description' => 'A comma separated list of RulesCount fields to display.',
            'items' => [
                'type' => 'string',
            ],
        ],
    ];

    protected const OPERATION = [
        'id' => 'getRuleCounts',
        'method' => 'GET',
        'path' => '/2/tweets/search/stream/rules/counts',
        'parameters' => [
            [
                'name' => 'rules_count.fields',
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
        'runtime_mode' => 'request_response',
        'tags' => [
            'Stream',
            'Tweets',
        ],
    ];
}
