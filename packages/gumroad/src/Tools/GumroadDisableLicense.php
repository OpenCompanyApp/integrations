<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

/**
 * Disable a Gumroad license key.
 */
class GumroadDisableLicense extends AbstractGumroadEndpointTool
{
    protected string $toolName = 'gumroad_disable_license';

    protected string $toolDescription = 'Disable a Gumroad license key.';

    protected string $method = 'PUT';

    protected string $path = '/licenses/disable';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'product_permalink' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Product permalink.',
    ],
    'license_key' => [
        'type' => 'string',
        'required' => true,
        'description' => 'License key to disable.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'product_permalink',
    'license_key',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [
    'product_permalink',
    'license_key',
];
}
