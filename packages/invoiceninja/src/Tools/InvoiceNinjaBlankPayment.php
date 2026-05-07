<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Fetch a blank payment object with Invoice Ninja defaults.
 */
class InvoiceNinjaBlankPayment extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [];

    protected array $required = [];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/api/v1/payments/create';

    protected string $toolName = 'invoiceninja_blank_payment';

    protected string $toolDescription = 'Fetch a blank payment object with Invoice Ninja defaults.';
}
