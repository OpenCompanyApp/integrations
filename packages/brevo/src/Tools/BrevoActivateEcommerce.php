<?php

namespace OpenCompany\Integrations\Brevo\Tools;

/**
 * Activate eCommerce features for Brevo.
 */
class BrevoActivateEcommerce extends AbstractBrevoTool
{
    protected string $toolName = 'brevo_activate_ecommerce';

    protected string $toolDescription = 'Activate eCommerce features for Brevo.';

    protected string $method = 'POST';

    protected string $path = '/ecommerce/activate';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'payload' => [
        'type' => 'object',
        'required' => false,
        'description' => 'Additional documented Brevo JSON body fields to pass through.',
    ],
];

    /** @var list<string> */
    protected array $required = [
];

    /** @var array<int|string, string> */
    protected array $queryParams = [
];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'payload',
];
}
