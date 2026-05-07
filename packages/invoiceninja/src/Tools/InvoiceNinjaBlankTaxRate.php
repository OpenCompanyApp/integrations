<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Fetch a blank Invoice Ninja tax rate object with defaults.
 */
class InvoiceNinjaBlankTaxRate extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [];

    protected array $required = [];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/api/v1/tax_rates/create';

    protected string $toolName = 'invoiceninja_blank_tax_rate';

    protected string $toolDescription = 'Fetch a blank Invoice Ninja tax rate object with defaults.';
}
