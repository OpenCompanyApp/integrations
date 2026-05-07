<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Create a non-recurring invoice for charge items and ad hoc charges.
 */
class ChargebeeCreateInvoiceForChargeItemsAndCharges extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Form payload using Chargebee API parameter names, including bracketed keys such as subscription_items[item_price_id][0].'],
    ];

    protected array $required = ['payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'POST';

    protected string $path = '/invoices/create_for_charge_items_and_charges';

    protected string $toolName = 'chargebee_create_invoice_for_charge_items_and_charges';

    protected string $toolDescription = 'Create a non-recurring invoice for charge items and ad hoc charges.';
}
