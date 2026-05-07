<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Delete a mailing list.
 */
class MailgunDeleteMailingList extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_delete_mailing_list';

    protected string $toolDescription = 'Delete a mailing list.';

    protected string $method = 'DELETE';

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
