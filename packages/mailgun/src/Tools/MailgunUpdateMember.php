<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Update one mailing list member.
 */
class MailgunUpdateMember extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_update_member';

    protected string $toolDescription = 'Update one mailing list member.';

    protected string $method = 'PUT';

    protected string $path = '/lists/{list_address}/members/{address}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'list_address' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Mailing list address.',
    ],
    'address' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Member email address.',
    ],
    'payload' => [
        'type' => 'object',
        'required' => true,
        'description' => 'Member update body.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'list_address',
    'address',
    'payload',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
