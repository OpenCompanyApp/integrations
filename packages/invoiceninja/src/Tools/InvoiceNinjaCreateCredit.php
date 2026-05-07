<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Create an Invoice Ninja credit.
 */
class InvoiceNinjaCreateCredit extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Request payload matching the Invoice Ninja API schema for this endpoint.'],
    ];

    protected array $required = ['payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'POST';

    protected string $path = '/api/v1/credits';

    protected string $toolName = 'invoiceninja_create_credit';

    protected string $toolDescription = 'Create an Invoice Ninja credit.';
}
