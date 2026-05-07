<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get forward request.
 *
 * Maps to the official Checkout.com endpoint GET /forward/{id}.
 */
class CheckoutComGetForwardRequest extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_forward_request';
    protected const DESCRIPTION = 'Retrieve the details of a successfully forwarded API request. The details can be retrieved for up to 14 days after the request was initiated.

Official Checkout.com endpoint: GET /forward/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The unique identifier of the forward request.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/forward/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
