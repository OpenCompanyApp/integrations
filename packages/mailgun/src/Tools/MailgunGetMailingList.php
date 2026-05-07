<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Get one mailing list by address.
 */
class MailgunGetMailingList extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_get_mailing_list';

    protected string $toolDescription = 'Get one mailing list by address.';

    protected string $method = 'GET';

    protected string $path = '/lists/{list_address}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'list_address' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Mailing list address.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'list_address',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
