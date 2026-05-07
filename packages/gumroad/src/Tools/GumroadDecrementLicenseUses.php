<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

/**
 * Decrement the uses count for a Gumroad license key.
 */
class GumroadDecrementLicenseUses extends AbstractGumroadEndpointTool
{
    protected string $toolName = 'gumroad_decrement_license_uses';

    protected string $toolDescription = 'Decrement the uses count for a Gumroad license key.';

    protected string $method = 'PUT';

    protected string $path = '/licenses/decrement_uses_count';

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
        'description' => 'License key.',
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
