<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Respond to a compliance request.
 *
 * Maps to the official Checkout.com endpoint POST /compliance-requests/{payment_id}.
 */
class CheckoutComComplianceRequestsSubmitComplianceRequestResponse extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_compliance_requests_submit_compliance_request_response';
    protected const DESCRIPTION = 'Submit a response to a compliance request.

Official Checkout.com endpoint: POST /compliance-requests/{payment_id}.';
    protected const PARAMETERS = [
        'payment_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The compliance request\'s payment ID.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/compliance-requests/{payment_id}';
    protected const PATH_PARAMS = [
        'payment_id' => 'payment_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
