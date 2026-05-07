<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Fetch a blank Invoice Ninja purchase order object with defaults.
 */
class InvoiceNinjaBlankPurchaseOrder extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [];

    protected array $required = [];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/api/v1/purchase_orders/create';

    protected string $toolName = 'invoiceninja_blank_purchase_order';

    protected string $toolDescription = 'Fetch a blank Invoice Ninja purchase order object with defaults.';
}
