<?php

namespace OpenCompany\Integrations\Gumroad\Tools;

/**
 * Delete an offer code for a product.
 */
class GumroadDeleteProductOfferCode extends AbstractGumroadEndpointTool
{
    protected string $toolName = 'gumroad_delete_product_offer_code';

    protected string $toolDescription = 'Delete an offer code for a product.';

    protected string $method = 'DELETE';

    protected string $path = '/products/{product_id}/offer_codes/{offer_code_id}';

    /** @var array<string, array<string, mixed>> */
    protected array $parameters = [
    'product_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Gumroad product ID.',
    ],
    'offer_code_id' => [
        'type' => 'string',
        'required' => true,
        'description' => 'Offer code ID.',
    ],
];

    /** @var list<string> */
    protected array $required = [
    'product_id',
    'offer_code_id',
];

    /** @var array<int|string, string> */
    protected array $queryParams = [];

    /** @var array<int|string, string> */
    protected array $bodyParams = [];
}
