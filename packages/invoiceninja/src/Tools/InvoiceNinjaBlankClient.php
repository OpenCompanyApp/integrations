<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Fetch a blank client object with Invoice Ninja defaults.
 */
class InvoiceNinjaBlankClient extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [];

    protected array $required = [];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/api/v1/clients/create';

    protected string $toolName = 'invoiceninja_blank_client';

    protected string $toolDescription = 'Fetch a blank client object with Invoice Ninja defaults.';
}
