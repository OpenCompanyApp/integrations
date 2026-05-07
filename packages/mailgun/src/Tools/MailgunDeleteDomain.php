<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Delete a Mailgun domain.
 */
class MailgunDeleteDomain extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_delete_domain';

    protected string $toolDescription = 'Delete a Mailgun domain.';

    protected string $method = 'DELETE';

    protected string $path = '/v4/domains/{domain}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'domain' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Mailgun domain.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'domain',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
