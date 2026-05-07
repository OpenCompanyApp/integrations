<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Call the Invoice Ninja health-check endpoint.
 */
class InvoiceNinjaHealthCheck extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [];

    protected array $required = [];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/api/v1/health_check';

    protected string $toolName = 'invoiceninja_health_check';

    protected string $toolDescription = 'Call the Invoice Ninja health-check endpoint.';
}
