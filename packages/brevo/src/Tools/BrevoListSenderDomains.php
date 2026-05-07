<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * List sender domains.
 */
class BrevoListSenderDomains extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_list_sender_domains';

    protected string $toolDescription = 'List sender domains.';

    protected string $method = 'GET';

    protected string $path = '/senders/domains';

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
