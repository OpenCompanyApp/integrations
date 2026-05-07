<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Delete one mailing list member.
 */
class MailgunDeleteMember extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_delete_member';

    protected string $toolDescription = 'Delete one mailing list member.';

    protected string $method = 'DELETE';

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
];

    /** @var list<string> */
    protected array $required = [
    'list_address',
    'address',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
