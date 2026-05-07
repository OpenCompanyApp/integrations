<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Update a mailing list.
 */
class MailgunUpdateMailingList extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_update_mailing_list';

    protected string $toolDescription = 'Update a mailing list.';

    protected string $method = 'PUT';

    protected string $path = '/lists/{list_address}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'list_address' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Mailing list address.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Mailing list update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'list_address',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
