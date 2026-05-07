<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Collect payment for an invoice.
 */
class ChargebeeCollectInvoicePayment extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Form payload using Chargebee API parameter names, including bracketed keys such as subscription_items[item_price_id][0].'],
    ];

    protected array $required = ['id', 'payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'POST';

    protected string $path = '/invoices/{id}/collect_payment';

    protected string $toolName = 'chargebee_collect_invoice_payment';

    protected string $toolDescription = 'Collect payment for an invoice.';
}
