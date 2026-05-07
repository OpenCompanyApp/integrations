<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Update an Invoice Ninja purchase order by ID.
 */
class InvoiceNinjaUpdatePurchaseOrder extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource hashed ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Request payload matching the Invoice Ninja API schema for this endpoint.'],
    ];

    protected array $required = ['id', 'payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'PUT';

    protected string $path = '/api/v1/purchase_orders/{id}';

    protected string $toolName = 'invoiceninja_update_purchase_order';

    protected string $toolDescription = 'Update an Invoice Ninja purchase order by ID.';
}
