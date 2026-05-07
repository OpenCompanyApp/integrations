<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

/**
 * Call any CloudConvert API PUT endpoint path.
 */
class CloudConvertApiPut extends AbstractCloudConvertTool
{
    protected string $toolName = 'cloudconvert_api_put';

    protected string $toolDescription = 'Call any CloudConvert API PUT endpoint path.';

    protected string $method = 'PUT';

    protected string $path = '{path}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'path' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Endpoint path to update.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional CloudConvert request body fields.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented CloudConvert query parameters to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'path',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
