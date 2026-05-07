<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Verify API credentials by listing one domain.
 */
class MailgunGetCurrentUser extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_get_current_user';

    protected string $toolDescription = 'Verify API credentials by listing one domain.';

    protected string $method = 'GET';

    protected string $path = '/v4/domains';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'limit' => [
        'type' => 'integer',
        'required' => false,
        'description' => 'Number of domains to return.',
    ],
];

    /** @var list<string> */
    protected array $required = [];

    /** @var array<int|string, string> */
    protected array $queryParams = [
    'limit',
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
