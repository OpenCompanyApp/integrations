<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Fetch a blank Invoice Ninja credit object with defaults.
 */
class InvoiceNinjaBlankCredit extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [];

    protected array $required = [];

    protected array $queryParams = [];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/api/v1/credits/create';

    protected string $toolName = 'invoiceninja_blank_credit';

    protected string $toolDescription = 'Fetch a blank Invoice Ninja credit object with defaults.';
}
