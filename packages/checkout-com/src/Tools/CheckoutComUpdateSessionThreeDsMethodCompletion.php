<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Update session 3DS Method completion indicator.
 *
 * Maps to the official Checkout.com endpoint PUT /sessions/{id}/issuer-fingerprint.
 */
class CheckoutComUpdateSessionThreeDsMethodCompletion extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_update_session_three_ds_method_completion';
    protected const DESCRIPTION = 'Update the session\'s 3DS Method completion indicator based on the result of accessing the 3DS Method URL.

Official Checkout.com endpoint: PUT /sessions/{id}/issuer-fingerprint.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Session ID',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PUT';
    protected const PATH = '/sessions/{id}/issuer-fingerprint';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
