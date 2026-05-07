<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Provide dispute evidence.
 *
 * Maps to the official Checkout.com endpoint PUT /disputes/{dispute_id}/evidence.
 */
class CheckoutComProvideDisputeEvidence extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_provide_dispute_evidence';
    protected const DESCRIPTION = 'Provide dispute evidence

Official Checkout.com endpoint: PUT /disputes/{dispute_id}/evidence.';
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
    protected const METHOD = 'PUT';
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
