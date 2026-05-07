<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Submit dispute arbitration evidence.
 *
 * Maps to the official Checkout.com endpoint POST /disputes/{dispute_id}/evidence/arbitration.
 */
class CheckoutComSubmitDisputeArbitrationEvidence extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_submit_dispute_arbitration_evidence';
    protected const DESCRIPTION = 'Submits the previously provided arbitration evidence to the scheme. You cannot amend evidence after you submit with this endpoint. Ensure you have provided all of the required information.

Official Checkout.com endpoint: POST /disputes/{dispute_id}/evidence/arbitration.';
    protected const PARAMETERS = [
        'dispute_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The dispute identifier.',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/disputes/{dispute_id}/evidence/arbitration';
    protected const PATH_PARAMS = [
        'dispute_id' => 'dispute_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
