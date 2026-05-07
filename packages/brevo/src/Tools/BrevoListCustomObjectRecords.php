<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * List custom object records.
 */
class BrevoListCustomObjectRecords extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_list_custom_object_records';

    protected string $toolDescription = 'List custom object records.';

    protected string $method = 'GET';

    protected string $path = '/objects/{object_type}/records';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'object_type' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Custom object type.',
    ],
    'limit' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Maximum records to return.',
    ],
    'offset' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Number of records to skip.',
    ],
    'sort' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Sort order when supported.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo query parameters to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'object_type',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'limit',
    'offset',
    'sort',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
