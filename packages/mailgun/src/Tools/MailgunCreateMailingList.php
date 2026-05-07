<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Create a mailing list.
 */
class MailgunCreateMailingList extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_create_mailing_list';

    protected string $toolDescription = 'Create a mailing list.';

    protected string $method = 'POST';

    protected string $path = '/lists';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'address' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Mailing list address.',
    ],
    'name' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Display name.',
    ],
    'description' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Description.',
    ],
    'access_level' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Access level.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'address',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'address',
    'name',
    'description',
    'access_level',
];
}
