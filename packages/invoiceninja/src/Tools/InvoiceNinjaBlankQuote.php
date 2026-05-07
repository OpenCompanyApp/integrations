<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Fetch a blank Invoice Ninja quote object with defaults.
 */
class InvoiceNinjaBlankQuote extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [];

    protected array $required = [];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/api/v1/quotes/create';

    protected string $toolName = 'invoiceninja_blank_quote';

    protected string $toolDescription = 'Fetch a blank Invoice Ninja quote object with defaults.';
}
