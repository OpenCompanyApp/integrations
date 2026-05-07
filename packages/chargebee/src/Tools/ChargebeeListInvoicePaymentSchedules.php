<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

/**
 * Retrieve payment schedules for an invoice.
 */
class ChargebeeListInvoicePaymentSchedules extends AbstractChargebeeEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results to return.'],
            'offset' => ['type' => 'string', 'description' => 'Pagination offset from a previous response.'],
    ];

    protected array $required = ['id'];

    protected array $queryParams = ['limit', 'offset'];

    protected array $bodyParams = [];

    protected string $method = 'GET';

    protected string $path = '/invoices/{id}/payment_schedules';

    protected string $toolName = 'chargebee_list_invoice_payment_schedules';

    protected string $toolDescription = 'Retrieve payment schedules for an invoice.';
}
