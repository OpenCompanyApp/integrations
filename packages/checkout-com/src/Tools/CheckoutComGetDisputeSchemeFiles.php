<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get dispute scheme files.
 *
 * Maps to the official Checkout.com endpoint GET /disputes/{dispute_id}/schemefiles.
 */
class CheckoutComGetDisputeSchemeFiles extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_dispute_scheme_files';
    protected const DESCRIPTION = 'Returns all of the scheme files of a dispute using the dispute identifier. Currently available only for VISA disputes.

Official Checkout.com endpoint: GET /disputes/{dispute_id}/schemefiles.';
    protected const PARAMETERS = [
        'dispute_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The dispute identifier',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/disputes/{dispute_id}/schemefiles';
    protected const PATH_PARAMS = [
        'dispute_id' => 'dispute_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
