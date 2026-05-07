<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Get Brevo account information.
 */
class BrevoGetAccount extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_get_account';

    protected string $toolDescription = 'Get Brevo account information.';

    protected string $method = 'GET';

    protected string $path = '/account';

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
