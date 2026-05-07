<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

/**
 * Enable a Gumroad license key.
 */
class GumroadEnableLicense extends AbstractGumroadEndpointTool
{
    protected string $toolName = 'gumroad_enable_license';

    protected string $toolDescription = 'Enable a Gumroad license key.';

    protected string $method = 'PUT';

    protected string $path = '/licenses/enable';

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
        'description' => 'License key to enable.',
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
