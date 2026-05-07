<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Accept dispute.
 *
 * Maps to the official Checkout.com endpoint POST /disputes/{dispute_id}/accept.
 */
class CheckoutComAcceptDispute extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_accept_dispute';
    protected const DESCRIPTION = 'If a dispute is legitimate, you can choose to accept it. This will close it for you and remove it from your list of open disputes. There are no further financial implications.

Official Checkout.com endpoint: POST /disputes/{dispute_id}/accept.';
    protected const PARAMETERS = [
        'dispute_id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The dispute identifier',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/disputes/{dispute_id}/accept';
    protected const PATH_PARAMS = [
        'dispute_id' => 'dispute_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
