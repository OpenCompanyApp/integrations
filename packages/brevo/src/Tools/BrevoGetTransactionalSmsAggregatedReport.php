<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Get transactional SMS aggregated report.
 */
class BrevoGetTransactionalSmsAggregatedReport extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_get_transactional_sms_aggregated_report';

    protected string $toolDescription = 'Get transactional SMS aggregated report.';

    protected string $method = 'GET';

    protected string $path = '/transactionalSMS/statistics/aggregatedReport';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'start_date' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Start date.',
    ],
    'end_date' => [
        'type' => 'string',
        'required' => false,
        'description' => 'End date.',
    ],
    'days' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Number of days.',
    ],
    'tag' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Tag filter.',
    ],
    'query' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo query parameters to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'start_date' => 'startDate',
    'end_date' => 'endDate',
    'days',
    'tag',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
