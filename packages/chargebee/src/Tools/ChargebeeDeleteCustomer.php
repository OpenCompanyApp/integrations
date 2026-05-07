<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Delete or archive a Chargebee customer by ID.
 */
class ChargebeeDeleteCustomer extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Form payload using Chargebee API parameter names, including bracketed keys such as subscription_items[item_price_id][0].'],
    ];

    protected array $required = ['id'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'POST';

    protected string $path = '/customers/{id}/delete';

    protected string $toolName = 'chargebee_delete_customer';

    protected string $toolDescription = 'Delete or archive a Chargebee customer by ID.';
}
