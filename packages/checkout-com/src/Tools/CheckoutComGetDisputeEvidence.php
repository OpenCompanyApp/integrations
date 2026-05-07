<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get dispute evidence.
 *
 * Maps to the official Checkout.com endpoint GET /disputes/{dispute_id}/evidence.
 */
class CheckoutComGetDisputeEvidence extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_dispute_evidence';
    protected const DESCRIPTION = 'Retrieves a list of the evidence submitted in response to a specific dispute.

Official Checkout.com endpoint: GET /disputes/{dispute_id}/evidence.';
    protected const PARAMETERS = [
        'dispute_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The dispute identifier.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/disputes/{dispute_id}/evidence';
    protected const PATH_PARAMS = [
        'dispute_id' => 'dispute_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
