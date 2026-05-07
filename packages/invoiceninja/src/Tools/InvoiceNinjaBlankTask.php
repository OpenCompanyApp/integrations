<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Fetch a blank Invoice Ninja task object with defaults.
 */
class InvoiceNinjaBlankTask extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [];

    protected array $required = [];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/api/v1/tasks/create';

    protected string $toolName = 'invoiceninja_blank_task';

    protected string $toolDescription = 'Fetch a blank Invoice Ninja task object with defaults.';
}
