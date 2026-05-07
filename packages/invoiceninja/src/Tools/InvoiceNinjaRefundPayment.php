<?php

namespace OpenCompany\Integrations\InvoiceNinja\Tools;

/**
 * Refund an Invoice Ninja payment.
 */
class InvoiceNinjaRefundPayment extends AbstractInvoiceNinjaEndpointTool
{
    protected array $parameters = [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'Resource hashed ID.'],
            'payload' => ['type' => 'object', 'required' => true, 'description' => 'Request payload matching the Invoice Ninja API schema for this endpoint.'],
    ];

    protected array $required = ['id', 'payload'];

    protected array $queryParams = [];

    protected array $bodyParams = ['payload'];

    protected string $method = 'POST';

    protected string $path = '/api/v1/payments/{id}/refund';

    protected string $toolName = 'invoiceninja_refund_payment';

    protected string $toolDescription = 'Refund an Invoice Ninja payment.';
}
