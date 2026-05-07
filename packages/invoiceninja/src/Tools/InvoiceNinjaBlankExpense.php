<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Fetch a blank Invoice Ninja expense object with defaults.
 */
class InvoiceNinjaBlankExpense extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [];

    protected array $required = [];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/api/v1/expenses/create';

    protected string $toolName = 'invoiceninja_blank_expense';

    protected string $toolDescription = 'Fetch a blank Invoice Ninja expense object with defaults.';
}
