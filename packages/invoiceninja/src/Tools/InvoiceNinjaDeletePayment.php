<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Delete an Invoice Ninja payment by ID.
 */
class InvoiceNinjaDeletePayment extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource hashed ID.'],
    ];

    protected array $required = ['id'];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'DELETE';

    protected string $path = '/api/v1/payments/{id}';

    protected string $toolName = 'invoiceninja_delete_payment';

    protected string $toolDescription = 'Delete an Invoice Ninja payment by ID.';
}
