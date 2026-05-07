<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * List transactional email logs.
 */
class BrevoListTransactionalEmails extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_list_transactional_emails';

    protected string $toolDescription = 'List transactional email logs.';

    protected string $method = 'GET';

    protected string $path = '/smtp/emails';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'email' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Recipient email filter.',
    ],
    'template_id' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Template ID filter.',
    ],
    'message_id' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Message ID filter.',
    ],
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
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'email',
    'template_id' => 'templateId',
    'message_id' => 'messageId',
    'start_date' => 'startDate',
    'end_date' => 'endDate',
    'limit',
    'offset',
    'sort',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
