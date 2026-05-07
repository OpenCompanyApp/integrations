<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Fetch a blank Invoice Ninja project object with defaults.
 */
class InvoiceNinjaBlankProject extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [];

    protected array $required = [];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/api/v1/projects/create';

    protected string $toolName = 'invoiceninja_blank_project';

    protected string $toolDescription = 'Fetch a blank Invoice Ninja project object with defaults.';
}
