<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Add or update one mailing list member.
 */
class MailgunAddMember extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_add_member';

    protected string $toolDescription = 'Add or update one mailing list member.';

    protected string $method = 'POST';

    protected string $path = '/lists/{list_address}/members';

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
    'name' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Member display name.',
    ],
    'vars' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Member variables.',
    ],
    'subscribed' => [
        'type' => 'boolean',
        'required' => false,
        'description' => 'Subscription status.',
    ],
    'upsert' => [
        'type' => 'boolean',
        'required' => false,
        'description' => 'Update existing member if present.',
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
    protected array $bodyParams = [
    'address',
    'name',
    'vars',
    'subscribed',
    'upsert',
];
}
