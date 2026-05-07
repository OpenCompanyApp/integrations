<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Fetch Invoice Ninja static reference data used by selectors.
 */
class InvoiceNinjaStatics extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [];

    protected array $required = [];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/api/v1/statics';

    protected string $toolName = 'invoiceninja_statics';

    protected string $toolDescription = 'Fetch Invoice Ninja static reference data used by selectors.';
}
