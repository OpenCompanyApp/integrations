<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Get session details.
 *
 * Maps to the official Checkout.com endpoint GET /sessions/{id}.
 */
class CheckoutComGetSession extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_get_session';
    protected const DESCRIPTION = 'Returns the details of the session with the specified identifier string.

Official Checkout.com endpoint: GET /sessions/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Session ID',
        ],
        'channel' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Optionally provide the type of channnel so you only get the relevant actions',
            'enum' => ['browser', 'app'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/sessions/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [
        'channel' => 'channel',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
