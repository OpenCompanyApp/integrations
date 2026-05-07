<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Fetch a blank Invoice Ninja vendor object with defaults.
 */
class InvoiceNinjaBlankVendor extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [];

    protected array $required = [];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/api/v1/vendors/create';

    protected string $toolName = 'invoiceninja_blank_vendor';

    protected string $toolDescription = 'Fetch a blank Invoice Ninja vendor object with defaults.';
}
