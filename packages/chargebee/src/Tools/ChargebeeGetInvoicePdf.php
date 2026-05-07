<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Retrieve invoice PDF metadata and download URL.
 */
class ChargebeeGetInvoicePdf extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results to return.'],
            'offset' => ['type' => 'string', 'description' => 'Pagination offset from a previous response.'],
    ];

    protected array $required = ['id'];

    protected array $queryParams = ['limit', 'offset'];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/invoices/{id}/pdf';

    protected string $toolName = 'chargebee_get_invoice_pdf';

    protected string $toolDescription = 'Retrieve invoice PDF metadata and download URL.';
}
