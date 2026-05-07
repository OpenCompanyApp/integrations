<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Bulk add mailing list members.
 */
class MailgunAddMemberBulk extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_add_member_bulk';

    protected string $toolDescription = 'Bulk add mailing list members.';

    protected string $method = 'POST';

    protected string $path = '/lists/{list_address}/members.json';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'list_address' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Mailing list address.',
    ],
    'members' => [
        'type' => 'array',
        'required' => true,
        'description' => 'Array of member objects.',
    ],
    'upsert' => [
        'type' => 'boolean',
        'required' => false,
        'description' => 'Update existing members.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'list_address',
    'members',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'members',
    'upsert',
];
}
