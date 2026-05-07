<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Fetch a blank product object with Invoice Ninja defaults.
 */
class InvoiceNinjaBlankProduct extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [];

    protected array $required = [];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/api/v1/products/create';

    protected string $toolName = 'invoiceninja_blank_product';

    protected string $toolDescription = 'Fetch a blank product object with Invoice Ninja defaults.';
}
