<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Fetch a blank invoice object with Invoice Ninja defaults.
 */
class InvoiceNinjaBlankInvoice extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [];

    protected array $required = [];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/api/v1/invoices/create';

    protected string $toolName = 'invoiceninja_blank_invoice';

    protected string $toolDescription = 'Fetch a blank invoice object with Invoice Ninja defaults.';
}
