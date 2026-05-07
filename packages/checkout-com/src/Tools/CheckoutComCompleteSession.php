<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Complete a session.
 *
 * Maps to the official Checkout.com endpoint POST /sessions/{id}/complete.
 */
class CheckoutComCompleteSession extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_complete_session';
    protected const DESCRIPTION = 'Complete a session

Official Checkout.com endpoint: POST /sessions/{id}/complete.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Session ID',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official Checkout.com OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/sessions/{id}/complete';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
