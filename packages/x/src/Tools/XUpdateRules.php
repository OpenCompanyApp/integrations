<?php

namespace OpenCompany\Integrations\X\Tools;

/**
 * Update stream rules
 */
class XUpdateRules extends XGeneratedTool
{
    protected const SLUG = 'x_update_rules';

    protected const DESCRIPTION = 'Update stream rules';

    protected const PARAMETERS = [
        'dry_run' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Dry Run can be used with both the add and delete action, with the expected result given, but without actually taking any action in the system (meaning the end state will always be as it was when the request was submitted). This is particularly useful to validate rule changes.',
        ],
        'delete_all' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Delete All can be used to delete all of the rules associated this client app, it should be specified with no other parameters. Once deleted, rules cannot be recovered.',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body for this X API operation. Use the shape documented by the official operation schema.',
        ],
    ];

    protected const OPERATION = [
        'id' => 'updateRules',
        'method' => 'POST',
        'path' => '/2/tweets/search/stream/rules',
        'parameters' => [
            [
                'name' => 'dry_run',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
            [
                'name' => 'delete_all',
                'in' => 'query',
                'required' => false,
                'style' => 'form',
                'explode' => null,
            ],
        ],
        'has_body' => true,
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
