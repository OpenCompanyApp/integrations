<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

/**
 * Verify a Gumroad license key.
 */
class GumroadVerifyLicense extends AbstractGumroadEndpointTool
{
    protected string $toolName = 'gumroad_verify_license';

    protected string $toolDescription = 'Verify a Gumroad license key.';

    protected string $method = 'POST';

    protected string $path = '/licenses/verify';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'product_permalink' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Product permalink, such as the /l/{permalink} value.',
    ],
    'license_key' => [
        'type' => 'string',
        'required' => true,
        'description' => 'License key to verify.',
    ],
    'increment_uses_count' => [
        'type' => 'boolean',
        'required' => false,
        'description' => 'Whether Gumroad should increment the uses count.',
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
    'increment_uses_count',
];
}
