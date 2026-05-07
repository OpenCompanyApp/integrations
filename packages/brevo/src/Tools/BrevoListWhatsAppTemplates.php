<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * List WhatsApp templates.
 */
class BrevoListWhatsAppTemplates extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_list_whatsapp_templates';

    protected string $toolDescription = 'List WhatsApp templates.';

    protected string $method = 'GET';

    protected string $path = '/whatsappCampaigns/template-list';

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
