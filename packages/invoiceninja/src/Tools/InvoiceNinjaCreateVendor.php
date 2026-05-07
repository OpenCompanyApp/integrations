<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Create an Invoice Ninja vendor.
 */
class InvoiceNinjaCreateVendor extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Request payload matching the Invoice Ninja API schema for this endpoint.'],
    ];

    protected array $required = ['payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'POST';

    protected string $path = '/api/v1/vendors';

    protected string $toolName = 'invoiceninja_create_vendor';

    protected string $toolDescription = 'Create an Invoice Ninja vendor.';
}
