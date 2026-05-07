<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Get process status.
 */
class BrevoGetProcess extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_get_process';

    protected string $toolDescription = 'Get process status.';

    protected string $method = 'GET';

    protected string $path = '/processes/{process_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'process_id' => [
        'type' => 'integer',
        'required' => true,
        'description' => 'Process ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'process_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
