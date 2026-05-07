<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Delete a Mailgun Complaint record.
 */
class MailgunDeleteComplaint extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_delete_complaint';

    protected string $toolDescription = 'Delete a Mailgun Complaint record.';

    protected string $method = 'DELETE';

    protected string $path = '/{domain}/complaints/{address}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'domain' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Mailgun domain. Defaults to the configured sending domain.',
    ],
    'address' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Email address.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'address',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
