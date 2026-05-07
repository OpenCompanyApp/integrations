<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get a compliance request.
 *
 * Maps to the official Checkout.com endpoint GET /compliance-requests/{payment_id}.
 */
class CheckoutComComplianceRequestsGetComplianceRequest extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_compliance_requests_get_compliance_request';
    protected const DESCRIPTION = 'Retrieve an existing compliance request by payment ID.

Official Checkout.com endpoint: GET /compliance-requests/{payment_id}.';
    protected const PARAMETERS = [
        'payment_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The compliance request\'s payment ID.',
        ],
    ];
    protected const METHOD = 'GET';
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
