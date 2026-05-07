<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Call the Invoice Ninja ping endpoint.
 */
class InvoiceNinjaPing extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [];

    protected array $required = [];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/api/v1/ping';

    protected string $toolName = 'invoiceninja_ping';

    protected string $toolDescription = 'Call the Invoice Ninja ping endpoint.';
}
