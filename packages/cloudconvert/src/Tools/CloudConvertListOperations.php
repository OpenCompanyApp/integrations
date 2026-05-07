<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

/**
 * List available operations, formats, engines, versions, and options.
 */
class CloudConvertListOperations extends AbstractCloudConvertTool
{
    protected string $toolName = 'cloudconvert_list_operations';

    protected string $toolDescription = 'List available operations, formats, engines, versions, and options.';

    protected string $method = 'GET';

    protected string $path = '/operations';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'operation' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Filter by operation name, such as convert or optimize.',
    ],
    'input_format' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Filter by input format.',
    ],
    'output_format' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Filter by output format.',
    ],
    'engine' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Filter by engine name.',
    ],
    'engine_version' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Filter by engine version.',
    ],
    'alternatives' => [
        'type' => 'boolean',
        'required' => false,
        'description' => 'Include alternative engines where available.',
    ],
    'include' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Comma-separated includes such as options,engine_versions.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented CloudConvert query parameters to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'operation' => 'filter[operation]',
    'input_format' => 'filter[input_format]',
    'output_format' => 'filter[output_format]',
    'engine' => 'filter[engine]',
    'engine_version' => 'filter[engine_version]',
    'alternatives',
    'include',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
