<?php

namespace OpenCompany\Integrations\Mailgun\Tools;

/**
 * Get one tag for a domain.
 */
class MailgunGetTag extends AbstractMailgunEndpointTool
{
    protected string $toolName = 'mailgun_get_tag';

    protected string $toolDescription = 'Get one tag for a domain.';

    protected string $method = 'GET';

    protected string $path = '/{domain}/tags/{tag}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'domain' => [
        'type' => 'string',
        'required' => false,
        'description' => 'Mailgun domain. Defaults to the configured sending domain.',
    ],
    'tag' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Tag value.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'tag',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
