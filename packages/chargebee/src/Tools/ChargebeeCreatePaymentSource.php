<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Create a payment source for a customer.
 */
class ChargebeeCreatePaymentSource extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Form payload using Chargebee API parameter names, including bracketed keys such as subscription_items[item_price_id][0].'],
    ];

    protected array $required = ['payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'POST';

    protected string $path = '/payment_sources/create_using_temp_token';

    protected string $toolName = 'chargebee_create_payment_source';

    protected string $toolDescription = 'Create a payment source for a customer.';
}
