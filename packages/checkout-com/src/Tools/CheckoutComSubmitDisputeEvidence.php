<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Submit dispute evidence.
 *
 * Maps to the official Checkout.com endpoint POST /disputes/{dispute_id}/evidence.
 */
class CheckoutComSubmitDisputeEvidence extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_submit_dispute_evidence';
    protected const DESCRIPTION = 'With this final request, you can submit the evidence that you have previously provided. Make sure you have provided all the relevant information before using this request. You will not be able to amend your evidence once you have submitted it.

Official Checkout.com endpoint: POST /disputes/{dispute_id}/evidence.';
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
