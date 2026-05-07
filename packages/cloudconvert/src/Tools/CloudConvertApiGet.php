<?php

namespace OpenCompany\Integrations\CloudConvert\Tools;

/**
 * Call any CloudConvert API GET endpoint path.
 */
class CloudConvertApiGet extends AbstractCloudConvertTool
{
    protected string $toolName = 'cloudconvert_api_get';

    protected string $toolDescription = 'Call any CloudConvert API GET endpoint path.';

    protected string $method = 'GET';

    protected string $path = '{path}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'path' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Endpoint path, such as /jobs or /operations.',
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
];
}
