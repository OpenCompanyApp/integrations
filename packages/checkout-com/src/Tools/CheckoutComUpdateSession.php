<?php

namespace OpenCompany\Integrations\CheckoutCom\Tools;

/**
 * Update a session.
 *
 * Maps to the official Checkout.com endpoint PUT /sessions/{id}/collect-data.
 */
class CheckoutComUpdateSession extends AbstractCheckoutComTool
{
    protected const NAME = 'checkout_com_update_session';
    protected const DESCRIPTION = 'Update a session by providing information about the environment.

Official Checkout.com endpoint: PUT /sessions/{id}/collect-data.';
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
    protected const PATH = '/sessions/{id}/collect-data';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'application/json';
    protected const REQUIRES_AUTH = true;
}
