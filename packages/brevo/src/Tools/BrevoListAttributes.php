<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * List contact attributes.
 */
class BrevoListAttributes extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_list_attributes';

    protected string $toolDescription = 'List contact attributes.';

    protected string $method = 'GET';

    protected string $path = '/contacts/attributes';

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
