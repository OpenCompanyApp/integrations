<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Delete or archive an Invoice Ninja purchase order by ID.
 */
class InvoiceNinjaDeletePurchaseOrder extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource hashed ID.'],
    ];

    protected array $required = ['id'];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'DELETE';

    protected string $path = '/api/v1/purchase_orders/{id}';

    protected string $toolName = 'invoiceninja_delete_purchase_order';

    protected string $toolDescription = 'Delete or archive an Invoice Ninja purchase order by ID.';
}
