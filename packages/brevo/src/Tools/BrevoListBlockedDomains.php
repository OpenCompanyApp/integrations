<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * List blocked SMTP domains.
 */
class BrevoListBlockedDomains extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_list_blocked_domains';

    protected string $toolDescription = 'List blocked SMTP domains.';

    protected string $method = 'GET';

    protected string $path = '/smtp/blockedDomains';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
];

    /** @var list<string> */
    protected array $required = [
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
];
}
