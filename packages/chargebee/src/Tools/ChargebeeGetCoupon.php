<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Retrieve a Chargebee coupon by ID.
 */
class ChargebeeGetCoupon extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID.'],
    ];

    protected array $required = ['id'];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/coupons/{id}';

    protected string $toolName = 'chargebee_get_coupon';

    protected string $toolDescription = 'Retrieve a Chargebee coupon by ID.';
}
