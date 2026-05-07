<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Fetch a blank Invoice Ninja recurring invoice object with defaults.
 */
class InvoiceNinjaBlankRecurringInvoice extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [];

    protected array $required = [];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/api/v1/recurring_invoices/create';

    protected string $toolName = 'invoiceninja_blank_recurring_invoice';

    protected string $toolDescription = 'Fetch a blank Invoice Ninja recurring invoice object with defaults.';
}
