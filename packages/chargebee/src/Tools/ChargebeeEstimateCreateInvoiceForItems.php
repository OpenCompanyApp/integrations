<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Estimate creating an invoice for item prices and charges.
 */
class ChargebeeEstimateCreateInvoiceForItems extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Form payload using Chargebee API parameter names, including bracketed keys such as subscription_items[item_price_id][0].'],
    ];

    protected array $required = ['payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'POST';

    protected string $path = '/estimates/create_invoice_for_items';

    protected string $toolName = 'chargebee_estimate_create_invoice_for_items';

    protected string $toolDescription = 'Estimate creating an invoice for item prices and charges.';
}
